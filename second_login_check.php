<?php
session_start();
session_regenerate_id(TRUE);
include("db_config_client.php");

	// Chiamo le variabili di login
	$user = addslashes($_POST['username']);
	
	$psw = addslashes($_POST['password']);
	$secure_psw= sha1(md5(base64_encode($psw)));
	$statement=$_POST['statement'];

$sel1=mysql_select_db($db_database)or die(mysql_error());
$sel1_db="select * from client_login inner join (contatti) on (client_login.client_id=contatti.ID) where client_login.username_cl='".$user."' and client_login.password_cl='".$secure_psw."';";
$sel1_res=mysql_query($sel1_db);
$sel1_row=mysql_num_rows($sel1_res);
$selfetch=mysql_fetch_assoc($sel1_res);
$num_scheda=$selfetch['client_id'];
$day = "01";
$month=date("m");
$year=date("y");	
	// Controllo se i dati di login sono nel database
		
	if ($sel1_row != 1) {
		//header("Location:clientstatement.php");
		echo "error";
	}else{
		$_SESSION['user2'] = $user;
		$_SESSION['password2'] = $secure_psw;
		$_SESSION['clientid'] = $num_scheda;
$_SESSION['clientname'] = $selfetch['Nome']." ".$selfetch['Cognome'];
				
		// ricavo l'indirizzo ip
		$ip = $_SERVER['REMOTE_ADDR'];
		
		
if (!is_dir('/home/sdacreal/public_html/sdac2/schede/statements/'.$num_scheda.'')) {
	chdir("/home/sdacreal/public_html/sdac2/schede/statements");
	opendir(".");
	mkdir("/home/sdacreal/public_html/sdac2/schede/statements/".$num_scheda."" ,0777);
}
$path = '/home/sdacreal/public_html/sdac2/schede/statements/'.$num_scheda.'/statement_';
				//imposto il numero della ricevuta
				

//if(file_exists($path.$month."-".$year.'.pdf')){
//$download=$path.$month."-".$year.'.pdf';
//header("Location:clientpage.php?clientid=".$selfetch['client_id']);
//header("Location:clientpage.php?clientid=".$selfetch['client_id']);
//}else{
					
					
//////////////pdf


require_once('/home/sdacreal/public_html/sdac2/mpdf/mpdf.php');


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
	
//recupero le variabili per creare l'estratto conto
$num_scheda = $selfetch['client_id']; // id_cliente
$name = $selfetch['Nome'];
$surname = $selfetch['Cognome'];
$statement_property = $_POST['statement']; //id della proprietÃƒ  oppure ALL oppure CUSTOMER
$from_data = $_POST['stat_data_from'];
$to_data = $_POST['stat_data_to'];


//////////////////////////////////////////////////////////////////////////////
// verifica utente e agente di sicurezza /////////////////////////////////////


// fine verifica di sicurezza ////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////



// query riepilogo 1pag in funzione della data
$query_data_start_bal = "AND data_voce ='".date("Y-m")."'";


// casistica per il debito e credito del riepilogo pag1
$query_data_debt_cred = "";

// casistica per il debito e credito iniziale della proprietÃƒ 
$query_data_prop_s = "AND data_voce ='".date("Y-m")."'";

// casistica per il debito e credito finale della proprietÃƒ 
$query_data_prop = "";


// ///////////// SCRIPT PER LA PRIMA PAGINA ////////////////////
/**********************AWC*************************/
$qry1=mysql_select_db($db_database)or die(mysql_error());
	$qry="SELECT data_voce AS start_date FROM customer_cont WHERE id_cliente=".$num_scheda."  AND voce_diretta_cliente='' ORDER BY data_voce ASC LIMIT 1";
	$myqry= mysql_query($qry);
	$row_qry= mysql_fetch_assoc($myqry);
	$from_data_xqry=$row_qry['start_date'];
	$from_data = datareformat($row_qry['start_date']);	
	


if ($to_data == "") $to_data= date('d/m/Y');

$debug=NULL;

/**********************END AWC*********************/	
	
// Calcolo il bilancio iniziale in funzione della data
//recupero il totale delle voci
/**********************AWC*************************/
//added  AND type_voce='credit'

/**********************END AWC*********************/	
// Calcolo il bilancio iniziale in funzione della data
//recupero il totale delle voci
$sel_ti = mysql_select_db($db_database)or die(mysql_error());
$sql_ti="SELECT SUM(amount_voce) AS tot_voci_in FROM customer_cont WHERE id_cliente='".$num_scheda."'  AND type_voce='credit' AND voce_diretta_cliente='' ".$query_data_start_bal."";
$query_ti = mysql_query($sql_ti) or die(mysql_error());
$row_ti = mysql_fetch_assoc($query_ti);
$tot_start = $row_ti['tot_voci_in'];
if ($debug) print '<br>: '.$sql_ti;

if ($debug) print '<br>tot_start '.$tot_start;

//recupero il debito
$sel_di = mysql_select_db($db_database)or die(mysql_error());
$sql_di="SELECT SUM(amount_voce) AS debt_voci_in FROM customer_cont WHERE id_cliente='".$num_scheda."' AND type_voce='debt' AND voce_diretta_cliente='' ".$query_data_start_bal."";
$query_di = mysql_query($sql_di) or die(mysql_error());
$row_di = mysql_fetch_assoc($query_di);
$debt_start = $row_di['debt_voci_in'];
if ($debug) print '<br>debt_start '.$debt_start;
// recupero i bank charges
$sel_bc = mysql_select_db($db_database)or die(mysql_error());
$sql_bc="SELECT SUM(bank_charges) AS bc_voci_in FROM customer_cont WHERE id_cliente='".$num_scheda."' AND voce_diretta_cliente='' ".$query_data_start_bal."";
$query_bc = mysql_query($sql_bc) or die(mysql_error());
$row_bc = mysql_fetch_assoc($query_bc);
$bc_start = $row_bc['bc_voci_in'];
if ($debug) print '<br>bc_start '.$bc_start;



if((float)$start_bal > 0) {$segno_start_bal= "+";}
else {$segno_start_bal= "";}


// Calcolo il debito in funzione della data selezionata
$sel_deb = mysql_select_db($db_database)or die(mysql_error());
$sql_deb="SELECT SUM(amount_voce) AS tot_debt FROM customer_cont WHERE id_cliente='".$num_scheda."' AND type_voce='debt' AND voce_diretta_cliente='' ".$query_data_debt_cred."";
$query_deb = mysql_query($sql_deb) or die(mysql_error());
$row_deb = mysql_fetch_assoc($query_deb);
$part_debt = $row_deb['tot_debt'];
if ($debug) print '<br>part_debt '.$part_debt;


// recupero il totale dei bank charges
$sel_tbc = mysql_select_db($db_database)or die(mysql_error());
$sql_tbc="SELECT SUM(bank_charges) AS tot_bc FROM customer_cont WHERE id_cliente='".$num_scheda."' AND voce_diretta_cliente='' ".$query_data_debt_cred."";
$query_tbc = mysql_query($sql_tbc) or die(mysql_error());
$row_tbc = mysql_fetch_assoc($query_tbc);
$tot_bc = $row_tbc['tot_bc'];
if ($debug) print '<br>tot_bc '.$tot_bc;
/******************AWC***********/	
$start_bal = (float)$tot_start - (float)$debt_start - (float)$bc_start;


$tot_debt = (float)$part_debt + (float)$tot_bc;

// Calcolo il credito in funzione della data selezionata (SENZA CONTEGGIARE LE VOCI DIRETTE AL CLIENTE)
$sel_cred = mysql_select_db($db_database)or die(mysql_error());
$sql_cred="SELECT SUM(amount_voce) AS tot_credit FROM customer_cont WHERE id_cliente='".$num_scheda."' AND type_voce='credit' AND voce_diretta_cliente='' ".$query_data_debt_cred."";
$query_cred = mysql_query($sql_cred) or die(mysql_error());
$row_cred = mysql_fetch_assoc($query_cred);
$tot_credit = $row_cred['tot_credit'];
if ($debug) print '<br>tot_credit '.$tot_credit;

//bilancio finale
$final_bal = (float)$start_bal + (float)$tot_credit - (float)$tot_debt;

if ($debug)
exit;

// casistica per la data della prima pagina
if($from_data == "" && $to_data == "") {$fp_from=""; $fp_to="";}
elseif($from_data != "" && $to_data == "") {$fp_from="at ".$from_data; $fp_to="";}
elseif($from_data == "" && $to_data != "") {$fp_from=""; $fp_to="at ".$to_data;}
elseif($from_data != "" && $to_data != "") {$fp_from="at ".$from_data; $fp_to="at ".$to_data;}

// recupero i dati del cliente
$cd = 0;
$sel_cd = mysql_select_db($db_database)or die(mysql_error());
						
$query_cd = "SELECT * FROM contatti WHERE ID='".$num_scheda."'"; 
$action_cd = mysql_query($query_cd)or die(mysql_error()); 
$number_cd = mysql_num_rows($action_cd);	
						 
while ($number_cd > $cd) {
	$cust_addr = mysql_result($action_cd,$cd,"Indirizzo");
	$cust_city = mysql_result($action_cd,$cd,"Citta");
	$cust_naz = mysql_result($action_cd,$cd,"Nazione");
	
	$cd++;
}

/*
if($from_data == "" && $to_data == "") {$header_data = "Historical";}
elseif($from_data != "" && $to_data == "") {$header_data = "From ".$from_data;}
elseif($from_data == "" && $to_data != "") {$header_data = "Until ".$to_data;}
elseif($from_data != "" && $to_data != "") {$header_data = $from_data." - ".$to_data;}
*/


////////////////////////////////////////////////////////////////////
// Extend the TCPDF class to create custom Header and Footer
// ---------------------------------------------------------
// define some HTML content with style
$mpdf=new mPDF('utf-8', 'A4');
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
<div style="float:left;width:70%; text-align: left; font-weight: bold; font-size: 10pt;">
<img src="https://www.sdacrealestate.com/sdac2/mpdf/logo.png width="200" height="64""></img></div>

<div style="margin-top:-10px; float:left;width:30%; text-align: right; font-family:sans;font-size: 10pt;">
<strong>'.$name.' '.$surname.' <br /> '.$cust_addr.' <br /> '.$cust_city.' '.$cust_naz.'</strong></div>
</htmlpageheader>
						 
<htmlpagefooter name="MyFooter1">
<table width="100%" style="vertical-align: bottom; font-family:sans;font-size: .7em;color: #555; text-align:center;border:1px solid #555;"><tr>
    <td width="99%"> Confirmation of the correctness of the statement as rendered will be assumed if no notice of disagreement with any of the entries is received by SDAC within 15 days of the date of statement
     <td width="1%" align="right" style=" font-style: italic;background:#555;color:#fff">{PAGENO}</td>
    
    </tr></table>
</htmlpagefooter>

<sethtmlpageheader name="MyHeader1" value="on" show-this-page="1" />

<sethtmlpagefooter name="MyFooter1" value="on" />';

//////////////////////////////////////////////////
// CODICE PRIMA PAGINA ///////////////////////////

$html .='
<p></p><p></p>';

$html .='<div style="border-top: solid 2px #555; height: 1em;"></div>
<div style="margin:0 auto;text-align: center;background-color:#fff;width:100%;height:30px;color:#555; font-family:sans;font-size: 1.2em;">
	<strong>Statement of Account</strong>
</div>
<div style="border-bottom: solid 2px #555; height: 1em;"></div>

<p></p><p></p><p></p><p></p><p></p>

<table border="0" cellpadding="1" style="margin: 0 auto; font-family:sans;font-size: 1.2em; font-weight: bold; color: #555; margin: auto; width: 100%;">
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
    <td style="text-align: right; color: #555">AED '.currency_format($tot_debt).'</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align: left;color: #555">Final Balance '.$fp_to.'</td>
    <td style="text-align: right;color: #555">AED '.currency_format($final_bal).'</td>
  </tr>
</table>
<pagebreak />
';

/////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////
// CODICE PAGINA CONTABILITA' ///////////////////////////
$html .='
<p></p><p></p>
<div style="border-top: solid 2px #555; height: 1em;"></div>
<div style="margin:0 auto;text-align:center; background-color:#fff;color:#555;width:100%;height:30px;font-family:sans;font-size: 1.2em;">
	<strong>Statement Details</strong>
</div>
<div style="border-bottom: solid 2px #555; height: 1em;"></div>

<p></p>

<table border="0" cellpadding="3" style="width: 100%; font-family:sans;color: #555;">
  <tr style="font-family:sans;font-size: 1.1em;">
    <td style="text-align: center; width: 125px;"><strong>Date</strong></td>
    <td style="text-align: left; width: 400px;"><strong>Description</strong></td>
    <td style="text-align: center; width: 140px;"><strong>Amount</strong></td>
    <td style="text-align: center; width: 140px;"><strong>Bank Charges</strong></td>
    <td style="text-align: center; width: 140px;"><strong>Balance</strong></td>
  </tr>
  <tr>
	<td style="text-align: center;">'.$from_data.'</td>
	<td style="text-align: left;">Starting Balance</td>
	<td style="text-align: center;"></td>
	<td style="text-align: center;"></td>
	<td style="text-align: center;">AED '.currency_format($start_bal).'</td>
   </tr>';
  
  $q= 0;
  $sel_av = mysql_select_db($db_database)or die(mysql_error());
									  
  $query_av = "SELECT * FROM customer_cont WHERE id_cliente = '".$num_scheda."' AND voce_diretta_cliente=''  ".$query_data_prop." ORDER BY data_voce"; 
  $action_av = mysql_query($query_av)or die(mysql_error()); 
  $number_av = mysql_num_rows($action_av);
  
  while ($q < $number_av) {
	  $all_cont_data = mysql_result($action_av,$q,"data_voce");
	  $all_cont_descr = mysql_result($action_av,$q,"descr_voce");
	  $all_cont_type = mysql_result($action_av,$q,"type_voce");
	  $all_cont_amount = mysql_result($action_av,$q,"amount_voce");
	  $all_cont_bank = mysql_result($action_av,$q,"bank_charges");
	  $all_cont_prop = mysql_result($action_av,$q,"id_prop");
	  
	  //recupero il nome della voce
	  $r= 0;
	  $sel_auv = mysql_select_db($db_database)or die(mysql_error());
											  
	  $query_auv = "SELECT * FROM customer_prop WHERE ID = '".$all_cont_prop."'"; 
	  $action_auv = mysql_query($query_auv)or die(mysql_error()); 
	  $number_auv = mysql_num_rows($action_auv);
			  
	  if ($all_cont_prop != "") {								 
		  while ($number_auv > $r) {
			  $avc_prop = mysql_result($action_auv,$r,"nome_bld");
			  $avc_unit = mysql_result($action_auv,$r,"unit");
					  
			  $all_cont_prop_det = $avc_prop.' - '.$avc_unit.' - ';
					  
			  $r++;
		  }
	  }	
	  else {$all_cont_prop_det ="";}
	  
	  if ($all_cont_type == "credit") {$segno_all_cont = "+";}
	  else {$segno_all_cont = "-";}
	  
	  // script per il partial balance
	  if($all_cont_type == "debt") {
			$start_bal = $start_bal - (float)$all_cont_amount - (float)$all_cont_bank;
	  }
	  else {
		  $start_bal = $start_bal + (float)$all_cont_amount - (float)$all_cont_bank;
	  }
	  
	  $html .='
		  <tr>
			<td style="text-align: center;">'.datareformat($all_cont_data).'</td>
			<td style="text-align: left;">'.$all_cont_prop_det.''.$all_cont_descr.'</td>
			<td style="text-align: center;">AED '.$segno_all_cont.' '.currency_format($all_cont_amount).'</td>
			<td style="text-align: center;">AED '.currency_format($all_cont_bank).'</td>
			<td style="text-align: center;">AED '.currency_format($start_bal).'</td>
		   </tr>';	

	  
	  $q++;
  }	
  
$html .='</table>

<table border="0" cellpadding="3" style="width: 100%;font-family:sans;">
  <tr>
    <td colspan="3" style="width: 665px;">&nbsp;</td>
    <td style="text-align: center; width: 140px;">&nbsp;</td>
    <td style="text-align: center; width: 140px;">&nbsp;</td>
  </tr>
  <tr style="font-family:sans;font-size: 1.1em;">
  	<td style="text-align: center; width: 125px;"><strong>'.$to_data.'</strong></td>
    <td style="text-align: left; width: 400px;"></td>
    <td style="text-align: center; width: 140px;"></td>
    <td style="text-align: center; width: 140px;color: #555;"><strong>Final Balance:</strong></td>
    <td style="text-align: center; width: 140px;color: #555;"><strong> AED '.currency_format($start_bal).'</strong></td>
  </tr>
</table>';

/////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////
// CODICE PAGINA PROPRIETA' ////////////////////////////
////////////////////////////////////////////////////////
// SE E' ALL ///////////////////////////////////////////

	// ricavo tutte le proprietÃƒ  del cliente che possono essere usate per gli statement
	$a = 0;
	$sel_prop = mysql_select_db($db_database)or die(mysql_error());
	
	$query_prop = "SELECT * FROM customer_prop WHERE customer_prop.num_scheda='".$num_scheda."' ORDER BY data_stipulaz"; 
	$action_prop = mysql_query($query_prop)or die(mysql_error()); 
	$number_prop = mysql_num_rows($action_prop);	
							 
	while ($number_prop > $a) {
		$numscheda=mysql_result($action_prop,$a,"num_scheda");
		$id_prop = mysql_result($action_prop,$a,"ID");
		$prop_name = mysql_result($action_prop,$a,"nome_bld");
		$prop_unit = mysql_result($action_prop,$a,"unit");
		$prop_date = mysql_result($action_prop,$a,"data_stipulaz");
		$prop_status = mysql_result($action_prop,$a,"status");
	

$ccc=0;
$sel_ccc=mysql_select_db($db_database)or die(mysql_error());
$query_ccc="select * from prop_insurance where id_prop='".$id_prop."'";
$action_ccc=mysql_query($query_ccc)or die(mysql_error());
$query_row=mysql_num_rows($action_ccc);

while($query_row > $ccc){
	
		$ins_start=mysql_result($action_ccc,$ccc,"ins_start");
		$ins_end=mysql_result($action_ccc,$ccc,"ins_end");
		$ins_amount=mysql_result($action_ccc,$ccc,"ins_amount");
		$ins_status=mysql_result($action_ccc,$ccc,"status");

		if($ins_status=='archive'){
			$ins_end="<strong style='color:#ba0000'> Expired </strong>" . $ins_end;
		}
		
		

$ccc++;
}
		
		// creo una pagina per ogni proprietÃƒ 
		$html .= '<div style="page-break-before:always;"></div>';
		
		//recupero i dettagli di acquisto
		$f = 0;
		$sel_bd = mysql_select_db($db_database)or die(mysql_error());
								
		$query_bd = "SELECT * FROM customer_prop WHERE ID='".$id_prop."'"; 
		$action_bd = mysql_query($query_bd)or die(mysql_error()); 
		$number_bd = mysql_num_rows($action_bd);	
								 
		while ($number_bd > $f) {
			$buy_price = mysql_result($action_bd,$f,"prezzo");
			$buy_tax = mysql_result($action_bd,$f,"tasse_spese");
			$f++;
		}
		
		//recupero i dettagli del rent
		$re = 0;
		$sel_re = mysql_select_db($db_database)or die(mysql_error());
								
		$query_re = "SELECT * FROM rent_agr_details WHERE id_prop='".$id_prop."';"; 
		$action_re = mysql_query($query_re)or die(mysql_error()); 
		$number_re = mysql_num_rows($action_re);	
								 
		while ($number_re > $re) {
			$rent_amount = mysql_result($action_re,$re,"amount_canone");
			$rent_start = mysql_result($action_re,$re,"inizio_rent");
			$rent_end = mysql_result($action_re,$re,"fine_rent");
			$agr_break = mysql_result($action_re,$re,"agr_break");
			$agr_break_amount = mysql_result($action_re,$re,"agr_break_amount");
			$agr_break_paid = mysql_result($action_re,$re,"agr_break_paid");
			$agr_break_date = mysql_result($action_re,$re,"agr_break_date");
			$status1 = mysql_result($action_re,$re,"status");
			$re++;
		}
		
		//recupero la somma versata per il security deposit
		$e = 0;
		$sel_sec_dep = mysql_select_db($db_database)or die(mysql_error());
									
		$query_sec_dep = "SELECT * FROM rent_deposit WHERE id_prop='".$id_prop."' AND status='active'"; 
		$action_sec_dep = mysql_query($query_sec_dep)or die(mysql_error()); 
		$number_sec_dep = mysql_num_rows($action_sec_dep);	
									 
		// stampo solo se ÃƒÂ¨ attivo
if($number_sec_dep > 0) {	
			while ($number_sec_dep > $e) { // VOCE DA RIPETERE
				$dep_amount = mysql_result($action_sec_dep,$e,"deposit_amount");
				
				$rsd_label='
				
				<td style="width:12%;background-color:#fff;color:#555;height:2px;text-align:left;">Ref. Sec. Dep :</td>
				<td style="width:18%;background-color:#fff;color:#555;height:2px;text-align:right;">AED '.currency_format($dep_amount).'</td></tr>';
				
			
				$e++;	
			}
		}
		else { 
		$rsd_label='
				<td style="width:12%;background-color:#fff;color:#555;height:2px;text-align:left;"></td>
				<td style="width:18%;background-color:#fff;color:#555;height:2px;text-align:right;"></td>
					
				
				
				</tr>'; }
		
		// CORPO DELLA PAGINA ////////////////////////////////////



//		<table border="0" style="width:100%;float:right;">
//		<tr>
//		<td style="width:70%;"></td>
//		<td><STRONG>INSURANCE DETAIL</STRONG></TD><TD></TD>
//		</tr>
//		<tr>
//		<td style="width:70%;"></td>
//		<td style="width:15%;">Start Date</TD><TD style="width:15%;float:right">'.$ins_start.'</TD>
//		</tr>
//		<tr>
//		<td style="width:70%;"></td>
//		<td style="width:15%;">Start Date</TD><TD style="width:15%;float:right">'.$ins_end.'</TD>
//		</tr>
//		<tr>
//		<td style="width:70%;"></td>
//		<td style="width:15%;">Insurance Amount</TD><TD style="width:15%;float:right">'.$ins_amount.'</TD>
//		</tr>
//		</table>


		$html .='
<p></p>
			<div style="border-top: solid 2px #555; height: 1em;"></div>
			<div style=":margin: 0 auto;text-align: center; background-color:#fff;color:#555;width:100%;height:30px;font-family:sans;font-size: 1.2em;">
				<strong>Property Incomes and Costs - '.$prop_name.' - Unit '.$prop_unit.'</strong>
			</div>
			<div style="border-bottom: solid 2px #555; height: 1em;"></div>';
$html .='
<table border="0" cellpadding="3" style="width:100%;height:10px;font-family:sans;">
<tr>
<td style="width:30%;background-color:#fff;color:#fff;height:10px;text-align:center;"></td>
<td style="width:5%;background-color:#fff;height:10px;"></td>
<td style="width:30%;background-color:#fff;color:#fff;height:10px;text-align:center;"></td>
<td style="width:5%;background-color:#fff;height:10px"></td>
<td style="width:30%;background-color:#fff;color:#fff;height:10px;text-align:center;"></td>

</tr>
</table>


<table border="0" cellpadding="3" style="width: 100%; color: #555;font-family:sans;">
<tr>
<td style="width:33%;background-color:#555;color:#fff;height:20px;text-align:center;">PURCHASE DETAIL</td>
<td style="width:2%;background-color:#fff;height:20px;"></td>
<td style="width:30%;background-color:#555;color:#fff;height:20px;text-align:center;">INSURANCE DETAIL</td>
<td style="width:2%;background-color:#fff;height:20px;"></td>
<td style="width:33%;background-color:#555;color:#fff;height:20px;text-align:center;">INCOME DETAIL</td>
</tr>
</table>
			
<table border="0" cellpadding="3" style="width:100%;height:10px; color: #555;font-family:sans;">
<tr>
<td style="width:33%;background-color:#fff;color:#fff;height:2px;text-align:center;border-bottom:1px solid #164c7e"></td>
<td style="width:2%;background-color:#fff;height:2px;"></td>
<td style="width:30%;background-color:#fff;color:#fff;height:2px;text-align:center;border-bottom:1px solid #164c7e"></td>
<td style="width:2%;background-color:#fff;height:2px"></td>
<td style="width:33%;background-color:#fff;color:#fff;height:2px;text-align:center;border-bottom:1px solid #164c7e"></td>

</tr>
</table>

			<table border="0" cellpadding="3" style="width: 100%; color: #555;font-family:sans;font-size:10px;">
			  <tr>
				
				
				<td style="width:15%;background-color:#fff;color:#555;height:2px;text-align:left;">Purchase Date:</td>
				<td style="width:15%;background-color:#fff;color:#555;height:2px;text-align:right;">'.datareformat($prop_date).'</td>
				<td style="width:5%;background-color:#fff;height:2px;"></td>
				
				<td style="width:15%;background-color:#fff;color:#555;height:2px;text-align:left;">Start Date:</td>';
				if($query_row==false){
				$html .= '
				<td style="width:15%;background-color:#fff;color:#555;height:2px;text-align:right;">--</td>';
				}else{
				$html .= '<td style="width:15%;background-color:#fff;color:#555;height:2px;text-align:right;">'.datareformat($ins_start).'</td>';
				}
				$html .= '<td style="width:5%;background-color:#fff;height:2px;"></td>';
				if($number_re > 0 && $status1==FALSE  && $agr_break=="NO") {
				$html .='		
				
				<td style="width:12%;background-color:#fff;color:#555;height:2px;text-align:left;">Rental Income:</td>
				<td style="width:18%;background-color:#fff;color:#555;height:2px;text-align:right;">AED '.currency_format($rent_amount).'</td></tr>';
				}elseif($number_re > 0 && $status1=="archive"  && $agr_break=="YES") {
				
				$summary = 0;
				$sum_data = mysql_select_db($db_database)or die(mysql_error());
								
				$sum_re = "SELECT sum(amount_pagamento) as totalamount FROM pagamenti_rent WHERE id_prop='".$id_prop."';"; 
				$sumaction_re = mysql_query($sum_re)or die(mysql_error()); 
				$sumnumber_re = mysql_num_rows($sumaction_re);	
								 
				
				$finalamount2 = mysql_result($sumaction_re,$summary,"totalamount");
				
				$finalamount=$finalamount2-$agr_break_amount;
					
				$html .= '<td style="width:12%;background-color:#fff;color:#555;height:2px;text-align:left;">Rental Income:</td>
				<td style="width:18%;background-color:#fff;color:#555;height:2px;text-align:right;">'.$finalamount.'</td></tr>';
				
				}else{
				$html .= '<td style="width:12%;background-color:#fff;color:#555;height:2px;text-align:left;">Rental Income:</td>
				<td style="width:18%;background-color:#fff;color:#555;height:2px;text-align:right;">//</td></tr>';
				}
				$html.='
				<tr>
				<td style="width:15%;background-color:#fff;color:#555;height:2px;text-align:left;">Purchase Price:</td>
				<td style="width:15%;background-color:#fff;color:#555;height:2px;text-align:right;">AED '.currency_format($buy_price).'</td>
				<td style="width:5%;background-color:#fff;height:2px;"></td>
				
				<td style="width:15%;background-color:#fff;color:#555;height:2px;text-align:left;">End Date:</td>';
				if($query_row==false){
				$html .= '<td style="width:15%;background-color:#fff;color:#555;height:2px;text-align:right;">--</td>';
				}else{
				$html .='<td style="width:15%;background-color:#fff;color:#555;height:2px;text-align:right;">'.datareformat($ins_end).'</td>';
				}
				$html .= '<td style="width:5%;background-color:#fff;height:2px;"></td>';
				if($number_re > 0 && $status1==FALSE  && $agr_break=="NO") {
				$html .='		
				
				<td style="width:12%;background-color:#fff;color:#555;height:2px;text-align:left;">Rental Period :</td>
				<td style="width:18%;background-color:#fff;color:#555;height:2px;text-align:right;">'.datareformat($rent_start).' - '.datareformat($rent_end).'</td></tr>';
				}elseif ($number_re > 0 && $status1=="archive"  && $agr_break=="YES") {
				$html .='<td style="width:12%;background-color:#fff;color:#555;height:2px;text-align:left;">Rental Period :</td>
				<td style="width:18%;background-color:#fff;color:#555;height:2px;text-align:right;">'.datareformat($rent_start).' - <strong style="color:#ba0000">'.datareformat($agr_break_date).'</strong></td></tr>';
					}else{
				$html .= '<td style="width:12%;background-color:#fff;color:#555;height:2px;text-align:left;">Rental Period:</td>
				<td style="width:18%;background-color:#fff;color:#555;height:2px;text-align:right;">//</td></tr>';
				}
				
				$html.='
				<tr>
				<td style="width:15%;background-color:#fff;color:#555;height:2px;text-align:left;">Taxes & Charges :</td>
				<td style="width:15%;background-color:#fff;color:#555;height:2px;text-align:right;">AED '.currency_format($buy_tax).'</td>
				<td style="width:5%;background-color:#fff;height:2px;"></td>
				
				<td style="width:15%;background-color:#fff;color:#555;height:2px;text-align:left;">Insurance Amount:</td>';
				if($query_row == false){
				$html .='<td style="width:15%;background-color:#fff;color:#555;height:2px;text-align:right;">--</td>';
				}else{
				$html .= '<td style="width:15%;background-color:#fff;color:#555;height:2px;text-align:right;">'.$ins_amount.'</td>';
				}
				$html .= '<td style="width:5%;background-color:#fff;height:2px;"></td>';
				$html .=''.$rsd_label.'';
				$html .='
				<tr>
				<td style="width:15%;background-color:#fff;color:#555;height:2px;text-align:left;">Status :</td>
				<td style="width:15%;background-color:#fff;color:#555;height:2px;text-align:right;">'.$prop_status.'</td>
				<td style="width:5%;background-color:#fff;height:2px;"></td>
				<td style="width:15%;background-color:#fff;color:#555;height:2px;text-align:left;"></td>
				<td style="width:15%;background-color:#fff;color:#555;height:2px;text-align:right;"></td>
				<td style="width:5%;background-color:#fff;height:2px;"></td>
				<td style="width:12%;background-color:#fff;color:#555;height:2px;text-align:left;"></td>
				<td style="width:18%;background-color:#fff;color:#555;height:2px;text-align:right;"></td>
				</tr>
				
				
			</table>
			
		
		<p></p>
		<p></p>
			
			<table border="0" cellpadding="3" style="color: #555;font-family:sans;">
			<thead>
			  <tr style="font-family:sans;font-size: 1.1em;">
				<td style="width: 400px; border-bottom: solid 1px black; color: #555;"><strong>Property Accounting</strong></td>
				<td style="width: 180px; text-align: center; border-bottom: solid 1px black; color: #555;"><strong>Credit (AED)</strong></td>
				<td style="width: 180px; text-align: center; border-bottom: solid 1px black; color: #555;"><strong>Debit (AED)</strong></td>
				<td style="width: 200px; text-align: center;"></td>
			  </tr>
			  </thead>';
			  
			  // ricavo tutte le voci contabili della proprietÃƒ 
			  $b = 0;
			  $sel_prop_con = mysql_select_db($db_database)or die(mysql_error());
									  
			  $query_prop_con = "SELECT * FROM customer_cont WHERE id_prop='".$id_prop."' ".$query_data_prop." ORDER BY data_voce"; 
			  $action_prop_con = mysql_query($query_prop_con)or die(mysql_error()); 
			  $number_prop_con = mysql_num_rows($action_prop_con);	
									   
			  while ($number_prop_con > $b) { // VOCE DA RIPETERE
				  $type_voce = mysql_result($action_prop_con,$b,"type_voce");
				  $classe_voce = mysql_result($action_prop_con,$b,"classe_voce");
				  $descr_voce = mysql_result($action_prop_con,$b,"descr_voce");
				  $data_voce = mysql_result($action_prop_con,$b,"data_voce");
				  $amount_voce = mysql_result($action_prop_con,$b,"amount_voce");
				  $cont_corr = mysql_result($action_prop_con,$b,"customer_cont_corr");
				  
				  //se c'ÃƒÂ¨ il conto corrente ne ricavo il nome della banca
				  if ($cont_corr != "") {
					  $d = 0;
					  $sel_bank = mysql_select_db($db_database)or die(mysql_error());
					  $query_bank = "SELECT * FROM customer_bank WHERE id_cliente='".$num_scheda."' AND cont_corr='".$cont_corr."'"; 
					  $action_bank = mysql_query($query_bank)or die(mysql_error()); 
					  $number_bank = mysql_num_rows($action_bank);	
											   
					  while ($number_bank > $d) { // VOCE DA RIPETERE
						  $bank_name = mysql_result($action_bank,$d,"nome_banca");
						  $bank_det = '<div style="font-family:sans;font-size: 0.6em; display: inline;">('.$bank_name.' - '.$cont_corr.')</div>';
						  $d++;
					  }
				  }
				  else {$bank_det = "";}
				  
				  
				  // stampo solo classe standard, spese accessorie e maintenance fees
				  if(((($classe_voce=="standard" OR $class_voce="mc_old") && ($descr_voce=="Rental Income" OR $descr_voce=="Credit Generated to balance maintenance paid direct by client"))) AND $type_voce == "credit"){ 
						  $html .='
							<tr>
							  <td>'.datareformat($data_voce).' - '.($descr_voce).' '.$bank_det.'</td>
							  <td style="text-align:center; border-right: solid 1px black;">'.currency_format($amount_voce).'</td>
							  <td style="text-align:center;">-</td>
							  <td style="text-align:center;"></td>
							</tr>';
					  }

					  
					  elseif(($classe_voce=="maintenance_fee" OR $classe_voce=="maintenance_cont") && ($type_voce == "debt")) {
						
						  
						
							  $html .='
								<tr>
								  <td>'.datareformat($data_voce).' - '.$descr_voce.'</td>
								  <td style="text-align:center; border-right: solid 1px black;">-</td>
								  <td style="text-align:center;">'.currency_format($amount_voce).'</td>
								  <td style="text-align:center;"></td>
								</tr>';
						  
					  
				  }
				  else {$html .='';} // se non ÃƒÂ¨ standard o maintenance nn lo stampo
				  
				  $b++;
			  }
			    
			    
		// SCRIPT PER IL CALCOLO DEL BALANCE FINALE	DELLA PROPRIETA	
		// ricavo il totale delle voci standard
		$sel_srd = mysql_select_db($db_database)or die(mysql_error());
		$query_srd = mysql_query("SELECT SUM(amount_voce) AS prop_srd_debt FROM customer_cont WHERE id_prop='".$id_prop."' AND type_voce='debt' AND classe_voce LIKE '%maintenance_%' ".$query_data_prop."") or die(mysql_error());
		$row_srd = mysql_fetch_assoc($query_srd);
		$prop_srd_debt = $row_srd['prop_srd_debt'];
		
		// ricavo il totale delle spese accessorie
//		$sel_psa = mysql_select_db($db_database)or die(mysql_error());
//		$query_psa = mysql_query("SELECT SUM(amount_voce) AS prop_psa_debt FROM customer_cont WHERE id_prop='".$id_prop."' AND type_voce='debt' AND classe_voce='spese_accessorie' ".$query_data_prop."") or die(mysql_error());
//		$row_psa = mysql_fetch_assoc($query_psa);
//		$prop_psa_debt = $row_psa['prop_psa_debt']; 
		
		// ricavo il totale delle maintenance fees
		$sel_mnf = mysql_select_db($db_database)or die(mysql_error());
		$query_mnf = mysql_query("SELECT SUM(amount_voce) AS prop_mnf_debt FROM customer_cont WHERE id_prop='".$id_prop."' AND type_voce='debt' AND classe_voce='maintenance_fee' ".$query_data_prop."") or die(mysql_error());
		$row_mnf = mysql_fetch_assoc($query_mnf);
		$prop_mnf_debt = $row_mnf['prop_mnf_debt'];



		// ricavo il totale delle rental income
		$sel_mnf2 = mysql_select_db($db_database)or die(mysql_error());
		$query_mnf2 = mysql_query("SELECT SUM(amount_voce) AS prop_mnf_debt FROM customer_cont WHERE id_prop='".$id_prop."' AND type_voce='credit' AND descr_voce='Rental Income' ".$query_data_prop."") or die(mysql_error());
		$row_mnf2 = mysql_fetch_assoc($query_mnf);
		$prop_mnf_debt2 = $row_mnf2['prop_mnf_debt'];

		
		// ricavo il totale del credito della proprietÃƒ 
		$sel_pc = mysql_select_db($db_database)or die(mysql_error());
		$query_pc = mysql_query("SELECT SUM(amount_voce) AS prop_tot_credit FROM customer_cont WHERE id_prop='".$id_prop."' AND type_voce='credit' AND classe_voce='standard' and descr_voce='Rental Income' ".$query_data_prop."") or die(mysql_error());
		$row_pc = mysql_fetch_assoc($query_pc);
		$prop_tot_credit = $row_pc['prop_tot_credit'];


		$sel_main = mysql_select_db($db_database)or die(mysql_error());
		$query_main = mysql_query("SELECT SUM(amount_voce) AS prop_main_credit FROM customer_cont WHERE id_prop='".$id_prop."' AND type_voce='credit' AND classe_voce='mc_old' AND descr_voce='Credit Generated to balance maintenance paid direct by client' ".$query_data_prop."") or die(mysql_error());
		$row_main = mysql_fetch_assoc($query_main);
		$prop_main_credit = $row_main['prop_main_credit'];

		
			// ricavo il totale del credito della proprietÃƒ 
		$sel_pc2 = mysql_select_db($db_database)or die(mysql_error());
		$query_pc2 = mysql_query("SELECT SUM(amount_voce) AS prop_tot_credit FROM customer_cont WHERE id_prop='".$id_prop."' AND type_voce='credit' AND classe_voce='standard' and descr_voce='Rental Income' ".$query_data_prop."") or die(mysql_error());
		$row_pc2 = mysql_fetch_assoc($query_pc2);
		$prop_tot_credit2 = $row_pc['prop_tot_credit'];
		
		
		// sottraggo il PO BOx rental 
//		$sel_pbd = mysql_select_db($db_database)or die(mysql_error());
//		$query_pbd = mysql_query("SELECT SUM(amount_voce) AS prop_tot_pob FROM customer_cont WHERE id_prop='".$id_prop."' AND descr_voce='P.O. Box Rental' ".$query_data_prop."") or die(mysql_error());
//		$row_pbd = mysql_fetch_assoc($query_pbd);
//		$prop_po_box = $row_pbd['prop_tot_pob'];
		
$prop_cred_final= (float)$prop_tot_credit + (float)$prop_main_credit;
		$prop_final_debt = -(float)$prop_srd_debt;
		
//		$prop_bal = (float)$prop_tot_credit + (float)$prop_mnf_debt2 + (float)$prop_final_debt;		
		$prop_bal = (float)$prop_cred_final + $prop_final_debt;						
		$html .='</table>
		
		<table border="0" cellpadding="3" style="color: #555;font-family:sans;">
		  <tr style="font-family:sans;font-size: 1.1em;">
			<td style="width: 400px; text-align: right;"></td>
			<td style="width: 180px; text-align: center;"></td>
			<td style="width: 180px; text-align: center;"></td>
			<td style="width: 200px; text-align: center; font-family:sans;font-size: 1.2em;"></td>
		  </tr>
		  <tr style="font-family:sans;font-size: 1.1em;">
			<td style="width: 400px; text-align: right; font-size: 1.1em;"><strong style="color:#fff"><br /></strong>Subtotal</td>
			<td style="width: 180px; text-align: center; font-size: 1.1em;"><strong style="color:#fff"><br /></strong>'.currency_format($prop_cred_final).'</td>
			<td style="width: 180px; text-align: center; font-size: 1.1em;"><strong style="color:#fff"><br /></strong>'.currency_format($prop_final_debt).'</td>
			<td style="width: 200px; text-align: center; font-size: 1.1em;"><strong>Total AED <BR /> '.currency_format($prop_bal).'</strong></td>
		  </tr>
		</table>';
		
		
		
		$a++;
	}


// SE E' DI UNA SINGOLA PROPRIETA'
 // fine if is NOT ALL

/////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////
// CODICE ULTIMA PAGINA ///////////////////////////
$html .='
<pagebreak />
<p></p><p></p>
<div style="border-top: solid 2px #555; height: 1em;"></div>
<div style="margin: 0 auto;text-align: center;background-color:#fff;width:100%;height:30px;color:#555; font-family:sans;font-size: 1.2em;">
	<strong>Future Rental Incomes</strong>
</div>
<div style="border-bottom: solid 2px #555; height: 1em;"></div>

<br/>

<table border="o" cellpadding="3" style="font-family:sans;">
  <tr>
  	<td style="width: 10px;">&nbsp;</td>
    <td style="width: 30px; border-bottom: dotted 1px #555;">&nbsp;</td>
	<td style="text-align: center; width: 140px; border-bottom: dotted 1px #555;"><strong>Date</strong></td>
    <td style="width: 300px; border-bottom: dotted 1px #555;"><strong>Property</strong></td>
    <td style="width: 80px; border-bottom: dotted 1px #555;">&nbsp;</td>
    <td style="text-align: center; width: 160px; border-bottom: dotted 1px #555;"><strong>Amount</strong></td>
  </tr>';
  
// casistica a seconda dello statement scelto

  //recupero le entrate di tutte le unitÃƒ 
  $b = 0;
  $sel_next = mysql_select_db($db_database)or die(mysql_error());
						  
  $query_next = "SELECT * FROM pagamenti_rent WHERE data_pagamento > CURDATE() AND id_cliente='".$num_scheda."' AND status='' ORDER BY data_pagamento"; 
  $action_next = mysql_query($query_next)or die(mysql_error()); 
  $number_next = mysql_num_rows($action_next);
		
  while ($number_next > $b) {
	  $next_id_prop = mysql_result($action_next,$b,"id_prop");
	  $income_data = mysql_result($action_next,$b,"data_pagamento");
	  $amount_pagamento = mysql_result($action_next,$b,"amount_pagamento");
	  
	  // recupero i dati delle proprietÃƒ  dall'ID
	  $c = 0;
	  $sel_next_name = mysql_select_db($db_database)or die(mysql_error());
							  
	  $query_next_name = "SELECT * FROM customer_prop WHERE ID='".$next_id_prop."'"; 
	  $action_next_name = mysql_query($query_next_name)or die(mysql_error()); 
	  $number_next_name = mysql_num_rows($action_next_name);
			
	  while ($number_next_name > $c) {
		  $next_prop_name = mysql_result($action_next_name,$c,"nome_bld");
		  $next_prop_unit = mysql_result($action_next_name,$c,"unit");
		  
		  $html .='
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="text-align: center;">'.datareformat($income_data).'</td>
			<td>'.$next_prop_name.' - '.$next_prop_unit.'</td>
			<td>&nbsp;</td>
			<td style="text-align: center;">AED '.currency_format($amount_pagamento).'</td>
		  </tr>';
		  
		  $c++;
	  }
	  $b++;
  }
  
  // script per distanziare
  if ($number_next < 4) {
	  for($ds=$number_next; $ds <= 4; $ds++) {
		  $html .='
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td></td>
			<td style="text-align: center;"></td>
			<td>&nbsp;</td>
			<td style="text-align: center;"></td>
		  </tr>';
	  }
  }
  
  if ($number_next == 0) { //se non ci sono incomes futuri
	  $html .='
	  <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>-</td>
		<td style="text-align: center;"></td>
		<td>&nbsp;</td>
		<td style="text-align: center;"></td>
	  </tr>';
  }
 
// calcolo il totale dei future incomes  
$sel_fi = mysql_select_db($db_database)or die(mysql_error());
$query_fi = mysql_query("SELECT SUM(amount_pagamento) AS prop_fi FROM pagamenti_rent WHERE data_pagamento > CURDATE() AND id_cliente='".$num_scheda."'") or die(mysql_error());
$row_fi = mysql_fetch_assoc($query_fi);
$prop_fi = $row_fi['prop_fi'];

$html .='
  <tr>
  	<td style="width: 10px;">&nbsp;</td>
    <td style="width: 30px;">&nbsp;</td>
	<td style="text-align: center; width: 140px;"></td>
    <td style="width: 300px; border-top: dotted 1px #555;"><strong>Total</strong></td>
    <td style="width: 80px; border-top: dotted 1px #555;">&nbsp;</td>
    <td style="text-align: center; width: 160px; border-top: dotted 1px #555;"><strong>AED '.currency_format($prop_fi).'</strong></td>
  </tr>
</table>


<p></p><p></p><p>


<div style="border-top: solid 2px #555; height: 1em;"></div>
<div style="margin: 0 auto;text-align: center; background-color:#fff;width:100%;height:30px;color:#555; font-family:sans;font-size: 1.2em;">
	<strong>Future Rental Contracts Expirations</strong>
</div>
<div style="border-bottom: solid 2px #555; height: 1em;"></div>

<br/>

<table border="o" cellpadding="3" style="font-family:sans;">
  <tr>
  	<td style="width: 10px;">&nbsp;</td>
  	<td style="width: 30px;">&nbsp;</td>
	<td style="text-align: center; width: 140px; border-bottom: dotted 1px #555;"><strong>Date</strong></td>
    
    <td style="width: 300px; text-align: left; border-bottom: dotted 1px #555;"><strong>Property</strong></td>
  </tr>';
  
  // recupero le scadenze del cliente
  $d = 0;
  $sel_exp = mysql_select_db($db_database)or die(mysql_error());
						  
  $query_exp = "SELECT * FROM rent_agr_details WHERE id_cliente='".$num_scheda."' and agr_break!='YES' ORDER BY fine_rent"; 
  $action_exp = mysql_query($query_exp)or die(mysql_error()); 
  $number_exp = mysql_num_rows($action_exp);	
						   
  while ($number_exp > $d) {
	  $fine_id_prop = mysql_result($action_exp,$d,"id_prop");
	  $fine_rent = mysql_result($action_exp,$d,"fine_rent");
	  
	  //stampo solo se la data di scadenza ÃƒÂ¨ posteriore a oggi
	  if ($fine_rent > date('Y-m-d')) {
		  // recupero i dati delle proprietÃƒ  dall'ID
		  $e = 0;
		  $sel_exp_name = mysql_select_db($db_database)or die(mysql_error());
								  
		  $query_exp_name = "SELECT * FROM customer_prop WHERE ID='".$fine_id_prop."'"; 
		  $action_exp_name = mysql_query($query_exp_name)or die(mysql_error()); 
		  $number_exp_name = mysql_num_rows($action_exp_name);
				
		  while ($number_exp_name > $e) {
			  $exp_prop_name = mysql_result($action_exp_name,$e,"nome_bld");
			  $exp_prop_unit = mysql_result($action_exp_name,$e,"unit");
		  
			  $html .='
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td style="text-align: center;">'.datareformat($fine_rent).'</td>
					<td style="text-align: left;">'.$exp_prop_name.' - '.$exp_prop_unit.'</td>
				  </tr>';
		  
			  $e++;	  
		  }
	  }
	  $d++;
  }
  
$html .='</table>';


//  SE SI STA CERCANDO UNA SOLA UNITA'

	
//	$sel_next = mysql_select_db($db_database)or die(mysql_error());
//							
//	$query_next = "SELECT DISTINCT(id_prop) FROM pagamenti_rent where id_cliente='".$num_scheda."' order by id_prop;"; 
//	$action_next = mysql_query($query_next)or die(mysql_error()); 
//	$number_next = mysql_num_rows($action_next);
//		  
//	while ($number_next = mysql_fetch_assoc($action_next)) {
//		$id_prop = $number_next['id_prop'];
//		

//$html .='<table><tr><td style="width:1000px; height:500px;">
//		
//		<img src='.$https.'./sdac2/jpgraph/src/test.php?clientid='.$id_prop.'" width="1000" height="500">
//		</td></tr></table>';
//
//	}
//	
		
/*
$html .='<pagebreak />
<img src="https://www.sdacrealestate.com/sdac2/jpgraph/src/test_allprop_test.php?clientid='.$num_scheda.' width="1200" height="600" border="none" ">
</img>';
*/
/*
$html .='<pagebreak ... sheet-size="A4-L" ... />
<img src="https://www.sdacrealestate.com/sdac2/jpgraph/src/test_allprop_test1.php?clientid='.$num_scheda.' width="1200" height="600" border="none" ">
</img>';
*/



	

	
////////////////////////////////////////////////////////////////
// CASISTICA PER STAMPARE IL PDF /////////////////////////////// 
////////////////////////////////////////////////////////////////

$mpdf->WriteHTML($html);
$path = '/home/sdacreal/public_html/sdac2/schede/statements/'.$num_scheda.'/statement_';
				//imposto il numero della ricevuta
				
				
				

//$mpdf->Output($savefile,'F');

//$mpdf->Output();
$mpdf->Output($path.$selfetch['ID'].'.pdf','F');
//$mpdf->Output($path.$month."-".$year.'.pdf','F');
header("Location:clientpage.php?clientid=".$selfetch['client_id']);		
				}		
//	}
	
?>