<?php
include("mysql_connect.php");
include("dbheader.php");
?>
<?php
sleep(1);
$is_ajax=$_REQUEST['is_ajax'];
if(isset($is_ajax) && $is_ajax)
{
	$db="";
	$dbpassword="";
	$dbname="";
	$id="";
	$state="";
	$gender="";
	$emailid=trim($_REQUEST['logemail']);
	$password=trim($_REQUEST['logpassword']);
	if($emailid && $password)
	{
		if($emailid=="prannoy876@gmail.com" && $password=="admin1234")
		{
			  echo "successadmin";
			  exit(0);
		}
			else
			{
			$query='SELECT * FROM users WHERE EMAIL="'.$emailid.'"';
			$result=mysql_query($query);
	 	 	$numrows=mysql_num_rows($result);
	  			if($numrows!=0)
	  			{
	     			while($row=mysql_fetch_assoc($result))
		 			{
		    			$db=$row['email'];
						$dbpassword=$row['password'];
						$fdbname=$row['f_name'];
						$ldbname=$row['l_name'];
						$id=$row['id'];
						$gender=$row['gender'];
						$state=$row['state'];
					}
					$dbname=$fdbname." ".$ldbname;
					if($emailid==$db && $password==$dbpassword && $state==0)
			  		{    
						$_SESSION['id']=$id;
				   		$_SESSION['email']=$db;
						$_SESSION['gender']=$gender;
						$_SESSION['name']=$dbname;
						$_SESSION['password']=$dbpassword;
						$_SESSION['state_id']=$state;
						echo "successwelcome";
			   		}
					else if($emailid==$db && $password==$dbpassword && $state==1)
					{
						$_SESSION['id']=$id;
				   		$_SESSION['email']=$db;
						$_SESSION['name']=$dbname;
						$_SESSION['password']=$dbpassword;
						$_SESSION['state_id']=$state;
						echo "successhome";
					}
					else if($emailid==$db && $password==$dbpassword && $state==-1)
					{
				   		$_SESSION['email']=$db;
						$_SESSION['name']=$dbname;
						$_SESSION['state_id']=$state;
						echo "successconfirm";
					}
				}
			}
	}
}

?>