<?php
include("mysql_connect.php");
include("dbheader.php");
?>

<?php
sleep(1);
$dbpassword="";
$fname=trim($_POST['fname']);
$lname=trim($_POST['lname']);
$email=trim($_POST['signupemail']);
$password=trim($_POST['signuppassword']);
$gender=trim($_POST['signupgender']);
$dbname=$fname." ".$lname;
$error_message = "";
$join_date = date("Y/m/d");
$state=-1;

	$query1='SELECT * FROM users WHERE EMAIL="'.$email.'"';
	$result1=mysql_query($query1);
	if(mysql_num_rows($result1)>=1)
	{
		$error_message.="An account already exists under this email.";
	}

	if (!empty($error_message))
	{
		$return['error'] = true;
		$return['msg'] = "".$error_message;					
		echo json_encode($return);
		exit();
	}
	else {
							  
			$return['error'] = false;
			$return['msg'] = ""; 
			echo json_encode($return);
			$query='INSERT INTO users VALUES("","'.$join_date.'","'.$fname.'","'.$lname.'","'.$email.'","'.$password.'","'.$gender.'","'.$state.'","","","")';
			$result=mysql_query($query);
			$encrypt=md5($dbname);
			$verifyquery='INSERT INTO verify values("'.$email.'","'.$encrypt.'","0","","0")';
			$verifyqueryresult=mysql_query($verifyquery);
			$_SESSION['name']=$dbname;
			$_SESSION['email']=$email;
			$_SESSION['gender']=$gender;
			$_SESSION['state_id']=$state;
	}
	
if(!$result) die("Database access failed".mysql_error());
if(!$result1) die("Database access failed".mysql_error());
?>