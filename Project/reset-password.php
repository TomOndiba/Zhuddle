<?php
include("mysql_connect.php");
include("dbheader.php");
?>

<?php

sleep(1);
$is_ajax=$_REQUEST['is_ajax'];
$prev_page=$_REQUEST['prev_page'];
if(isset($is_ajax) && $is_ajax && isset($prev_page))
{
	if($prev_page==0)
	{
		$email=trim($_REQUEST['email']);
		$random=random_string();
		$query='SELECT * FROM users where email="'.$email.'"';
		$result=mysql_query($query);
		if(mysql_num_rows($result)>=1)
		{
			$query2='SELECT * FROM verify where email="'.$email.'"';
			$result2=mysql_query($query2);
			while($row=mysql_fetch_assoc($result2))
			{
				$num_times=$row['num_times'];
			}
			$incr_num_times=$num_times+1;
			$query3='UPDATE verify SET num_times="'.$incr_num_times.'",temp_password="'.$random.'" where email="'.$email.'"';
			$result3=mysql_query($query3);
			$_SESSION['value']=$email;
			echo "success";
		}
	}
	else if($prev_page==1)
	{
		$email=trim($_REQUEST['email']);
		$temp_pass=trim($_REQUEST['temp_pass']);
		$newpassword=trim($_REQUEST['newpassword']);
		$query='SELECT * from verify where email="'.$email.'"';
		$result=mysql_query($query);
		if(mysql_num_rows($result)>=1)
		{
			while($row=mysql_fetch_assoc($result))
			{
				$dbtemp=$row['temp_password'];
			}
			if($temp_pass==$dbtemp)
			{
				$query2='SELECT * from users where email="'.$email.'"';
				$result2=mysql_query($query2);
				while($row2=mysql_fetch_assoc($result2))
				{
					$id=$row2['id'];
					$name=$row2['f_name'].$row2['l_name'];
				}
				$query3='UPDATE users set password="'.$newpassword.'" where email="'.$email.'"';
				$result3=mysql_query($query3);
				echo "success";
				$_SESSION['value']='';
				$_SESSION['id']=$id;
				$_SESSION['email']=$email;
				$_SESSION['name']=$name;
				$_SESSION['password']=$newpassword;
			}
			else
			echo "nomatch";
		}
		else
		echo "noaccount";
	}
}
else if(isset($is_ajax) && $is_ajax)
{
	$email=$_SESSION['email'];
	$existing_password=$_REQUEST['existing_password'];
	$new_password=$_REQUEST['new_password'];
	echo change_password($existing_password,$new_password,$email);
}

function change_password($existing_password,$new_password,$email)
{
	$query='SELECT * from users where email="'.$email.'"';
	$result=mysql_query($query);
	if(mysql_num_rows($result)>=1)
	{
		while($row=mysql_fetch_assoc($result))
		{
			$password=$row['password'];
		}
		if($existing_password==$password)
		{
			$change_password_query='UPDATE users set password="'.$new_password.'" where email="'.$email.'"';
			$change_password_result=mysql_query($change_password_query);
			return "success" ;
		}
	}
}

function random_string()
{
    $character_set_array = array();
    $character_set_array[] = array('count' => 6, 'characters' => 'abcdefghijklmnopqrstuvwxyz');
    $character_set_array[] = array('count' => 1, 'characters' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
    $character_set_array[] = array('count' => 2, 'characters' => '0123456789');
    $character_set_array[] = array('count' => 1, 'characters' => '!@#$+-*&?:');
    $temp_array = array();
    foreach ($character_set_array as $character_set) {
        for ($i = 0; $i < $character_set['count']; $i++) {
            $temp_array[] = $character_set['characters'][rand(0, strlen($character_set['characters']) - 1)];
        }
    }
    shuffle($temp_array);
    return implode('', $temp_array);
}
?>