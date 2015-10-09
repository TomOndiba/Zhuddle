<?php
include("mysql_connect.php");
include("dbheader.php");
?>
<?php
sleep(1);
$is_ajax=$_REQUEST['is_ajax'];
if(isset($is_ajax) && $is_ajax)
{
	$email=$_SESSION['email'];
	$dbname=$_SESSION['name'];
	$gender=trim($_REQUEST['gender']);
	$dob=trim($_REQUEST['dob']);
	$loc_country=trim($_REQUEST['country']);
	$loc_city=trim($_REQUEST['city']);
	$prof=trim($_REQUEST['prof']);
	$relation=trim($_REQUEST['relation']);
	$about_self=trim($_REQUEST['about_self']);
	$updatephone=$_REQUEST['updatephone'];
	$updatemobile=$_REQUEST['updatemobile'];
	$updatewebsite=$_REQUEST['updatewebsite'];
	
	$pri_dob_1=$_REQUEST['pri_dob_1'];
	$pri_loc_1=$_REQUEST['pri_loc_1'];
	$pri_prof_1=$_REQUEST['pri_prof_1'];
	$pri_rel_1=$_REQUEST['pri_rel_1'];
	$pri_about_self_1=$_REQUEST['pri_about_self_1'];
	$pri_email_1=$_REQUEST['pri_email_1'];
	$pri_phone_no_1=$_REQUEST['pri_phone_no_1'];
	$pri_mobile_no_1=$_REQUEST['pri_mobile_no_1'];
	$pri_website_1=$_REQUEST['pri_website_1'];
	$pri_all_1=$_REQUEST['pri_all_1'];
	$pri_dob_2=$_REQUEST['pri_dob_2'];
	$pri_loc_2=$_REQUEST['pri_loc_2'];
	$pri_prof_2=$_REQUEST['pri_prof_2'];
	$pri_rel_2=$_REQUEST['pri_rel_2'];
	$pri_about_self_2=$_REQUEST['pri_about_self_2'];
	$pri_email_2=$_REQUEST['pri_email_2'];
	$pri_phone_no_2=$_REQUEST['pri_phone_no_2'];
	$pri_mobile_no_2=$_REQUEST['pri_mobile_no_2'];
	$pri_website_2=$_REQUEST['pri_website_2'];
	$pri_all_2=$_REQUEST['pri_all_2'];
	
	$bg_color=$_REQUEST['bg_color'];
	$header_color=$_REQUEST['header_color'];

	$personal_view=$_REQUEST['personal_view'];
	$social_view=$_REQUEST['social_view'];
	$cultural_view=$_REQUEST['cultural_view'];
	$political_view=$_REQUEST['political_view'];
	
	$selquery='SELECT id FROM users WHERE EMAIL="'.$email.'"';
	$selresult=mysql_query($selquery);
	while($row=mysql_fetch_assoc($selresult))
	{
		$id=$row['id'];
	}
		if($gender!='Select')
		{
		$query='UPDATE user_general_info SET gender="'.$gender.'" where id="'.$id.'" ' ;
		$result=mysql_query($query);
		$query7='UPDATE users SET gender="'.$gender.'" where id="'.$id.'" ' ;
		$result7=mysql_query($query7);
		}
		if($dob!='DD/MM/YYYY')
		{
			$query1='UPDATE user_general_info SET dob="'.$dob.'" where id="'.$id.'" ' ;
			$result1=mysql_query($query1);
		}
		if($loc_country!='')
		{
			$query2='UPDATE user_general_info SET location_country="'.$loc_country.'" where id="'.$id.'" ' ;
			$result2=mysql_query($query2);
		}
		if($loc_city!='')
		{
			$query3='UPDATE user_general_info SET location_city="'.$loc_city.'" where id="'.$id.'" ' ;
			$result3=mysql_query($query3);
		}
		if($prof!='Select')
		{
			$query4='UPDATE user_general_info SET profession="'.$prof.'" where id="'.$id.'" ' ;
			$result4=mysql_query($query4);
		}
		if($relation!='Select')
		{
			$query5='UPDATE user_general_info SET relation="'.$relation.'" where id="'.$id.'" ' ;
			$result5=mysql_query($query5);
		}
		if($about_self!=''||$about_self=='')
		{
			$query6='UPDATE user_general_info SET about_self="'.$about_self.'" where id="'.$id.'" ' ;
			$result6=mysql_query($query6);
		}
		
		if($updatephone!='(022)')
		{
			$query7='UPDATE user_contact_info SET phone_no="'.$updatephone.'" where email="'.$email.'" ' ;
			$result7=mysql_query($query7);
		}
		if($updatemobile!='+91')
		{
			$query8='UPDATE user_contact_info SET mobile_no="'.$updatemobile.'" where email="'.$email.'" ' ;
			$result8=mysql_query($query8);
		}
		if($updatewebsite!='')
		{
			$query9='UPDATE user_contact_info SET website="'.$updatewebsite.'" where email="'.$email.'" ' ;
			$result9=mysql_query($query9);
		}
	
	if($pri_dob_1=='true'&&$pri_loc_1=='true'&&$pri_prof_1=='true'&&$pri_rel_1=='true'&&$pri_about_self_1=='true'&&$pri_email_1=='true'&&$pri_phone_no_1=='true'&&$pri_mobile_no_1=='true'&&$pri_website_1=='true')
	{
		$pri_all_1='true';
	}
	if($pri_dob_2=='true'&&$pri_loc_2=='true'&&$pri_prof_2=='true'&&$pri_rel_2=='true'&&$pri_about_self_2=='true'&&$pri_email_2=='true'&&$pri_phone_no_2=='true'&&$pri_mobile_no_2=='true'&&$pri_website_2=='true')
	{
		$pri_all_2='true';
	}
	$selquery='SELECT id FROM users WHERE EMAIL="'.$email.'"';
	$selresult=mysql_query($selquery);
	while($row=mysql_fetch_assoc($selresult))
	{
		$id=$row['id'];
	}
	$query='UPDATE user_privacy_info_everyone SET dob_visibility="'.$pri_dob_1.'",loc_visibility="'.$pri_loc_1.'",prof_visibility="'.$pri_prof_1.'",rel_visibility="'.$pri_rel_1.'",about_self_visibility="'.$pri_about_self_1.'" where id="'.$id.'"' ;
	$result=mysql_query($query);
	$query1='UPDATE user_privacy_info_everyone SET email_visibility="'.$pri_email_1.'" where id="'.$id.'"' ;
	$result1=mysql_query($query1);
	$query2='UPDATE user_privacy_info_everyone SET phone_no_visibility="'.$pri_phone_no_1.'" where id="'.$id.'"' ;
	$result2=mysql_query($query2);
	$query3='UPDATE user_privacy_info_everyone SET mobile_no_visibility="'.$pri_mobile_no_1.'" where id="'.$id.'"' ;
	$result3=mysql_query($query3);
	$query4='UPDATE user_privacy_info_everyone SET website="'.$pri_website_1.'" where id="'.$id.'"' ;
	$result4=mysql_query($query4);
	$query5='UPDATE user_privacy_info_everyone SET full="'.$pri_all_1.'" where id="'.$id.'"';
	$result5=mysql_query($query5);
	
	
	$query6='UPDATE user_privacy_info_contacts SET dob_visibility="'.$pri_dob_2.'",loc_visibility="'.$pri_loc_2.'",prof_visibility="'.$pri_prof_2.'",rel_visibility="'.$pri_rel_2.'",about_self_visibility="'.$pri_about_self_2.'" where id="'.$id.'"' ;
	$result6=mysql_query($query6);
	$query7='UPDATE user_privacy_info_contacts SET email_visibility="'.$pri_email_2.'" where id="'.$id.'"' ;
	$result7=mysql_query($query7);
	$query8='UPDATE user_privacy_info_contacts SET phone_no_visibility="'.$pri_phone_no_2.'" where id="'.$id.'"' ;
	$result8=mysql_query($query8);
	$query9='UPDATE user_privacy_info_contacts SET mobile_no_visibility="'.$pri_mobile_no_2.'" where id="'.$id.'"' ;
	$result9=mysql_query($query9);
	$query10='UPDATE user_privacy_info_contacts SET website="'.$pri_website_2.'" where id="'.$id.'"' ;
	$result10=mysql_query($query10);
	$query11='UPDATE user_privacy_info_contacts SET full="'.$pri_all_2.'" where id="'.$id.'"';
	$result11=mysql_query($query11);
	
	//For Customize
	
	if($bg_color)
	{
		if($header_color)
		{
			$colorquery=mysql_query('SELECT * from customize where id="'.$id.'"');
			$color_rows=mysql_num_rows($colorquery);
			if($color_rows==0)
			{
				$colorinsquery=mysql_query('INSERT INTO customize values("'.$id.'","'.$bg_color.'","'.$header_color.'","")');
			}
			else
			{
					$colorupdatequery=mysql_query('UPDATE customize set bg_color="'.$bg_color.'",header_color="'.$header_color.'" where id="'.$id.'"');
			}
		}
	}
	
	$viewsquery='UPDATE user_views_info set personal_view="'.$personal_view.'",social_view="'.$social_view.'",cultural_view="'.$cultural_view.'",political_view="'.$political_view.'" where id="'.$id.'"';
	$viewsqueryresult1=mysql_query($viewsquery);
				
	echo "success";
}
?>