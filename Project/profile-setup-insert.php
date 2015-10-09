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
	$gender=$_SESSION['gender'];
	$dob=trim($_REQUEST['dob']);
	$loc_country=trim($_REQUEST['loc_country']);
	$loc_city=trim($_REQUEST['loc_city']);
	$prof=trim($_REQUEST['prof']);
	$relation=trim($_REQUEST['relation']);
	$about_self=trim($_REQUEST['about_self']);
	$phone_no=$_REQUEST['phone_no'];
	$mobile_no=$_REQUEST['mobile_no'];
	$website=trim($_REQUEST['website']);
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

	if($pri_dob_1=='true'&&$pri_loc_1=='true'&&$pri_prof_1=='true'&&$pri_rel_1=='true'&&$pri_about_self_1=='true'&&$pri_email_1=='true'&&$pri_phone_no_1=='true'&&$pri_mobile_no_1=='true'&&$pri_website_1=='true')
	{
		$pri_all_1='true';
	}
	if($pri_dob_2=='true'&&$pri_loc_2=='true'&&$pri_prof_2=='true'&&$pri_rel_2=='true'&&$pri_about_self_2=='true'&&$pri_email_2=='true'&&$pri_phone_no_2=='true'&&$pri_mobile_no_2=='true'&&$pri_website_2=='true')
	{
		$pri_all_2='true';
	}
	
	if($phone_no=='(022)')
	{
		$phone_no='';
	}
	if($mobile_no=='+91')
	{
		$mobile_no='';
	}
	$state=1;
	$selquery='SELECT id FROM users WHERE EMAIL="'.$email.'"';
	$selresult=mysql_query($selquery);
	while($row=mysql_fetch_assoc($selresult))
	{
		$id=$row['id'];
	}
	$generalquery='INSERT INTO user_general_info VALUES("'.$id.'","'.$dbname.'","'.$gender.'","'.$dob.'","'.$loc_country.'","'.$loc_city.'","'.$prof.'","'.$relation.'","'.$about_self.'")';
	$generalresult=mysql_query($generalquery);
	$contactquery='INSERT INTO user_contact_info VALUES("'.$email.'","'.$phone_no.'","'.$mobile_no.'","'.$website.'")';
	$contactresult=mysql_query($contactquery);
	$query1='UPDATE users SET state="'.$state.'" where email="'.$email.'"';
	$result1=mysql_query($query1);
	
	$pri_query_1='INSERT INTO user_privacy_info_everyone VALUES("'.$id.'","'.$pri_dob_1.'","'.$pri_loc_1.'","'.$pri_prof_1.'","'.$pri_rel_1.'","'.$pri_about_self_1.'","'.$pri_email_1.'","'.$pri_phone_no_1.'","'.$pri_mobile_no_1.'","'.$pri_website_1.'","'.$pri_all_1.'")';
	$pri_result_1=mysql_query($pri_query_1);
	
	$pri_query_2='INSERT INTO user_privacy_info_contacts VALUES("'.$id.'","'.$pri_dob_2.'","'.$pri_loc_2.'","'.$pri_prof_2.'","'.$pri_rel_2.'","'.$pri_about_self_2.'","'.$pri_email_2.'","'.$pri_phone_no_2.'","'.$pri_mobile_no_2.'","'.$pri_website_2.'","'.$pri_all_2.'")';
	$pri_result_2=mysql_query($pri_query_2);
	
	//For Customize
	
	if($bg_color || $header_color)
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
	
	if($personal_view !='' || $social_view!='' || $cultural_view!='' || $political_view!='')
	{
		$viewsquery=mysql_query('INSERT into user_views_info values("'.$id.'","'.$personal_view.'","'.$social_view.'","'.$cultural_view.'","'.$political_view.'")');
	}
	$_SESSION['state_id']=$state;
	echo "success";
}

?>