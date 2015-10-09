<?php 
include("dbheader.php");
$blabberid="";
$blabberDisplayList="";
$display_comments="";
$id="";
$blabid="";
$comm_date="";
$timestamp="";
$uid1="";
$count="";
$blab_posts=0;
if($_POST)
{
$blabberid=$_POST['blabid'];
$prevent_dp = mysql_query("SELECT user_id FROM blabs WHERE user_id='".mysql_real_escape_string($blabberid)."' AND blab_date between subtime(now(),'00000-00-00 00:00:20') and now()");
$nr = mysql_num_rows($prevent_dp);
if ($nr > 0){
	echo 'Please wait 20 seconds between your blab.';
	exit();
}


// Process the blab once it has been sent 
if (isset($_POST['blab'])) { 
  // Escape and prepare our variables for insertion into the database 
  
  
  $time=time();
  $blab = htmlspecialchars($_POST['blab']); // Convert html tags and such to html entities which are safer to store and display
  $blab = mysql_real_escape_string($blab); // Just in case anything malicious is not converted, we escape those characters here
  $blab = mysql_real_escape_string($blab); // Just in case anything malicious is not converted, we escape those characters here
 
    $sql = "INSERT INTO blabs (user_id,blab_content,blab_date,timestamp) VALUES ('$blabberid','$blab',now(),$time)"; 
    if (!mysql_query($sql)) { 
	    echo 'Could not post blab! An insertion query error has occured.';
	}
	else
	{
	}
}
}     

$list="";
	
	$sql_friends=mysql_query("SELECT contact_list FROM users WHERE id='".$_SESSION['id']."'");
	while($result=mysql_fetch_array($sql_friends))
	{
		$friends=$result['contact_list'];
		
	}
	$list=explode("," , $friends);   
	
	$sql_blabs = mysql_query("SELECT blab_id, user_id, blab_content, blab_date,timestamp FROM blabs ORDER BY timestamp DESC  ");
  
    $blabberDisplayList = "";
	$blabber_pic="";
	$comments_list="";
	$comm_id="";
	$older="";
	$friend_id="";

    while($row = mysql_fetch_array($sql_blabs)){
		if($blab_posts<3)
		{
	
	$blabid = $row["blab_id"];
	$older=$row["timestamp"];
	$uid1= $row["user_id"];
	$the_blab = $row["blab_content"];
	$blab_date = $row["blab_date"];
	$blab_d=date_create($blab_date);
	$blab_date = date_format($blab_d, 'h:i a \o\n jS F, Y');
	$timestamp=$row['timestamp'];
	
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
		$sql_comments=mysql_query("SELECT * FROM comments WHERE id_blab=".$blabid." ORDER BY comm_date DESC LIMIT 2");
		$sql_comments1=mysql_query("SELECT * FROM comments WHERE id_blab=$blabid ");
		$count=mysql_num_rows($sql_comments1);
	       if($count<=2)
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
			$blabberDisplayList .='<div id="'.$timestamp.'" class="results"><form id="blab_post_"'.$uid.'"" method="POST"><ul class="link-list search-list"><li><a href="profile.php"><img class="search-pic1" src='.$blabber_pic.' height="35" width="35"/>'.$ufirstname.'  '.$ulastname.'</a><p class="blabs-p">'.$the_blab_formatted.'<br /><span class="time-span-class">@ '.$blab_date.'</span></p><br />
<div id="comments-box'.$blabid.'">
'.$display_comments.'
</div><form  method="POST" action=""><input type="text" id="commentcontent'.$blabid.'" class="text-box" autocomplete="off" maxlength="200"/> <input type="button" id="'.$blabid.'" class="newbutton" value="Post Comment" /> <button type="button" class="button_delete" id="'.$blabid.'" value="Delete">Delete</button><input type="hidden" name="blabid" id="blabid" value="'.$blabid.'"/></form>
</form></div></li></ul>';
 
 $blab_posts=$blab_posts+1;
     $display_comments="";
			}
		else
		{
			
			foreach($list as $friend_id)
			{
			   if($friend_id==$uid1)
				{
			
			$the_blab_formatted=stripslashes(wordwrap(nl2br($the_blab), 56, "<br>", true));
			$blabberDisplayList .='<div id="'.$timestamp.'" class="results"><form id="blab_post_"'.$uid.'"" method="POST"><ul class="link-list search-list"><li><a href="profile-view.php?id='.$uid.'"><img class="search-pic1" src='.$blabber_pic.' height="35" width="35"/>'.$ufirstname.'  '.$ulastname.'</a><p class="blabs-p">'.$the_blab_formatted.'<br /><span class="time-span-class">@ '.$blab_date.'</span></p><br />
<div id="comments-box'.$blabid.'">
'.$display_comments.'
</div><form method="POST" action=""><input type="text" id="commentcontent'.$blabid.'" class="text-box" autocomplete="off" maxlength="200"/> <input type="button" class="newbutton" id="'.$blabid.'" value="Post Comment"/><input type="hidden" name="blabid" id="'.$blabid.'" value="'.$blabid.'"/></form>
 </form></div></li></ul>';
          $blab_posts=$blab_posts+1;
     $display_comments="";
	 
				}
			}
		}
			}
		}
		else
		{
		}
}

  $blabberDisplayList.='<br/><br/><div class="getblabs" id="'.$blabid.'" ><br/><br/><img src="images/loader.gif" alt="Loading" /></div>';
	

echo $blabberDisplayList;
//to display the blabs
?>