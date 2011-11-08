<?php

/****
/*
/*   @desc: Stores the visualization code in the DB
/*   @author: NKB <hi@nkb.fr>
/*
/****/


require_once "../config.php";

$data = stripslashes($_POST['data']);

$chart_id = $_POST['chart_id'];

$action = $_POST['action'];

if ($action == "next"){
	//If user has pressed the 'next' button

	//Fetches the JSON data sent by the client and stores it in the DB
	$data_json = json_decode($data);

	//Gets the lib in use
	$chart_library = $data_json->chart_lib;

	//Specific ton HighCharts
	$chart_type = "";
	if ($chart_library == "Highcharts"){
		
		//Gets the chart type
		$chart_type = $data_json->chart->defaultSeriesType;

		//Gets the chart title
		$chart_title = $data_json->title->text;

		//Gets the chart theme
		$chart_theme = $data_json->chart->chart_theme;
	}

	//Retrieves chart JS code for visualization
	$chart_js_code = addslashes($data);

	//Gets the current language
	$chart_lang = getLocale();

	//Builds query
	$q = "UPDATE charts SET chart_js_code = '$chart_js_code', chart_type='$chart_type', chart_theme='$chart_theme', chart_library='$chart_library', chart_title='$chart_title', chart_lang='$chart_lang' WHERE chart_id='$chart_id'";

	if ($result = $mysqli->query($q)) {
		
		//success
		$return_array["status"] = "200";

		//returns the id of the chart
		$return_array["chart_id"] = $chart_id;
			
	}else{

		$return_array["status"] = "600";
		$return_array["error"] = _("Could not fetch the data from the database.");
		$return_array["error_details"] = $mysqli->error;
	}
}


echo json_encode($return_array);

$mysqli->close();



?>