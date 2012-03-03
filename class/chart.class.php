<?php

/**
 * @desc: Manages charts
 *
 * @author: nkb
 *
 */


class Chart { 

	public $id;
	public $raw_data;
	public $formatted_data;
	public $csv_data;
	public $has_vertical_header;
	public $has_horizontal_header;
	protected $db;


	function __construct(& $db) {  
	      
        // links to the db
        $this->db = & $db;

    }

    function setID($id){

    	$this->id = $id;
    
    }

    function setData($raw_data){
    	
    	$this->raw_data = $raw_data;

    }

    /*   
	 *	@desc: 		Loads the data in the app
	 *  @return: 	chart_id to the front
	 */

    function loadData($raw_data){
    	
    	$this->setData($raw_data);

    	$this->formatData();

    	return $this->storeData();

    }

    /*   
	 *	@desc: Converts TSV data in an array
	 */

    function formatData(){
    	//Contains the CSV data
		$this->formatted_data = array();

		//Contains the JSON that'll be sent back to the front
		$return_array = array();

		//Parses the rows
		$rows = explode("\n", $this->raw_data);

		$this->has_horizontal_header = 0;
		$this->has_vertical_header = 0;

		$top_headers = 0;
		$vert_headers = 0;
		$row_num = -1;

		foreach ($rows as $key_row=>$row){
			
			//If the row isn't just one empty cell
			if (count($row)>1 || $row!=""){

				//new row in the formatted_data array
				$row_num++;

				$this->formatted_data[$row_num] = array();

				//Parses the columns in an array
				$row_array = explode("\t", $row);

				//adds the column array to the formatted array
				foreach ($row_array as $key_col => $cell_raw){
					
					$cell = trim($cell_raw);

					//Converts commas to dots
					if (!(is_numeric($cell)) && is_numeric(str_replace(",", ".", $cell)))
						$cell = str_replace(",", ".", $cell);

					//detects if there are headers on the top row. 	
					if ($key_row == 0){
						if (!(is_numeric($cell)))
							$top_headers++;
					}

					if ($key_col == 0){
						//detects if there are headers on the first column
						if (!(is_numeric($cell)))
							$vert_headers++;
					}

					$this->formatted_data[$row_num][$key_col] = trim($cell);
				}
			}
		}

		//If more than 50% of the rows are not numeric, there are horizontal headers
		if ($top_headers > (count($this->formatted_data[0])/2))
			$this->has_horizontal_header = 1;

		//If more than 50% of the cells on the first col are not numeric, there are vertical headers
		if ($vert_headers >= (count($this->formatted_data)/2))
			$this->has_vertical_header = 1;

		if (!$this->has_horizontal_header){
			//if the top row contains numerical data between 1900 and 2100 in successive order, then it's a header
			$count_years = 0;
			$prev_year = 0;

			foreach ($this->formatted_data[0] as $year){
				
				if ($prev_year == ($year - 1) && ($year > 1900) && ($year < 2100))
					$count_years++;

				$prev_year = $year;
			}

			if ($count_years > (count($this->formatted_data[0])/2))
				$this->has_horizontal_header = 1;
		}

		//Empties the top left cell if there are vertical and horizontal headers
		if ($this->has_vertical_header && $this->has_horizontal_header)
			$this->formatted_data[0][0] = "";

		//Transposes automatically so that we only have 1 kind of single-header tables to deal with
		if ($this->has_vertical_header == 0 && $this->has_horizontal_header == 1){
			//transposes
			$this->formatted_data = transpose($this->formatted_data);

			//corrects the headers description
			$this->has_vertical_header = 1;
			$this->has_horizontal_header = 0;

		}
    }

    /*   
	 *	@desc: Stores the data in the DB
	 */

    function storeData(){

    	$user_id = $_SESSION["user_id"];

    	$serialized_data = addslashes(serialize($this->formatted_data));

		//Stores the data in the DB
		$q = "INSERT INTO charts (user_id, chart_csv_data, date_create, horizontal_headers, vertical_headers) VALUES ('$user_id', '$serialized_data', '" . date('Y-m-d H:i:s') . "', " . $this->has_horizontal_header . ", " . $this->has_vertical_header . ")";

		if ($result =$this->db->query($q)) {
			
			$this->id = $this->db->insert_id;

			$return_array["status"] = "200";
			
			//returns the id of the chart
			$return_array["chart_id"] = $this->id;

		}else{

			$return_array["status"] = "600";
			$return_array["error"] = _("Could not store the data on the database.");
			$return_array["error_details"] = $this->db->error;
		} 
    	
    	return $return_array;

    }

    /*   
	 *	@desc: 		Gets the data
	 *	@return: 	CSV data
	 */

    function getData(){

    	$q = "SELECT chart_csv_data, horizontal_headers, vertical_headers FROM charts WHERE chart_id='" . $this->id . "' LIMIT 1";

		if ($result = $this->db->query($q)) {
			
			//fetches the result
			while ($row = $result->fetch_object()) {

				$this->csv_data = unserialize($row->chart_csv_data);
				$this->has_horizontal_headers = $row->horizontal_headers;
				$this->has_vertical_headers = $row->vertical_headers;
				
			}

			//success
			$return_array["status"] = "200";
			
			//returns the chart data
			$return_array["csv_data"] = $this->csv_data;

			//returns the headers details
			$return_array["vertical_headers"] = $this->has_vertical_headers;
			$return_array["horizontal_headers"] = $this->has_horizontal_headers;

			//returns the id of the chart
			$return_array["chart_id"] = $this->id;
		}else{

			$return_array["status"] = "600";
			$return_array["error"] = _("Could not fetch the data from the database.");
			$return_array["error_details"] = $this->db->error;

		} 

		return $return_array;
    }
    
    /*   
	 *	@desc: 		Transposes the data
	 *	@return: 	status
	 */

    function transpose(){

    	$this->getData();

    	if ($this->has_horizontal_headers && $this->has_vertical_headers){

			//Transposes the data
			$this->csv_data = transpose($this->csv_data);

			$q = "UPDATE charts SET chart_csv_data = '" . serialize($this->csv_data) . "' WHERE chart_id = '". $this->id ."'";
			
			if ($result = $this->db->query($q)) {

				//success
				$return_array["status"] = "200";

				//returns the id of the chart
				$return_array["chart_id"] = $this->id;

			}else{
					$return_array["status"] = "600";
					$return_array["error"] = _("Could not transpose the data in the database.");
					$return_array["error_details"] = $this->db->error;
			}

		}else{
			
			//Error message when trying to transpose a table with only one header

			$return_array["status"] = "601";
			$return_array["error"] = _("You can only transpose a table with two entries.");
		}

		return $return_array;
    }

    /*   
	 *	@desc: 		Toggles the has_horizontal_header
	 *	@return: 	status
	 */

    function toggle_header(){

    	$this->getData();

    	$return_array["has_horizontal_header"] = $this->has_horizontal_header;

    	if ($this->has_horizontal_headers == 1)
    		$this->has_horizontal_headers = 0;
    	else
    		$this->has_horizontal_headers = 1;

    	$q = "UPDATE charts SET horizontal_headers = '". $this->has_horizontal_headers ."' WHERE chart_id='". $this->id ."' LIMIT 1";

		if ($result = $this->db->query($q)) {

			//success
			$return_array["status"] = "200";

			//returns the id of the chart
			$return_array["chart_id"] = $this->id;

		}else{
				$return_array["status"] = "600";
				$return_array["error"] = _("Could not modify header row.");
				$return_array["error_details"] = $mysqli->error;
		}

		return $return_array;
    }
}