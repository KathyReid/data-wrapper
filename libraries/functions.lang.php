<?php

	/*********************************************************************************
	*** Languages functions library
	*
	* @author	Development Team (XL) <contact@web-e-tic.fr>
	* @desc		
	*********************************************************************************/

	/** Function setLanguage
	* @author	Development Team (XL based on Yosra's) <contact@web-e-tic.fr>
	* @desc		set language info for gettext stuff and co
	*
	* @param	$lang		: string ; looks like "fr_FR" or "en_US" ...
	* @param	$domain		: string ; typically the name of the language files
	* @param	$baseFolder	: string ; under the document root ; it's the folder that contain sth like "fr_FR/LC_MESSAGES/*.[pm]o"
	* @return	the new locale
	*/

	function setLanguage($lang, $domain = "messages", $baseFolder = "") {
				

				//Starts session if it hasn't been started already
				if (!isset ($_COOKIE[ini_get('session.name')])) {
    				session_start();
  				}

				$baseFolder = dirname(__FILE__)."/../locale";
				
				$_SESSION[LANG_SESSION_VAR] = $lang;

                $codeset = "UTF-8";
                
				putenv("LC_ALL=$lang");
				putenv("LANG=$lang.$codeset");
                putenv("LANGUAGE=$lang.$codeset");

                $newLocale = setlocale(LC_ALL, "$lang.$codeset");

                bindtextdomain($domain, $baseFolder);
                bind_textdomain_codeset($domain, $codeset);
				textdomain($domain);

				return $newLocale;
                
	}



	/** Function initLanguage
	* @author	Pierre Romera, Team 22mars <pierre.romera@gmail.com>
	* @desc		Define application language
        * 
	*/
        if(! function_exists("initLanguage") ) {

            define('LANG_SESSION_VAR', 'language');

            function initLanguage() {

                if(isset($_GET["lang"]))
                     setLanguage($_GET["lang"]);

                elseif( isset($_SESSION[LANG_SESSION_VAR]) )
                     setLanguage($_SESSION[LANG_SESSION_VAR]);

                else setLanguage("en_US");

            }
        }

?>