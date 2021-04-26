<?php

include_once('adminCheck.php');
	require("db_config.php");
	require("db.php");
	require("header.php");
?>
<div style="width:500px;padding-top:10px;background:#ccc;margin:0 auto;font:12px Trebuchet MS, sans serif;">
	<table style="width:450px;margin:0 auto;text-align:center;margin:0 auto;">
	<tr style="font-weight:bold">
	<td>Card Number</td><td>Card Date</td><td>Action</td></tr>
<?PHP
$sel1="select * from delivery;";
$s1=mysql_query($sel1);
while($s1f=mysql_fetch_assoc($s1)){

	echo '<tr><td>'.$s1f['delnum'].'</td><td>'.$s1f['deldate'].'</td><td><a href="vd.php?cardid='.$s1f['cardid'].'&delid='.$s1f['delnum'].'"/target=_blank>View Delivery</td>';
	echo '</tr>';
}
echo '</table>';
echo '</div>';
?>