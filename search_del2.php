<?PHP
include_once('adminCheck.php');
if($_POST['submit']==true){
	require("db_config.php");
	require("db.php");
$namesearch=$_POST['searchname'];
$sel1="select * from cards where cardnumber LIKE '".$namesearch." %' OR clientjobnumber LIKE '%".$namesearch."%' and cardstatus='del';";
$s1=mysql_query($sel1);
$s1row=mysql_num_rows($s1);

if($s1row != 1){
	echo "This card does not exists.";
	exit;
}else{
$s1f=mysql_fetch_assoc($s1);
require("header2.php");
?>
<div style="width:500px;padding-top:10px;background:#ccc;margin:0 auto;font:12px Trebuchet MS, sans serif;">
<table style="width:450px;margin:0 auto;text-align:center;margin:0 auto;">
	<tr style="font-weight:bold">
<?PHP
echo '<td>Card Number</td><td>Client Job Number</td><td>Card Date</td><td>Add Invoice</td></tr><tr>';
	echo '<td>'.$s1f['cardnumber'].'</td><td>'.$s1f['clientjobnumber'].'</td><td>'.$s1f['carddate'].'</td><td><a href="delin2.php?cardid='.$s1f['ID'].'"/>Add Delivery</td>';
	echo '</tr>';

echo '</table>';
echo '</div>';
}
}else{	
	require("header2.php");
}	
	
?>