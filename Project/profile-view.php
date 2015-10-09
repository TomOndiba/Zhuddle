<?php
sleep(1);
include("dbheader.php");
$email1=$_SESSION['email'];
$state="";

if(isset($_GET['id'])&& $_SESSION['state_id']==1)
  {
	  $id=$_GET['id'];
	  $query1='SELECT id from users where email="'.$email1.'"';
	  $query_result1=mysql_query($query1);
	  while($row=mysql_fetch_assoc($query_result1))
		 {
			$user_id=$row['id'];
		 }
	  
	  $query='SELECT email from users where id="'.$id.'"';
	  $query_result=mysql_query($query);
	  while($row=mysql_fetch_assoc($query_result))
		 {
			$view_email=$row['email'];
		 }
		 $general_info_query='SELECT * FROM user_general_info WHERE id="'.$id.'"';
		 $general_info_query_result=mysql_query($general_info_query);
		 while($row=mysql_fetch_assoc($general_info_query_result))
		 {
			$name=$row['name'];
			$gender=$row['gender'];
			$dob=$row['dob'];
			$loc_country=$row['location_country'];
			$loc_city=$row['location_city'];
			$prof=$row['profession'];
			$rel=$row['relation'];
			$about_self=$row['about_self'];
		}
		$contact_info_query='SELECT * FROM user_contact_info WHERE email="'.$view_email.'"';
		 $contact_info_query_result=mysql_query($contact_info_query);
		 while($row=mysql_fetch_assoc($contact_info_query_result))
		 {
			$phoneno=$row['phone_no'];
			$mobileno=$row['mobile_no'];
			$website=$row['website'];
		}
  }
else if(isset($_SESSION['email'])&& $_SESSION['state_id']==1)
   
	 {
		 $query='SELECT id FROM users WHERE EMAIL="'.$_SESSION['email'].'"';
		 $result=mysql_query($query);
		 while($row=mysql_fetch_assoc($result))
		 {
			$id=$row['id'];
		 }
		 $general_info_query='SELECT * FROM user_general_info WHERE id="'.$id.'"';
		 $general_info_query_result=mysql_query($general_info_query);
		 while($row=mysql_fetch_assoc($general_info_query_result))
		 {
			$name=$row['name'];
			$gender=$row['gender'];
			$dob=$row['dob'];
			$loc_country=$row['location_country'];
			$loc_city=$row['location_city'];
			$prof=$row['profession'];
			$rel=$row['relation'];
			$about_self=$row['about_self'];
		}
		$contact_info_query='SELECT * FROM user_contact_info WHERE email="'.$email1.'"';
		 $contact_info_query_result=mysql_query($contact_info_query);
		 while($row=mysql_fetch_assoc($contact_info_query_result))
		 {
			$phoneno=$row['phone_no'];
			$mobileno=$row['mobile_no'];
			$website=$row['website'];
		}
	 // echo"<meta http-equiv=\"refresh\"content=\"0;url=http://localhost/Project/home.php\">";
	 }
	 else if(isset($_SESSION['email'])&& $_SESSION['state_id']==-1)
	 {
	    header("location:confirm_account.php");
	 }
	 else
	 {
	    header("location:index.php");
	 }
	 $check_pic=mysql_query("SELECT * FROM users WHERE id='$id'");
	$get_pic_row=mysql_fetch_assoc($check_pic);

	$profile_pic_db=$get_pic_row['profile_pic'];
   $custquery='SELECT * from customize where id="'.$id.'"';
   $custresult=mysql_query($custquery);
   $custcount=mysql_num_rows($custresult);
   while($row=mysql_fetch_assoc($custresult))
   {
	   $bgcolor=$row['bg_color'];
	   $headercolor=$row['header_color'];
		$bgimage=$row['bg_image'];
   }
		 $viewsquery='SELECT * FROM user_views_info where id="'.$id.'"';
		 $viewsresult=mysql_query($viewsquery);
		 $viewscount=mysql_num_rows($viewsresult);
		 while($row=mysql_fetch_assoc($viewsresult))
		 {
			 $personal_view=$row['personal_view'];
			 $social_view=$row['social_view'];
			 $cultural_view=$row['cultural_view'];
			 $political_view=$row['political_view'];
		 }
		 
	if($profile_pic_db=="")
 	{
   		$profile_pic="";
   	}
   else
   {
     $profile_pic=$profile_pic_db;
	 }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Profile</title>
