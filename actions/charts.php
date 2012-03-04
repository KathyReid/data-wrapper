<?php

/****
/*
/*   @desc: Manages the charts
/*
/****/

if (isset($_POST['action'])){
	
	require_once "../config.php";

	$chart = new Chart($mysqli);

	if  (isset($_POST['chart_id'])){

		$chart->setID($chart_id);
	
	}

	switch($_POST['action']){
		
		case "setData":
			$data = $_POST['data'];
			$chart->loadData($data);
			break;

		case "getData":
			$chart->getData();
			break;

		case "transpose":
			$chart->transpose();
			break;

		case "storeVis":
			$opts = $_POST['opts'];
			$chart->setOpts($opts);
			$chart->storeOpts();
			break;

		case "toggle_header":
			$chart->toggle_header();
			break;

		default:


	}

	$return_array = $chart->return_status();

}else{

	$return_array["status"] = "603";
	$return_array["error"] = _("No action defined.");

}

echo json_encode($return_array);
?>