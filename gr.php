<?php
ob_start();
ini_set('memory_limit', '-1');
require("db_config.php");
require("db.php");

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
if($_POST['submit']){
	
	
////////////////////////////////////////////////////////////////////
// Extend the TCPDF class to create custom Header and Footer
// ---------------------------------------------------------
// define some HTML content with style

require_once(dirname(__FILE__).'/mpdf/mpdf.php');
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
<div style="width:100%;height:40px;margin:0 auto;text-align:center;"><h3>JOBS STATUS REPORT</h3></div>
<div style="width:100%;height:20px;margin:0 auto;text-align:center;"><h4>01/'.$_POST['smonth'].'/'.$_POST['sy']. ' to 01/'.$_POST['emonth'].'/'.$_POST['ey'].'</h4></div>

</htmlpageheader>
						 
<htmlpagefooter name="MyFooter1">
<table width="100%" style="vertical-align: bottom; font-family:sans;font-size: .7em;color: #555; text-align:center;border:1px solid #555;"><tr>
    <td width="99%">NSE Electronics LLC</td>
    <td width="1%" align="right" style=" font-style: italic;background:#555;color:#fff">{PAGENO}</td>
    
    </tr></table>
</htmlpagefooter>

<sethtmlpageheader name="MyHeader1" value="on" show-this-page="1" />

<sethtmlpagefooter name="MyFooter1" value="on" />';





$sel1="select * from companies where companyid='".$_POST['companyid']."';";
$sel1r=mysql_query($sel1);
$sel1f=mysql_fetch_assoc($sel1r);
 

$html .='
<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>
<div style="width:100%;float:left;padding-right:20px;">
<table style="text-align:left;float:left;"><tr><td style="width:150px;vertical-align:top;"><strong>Company Name:  </strong></td><td style="width:150px;">'.$sel1f['companyname'].'</td></tr><tr>
<td style="width:150px;vertical-align:top;"><strong>Branch:  </strong></td><td style="width:150px;">'.$sel1f['companybranch'].'</td></tr><tr>
<td style="width:150px;vertical-align:top;"><strong>Contact Person:  </strong></td><td style="width:150px;">'.$sel1f['contactperson'].'</td></tr><tr>
<td style="width:150px;vertical-align:top;"><strong>Mobile:  </strong></td><td style="width:150px;">'.$sel1f['mobile'].'</td></tr><tr>
<td style="width:150px;vertical-align:top;"><strong>Telephone:  </strong></td><td style="width:150px;">'.$sel1f['telephone'].'</td></tr><tr>
<td style="width:150px;vertical-align:top;"><strong>Fax:  </strong></td><td style="width:150px;">'.$sel1f['fax'].'</td></tr>
</table>
</div>


<div style="width:100%;margin:0 auto;float:left;height:30px"></div>
<div style="width:100%;margin:0 auto;float:left;">
<table style="width:100%;border-collapse:collapse;"><thead><tr>
<td style="font-size:14px;width:100px;border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;"><strong>Card #</strong></td>
<td style="font-size:14px;width:100px;border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;"><strong>Client Job #</strong></td>
<td style="font-size:14px;width:70px;border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;"><strong>Car #</strong></td>
<td style="font-size:14px;width:80px;border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000"><strong>Card Date</strong></td>
<td style="font-size:14px;width:80px;border-left:1px solid #000;border-top:1px solid #000;border-right:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000"><strong>Delivery Date</strong></td>
<td style="font-size:14px;width:250px;border-right:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000"><strong>Customer Complaint</strong></td>';
if($_POST['checker']=='checked'){
$html .='
<td style="font-size:14px;width:20px;border-right:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;text-align:center;"><strong>PAID</strong></td>
<td style="font-size:14px;width:150px;border-right:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;text-align:right;"><strong>Total Amount</strong></td>
</tr></thead>';
}else{
	$html .='</tr></thead>';
}
$s="select * from cards where companyid='".$_POST['companyid']."'
and carddate between '".$_POST['sy'].'-'.$_POST['smonth'].'-01'."' AND '".$_POST['ey'].'-'.$_POST['emonth'].'-01'."' ORDER BY carddate;";
$sr=mysql_query($s)or die(mysql_error());
$srow=mysql_num_rows($sr);

while($sf=mysql_fetch_assoc($sr)){
$tot="select sum(linetotal) as total from services where cardid='".$sf['ID']."';";
$totr=mysql_query($tot);
$totf=mysql_fetch_assoc($totr);

$s2="select * from delivery where cardid='".$sf['ID']."';";
$sr2=mysql_query($s2)or die(mysql_error());
$srow2=mysql_num_rows($sr2);
$sf2=mysql_fetch_assoc($sr2);
if($sf['cardstatus'] != 'paid'){
$cardstatus='N0';}else{
	$cardstatus='YES';
}


	$html .='<tr><td valign=top style="border-bottom:1px solid #777;font-size:12px;">'.$sf['cardnumber'].'</td>
	<td valign=top style="border-bottom:1px solid #777;font-size:12px;">'.$sf['clientjobnumber'].'</td>
	<td valign=top style="border-bottom:1px solid #777;font-size:12px;">'.$sf['carnum'].'</td>
	<td valign=top style="border-bottom:1px solid #777;font-size:12px;">'.datareformat($sf['carddate']).'</td>
	<td valign=top style="border-bottom:1px solid #777;font-size:12px;">'.datareformat($sf2['deldate']).'</td>
	<td valign=top style="border-bottom:1px solid #777;font-size:12px;">'.$sf['customercomplaint'].'</td>';
	if($_POST['checker']=='checked'){
		$html .='<td valign=top style="text-align:center;border-bottom:1px solid #777;font-size:12px;">'.$cardstatus.'</td>
		<td valign=top style="text-align:right;border-bottom:1px solid #777;font-size:12px;">'.$totf['total'].'</td>';
		}else{
		}
		$html .='</tr>';
}
if($_POST['checker']=='checked'){
$html .='<tr><td style="height:40px;"></td><td style="height:40px;"></td><td style="height:40px;"></td><td style="height:40px;"></td></tr>';
$tot2="select sum(totamount) as amounttotal from cards where companyid='".$_POST['companyid']."' and carddate between '".$_POST['sy'].'-'.$_POST['smonth'].'-01'."' AND '".$_POST['ey'].'-'.$_POST['emonth'].'-01'."';";
	$tot2r=mysql_query($tot2);
	$tot2f=mysql_fetch_assoc($tot2r);
$tot3="select sum(totamount) as amounttotal2 from cards where companyid='".$_POST['companyid']."' and carddate between '".$_POST['sy'].'-'.$_POST['smonth'].'-01'."' AND '".$_POST['ey'].'-'.$_POST['emonth'].'-01'."' and cardstatus='paid';";
	$tot3r=mysql_query($tot3);
	$tot3f=mysql_fetch_assoc($tot3r);
$amountleft=$tot2f['amounttotal']-$tot3f['amounttotal2'];	
$html .= '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td valign="top" style="border-bottom:1px solid #000;">Total(AED)<br />Paid<br />Due</td><td style="text-align:right;border-bottom:1px solid #000;">'.$tot2f['amounttotal'].' <br />'.$tot3f['amounttotal2'].' <br />'.$amountleft.'</td></tr>';
}else{
}
$html .='<tr><td style="height:100px;"></td><td style="height:40px;"></td><td style="height:40px;"></td><td style="height:40px;"></td></tr>
</table>
</div>
<div style="width:100%;margin:0 auto;float:left;height:50px"></div>
<div style="width:100%;margin:0 auto;float:left;">
<table style="width:50%;"><tr>
<td>Report Generated on:</td><td>'.date("d/m/Y").'</td></tr></table>
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

?>