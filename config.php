<?php

session_start();

//Initializes GetText
require_once "libraries/functions.lang.php";
initLanguage();

//Fetches the functions that DW needs to run
require_once "libraries/helpers.php";

//Indicates the name of the prod server
$prod_domain1 = "cloudcontrolled.com";

$prod_domain2 = "datawrapper.de";



if (strstr($_SERVER['SERVER_NAME'], $prod_domain1) || strstr($_SERVER['SERVER_NAME'], $prod_domain2) ){		

	// PROD ENVIRONMENT //
	require_once('actions/passwords.prod.php');

}else{

	// DEV ENVIRONMENT //
	require_once('actions/passwords.dev.php');
}

global $mysqli;

$mysqli = new mysqli(DW_HOST,DW_USERNAME,DW_PASSWORD,DW_DATABASE);

//Loads the user class
require_once "class/user.class.php";

//Loads the chart class
require_once "class/chart.class.php";
?>