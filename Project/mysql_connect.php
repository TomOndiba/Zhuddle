<?php

$db_server = mysql_connect("localhost","root","");
 	if(!$db_server)
 	{
		die("Unable to connect to mysql:".mysql_error());
 	}
 	mysql_select_db("zhuddle") or die("unable to find the database".mysql_error());

?>