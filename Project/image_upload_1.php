<?php
sleep(1);
include("dbheader.php");
if(isset($_SESSION['email']))

	 {
	 // echo"<meta http-equiv=\"refresh\"content=\"0;url=http://localhost/Project/home.php\">";
	 }
	 else
	 {
	    header("location:index.php");
	 }
	 $email=$_SESSION['email'];
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

	$query='SELECT id FROM users WHERE EMAIL="'.$_SESSION['email'].'"';
		 $result=mysql_query($query);
		 while($row=mysql_fetch_assoc($result))
		 {
			$id=$row['id'];
		 }
		 
		$custquery='SELECT * from customize where id="'.$id.'"';
		 $custresult=mysql_query($custquery);
		 $custcount=mysql_num_rows($custresult);
		 while($row=mysql_fetch_assoc($custresult))
		 {
			 $bgcolor=$row['bg_color'];
			 $headercolor=$row['header_color'];
			 $bgimage=$row['bg_image'];
		 }
?>
<?php
include("mysql_connect.php");
$query='SELECT id FROM users WHERE EMAIL="'.$_SESSION['email'].'"';
		 $result=mysql_query($query);
		 while($row=mysql_fetch_assoc($result))
		 {
			$id=$row['id'];
		 }
$wmax="";
$hmax="";
$prev=$_POST['question'];

