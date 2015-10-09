<?php
sleep(1);
include("dbheader.php");
if(isset($_SESSION['email'])&& $_SESSION['state_id']==1)
{
	 // echo"<meta http-equiv=\"refresh\"content=\"0;url=http://localhost/Project/home.php\">";
	 	 $query='SELECT * FROM users WHERE EMAIL="'.$_SESSION['email'].'"';
		 $result=mysql_query($query);
		 while($row=mysql_fetch_assoc($result))
		 {
			$id=$row['id'];
			$user_id=$row['id'];
		 }
		 $logquery='SELECT id,login FROM log WHERE id="'.$id.'"';
		 $logresult=mysql_query($logquery);
		 $ini_no=1;
		 if (mysql_num_rows($logresult) == 0 ) 
		 {
			$logquery='INSERT into log VALUES("'.$id.'","'.$ini_no.'","")';
		 	$logresult=mysql_query($logquery);
		 }
		 else
		 {
			while($row=mysql_fetch_assoc($logresult))
		 	{
			$logid=$row['id'];
			$login_nos=$row['login'];
		 	}
			$login_nos=$login_nos+1;
			$logupdatequery='UPDATE log set login="'.$login_nos.'" where id="'.$logid.'"';
		 	$logupdateresult=mysql_query($logupdatequery);
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
<title>Home</title>

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

<script type="text/javascript" src="js/profile-update.js"></script>
<script type="text/javascript" src="js/photoZoom.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
	   $("#profile-pic").photoZoom();
	   $(".img-div").photoZoom();
	});
