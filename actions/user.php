<?php

/****
/*
/*   @desc: Manages the user
/*   @author: NKB <hi@nkb.fr>
/*
/****/

if (isset($_POST['action'])){
	
	require_once "../config.php";
	require_once "../libraries/ses.php";

	$user = new User($mysqli);

	switch($_POST['action']){
		
		case "signup":
			$return_array = $user->signup();
			break;

		case "connect":
			$return_array = $user->connect();
			break;

		case "logout":
			$return_array = $user->logout();
			break;

	}

}elseif (isset($_GET["verify"])){
	
	$user = new User($mysqli);

	$user->verify();

}else{

	$return_array["status"] = "603";
	$return_array["error"] = _("No action defined.");

}

echo json_encode($return_array);
?>