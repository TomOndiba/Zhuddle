<?php
include("mysql_connect.php");
include("dbheader.php");
?>

<?php
sleep(1);
$code=$_POST['verify-textbox'];
$email=$_POST['useremail'];

	$info_query=mysql_query('SELECT * from users where email="'.$email.'"');
	$row=mysql_fetch_assoc($info_query);
	$id=$row['id'];
	$dbpassword=$row['password'];
	$query=mysql_query('SELECT * from verify where email="'.$email.'"');
	$row1=mysql_fetch_assoc($query);
	$encrypt=$row1['verification_code'];
		if($code==$encrypt)
		{
			$state=0;
			$logquery='INSERT INTO log values("'.$id.'","'.$email.'",0,0)';
			$logresult=mysql_query($logquery);
			$updatestate='UPDATE users set state="'.$state.'" where id="'.$id.'"';
			$updatestateresult=mysql_query($updatestate);
			$_SESSION['password']=$dbpassword;
			$_SESSION['state_id']=$state;
			 header("location:welcome.php");
		}
		else
		{
			 header("location:confirm_account.php");
		}
?>