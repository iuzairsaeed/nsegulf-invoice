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

?>
<div style="width:700px;height:70px;padding-top:10px;background:#fff;margin:0 auto;font:12px Trebuchet MS, sans serif;">
	<form method=post action=mr.php>
	<table style="width:650px;margin:0 auto;text-align:center;margin:0 auto;">
	<tr style="font-weight:bold">
	<td>Start Month-Year</td><td>End Month-Year</td></tr>
<?PHP
echo "<tr><td><select name=smonth><option value=''>Start Month</option>
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

<!-- ////////////////////////////////// -->
<!-- //      Javascript Files        // -->
<!-- ////////////////////////////////// -->
<script type="text/javascript" src="cssuser/jquery-1.6.4.min.js"></script>

<!-- jQuery Superfish -->
<script type="text/javascript" src="cssuser/hoverIntent.js"></script> 
<script type="text/javascript" src="cssuser/superfish.js"></script> 
<script type="text/javascript" src="cssuser/supersubs.js"></script>

<!-- jQuery Flexslider -->
    

<script type="text/javascript" src="cssuser/jquery.prettyPhoto.js"></script>
<!-- jQuery Dropdown Mobile -->
<script type="text/javascript" src="cssuser/tinynav.min.js"></script>


<script type="text/javascript" src="cssuser/fade.js"></script>
<script type="text/javascript" src="cssuser/contact.js"></script>
<!-- Custom Script -->
<script type="text/javascript" src="cssuser/custom.js"></script>


<!-- Form Contact Script -->


<!-- Custom Script -->

    


<!-- Begin Web-Stat code v 6.2 -->
<span id="wts709589">&nbsp;</span><script type="text/javascript">
var wts=document.createElement('script');wts.type='text/javascript';
wts.async=true;wts.src=('https:'==document.location.protocol?'https://server2':'http://lb')
+'.web-stat.com/5/709589/log6_2.js';
document.getElementById('wts709589').appendChild(wts);
</script><noscript><a href="http://www.web-stat.com">
<img src="//server2.web-stat.com/6/5/709589.gif" 
style="border:0px;" alt=""></a></noscript>
<!-- End Web-Stat code v 6.2 -->



<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-34160844-1', 'auto');
  ga('send', 'pageview');

</script>




</body>
</html>
 
        
        
        
        
