<?php
sleep(1);
include("dbheader.php");
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
        });
$(document).ready(function() {
	$("#options a,#icons a").click(function()
	{
		$('#logo-div').hide();
		$("#anime-logo-div").css("display","inline");
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
	var autoSugg=$('#search-textbox').val();
	$('#search-textbox').keydown(function()
	{
		var autoSugg2=$('#search-textbox').val();
		if(autoSugg2=='')
		{
		$("#autosuggest-container").empty();
		}
		else
		$("#autosuggest-container").show();
	});
	$('#autosuggest-container').mouseleave(function()
	{
		$("#autosuggest-container").hide();
	});

	$('#search-textbox').click(function()
	{
		var autoSugg1=$('#search-textbox').val();
		if(autoSugg1!='')
		{
		$("#autosuggest-container").show();
		}
		else
		$("#autosuggest-container").empty();
		$("#autosuggest-container").show();
	});
	$("#search-button").click(function(e)
	{	
		var autoSugg=$('#search-textbox').val();
		if(autoSugg=='')
		e.preventDefault();
	});
});
$(document).ready(function(e) {
    $("#error-box1").hide();
	$("#blab-container").show();
	$("#overlay-inside").hide();
	$("#overlay-inside2").hide();
	$("#overlay").hide();
	$("#overlay2").hide();
	$(".getblabs").hide();
	var url="blab_msg_parse.php";
	$.post(url,{},function(data)
	{
		$("#blab-container").html(data);
	});
});
$('#blabform').submit(function(){$('input[type=submit]', this).attr('disabled', 'disabled');});	
$(function() {
	 
	 $(".blabpostbtn").click(function(e){
	    e.preventDefault();
      var blabposterid = $("#blabposterid");
	  var blabcontent = $("#blabcontent");
       var url="blab_msg_parse.php";
      if (blabcontent.val()=="") {
		  e.preventDefault();
           //$("#error-box1").html('Please type a Blab.').fadeIn('slow');

      } else {
		   $.post(url,{ blabid: blabposterid.val(), blab: blabcontent.val(),   } , function(data) {
			  
			   
		 
			   document.blabform.blabcontent.value='';
			   $("#blab-container").html(data);
		   
			   
           });
	  }
	  });
	  
});

$(function() {
 
     $(".newbutton").live("click",function() 
	 {
	
	var url="comment_parse.php";
	var url1="blab_msg_parse.php";
	var blabid=$(this).attr("id");
	var comment=$("#commentcontent"+ blabid);
	if (comment.val() == "") {
		  
      } else {
		 
		  $.post(url,{ comment:comment.val(), blab_id:blabid } ,  function(data) {
			   document.getElementById("commentcontent"+ blabid).value='';
			  
			   
			   $("#comments-box"+blabid).append(data);
			    $("#comment-box"+blabid).focus();
           });
	  }
	 });
	 
	 $(".button_delete").live("click",function()
	 {
		 var url="delete_blabs.php";
		 var url1="blab_msg_parse.php";
		 var blabid=$(this).attr("id");
		 $.post(url,{blab_to_delete:blabid},function(data){
			 
		 });
		  $.post(url1,{ },function(data){
			 $("#blab-container").html(data);
		 });
	 });
	 
	  $(".delete_comments").live("click",function()
	 {
		 var url="delete_comments.php";
		 var url1="blab_msg_parse.php";
		 var commid=$(this).attr("id");
		 $.post(url,{comm_to_delete:commid},function(data){
			 
			 $("#comm"+commid).slideUp();
			  $("#comment-box"+blabid).focus();
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
                    <input type="text" id="search-textbox" class="text-box" placeholder="Search..." name="x" onkeyup="autoSuggest()" autocomplete="off" />
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
        	<p class="labels" id="tags">View Comments</p>
            <div id="results2">
<?php 
if(isset($_GET['value']))
{
	
	$blabberDisplayList = "";
	$blabber_pic="";
	$comments_list="";
	$comm_id="";
	$blabid="";
	$the_blab="";
	$blab_date="";
	$display_comments="";


	$id_value=$_GET['value'];
	$sql_blabs = mysql_query("SELECT blab_id, user_id, blab_content, blab_date FROM blabs where blab_id=$id_value ");
  
    $blabberDisplayList = "";
	$blabber_pic="";
	$comments_list="";
	$comm_id="";

    while($row = mysql_fetch_array($sql_blabs)){
	
	
	$blabid = $row["blab_id"];
	$uid1= $row["user_id"];
	$the_blab = $row["blab_content"];
	$blab_date = $row["blab_date"];
	$blab_d=date_create($blab_date);
	$blab_date = date_format($blab_d, 'h:i a \o\n jS F, Y');
	
	
	// Inner sql query
	$sql_mem_data = mysql_query("SELECT * FROM users WHERE id='$uid1' LIMIT 1");
	
	while($row = mysql_fetch_array($sql_mem_data)){
			$uid = $row["id"];
			$ufirstname = $row["f_name"];
			$ulastname = $row["l_name"];
			$ufirstname = substr($ufirstname, 0, 10);
			///////  Mechanism to Display Pic. See if they have uploaded a pic or not  //////////////////////////
			$blabber_pic = $row['profile_pic'];
			if($blabber_pic=='')
			{
				$blabber_pic='images/blank.jpg';
			}
		$sql_comments=mysql_query("SELECT * FROM comments WHERE id_blab=$id_value ORDER BY comm_date ASC ");
		while($row1=mysql_fetch_array($sql_comments))
		    {
				$comments_list=$row1["comm_content"];
				$commentator=$row1["sender_id"];
				$comm_id=$row1["comm_id"];
				$comm_date=$row1["comm_date"];
				$comm_date_d=date_create($comm_date);
				$comm_date=date_format($comm_date_d, 'h:i a \o\n jS F, Y');
				$retrieve_commentator=mysql_query("SELECT * FROM users WHERE id=$commentator");
				while($results=mysql_fetch_assoc($retrieve_commentator))
				{
					$commentator_pic=$results["profile_pic"];
					if($commentator_pic=='')
					{
						$commentator_pic='images/blank.jpg';
					}
					$f_name=$results["f_name"];
					$l_name=$results["l_name"];
					
					if($commentator==$_SESSION['id'])
					{
					$comments_list_formatted=stripslashes(wordwrap(nl2br($comments_list), 65, "<br>", true));
				$display_comments.='<div class="comments-class" id="comm'.$comm_id.'""><ul class="link-list search-list"><li><a href="profile.php"><img class="search-pic" src='.$commentator_pic.' />'.$f_name.' '.$l_name.'</a><p class="blabs-p">'.$comments_list_formatted.'<br /><span class="time-span-class">@ '.$comm_date.'</span></p><div id="delete-comment-button"><button type="button" id="'.$comm_id.'" class="delete_comments" value="Delete">Delete</button></div></li></ul></div>';
					}
					else
					{
					$comments_list_formatted=stripslashes(wordwrap(nl2br($comments_list), 65, "<br>", true));
				$display_comments.='<div class="comments-class" id="comm'.$comm_id.'"><ul class="link-list search-list"><li><a href="profile-view.php?id='.$commentator.'"><img class="search-pic" src='.$commentator_pic.' />'.$f_name.' '.$l_name.'</a><p class="blabs-p">'.$comments_list_formatted.'<br /><span class="time-span-class">@ '.$comm_date.'</span></p></li></ul></div>';
					}
					
				}
		
			}
			if($_SESSION['id']==$uid1)
			{
			$the_blab_formatted=stripslashes(wordwrap(nl2br($the_blab), 56, "<br>", true));
			$blabberDisplayList .='<div id="" class="results"><form id="blab_post_"'.$uid.'"" method="POST"><ul class="link-list search-list"><li><a href="profile.php"><img class="search-pic1" src='.$blabber_pic.' height="35" width="35"/>'.$ufirstname.'  '.$ulastname.'</a><p class="blabs-p">'.$the_blab_formatted.'<br /><span class="time-span-class">@ '.$blab_date.'</span></p><br />
<div id="comments-box'.$blabid.'">
'.$display_comments.'
</div><form  method="POST" action=""><input type="text" id="commentcontent'.$blabid.'" class="text-box" autocomplete="off" maxlength="200"/> <input type="button" id="'.$blabid.'" class="newbutton" value="Post Comment" /> <button type="button" class="button_delete" id="'.$blabid.'" value="Delete">Delete</button><input type="hidden" name="blabid" id="blabid" value="'.$blabid.'"/></form>
</form></div></li></ul>';
 
     $display_comments="";
			}
		else
		{
		
			
			$the_blab_formatted=stripslashes(wordwrap(nl2br($the_blab), 56, "<br>", true));
			$blabberDisplayList .='<div id="" class="results"><form id="blab_post_"'.$uid.'"" method="POST"><ul class="link-list search-list"><li><a href="profile-view.php?id='.$uid.'"><img class="search-pic1" src='.$blabber_pic.' height="35" width="35"/>'.$ufirstname.'  '.$ulastname.'</a><p class="blabs-p">'.$the_blab_formatted.'<br /><span class="time-span-class">@ '.$blab_date.'</span></p><br />
<div id="comments-box'.$blabid.'">
'.$display_comments.'
</div><form method="POST" action=""><input type="text" id="commentcontent'.$blabid.'" class="text-box" autocomplete="off" maxlength="200"/> <input type="button" class="newbutton" id="'.$blabid.'" value="Post Comment"/><input type="hidden" name="blabid" id="'.$blabid.'" value="'.$blabid.'"/></form>
 </form></div></li></ul>';
         
     $display_comments="";
	 
			
		
			}
		}
	}
		


 
echo $blabberDisplayList;
	
}
else
{
}


?>            </div>
        </div>
        </div>
        </section>
</div>
</body>
</html>