<?php
include("dbheader.php");
$id=$_REQUEST['id'];
$email1=$_SESSION['email'];
	  $query1='SELECT * from users where email="'.$email1.'"';
	  $query_result1=mysql_query($query1);
	  while($row=mysql_fetch_assoc($query_result1))
		 {
			$user_id=$row['id'];
			$contact_list=$row['contact_list'];
		 }
		$query2='SELECT * from users where id="'.$id.'"';
	  $query_result2=mysql_query($query2);
	  while($row=mysql_fetch_assoc($query_result2))
		 {
			$contact_list2=$row['contact_list'];
		 } 

if(isset($_REQUEST['id']) && isset($_SESSION['email']))
{
		$query='DELETE from requests where (id_from="'.$user_id.'"and id_to="'.$id.'") or (id_from="'.$id.'"and id_to="'.$user_id.'")';
		$result1=mysql_query($query);
		//Remove from current users contacts
		$contacts=explode(",",$contact_list);
		$contacts2=explode(",",$contact_list2);
		for($i=0;$i<count($contacts);$i++)
		{
			if($contacts[$i]==$id)
			{
				unset($contacts[$i]);
				$updated_list=array_values($contacts);
			}
		}
		$columns = implode(",",array_keys($updated_list));
		$escaped_values = array_map('mysql_real_escape_string', array_values($updated_list));
		$values  = implode(",", $escaped_values);
		
		$contacts_update_query='UPDATE users SET contact_list="'.$values.'" where id="'.$user_id.'"';
		$contacts_update_query_result=mysql_query($contacts_update_query);
		//Remove from others contacts
		for($i=0;$i<count($contacts2);$i++)
		{
			if($contacts2[$i]==$user_id)
			{
				unset($contacts2[$i]);
				$updated_list2=array_values($contacts2);
			}
		}
		$columns2 = implode(",",array_keys($updated_list2));
		$escaped_values2 = array_map('mysql_real_escape_string', array_values($updated_list2));
		$values2  = implode(",", $escaped_values2);
		
		$contacts_update_query2='UPDATE users SET contact_list="'.$values2.'" where id="'.$id.'"';
		$contacts_update_query_result2=mysql_query($contacts_update_query2);
}
?>