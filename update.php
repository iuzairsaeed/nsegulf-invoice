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
                    <div class="clear"></div>
                </section>
                <div class="clear"></div>
            </header>
            </div>
        </div>
        <!-- END HEADER -->
        
              
      <!-- MAIN CONTENT -->
      
                   <div id="outerafterheader">
            <div class="container">
                <div id="afterheader" class="twelve columns">
                    <section id="aftertheheader">
                     <hgroup>
                            
                            <h1 align="center" class="pagedesc"></h1>
                      </hgroup>
                    </section>
                </div>
            </div>
        </div>
        
        
      <div id="outermain">
         <div class="container">
         <section id="maincontent" class="twelve columns">
       <?php
require("db_config.php");
require("db.php");

////////////////////////////////////////////////////////////////////
// Extend the TCPDF class to create custom Header and Footer
// ---------------------------------------------------------
// define some HTML content with style
if (isset($_POST['submit'])){
	if($_POST['pay']!=false && $_POST['payment']!=false){
	$update="update cards set cardstatus='paid', paymentref='".addslashes($_POST['pay'])."', paymentmode='".$_POST['payment']."' where ID='".addslashes($_POST['cardid'])."';";
	$updateres=mysql_query($update)or die(mysql_error());
	header("Location:us.php");
	}else{
		echo "You did not type the reference number";
		
	}
}else{
if (isset($_GET['cardid'])){
		require("header2.php");
?>
<form method=POST action=update.php>
<div style="width:100%;height:50px;">
<table style="width:500px;margin:0 auto;text-align:center;"><tr>
<td><input type=hidden name=cardid value=<?php echo $_GET['cardid'] ?>></td><td></td></tr><tr>
<td>Enter Payment Reference #</td><td><input type=text name=pay maxlength=50></td></tr><tr>
<td>Enter Payment Mode</td><td><input type=text name=payment maxlength=10></td>
<td></td><td><input type=submit name=submit value=Update></td></tr></table></form></div>
<?PHP
}else{

	echo "This card does not exists";
}
}
	

?>
                <div class="separator"></div>
                <div class="one_half lastcols">
                
             <h3>&nbsp;</h3>
                         
                    
                    
                    <div id="contactform"></div>
         
     
                </div>
                
                
                <div class="clear"></div>
           </section>
           <p>&nbsp;</p>
           <p>&nbsp;</p>
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
 
        
        
        
        