$(document).ready(function() {
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
	$("#interactionResults").hide();
	$("#overlay-for-contacts").hide();
	$("#overlay-for-message").hide();
	$("#messaging-container").hide();
	$("#message-error-box").hide();
		
	$('#mscontent').focus(function()
	{
		$(this).css("background","#F0F0F0");
	});
	$('#mscontent').blur(function()
	{
		$(this).css("background","#cbcbcb");
	});
			
	$(".newbutton1").click(function(e)
	{
	    e.preventDefault();
		$("#overlay-for-contacts").fadeIn("slow");

	   var id=$(this).attr('id');
		$.ajax({
		type:'GET',
		url:'contact_remove.php',
		data:{'id':id},
		});
	});
	
	$(".button1").click(function(e)
	{
		e.preventDefault();
		$("#overlay-for-contacts").fadeOut("slow");
		window.location.reload(true);
	});
	$(".newbutton").click(function(e)
	{
	    e.preventDefault();
		$("#overlay-for-message").fadeIn("slow");
		$("#messaging-container").fadeIn("slow");
	});
	$("#close-message").click(function(e)
	{  
		$("#overlay-for-message").fadeOut("slow");
		$("#messaging-container").fadeOut("slow");
		$("#interactionResults").fadeOut("slow");
		document.pmForm.messubject.value='';
		document.pmForm.mscontent.value='';
		$("#message-error-box").fadeOut('slow')
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
           $("#message-error-box").html('Please type a subject.').fadeIn("slow");
      } else if (pmTextArea.val() == "") {
		   $("#message-error-box").html('Please type in your message.').fadeIn("slow");
      } else {
		   $.post(url,{ subject: pmSubject.val(), message: pmTextArea.val(), senderName: sendername.val(), senderid: senderid.val(), rcpntName: recName.val(), recID: recID.val(), pageID: pageID.val()  } ,           function(data) {
			   $("#message-error-box").css("border","#1F8532 inset 1px").css("color","#1F8532").html(data).fadeIn("slow");
			$('#logo-div').hide();
			$("#anime-logo-div").css("display","inline");
			   $("#overlay-for-message").fadeOut(3000);
			   document.pmForm.messubject.value='';
			   document.pmForm.mscontent.value='';
			   $("#message-error-box").fadeOut('slow');
			   window.location.reload();
           });
	  	}
	  });
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
                	<a href="contact_list.php" class="tabbox">Contacts&nbsp;<span class="nos">[<?php echo $new_rows?>]</span></a>
                </div>
			</div>
            <div id="overlay-for-contacts">
                    <div id="overlay-for-contacts-inside">
                    <p class="info">This person has been removed from your contacts.</p>
                    <button type="button" class="button1" id="<?php echo $id?>" value="Close">Close</button>
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
            <?php
			$files = glob("uploads/$id/*.*");
			for ($i=0; $i<count($files); $i++)
			{
				$num = $files[$i];
				echo '<div class="img-div"><a href="" id="'.$i.'" class="img-link"><img src="'.$num.'" class="img" width=150 height=150></a></div>';
			}
			?>
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
        	<p class="labels" id="tags">Contacts</p>
            <div id="results">
<?php
$FriendDisplayList="";
$id2="";
$blank_img='images/blank.jpg';
if($new_rows!='')
{
		for($i=0;$i<count($new);$i++)
		{
			$contacts_query='SELECT * from users where id="'.$new[$i].'"';
			$contacts_query_result=mysql_query($contacts_query) or die(mysql_error());
			while($row=mysql_fetch_array($contacts_query_result))
			   {
				   $firstname=$row['f_name'];
				   $lastname=$row['l_name'];
			   }
			   $names[$i]=$firstname." ".$lastname;
			   sort($names);
		}
		
		for($i=0;$i<count($names);$i++)
		{
			$contacts_query1='SELECT * from users where CONCAT(f_name," ",l_name)="'.$names[$i].'"';
			$contacts_query_result1=mysql_query($contacts_query1) or die(mysql_error());
			while($row=mysql_fetch_array($contacts_query_result1))
		   {
			   $contact_id=$row['id'];
			   $firstname=$row['f_name'];
				$lastname=$row['l_name'];
				$pic=$row['profile_pic'];
				$email_contact=$row['email'];
				$gender=$row['gender'];
		   }
							if($pic=='')
							{$FriendDisplayList[] .='<ul class="link-list search-list"><li><a href="profile-view.php?id='.$contact_id.'"><img class="search-pic1" src='.$blank_img.' height="35" width="35"/>'.$firstname.'  '.$lastname.'</a><p>'.$email_contact.'<br /><br /><br /><br />'.$gender.'</p><div id="accept-reject-buttons1"><input type="submit" class="newbutton" value="Message" /> <input type="submit" class="newbutton1" id="'.$contact_id.'" value="Remove from Contacts" /></div></li></ul>';}
							else
							{
							$FriendDisplayList[] .='<ul class="link-list search-list"><li><a href="profile-view.php?id='.$contact_id.'"><img class="search-pic1" src='.$pic.' height="35" width="35"/>'.$firstname.'  '.$lastname.'</a><p>'.$email_contact.'<br /><br /><br /><br />'.$gender.'</p><div id="accept-reject-buttons1"><input type="submit" class="newbutton" value="Message" /> <input type="submit" class="newbutton1" id="'.$contact_id.'" value="Remove from Contacts" /></div></li></ul>';
							}
		}
		//Pagination
		$per_page=6;
		$pages_query=count($names);
		$pages=ceil($pages_query/$per_page);
		$page=(isset($_GET['page'])) ? (int)$_GET['page'] : 1;
		$start=($page-1)*$per_page;
		if($start==0){
			if($pages_query>6)
			{
				for($i=$start;$i<$per_page;$i++)
				{
				echo $FriendDisplayList[$i];
				}
			}
			else
			{
				for($i=$start;$i<$pages_query;$i++)
				{
				echo $FriendDisplayList[$i];
				}
			}
		}
		else{
		for($i=$start;$i<$per_page*$page;$i++)
		{
			if(array_key_exists($i, $FriendDisplayList))
	   		echo $FriendDisplayList[$i];
			else
			break;
		}
		}?>
        <div class="pagination">
		<ul class="my-pagination classC page-C-08">
        <?php
		if($pages_query>6)
		if($pages>=1 && $page<=$pages)
		{
			echo '<li><a href="?page=1">First</a></li>';
			for($x=1;$x<=$pages;$x++)
			{
			echo ($x==$page) ? '<li><a href="?page='.$x.'">'.$x.'</a></li> ':'<li><a href="?page='.$x.'">'.$x.'</a></li> ';
			}
			echo '<li><a href="?page='.$pages.'">Last</a></li>';
		}
}
	 else
	 {
		 $FriendDisplayList.='<p class="p-class">You Have No Contacts.</p>';
		 echo $FriendDisplayList;
	 }
 ?>        </ul>
 </div>
            </div>
            
        </div> 
        <div id="overlay-for-message">
                    <div id="message-error-box">
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
                            <input type="text" name="messubject" id="messubject" maxlength="64" class="text-box" autocomplete="off" />
                            <textarea name="mscontent" id="mscontent" class="text-box" maxlength="200"></textarea>
                            <input type="hidden" name="sender-id" id="sender-id" value="<?php echo $user_id;?>"/>
                            <input type="hidden" name="sender-name" id="sender-name" value="<?php echo $_SESSION['email'];?>"/>
                            <input type="hidden" name="reciever-id" id="reciever-id" value="<?php echo $contact_id;?>"/>
                            <input type="hidden" name="reciever-name" id="reciever-name" value="<?php echo $email_contact;?>"/>
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
            </div>
	</section>
</div>

</body>
</html>
