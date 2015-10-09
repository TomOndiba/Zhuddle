<?php
include("search.php");
$id=$_GET['id'];
autoSuggest($_GET['query'],$id);
?>
	