<?php
include("loggedincheck.php");
$blab_id="";
$comment_content="";
$comments_list="";
$comm_date="";
$commentator="";
$comm_id="";
$display_comments="";
$session_id=$_SESSION['id'];
if($_POST)
{
	$blab_id=$_POST['blab_id'];
	$comment_content=$_POST['comment'];
}

if(isset($_POST['comment']))
 {
	$comment_content=htmlspecialchars($comment_content);
	$comment_content=stripslashes($comment_content);
	$comment_content=mysql_real_escape_string($comment_content);
	
	    $selquery='SELECT * from blabs where blab_id="'.$blab_id.'"';
		$selresult=mysql_query($selquery);
		while($row=mysql_fetch_assoc($selresult))
		{
			$user_id=$row['user_id'];
		}
		if($user_id!=$session_id)
		{
		date_default_timezone_set('Asia/Kolkata');
		
		$responsequery="INSERT INTO responses(type,response,id_from,id_to,time,status) values('Blab-Comment','$blab_id','$user_id','$session_id',now(),'Unseen')";
		$responseresult=mysql_query($responsequery);
		}
	 $sql = "INSERT INTO comments(id_blab,comm_content,comm_date,sender_id) VALUES ('$blab_id','$comment_content',now(),$session_id)";
    if (!mysql_query($sql)) { 
	    echo '<img src="images/round_error.png" alt="Error" width="31" height="30" /> &nbsp;  Could not post comment! An insertion query error has occured.';
    } else { 
	   
	   
	}
 }
	$sql_comments=mysql_query("SELECT * FROM comments WHERE sender_id=$session_id ORDER BY comm_id DESC LIMIT 1");
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
				$display_comments='<div class="comments-class" id="comm'.$comm_id.'"><ul class="link-list search-list"><li><a href="profile-view.php?id='.$commentator.'"><img class="search-pic" src='.$commentator_pic.' />'.$f_name.' '.$l_name.'</a><p class="blabs-p">'.$comments_list_formatted.'<br /><span class="time-span-class">@ '.$comm_date.'</span></p><div id="delete-comment-button"><button type="button" id="'.$comm_id.'" class="delete_comments" value="Delete">Delete</button></div></li></ul>';
					}
					else
					{
					$comments_list_formatted=stripslashes(wordwrap(nl2br($comments_list), 65, "<br>", true));
				$display_comments='<div class="comments-class" id="comm'.$comm_id.'"><ul class="link-list search-list"><li><a href="profile-view.php?id='.$commentator.'"><img class="search-pic" src='.$commentator_pic.' />'.$f_name.' '.$l_name.'</a><p class="blabs-p">'.$comments_list_formatted.'<br /><span class="time-span-class">@ '.$comm_date.'</span></p>';
					}
				}
				
			}
		
	echo $display_comments;
//to display the blabs
?>
	 
 