<link rel="stylesheet" type="text/css" href="stylesheet/stylesheet1.css" />
<link rel="Shorcut Icon" href="zhuddle_icon_small.ico">

<noscript>
	<style type="text/css">
            #main {display:none;}
    </style>
    <meta http-equiv="refresh" content="0;url=logout.php">
</noscript>

<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/search_func.js"></script>
<script type="text/javascript" language="javascript" src="js/search-empty.js"></script>
<script type="text/javascript" src="js/photoZoom.min.js"></script>
<script type="text/javascript" src="js/profile-update.js"></script>

<script type="text/javascript">
        $(document).ready(function(){
           $("#profile-pic").photoZoom();
        });
</script>


<script type="text/javascript">
$(document).ready(function()
{
	$("#profile-view-error-box").hide();
	$("#interactionResults").hide();
	$("#overlay-for-contacts").hide();
	$("#overlay-for-message").hide();
	$("#messaging-container").hide();
	$(".newbutton").click(function(e)
	{
	    e.preventDefault();
		$("#overlay-for-contacts").fadeIn("slow");
		$(".newbutton").hide();

	   var id=$(this).attr('id');
		$.ajax({
		type:'GET',
		url:'contact_insert.php',
		data:{'id':id},
		});
	});
	
	$('#mscontent').focus(function()
	{
		$(this).css("background","#F0F0F0");
	});
	$('#mscontent').blur(function()
	{
		$(this).css("background","#cbcbcb");
	});
	
	$("#overlay-for-contacts .button").click(function(e)
	{
		if($(this).val()=='Close')
		e.preventDefault();
		$("#overlay-for-contacts").fadeOut("slow");
		window.location.reload(true);
	});

	$(".newbutton1").click(function(e)
	{
	    e.preventDefault();
		$("#overlay-for-contacts").fadeIn("slow");
		$("#overlay-for-contacts p").html("This person has been removed from your contacts.");

	   var id=$(this).attr('id');
		$.ajax({
		type:'GET',
		url:'contact_remove.php',
		data:{'id':id},
		});
	});
	
	$("#message-req").click(function(e)
	{
		$("#overlay-for-message").fadeIn("slow");
		$("#messaging-container").fadeIn("slow");
	});
	
	$("#close-message").click(function(e)
	{  
		$("#overlay-for-message").fadeOut("slow");
		$("#messaging-container").fadeOut("slow");
		$("#interactionResults").fadeOut("slow");
		window.location.reload();
	});
	
	$('#pmForm').submit(function(){$('input[type=submit]', this).attr('disabled', 'disabled');});	
	$(function() {
	 
	 $("#pmsubmit").click(function(e){
	    e.preventDefault();
      var pmSubject = $("#messubject");
	  var pmTextArea = $("#mscontent");
	  var sendername = $("#sender-name");
	  var senderid = $("#sender-id");
	  var recName = $("#reciever-name");
	  var recID = $("#reciever-id");
	  var pageID = $("#prev_page_id");
	 
      var url="private_msg_parse.php";
      if (pmSubject.val()=="") {
           $("#profile-view-error-box").html('Please type a subject.').fadeIn("slow");
      } else if (pmTextArea.val() == "") {
		   $("#profile-view-error-box").html('Please type in your message.').fadeIn("slow");
      } else {
		   $.post(url,{ subject: pmSubject.val(), message: pmTextArea.val(), senderName: sendername.val(), senderid: senderid.val(), rcpntName: recName.val(), recID: recID.val(), pageID: pageID.val()  } ,           function(data) {
			   $("#profile-view-error-box").css("border","#1F8532 inset 1px").css("color","#1F8532").html(data).fadeIn("slow");
			   $("#overlay-for-message").fadeOut(3000);
			   document.pmForm.messubject.value='';
			   document.pmForm.mscontent.value='';
			   $("#profile-view-error-box").fadeOut('slow')
           });
	  	}
	  });
});

// End Private Messaging stuff
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
{
echo '<div id="header" style="background-color:'.$headercolor.'">';
}
?>
	<div id="header-container">
		<div id="logo-div">
        <a href="home.php"><img id="logo" alt="Zhuddle" src="images/zhuddle-logo.png" title="Zhuddle"/></a>
        </div>
        <div id="anime-logo-div">
        <a href=""><img id="anime-logo" alt="Zhuddle" src="images/anime.gif" title="Zhuddle"/></a>
        </div>
         <div id="search-box">
	        <form class="form-wrapper cf" action="view_contact.php" method="get">
                    <input type="text" id="search-textbox" class="text-box" placeholder="Search..." name="x" onkeyup="autoSuggest()"/>
                <button type="submit" id="search-button"><img src="images/Search.png" height="25px"/></button>
                <input type="hidden" id="id-textbox" value="<?php echo $user_id?>"/>
            </form>
            <div id="autosuggest-container" >
 		</div>
         </div>
        <div id="icons">
        <a href="home.php" class="icon">
        	<img id="home-icon" src="images/home.png" alt="Home" title="Home"/>
        </a>
        <a href="profile.php" class="icon">
        	<img id="profile-icon" src="images/profile.png" alt="Profile" title="Profile"/>
        </a>
        <a href="logout.php" class="icon">
        	<img id="log-out-icon" src="images/logout.png" alt="Log Out" title="Log Out" />
        </a>
        </div>
	</div>
 <?php
	 $id2=$_GET['id'];
	 //$friend_check=mysql_query("SELECT * FROM friend_requests WHERE id_to='$id' AND id_from='$id1'");
	 //$numrows=mysql_num_rows($friend_check);
	 //$get_state=mysql_fetch_assoc($friend_check);
	 //$state=$get_state['state'];
	 $request_query=mysql_query('SELECT * from requests where id_from="'.$user_id.'" and id_to="'.$id2.'"');
	 $request_query1=mysql_query('SELECT * from requests where id_from="'.$id2.'" and id_to="'.$user_id.'"');
	 $numrows=mysql_num_rows($request_query);
	 $numrows1=mysql_num_rows($request_query1);
	 $get_state=mysql_fetch_assoc($request_query);
	 $status=$get_state['status'];
	 $get_state1=mysql_fetch_assoc($request_query1);
	 $status1=$get_state1['status'];
	  if($numrows==0)
	  {
		  if($numrows1==0)
		  {
			$privacy_info_query_everyone='SELECT * FROM user_privacy_info_everyone WHERE id="'.$id2.'"';
			$privacy_info_query_result=mysql_query($privacy_info_query_everyone);
			while($row=mysql_fetch_assoc($privacy_info_query_result))
				 {
					$dob_visibility=$row['dob_visibility'];
					$loc_visibility=$row['loc_visibility'];
					$prof_visibility=$row['prof_visibility'];
					$rel_visibility=$row['rel_visibility'];
					$about_self_visibility=$row['about_self_visibility'];
					$email_visibility=$row['email_visibility'];
					$phone_no_visibility=$row['phone_no_visibility'];
					$mobile_no_visibility=$row['mobile_no_visibility'];
					$website_visibility=$row['website'];
					$full=$row['full'];
				}
				$temp=0;
		  }
		  else if($status1=='Request-Sent')
		   {
		   $privacy_info_query_everyone='SELECT * FROM user_privacy_info_everyone WHERE id="'.$id2.'"';
			$privacy_info_query_result=mysql_query($privacy_info_query_everyone);
			while($row=mysql_fetch_assoc($privacy_info_query_result))
				 {
					$dob_visibility=$row['dob_visibility'];
					$loc_visibility=$row['loc_visibility'];
					$prof_visibility=$row['prof_visibility'];
					$rel_visibility=$row['rel_visibility'];
					$about_self_visibility=$row['about_self_visibility'];
					$email_visibility=$row['email_visibility'];
					$phone_no_visibility=$row['phone_no_visibility'];
					$mobile_no_visibility=$row['mobile_no_visibility'];
					$website_visibility=$row['website'];
					$full=$row['full'];
				}
			$temp=-2;
	   }
	   else if($status1=='In-Contacts')
		   {
			   $privacy_info_query_contacts='SELECT * FROM user_privacy_info_contacts WHERE id="'.$id2.'"';
			$privacy_info_query_result1=mysql_query($privacy_info_query_contacts);
		while($row=mysql_fetch_assoc($privacy_info_query_result1))
		 {
			$dob_visibility=$row['dob_visibility'];
			$loc_visibility=$row['loc_visibility'];
			$prof_visibility=$row['prof_visibility'];
			$rel_visibility=$row['rel_visibility'];
			$about_self_visibility=$row['about_self_visibility'];
			$email_visibility=$row['email_visibility'];
			$phone_no_visibility=$row['phone_no_visibility'];
			$mobile_no_visibility=$row['mobile_no_visibility'];
			$website_visibility=$row['website'];
			$full=$row['full'];
		}
		   $temp=1;
		   }
	  }
	  else
	  {
	   if($status=='In-Contacts')
	   {
		   	$privacy_info_query_contacts='SELECT * FROM user_privacy_info_contacts WHERE id="'.$id2.'"';
			$privacy_info_query_result1=mysql_query($privacy_info_query_contacts);
		while($row=mysql_fetch_assoc($privacy_info_query_result1))
		 {
			$dob_visibility=$row['dob_visibility'];
			$loc_visibility=$row['loc_visibility'];
			$prof_visibility=$row['prof_visibility'];
			$rel_visibility=$row['rel_visibility'];
			$about_self_visibility=$row['about_self_visibility'];
			$email_visibility=$row['email_visibility'];
			$phone_no_visibility=$row['phone_no_visibility'];
			$mobile_no_visibility=$row['mobile_no_visibility'];
			$website_visibility=$row['website'];
			$full=$row['full'];
		}
		   $temp=1;
	   }
	   
	   else if($status=='Request-Sent')
	   {
		   $privacy_info_query_everyone='SELECT * FROM user_privacy_info_everyone WHERE id="'.$id2.'"';
	$privacy_info_query_result=mysql_query($privacy_info_query_everyone);
	while($row=mysql_fetch_assoc($privacy_info_query_result))
		 {
			$dob_visibility=$row['dob_visibility'];
			$loc_visibility=$row['loc_visibility'];
			$prof_visibility=$row['prof_visibility'];
			$rel_visibility=$row['rel_visibility'];
			$about_self_visibility=$row['about_self_visibility'];
			$email_visibility=$row['email_visibility'];
			$phone_no_visibility=$row['phone_no_visibility'];
			$mobile_no_visibility=$row['mobile_no_visibility'];
			$website_visibility=$row['website'];
			$full=$row['full'];
		}
		$temp=-1;
	   }
	   else
	   {
	   }

	  }
?>
<?php 
	$contact_list=$get_pic_row['contact_list'];
	$contacts=explode(",",$contact_list);
	$contacts_num=count($contacts);
	if($contacts_num==1)
	$new_rows=0;
	else
	{
		for($i=0;$i<$contacts_num-1;$i++)
		{
			$new[$i]=$contacts[$i];
		}
		$new_rows=count($new);
	}
?>
<!----MAIN AREA---->
<div id="main">
<section>
<div id="main-box">
		<div id="left-box">
    			<div id="profile-pic">
                <div>
                <?php
                    if($profile_pic=='')
                        echo "<img src=images/blank.jpg width=150 height=150/>";
                    else
                        echo "<img src=$profile_pic width=150 height=150/>";
                ?>
                </div>
    			</div>
               	<div id="options">
                    <a href="#" class="tabbox" id="message-req">Send a Message</a>
                	<?php if($full=='true')
					echo '<a href="view_contact_list2.php?id='.$id.'" class="tabbox">Contacts&nbsp;<span class="nos">['.$new_rows.']</span></a>';
					else if($email_visibility!='false')
					echo '<a href="view_contact_list2.php?id='.$id.'" class="tabbox">Contacts&nbsp;<span class="nos">['.$new_rows.']</span></a>';
					?>
                </div>
        </div>
        <div id="overlay-for-contacts">
            <div id="overlay-for-contacts-inside">
            <p class="info">A Request Has Been Sent.</p>
            <button type="button" class="button" id="<?php echo $id?>" value="Close">Close</button>
            </div>
        </div>
        
        <div id="overlay-for-message">
            <div id="profile-view-error-box">
            </div>
        	<div id="messaging-container">
                <p class="labels">Send a Message</p>
      		<form action="" name="pmForm" id="pmForm" method="POST">
                <div class="overlay-menu">
                <div class="info-labels">
                    <label class="labels">Subject</label>
                    <label class="labels">Your Message</label>
                </div>
                <div class="info-container" id="message-box">
                    <input type="text" name="messubject" id="messubject" maxlength="64" class="text-box"autocomplete="off" />
                    <textarea name="mscontent" id="mscontent" class="text-box" autocomplete="off"></textarea>
                    <input type="hidden" name="sender-id" id="sender-id" value="<?php echo $user_id;?>"/>
                    <input type="hidden" name="sender-name" id="sender-name" value="<?php echo $email1;?>"/>
                    <input type="hidden" name="reciever-id" id="reciever-id" value="<?php echo $id;?>"/>
                    <input type="hidden" name="reciever-name" id="reciever-name" value="<?php echo $view_email;?>"/>
                    <input type="hidden" id="prev_page_id" value="2"/>
                    <div id="send-close-buttons">
                        <button type="submit" value="Send" class="button" id="pmsubmit">Send</button>
                        <button type="button" name="close" id="close-message" value="Close" class="button">Close</button>
                    </div>
                    
                </div>
                </div>
        </form>
        </div>
        </div>
<div id="container">
	<div id="tabbox">
    <a href="#" id="basic-info" class="tab basic">General Info.</a>
	<a href="#" id="contact-info" class="tab select">Contact Info.</a>
    <a href="#" id="views" class="tab select">Views</a>
   
    </div>
	<div id="panel">
    <div id="user_name">
		<p class="labels" id="user_name_p">
		<span>@</span>
		<?php echo "".$name?>
        </p>
	</div>
    	<div id="basic-info-box">
    		<div class="info-labels">
    			<label class="labels">Gender</label>
				<?php if($full=='true')
				echo "<label class=labels>Date of Birth</label>";
				else if($dob_visibility!='false')
				echo "<label class=labels>Date of Birth</label>";
				?>
    			<?php if($full=='true')
				echo "<label class=labels>Location</label>";
				else if($loc_visibility!='false')
				echo "<label class=labels>Location</label>";
				?>
    			<?php if($full=='true')
				echo "<label class=labels>Profession</label>";
				else if($prof_visibility!='false')
				echo "<label class=labels>Profession</label>";
				?>
                <?php if($full=='true')
				if($rel!="")
				echo "<label class=labels>Relationship Status</label>";
				else if($rel_visibility!='false')
				if($rel!="")
				echo "<label class=labels>Relationship Status</label>";
				?>
                <?php if($full=='true')
					if($about_self!='')
				echo "<label class=labels>About yourself</label>";
				else if($about_self_visibility!='false')
					if($about_self!='')
				echo "<label class=labels>About yourself</label>";
				?>
    		</div>
    
    	<div id="info-display" class="info-container">
                <div class="info-top">
        			<p><?php echo "".$gender?></p>
        		</div>
                <div class="info" id="dob">
        			<p><?php if($full=='true')
					echo "".$dob;
					else if($dob_visibility=='false')
					echo "";
					else echo "".$dob;
					?></p>
        		</div>
               	<div class="info" id="loc">
        			<p><?php if($full=='true')
					echo "".$loc_city.", ".$loc_country;
					else if($loc_visibility=='false')
					echo "";
					else echo "".$loc_city.", ".$loc_country?></p>
        		</div>
                
                <div class="info" id="prof">
        			<p><?php if($full=='true')
					echo "".$prof;
					else if($prof_visibility=='false')
					echo "";
					else echo "".$prof?></p>
        		</div>
                <div class="info">
        			<p><?php if($full=='true')
					if($rel!="")
					echo "".$rel;
					else if($rel_visibility=='false')
					echo "";
					else
					if($rel!="")
					echo "".$rel?></p>
        		</div>
                <div class="info" id="about-yourself">
        			<p id="about-yourself-text"><?php
					if($full=='true')
					if($about_self!='')
					echo "".$about_self;
					else if($about_self_visibility=='false')
					echo "";
					else
					if($about_self!='')
					echo "".$about_self;
					else echo "";?></p>
        		</div>
                <!--<div class="info" id="about-yourself-edit">
                <textarea class="text-box" id="about-self" disabled="disabled"><?php echo "".$about_self?></textarea>
                </div>-->
    	</div>
        </div>

	<div id="contact-info-box">
    <div class="info-labels">
    	<label class="labels">Email</label>
		<?php if($full=='true') 
		{if($phoneno!='')
		echo '<label class="labels">Phone Number</label>';}
		else if($phone_no_visibility!='false')
		if($phoneno!='')
		echo '<label class="labels">Phone Number</label>'?>
        <?php if($full=='true')
		{if($mobileno!='') 
		echo '<label class="labels">Mobile Number</label>';}
		else if($mobile_no_visibility!='false')
		if($mobileno!='') 
		echo '<label class="labels">Mobile Number</label>'?>
        <?php if($full=='true')
		{if($website!='') 
		echo '<label class="labels">Website</label>';}
		else if($website_visibility!='false')
		if($website!='') 
		echo '<label class="labels">Website</label>'?>
    </div>
    <div class="info-container">
            <div class="info-top">
        			<p><?php echo "".$view_email?></p>
       		</div>
            <div class="info">
        			<p><?php if($full=='true')
					{if($phoneno!='')
					echo "".$phoneno;}
					else if($phone_no_visibility=='false')
					echo "";
					else
					if($phoneno=='')
					{
						echo "";
					}
					else
					{
						echo "".$phoneno;
					}?></p>
        	</div>
            <div class="info">
        			<p><?php if($full=='true') 
					{if($mobileno!='')
					echo "".$mobileno;}
					else if($mobile_no_visibility=='false')
					echo "";
					else
					if($mobileno=='')
					{
						echo "";
					}
					else
					{
						echo "".$mobileno;
					}?></p>
        	</div>
            <div class="info">
        			<p><?php if($full=='true') 
					{if($website!='')
					echo "<a href=$website id=web-link>$website</a>";}
					else if($website_visibility=='false')
					echo "";
					else
					if($website=='')
					{
						echo "";
					}
					else
					{
						echo "<a href=$website id=web-link>$website</a>";
					}?></p>
        	</div>
        </div>
    </div>
    <div id="views-box">
    	<div class="info-labels-views">
    		<?php if($personal_view!='')
			echo '<label class="labels">Personal Views</label>';
			if($social_view!='')
			echo '<label class="labels">Social Views</label>';
			if($cultural_view!='')
            echo '<label class="labels">Cultural Views</label>';
			if($political_view!='')
            echo '<label class="labels">Political Views</label>';
			?>
   		</div>
        <div class="info-container-views">
            <div>
            <?php if($personal_view!='')
               echo '<textarea class="text-box" id="personal-view-textarea" disabled="disabled"  maxlength="200" >'.$personal_view.'</textarea>';
			if($social_view!='')
               echo '<textarea class="text-box" id="social-view-textarea" disabled="disabled"  maxlength="200" >'.$social_view.'</textarea>';
			if($cultural_view!='')
               echo '<textarea class="text-box" id="cultural-view-textarea" disabled="disabled"  maxlength="200" >'.$cultural_view.'</textarea>';
			if($political_view!='')
               echo '<textarea class="text-box" id="political-view-textarea" disabled="disabled"  maxlength="200" >'.$political_view.'</textarea>';
			   ?>
            </div>
        </div>
    </div>
        <?php if($temp==0)
			echo '<div id="buttons-container">
			<form action=" " method=" ">
            <input type="submit" class="newbutton" id='.$id2.' value="Add to Contacts"/>
            </form></div>';
			else if($temp==1)
			echo '<div id="buttons-container" style="left:300px">
			<form action="contact_remove.php" method="POST">
            <input type="submit" class="newbutton" id="in-contacts" value="In Contacts" disabled="disabled"/>
			<input type="submit" class="newbutton1" id="'.$id2.'" value="Remove from Contacts" />
            </form></div>';
			else if($temp==-1)
			echo '<div id="buttons-container">
			<form action=" " method=" ">
            <input type="submit" class="newbutton" id="decision-pending" value="Decision Pending" disabled="disabled"/>
            </form></div>';
			else if($temp==-2)
			echo '<div id="buttons-container">
			<form action="contact_decision1.php" method="POST">
            <input type="submit" name="accept_friend" class="newbutton1" value="Accept"/> <input type="submit" class="newbutton" value="Reject"/>
			<input type="hidden" name="id" value="'.$id2.'"/>
            </form></div>';
		?>
    </div>
    </div>
</div>
</section>
</div>
</body>
</html>
