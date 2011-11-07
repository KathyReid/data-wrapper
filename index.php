<?php 

require_once "config.php"; 

if (isset($_GET["c"])){
	//User is loading an embedded visualization
	require_once "views/embed.php";

}else if(isset($_SESSION["user_email"])){

	//User is signed in, can build a datavis
	
	//Gets user_id
	$user = new User();
	$user_id = $user->getID();
	$user_email = $_SESSION["user_email"];
	$_SESSION["user_id"] = $user_id;

	require_once "views/screens.php";

}else{
	//Not signed in
	require_once "views/login.php";
}

?>
