<?php
include("mysql_connect.php");
include("dbheader.php");
?>

<?php 
sleep(1);
$is_ajax=$_REQUEST['is_ajax'];
if(isset($is_ajax) && $is_ajax)
{
		$email=trim($_REQUEST['email']);
		$query='SELECT * from users where email="'.$email.'"';
		$result=mysql_query($query);
			while($row=mysql_fetch_assoc($result))
			{
				$id=$row['id'];
				$contact_list=$row['contact_list'];
			}
		$contacts=explode(",",$contact_list);
		$contacts_num=count($contacts);
		for($i=0;$i<$contacts_num-1;$i++)
		{
			$new[$i]=$contacts[$i];
		}
		for($i=0;$i<count($new);$i++)
		{
			$query2='SELECT * from users where id="'.$new[$i].'"';
			$result2=mysql_query($query2);
			while($row=mysql_fetch_assoc($result2))
			{
				$friend_contact_list=$row['contact_list'];
			}
			$friend_contacts=explode(",",$friend_contact_list);
			$friend_contacts_num=count($friend_contacts);
			for($j=0;$j<$friend_contacts_num-1;$j++)
			{
				$new_friend[$j]=$friend_contacts[$j];
			}
			for($k=0;$k<count($new_friend);$k++)
			{
				if($new_friend[$k]==$id)
				{
					if(count($new_friend)==1){
					unset($new_friend[$k]);
					$updated_friend_list=implode(",",$new_friend);
					$updatequery='UPDATE users set contact_list="'.$updated_friend_list.'" where id="'.$new[$i].'"';
					$updatequeryresult=mysql_query($updatequery);
					}
					else{
					unset($new_friend[$k]);
					$updated_friend_list=implode(",",$new_friend).",";
					$updatequery='UPDATE users set contact_list="'.$updated_friend_list.'" where id="'.$new[$i].'"';
					$updatequeryresult=mysql_query($updatequery);}
				}
			}			
		}
		$deletequery='DELETE FROM users where id="'.$id.'"';
		$deleteresult=mysql_query($deletequery);
		echo "success";		
		session_start();
		session_unset();
		session_destroy();
}
?>