<?php
include_once('adminCheck.php');
require("session_validator.php");
include("db_config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NSE Invoicing System </title>

<!DOCTYPE html>

<?php include_once('adminCheck.php'); ?>
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
            </header>
            </div>
        </div>
        <!-- END HEADER -->
        
              
  <!-- MAIN CONTENT -->
      
                   <div id="outerafterheader"></div>
        
        
<div id="outermain">
         <div class="container">
           <section id="maincontent" class="twelve columns">
<div id="wrapper">
<div id="header">

  <?php
   require("header.php");
  
    ?>
  
</div>


<?php 
echo '<table width="500" border="1" cellpadding="2">
  <tr>
    <td><h3><a href="addcard.php" />Job Card </a></h3></td>
	<td><h3><a href="us.php"/>Update Status</a></h3></td>
	</tr>
 <tr>
 <td><h3><a href="search_inv.php" />Invoice </a></h3></td>
  
   <td><h3><a href="br.php" />Branch Report</a></h3></td>
  
 </tr>
 <tr>
<td><h3><a href="search_del.php"/>Delivery </a></h3></td>
  <td><h3><a href="md.php" />Managers Report</a></h3></td>
 </tr>
  <tr>
   <td><h3><a href="updatelpo.php" />Update LPO </a></h3></td>
	 
	  <td><h3><a href="del_card1.php"/>Delete Job</a></h3></td>
  </tr>
  
</table>';


?>
<p>&nbsp; </p>
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




