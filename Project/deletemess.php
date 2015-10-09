<?php
sleep(1);
include("dbheader.php");
$user_id=$_SESSION['id'];
if (isset($_POST['deleteBtnSent'])) {
	
	  if(isset($_POST['value']))
	    {
			
	$value=$_POST['value'];
    foreach ($value as  $item) {
	$delete=mysql_query("DELETE FROM private_messages where id='".$item."'");
	
		   }
		   
	     header("location:inbox.php");
	
		}
	
	else
	{
		header("location:inbox.php");
	}
	
		   		
		

    
	
}