<?php
include_once('adminCheck.php');
if($_POST['submit']){
	require("db_config.php");
	require("db.php");
$s="select * from cards ORDER BY ID DESC limit 1";
$sr=mysql_query($s);
$sf=mysql_fetch_assoc($sr);
	
		$validd1=explode(" ", $_POST['cdate']);
$year1=$validd1[0];
$month1=$validd1[1];
$day1=$validd1[2];
$validdate1=checkdate($month1, $day1, $year1);
if($validdate1==true){
$cdate=$year1.$month1.$day1;

}else{
	echo "There was error in Date format";
}

$company=$_POST['companyold'];
	
$select="select * from cards where companyid='".$company."';";
$selectres=mysql_query($select);
$selectrow=mysql_num_rows($selectres);
$selectfetch=mysql_fetch_assoc($selectres);
if($selectrow==0){
$select2="select * from companies where companyid='".$company."';";
$select2res=mysql_query($select2);
$select2f=mysql_fetch_assoc($select2res);

	$number=1;
	
		$newcard = $select2f['companycode'].'/'.$sf['ID'].'/'.'00'.$number;
}else{
	
	$number = $selectrow + 1;


		$explode=explode("/", $selectfetch['cardnumber']);
		$newcard = $explode[0].'/'.$sf['ID'].'/'.'00'.$number;	
	
}		
		
	
		
		$i1="insert into cards (cardnumber, carddate, companyid, carnum, partnumber, modelnumber, serialnumber, customertype, 
		faultdetail)
		values('".addslashes($newcard)."', '".addslashes($cdate)."','".addslashes($company)."',
		'".addslashes($_POST['carnumber'])."','".addslashes($_POST['partnumber'])."',
		'".addslashes($_POST['modelnumber'])."','".addslashes($_POST['serialnumber'])."',
		'".addslashes($_POST['customertype'])."',
		'".addslashes($_POST['faultdetail'])."');";
		$i1res=mysql_query($i1)or die(mysql_error());
		$insert=mysql_insert_id();
		
$s1="select * from cards where ID='".$insert."';";
$s1r=mysql_query($s1);
$s1f=mysql_fetch_assoc($s1r);
		


require_once(dirname(__FILE__).'/mpdf/mpdf.php');


// funzione per le valute
function currency_format($amount) {
	$amount_ok = number_format($amount,2,',','.');
	return $amount_ok;
}

// funzione per la data
function dataformat ($data_grezza) {
	//elaboro da data
	$day_grezzo = substr($data_grezza,0,2);
	$day = (int) $day_grezzo;
	$month_grezzo = substr($data_grezza,3,2);
	$month = (int) $month_grezzo;
	$year_grezzo = substr($data_grezza,-4,4);
	$year = (int) $year_grezzo;
	// Controllo la variabile data
	if ($day<=31 && $month<=12) {
		if ($day<10) {$day_ok = "0".$day;}
		else {$day_ok = $day;}
		
		if ($month<10) {$month_ok = "0".$month;}
		else {$month_ok = $month;}
		$data_app = $year.$month_ok.$day_ok;
	}
	else {$data_app = "err";} 
		return $data_app;
}

// Funzione per cambiare il formato della data
	function datareformat ($data) {	
   	$aa=substr($data, 0, 4);
   	$mm=substr($data, 5, 2);
    $gg=substr($data, -2, 2);
    $datareformat= $gg."/".$mm."/".$aa;
	return $datareformat;
}
	
////////////////////////////////////////////////////////////////////
// Extend the TCPDF class to create custom Header and Footer
// ---------------------------------------------------------
// define some HTML content with style
$mpdf=new mPDF('utf-8', 'A4');



$html = '
<htmlpageheader name="MyHeader1">
<div style="float:left;width:70%; text-align: left; font-weight: bold; font-size: 10pt;">
<img src="'.$config_basedir.'/css/immagini/nselogobig.png" width="250" height="73"></img></div>
<div style="float:right:width:30%;text-align:right;font-weight:normal;font-size:10pt;">Tel:  +971 4 3935560 <br /> 
Fax:  +971 4 3935561 <br />P.O. Box:  8194. Dubai U.A.E.<br />
Email:  info@nsegulf.com <br />
Website:  www.nsegulf.com</div>
<div style="width:100%;height:20px;margin:0 auto;border-bottom:2px solid #000;"></div>
<div style="width:100%;height:20px;margin:0 auto;"></div>
<div style="width:100%;height:40px;margin:0 auto;text-align:center;"><h1>NSE JOB CARD</h1></div>
<div style="width:100%;height:40px;float:right;text-align:right;"><h4>Job Card #: '.$s1f['cardnumber'].'</h4></div>
</htmlpageheader>
						 
<htmlpagefooter name="MyFooter1">
<table width="100%" style="vertical-align: bottom; font-family:sans;font-size: .7em;color: #555; text-align:center;border:1px solid #555;"><tr>
    <td width="99%">NSE Electronics LLC - Card Number:'.$s1f['cardnumber'].'</td>
    <td width="1%" align="right" style=" font-style: italic;background:#555;color:#fff">{PAGENO}</td>
    
    </tr></table>
