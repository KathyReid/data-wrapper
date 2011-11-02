<?php

/**
 * @desc: Manages users
 *
 * @author: nkb
 *
 */

class User { 

	public $id;
	public $email;

	function getID(){

		global $mysqli;

		if (isset($_SESSION["user_email"])){

			$email = $_SESSION["user_email"];

			$q = "SELECT user_id FROM users WHERE email = '$email' LIMIT 1";

			if ($result = $mysqli->query($q)) {
				
				while ($row = $result->fetch_object()) {

					$id = $row->user_id;
				}

				return $id;
				
			}else{
				//Error with DB
				 return json_encode( Array("status" => 600, "message" => _("Error while trying to retrieve user from database.") ) );
			}
		}
	}
}

?>