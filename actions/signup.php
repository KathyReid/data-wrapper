<?php

/*********************************************************************************************
 *  This file signsup new users and logs them in 											 *
 ********************************************************************************************/

require_once "../config.php";

if (isset($_POST['email']) && isset($_POST['pwd'])){

	//Gets data that was sent over POST
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];

	//Checks that the e-mail is not in the DB
	$q = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

	if ($result = $mysqli->query($q)) {

		$num_rows = $result->num_rows;

		if ($num_rows == 0){

			//Creates a new user

			$q_adduser = "INSERT INTO users (email, pwd) VALUES ('$email', '". md5($pwd) ."')";

			if ($result = $mysqli->query($q_adduser)) {

				$_SESSION["user_email"] = $email;

				$return_array["status"] = "200";
			
			}else{

				$return_array["status"] = "600";
				$return_array["error"] = _("Could not add user in the DB.");
				$return_array["error_details"] = $mysqli->error;

			}

		}else{

			$return_array["status"] = "605";
			$return_array["error"] = _("A user already has this email address.");
		}

	}else{

		$return_array["status"] = "600";
		$return_array["error"] = _("Could not add user in the DB.");
		$return_array["error_details"] = $mysqli->error;
	}
}else{

	$return_array["status"] = "603";
	$return_array["error"] = _("Not enough parameters were passed.");

}


echo json_encode($return_array);
?>