<?php

/*********************************************************************************************
 *  This file checks for existing users in the DB. Returns true if user exist 				 *
 ********************************************************************************************/

require_once "../config.php";

if (isset($_POST['email']) && isset($_POST['pwd'])){

	//Gets data that was sent over POST
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];

	//Checks that the e-mail and password match
	$q = "SELECT * FROM users WHERE email = '$email' AND pwd = '". md5($pwd) ."' LIMIT 1";

	if ($result = $mysqli->query($q)) {

		$num_rows = $result->num_rows;

		if ($num_rows == 1){

			//Sets the user_email and returns success
			if ($_SESSION["user_email"] = $email){

				$return_array["status"] = "200";

			}

		}else{

			$return_array["status"] = "604";
			$return_array["error"] = _("User and password do not match.");
		}

	}else{

			$return_array["status"] = "600";
			$return_array["error"] = _("Could not check the user credentials in the DB.");
			$return_array["error_details"] = $mysqli->error;
	}
}else{

	$return_array["status"] = "603";
	$return_array["error"] = _("Not enough parameters were passed.");

}


echo json_encode($return_array);
?>