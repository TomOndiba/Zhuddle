<?php
include("dbheader.php");
$prev=$_REQUEST['prev_page'];
$email=$_SESSION['email'];
$query='SELECT id FROM users WHERE EMAIL="'.$email.'"';
$result=mysql_query($query);
while($row=mysql_fetch_assoc($result))
{
	$id=$row['id'];
}
$selquery='SELECT * from customize where id="'.$id.'"';
$selresult=mysql_query($selquery);
while($row=mysql_fetch_assoc($selresult))
{
	$bgimage=$row['bg_image'];
}
unlink($bgimage);
$updatequery=mysql_query('UPDATE customize set bg_image="" where id="'.$id.'"');
if($prev==1)
{
	sleep(1);
	echo "successprofilesetup";
}
else if($prev==2)
{
	sleep(1);
	echo "successprofile";
}
else if($prev==3)
{
	sleep(1);
	echo "successhome";
}

?>
