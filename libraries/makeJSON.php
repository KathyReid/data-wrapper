<?php

/******************************************************
*  @desc: Generates the appropriate JSON  			  *
*  @param: Nothin			 						  * 
*  @return: Nothin									  *
*													  *
/*****************************************************/

//Makes the JSON files
makeJSON();

function makeJSON(){

	$files = array("visualizations/config.json");

	foreach($files as $file_name){

		/*Gets the localized version of the JSON*/
		$file_php_contents = $file_name.".php";
		require_once($file_php_contents);

		/*Updates the JSON file*/

		$fh = fopen($file_name, 'w') or die("can't open file");
		fwrite($fh, $file_content);
		fclose($fh); 
	}
}
?>