<?php
include_once('adminCheck.php');
require("headermain.php");
echo "<div id=mainpagebg>";
if($_POST['submit']==TRUE){
$error=array();

if($_POST['name1']==false){
$error[]="You did not tell us your name";
}
if($_POST['email']==false){
$error[]="You did not supply the email";
}
if($_POST['phone']==false){
$error[]="You did not supply phone number";
}
if($_POST['organization']==false){
$error[]="You did not supply your company name";
}
if($_POST['business']==false){
$error[]="You did not supply type of business";
}
if($_POST['comments']==false){
$error[]="You did not write any comments in the inquiry box";
}



if(count($error) > 0){
	
foreach($error as $errors){

echo $errors;
echo "<br />";
}
echo "<input style='border:1px solid #ccc;background:#BA0000;color:#ccc;' type='button' value='Back' onclick='history.go(-1)' /><br />";
}else{
	$message = 'Dear Inam '.$_POST['name1'].' has requested following Information:<br /><br />';
	$message .=$_POST['name1'].' details are as follows<br />
	Email:		'.$_POST['email'].'<br />
	Phone:		'.$_POST['phone'].'<br />
	Organization: '.$_POST['organization'].'<br />
	Business:	'.$_POST['business'].'<br />
	Address:	'.$_POST['address'].'<br />
	Inquire:	'.$_POST['comments'].'<br />';
	
	$destination = '';
$subject = 'Training Request by '.$first.'';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'To: Admin <khaninamm@gmail.com>' . "\r\n";
$headers .= 'From: Sonypsmea Training System <info@sonypsmea.com>' . "\r\n";

mail($destination, $subject, $message, $headers);	
	
	echo "Thank You for your inquiry regarding Sony Technical Training. We will get back to you with an official quotation based on availability of resources.";
	echo "<br />";
	echo "<a style='border:1px solid #ccc;background:#BA0000;color:#ccc;' href='http://www.sonypsmea.com/main.php'/>Main</a><br />";
	
			echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
}
}else{






		ECHO "<div style='width:60%;margin:0 auto;font:15px Trebuchet MS, sans serif;color:#777;margin-top:30px'>";
		echo "<H5>Please fill in as much details as possible</H5><br /><br /><br />";
		echo "<form method = POST action='gi.php'>";
		echo "<label  style='float:left;'>Your Name</label>&nbsp;<input size=40 style='float:right;' type=text name=name1 maxlength=50> <br /><br />";
		echo "<label  style='float:left;'>Email</label>&nbsp;<input size=40 style='float:right;' type=text name=email maxlength=100> <br /><br />";
		echo "<label  style='float:left;'>Phone</label>&nbsp;<input size=40 style='float:right;' type=text name=phone maxlength=50> <br /><br />";
		echo "<label  style='float:left;'>Organization</label>&nbsp;<input size=40 style='float:right;' type=text name=organization maxlength=50> <br /><br />";
		echo "<label  style='float:left;'>Nature of Business</label>&nbsp;<select style='float:right;' name=business> <option value=''>Select</option>
<option value='Broadcaster'>Broadcaster</option>
<option value='Production Facility'>Production Facility</option>
<option value='System Integrator'>System Integrator</option>
<option value='Education Center>Education Center</option>
<option value='Medical Facility'>Medical Facility</option>
<option value='Repair Facility'>Repair Facility</option>
<option value='Freelancer'>Freelancer</option>
<option value='Other'>Other</option></select>
<br /><br />";
		echo "<label  style='float:left;'>Address</label>&nbsp;<input size=40 style='float:right;' type=text name=address maxlength=100> <br /><br />";
		echo "<label  style='float:left;'>You are inquiring about?</label>&nbsp;<textarea style='float:right;' cols=31 rows=10 name=comments maxlength=500></textarea> <br /><br /><br /><br /><br /><br /><br /><br /><br />
<input style='float:right;' type=submit name=submit value=Submit><br /><br /><br /><br /><br /><br /><br /><br /><br />";
			echo "</form>";
		
		
	
		
	


echo "</div>";
}
echo "<div style='width:100%;height:400px;margin:0 auto;'></div>";
require("footer.php");
?>
