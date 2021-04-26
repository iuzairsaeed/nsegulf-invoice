<?php
require(dirname(__FILE__)."/../session_validator.php");
include(dirname(__FILE__)."/../db_config.php");
require(dirname(__FILE__)."/../user_level.php"); //il livello dell'user Ã¨ $curr_user_level
include_once('adminCheck.php');


require_once(dirname(__FILE__).'/../mpdf/mpdf.php');


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
$mpdf=new mPDF('utf-8', 'A4-L');
$query_cd = "SELECT * FROM contatti WHERE ID='".$num_scheda."'"; 
$action_cd = mysql_query($query_cd)or die(mysql_error()); 
$number_cd = mysql_num_rows($action_cd);	

while ($number_cd > $cd) {
	$cust_addr = mysql_result($action_cd,$cd,"Indirizzo");
	$cust_city = mysql_result($action_cd,$cd,"Citta");
	$cust_naz = mysql_result($action_cd,$cd,"Nazione");
	
	$cd++;
}
$html = '
<htmlpageheader name="MyHeader1">
<div style="float:left;width:80%; text-align: left; font-weight: bold; font-size: 10pt;">
<img src="http://localhost/sdac/mpdf/logo.png width="200" height="64""></img></div>

<div style="margin-top:-10px; float:left;width:20%; text-align: right; font-size: 10pt;">
<strong>'.$name.' '.$surname.' <br /> '.$cust_addr.' <br /> '.$cust_city.' '.$cust_naz.'</strong></div>
</htmlpageheader>
						 
<htmlpagefooter name="MyFooter1">
<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 10pt; 
    color: #000000; font-weight: bold; font-style: italic;text-align:center;border:1px solid #000;"><tr>
    <td width="98%"> &emsp;&emsp;&emsp;&emsp;&emsp; This is an eletronically generated statement and does not require any signature or stamp
    <td width="10%" align="right" style=" font-style: italic;">{PAGENO}</td>
    
    </tr></table>
</htmlpagefooter>

<sethtmlpageheader name="MyHeader1" value="on" show-this-page="1" />

<sethtmlpagefooter name="MyFooter1" value="on" />';





//////////////////////////////////////////////////
// CODICE PRIMA PAGINA ///////////////////////////

$html .='
<p></p><p></p>
<div style="border-top: solid 2px #1f4a00; height: 1em;"></div>
<div style="margin:0 auto;text-align: center;background-color:#fff;width:100%;height:30px;color:#1f4a00; font-size: 1.2em;">
	<strong>Statement of Account</strong>
</div>
<div style="border-bottom: solid 2px #1f4a00; height: 1em;"></div>

<p></p><p></p><p></p><p></p><p></p>

<table border="0" cellpadding="3" style="margin: 0 auto; font-size: 1.2em; font-weight: bold; margin: auto; width: 70%;">
  <tr>
  	
    <td style="text-align: left;">Opening Balance '.$fp_from.'</td>
    <td style="text-align: right;">AED '.$segno_start_bal.' '.currency_format($start_bal).'</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align: left;">Credit</td>
    <td style="text-align: right;">AED '.currency_format($tot_credit).'</td>
  </tr>
  <tr>
    <td style="text-align: left;">Debt</td>
    <td style="text-align: right;">AED '.currency_format($tot_debt).'</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align: left;">Final Balance '.$fp_to.'</td>
    <td style="text-align: right;">AED '.currency_format($final_bal).'</td>
  </tr>
</table>
<pagebreak />
';

/////////////////////////////////////////////////////////////////



	
////////////////////////////////////////////////////////////////
// CASISTICA PER STAMPARE IL PDF /////////////////////////////// 
////////////////////////////////////////////////////////////////

$mpdf->WriteHTML($html);

$mpdf->Output();
?>