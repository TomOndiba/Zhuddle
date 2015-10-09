<?php
include("loggedincheck.php");
if(isset($_SESSION['email'])&&isset($_SESSION['name'])&&$_SESSION['state_id']==1)
	 {
		 header("location:home.php");
	 }
	 else
	 {
	    
	 }
	$startup=mysql_query("SELECT  * FROM users WHERE email='".$_SESSION['email']."'");
	while($ans=mysql_fetch_array($startup))
	 {
		$id=$ans['id']; 
	 }
	 $_SESSION['id']=$id;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="stylesheet/stylesheet2.css" />
<link rel="Shorcut Icon" href="zhuddle_icon_small.ico">

<noscript>
	<style type="text/css">
            #main {display:none;}
    </style>
    <meta http-equiv="refresh" content="0;url=logout.php">
</noscript>

<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
</head>

<body>
<!----HEADER AREA---->
<div id="header">
	<header>
		<div id="logo">
        <a href="home.php" title="Home">
		<img id="logo" alt="Zhuddle" src="images/zhuddle-logo.png" title="Zhuddle"/></a>
        </div>
        <div id="icons">
        <a href="logout.php" class="icon">
        	<img id="log-out-icon" src="images/logout.png" alt="Log Out" title="Log Out" />
        </a>
        </div>
	</header>
</div>

<!----MAIN AREA---->
<div id="main">
	<section>
    	<div id="main-box">
            <p id="tags" class="labels">Welcome to Zhuddle</p>
            <div>
            <p class="p-class">Zhuddle is a social networking website which is a nice form of entertainment, great for meeting people with similar interests, and can be a very effective business technique for entrepreneurs, writers, actors, musicians or artists.<br />
However Zhuddle comes with a few unique features. They are as follows:<br /><br />

1. Users can interact via discussions and ask for
opinions and suggestions from online friends or users.<br />
2. Users can customize the appearance of the user interface.<br />
3. Users can upload pictures thoughts and views.<br />
4. Users can share problems and get people's opinion on how solve
them.<br />
5. People can interact on a more personal level giving them a broader
outlook towards life.<br /><br />

Zhuddle helps maintaining relationships and establish new ones by
reaching out to people you have never met before.</p>
            </div>
        <button type="button" id="set-up-button" class="button" value="Set up your Profile" onclick="window.location.href='profile-setup.php'">Set up your Profile</button>
        </div>
        
	</section>
</div>


</body>
</html>
