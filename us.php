<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NSE Invoicing Sysem - Login</title>
</head>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]--><head>
	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8" />
	<title>NSE Invoicing Sysem - Login | login Page</title>
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
	<meta name="author" content="" />

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />




	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="cssuser/skeleton.css" />
    <link rel="stylesheet" href="cssuser/style.css" />
        
    
        <link rel="stylesheet" href="cssuser/inner.css" />
    <link rel="stylesheet" href="cssuser/prettyPhoto.css" media="screen"/>
    
    
    <link rel="stylesheet" href="cssuser/color.css" />
	<link rel="stylesheet" href="cssuser/layout.css" />
    

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	

	
</head>
<body>



<input type="hidden" name="txt_urls" id="txt_urls"  value="http://www.nsegulf.com/" />
<div id="bodychild">
	<div id="outercontainer">
    
        <!-- HEADER -->
        <div id="outerheader">
        	<div class="container">
            <header id="top" class="twelve columns">
              <div id="logo"  class="three columns alpha">
                
          <a href="main.php"><img src="images/logo.JPG" width="200" height="70"></a></div> 
            
            	
                <section id="navigation" class="nine columns omega">
                    <nav>
            
                        </ul><!-- topnav -->
                    </nav><!-- nav -->	
                    
                </section>
            </header>
            </div>
        </div>
        <!-- END HEADER -->
        
              
      <!-- MAIN CONTENT -->

      <div id="outermain">
         <div  align="left" class="container">
         <section id="maincontent" class="twelve columns">
      <?php
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

	
	
////////////////////////////////////////////////////////////////////
// Extend the TCPDF class to create custom Header and Footer
// ---------------------------------------------------------
// define some HTML content with style
require("header2.php");
echo '<div style="width:800px;margin:0 auto;">';
echo '<table style="width:100%;border-collapse:collapse;margin:0 auto;text-align:center;"><thead><tr>
<td>Card Number</td><td>Update</td></tr></thead>';
$s="select * from cards where cardstatus='fin';";
$sr=mysql_query($s)or die(mysql_error());
while($sf=mysql_fetch_assoc($sr)){
	echo '<tr><td>'.$sf['cardnumber'].'</td><td><a href="update.php?cardid='.$sf['ID'].' "/>Set as Paid</td></tr>';
}
echo '</table>';
echo '</div>';

	
	
	

?>
 <div class="separator"></div>
                <div class="one_half lastcols">
                
             <h3>&nbsp;</h3>
                         
                    
                    
                    <div id="contactform"></div>
         
     
                </div>
                
                
                <div class="clear"></div>
           </section>
        </div>
    </div>
        
        
        <!-- Content End--><!-- AFTER CONTENT -->
              <div id="outerfooter">
        	<div class="container">
        	<div id="footercontainer" class="twelve columns">
           	  <footer id="footer">
           	    <div align="center">Copyright &copy;2014 Company. All Rights Reserved .</div>
           	  </footer>
        	</div>
            </div>
      </div>
        <!-- END FOOTER -->
        
	</div><!-- end bodychild -->
</div><!-- end outercontainer -->





</body>
</html>
 
        
        
        
        
