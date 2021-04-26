<?php
//session_start();
session_regenerate_id(TRUE);
require("session_validator.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="nofollow" />
<meta name="googlebot" content="noarchive" />
<meta name="googlebot" content="nosnippet" />
<title>NSE Invoice System</title>
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link href="js/datepicker/css/jquery-ui-1.8.2.custom.css" rel="stylesheet" type="text/css" />

</head>
<body>
<?php

echo '<div style="width:100%;clear:both;padding-bottom:50px;text-align:center;font:18px Trebuchet MS, sans serif;font-weight:bold;">';
echo '<ul><li style="display:inline;padding-right:10px;"><a style="background:#000;color:#FFF;padding-left:10px;padding-right:10px;text-decoration:none;" href="addcard.php" />Job Card</a></li>
<li style="display:inline;padding-right:10px;"><a style="background:#000;color:#FFF;padding-left:10px;padding-right:10px;text-decoration:none;" href="search_inv.php" />Invoice</a></li>
<li style="display:inline;padding-right:10px;"><a style="background:#000;color:#FFF;padding-left:10px;padding-right:10px;text-decoration:none;" href="search_del.php"/>Delivery</a></li>
<li style="display:inline;padding-right:10px;"><a style="background:#000;color:#fff;padding-left:10px;padding-right:10px;text-decoration:none;" href="br.php" />Branch Report</a></li>
<li style="display:inline;padding-right:10px;"><a style="background:#000;color:#fff;padding-left:10px;padding-right:10px;text-decoration:none;" href="md.php" />Managers Report</a></li>
<li style="display:inline;padding-right:10px;"><a style="background:#000;color:#fff;padding-left:10px;padding-right:10px;text-decoration:none;" href="us.php"/>Update Status</a></li></ul>';

echo '</div>';


?>