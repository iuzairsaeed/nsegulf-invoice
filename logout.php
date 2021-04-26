<?php
session_start();
session_regenerate_id(TRUE);

if (!isset($_SESSION['user']) && !isset($_SESSION['password'])) {
	header('location:login.php');
	exit;
}

else {
	session_destroy();
	header("location: login.php");
}
?>
