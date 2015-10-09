<?php
include("mysql_connect.php");
 function autoSuggest($query,$user_id)
 {  
 $user_id=$user_id; 
 $x=$query;
 $MemberDisplayList="";
 $MemberDisplayList1="";
 $MemberDisplayList2="";
	 $sql3='SELECT id,f_name,l_name ,profile_pic,email FROM users WHERE state=1 and id!="'.$user_id.'" and CONCAT(f_name," ",l_name) LIKE "%'.mysql_real_escape_string($query).'%" Limit 3';
	 $sql2='SELECT id,f_name,l_name ,profile_pic,email FROM users WHERE state=1 and id!="'.$user_id.'" and CONCAT(f_name," ",l_name) LIKE "%'.mysql_real_escape_string($query).'%"';
	 $result=mysql_query($sql3) or die(mysql_error());
	 $result2=mysql_query($sql2) or die(mysql_error());
	 $totalrows2=mysql_num_rows($result2);
	 $totalrows=mysql_num_rows($result);
	 if($totalrows >0)
	 {
		 
	 while($row=mysql_fetch_array($result))
	   {
		   $firstname=$row['f_name'];
		   $lastname=$row['l_name'];
		   $id=$row['id'];
		   $pic=$row['profile_pic'];
		   $email=$row['email'];
		   $blank_img='images/blank.jpg';
		   if($pic!='')
		   {
			$MemberDisplayList .='<ul class="link-list search-list"><li><a href="profile-view.php?id='.$id.'"><img class="search-pic" src='.$pic.' height="35" width="35"/>'.$firstname.'  '.$lastname.'</a><p>'.$email.'</p></li></ul>';
		   }
		   else
		   {
			   $MemberDisplayList1 .='<ul class="link-list search-list"><li><a href="profile-view.php?id='.$id.'"><img class="search-pic" src='.$blank_img.' height="35" width="35"/>'.$firstname.'  '.$lastname.'</a><p>'.$email.'</p></li></ul>';
		   }
	   }
	   $MemberDisplayList2.='<div id="load-more"><center><a href="view_contact.php?x='.$x.'">Load More Results</a></center></div>';
	   if($totalrows2 >3)
	   {
	   		echo $MemberDisplayList.$MemberDisplayList1.$MemberDisplayList2;
	   }
	   else
	   	   echo $MemberDisplayList.$MemberDisplayList1;
	 }
	 else
	 {
		 $MemberDisplayList.='<center><p class="p-class" style="margin:10px 0">No Matches Found.</p></center>';
		 echo $MemberDisplayList;
	 }
 }
 ?>
 
