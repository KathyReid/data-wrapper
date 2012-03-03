<?php

/****
/*
/*   @desc: Manages the charts
/*
/****/

if (isset($_POST['action'])){
	
	require_once "../config.php";

	$chart = new Chart($mysqli);

	switch($_POST['action']){
		
		case "setData":
			$data = $_POST['data'];
			$return_array = $chart->loadData($data);
			break;

	}

}else{

	$return_array["status"] = "603";
	$return_array["error"] = _("No action defined.");

}

echo json_encode($return_array);
?>