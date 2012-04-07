<?php

	// read the credentials file
	$string = file_get_contents($_ENV['CRED_FILE'], false);
	if ($string == false) {
	    die('FATAL: Could not read credentials file');
	}

	// the file contains a JSON string, decode it and return an associative array
	$creds = json_decode($string, true);

	//DB credentials
	define("DW_HOST", $creds['MYSQLS']['MYSQLS_HOSTNAME']);
	define("DW_DATABASE", $creds['MYSQLS']['MYSQLS_DATABASE']);
	define("DW_USERNAME", $creds['MYSQLS']['MYSQLS_USERNAME']);
	define("DW_PASSWORD", $creds['MYSQLS']['MYSQLS_PASSWORD']);


	//The following global vars are stored in the option table of the MYSQL database
	//AWS_SECRET		To be used in Amazon Simple Email Service
	//AWS_ACCESS_KEY	To be used in Amazon Simple Email Service
	//BASE_DIR			Gets the base URL to use in the app
	//PIWIK_PATH		Path to the piwik analytics server

	$mysqli = new mysqli(DW_HOST,DW_USERNAME,DW_PASSWORD,DW_DATABASE);

	//Queries the DB
	$q = "SELECT * FROM options WHERE name='AWS_SECRET' OR name='AWS_ACCESS_KEY' OR name='BASE_DIR' OR name='PIWIK_PATH' ";

	if ($result = $mysqli->query($q)) {

		//fetches the result
		while ($row = $result->fetch_object()) {

			//Defines the global vars
			define($row->name, $row->value);
		}
	}

?>