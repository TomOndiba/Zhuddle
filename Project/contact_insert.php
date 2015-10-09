<?php
include("dbheader.php");
$id=$_REQUEST['id'];
$email1=$_SESSION['email'];
	  $query1='SELECT id from users where email="'.$email1.'"';
	  $query_result1=mysql_query($query1);
	  while($row=mysql_fetch_assoc($query_result1))
		 {
			$user_id=$row['id'];
		 }

if(isset($_REQUEST['id']) && isset($_SESSION['email']))
{
		$query='INSERT INTO requests VALUES("'.$user_id.'","'.$id.'","Request-Sent")';
		$result1=mysql_query($query);
}
?>