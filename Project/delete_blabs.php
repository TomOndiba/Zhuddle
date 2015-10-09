<?php
include("loggedincheck.php");
$delete="";
if($_POST)
 {
	 if($_POST['blab_to_delete'])
	   {
		   $delete=$_POST['blab_to_delete'];
		   $query_delete=mysql_query("DELETE FROM blabs WHERE blab_id=$delete");
		   $query_comments=mysql_query("DELETE FROM comments WHERE id_blab=$delete");
		   $resp_delete=mysql_query("DELETE FROM responses WHERE type='Blab-Comment' and response=$delete");
	   }
	   else
	   {
	   }
 }
 else
 {
 }