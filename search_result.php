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

      <div id="outermain" >
         <div  align="left" class="container">
         <section id="maincontent" class="twelve columns">
     <?PHP
if($_POST['submit']==true){
	if($_POST['search']==''){
	require("header2.php");
	echo "You did not type anything or the search query is very small. Type at least three characters";
	exit;
	}else{
		require("header.php");
		require("db_config.php");
		require("db.php");
		$sel="select * from cards where cardnumber like '%".$_POST['search']."%' OR carnum like '%".$_POST['search']."%'  or clientjobnumber like '%".$_POST['search']."%' OR LPO like '%".$_POST['search']."%' ;";
		$selr=mysql_query($sel);
		$selrow=mysql_num_rows($selr);
		if($selrow==false){
			"Nothing found";
		}else{
			echo "<div style='width:600px;height:auto; text-align:center '>";
			echo "<table style='width:100%;margin:0 auto; '>
			<tr style='background:#887;color:#000;'><td style='text-align:left;padding-left:5px;'>Card Number</td>
			<td style='text-align:center;'>Order Number</td>
			<td style='text-align:center;'>Car Number</td>
			<td style='text-align:center;'>Status</td>
			<td style='text-align:center;'>Job Card</td>
			<td style='text-align:center;'>Invoice</td>
			<td style='text-align:center;'>Delivery</td>
			<td style='text-align:center;'>LPO No</td>";
			while($selfetch=mysql_fetch_assoc($selr)){
				if($selfetch['cardstatus']=="inv"){
					echo "<tr><td style='text-align:left;padding-left:5px;'>".$selfetch['cardnumber']."</td>
<td style='text-align:left;padding-left:5px;'>".$selfetch['clientjobnumber']."</td>
<td style='text-align:left;padding-left:5px;'>".$selfetch['carnum']."</td>
					<td style='text-align:center;'>Requires Invoice</td>
					<td style='text-align:center;'><a href='vc.php?cardid=".$selfetch['ID']." '/>View</a></td>
					<td style='text-align:center;'>--</td>
					<td style='text-align:center;'>--</td>
					<td style='text-align:left;padding-left:5px;'>".$selfetch['LPO']."</td>";
					
					
				}elseif($selfetch['cardstatus']=="invdone"){
					echo "<tr><td style='text-align:left;padding-left:5px;'>".$selfetch['cardnumber']."</td>
<td style='text-align:left;padding-left:5px;'>".$selfetch['clientjobnumber']."</td>
<td style='text-align:left;padding-left:5px;'>".$selfetch['carnum']."</td>
					<td style='text-align:center;'>Requires Delivery</td>
					<td style='text-align:center;'><a href='vc.php?cardid=".$selfetch['ID']." '/>View</a></td>
					<td style='text-align:center;'><a href='vi.php?cardid=".$selfetch['ID']." '/>View</a></td>
					<td style='text-align:center;'>--</td>
					<td style='text-align:left;padding-left:5px;'>".$selfetch['LPO']."</td>
					";
					
				}elseif($selfetch['cardstatus']=="fin"){
					echo "<tr><td style='text-align:left;padding-left:5px;'>".$selfetch['cardnumber']."</td>
<td style='text-align:left;padding-left:5px;'>".$selfetch['clientjobnumber']."</td>
<td style='text-align:left;padding-left:5px;'>".$selfetch['carnum']."</td>
					<td style='text-align:center;'>Unpaid</td>
					<td style='text-align:center;'><a href='vc.php?cardid=".$selfetch['ID']." '/>View</a></td>
					<td style='text-align:center;'><a href='vi.php?cardid=".$selfetch['ID']." '/>View</a></td>
					<td style='text-align:center;'><a href='vd.php?cardid=".$selfetch['ID']."  '/>View</a></td>
					<td style='text-align:left;padding-left:5px;'>".$selfetch['LPO']."</td>
					";
					
				}elseif($selfetch['cardstatus']=="paid"){
					echo "<tr><td valign=top style='text-align:left;padding-left:5px;'>".$selfetch ['cardnumber']."</td>
<td style='text-align:left;padding-left:5px;'>".$selfetch['clientjobnumber']."</td>
<td style='text-align:left;padding-left:5px;'>".$selfetch['carnum']."</td>
					<td valign=top style='text-align:center;'>Already Paid <br /> (".$selfetch ['paymentref'].")</td>
					<td valign=top style='text-align:center;'><a href='vc.php?cardid=".$selfetch['ID']."  '/>View</a></td>
					<td valign=top style='text-align:center;'><a href='vi.php?cardid=".$selfetch['ID']."  '/>View</a></td>
					<td valign=top style='text-align:center;'><a href='vd.php?cardid=".$selfetch['ID']."  '/>View</a></td>
					<td style='text-align:left;padding-left:5px;'>".$selfetch['LPO']."</td>
					";
					
					
				
				}
				
			}
			echo "</table></div>";
		}
	}
}else{
	require("header.php");
	echo "There was an error. Please search again";
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
 
        
        
        
        
