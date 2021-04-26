<?php
error_reporting(E_ERROR | E_PARSE);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if($_SESSION['level'] != "0"){
   header("location:main2.php");
   
}
?>