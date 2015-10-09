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
<title>Zhuddle</title>
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
<script type="text/javascript" src="js/inbox.js"></script>
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
	$("#create-new-message").click(function()
	{
		$('#logo-div').hide();
		$("#anime-logo-div").css("display","inline");
		setTimeout('window.location="contact_list.php"',500);
	});
});
    </script>
<script type="text/javascript">

	$(window).unload(function()
	{
		var id=$('#id-textbox').val();
			$.ajax({
				url:'update-messages.php',
				type:'POST',
				data:{id:id},
			});
	});
$(document).ready(function() {
	$('.subject-link').click(function()
	{
		var reply_id=$(this).parent().next().find(".reply-id").val();
		var user_id=$(this).parent().next().find(".user-id").val();
			$.ajax({
				url:'update-inbox.php',
				type:'POST',
				data:{reply_id:reply_id,user_id:user_id},
			});
	});
});

</script>

<script type="text/javascript">

function toggleChecks(field) {
	if (document.myform.toggleAll.checked == true)
	{
		$('.regular-checkbox').attr('checked','checked');
	}
	else
	{
		$('.regular-checkbox').removeAttr('checked');
	}
}

function change()
{
	$("#sent-box").show();
	$(".inbox").hide();
}

$(document).ready(function() {
$("#sent-box").hide(); 
$(".messaging-member-names").hide();
$(".toggle").click(function () { 
  if ($(this).next().is(":hidden")) {
    $(this).next().slideDown("fast");
	$(this).parent().prev().find(".messaging-member-names").slideDown("fast");
  } else { 
    $(this).next().slideUp("fast");
	$(this).parent().prev().find(".messaging-member-names").slideUp("fast");
  } 
}); 
	
	$("#close-message").click(function(e)
	{  
		$("#replyBox").fadeOut("slow");
		$("#reply-messaging-container").fadeOut("slow");
	  	window.location.reload();
	});
});
function markAsRead(msgID) {
	$.post("markAsRead.php",{ messageid:msgID, ownerid:<?php echo $user_id
	; ?> } ,function(data) {
		$('#subj_line_'+msgID).addClass('msgRead');
       // alert(data); // This line was just for testing returned data from the PHP file, it is not required for marking messages as read
   });
}
function toggleReplyBox(subject,sendername,senderid,recName,recID,messid) {
	$("#subjectShow").text(subject);
	$("#recipientShow").text(recName);
	document.replyForm.pmSubject.value = subject;
	document.replyForm.pm_sender_name.value = sendername;
	document.replyForm.pm_sender_id.value = senderid;
	document.replyForm.pm_rec_name.value = recName;
	document.replyForm.pm_rec_id.value = recID;
	document.replyForm.pm_message_id.value = messid;
    document.replyForm.replyBtn.value = "Send";
    if ($('#replyBox').is(":hidden")) {
		$('#reply-error-box').hide();
		  $('#replyBox').fadeIn("slow");
    } else {
		  $('#replyBox').fadeOut("slow");
    }     
}
//jquery for the sentbox stuff
function toggleChecksSend(field1) {
	if (document.myform1.toggleAll1.checked == true){
		  for (i = 0; i < field1.length; i++) {
              field1[i].checked = true;
		  }
	} else {
		  for (i = 0; i < field1.length; i++) {
              field1[i].checked = false;
		  }		
	}
		 
}

$(document).ready(function() { 

$(".toggle1").click(function () { 
  if ($(this).next().is(":hidden")) {
	$(".hiddenDiv").hide();
    $(this).next().slideDown("fast"); 
  } else { 
    $(this).next().slideUp("fast");
  } 
}); 
});

function reload1()
{
	window.location.reload();
}

