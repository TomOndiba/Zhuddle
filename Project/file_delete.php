<?php
include("mysql_connect.php");
include("dbheader.php");
?>
<?php
sleep(1);
$is_ajax=$_REQUEST['is_ajax'];
if(isset($is_ajax) && $is_ajax)
{
	$prev_page=$_REQUEST['prev_page'];
	$image_name=$_REQUEST['image_name'];
	unlink($image_name);
	$temp_query='UPDATE users set temp_profile_pic="" where id="'.$_SESSION['id'].'"';
	$temp_query_result=mysql_query($temp_query);
	if($prev_page==1)
	{
		echo "success1";
	}
	else if($prev_page==2)
	{
		echo "success2";
	}
	else
	echo "success3";
}