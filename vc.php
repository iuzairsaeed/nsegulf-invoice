<?php

ob_start();
	require("db_config.php");
	require("db.php");
	$c1="select * from cards where ID = '".addslashes($_GET['cardid'])."';";
	$c1res=mysql_query($c1);
	$c1r=mysql_num_rows($c1res);
		
$s1="select * from cards where ID='".$_GET['cardid']."';";
$s1r=mysql_query($s1);
$s1f=mysql_fetch_assoc($s1r);
		


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
<div style="width:100%;height:40px;margin:0 auto;text-align:center;"><h1>NSE JOB CARD</h1></div>
<div style="width:100%;height:20px;float:right;text-align:right;"><h4>Job Card #: '.$s1f['cardnumber'].'<br />
Card Date: '.$s1f['carddate'].'<br />
Order #: '.$s1f['clientjobnumber'].'<br />
Vehicle Plate #: '.$s1f['carnum'].'</h4></div>
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
<p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p><p></p>
<div style="width:100%;margin:0 auto;float:left;">
<table style="width:100%;text-align:left;"><tr><td style="width:45%;"><strong>Company Name:  </strong></td><td>'.$sel1f['companyname'].'</td></tr><tr>
<td style="width:45%;"><strong>Branch:  </strong></td><td>'.$sel1f['companybranch'].'</td></tr><tr>
<td style="width:45%;"><strong>Contact Person:  </strong></td><td>'.$s1f['contactperson'].'</td></tr><tr>
<td style="width:45%;"><strong>Mobile:  </strong></td><td>'.$sel1f['mobile'].'</td></tr><tr>
<td style="width:45%;"><strong>Telephone:  </strong></td><td>'.$sel1f['telephone'].'</td></tr><tr>
<td style="width:45%;"><strong>Fax:  </strong></td><td>'.$sel1f['fax'].'</td></tr>
</table>
</div>

<p></p><p></p>
<div style="width:100%;margin:0 auto;float:left;">
<table style="width:100%;">
<tr>
<td style="width:45%;"><strong>Car Number:  </strong></td><td>'.$s1f['carnum'].'</td></tr><tr>
<td style="width:45%;"><strong>Part Number:  </strong></td><td>'.$s1f['partnumber'].'</td></tr><tr>
<td style="width:45%;"><strong>Model Number:  </strong></td><td>'.$s1f['modelnumber'].'</td></tr><tr>
<td style="width:45%;"><strong>Serial Number:  </strong></td><td>'.$s1f['serialnumber'].'</td></tr><tr>
<td style="width:45%;"><strong>Customer Type:  </strong></td><td>'.$s1f['customertype'].'</td></tr><tr>
<td style="width:45%;"><strong>Received By:  </strong></td><td>'.$s1f['receivedby'].'</td></tr>
</table>
</div>

<div style="width:100%;margin:0 auto;float:left;height:30px"></div>
<div style="width:100%;margin:0 auto;float:left;">
<table style="width:100%;"><tr><td valign="top" style="width:45%;"><strong>Customer Complaint:  </strong></td><td>'.$s1f['customercomplaint'].'</td></tr>
</table>
<table style="width:100%;"><tr><td valign="top" style="width:45%;"><strong>Included Accessories:  </strong></td><td>'.$s1f['includedaccess'].'</td></tr>
</table>
<table style="width:100%;"><tr><td valign="top" style="width:45%;"><strong>Other Remarks:  </strong></td><td>'.$s1f['otherremarks'].'</td></tr>
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

?>