//sent box stuff ends here
function processReply () {
	  var pmSubject = $("#pmSubject");
	  var pmTextArea = $("#pmTextArea");
	  var sendername = $("#pm_sender_name");
	  var senderid = $("#pm_sender_id");
	  var recName = $("#pm_rec_name");
	  var recID = $("#pm_rec_id");
	  var messID = $("#pm_message_id");
	  var pageID = $("#prev_page_id");
	  var url = "private_msg_parse.php";
      if (pmTextArea.val() == "") {
		   $("#reply-error-box").html("Please type in your message.").fadeIn('fast');
      } else {
		  $.post(url,{ subject: pmSubject.val(), message: pmTextArea.val(), senderName: sendername.val(), senderid: senderid.val(), rcpntName: recName.val(), recID: recID.val(), messID: messID.val(), pageID: pageID.val()  } ,  function(data) {
			   document.replyForm.pmTextArea.value = "";
			   $('#replyBox').fadeOut(3000);
			   $("#reply-error-box").css("border","#1F8532 inset 1px").css("color","#1F8532").html(data).fadeIn("slow");
			   	window.location.reload();
           });  
	  }
}
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
              
<!-----Inbox area--------->
<div id="right-box">
    <p class="labels" id="tags">Messages</p>
    <?php
///////////End take away///////////////////////
// SQL to gather their entire PM list
$sql = mysql_query("SELECT * FROM private_messages WHERE id_to='".$user_id."' AND recipientDelete='0' ORDER BY time_sent DESC LIMIT 4");
$mainsql = mysql_query("SELECT id,message,id_from,subject FROM private_messages WHERE id_to='".$user_id."' AND recipientDelete='0' GROUP BY id ORDER BY time_sent DESC LIMIT 4");
$count=mysql_num_rows($sql);
$sqlsentmessages=mysql_query("SELECT * FROM private_messages WHERE id_from='".$user_id."' AND recipientDelete='0' ORDER BY time_sent DESC LIMIT 4");
$countsentmessages=mysql_num_rows($sqlsentmessages);
if($count==0)
{
	if($countsentmessages==0)
	{
		echo'
		<div id=inbox-table class=inbox>
		<p class="p-class" style="margin-left:0">You Have No Messages.</p>
			<input type="button" class="newbutton" value="Send a Message" id="create-new-message" />
		</div>';
	}
	else
	{
		echo'
		<div id=inbox-table class=inbox>
		<p class="p-class" style="margin-left:0">You Have No Messages.</p>
			<input type="button" class="newbutton" value="Send a Message" id="create-new-message" />
		</div>';
	}
}
else
{
	echo '
	<div id=inbox-table class=inbox>
            	<form name=myform action="deletemess.php" method=post enctype="multipart/form-data">
            <table width="580">
                <tr>
                <td colspan="4">
                </td>
                </tr>
              <tr>
                <td width="1%"></td>
                <td colspan="2">
                <button type="submit" class="button" name="deleteBtnSent" id="deleteBtnSent" value="Delete">Delete</button>
                 <span id="jsbox" style="display:none"></span>
                </td>
                <td align="right">             
			<input type="button" class="newbutton" value="Send a Message" id="create-new-message"/>
                </td>
              </tr>
              <tr>
                <td colspan="4">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4">&nbsp;</td>
              </tr>
              <tr>
                <td width="1%">
                <input name=toggleAll id=toggleAll type=checkbox onclick=toggleChecks(document.myform.cb) class=regular-checkbox /><label for=toggleAll></label>
                </td>
                <td width="24%" class="info-top">Sent By</td>
                <td width="38%" class="info-top">Subject</td>
                <td width="37%" class="info-top">Time</td>
              </tr>
        </table>';?>
<?php
while($row = mysql_fetch_array($mainsql))
{ 
	$messageid=$row['id'];
    $fr_id = $row['id_from']; 
	$sqlmessagesender=mysql_query('SELECT min(time_sent),id_from,Sstatus,Rstatus FROM private_messages where id="'.$messageid.'"');
	while($messagesenderrow=mysql_fetch_array($sqlmessagesender))
	{
		$id_from=$messagesenderrow['id_from'];
		$Sstatus = $messagesenderrow['Sstatus']; 
		$Rstatus = $messagesenderrow['Rstatus'];  
		$date = $messagesenderrow['min(time_sent)'];
		$d = date_create($date);
		$date=date_format($d, 'h:i a \o\n jS F, Y');
	}
    // SQL - Collect username for sender inside loop
	if($id_from!=$user_id)
	{
		$ret = mysql_query("SELECT id, f_name, l_name FROM users WHERE id='".$fr_id."' LIMIT 1");
    	while($raw = mysql_fetch_array($ret)){ $Sid = $raw['id']; $Sname = $raw['f_name'].' '.$raw['l_name']; }
	}
	else
	{
		$ret = mysql_query("SELECT id, f_name, l_name FROM users WHERE id='".$user_id."' LIMIT 1");
    	while($raw = mysql_fetch_array($ret)){ $Sid = $raw['id']; $Sname = $raw['f_name'].' '.$raw['l_name']; }

	}
?>
<?php

	$timequery=mysql_query("SELECT * from private_messages where id='".$messageid."' and subject='".$row['subject']."' ORDER BY time_sent ASC");
	while($t = mysql_fetch_array($timequery))
	{
		$time=$t['time_sent'];
	}
?>
        <table width="580" id="<?php echo $time ?>" class="tables">
              <tr>
                <td colspan="4">&nbsp;</td>
              </tr>
          <?php
			  $statusquery=mysql_query('SELECT * FROM private_messages where id='.$messageid.' AND Rstatus="Unseen" AND id_from!="'.$user_id.'"');
			  $newmessagecount=mysql_num_rows($statusquery);
		  if($Rstatus=='Unseen')
		  {
		  		echo '<tr style="background:#fff">';
		  }
		  else if($newmessagecount!=0)
			{
		  		echo '<tr style="background:#fff">';
			}
		else
		  echo '<tr>';
		?>
            <td width="1%">
            <input type="checkbox" name="value[]" id="cb<?php echo $row['id']; ?>" value="<?php echo $messageid; ?>" class="regular-checkbox"/><label for="cb<?php echo $row['id']; ?>"></label>
            </td>
            <td width="23%">
            <?php
			if($Sid==$user_id)
			{
			$Sname1=wordwrap(nl2br($Sname), 15, "<br>", true);
            echo '<a href="profile.php" style="line-height:1.5em">'.$Sname1.'</a>';
			}
			else
			{
			$Sname1=wordwrap(nl2br($Sname), 15, "<br>", true);
            echo '<a href="profile-view.php?id='.$Sid.'" style="line-height:1.5em">'.$Sname1.'</a>';
			}
            ?>
            <div class="messaging-member-names">
			<?php
				$sqlquery=mysql_query("SELECT * from private_messages where id='".$messageid."' and subject='".$row['subject']."' ORDER BY time_sent ASC");
				while($r = mysql_fetch_array($sqlquery))
				{
					$Rmessstatus = $r['Rstatus'];
					$display_id_from=$r['id_from'];
					echo '<p style="text-align:right">';
					$message_role=$r['id_from'];
					//echo stripslashes(wordwrap(nl2br($message_role), 40, "<br>", true));
					$message_role_name=mysql_query('SELECT * FROM users where id="'.$message_role.'"');
					while($rows=mysql_fetch_array($message_role_name))
					{
						if($Rstatus=='Unseen')
						{
						echo '<span class="time-span-class">NEW!&nbsp;&nbsp;</span>'.stripslashes(wordwrap(nl2br($rows['f_name']), 10, "<br>", true)).' :';
						}
						else if($Rstatus=='Seen')
						{
							if($Rmessstatus=='Seen')
							{
								echo stripslashes(wordwrap(nl2br($rows['f_name']), 10, "<br>", true)).' :';
							}
							else
							{
								if($display_id_from==$user_id)
								{
								echo stripslashes(wordwrap(nl2br($rows['f_name']), 10, "<br>", true)).' :';
								}
								else
								{
									if($rows['id']==$user_id)
									{
									echo stripslashes(wordwrap(nl2br($rows['f_name']), 10, "<br>", true)).' :';
									}
									else
									echo '<span class="time-span-class">NEW!&nbsp;&nbsp;</span>'.stripslashes(wordwrap(nl2br($rows['f_name']), 10, "<br>", true)).' :';
	
								}
							}
						}
					}
					echo '</p>';
				}
				?>
            </div>
            </td>
            <td width="36%">
              <span class="toggle">
              <a class="subject-link" id="subj_line_<?php echo $row['id']; ?>" style="line-height:1.5em" onclick="markAsRead(<?php echo $row['id']; ?>)"><?php echo wordwrap(stripslashes($row['subject']),18,"<br>"); ?></a>
              </span>
              <div class="hiddenDiv">
              	<table width="435">
                <tr>
                <td width="48.5%">
                <?php
				$sqlquery=mysql_query("SELECT * from private_messages where id='".$messageid."' and subject='".$row['subject']."' ORDER BY time_sent ASC");
				while($r = mysql_fetch_array($sqlquery))
				{
					echo '<p>';
					echo stripslashes(wordwrap(nl2br($r['message']), 20, "<br>", true));
					echo '</p>';
				}
				?>
               <a href="javascript:toggleReplyBox('<?php echo stripslashes($row['subject']); ?>','<?php echo $Sname; ?>','<?php echo $user_id; ?>','<?php echo $Sname; ?>','<?php echo $fr_id; ?>','<?php echo $messageid; ?>')">Reply</a>
               <input type="hidden" value="<?php echo $messageid ?>" class="reply-id"/>
               <input type="hidden" value="<?php echo $user_id ?>" class="user-id"/>
                </td>
                <td width="51.5%">
                <?php
				$sqlquery2=mysql_query("SELECT * from private_messages where id='".$messageid."' and subject='".$row['subject']."' ORDER BY time_sent ASC");

				while($r = mysql_fetch_array($sqlquery2))
				{
					echo '<p><span>';
					$sent_time=$r['time_sent'];
					$d_sent_time = date_create($sent_time);
					$date_sent_time=date_format($d_sent_time, 'h:i a \o\n jS F, Y');
					echo '@ '.$date_sent_time;
					echo '</p></span>';
				}
				?>
                </td>
                </tr>
               </table>
              </div>
           </td>
            <td width="36%"><span style="line-height:1.5em"><?php echo '@ '.$date; ?></span></td>
          </tr>
          <tr class="borders">
          </tr>
        </table>

<?php 
}
echo '</form></div>';
}// Close Main while loop
?>
            <!-- END THE PM FORM AND DISPLAY LIST -->
            <!-- Start Hidden Container the holds the Reply Form -->            
	