$fileName = $_FILES['uploaded_file']['name']; // The file name
$fileTmpLoc = $_FILES['uploaded_file']['tmp_name']; // File in the PHP tmp folder
$fileType = $_FILES['uploaded_file']['type']; // The type of file it is
$fileSize = $_FILES['uploaded_file']['size']; // File size in bytes
$fileErrorMsg = $_FILES['uploaded_file']['error']; // 0 = false | 1 = true
$kaboom = explode(".", $fileName); // Split file name into an array using the dot
$fileExt = end($kaboom); // Now target the last array element to get the file extension
// START PHP Image Upload Error Handling --------------------------------------------------
if (!$fileTmpLoc) { // if file not chosen
    //echo "ERROR: Please browse for a file before clicking the upload button.";
	$x=1;
    //exit();
} else if($fileSize > 5242880) { // if file size is larger than 5 Megabytes
    //echo "ERROR: Your file was larger than 5 Megabytes in size.";
	$x=2;
    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
    //exit();
} else if (!preg_match("/.(jpg)$/i", $fileName) ) {
     // This condition is only if you wish to allow uploading of specific file types    
     //echo "ERROR: Your image was not .gif, .jpg, or .png.";
	 $x=3;
     unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
     //exit();
} else if ($fileErrorMsg == 1) { // if file upload error key is equal to 1
    //echo "ERROR: An error occured while processing the file. Try again.";
	$x=4;
    //exit();
}
else
{
	$folderpath="uploads/".$id;
	if ( ! is_dir($folderpath))
	{
		mkdir("$folderpath",0700);
	}
	
	$moveResult = move_uploaded_file($fileTmpLoc, "$folderpath/$fileName");
	$wmax=200;
	$hmax=150;
	$profile_pic_name="$folderpath/$fileName";
	$profile_pic_query=mysql_query("UPDATE users SET temp_profile_pic='$profile_pic_name' WHERE email='$email'");
	$check_pic=mysql_query("SELECT * FROM users WHERE email='$email'");
	$get_pic_row=mysql_fetch_assoc($check_pic);
	$temp_profile_pic_db=$get_pic_row['temp_profile_pic'];
	$img_r = imagecreatefromjpeg($temp_profile_pic_db);
	$source_imagex = imagesx($img_r);
	$source_imagey = imagesy($img_r);
	
if($source_imagex>550)
	{
		$dest_imagex=$source_imagex;
		$ratiow=$dest_imagex/550;
		$dest_imagex=$dest_imagex/$ratiow;
		$dest_imagey=$source_imagey;
		$dest_imagey=$dest_imagey/$ratiow;
	}
if($source_imagey>400)
	{
		$dest_imagey=$source_imagey;
		$ratioh=$dest_imagey/400;
		$dest_imagey=$dest_imagey/$ratioh;
		$dest_imagex=$source_imagex;
		$dest_imagex=$dest_imagex/$ratioh;
}
	$dest_image=ImageCreateTrueColor( $dest_imagex, $dest_imagey );
	imagecopyresampled($dest_image, $img_r, 0, 0, 0, 0, $dest_imagex, 
				$dest_imagey, $source_imagex, $source_imagey);
	//header("Content-Type: image/jpeg");
	imagejpeg($dest_image,"$folderpath/$fileName",100);
	
// Check to make sure the move result is true before continuing
if ($moveResult != true) {
    //echo "ERROR: File not uploaded. Try again.";
	$x=5;
	
    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder to save space
    //exit();
}
 // Remove the uploaded file from the PHP temp folder
// Display things to the page so you can see what is happening for testing purposes
$_SESSION['prev_page']=$prev;
header("location:jcrop_main.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Image Upload</title>
<link rel="stylesheet" type="text/css" href="stylesheet/stylesheet1.css" />
<link rel="Shorcut Icon" href="zhuddle_icon_small.ico">

<noscript>
	<style type="text/css">
            #main {display:none;}
    </style>
    <meta http-equiv="refresh" content="0;url=logout.php">
</noscript>

<script type="text/javascript" language="javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="js/profile-change.js"></script>

<script type="text/javascript">
        $(document).ready(function(){
			$("#close-prev-1,#close-prev-2,#close-prev-3").click(function()
			{
				$('#logo-div').hide();
				$("#anime-logo-div").css("display","inline");
			});
		});
</script>

</head>

<?php
if($custcount==0)
echo '<body>';
else
{
	echo '<body style="background-color:'.$bgcolor.'">';
}
?>
<div id="stage">
	<img src="<?php echo $bgimage ?>" alt="sitebackground" />
</div>
<!----HEADER AREA---->
<?php
if($custcount==0)
echo '<div id="header">';
else
echo '<div id="header" style="background-color:'.$headercolor.'">';
?>
	<div id="header-container">
		<div id="logo-div">
        <a href="home.php"><img id="logo" alt="Zhuddle" src="images/zhuddle-logo.png" title="Zhuddle"/></a>
        </div>
        <div id="anime-logo-div">
        <a href=""><img id="anime-logo" alt="Zhuddle" src="images/anime.gif" title="Zhuddle"/></a>
        </div>
        <div id="icons">
        <a href="logout.php" class="icon">
        	<img id="log-out-icon" src="images/logout.png" alt="Log Out" title="Log Out" />
        </a>
        </div>
	</div>
</div>

<!----MAIN AREA---->
<div id="main">
<section>
<div id="main-box">
		
       <div id="overlay">
     		<div id="overlay-inside">
                <p id="reply-label" class="labels">Image Upload</p>
            	<form enctype="multipart/form-data" method="post" action="image_upload_1.php">
            	<div id="orig-img">
                </div>
          		<input name="uploaded_file" type="file" id="image2" class="filebutton" />
                <button type="submit" class="button" id="upload" value="Upload">Upload</button>
                <input type="hidden" name="question" value=<?php echo $prev?>>
                <?php
				if($prev==1)
				{
          			echo "<button type=button class=button id=close-prev-1 value=Close>Close</button>";
				}
				else if($prev==2)
				{
					echo "<button type=button class=button id=close-prev-2 value=Close>Close</button>";
				}
				else if($prev==3)
				{
					echo "<button type=button class=button id=close-prev-3 value=Close>Close</button>";
				}
				?>
                <div id="image-error-box">
                <?php 
				if($x==1)
				{
					echo "Please select a file before clicking the upload button.";
				}
				else if($x==2)
				{
					echo "Your file was larger than 5 Megabytes in size.";
				}
				else if($x==3)
				{
					echo "Your image was not .jpg.";
				}
				else if($x==4)
				{
					echo "An error occured while processing the file. Try again.";
				}
				else if($x==5)
				{
					echo "File not uploaded. Try again.";
				}
				?>
    			</div>
                </form>
    		</div>
	</div>
</div>
</section>
</div>

</body>
</html>
<?php if($x==1)
{
	exit();
}
else if($x==2)
{
	exit();
}
else if($x==3)
{
	exit();
}
else if($x==4)
{
	exit();
}
else if($x==5)
{
	exit();
}
?>
