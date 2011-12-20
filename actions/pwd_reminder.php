<?php

/****
/*
/*   @desc: Sends an email to the user for her to renew her password 
/*   @author: NKB <hi@nkb.fr>
/*
/****/

require_once "../config.php";

if (isset($_POST['email'])){

	//Gets data that was sent over POST
	$email = $_POST['email'];

	//Checks that the e-mail is in the DB
	$q = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

	if ($result = $mysqli->query($q)) {

		$num_rows = $result->num_rows;

		if ($num_rows == 1){

			//generates a new token
			$token = genRandomString();

			//Deletes the previous password hash and inserts new token
			$q_rm_pwd = "UPDATE users SET token='$token' WHERE email='$email'";

			if ($result = $mysqli->query($q_rm_pwd)) {

				//Prepares verify email
				$confirm_link = BASE_DIR."/?new_pwd=$token&email=$email";

				$to      = $email;

				$subject = '[DataWrapper] '. _("Password change requested");
				
				$message = _("Dear DataWrapper user,");
				$message .= "\r\n\r\n";
				$message .=	_("Please click on the link below to change your password:");
				$message .= "\r\n\r\n";
				$message .=	"<a href='$confirm_link'>$confirm_link</a>";
				$message .= "\r\n\r\n";
				$message .= _("Do ignore this message if you did not request a password change from DataWrapper.");
				$message .= "\r\n\r\n";
				$message .= _("Thanks!");
				$message .= "\r\n\r\n";
				$message .= _("The DataWrapper team");

				$headers = 'From: noreply@datastory.de' . "\r\n" .
				    'Reply-To: noreply@datastory.de' . "\r\n" .
				    'Content-type: text/html; charset=utf-8' . "\r\n" .
				    'X-Mailer: PHP/' . phpversion();

				//Sends email
				if (mail($to, $subject, $message, $headers))
					$return_array["status"] = "200";

				else{

					$return_array["status"] = "600";
					$return_array["error"] = _("Could not send password change e-mail.");

				}
					
			
			}else{

				$return_array["status"] = "600";
				$return_array["error"] = _("Could not send password change email.");
				$return_array["error_details"] = $mysqli->error;

			}

		}else{

			$return_array["status"] = "605";
			$return_array["error"] = _("No user found with this email address.");
		}

	}else{

		$return_array["status"] = "600";
		$return_array["error"] = _("Could not send password change email.");
		$return_array["error_details"] = $mysqli->error;
	}
}else{

	$return_array["status"] = "603";
	$return_array["error"] = _("Not enough parameters were passed.");

}


echo json_encode($return_array);
?>