<?php
  //start session
  session_start();
  ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
  
  include("db_config.php");
include("db.php");
  // Chiamo le variabili di login
  $user = addslashes($_POST['username']);
  
  $psw = addslashes($_POST['password']);
  
  
  // Controllo se i dati di login sono nel database
  
  $query = "SELECT * FROM login WHERE username = '$user' AND password = '$psw'"; 
  $action = mysql_query($query)or die(mysql_error()); 
  $number = mysql_num_rows($action);
    
  if ($number == 1) {
    $_SESSION['user'] = $user;
    $_SESSION['password'] = $secure_psw;
    
    // ricavo l'indirizzo ip
    $ip = $_SERVER['REMOTE_ADDR'];
    
    // invio una mail all'utente per segnalargli il login
    // ricavo la mail dell'utente
    $a= 0;
    
    while ($number > $a) {
      $mail = mysql_result($action,$a,"mail");
      $_SESSION['level'] = mysql_result($action,$a,"level");
      $a++;
    }?>
    <script>window.location = 'main.php';</script>
    <?php
  }
  else {
    $avviso = "<script>alert('Please Enter correct Username Or Password');window.location = 'login.php';</script>";
    }
?>
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
                
          <a href="http://www.nsegulf.com"><img src="images/logo.JPG" width="200" height="70"></a></div> 
            
            	
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
         <div class="container" align="center">
         <section id="maincontent" class="twelve columns">
           <form id="login_form" name="login_form" method="post" action="login_check.php">
            <label>Username:</label>
            <input type="text" name="username" class="login_user"/><br/><br/><br/>
            <label>Password:</label>
          <input type="password" name="password" class="login_psw"/><br/><br/><br/>
            <?php echo $avviso ?>
            <input id="login_btn" name="entra" type="submit" value="Enter" />
        </form>
                
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
 
        
        
        
        
<body>
</body>
</html>