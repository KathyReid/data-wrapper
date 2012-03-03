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
			$return_array = $chart->loadData($data);
			break;

		case "getData":
			$return_array = $chart->getData();
			break;

	}

}else{

	$return_array["status"] = "603";
	$return_array["error"] = _("No action defined.");

}

echo json_encode($return_array);
?>