</div>
            
            <div id="replyBox">
                <div id="reply-error-box">
            	</div>
                <div id="reply-messaging-container">
                <p class="labels" id="reply-label">Reply</p>
                    <div class="overlay-menu">
                    <div class="info-labels">
                        <label class="labels">To</label>
                        <label class="labels">Subject</label>
                        <label class="labels">Your Message</label>
                    </div>
                    <div id="reply-message-box" class="info-container">
                        <p id="recipientShow" class="info"></p>
                        <p id="subjectShow" class="info"></p>
                    
                <form action="javascript:processReply();" name="replyForm" id="replyForm" method="post">
                <!--<textarea id="pmTextArea" rows="8" style="width:98%;"></textarea>-->
                <input type="hidden" id="pmSubject" />
                <input type="hidden" id="pm_rec_id" />
                <input type="hidden" id="pm_rec_name" />
                <input type="hidden" id="pm_sender_id" />
                <input type="hidden" id="pm_sender_name" />
                <input type="hidden" id="pm_message_id" />
                <input type="hidden" id="prev_page_id" value="1"/>
                <textarea name="mscontent" id="pmTextArea" class="text-box"></textarea>
                 <div id="send-close-buttons">
                <button name="replyBtn" class="button" type="button" onclick="javascript:processReply()">Reply</button>
                <button type="button" name="close" id="close-message" value="Close" class="button">Close</button>
                </div>
                </form>
                </div>
                </div>
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
</div>
</section>
</div>
</body>
</html>