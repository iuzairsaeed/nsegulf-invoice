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
       
         
 <div class="separator"></div>
                <div class="one_half lastcols" align=""><strong><center><h2><bold>Add New Company</bold></h2></center></strong>
             <form action="addcompany.php" method="post">  
                <table  align="center" width="100" border="1" cellpadding="2">
                  <tr>
                    <td>Company Name</td>
                    <td><input type="text" name="companyname" id="companyname"></td>
                  </tr>
                  <tr>
                    <td>Company Code</td>
                    <td><input type="text" name="companycode" id="companycode"></td>
                  </tr>
                  <tr>
                    <td>Company Branch</td>
                    <td><input type="text" name="companybranch" id="companybranch"></td>
                  </tr>
                  <tr>
                    <td>Contact Person</td>
                    <td><input type="text" name="contactperson" id="contactperson"></td>
                  </tr>
                  <tr>
                    <td>Mobile Number</td>
                    <td><input type="text" name="mobile" id="mobile"></td>
                  </tr>
                  <tr>
                    <td>Telephone</td>
                    <td><input type="text" name="telephone" id="telephone"></td>
                  </tr>
                  <tr>
                    <td>Fax</td>
                    <td><input type="text" name="fax" id="fax"></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" id="email"></td>
                  </tr>
              
                </table>
                 <table style="margin:0 auto;text-align:right;">
	    <tr><td style="float:right;"><input type=submit name=submit value="Enter "></td></tr></table></form>
        <?php
	$con=mysql_connect("localhost","root","") or die (mysql_error());
	$db=mysql_select_db('nseinvoice' ,$con) or die (mysql_error());
	
	if (isset($_POST['submit']))
	{
	 $cname=$_POST['companyname'];
	 $ccode=$_POST['companycode'];
	 $cbranch=$_POST['companybranch'];
	$contperson=$_POST['contactperson'];
	$cmobile=$_POST['mobile'];
	$ctelephone=$_POST['telephone'];
	$cfax=$_POST['fax'];
	$cemail=$_POST['email'];
	if ($cname==''){
		echo "<script>alert ('Enter Name Please')</script>";
		exit();
	}
		if ($ccode==''){
		echo "<script>alert ('Enter Company Code Please')</script>";
		exit();
		}
		if ($cbranch==''){
		echo "<script>alert ('Enter Branch Please')</script>";
		exit();
		}
		if ($contperson==''){
		echo "<script>alert ('Enter Contact Person Please')</script>";
		exit();
		}
		if ($cmobile==''){
		echo "<script>alert ('Enter Mobile Number Please')</script>";
		exit();
		}
		if ($ctelephone==''){
		echo "<script>alert ('Enter Telephone Please')</script>";
		exit();
		}
		if ($cfax==''){
		echo "<script>alert ('Enter Fax number Please')</script>";
		exit();
		}
		if ($cemail==''){
		echo "<script>alert ('Enter Email Please')</script>";
		exit();
		}
	else
	{
		$que="insert into companies (companyname,companycode,companybranch,contactperson,mobile,telephone,fax,email) values ('$cname','$ccode','$cbranch','$contperson','$cmobile', '$ctelephone', '$cfax','$cemail')";
		if (mysql_query($que))
		{
			echo "<script>alert ('You Have Successfully Entered New Company')</script>";
			}
		}	
			
	}
	
		
        ?>
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

        
        
        
        

