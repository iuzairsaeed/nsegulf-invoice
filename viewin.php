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
$sel1="select * from invoice;";
$s1=mysql_query($sel1);
while($s1f=mysql_fetch_assoc($s1)){

	echo '<tr><td>'.$s1f['invoicenumber'].'</td><td>'.$s1f['invoice_date'].'</td><td><a href="vi.php?cardid='.$s1f['card_id'].'&invid='.$s1f['invoiceid'].'"/target=_blank>View Invoice</td>';
	echo '</tr>';
}
echo '</table>';
echo '</div>';
?>