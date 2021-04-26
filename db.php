<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

require("db_config.php");
$db = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbdatabase, $db);
?>