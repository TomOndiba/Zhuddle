<?php
include("mysql_connect.php");
include("dbheader.php");

if(isset($_POST['id']))
{
	$id=$_POST['id'];
	$query='UPDATE responses set status="Seen" where id_from="'.$id.'"';
	$result=mysql_query($query);
	//header("location:responses.php");
}
?>