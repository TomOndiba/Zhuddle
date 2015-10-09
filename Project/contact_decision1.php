<?php
include("loggedincheck.php");
$user_id=$_SESSION['id'];
$id=$_POST['id'];

if (isset($_POST['id'])&& isset($_POST['accept_friend']))
{
	$id=$_POST['id'];
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

	header("location:profile-view.php?id=$id");
	
	$add_contact_4=mysql_query("UPDATE requests SET status='In-Contacts' WHERE id_to=$user_id AND id_from=$id");
}
?>
