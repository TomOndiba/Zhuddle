<?php
include("loggedincheck.php");
$delete="";
if($_POST)
 {
	 if($_POST['comm_to_delete'])
	 
	   {
		   $delete_comm=$_POST['comm_to_delete'];
		   $query_delete=mysql_query("DELETE FROM comments WHERE comm_id=$delete_comm");
	   }
	   else
	   {
	   }
 }
 else
 {
 }