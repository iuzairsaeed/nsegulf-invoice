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
require("header.php");
$company=addslashes($_GET['companyid']);


?>
<div style="width:700px;height:70px;padding-top:10px;background:#FFF;margin:0 auto;font:12px Trebuchet MS, sans serif;">
	<form method=post action=gr.php target=_blank>
	<table style="width:650px;margin:0 auto;text-align:center;margin:0 auto;">
	<tr style="font-weight:bold">
	<td></td><td>Start Month-Year</td><td>End Month-Year</td></tr>
<?PHP
echo "<tr><td><input type=hidden name=companyid value=".$company."><td><select name=smonth><option value=''>Start Month</option>
<option>01</option>
<option>02</option>
<option>03</option>
<option>04</option>
<option>05</option>
<option>06</option>
<option>07</option>
<option>08</option>
<option>09</option>
<option>10</option>
<option>11</option>
<option>12</option>
</select><select name=sy><option value=''>Start Year</option>";
$plus=date("Y", strtotime("+10 Years"));
for($i=2010; $i<=$plus; $i++){
echo "<option>".$i."</option>";
}
echo "</select></td>";
echo "<td><select name=emonth><option value=''>Start Month</option>
<option>01</option>
<option>02</option>
<option>03</option>
<option>04</option>
<option>05</option>
<option>06</option>
<option>07</option>
<option>08</option>
<option>09</option>
<option>10</option>
<option>11</option>
<option>12</option>
</select><select name=ey><option value=''>Start Year</option>";
$plus=date("Y", strtotime("+10 Years"));
for($i=2010; $i<=$plus; $i++){
echo "<option>".$i."</option>";
}
echo "</select></td>
<td><input type=checkbox name=checker value=checked></td><td>Check if internal report</td>";
echo "<td><input type=submit name=submit value=submit></td></tr>";


	

echo '</table>';
echo "</form>";
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
 
        
        
        
        
