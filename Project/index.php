<?php include("dbheader.php");
if(isset($_SESSION['email'])&& isset($_SESSION['state_id']))
{
	if($_SESSION['state_id']==1)
   	header("location:home.php");
	else if($_SESSION['state_id']==-1)
   	header("location:confirm_account.php");
	else if($_SESSION['state_id']==0)
   	header("location:welcome.php");
 }
	 else
	 {
	    
	 }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Zhuddle</title>
<link rel="stylesheet" type="text/css" href="stylesheet/stylesheet.css" />
<link rel="Shorcut Icon" href="zhuddle_icon_small.ico">

<noscript>
<style type="text/css">
        #main {display:none;}
</style>
</noscript>

<script type="text/javascript" language="javascript" src="js/jquery.js"></script>



<script type="text/javascript" language="javascript" src="js/loginvalidation.js"></script>-

<script type="text/javascript" language="javascript" src="js/signupvalidation.js"></script>

</head>

<body>
<div id="stage">
	<img src="" alt="sitebackground" />
</div>
<!----HEADER AREA---->
<div id="header">
	<header>
		<div id="logo-div">
        <a href="Project.php"><img id="logo" alt="Zhuddle" src="images/zhuddle-logo.png" title="Zhuddle"/></a>
        </div>
        <div id="anime-logo-div">
        <a href="Project.php"><img id="anime-logo" alt="Zhuddle" src="images/anime.gif" title="Zhuddle"/></a>
        </div>
	</header>
</div>

<!----NOSCRIPT AREA---->
<div id="test" style="width: 100%;height: 700px;z-index: -9;position: absolute;top: 0;left: 0;">
    <section>
    <div id="test2">
    	<div>
        	<p class="about-p-class">
            Please enable Javascript from your browser and reload this page to access Zhuddle.
            </p>
        </div> 
    </div>
		<div id="log-in" style="width:500px; left:-5%;">
        	<h2 class="page-labels">Javascript Disabled</h2>
        </div>
    </section>
</div>

<!----MAIN AREA---->
<div id="main">
	<section>
    	<div id="main-box">
        <div id="seperation"></div>
        </div>
         
		<div id="log-in">
        
        <h2 class="page-labels">Log In</h2>
        <form method="POST" id="log-in-form" action="login.php" enctype="multipart/form-data">
        	<label class="labels">Email</label><input type="text" id="email" name="logemail" class="text-box"/>
        	<label class="labels">Password</label><input type="password" id="password" name="logpassword" class="text-box" />
        	<br />
        	<div>
        		<button type="submit" id="log-in-button" class="button" value="Log In">Log In</button>
        	</div>
        </form>
        </div>
        
      <div id="sign-up">
        <h2 class="page-labels">Sign Up</h2>
        <form action="insert.php" method="POST" id="sign-up-form" enctype="multipart/form-data">
        	<div id="field-names">
        		<label class="labels1">First Name</label>
        		<label class="labels1">Last Name</label>
        		<label class="labels1">Email</label>
        		<label class="labels1">Password</label>
        		<label class="labels1">Gender</label>
        	</div>
            <div id="fields">
       			<input type="text" id="fname" class="text-box1" name="fname"/>
        		<input type="text" id="lname" class="text-box1" name="lname"/>
        		<input type="text" id="emailid" class="text-box1" name="signupemail"/>
        		<input type="password" id="userpassword" class="text-box1" name="signuppassword"/><br />
        		<select id="gender-select" name="signupgender"> 
                <option value="Select">Select</option>
        		<option value="Male">Male</option>
        		<option value="Female">Female</option>
                <option value="Trans">Trans</option>
        		</select>
        	</div>
        	<button type="submit" id="sign-up-button" class="button1" value="Sign Up">Sign Up</button>
        	<button type="reset" id="reset-button" class="button1" value="Reset">Reset</button>
        </form>

     <div id="forgot-password">
     <a href="forgot-password.php"><span>*</span> Forgot Password</a></div>
     </div>
    <div id="log-error-box">
    </div>
	<div id="error-box">
    </div>
    <div id="premium-account" style="visibility:hidden">
    	<p><a href="">Create an account for business, brand, NGO, etc.</a></p>
    </div>
  </section>
</div>

<!----FOOTER AREA---->
<div id="footer">
	<div id="footer-content">
        	<ul class="footer-menu">
        		<li><a href="about/about.html">About</a></li>
                <li><a href="about/privacy.html">Privacy</a></li>
                <li><a href="about/contact.html">Contact</a></li>	
                <li><a href="about/help.html">Help</a></li>		
        	</ul>
	</div>
</div>

</body>
</html>
