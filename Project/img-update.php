<?php
include("mysql_connect.php");
include("dbheader.php");
?>
<?php
sleep(1);
$is_ajax=$_REQUEST['is_ajax'];
if(isset($is_ajax) && $is_ajax)
{
		$email=$_SESSION['email'];
		$img_name=$_REQUEST['img_name'];
		$selquery='SELECT id FROM users WHERE EMAIL="'.$email.'"';
		$selresult=mysql_query($selquery);
		while($row=mysql_fetch_assoc($selresult))
		{
			$id=$row['id'];
		}
		$query='UPDATE users SET profile_pic="'.$img_name.'" where id="'.$id.'" ' ;
		$result=mysql_query($query);
		echo "success";
}
?>