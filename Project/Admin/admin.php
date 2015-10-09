<?php
session_start();
if($_SESSION['admin']=="")
{
	header("location:../Project.php");
}
$_SESSION['admin']="prannoy";

?>
<html>
<head>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Zhuddle</title>

<link rel="Shorcut Icon" href="../zhuddle_icon_small.ico">
<link rel="stylesheet" type="text/css" href="../stylesheet/stylesheet1.css" />

<script type="text/javascript" language="javascript" src="scripts/jquery.js"></script>

<script type="text/javascript" language="javascript" src="scripts/loginvalidation.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" language="javascript" src="../js/js1/jquery-ui-1.10.2.custom.js"></script>
<script type="text/javascript" language="javascript" src="../js/js1/jquery-ui-1.10.2.custom.min.js"></script>
<script type="text/javascript" language="javascript" src="js/blitzer/jquery-ui-1.10.2.custom.css"></script>
<script type="text/javascript" language="javascript" src="js/blitzer/jquery-ui-1.10.2.custom.min.css"></script>

<script type="text/javascript" language="javascript" src="js/jquery.ui.datepicker.js"></script>


<script type="text/javascript">
/*
$("document").ready(function() {
	
$("#datepicker").datepicker({
changeYear:true,
changeMonth:true,
});
*/


	
	
	

    


</script>

</head>
<body>
<div id="header">
<div id="header-container">
		<div id="logo-div">
        <a href="admin.php"><img id="logo" alt="Zhuddle" src="../images/zhuddle-logo.png" title="Zhuddle"/></a>
        </div>
        <div id="icons">
        <a href="../logout.php" class="icon">
        	<img id="log-out-icon" src="../images/logout.png" alt="Log Out" title="Log Out" />
        </a>
        </div>
	</div>
    </div>
    
<div id="main">
<section>
<div id="main-box">
	<div id="reports">
        <a href="user_details.php">View User Details Based on Joining Date.</a><br/><br /><br />
        <a href="user_log.php">View most frequent users.</a></br><br/><br /><br /><br />
		<div id="reports2">
        <h2 style="font:'Trebuchet MS', Arial, Helvetica, sans-serif;	font-size:13px;	color:#000;margin-bottom:10px; margin-top:10px">View Posts sent by:</h2>
        <form action="generate_report.php" method="POST">
        <input type="text" name="posts"id="posts" class="text-box"/>
        <button class="button" type="submit" name="button1" id="button1" value="Generate Report">Generate Report</button><br/>
        </form>
        
        <h2 style="font:'Trebuchet MS', Arial, Helvetica, sans-serif;	font-size:13px;	color:#000;margin-bottom:10px; margin-top:20px">View Messages sent by:</h2>
        <form action="generate_message.php" method="POST">
        <input type="text" name="message_report"id="message_report" class="text-box"/>
        <button class="button" type="submit" name="button2" id="button1" value="Generate Report">Generate Report</button><br/>
        </form>
        
        <h2 style="font:'Trebuchet MS', Arial, Helvetica, sans-serif;	font-size:13px;	color:#000;margin-bottom:10px; margin-top:20px">View users who signed up on</h2><br/>
        <form action="testing.php" method="POST">
        <input type="date" name="field1" id="field1" class="text-box"/>
        <button class="button" type="submit" name="test" id="test" value="test">Test</button>
        </form>
        
        <h2 style="font:'Trebuchet MS', Arial, Helvetica, sans-serif;	font-size:13px;	color:#000;margin-bottom:10px; margin-top:20px">View Messages sent on a particular date</h2><br/>
        <form action="testing1.php" method="POST">
        <input type="date" name="field2" id="field2" class="text-box"/>
        <button class="button" type="submit" name="test" id="test" value="test">Test</button>
        </form>
        </div>
	</div>
</div>
</section>
</div>
</body>
</html>