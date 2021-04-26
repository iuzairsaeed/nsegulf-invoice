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
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->

<head>

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
		 
if (isset ($_POST['submit']))
{
	require("db_config.php");
	require("db.php");
$s="select * from cards ORDER BY ID DESC limit 1";
$sr=mysql_query($s);
$sf=mysql_fetch_assoc($sr);
if($_POST['cdate']==FALSE){
echo "You have to select date";
exit;
}
if($_POST['companyold']==FALSE){
echo "You have to select company";
exit;
}

if($_POST['customertype']==FALSE){
echo "You have to select customer type";
exit;
}
if($_POST['faultdetail']==FALSE){
echo "You have to select customer complaint";
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
	
		$newcard = $select2f['companycode'].'/'.$sf['ID'];
}else{
	
	$number = $selectrow + 1;


		$explode=explode("/", $selectfetch['cardnumber']);
		$newcard = $explode[0].'/'.$sf['ID'];	
	
}		
	
		
		$i1="insert into cards (contactperson, cardnumber, clientjobnumber, carddate, companyid, carnum, partnumber, modelnumber, serialnumber, customertype, 
		customercomplaint, includedaccess, otherremarks, totamount, receivedby, cardstatus)
		values('".addslashes($_POST['contactperson'])."','".addslashes($newcard)."', '".addslashes($_POST['clientjob'])."', '".addslashes($cdate)."','".addslashes($company)."',
		'".addslashes($_POST['carnumber'])."','".addslashes($_POST['partnumber'])."',
		'".addslashes($_POST['modelnumber'])."','".addslashes($_POST['serialnumber'])."',
		'".addslashes($_POST['customertype'])."',
		'".addslashes($_POST['faultdetail'])."',
		'".addslashes($_POST['included'])."',
		'".addslashes($_POST['remarks'])."', '0.00','".addslashes($_POST['receivedby'])."', 'inv');";
		$i1res=mysql_query($i1)or die(mysql_error());
		$insert=mysql_insert_id();
		
		

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

header("Location: http://dubaiitservice.com/addcard2.php?cardid=".$insert."");
		
}

else{
	require("header.php");
	require("db_config.php");
	require("db.php");
	
	?>
	<script type=Text/Javascript src=scw.js></script>
	<form method=POST action=addcard.php>
	<div   style="width:750px;margin:0 auto;font:12px Trebuchet MS, sans serif;">
	  <table width="114%" style="margin:0 auto;">
	    <tr>
	      <td width="89" style="padding-right:10px;">Date</td>
	      <td width="81"><input type=text readonly name=cdate onclick="scwShow(this,event);"></td>
	      </tr>
	    <tr>
	      <td style="padding-right:10px;">Client Job Number</td>
	      <td><input type=text name=clientjob></td>
	      </tr>
	    <tr>
	      <td style="padding-right:10px;">Car Number</td>
	      <td><input type=text name=carnumber></td>
	      </tr>
	    <tr>
	      <?PHP $com="Select * from companies order by companybranch";
$comr=mysql_query($com)or die(mysql_error());
?>
	      <td style="padding-right:10px;">Company Name: </td>
	      <td><select style="width:160px;"  name=companyold>
	        <option value="">Select if Existing</option>
	        <?PHP
while($comf=mysql_fetch_assoc($comr)){
		
	echo "<option value=".$comf['companyid'].">".$comf['companybranch']." &emsp; ".$comf['companycode']."</option>";
}
?>
	        </select></td>
	      </tr>
	    <tr>
	      <td style="padding-right:10px;">Contact Person</td>
	      <td><input type=text name=contactperson></td>
	      </tr>
	    <tr>
	      <td style="padding-right:10px;">Or Add New Company</td>
	      <td><a href='addcompany.php'/>New</td>
	      </tr>
	    <tr>
	      <td style="padding-right:10px;">Part Number</td>
	      <td><input type=text name=partnumber></td>
	      </tr>
	    <tr>
	      <td style="padding-right:10px;">Model Number</td>
	      <td><input type=text name=modelnumber></td>
	      </tr>
	    <tr>
	      <td style="padding-right:10px;">Serial Number</td>
	      <td><input type=text name=serialnumber></td>
	      </tr>
	    <tr>
	      <td style="padding-right:10px;">Customer Type</td>
	      <td><input type=text name=customertype></td>
	      </tr>
	    <tr>
	      <td style="padding-right:10px;">Received by</td>
	      <td><input type=text name=receivedby></td>
	      </tr>
	    <tr>
	      <td style="padding-right:10px;">Customer Complaint</td>
	      <td><textarea cols=104 rows=2 name=faultdetail></textarea></td>
	      </tr>
	    <tr>
	      <td style="padding-right:10px;">Included Accessories</td>
	      <td><textarea cols=104 rows=2 name=included></textarea></td>
	      </tr>
	    <tr>
	      <td style="padding-right:10px;">Other Remarks</td>
	      <td><textarea cols=104 rows=2 name=remarks></textarea></td>
	      </tr>
	    </table>
	  <table style="margin:0 auto;text-align:right;">
	    <tr><td></td><td></td><td style="padding-right:10px;"></td><td style="float:right;"><input type=submit name=submit value="Enter New Card"></td></tr></table></div></form>
<?PHP
}
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
 
        
        
        
        

