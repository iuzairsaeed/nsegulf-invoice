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

	if($_POST['day']==false OR $_POST['month'] == false OR $_POST['year']==false){
		$error[]= "You did not select date";
		
	}else{
$validdate= checkdate($_POST['month'], $_POST['day'], $_POST['year']);
if($validdate== TRUE){
	$concat = sprintf("%02d", $_POST['day'])."/".sprintf("%02d", $_POST['month'])."/".$_POST['year'];
	$concat2 = $_POST['year']."".sprintf("%02d", $_POST['month'])."".sprintf("%02d", $_POST['day']);
}else{
	$error[]= "The date you chose is not correct";
	
}
$concat3 = date("Ymd", strtotime("+30 days"));
if($concat2 <= $concat3){
	$error[]= "As mentioned before in the form you have to select a training date at least 30 days from today";
	
	
}
}
if(is_numeric($_POST['onpeople'])==false){
$error[]= "Select only numbers for number of people wanting to attend the training";

}

if(count($error) > 0){
	
foreach($error as $errors){

echo $errors;
echo "<br />";
}
echo "<input style='border:1px solid #ccc;background:#BA0000;color:#ccc;' type='button' value='Back' onclick='history.go(-1)' /><br />";
}else{
	$message = 'Dear Inam '.$_POST['name1'].' has requested following training:<br /><br />';
	$message .=' Training required for Model: '.$_POST['modelname'].'<br /><br />
	Training Date Requested for '.$concat.'<br /><br />
	Operational/Maintenance : '.$_POST['operat'].'<br /><br />
	On-site/Dubai ; '.$_POST['site'].'<br /><br />
	Number of People : '.$_POST['onpeople'].'<br /><br />';
	$message .=$_POST['name1'].'details are as follows<br />
	Email:		'.$_POST['email'].'<br />
	Phone:		'.$_POST['phone'].'<br />
	Organization: '.$_POST['organization'].'<br />
	Business:	'.$_POST['business'].'<br />
	Address:	'.$_POST['address'].'<br />';
	
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
		echo "<form method = POST action='trainingform.php'>";
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




		echo "<label  style='float:left;'>Model of Sony product</label>&nbsp;<input size=40 style='float:right;' type=text name=modelname maxlength=100> <br /><br />
		<label style='float:left;'> Type of training required</label><label style='float:left'>&emsp;&emsp;&emsp;&emsp; Operations: <input type=radio name=operat checked value='Operations'></label><label style='float:right;'> &emsp;&emsp; Maintenance: <input type=radio name=operat value='Maintenance'></label> <br /><br />
			<label style='float:left;'>Requested venue for training &emsp;&emsp;&nbsp;</label> <label style='float:left'>Customer's Location:&nbsp;<input type=radio checked name=site value='On-site'></label><label style='float:right'> &nbsp; &thinsp; Sony PSMEA,  Dubai: <input type=radio name=site value='Dubai'></label><br /><br />
			<label style='float:left;text-align:left;'>Prefered date for training <br />
(At least one month from today)&nbsp;&emsp;</label>";
			echo "<select style='float:left;' name=day><option value=''>Day</option>";
			for($i=1;$i<=31;$i++){
				echo "<option>$i</option>";
			}
			echo "</select>";
			echo "<select style='float:left;' name=month><option value=''>Month</option>";
			for($i=1;$i<=12;$i++){
				echo "<option>$i</option>";
			}
			echo "</select>";
			echo "<select style='float:left;' name=year><option value=''>Year</option>";
			$yearplus=date("Y", strtotime("+1 year"));
			for($i=date("Y");$i<=$yearplus;$i++){
				echo "<option>$i</option>";
			}
			echo "</select>
<br /><br /><br />
			<label style='float:left;text-align:left;'>Number of persons attending &emsp; &nbsp; &nbsp; <br /> the training </label> <input style='float:left;' type=text name=onpeople maxlength=5><br /><br /><br />
			
<input style='float:right;' type=submit name=submit value=Submit><br /><br /><br /><br /><br /><br /><br /><br /><br />";
			echo "</form>";
		echo "</div>";
		
	
		
	


echo "</div>";
}
echo "<div style='width:100%;height:400px;margin:0 auto;'></div>";
require("footer.php");
?>
