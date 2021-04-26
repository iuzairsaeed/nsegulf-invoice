<?php
ob_start();
if (isset($_POST['submit'])){
	require("db_config.php");
	require("db.php");
	$c1="select * from cards where ID = '".addslashes($_POST['cardid'])."' and cardstatus='inv';";
	$c1res=mysql_query($c1)or die(mysql_error());
	$c1r=mysql_num_rows($c1res);
	if($c1r ==1){
$s1f=mysql_fetch_assoc($c1res);
if($_POST['cdate']==FALSE){
echo "You have to select date";
exit;
}
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
$invnum=$s1f['cardnumber'].'/I';
		$i1="insert into invoice (invoicenumber, card_id, invoice_date, totalamount) 
		values('".addslashes($invnum)."', '".addslashes($_POST['cardid'])."','".addslashes($cdate)."', '0.00');";
		$i1res=mysql_query($i1)or die(mysql_error());
			

		foreach($_POST['description'] as $key =>$value){
			$unitprice=$_POST['unitprice'][$key];
			$linetotal=$_POST['linetotal'][$key];
			$qty=$_POST['quantity'][$key];
			
			if($qty==false){}else{	
			$i2="insert into services (cardid, qty, description, unitprice, linetotal)
			values('".$_POST['cardid']."','".$qty."','".$value."','".$unitprice."',
			'".$linetotal."');";
			$i2res=mysql_query($i2)or die(mysql_error());
		$insert=mysql_insert_id();
		
		}
		}
		$sum="select sum(linetotal) as totalline from services where cardid='".$_POST['cardid']."';";
		$sumr=mysql_query($sum);
		$sumf=mysql_fetch_assoc($sumr);
		$i3="update cards set cardstatus='invdone', totamount='".$sumf['totalline']."' where ID='".$_POST['cardid']."';";
		$i3r=mysql_query($i3)or die(mysql_error());
		$i4="update invoice set totalamount='".$sumf['totalline']."' where card_id='".$_POST['cardid']."';";
		$i4r=mysql_query($i4);



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
<img src="css/immagini/nselogobig.png" width="250" height="73"></img></div>
<div style="float:right:width:30%;text-align:right;font-weight:normal;font-size:10pt;">Tel:  +971 4 3935560 <br /> 
Fax:  +971 4 3935561 <br />P.O. Box:  8194. Dubai U.A.E.<br />
Email:  info@nsegulf.com <br />
Website:  www.nsegulf.com</div>
<div style="width:100%;height:20px;margin:0 auto;border-bottom:2px solid #000;"></div>
<div style="width:100%;height:20px;margin:0 auto;"></div>
<div style="width:100%;height:40px;margin:0 auto;text-align:center;"><h1>TAX INVOICE</h1></div>
<div style="width:100%;height:20px;float:right;text-align:right;"><h4>Invoice Number #: '.$invnum.'</h4></br><h5>TRN#:100332687100003</h5></div>

<div style="width:100%;height:20px;float:right;text-align:right;"><h4>Invoice Date: '.datareformat($_POST['cdate']).'</h4></div>

</htmlpageheader>
						 
<htmlpagefooter name="MyFooter1">
<table width="100%" style="vertical-align: bottom; font-family:sans;font-size: .7em;color: #555; text-align:center;border:1px solid #555;"><tr>
    <td width="99%">NSE Electronics LLC - Invoice Number:'.$invnum.'</td>
	
    <td width="1%" align="right" style=" font-style: italic;background:#555;color:#fff">{PAGENO}</td>
    
    </tr></table>
</htmlpagefooter>

<sethtmlpageheader name="MyHeader1" value="on" show-this-page="1" />

<sethtmlpagefooter name="MyFooter1" value="on" />';

$sel1="select * from companies where companyid='".$s1f['companyid']."';";
$sel1r=mysql_query($sel1);
$sel1f=mysql_fetch_assoc($sel1r);
 

$html .='
<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>
<div style="width:54%;float:left;padding-right:20px;">
<table style="text-align:left;float:left;"><tr><td style="width:150px;vertical-align:top;"><strong>Company Name:  </strong></td><td style="width:150px;">'.$sel1f['companyname'].'</td></tr>
<tr>
<td style="width:150px;vertical-align:top;"><strong>TRN#:  </strong></td><td style="width:150px;vertical-align:top;"> 100072684200003</td></tr>
<tr>
<td style="width:150px;vertical-align:top;"><strong>Branch:  </strong></td><td style="width:150px;">'.$sel1f['companybranch'].'</td></tr><tr>
<td style="width:150px;vertical-align:top;"><strong>Contact Person:  </strong></td><td style="width:150px;">'.$s1f['contactperson'].'</td></tr><tr>
<td style="width:150px;vertical-align:top;"><strong>Mobile:  </strong></td><td style="width:150px;">'.$sel1f['mobile'].'</td></tr><tr>
<td style="width:150px;vertical-align:top;"><strong>Telephone:  </strong></td><td style="width:150px;">'.$sel1f['telephone'].'</td></tr><tr>
<td style="width:150px;vertical-align:top;"><strong>Fax:  </strong></td><td style="width:150px;">'.$sel1f['fax'].'</td></tr>
</table>
</div>


<div style="width:42%;float:left;">
<table style="float:right;">
<tr>
<td style="width:150px;vertical-align:top;"><strong>Order Number:  </strong></td><td style="width:150px;">'.$s1f['clientjobnumber'].'</td></tr><tr>
<td style="width:150px;vertical-align:top;"><strong>Car Number:  </strong></td><td style="width:150px;">'.$s1f['carnum'].'</td></tr><tr>
<td style="width:150px;vertical-align:top;"><strong>Part Number:  </strong></td><td style="width:150px;">'.$s1f['partnumber'].'</td></tr><tr>
<td style="width:150px;vertical-align:top;"><strong>Model Number:  </strong></td><td style="width:150px;">'.$s1f['modelnumber'].'</td></tr><tr>
<td style="width:150px;vertical-align:top;"><strong>Serial Number:  </strong></td><td style="width:150px;">'.$s1f['serialnumber'].'</td></tr><tr>
<td style="width:150px;vertical-align:top;"><strong>Customer Type:  </strong></td><td style="width:150px;">'.$s1f['customertype'].'</td></tr><tr>
<td style="width:150px;vertical-align:top;"><strong>Vender#:  </strong></td><td style="width:150px;vertical-align:top;"> 10040890</td></tr><tr>
</table>
</div>
<div style="width:100%;margin:0 auto;float:left;height:30px"></div>
<div style="width:100%;margin:0 auto;float:left;border:1px solid #555;">
<table style="width:100%;"><tr><td valign=top style="width:25%;"><strong>Customer Complaint:  </strong></td><td>'.$s1f['customercomplaint'].'</td></tr>
</table>
<table style="width:100%;"><tr><td valign=top style="width:25%;"><strong>Included Accessories:  </strong></td><td>'.$s1f['includedaccess'].'</td></tr>
</table>
<table style="width:100%;"><tr><td valign=top style="width:25%;"><strong>Other Remarks:  </strong></td><td>'.$s1f['otherremarks'].'</td></tr>
</table>
</div>
<div style="width:100%;margin:0 auto;float:left;height:30px"></div>
<div style="width:100%;margin:0 auto;float:left;">
<table style="width:100%;border-collapse:collapse;"><thead><tr>
<td style="width:50px;border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;"><strong>Qty</strong></td>
<td style="width:300px;border-top:1px solid #000;border-bottom:1px solid #000"><strong>Description</strong></td>
<td style="width:50px;border-top:1px solid #000;border-bottom:1px solid #000"><strong>Unit Price</strong></td>
<td style="width:150px;border-right:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;text-align:right;"><strong>Line Tool</strong></td></tr></thead>';
$tot="select sum(linetotal) as total from services where cardid='".$_POST['cardid']."';";
$totr=mysql_query($tot);
$totf=mysql_fetch_assoc($totr);
$del="select * from services where cardid='".$_POST['cardid']."';";
$delr=mysql_query($del)or die(mysql_error());
$delrow=mysql_num_rows($delr);
$newdelrow=$delrow+3;

while($delf=mysql_fetch_assoc($delr)){

	$html .='<tr><td valign=top>'.$delf['qty'].'</td><td>'.$delf['description'].'</td><td valign=top>'.$delf['unitprice'].'</td><td valign=top style="text-align:right;">'.$delf['linetotal'].'</td></tr>';
	
	

}
$html .='<tr><td style="height:40px;"></td><td style="height:40px;"></td><td style="height:40px;"></td><td style="height:40px;"></td></tr>';
$html .= '<tr><td></td><td></td><td style="border-bottom:1px solid #000;">Total(AED)</td><td style="text-align:right;border-bottom:1px solid #000;">'.$totf['total'].'</td></tr>

</table>
</div>
<div style="width:100%;margin:0 auto;float:left;height:50px"></div>
<div style="width:100%;margin:0 auto;float:left;">
<table style="width:100%;"><tr>
<td>Received by:</td><td></td><td>Delivered By:</td><td></td></tr>
<tr><td style="height:10px;"></td><td style="height:10px;"></td><td style="height:10px;"></td><td style="height:10px;"></td></tr>
<tr><td style="width:170px;">Name & Signature</td><td style="width:110px;"></td>

<td style="width:170px;">Name & Signature</td><td style="width:110px;"></td></tr></table>
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



		
	}else{
	$c1="select * from cards where ID = '".addslashes($_POST['cardid'])."' and cardstatus='invdone';";
	$c1res=mysql_query($c1)or die(mysql_error());
	$c1r=mysql_num_rows($c1res);
	
$s1f=mysql_fetch_assoc($c1res);
echo "This delivery already exists:-"; echo $s1f['cardnumber'].'/D';
	}
}else{
	echo "There was an error";
}
?>