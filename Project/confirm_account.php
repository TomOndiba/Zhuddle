<?php
include("dbheader.php");
if(isset($_SESSION['email'])&&isset($_SESSION['name'])&&$_SESSION['state_id']==-1)
	 {
		 $query=mysql_query('SELECT * from verify where email="'.$_SESSION['email'].'"');
		 $row=mysql_fetch_assoc($query);
		 $encrypt=$row['verification_code'];
		 $state=$row['state'];
		 if($state==0)
		 {
	 // echo"<meta http-equiv=\"refresh\"content=\"0;url=http://localhost/Project/home.php\">";
			require_once('class.phpmailer.php');
			//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
			
			$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
			
			$mail->IsSMTP(); // telling the class to use SMTP
			
			try {
			  $mail->Host       = "smtp.gmail.com";		 // SMTP server
			  //$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
			  $mail->SMTPAuth   = true;                  // enable SMTP authentication
			  $mail->SMTPSecure = "ssl";
			  $mail->Host       = "smtp.gmail.com"; // sets the SMTP server
			  $mail->Port       = 465;                    // set the SMTP port for the GMAIL server
			  $mail->Username   = "zhuddle940@gmail.com"; // SMTP account username
			  $mail->Password   = "thesocialnetwork13";        // SMTP account password
			  $mail->FromName 	= "Zhuddle"; //name of sender
			  $mail->AddAddress($_SESSION['email'], $_SESSION['name']); // receiver
			  $mail->Subject 	= 'Welcome to Zhuddle'; //Mail subject
			  $mail->Body    	= 'Welcome to Zhuddle'.' '.$_SESSION['name'].' '.'Zhuddle is a social networking website which is a nice form of entertainment, great for meeting people with similar interests, and can be a very effective business technique for entrepreneurs, writers, actors, musicians or artists. Please enter the following verification code to confirm your account with Zhuddle: '.$encrypt.'. Thank you for signing up at Zhuddle.'; //Mail body
			  //$mail->MsgHTML(file_get_contents('contents.php'));
			  //$mail->AddAttachment('images/Koala.jpg');      // attachment
			  //$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
			  $mail->Send();
			$updatestatequery=mysql_query('UPDATE verify set state="1" where email="'.$email.'"');
			} catch (phpmailerException $e) {
			  echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
			  echo $e->getMessage(); //Boring error messages from anything else!
			}
		 }
		 else
		 {}
	 }
	 else if($_SESSION['state_id']==0)
	 {
	    	header("location:welcome.php");
	 }
	 else
	 {
	    header("location:index.php");
	 }
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
        <form method="post" action="verify.php" enctype="multipart/form-data">
            <p id="tags" class="labels">Welcome to Zhuddle</p>
            <div>
            <p class="p-class">A confirmation mail has been sent to your email account.<br />
Please enter the unique key in the textbox below for confirming your account with Zhuddle.</p>
            </div>
            <div id="verify-box">
            	<input type="text" class="text-box" name="verify-textbox" id="verify-textbox" autocomplete="off" />
                <input type="hidden" value="<?php echo $_SESSION['email'] ?>" name="useremail" />
            </div>
        <button type="submit" id="confirm-button" class="button" value="Confirm">Confirm</button>
        </form>
        </div>
        
	</section>
</div>


</body>
</html>
