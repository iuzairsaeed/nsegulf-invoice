
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
                           <?php 
						   
						   require("header.php");
						   ?> 
                            <h1 align="center" class="pagedesc"></h1>
                      </hgroup>
                    </section>
                </div>
            </div>
        </div>
        
        
      <div id="outermain">
         <div class="container">
         <section id="maincontent" class="twelve columns">
      
      <form method=POST action=updatelpo.php>
      <table style="width:900px;margin:0 auto;text-align:center;"><tr>
      <td>Enter Job Card Number</td><td><input type="text" name="cardnum"></td>
      <td>Enter LPO Number</td><td><input type="text" name="lpo" maxlength="50"></td>
      <td></td><td><input type="submit" name="submit" value="Update LPO"></td>
      </tr></table>
      </form>
    
         <?php
		
require("db_config.php");
require("db.php");
if (isset ($_POST['submit']))
{
	
	
	if ($Jc=$_POST['cardnum']==''){
		echo "<script>alert ('Enter Job Card Number')</script>";
		exit();
			}
	if ($lp=$_POST['lpo']==''){
		echo "<script>alert ('Enter LPO Number')</script>";
		exit();
		}


    $selectCard="select * from cards where cardnumber='".$_POST['cardnum']."'";
    $selectCardRes=mysql_query($selectCard)or die(mysql_error());
    $cardExists=mysql_num_rows($selectCardRes);
    if($cardExists >= 1){
      $update="update cards set LPO='".$_POST['lpo']."' where cardnumber='".$_POST['cardnum']."'";
      if (mysql_query($update))
      {
        echo "<script>alert ('You have successfully entered LPO Number')</script>";
      }
    }
    else{
        echo "<script>alert ('Card does not found. Please enter correct card number')</script>";
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
 
        
        
        
        

