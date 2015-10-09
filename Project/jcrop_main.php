<?php
include("dbheader.php");
$email=$_SESSION['email'];
$prev=$_SESSION['prev_page'];
//$id=$_SESSION['id'];
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
	$id=$get_pic_row['id'];
	$temp_profile_pic=$get_pic_row['temp_profile_pic'];
	if($profile_pic_db=="")
 	{
   		$profile_pic="";
   	}
   else
   {
     $profile_pic=$profile_pic_db;
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Profile Picture</title>
<link rel="Shorcut Icon" href="zhuddle_icon_small.ico">
<link rel="stylesheet" type="text/css" href="stylesheet/stylesheet1.css" />
<link rel="stylesheet" href="stylesheet/jquery.ui.theme.css" type="text/css" />
<link rel="stylesheet" href="stylesheet/jquery.ui.accordion.css" type="text/css" />
<link rel="stylesheet" href="stylesheet/jquery.Jcrop.css" type="text/css" />
<link rel="stylesheet" href="stylesheet/jcrop_main.css" type="text/css" />

<noscript>
	<style type="text/css">
            #main {display:none;}
    </style>
    <meta http-equiv="refresh" content="0;url=logout.php">
</noscript>

<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.widget.js"></script>
<script src="js/jquery.ui.accordion.js"></script>
<script src="js/jquery.Jcrop.min.js"></script>
<script type="text/javascript" src="js/profile-change.js"></script>
<script src="js/jcrop_main.js"></script>

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

<div id="main">
<section>
<div id="main-box">
       <div id="overlay">
     		<div id="overlay-inside">
                <p id="reply-label" class="labels">Image Cropping</p>
            	<form method="post" action="img-save.php" onSubmit="return checkCoords();">
            	<div id="orig-img">
                	<img src="<?php echo $temp_profile_pic;?>" id="cropbox1" />
                </div>
          		<div style="margin:5px;">
                    <label>X1 <input type="hidden" name="x" id="x" size="4" /></label>
                    <label>Y1 <input type="hidden" name="y" id="y" size="4"/></label>
                    <label>X2 <input type="hidden" name="x2" id="x2" size="4"/></label>
                    <label>Y2 <input type="hidden" name="y2" id="y2" size="4"/></label>
                    <label>W <input type="hidden" name="w" id="w" size="4"/></label>
                    <label>H <input type="hidden" name="h" id="h" size="4"/></label>
                </div>
                    <button type="submit" id="image-save" value="Save" class="button">Save</button>
                    <?php
				if($prev==1)
				{
          			echo "<button type=button class=button id=cancel-prev-1 value=Cancel>Cancel</button>";
				}
				else if($prev==2)
				{
					echo "<button type=button class=button id=cancel-prev-2 value=Cancel>Cancel</button>";
				}
				else if($prev==3)
				{
					echo "<button type=submit class=button id=cancel-prev-3 value=Cancel>Cancel</button>";
				}
				?>
                <div id="image-crop-box">
                	Please select a crop region.
                </div>
                </form>
    		</div>
	</div>
</div>
</section>


</div>
</body>
</html>

            

