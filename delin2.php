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
require("header2.php");
?>
	<script type=Text/Javascript src=scw.js></script>
	<form method=POST action=delin3.php>
	<div style="width:750px;height:300px;padding-top:20px;padding-left:25px;background:#fff; ">
	<table style="width:600;float:left;;text-align:left;">
	<tr>
<?PHP
$select="select * from cards where ID='".$_GET['cardid']."' and cardstatus='invdone';";
$selres=mysql_query($select);
$self=mysql_fetch_assoc($selres);
?>
	<td></td><td><input type=hidden READONLY name=cardid value='<?php echo $_GET['cardid'] ?>'>Assigning Delivery Note to Card #<?PHP ECHO $self['cardnumber']; ?></td></tr><tr>
	<td style="padding-right:10px;">Date</td><td><input type=text name=cdate onclick="scwShow(this,event);"></td></tr></table><br /><br />
	
<?php
echo "<table style='margin:0 auto;width:600px;'><tr><td style='width:30px;'></td><td>Qty</td><td>Description</td><td>Unit Price</td><td>Line Total</td></tr>";
$select2="select * from services where cardid='".$_GET['cardid']."';";
$selres2=mysql_query($select2);
while($self2=mysql_fetch_assoc($selres2)){



echo "<tr><td style='width:30px;'><input type=hidden name=number[] value=".$self2['serviceid']."></td><td><input type=text name=quantity[] READONLY value=".$self2['qty'].">
</td><td><input type=text name=description[] READONLY value='".$self2['description']."' ></td><td><input type=text name=unitprice[] READONLY value=".$self2['unitprice']."></td>
<td><input type=text name=linetotal[] READONLY value=".$self2['linetotal']."></td></tr>";
}	

echo "<tr><td></td><td></td><td></td><td></td><td align=right><input type=submit name=submit value=submit></td></tr>";
echo "</table>";

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
 
        
        
        
        
