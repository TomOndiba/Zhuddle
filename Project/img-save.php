<?php
include("dbheader.php");
$email=$_SESSION['email'];
$id=$_SESSION['id'];
$prev=$_SESSION['prev_page'];

if(isset($_SESSION['email']))

	 {
	 // echo"<meta http-equiv=\"refresh\"content=\"0;url=http://localhost/Project/home.php\">";
	 }
	 else
	 {
	    header("location:index.php");
	 }

	 $check_pic=mysql_query("SELECT * FROM users WHERE email='$email'");
	$get_pic_row=mysql_fetch_assoc($check_pic);

	$profile_pic_db=$get_pic_row['profile_pic'];


	if($profile_pic_db=="")
 	{
   		$profile_pic="";
   	}
   
   else
   {
     $profile_pic=$profile_pic_db;
	 }
	//$blank_img="images/blank.jpg";
	$temp_profile_pic=$get_pic_row['temp_profile_pic'];
	//if($temp_profile_pic=="")
	//{
	//	$temp_profile_pic=$blank_img;
	//}
    $targ_w = $targ_h = 300;
    $jpeg_quality = 100;

   
    $img_r = imagecreatefromjpeg($temp_profile_pic);
    $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

    imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
    $targ_w,$targ_h,$_POST['w'],$_POST['h']);
  	
    imagejpeg($dst_r,"$temp_profile_pic",$jpeg_quality);
	
	$profile_pic_name="$temp_profile_pic";
	$profile_pic_query=mysql_query("UPDATE users SET profile_pic='$profile_pic_name' WHERE email='$email'");
	if(true)
	{
	$delete_temp_profile_pic_query=mysql_query("UPDATE users SET temp_profile_pic='' WHERE email='$email'");
	}

require_once('jcrop_main.php');

if($prev==1)
{
	sleep(2);
	header("location:profile-setup.php");
}
else if($prev==2)
{
	sleep(2);
	header("location:profile.php");
}
else if($prev==3)
{
	sleep(2);
	header("location:home.php");
}
?>