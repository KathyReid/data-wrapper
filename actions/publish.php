<?php


/****
/*
/*   @desc: Sends back the code for the visualization
/*   @author: NKB <hi@nkb.fr>
/*
/****/


require_once "../config.php";

$chart_id = $_POST['chart_id'];

$action = $_POST['action'];

$q = "SELECT chart_js_code, chart_type, chart_library, chart_theme FROM charts WHERE chart_id='$chart_id' LIMIT 1";

if ($result = $mysqli->query($q)) {
	
	//fetches the result
	while ($row = $result->fetch_object()) {

		$chart_js_code = $row->chart_js_code;
		$chart_library = $row->chart_library;
		$chart_type = $row->chart_type;
		$chart_theme = $row->chart_theme;
		
}

	//success
	$return_array["status"] = "200";

	//returns the chart JS code in an array
	$return_array["chart_js_code"] = json_decode($chart_js_code, true);

	//returns the chart type & lib & theme
	$return_array["chart_type"] = $chart_type;
	$return_array["chart_library"] = $chart_library;
	$return_array["chart_theme"] = $chart_theme;

	//returns the id of the chart
	$return_array["chart_id"] = $chart_id;

	//returns the text id
	$return_array["chart_text_id"] = alphaID($chart_id);

}else{

	$return_array["status"] = "600";
	$return_array["error"] = _("Could not fetch the data from the database.");
	$return_array["error_details"] = $mysqli->error;
} 



echo json_encode($return_array);

$mysqli->close();