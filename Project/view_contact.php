<?php
include("loggedincheck.php");
if(isset($_SESSION['email'])&& $_SESSION['state_id']==1)
{
	 // echo"<meta http-equiv=\"refresh\"content=\"0;url=http://localhost/Project/home.php\">";
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
	 }
	 else if(isset($_SESSION['email'])&& $_SESSION['state_id']==-1)
	 {
	    header("location:confirm_account.php");
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
	$num_req=mysql_query("SELECT * FROM requests WHERE id_to=$id AND status='Request-Sent'");
	$num_rows=mysql_num_rows($num_req);
	
	$num_res=mysql_query("SELECT * FROM responses WHERE id_from=$id and status='Unseen'");
	$num_rows_res=mysql_num_rows($num_res);
	
	$num_messages=mysql_query("SELECT * FROM private_messages WHERE id_to=$id and Rstatus='Unseen'");
	$num_rows_messages=mysql_num_rows($num_messages);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Zhuddle</title>
<link rel="Shorcut Icon" href="zhuddle_icon_small.ico">
<link rel="stylesheet" type="text/css" href="stylesheet/stylesheet1.css" />

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

<script type="text/javascript">
$(document).ready(function(){
	   $("#profile-pic").photoZoom();
	   $(".img-div").photoZoom();
	   
	$("#options a,#icons a").click(function()
	{
		$('#logo-div').hide();
		$("#anime-logo-div").css("display","inline");
	});
	$("#add-profile-pic, #change-profile-pic").click(function()
	{
		$('#logo-div').show();
		$("#anime-logo-div").css("display","none");
	});

});
</script>

<script type="text/javascript">
$(document).ready(function()
{
	$("#overlay").hide();
	$("#overlay2").hide();
	$("#add-profile-pic").click(function(e)
	{
		e.preventDefault();
		$("#overlay").fadeIn("slow");
		$("#overlay-inside").fadeIn("slow");
	});
	$("#change-profile-pic").click(function(e)
	{
		e.preventDefault();
		$("#overlay2").fadeIn("slow");
		$("#overlay-inside2").fadeIn("slow");
	});
	$("#close").click(function()
	{
		$("#overlay").fadeOut("slow");
	});
	$("#close2").click(function()
	{
		$("#overlay2").fadeOut("slow");
	});
	$("#save-change-pic").css("opacity","0.5");
	$($(".img-link")).focus(function()
	{
		var x=$(this).attr('id');
		$($(".img-link").get(x)).click(function(e)
		{
			$("#save-change-pic").css("opacity","1");
			$("#save-change-pic").removeAttr('disabled');
			e.preventDefault();
			$($(".img").get(x)).css('border-radius','3px');
			$($(".img").get(x)).css('border','9px solid #fff');
			$("#save-change-pic").click(function(e)
			{
				e.preventDefault();
				var img_name=$($(".img").get(x)).attr("src");
				$('#logo-div').hide();
				$("#anime-logo-div").css("display","inline");
				var imgData = {img_name:img_name,is_ajax:1};
				submitImg(imgData);	
			});
			function submitImg(imgData)
			{
			$.ajax({	
				type: 'POST',
				url: 'img-update.php',		
				data: imgData,
				success:function(response)
				{
				if(response == 'success')
				{
					var t=setTimeout('window.location="home.php"',2000);
				}
				else
				{
					$('#logo-div').show();
					$("#anime-logo-div").css("display","none");
				}
				}
			});
			return false;
			}
		});
	});
	$($(".img-link")).focus(function()
	{
		var x=$(this).attr('id');
		$($(".img-link").get(x)).blur(function(e)
		{
			e.preventDefault();
			$("#save-change-pic").css("opacity","0.5");
			$($(".img").get(x)).css('border-radius','3px');
			$($(".img").get(x)).css('border','9px solid #E2E2E2');
		});
	});
	$("#upload-button").click(function()
	{
		$('#logo-div').hide();
		$("#anime-logo-div").css("display","inline");
	});

});
$(document).ready(function()
{   
    $("#autosuggest-container").hide();
	$('#search-box').keydown(function()
	{
		$("#autosuggest-container").show();
	});
	$('#autosuggest-container').mouseleave(function()
	{
		$("#autosuggest-container").hide();
	});
	var autoSugg=$('#search-textbox').val();
	if(autoSugg=='')
	{
		    $("#autosuggest-container").hide();
	}
});
</script>
<script type="text/javascript">
$(document).ready(function()
{
	$("#overlay-for-contacts").hide();
	$(".newbutton").click(function(e)
	{
	    e.preventDefault();
		$("#overlay-for-contacts").fadeIn("slow");

	   var id=$(this).attr('id');
		$.ajax({
		type:'GET',
		url:'contact_insert.php',
		data:{'id':id},
		});
	});
	
	$(".button").click(function(e)
	{
		e.preventDefault();
		$("#overlay-for-contacts").fadeOut("slow");
		window.location.reload(true);
	});
});

$(window).scroll(function(){
if ($(window).scrollTop() == $(document).height() - $(window).height()){
var time=$(".results:last").attr("id");
 var url1="getmore_contacts.php";
		
		 $.post(url1,{timeval:time},function(data){
			 
			 if(data!="")
			 {
				 $(".getcontacts").empty();
				 var height=$("#right-box").css("height");
				 $("#main-box").css("height","+=660");
			 }
			 else
			 {
				 $(".getcontacts").hide();
			 }
			 $("#results").append(data);
		 });
}
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
        <div id="search-box">
	        <form class="form-wrapper cf" action="view_contact.php" method="get">
                    <input type="text" id="search-textbox" class="text-box" placeholder="Search..." name="x" onkeyup="autoSuggest()"/>
                <button type="submit" id="search-button"><img src="images/Search.png" height="25px"/></button>
                <input type="hidden" id="id-textbox" value="<?php echo $id?>"/>
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
</div>
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
                	<?php 
				 if($profile_pic=="")
				 {
                	echo "<a href='' class=tabbox id=add-profile-pic>Add a Profile Photo</a>";
				 }
				 else
                    echo "<a href='' class=tabbox id=change-profile-pic>Change Profile Photo</a>";
				?>
                	<a href="responses.php" class="tabbox">Responses&nbsp;<span class="nos">[<?php echo $num_rows_res?>]</span></a>
                    <a href="inbox.php" class="tabbox">Messages&nbsp;<span class="nos">[<?php echo $num_rows_messages?>]</span></a>
                	<a href="contact_requests.php" class="tabbox">Requests&nbsp;<span class="nos">[<?php echo $num_rows?>]</span></a>
                    <a href="contact_list.php" class="tabbox">Contacts&nbsp;<span class="nos">[<?php echo $new_rows?>]</a>
                </div>
			</div>
            <div id="overlay-for-contacts">
                    <div id="overlay-for-contacts-inside">
                    <p class="info">A request has been sent.</p>
                    <button type="button" class="button" id="<?php echo $id?>" value="Close">Close</button>
                    </div>
        	</div>
            <div id="overlay">
     			<div id="overlay-inside">
                <p id="reply-label" class="labels">Add a Profile Photo</p>
            	<form enctype="multipart/form-data" method="post" action="image_upload_1.php">
            	<div id="orig-img">
                </div>
                    <input name="uploaded_file" type="file" id="image" class="filebutton" />
                    <button type="submit" class="button" id="upload" value="Upload">Upload</button>
                    <button type="button" class="button" id="close" value="Close">Close</button>
                    <input type="hidden" name="question" value="3">
				<div id="cropped-img">
                </div>
                </form>
    		</div>
		</div>
        <div id="overlay2">
     		<div id="overlay-inside2">
            <p id="reply-label" class="labels">Change Profile Photo</p>
            	<form enctype="multipart/form-data" method="post" action="image_upload_1.php">
          			<input name="uploaded_file" type="file" id="image" class="filebutton" />
                	<button type="submit" class="button" id="upload-button" value="Upload">Upload</button>
          			<button type="button" class="button" id="close2" value="Close">Close</button>
                	<input type="hidden" name="question" value="3" />
				<div id="cropped-img">
                </div>
                </form>
    		</div>
		</div>
		<div id="right-box">
            <?php
			 $MemberDisplayList="";
 			$MemberDisplayList1="";
 			$MemberDisplayList2="";
			$blank_img='images/blank.jpg';
			$x1=$_GET['x'];
			$findRequests2='SELECT * FROM users WHERE state=1 and id !="'.$id.'" and CONCAT(f_name," ",l_name) LIKE "%'.mysql_real_escape_string($x1).'%" ORDER BY CONCAT(f_name," ",l_name) ASC';
		   $result2=mysql_query($findRequests2) or die(mysql_error());
		   $totalrows2=mysql_num_rows($result2);
		   ?>
            <p class="labels" id="tags">Search Results</p>
            <?php if($totalrows2!=0)
            echo "<span class=search-results-span-class>Found $totalrows2 Results.</span>";
            ?>
            <div id="results">
           <?php
			if($totalrows2>0)
			{
				while($row=mysql_fetch_array($result2))
				{
				  $firstname=$row['f_name'];
				 $lastname=$row['l_name'];
				 $id3=$row['id'];
				 $pic=$row['profile_pic'];
				 $email=$row['email'];
				 $gender=$row['gender'];
				$findrequest='SELECT * from requests where id_to="'.$id3.'" and id_from="'.$_SESSION['id'].'"';
				$findrequest_result=mysql_query($findrequest);
				$findrequest_result_rows=mysql_num_rows($findrequest_result);
				
				$findrequest3='SELECT * from requests where id_to="'.$_SESSION['id'].'" and id_from="'.$id3.'"';
				$findrequest_result3=mysql_query($findrequest3);
				$findrequest_result_rows3=mysql_num_rows($findrequest_result3);
				while($row=mysql_fetch_array($findrequest_result))
				{
					$status=$row['status'];
				}
				while($row=mysql_fetch_array($findrequest_result3))
				{
					$status3=$row['status'];
				}
				if($findrequest_result_rows==0)
				{
					if($findrequest_result_rows3==0)
					{
								if($pic!='')
							   {
								$MemberDisplayList .='<ul class="link-list search-list"><li><a href="profile-view.php?id='.$id3.'"><img class="search-pic1" src='.$pic.' height="35" width="35"/>'.$firstname.'  '.$lastname.'</a><p>'.$email.'<br /><br /><br /><br />'.$gender.'</p><div id="accept-reject-buttons"><input type="submit" class="newbutton" id="'.$id3.'" value="Add to Contacts"/></div></li></ul>';
							   }
							   else
							   {
								   $MemberDisplayList1 .='<ul class="link-list search-list"><li><a href="profile-view.php?id='.$id3.'"><img class="search-pic1" src='.$blank_img.' height="35" width="35"/>'.$firstname.'  '.$lastname.'</a><p>'.$email.'<br /><br /><br /><br />'.$gender.'</p><div id="accept-reject-buttons"><input type="submit" class="newbutton" id="'.$id3.'" value="Add to Contacts"/></div></li></ul>';
							   }
					}
					else if($status3=='Request-Sent')
					{
						if($pic!='')
							   {
								$MemberDisplayList .='<form action="contact_decision.php?id='.$id3.'" method="POST"><ul class="link-list search-list"><li><a href="profile-view.php?id='.$id3.'"><img class="search-pic1" src='.$pic.' height="35" width="35"/>'.$firstname.'  '.$lastname.'</a><p>'.$email.'<br /><br /><br /><br />'.$gender.'</p><div id="accept-reject-buttons"><input type="submit" name="accept_contact" class="newbutton1" value="Accept"/> <input type="submit" class="newbutton1" value="Reject" name="reject_contact"/><input type="hidden" name="question" value="1"/><input type="hidden" name="x" value='.$x1.'/></div></li></ul></form>';
							   }
							   else
							   {
								$MemberDisplayList1 .='<form action="contact_decision.php?id='.$id3.'" method="POST"><ul class="link-list search-list"><li><a href="profile-view.php?id='.$id3.'"><img class="search-pic1" src='.$blank_img.' height="35" width="35"/>'.$firstname.'  '.$lastname.'</a><p>'.$email.'<br /><br /><br /><br />'.$gender.'</p><div id="accept-reject-buttons"><input type="submit" name="accept_contact" class="newbutton1" value="Accept"/> <input type="submit" class="newbutton1" value="Reject" name="reject_contact"/><input type="hidden" name="question" value="1"/><input type="hidden" name="x" value="'.$x1.'"/></div></li></ul></form>';
							   }
					}
					else if($status3=='In-Contacts')
					{
						if($pic!='')
							   {
								$MemberDisplayList .='<ul class="link-list search-list"><li><a href="profile-view.php?id='.$id3.'"><img class="search-pic1" src='.$pic.' height="35" width="35"/>'.$firstname.'  '.$lastname.'</a><p>'.$email.'<br /><br /><br /><br />'.$gender.'</p><div id="accept-reject-buttons"><input type="submit" class="newbutton" value="In Contacts" disabled="disabled"/></div></li></ul>';
							   }
							   else
							   {
								   $MemberDisplayList1 .='<ul class="link-list search-list"><li><a href="profile-view.php?id='.$id3.'"><img class="search-pic1" src='.$blank_img.' height="35" width="35"/>'.$firstname.'  '.$lastname.'</a><p>'.$email.'<br /><br /><br /><br />'.$gender.'</p><div id="accept-reject-buttons"><input type="submit" class="newbutton" value="In Contacts" disabled="disabled"/></div></li></ul>';
							   }
					}
				}
				else
				  {
				   if($status=='In-Contacts')
				   {
					   if($pic!='')
							   {
								$MemberDisplayList .='<ul class="link-list search-list"><li><a href="profile-view.php?id='.$id3.'"><img class="search-pic1" src='.$pic.' height="35" width="35"/>'.$firstname.'  '.$lastname.'</a><p>'.$email.'<br /><br /><br /><br />'.$gender.'</p><div id="accept-reject-buttons"><input type="submit" class="newbutton" value="In Contacts" disabled="disabled"/></div></li></ul>';
							   }
							   else
							   {
								   $MemberDisplayList1 .='<ul class="link-list search-list"><li><a href="profile-view.php?id='.$id3.'"><img class="search-pic1" src='.$blank_img.' height="35" width="35"/>'.$firstname.'  '.$lastname.'</a><p>'.$email.'<br /><br /><br /><br />'.$gender.'</p><div id="accept-reject-buttons"><input type="submit" class="newbutton" value="In Contacts" disabled="disabled"/></div></li></ul>';
							   }
				   }
				   else if($status=='Request-Sent')
				   {
					   if($pic!='')
							   {
								$MemberDisplayList .='<ul class="link-list search-list"><li><a href="profile-view.php?id='.$id3.'"><img class="search-pic1" src='.$pic.' height="35" width="35"/>'.$firstname.'  '.$lastname.'</a><p>'.$email.'<br /><br /><br /><br />'.$gender.'</p><div id="accept-reject-buttons"><input type="submit" class="newbutton" value="Decision Pending" disabled="disabled"/></div></li></ul>';
							   }
							   else
							   {
								   $MemberDisplayList1 .='<ul class="link-list search-list"><li><a href="profile-view.php?id='.$id3.'"><img class="search-pic1" src='.$blank_img.' height="35" width="35"/>'.$firstname.'  '.$lastname.'</a><p>'.$email.'<br /><br /><br /><br />'.$gender.'</p><div id="accept-reject-buttons"><input type="submit" class="newbutton" value="Decision Pending" disabled="disabled"/></div></li></ul>';
							   }
				   }
				 }
	}echo $MemberDisplayList.$MemberDisplayList1;
}
	else
	{$MemberDisplayList .='<p class="p-class">No Matches Found.</p>';
	echo $MemberDisplayList;}
 ?>
            </div>
        </div> 
        </div>
    </section>
</div>
</body>
</html>
        