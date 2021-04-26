<?php

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
<div id="wrapper">
<div id="header">
    	<?php
        echo $welcome;
		echo '<div id="logo_link"><a href="'.$https.'/main.php"></a></div>';
			
echo '</div>';
echo '</div>';

?>

<div style="clear:both;width:500px;padding-top:10px;height:50px;padding-bottom:20px;margin:0 auto;font:12px Trebuchet MS, sans serif;">
<form method=post action=search_result.php>
	<table style="width:450px;margin:0 auto;text-align:center;margin:0 auto;">
	<tr style="font-weight:bold">
	<td><input type=text name=search size=50></td>
	<td><input style="width:100px;" type=submit name=submit value=Search></td></tr></table></form>
</div>
<?PHP
echo "<div id=wrapper3>";
?>