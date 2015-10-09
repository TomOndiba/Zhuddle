<?php
sleep(1);
include("dbheader.php");
if(isset($_SESSION['email'])&& $_SESSION['state_id']==1)
{
$_SESSION['password']="";
	 // echo"<meta http-equiv=\"refresh\"content=\"0;url=http://localhost/Project/home.php\">";
	 	 $query='SELECT * FROM users WHERE EMAIL="'.$_SESSION['email'].'"';
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
	 else if(isset($_SESSION['email'])&& $_SESSION['state_id']==0)
	 {
	    header("location:welcome.php");
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
<script type="text/javascript" src="js/photoZoom.min.js"></script>
<script type="text/javascript" src="js/profile-update.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
           $("#profile-pic").photoZoom();
		   $(".img-div").photoZoom();
        });
    </script>
    
<script type="text/javascript">

$(document).ready(function() {
	$("#options a,#icons a").click(function()
	{
		$('#logo-div').hide();
		$("#anime-logo-div").css("display","inline");
	});
	$("#add-profile-pic, #change-profile-pic", "#add-bg-image").click(function()
	{
		$('#logo-div').show();
		$("#anime-logo-div").css("display","none");
	});
	
	$("#show-news").click(function()
	{    
		setTimeout(function() {
			$(this).hide();
			$("#hide-news").hide();
			$("iframe").slideDown('slow');
		}, 500);
	});
	$("#hide-news").click(function()
	{
		$(this).hide();
		$("#show-news").show();
		$("iframe").slideUp('slow');
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

$(window).scroll(function(){
if ($(window).scrollTop() == $(document).height() - $(window).height()){
var time=$(".results:last").attr("id");
 var url1="getmore_blabs.php";
		
		 $.post(url1,{timeval:time},function(data){
			 
			 if(data!="")
			 {
				 $(".getblabs").empty();
				 var height=$("#right-box").css("height");
				 $("#main-box").css("height","+=660");
			 }
			 else
			 {
				 $(".getblabs").hide();
			 }
			 $("#blab-container").append(data);
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
				 if($custcount!=0)
				 {
					 if($bgimage=="")
					 {
						echo "<a href='' class=tabbox id=add-bg-image>Add Background</a>";
					 }
					 else
						echo "<a href='' class=tabbox id=remove-bg-image>Remove Background</a>";
				 }
				 else
						echo "<a href='' class=tabbox id=add-bg-image>Add Background</a>";
				?>
                	<a href="responses.php" class="tabbox">Responses&nbsp;<span class="nos">[<?php echo $num_rows_res?>]</span></a>
                    <a href="inbox.php" class="tabbox">Messages&nbsp;<span class="nos">[<?php echo $num_rows_messages?>]</span></a>
                	<a href="contact_requests.php" class="tabbox">Requests&nbsp;<span class="nos">[<?php echo $num_rows?>]</span></a>
                	<a href="contact_list.php" class="tabbox">Contacts&nbsp;<span class="nos">[<?php echo $new_rows?>]</span></a>
                	<a href="games.php" class="tabbox">Games&nbsp;</a>
                </div>
			</div>
		<div id="overlay-bg">
     		<div id="overlay-inside-bg">
                <p id="reply-label" class="labels">Add Background</p>
            	<form enctype="multipart/form-data" method="post" action="image_upload_2.php">
            	<div id="orig-img">
                </div>
          		<input name="uploaded_file" type="file" id="image" class="filebutton" />
                <button type="submit" class="button" id="upload3" value="Upload">Upload</button>
          		<button type="button" class="button" id="close3" value="Close">Close</button>
                <input type="hidden" name="question" id="prev-page" value="3">
				<div id="cropped-img">
                </div>
                </form>
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
            	<div id="orig-img">
                </div>
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
        	<p class="labels" id="tags">News</p>
            
            <button class="button" id="show-news">Show News</button>
            <button class="button" id="hide-news">Hide News</button>
                <!-- start sw-rss-feed code --> 
                <script type="text/javascript"> 
                $("#autosuggest-container").hide();
				$("#overlay").hide();
				$("#overlay2").hide();
				$("#overlay-bg").hide();
				$("#show-news").hide();
                rssfeed_url = new Array(); 
                rssfeed_url[0]="http://rss.people.com/web/people/rss/topheadlines/index.xml";rssfeed_url[1]="http://feeds.bbci.co.uk/news/world/rss.xml";rssfeed_url[1]="rss://sports.espn.go.com/espn/rss/news";  
                rssfeed_frame_width="580"; 
                rssfeed_frame_height="200"; 
                rssfeed_scroll="on"; 
                rssfeed_scroll_step="5"; 
                rssfeed_scroll_bar="on"; 
                rssfeed_target="_blank"; 
                rssfeed_font_size="12"; 
                rssfeed_font_face="Tahoma, Geneva, sans-serif"; 
                rssfeed_border="on"; 
                rssfeed_css_url=""; 
                rssfeed_title="on"; 
                rssfeed_title_name="Latest News"; 
                rssfeed_title_bgcolor="#2D002D"; 
                rssfeed_title_color="#fff"; 
                rssfeed_title_bgimage="http://"; 
                rssfeed_footer="off"; 
                rssfeed_footer_name="rss feed"; 
                rssfeed_footer_bgcolor="#fff"; 
                rssfeed_footer_color="#333"; 
                rssfeed_footer_bgimage="http://"; 
                rssfeed_item_title_length="50"; 
                rssfeed_item_title_color="#2D002D"; 
                rssfeed_item_bgcolor="#fff"; 
                rssfeed_item_bgimage="http://"; 
                rssfeed_item_border_bottom="on"; 
                rssfeed_item_source_icon="off"; 
                rssfeed_item_date="on"; 
                rssfeed_item_description="on"; 
                rssfeed_item_description_length="120"; 
                rssfeed_item_description_color="#000"; 
                rssfeed_item_description_link_color="#333"; 
                rssfeed_item_description_tag="off"; 
                rssfeed_no_items="0"; 
                rssfeed_cache = "eb8df3b8a37b57abc6082eae19b4bc96"; 
                //--> 
                </script> 
                <script type="text/javascript" src="http://feed.surfing-waves.com/js/rss-feed.js"></script> 
            	<div id="blabs">
                    <form action="" enctype="multipart/form-data" method="POST" id="blabform" name="blabform">
                    <input type="text" name="blab-content" class="text-box" id="blabcontent" placeholder="Whats on your mind?" autocomplete="off" maxlength="200"/>
                    <button type="submit" value="Share" class="blabpostbtn" name="blabpost" id="blabsubmitbtn">Share</button>
                    <input type="hidden" name="blabposterid"  id="blabposterid" value="<?php echo $id;?>"/>
                    </form>              
               </div>
               <div id="blab-container">
                </div>
               <div id="error-box1">
               </div>
               </div>
            </div>
	</section>
</div>

</body>
</html>
