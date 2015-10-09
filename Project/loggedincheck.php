<?php
include("mysql_connect.php");
?>
<?php
session_start();
//Checks whether the user is logged in or not
?>
<?php

  if(isset($_SESSION['email']))
  {
  
     $email=$_SESSION['email'];
	 
     }
	 
	 else
	 
	 {  
	      header("location:index.php");
	     
	    }
	?>