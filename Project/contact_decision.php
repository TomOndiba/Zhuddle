<?php
include("loggedincheck.php");
$user_id=$_SESSION['id'];
$id=$_GET['id'];
$ques=$_POST['question'];
$x=$_POST['x'];

if (isset($_GET['id'])&& isset($_POST['accept_contact']))
{
	
	$id=$_GET['id'];
	$update_contact_list_1='SELECT * FROM users WHERE id="'.$user_id.'"';
	$result1=mysql_query($update_contact_list_1);
	 $totalrows2=mysql_num_rows($result1);
			 if($totalrows2>0)
			 {
				 while($row=mysql_fetch_array($result1))
				 {
					  $contact1.=$row['contact_list'];
				 }
			 }
	$add_contact=mysql_query("UPDATE users SET contact_list=CONCAT(contact_list,$id) WHERE id=$user_id");
   $add_contact_1=mysql_query("UPDATE users SET contact_list=CONCAT(contact_list,',') WHERE id=$user_id");
	
	$update_contact_list_2='SELECT * FROM users WHERE id="'.$id.'"';
	$result2=mysql_query($update_contact_list_2);
	 $totalrows3=mysql_num_rows($result2);
						   if($totalrows3>0)
						   {
							   while($row=mysql_fetch_array($result2))
							   {
								    $contact2.=$row['contact_list'];
							   }
						   }
	$add_contact_2=mysql_query("UPDATE users SET contact_list=CONCAT(contact_list,$user_id) WHERE id=$id");
	$add_contact_3=mysql_query("UPDATE users SET contact_list=CONCAT(contact_list,',') WHERE id=$id");

	$add_contact_4=mysql_query("UPDATE requests SET status='In-Contacts' WHERE id_to=$user_id AND id_from=$id");
	
	//For user system time
	
	$get_loc='SELECT location_country FROM user_general_info WHERE id="'.$user_id.'"';
	$get_loc_result=mysql_query($get_loc);

		date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d h:i:s');
	
	$responses_query="INSERT into responses (type,response,id_from,id_to,time,status) VALUES('Request-Response','Accepted','$id','$user_id',now(),'Unseen')";
	$responses_query_result=mysql_query($responses_query);
	
	if($ques==1)
	{
		header("location:view_contact.php?x=$x");
	}
	else
	header("location:contact_requests.php");
	
}
else if (isset($_GET['id'])&& isset($_POST['reject_contact']))
{
	$delete_request=mysql_query('DELETE from requests where id_to="'.$user_id.'" and id_from="'.$id.'"');
	if($ques==1)
	{
		header("location:view_contact.php?x=$x");
	}
	else
	header("location:contact_requests.php");
}
?>
