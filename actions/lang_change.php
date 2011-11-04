<?php

/*********************************************************************************************
 *  This file changes the language of the app following an AJAX request                      *
 ********************************************************************************************/

require_once "../libraries/functions.lang.php";

if (isset($_POST["lang"])){

	$lang = $_POST["lang"];

	//Detects the current locale
	$current_locale =  setlocale(LC_ALL, '0');
	
	//if the demanded language is different from the current one
	if ($current_locale != $lang."UTF-8"){

		$pattern = "/[a-z]_[A-Z]/";

		//Checks that the locale is correctly set
		if (preg_match($pattern, $lang)){

			//sets the language
			$newLocale = setLanguage($lang);
			$return_array["status"] = "200";
			$return_array["lang"] = _("$newLocale");

		}else{
			$return_array["status"] = "603";
			$return_array["error"] = _("Unknown language code.");
		}
	}else{
		$return_array["status"] = "201";
	}

	echo json_encode($return_array);

}


?>