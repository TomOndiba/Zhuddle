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
    <meta http-equiv="refresh" content="0;url=logout.php">
</noscript>

<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript" language="javascript">

$(document).ready(function() {
	
	$('#error-box').hide();
	
	$('#send-code-button').click(function(e) {
		e.preventDefault();
		var email=$('#re-email').val();
		var prev_page=$('#prev-page').val();
		if(email=='')
		{
			$('#error-box').fadeIn('slow').html('Please enter your email.');
		}
		else if (!email.match(/^([a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,4}$)/i))
		{
			$('#error-box').fadeIn('slow').html('Enter valid email address.');					  
		}
		else
		{
			$('#logo-div').hide();
			$("#anime-logo-div").css("display","inline");
			$('#error-box').fadeOut('slow')
			var formData = {email:email,prev_page:prev_page,is_ajax:1};
			submitresetinfo(formData);			
		}
		});
		function submitresetinfo(formData)
		{
				$.ajax({	
				type: 'POST',
				url: 'reset-password.php',		
				data: formData,
				success:function(response)
				{
				if(response)
				{
					window.location.reload();
				}
				else
				{
					$('#logo-div').show();
					$("#anime-logo-div").css("display","none");
					$('#error-box').html('There is no account under this email.').fadeIn('slow');
				}
				}
			});
			return false;
		}
		
	$('#reset-password-button').click(function(e) {
		e.preventDefault();
		var email=$('#email').val();
		var temp_pass=$('#temp-pass').val();
		var newpassword=$('#new-password').val();
		var prev_page=$('#prev-page').val();
		if(email=='' || temp_pass=='' || newpassword=='')
		{
			$('#error-box').fadeIn('slow').html('Please fill in all the details.');
		}
		else if(newpassword.length>16||newpassword.length<8)
		{
			$('#error-box').fadeIn('slow').html('Enter password between 8 and 20 characters.');
		}
		else
		{
			$('#logo-div').hide();
			$("#anime-logo-div").css("display","inline");
			$('#error-box').fadeOut('slow')
			var formData = {email:email,code:code,temp_pass:temp_pass,prev_page:prev_page,is_ajax:1};
			verifyinfo(formData);			
		}
		function verifyinfo(formData)
		{
				$.ajax({	
				type: 'POST',
				url: 'reset-password.php',		
				data: formData,
				success:function(response)
				{
				if(response === 'success')
				{
					window.location.reload();
				}
				else if(response === 'noaccount')
				{
					$('#error-box').html('There is no account under this email.').fadeIn('slow');
				}
				else if(response === 'nomatch')
				{
					$('#error-box').html('The temporary password does not match.').fadeIn('slow');
				}
				else
				{
					$('#logo-div').show();
					$("#anime-logo-div").css("display","none");
					$('#error-box').html('There is no account under this email.').fadeIn('slow');
				}
				}
			});
			return false;
		}
	});
});

</script>

</head>

<body>

<!----HEADER AREA---->
<div id="header">
	<header>
		<div id="logo-div">
        <a href="index.php"><img id="logo" alt="Zhuddle" src="images/zhuddle-logo.png" title="Zhuddle"/></a>
        </div>
        <div id="anime-logo-div">
        <a href="index.php"><img id="anime-logo" alt="Zhuddle" src="images/anime.gif" title="Zhuddle"/></a>
        </div>
	</header>
</div>

<!----MAIN AREA---->
<div id="main">
	<section>
    	<div id="main-box">
        </div>
			<div id="log-in">
            <?php
			if(isset($_SESSION['value']))
			{
				echo '<h2 class="page-labels">Forgot Password</h2>
				<form method="POST" id="log-in-form" action="reset-password.php" enctype="multipart/form-data">
				<p>HEEEHEADSAFASFFAS</p>
				<label class="labels">Email</label><input type="text" class="text-box" autocomplete="off" name="email" id="email" />
                <label class="labels">Temporary Password</label><input type="text" class="text-box" autocomplete="off" name="temp-pass" id="temp-pass" />
                <label class="labels">New Password</label><input type="password" class="text-box" autocomplete="off" name="new-password" id="new-password" />
				<input type="hidden" value="1" id="prev-page" />
                <button type="submit" id="reset-password-button" name="submit" class="button">Submit</button>
				</form>';
				
			}
			else
			{
            	echo '<h2 class="page-labels">Forgot Password</h2>
                <form method="POST" id="log-in-form" action="reset-password.php" enctype="multipart/form-data">
                <p>Hello</p>
                <label class="labels">Email</label><input type="text" class="text-box" autocomplete="off" name="email" id="re-email" />
				<input type="hidden" value="0" id="prev-page" />
                <button type="submit" id="send-code-button" name="submit" class="button">Submit</button>
                </form>';
			}
            ?>
            </div>
            <div id="error-box">
    		</div>
   	</section>
</div>



<!----FOOTER AREA---->
<div id="footer">
	<div id="footer-content">
        	<ul class="footer-menu">
        		<li><a href="about/about.html">About</a></li>
                <li><a href="#">Developers</a></li>
                <li><a href="#">Privacy</a></li>
                <li><a href="#">Terms</a></li>
                <li><a href="#">Contact</a></li>	
                <li><a href="#">Advertise</a></li>	
                <li><a href="#">Cookies</a></li>
                <li><a href="#">Help</a></li>		
        	</ul>
	</div>
</div>

</body>
</html>