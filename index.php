<?php 

require_once "config.php"; 

echo setlocale(LC_ALL, '0');

if (isset($_GET["c"])){
	//User is loading an embedded visualization
	require_once "inc/embed.php";

}else if(isset($_SESSION["user_email"])){

	//User is signed in, can build a datavis
	
	//Gets user_id
	$user = new User();
	$user_id = $user->getID();
	$user_email = $_SESSION["user_email"];
	$_SESSION["user_id"] = $user_id;

	require_once "inc/screens.php";

}else{
	//Not signed in
	require_once "inc/login.php";
}

?>
