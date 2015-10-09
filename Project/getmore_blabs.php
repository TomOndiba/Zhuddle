<?php
include("loggedincheck.php");
sleep(1);
$blab_get="";
$get_blabs="";
$blabid="";
$display_comments="";
$row="";
$blabberDisplayList = "";
$comm_date="";
$older="";
$timestamp="";
$list1="";
$sql_contacts="";
$blab_posts1=0;
$status=0;
$count2="";
if(isset($_POST['timeval']))
{
	$blab_get=$_POST['timeval'];
	
	$get_blabs = mysql_query("SELECT blab_id, user_id, blab_content, blab_date,timestamp FROM blabs where $blab_get>timestamp ORDER BY blab_date DESC ");
  $numrows=mysql_num_rows($get_blabs);
  if($numrows==0)
   {
	  echo"";
   }
   else
   {
    
	$sql_contacts=mysql_query("SELECT contact_list FROM users WHERE id='".$_SESSION['id']."'");
	while($ans=mysql_fetch_assoc($sql_contacts))
	{
		$friend_array=$ans['contact_list'];
	}
	$list1=explode(",",$friend_array);
	$blabber_pic="";
	$comments_list="";
	$comm_id="";

    while($row = mysql_fetch_array($get_blabs)){
		if($blab_posts1<3)
		{
	
	$blabid = $row["blab_id"];
	$uid = $row["user_id"];
	$the_blab = $row["blab_content"];
	$blab_date = $row["blab_date"];
	$blab_d=date_create($blab_date);
	$blab_date = date_format($blab_d, 'h:i a \o\n jS F, Y');
	$timestamp=$row["timestamp"];
	// Inner sql query
	$sql_mem_data = mysql_query("SELECT * FROM users WHERE id='$uid' LIMIT 1");
	while($row = mysql_fetch_array($sql_mem_data)){
			
			$ufirstname = $row["f_name"];
			$ulastname = $row["l_name"];
			$ufirstname = substr($ufirstname, 0, 10);
			///////  Mechanism to Display Pic. See if they have uploaded a pic or not  //////////////////////////
			$blabber_pic = $row['profile_pic'];
		$sql_comments=mysql_query("SELECT * FROM comments WHERE id_blab=$blabid ORDER BY comm_date DESC LIMIT 2");
		$sql_comments2=mysql_query("SELECT * FROM comments WHERE id_blab=$blabid ");
		$count2=mysql_num_rows($sql_comments2);
	       if($count2<=2)
					{
					}
					else
					{
						$display_comments='<ul class="link-list search-list"><li><a href="view-comments.php?value='.$blabid.'">View All Comments</a></li></ul>';
					}
		while($row1=mysql_fetch_array($sql_comments))
		    {
				$comments_list=$row1["comm_content"];
				$commentator=$row1["sender_id"];
				$comm_id=$row1["comm_id"];
				$comm_date=$row1['comm_date'];
				$comm_date_d=date_create($comm_date);
				$comm_date=date_format($comm_date_d, 'h:i a \o\n jS F, Y');
				$retrieve_commentator=mysql_query("SELECT * FROM users WHERE id=$commentator");
				while($results=mysql_fetch_assoc($retrieve_commentator))
				{
					$commentator_pic=$results["profile_pic"];
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
			if($_SESSION['id']==$uid)
			{
			$the_blab_formatted=stripslashes(wordwrap(nl2br($the_blab), 56, "<br>", true));
	
			$blabberDisplayList .='<div id="'.$timestamp.'" class="results"><form id="blab_post_"'.$uid.'"" method="POST"><ul class="link-list search-list"><li><a href="profile.php"><img class="search-pic1" src='.$blabber_pic.' height="35" width="35"/>'.$ufirstname.'  '.$ulastname.'</a><p class="blabs-p">'.$the_blab_formatted.'<br /><span class="time-span-class">@ '.$blab_date.'</span></p><form  method="POST" action=""><input type="text" id="commentcontent'.$blabid.'" class="text-box"/> <input type="button" id="'.$blabid.'" class="newbutton" value="Post Comment" /> <input type="button" class="button_delete" id="'.$blabid.'" value="Delete" /><input type="hidden" name="blabid" id="blabid" value="'.$blabid.'"/></form>
<div id="comments-box'.$blabid.'">
'.$display_comments.'
</div>
</form></div></li></ul>';
          $status=1;
		   $blab_posts1=$blab_posts1+1;
     $display_comments="";
			}
		
			
		else 
		{
			foreach($list1 as $friend)
			  {
				  if($friend==$uid)
				  {
			$the_blab_formatted=stripslashes(wordwrap(nl2br($the_blab), 56, "<br>", true));
			$blabberDisplayList .='<div id="'.$timestamp.'" class="results"><form id="blab_post_"'.$uid.'"" method="POST"><ul class="link-list search-list"><li><a href="profile-view.php?id='.$uid.'"><img class="search-pic1" src='.$blabber_pic.' height="35" width="35"/>'.$ufirstname.'  '.$ulastname.'</a><p class="blabs-p">'.$the_blab_formatted.'<br /><span class="time-span-class">@ '.$blab_date.'</span></p><form method="POST" action=""><input type="textbox" id="commentcontent'.$blabid.'" class="text-box"/> <input type="button" class="newbutton" id="'.$blabid.'" value="Post Comment"/><input type="hidden" name="blabid" id="'.$blabid.'" value="'.$blabid.'"/></form>
<div id="comments-box'.$blabid.'">
'.$display_comments.';
</div>
 </form></div></li></ul>';
        $status=1;
		 $blab_posts1=$blab_posts1+1;
     $display_comments="";
		         }
				 else
				 {
					 
				 }
		
			}
		}
	
	}
	}
		else
		{
		}	
}

  $blabberDisplayList.='<br/><br/><div class="getblabs" id="'.$blabid.'" ><br/><br/><img src="images/loader.gif" alt="Error" /></div>';
   }
if($status==1)
{
echo $blabberDisplayList;
$blabberDisplayList="";
}
else
{
	echo "";
}
}
else
{
}
				