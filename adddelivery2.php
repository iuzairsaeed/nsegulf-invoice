<?php
require("db_config.php");
require("db.php");
require("header.php");
include_once('adminCheck.php');
?>
	<script type=Text/Javascript src=scw.js></script>
	<form method=POST action=adddelivery3.php>
	<div style="width:750px;height:300px;padding-top:20px;padding-left:30px;background:#ccc;margin:0 auto;">
	<table style="width:600;float:left;;text-align:left;">
	<tr>
<?PHP
$select="select * from cards where ID='".$_GET['cardid']."' and cardstatus='del';";
$selres=mysql_query($select);
$self=mysql_fetch_assoc($selres);
?>
	<td></td><td><input type=hidden READONLY name=cardid value='<?php echo $_GET['cardid'] ?>'>Assigning Delivery Number for Card #<?PHP ECHO $self['cardnumber'] ?></td></tr><tr>
	<td style="padding-right:10px;">Date</td><td><input type=text name=cdate onMouseOver="scwShow(this,event);"></td></tr></table><br /><br />
	
<?php
echo "<table style='margin:0 auto;width:600px;'><tr><td style='width:30px;'></td><td>Qty</td><td>Description</td><td>Unit Price</td><td>Line Total</td></tr>";
for($i=1; $i<=5; $i++){
	echo "<tr><td style='width:30px;'><input type=hidden name=number[] value=".$i."></td><td><input type=text name=quantity[]></td><td><input type=text name=description[]></td><td><input type=text name=unitprice[]></td><td><input type=text name=linetotal[]></td></tr>";
	
}
echo "<tr><td></td><td></td><td></td><td></td><td align=right><input type=submit name=submit value=submit></td></tr>";
echo "</table>";

?>