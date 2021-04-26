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
       <?PHP

if (isset($_POST['submit'])){
	require("header2.php");
	require("db_config.php");
	require("db.php");
	echo "<div style='width:500px;margin:0 auto;text-align:center;'>";
	echo "<table style='margin:0 auto;width:100%;'><tr><td>Job Number</td><td>Delete</td></tr>";
	$del1="select * from cards where cardnumber='".$_POST['jobnumber']."';";
	$del1r=mysql_query($del1);
	$del1row=mysql_num_rows($del1r);
	if($del1row==false){
		echo "There was an error. Nothing found";
	}else{
	while($del1f=mysql_fetch_assoc($del1r)){
		echo '<tr><td>'.$del1f['cardnumber'].'</td><td><a href="del_card.php?cardid='.$del1f['ID'].' ">DELETE</a></td></tr>';
	}
	echo '</table></div>';
	
}
}else{
require("header2.php");
echo "<div style='width:500px;margin:0 auto;'>";
echo "<form method=POST action=del_card1.php>";
echo "<table>";
echo "<tr><td><input type=text name=jobnumber></td><td>Type Job Number</td><td><input type=submit name=submit value=Delete></td></tr></table></form></div>";

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
 
        
        
        
        
