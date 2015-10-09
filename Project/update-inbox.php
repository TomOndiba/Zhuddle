<?php
include("mysql_connect.php");
include("dbheader.php");

if(isset($_POST['reply_id'])&&isset($_POST['user_id']))
{
	$userid=$_POST['user_id'];
	$messid=$_POST['reply_id'];
	$seltime='SELECT min(time_sent) from private _messages where id="'.$messid.'"';
	$resseltime=mysql_query($seltime);
	while($row=mysql_fetch_assoc($resseltime))
	{
		$min_time_sent=$row['min(time_sent)'];
	}
	$selstatus='SELECT Rstatus from private_messages where id="'.$messid.'" AND time_sent="'.$min_time_sent.'"';
	$resselstatus=mysql_query($selstatus);
	while($row=mysql_fetch_assoc($resselstatus))
	{
		$currentstatus=$row['Rstatus'];
	}
	if($currentstatus=='Seen')
	{
	}
	else
	{
		$selmaxtime='SELECT max(time_sent) from private_messages where id="'.$messid.'"';
		$resselmaxtime=mysql_query($selmaxtime);
		while($row=mysql_fetch_assoc($resselmaxtime))
		{
			$max_time_sent=$row['max(time_sent)'];
		}
		$selmaxval='SELECT * from private_messages where id="'.$messid.'" and time_sent="'.$max_time_sent.'"';
		$resselmaxval=mysql_query($selmaxval);
		while($row=mysql_fetch_assoc($resselmaxval))
		{
			$max_id_from=$row['id_from'];
		}
		if($max_id_from==$userid)
		{
		}
		else
		{
		$updatemessstatus='UPDATE private_messages set Rstatus="Seen" where id="'.$messid.'"';
		$result=mysql_query($updatemessstatus);
		}
	}
}
?>