</htmlpagefooter>

<sethtmlpageheader name="MyHeader1" value="on" show-this-page="1" />

<sethtmlpagefooter name="MyFooter1" value="on" />';

$sel1="select * from companies where companyid='".$s1f['companyid']."';";
$sel1r=mysql_query($sel1);
$sel1f=mysql_fetch_assoc($sel1r);
 

$html .='
<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>
<div style="width:100%;margin:0 auto;float:left;">
<table style="width:100%;text-align:left;"><tr><td style="width:45%;"><strong>Company Name:  </strong></td><td>'.$sel1f['companyname'].'</td></tr><tr>
<td style="width:45%;"><strong>Branch:  </strong></td><td>'.$sel1f['companybranch'].'</td></tr><tr>
<td style="width:45%;"><strong>Contact Person:  </strong></td><td>'.$sel1f['contactperson'].'</td></tr><tr>
<td style="width:45%;"><strong>Mobile:  </strong></td><td>'.$sel1f['mobile'].'</td></tr><tr>
<td style="width:45%;"><strong>Telephone:  </strong></td><td>'.$sel1f['telephone'].'</td></tr><tr>
<td style="width:45%;"><strong>Fax:  </strong></td><td>'.$sel1f['fax'].'</td></tr>
</table>
</div>

<p></p><p></p>
<div style="width:100%;margin:0 auto;float:left;">
<table style="width:100%;">
<tr>
<td style="width:45%;"><strong>Car Number:  </strong></td><td>'.$_POST['carnumber'].'</td></tr><tr>
<td style="width:45%;"><strong>Part Number:  </strong></td><td>'.$_POST['partnumber'].'</td></tr><tr>
<td style="width:45%;"><strong>Model Number:  </strong></td><td>'.$_POST['modelnumber'].'</td></tr><tr>
<td style="width:45%;"><strong>Serial Number:  </strong></td><td>'.$_POST['serialnumber'].'</td></tr><tr>
<td style="width:45%;"><strong>Customer Type:  </strong></td><td>'.$_POST['customertype'].'</td></tr><tr>
<td style="width:45%;"><strong>Received By:  </strong></td><td>'.$_POST['receivedby'].'</td></tr>
</table>
</div>

<div style="width:100%;margin:0 auto;float:left;height:30px"></div>
<div style="width:100%;margin:0 auto;float:left;">
<table style="width:100%;"><tr><td style="width:45%;"><strong>Fault in Detail:  </strong></td><td>'.$_POST['faultdetail'].'</td></tr>
</table>
</div>';
	

	
////////////////////////////////////////////////////////////////
// CASISTICA PER STAMPARE IL PDF /////////////////////////////// 
////////////////////////////////////////////////////////////////

$mpdf->WriteHTML($html);

				//imposto il numero della ricevuta
				
				
				

//$mpdf->Output($savefile,'F');

//$mpdf->Output();
$mpdf->Output();
//$mpdf->Output($path.$month."-".$year.'.pdf','F');
		
				}
else{
	require("header.php");
	require("db_config.php");
	require("db.php");
	
	?>
	<script type=Text/Javascript src=scw.js></script>
    <div style="width:600px;height:500px;padding-top:20px;background:#ccc;margin:0 auto;">
	<form method=POST action=addcard.php>
	
	<table width="430" height="380" align="center" style="width:400;margin:0 auto;text-align:center;">
	<tr>
		

	<td width="189" style="padding-right:10px;">Date</td><td width="244"><input type=text name=cdate onMouseOver="scwShow(this,event);"></td></tr><tr>
	<td style="padding-right:10px;">Car Number</td><td><input type=text name=carnumber></td></tr><tr>
<?PHP $com="Select * from companies order by companybranch";
$comr=mysql_query($com)or die(mysql_error());
?><td style="padding-right:10px;">Company Name:  </td><td><select style="width:160px;"  name=companyold><option value="">Select if Existing</option>
<?PHP
while($comf=mysql_fetch_assoc($comr)){
		
	echo "<option value=".$comf['companyid'].">".$comf['companybranch']." &emsp; ".$comf['companycode']."</option>";
}
?>
</select></td></tr><tr>

	<td style="padding-right:10px;">Or Add New Company</td><td><a href='addcompany.php'/>New</a></td></tr><tr>
	<td style="padding-right:10px;">Part Number</td><td><input type=text name=partnumber></td></tr><tr>
	<td style="padding-right:10px;">Model Number</td><td><input type=text name=modelnumber></td></tr><tr>
	<td style="padding-right:10px;">Serial Number</td><td><input type=text name=serialnumber></td></tr><tr>
	<td style="padding-right:10px;">Customer Type</td><td><input type=text name=customertype></td></tr><tr>
	<td style="padding-right:10px;">Received by</td><td><input type=text name=receivedby></td></tr><tr>
	<td style="padding-right:10px;">Fault Detail</td><td><textarea cols=24 rows=7 name=faultdetail></textarea></td></tr><tr>
	<td style="padding-right:10px;">Enter New Card</td><td style="float:right;"><input type=submit name=submit value=submit></td></tr></table></form></div>
<?PHP
}
?>