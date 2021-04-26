<?php
error_reporting(E_ERROR | E_PARSE);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//echo $old_sessionid = session_id();

////// URL DEL SERVER PER SSL //////

if (!isset($_SESSION['user']) && !isset($_SESSION['password'])) 
{

	header('location:login.php');
	exit();
}

else 
{
	
	$welcome_user = $_SESSION['user'];
	$welcome_user_new = ucwords($welcome_user);
	$welcome = '<div id="welcome"><span id="welcome_txt">Logged in as '.$welcome_user_new.' - <a style="color:#E0D91B;" href="'.$https.'/logout.php">Logout</a></span></div>';
}

?>