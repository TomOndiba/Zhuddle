// Profile Update

$(document).ready(function()
{
	$("#profile-error-box").hide();
	$("#edit-info-container").hide();
	$("#edit-contact-info-container").hide();
	$("#update-button").hide();
	$("#update-button2").hide();
	$("#edit-button2").hide();
	$("#cancel-button").css("opacity","0.5");
	$("#dochange").css("opacity","0.5");
	$("#dochange2").css("opacity","0.5");
	$("#reset-color").css("opacity","0.5");
	$("#reset-color2").css("opacity","0.5");
	$("#upload-bg-image").css("opacity","0.5");
	
	$("#edit-button").click(function()
	{ 
		$("#about-yourself-edit").fadeIn("slow");
		$("#about-self").removeAttr('disabled');
		$("#about-yourself").hide();
		$("#edit-info-container").fadeIn("slow");
		$("#edit-contact-info-container").fadeIn("slow");
		$("#edit-button").hide();
		$("#edit-button2").hide();
		$("#update-button").show();
		$("#update-button2").hide();
		$("#cancel-button").removeAttr('disabled');
		$("#cancel-button").css("opacity","1");
		$(".regular-checkbox").removeAttr('disabled');
		$("#dochange").removeAttr('disabled');
		$("#dochange").css("opacity","1");
		$("#colorpicker").removeAttr('disabled');
		$("#dochange2").removeAttr('disabled');
		$("#dochange2").css("opacity","1");
		$("#colorpicker2").removeAttr('disabled');
		$("#reset-color").css("opacity","1");
		$("#reset-color").removeAttr('disabled');
		$("#reset-color2").css("opacity","1");
		$("#reset-color2").removeAttr('disabled');
		$("#upload-bg-image").removeAttr('disabled');
		$("#upload-bg-image").css("opacity","1");
		$("#personal-view-textarea").removeAttr('disabled');
		$("#social-view-textarea").removeAttr('disabled');
		$("#cultural-view-textarea").removeAttr('disabled');
		$("#political-view-textarea").removeAttr('disabled');
	});
	$("#cancel-button").click(function()
	{
		window.location.reload();
	});
	$("#reset-color").click(function(e)
	{
		e.preventDefault();
		$("#stage").show();
		$("#colorpicker").attr("value","#fff");
		$(this).parent().find(".minicolors-swatch span").css("background-color","#fff");
	});
	$("#reset-color2").click(function(e)
	{
		e.preventDefault();
		$("#colorpicker2").attr("value","#2D002D");
		$(this).parent().find(".minicolors-swatch span").css("background-color","#2D002D");
	});
	$("#edit-button2").click(function()
	{ 
		$("#about-yourself-edit").fadeIn("slow");
		$("#about-self").removeAttr('disabled');
		$("#about-yourself").hide();
		$("#edit-info-container").fadeIn("slow");
		$("#edit-contact-info-container").fadeIn("slow");
		$("#edit-button2").hide();
		$("#update-button2").show();
		$("#cancel-button").removeAttr('disabled');
		$("#cancel-button").css("opacity","1");
		$(".regular-checkbox").removeAttr('disabled');
		$("#dochange").removeAttr('disabled');
		$("#dochange").css("opacity","1");
		$("#colorpicker").removeAttr('disabled');
		$("#dochange2").removeAttr('disabled');
		$("#dochange2").css("opacity","1");
		$("#colorpicker2").removeAttr('disabled');
		$("#reset-color").css("opacity","1");
		$("#reset-color").removeAttr('disabled');
		$("#reset-color2").css("opacity","1");
		$("#reset-color2").removeAttr('disabled');
		$("#personal-view-textarea").removeAttr('disabled');
		$("#social-view-textarea").removeAttr('disabled');
		$("#cultural-view-textarea").removeAttr('disabled');
		$("#political-view-textarea").removeAttr('disabled');
	});
});


$(document).ready(function()
{
	$("#about-yourself-edit").hide();
	if($('#about-yourself > p').is(':empty')) {
		$("#about-yourself").hide(); 
		$("#about-yourself-edit").show();
	}
	else
	{
		
	}
	var personal_view_info=$('#personal-view-textarea').val();
	var social_view_info=$('#social-view-textarea').val();
	var cultural_view_info=$('#cultural-view-textarea').val();
	var political_view_info=$('#political-view-textarea').val();

	$('#personal-view-textarea,#social-view-textarea,#cultural-view-textarea,#political-view-textarea').focus(function()
	{
		$(this).html("");
		$(this).css("background","#F0F0F0");
	});
	$('#personal-view-textarea,#social-view-textarea,#cultural-view-textarea,#political-view-textarea').blur(function()
	{
		$(this).css("background","#cbcbcb");
		var id=$(this).attr('id');
		if(id=='personal-view-textarea')
		{
			$(this).html(personal_view_info);
		}
		if(id=='social-view-textarea')
		{
			$(this).html(social_view_info);
		}
		if(id=='cultural-view-textarea')
		{
			$(this).html(cultural_view_info);
		}
		if(id=='political-view-textarea')
		{
			$(this).html(political_view_info);
		}
	});
});

$(document).ready(function()
{
	$("#contact-info-box").hide();
	$("#views-box").hide();
	$("#privacy-box").hide();
	$("#customize-box").hide();
	$(".tab").click(function(e)
	{
	e.preventDefault();
var X=$(this).attr('id');

if(X=='basic-info')
{
	$("#basic-info-box").show();
	$("#contact-info-box").hide();
	$("#views-box").hide();
	$("#privacy-box").hide();
	$("#customize-box").hide();
	$("#basic-info").css("background-color","#dedede");
	$("#contact-info").css("background-color","#fff");
	$("#views").css("background-color","#fff");
	$("#privacy").css("background-color","#fff");
	$("#customize").css("background-color","#fff");
	if($("#edit-button2").is(":visible"))
	{
		$("#edit-button2").hide();
		$("#edit-button").show();
	}
	if($("#update-button2").is(":visible"))
	{
		$("#update-button2").hide();
		$("#update-button").show();
	}
}
else if(X=='contact-info')
{
	$("#contact-info").css("background-color","#dedede");
	$("#basic-info").css("background-color","#fff");
	$("#views").css("background-color","#fff");
	$("#privacy").css("background-color","#fff");
	$("#customize").css("background-color","#fff");
	$("#views-box").hide();
	$("#basic-info-box").hide();
	$("#customize-box").hide();
	$("#contact-info-box").show();
	$("#privacy-box").hide();
	if($("#edit-button2").is(":visible"))
	{
		$("#edit-button2").hide();
		$("#edit-button").show();
	}
		if($("#update-button2").is(":visible"))
	{
		$("#update-button2").hide();
		$("#update-button").show();
	}
}
else if(X=='views')
{
	$("#contact-info").css("background-color","#fff");
	$("#basic-info").css("background-color","#fff");
	$("#views").css("background-color","#dedede");
	$("#privacy").css("background-color","#fff");
	$("#customize").css("background-color","#fff");
	$("#views-box").show();
	$("#basic-info-box").hide();
	$("#contact-info-box").hide();
	$("#privacy-box").hide();
	$("#customize-box").hide();
	if($("#edit-button2").is(":visible"))
	{
		$("#edit-button2").hide();
		$("#edit-button").show();
	}
		if($("#update-button2").is(":visible"))
	{
		$("#update-button2").hide();
		$("#update-button").show();
	}
}
else if(X=='privacy')
{
	$("#contact-info").css("background-color","#fff");
	$("#basic-info").css("background-color","#fff");
	$("#views").css("background-color","#fff");
	$("#privacy").css("background-color","#dedede");
	$("#customize").css("background-color","#fff");
	$("#views-box").hide();
	$("#basic-info-box").hide();
	$("#contact-info-box").hide();
	$("#privacy-box").show();
	$("#customize-box").hide();
	if($("#edit-button").is(":visible"))
	{
		$("#edit-button").hide();
		$("#edit-button2").show();
	}
	if($("#update-button").is(":visible"))
	{
		$("#update-button").hide();
		$("#update-button2").show();
	}
}
else if(X=='customize')
{
	$("#contact-info").css("background-color","#fff");
	$("#basic-info").css("background-color","#fff");
	$("#views").css("background-color","#fff");
	$("#privacy").css("background-color","#fff");
	$("#customize").css("background-color","#dedede");
	$("#views-box").hide();
	$("#basic-info-box").hide();
	$("#contact-info-box").hide();
	$("#privacy-box").hide();
	$("#customize-box").show();
	if($("#edit-button").is(":visible"))
	{
		$("#edit-button").hide();
		$("#edit-button2").show();
	}
	if($("#update-button").is(":visible"))
	{
		$("#update-button").hide();
		$("#update-button2").show();
	}
}
	});
	
});

$(document).ready(function()
{

$('#update-button').click(function(e) {
		
		// prevent forms default action until
		// error check has been performed
		e.preventDefault();
		var valid = '';
		var gender=$("#gender-select").val();
		var dob=$("#dateeditpicker").val();
		var country=$("#parentdrop1").val();
		var city=$("#childdrop51567d9e4e1bb").val();
		var prof=$("#prof-selection").val();
		var relation=$("#relation-selection").val();
		var about_self=$("#about-self").val();
		var about_self_orig=$("#about-yourself-text").text();
		var updatephone=$("#updatephoneno").val();
		var updatemobile=$("#updatemobileno").val();
		var updatewebsite=$("#updatewebsite").val();
		
		var pri_dob_1=$('#dob-checkbox').is(':checked');
		var pri_loc_1=$('#loc-checkbox').is(':checked');
		var pri_prof_1=$('#prof-checkbox').is(':checked');
		var pri_rel_1=$('#rel-checkbox').is(':checked');
		var pri_about_self_1=$('#about-self-checkbox').is(':checked');
		var pri_email_1=$('#email-checkbox').is(':checked');
		var pri_phone_no_1=$('#phone-no-checkbox').is(':checked');
		var pri_mobile_no_1=$('#mobile-no-checkbox').is(':checked');
		var pri_website_1=$('#website-checkbox').is(':checked');
		var pri_all_1=$('#all-checkbox').is(':checked');
		var pri_dob_2=$('#dob2-checkbox').is(':checked');
		var pri_loc_2=$('#loc2-checkbox').is(':checked');
		var pri_prof_2=$('#prof2-checkbox').is(':checked');
		var pri_rel_2=$('#rel2-checkbox').is(':checked');
		var pri_about_self_2=$('#about-self2-checkbox').is(':checked');
		var pri_email_2=$('#email2-checkbox').is(':checked');
		var pri_phone_no_2=$('#phone-no2-checkbox').is(':checked');
		var pri_mobile_no_2=$('#mobile-no2-checkbox').is(':checked');
		var pri_website_2=$('#website2-checkbox').is(':checked');
		var pri_all_2=$('#all2-checkbox').is(':checked');
		
		var bg_color=$("#colorpicker").val();
		var header_color=$("#colorpicker2").val();
		
		var personal_view=$("#personal-view-textarea").val();
		var social_view=$("#social-view-textarea").val();
		var cultural_view=$("#cultural-view-textarea").val();
		var political_view=$("#political-view-textarea").val();
		
		var personal_view_hidden=$("#personal-view-hidden").val();
		var social_view_hidden=$("#social-view-hidden").val();
		var cultural_view_hidden=$("#cultural-view-hidden").val();
		var political_view_hidden=$("#political-view-hidden").val();
		
		if(gender=='Select'&&dob=='DD/MM/YYYY'&&prof=='Select'&&country==''&&relation=='Select'&&about_self==about_self_orig&&updatephone=='(022)'&&updatemobile=='+91'&&updatewebsite==''&&personal_view==personal_view_hidden&&social_view==social_view_hidden&&cultural_view==cultural_view_hidden&&political_view==political_view_hidden)
		{
			valid='There is nothing to update.';
		}
		else if(dob!='DD/MM/YYYY')
		{
			if(!dob.match(/^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/))
			valid='Please enter valid date format.';
		}
		else if(updatephone!='(022)')
		{
			if(!updatephone.match(/^\(0\d{2}\)\s?\d{8}$/))
			{
				valid='Please enter valid phone number.';
				$("#updatephoneno").val('(022)');
			}
			else
			{
				if(updatemobile!='+91')
				{
					if(!updatemobile.match(		/^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1}){0,1}9[0-9](\s){0,1}(\-){0,1}(\s){0,1}[1-9]{1}[0-9]{7}$/))
					{
						valid='Please enter valid mobile number.';
						$("#updatemobileno").val('+91');
					}	
				}
			}
		}
		else if(updatemobile!='+91')
		{
			if(!updatemobile.match(
/^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1}){0,1}9[0-9](\s){0,1}(\-){0,1}(\s){0,1}[1-9]{1}[0-9]{7}$/))
			{
				valid='Please enter valid mobile number.';
				$("#updatemobileno").val('+91');
			}	
			else
			{
				if(updatephone!='(022)')
				{
					if(!updatephone.match(/^\(0\d{2}\)\s?\d{8}$/))
					{
						valid='Please enter valid phone number.';
						$("#updatephoneno").val('(022)');
					}
				}
			}
		}
		else if(updatewebsite!='')
		{
			if(!updatewebsite.match( /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/))
			{
				valid='Please enter valid website.';
			}
		}
		else if(pri_dob_1==false&&pri_loc_1==false&&pri_prof_1==false&&pri_rel_1==false&&pri_about_self_1==false&&pri_email_1==false&&pri_phone_no_1==false&&pri_mobile_no_1==false&&pri_website_1==false&&pri_all_1==false)
		{
			valid='Please enter your privacy settings.';
		}
		else if(pri_dob_2==false&&pri_loc_2==false&&pri_prof_2==false&&pri_rel_2==false&&pri_about_self_2==false&&pri_email_2==false&&pri_phone_no_2==false&&pri_mobile_no_2==false&&pri_website_2==false&&pri_all_2==false)
		{
			valid='Please enter your privacy settings.';
		}
		else if(personal_view=='Share your view.'||social_view=='Share your view.'||cultural_view=='Share your view.'||political_view=='Share your view.')
		{
		}
		if (valid != '') {
			
			$('#profile-error-box').html(''+valid).fadeIn('slow');			
		}
		else {
			
			//$('#log-error-box').fadeOut('slow');
			$('#logo-div').hide();
			$("#profile-error-box").fadeOut('slow');
			$("#anime-logo-div").css("display","inline");
			var logformData = {gender:gender,dob:dob,country:country,city:city,prof:prof,relation:relation,about_self:about_self,updatephone:updatephone,updatemobile:updatemobile,updatewebsite:updatewebsite,pri_dob_1:pri_dob_1,pri_loc_1:pri_loc_1,pri_prof_1:pri_prof_1,pri_rel_1:pri_rel_1,pri_about_self_1:pri_about_self_1,pri_email_1:pri_email_1,pri_phone_no_1:pri_phone_no_1,pri_mobile_no_1:pri_mobile_no_1,pri_website_1:pri_website_1,pri_all_1:pri_all_1,pri_dob_2:pri_dob_2,pri_loc_2:pri_loc_2,pri_prof_2:pri_prof_2,pri_rel_2:pri_rel_2,pri_about_self_2:pri_about_self_2,pri_email_2:pri_email_2,pri_phone_no_2:pri_phone_no_2,pri_mobile_no_2:pri_mobile_no_2,pri_website_2:pri_website_2,pri_all_2:pri_all_2,bg_color:bg_color,header_color:header_color,personal_view:personal_view,social_view:social_view,cultural_view:cultural_view,political_view:political_view,is_ajax:1};
			logsubmitForm(logformData);			
		}		
	});
});

function logsubmitForm(logformData) {
	
	$.ajax({	
		type: 'POST',
		url: 'profile-update.php',		
		data: logformData,
		success:function(response)
		{
		if(response == 'success')
		{
			logredirect();
		}
		else
		{
			$('#logo-div').show();
			$("#anime-logo-div").css("display","none");
			$('#profile-error-box').html('Something went wrong.').fadeIn('slow');
		}
		}
	});
	return false;
}
		
	function logredirect()
	{
		var t=setTimeout('window.location="profile.php"',2000);
	}
$(document).ready(function()
{
$('#update-button2').click(function(e) {
		
		// prevent forms default action until
		// error check has been performed
		e.preventDefault();
		var valid1 = '';
		var gender=$("#gender-select").val();
		var dob=$("#dateeditpicker").val();
		var country=$("#parentdrop1").val();
		var city=$("#childdrop51567d9e4e1bb").val();
		var prof=$("#prof-selection").val();
		var relation=$("#relation-selection").val();
		var about_self=$("#about-self").val();
		var about_self_orig=$("#about-yourself-text").text();
		var updatephone=$("#updatephoneno").val();
		var updatemobile=$("#updatemobileno").val();
		var updatewebsite=$("#updatewebsite").val();
		
		var pri_dob_1=$('#dob-checkbox').is(':checked');
		var pri_loc_1=$('#loc-checkbox').is(':checked');
		var pri_prof_1=$('#prof-checkbox').is(':checked');
		var pri_rel_1=$('#rel-checkbox').is(':checked');
		var pri_about_self_1=$('#about-self-checkbox').is(':checked');
		var pri_email_1=$('#email-checkbox').is(':checked');
		var pri_phone_no_1=$('#phone-no-checkbox').is(':checked');
		var pri_mobile_no_1=$('#mobile-no-checkbox').is(':checked');
		var pri_website_1=$('#website-checkbox').is(':checked');
		var pri_all_1=$('#all-checkbox').is(':checked');
		var pri_dob_2=$('#dob2-checkbox').is(':checked');
		var pri_loc_2=$('#loc2-checkbox').is(':checked');
		var pri_prof_2=$('#prof2-checkbox').is(':checked');
		var pri_rel_2=$('#rel2-checkbox').is(':checked');
		var pri_about_self_2=$('#about-self2-checkbox').is(':checked');
		var pri_email_2=$('#email2-checkbox').is(':checked');
		var pri_phone_no_2=$('#phone-no2-checkbox').is(':checked');
		var pri_mobile_no_2=$('#mobile-no2-checkbox').is(':checked');
		var pri_website_2=$('#website2-checkbox').is(':checked');
		var pri_all_2=$('#all2-checkbox').is(':checked');
		
		var bg_color=$("#colorpicker").val();
		var header_color=$("#colorpicker2").val();
		
		var personal_view=$("#personal-view-textarea").val();
		var social_view=$("#social-view-textarea").val();
		var cultural_view=$("#cultural-view-textarea").val();
		var political_view=$("#political-view-textarea").val();
		
		var personal_view_hidden=$("#personal-view-hidden").val();
		var social_view_hidden=$("#social-view-hidden").val();
		var cultural_view_hidden=$("#cultural-view-hidden").val();
		var political_view_hidden=$("#political-view-hidden").val();

		
		if(gender=='Select'&&dob=='DD/MM/YYYY'&&prof=='Select'&&country==''&&relation=='Select'&&about_self==about_self_orig&&updatephone=='(022)'&&updatemobile=='+91'&&updatewebsite==''&&personal_view==personal_view_hidden&&social_view==social_view_hidden&&cultural_view==cultural_view_hidden&&political_view==political_view_hidden)
		{
			valid1='There is nothing to update.';
		}
		else if(dob!='DD/MM/YYYY')
		{
			if(!dob.match(/^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/))
			valid1='Please enter valid date format.';
		}
		else if(updatephone!='(022)')
		{
			if(!updatephone.match(/^\(0\d{2}\)\s?\d{8}$/))
			{
				valid='Please enter valid phone number.';
				$("#updatephoneno").val('(022)');
			}
			else
			{
				if(updatemobile!='+91')
				{
					if(!updatemobile.match(		/^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1}){0,1}9[0-9](\s){0,1}(\-){0,1}(\s){0,1}[1-9]{1}[0-9]{7}$/))
					{
						valid='Please enter valid mobile number.';
						$("#updatemobileno").val('+91');
					}	
				}
			}
		}
		else if(updatemobile!='+91')
		{
			if(!updatemobile.match(
/^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1}){0,1}9[0-9](\s){0,1}(\-){0,1}(\s){0,1}[1-9]{1}[0-9]{7}$/))
			{
				valid='Please enter valid mobile number.';
				$("#updatemobileno").val('+91');
			}	
			else
			{
				if(updatephone!='(022)')
				{
					if(!updatephone.match(/^\(0\d{2}\)\s?\d{8}$/))
					{
						valid='Please enter valid phone number.';
						$("#updatephoneno").val('(022)');
					}
				}
			}
		}
		else if(updatewebsite!='')
		{
			if(!updatewebsite.match( /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/))
			{
				valid1='Please enter valid website.';
			}
		}
		else if(pri_dob_1==false&&pri_loc_1==false&&pri_prof_1==false&&pri_rel_1==false&&pri_about_self_1==false&&pri_email_1==false&&pri_phone_no_1==false&&pri_mobile_no_1==false&&pri_website_1==false&&pri_all_1==false)
		{
			valid1='Please enter your privacy settings.';
		}
		else if(pri_dob_2==false&&pri_loc_2==false&&pri_prof_2==false&&pri_rel_2==false&&pri_about_self_2==false&&pri_email_2==false&&pri_phone_no_2==false&&pri_mobile_no_2==false&&pri_website_2==false&&pri_all_2==false)
		{
			valid1='Please enter your privacy settings.';
		}
		if (valid1 != '') {
			
			$('#profile-error-box').html(''+valid1).fadeIn('slow');			
		}
		else {

			//$('#log-error-box').fadeOut('slow');
			$('#logo-div').hide();
			$('#profile-error-box').fadeOut('slow');
			$("#anime-logo-div").css("display","inline");
			var logformData1 = {gender:gender,dob:dob,country:country,city:city,prof:prof,relation:relation,about_self:about_self,updatephone:updatephone,updatemobile:updatemobile,updatewebsite:updatewebsite,pri_dob_1:pri_dob_1,pri_loc_1:pri_loc_1,pri_prof_1:pri_prof_1,pri_rel_1:pri_rel_1,pri_about_self_1:pri_about_self_1,pri_email_1:pri_email_1,pri_phone_no_1:pri_phone_no_1,pri_mobile_no_1:pri_mobile_no_1,pri_website_1:pri_website_1,pri_all_1:pri_all_1,pri_dob_2:pri_dob_2,pri_loc_2:pri_loc_2,pri_prof_2:pri_prof_2,pri_rel_2:pri_rel_2,pri_about_self_2:pri_about_self_2,pri_email_2:pri_email_2,pri_phone_no_2:pri_phone_no_2,pri_mobile_no_2:pri_mobile_no_2,pri_website_2:pri_website_2,pri_all_2:pri_all_2,bg_color:bg_color,header_color:header_color,personal_view:personal_view,social_view:social_view,cultural_view:cultural_view,political_view:political_view,is_ajax:1};
			logsubmitForm1(logformData1);			
		}	
});
});
function logsubmitForm1(logformData1) {
	
	$.ajax({	
		type: 'POST',
		url: 'profile-update1.php',		
		data: logformData1,
		success:function(response)
		{
		if(response == 'success')
		{
			logredirect();
		}
		else
		{
			$('#logo-div').show();
			$("#anime-logo-div").css("display","none");
			$('#profile-error-box').html('Something went wrong.').fadeIn('slow');
		}
		}
	});
	return false;
}

$(document).ready(function()
{
	$('#about-self').focus(function()
	{
		$(this).css("background","#F0F0F0");
	});
	$('#about-self').blur(function()
	{
		$(this).css("background","#cbcbcb");
	});
});

$(document).ready(function()
{
	$("#overlay").hide();
	$("#overlay2").hide();
	$("#overlay-bg").hide();
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
	$("#add-bg-image").click(function(e)
	{
		e.preventDefault();
		$("#overlay-bg").fadeIn("slow");
		$("#overlay-inside-bg").fadeIn("slow");
	});
	$("#remove-bg-image").click(function(e)
	{
		e.preventDefault();
		var prev_page=$("#prev-page").val();
		$('#logo-div').hide();
		$("#anime-logo-div").css("display","inline");
		$.ajax({
		type:'POST',
		url:'img_bg_remove.php',
		data:{'prev_page':prev_page},
		success:function(response)
		{
		if(response == 'successprofilesetup')
		{
			var t=setTimeout('window.location="profile-setup.php"',2000);
		}
		else if(response == 'successprofile')
		{
			var t=setTimeout('window.location="profile.php"',2000);
		}
		else if(response == 'successhome')
		{
			var t=setTimeout('window.location="home.php"',2000);
		}
		else
		{
			$('#logo-div').show();
			$("#anime-logo-div").css("display","none");
			$('#profile-setup-error-box').html('Something went wrong.').fadeIn('slow');
		}
		}
		});
		return false;
	});
	$("#close").click(function()
	{
		$("#overlay").fadeOut("slow");
	});
	$("#close2").click(function()
	{
		$("#overlay2").fadeOut("slow");
		window.location.reload();
	});
	$("#close3").click(function()
	{
		$("#overlay-bg").fadeOut("slow");
	});
});

$(document).ready(function()
{
	$(".regular-checkbox").attr("disabled", true);
});


$(document).ready(function()
{
	$("#dob-checkbox, #loc-checkbox, #prof-checkbox, #rel-checkbox, #about-self-checkbox, #email-checkbox, #phone-no-checkbox, #mobile-no-checkbox, #website-checkbox").click(function()
	{
		if($('#dob-checkbox').is(':checked')==true||$('#loc-checkbox').is(':checked')==true||$('#prof-checkbox').is(':checked')==true||$('#rel-checkbox').is(':checked')==true||$('#about-self-checkbox').is(':checked')==true||$('#email-checkbox').is(':checked')==true||$('#phone-no-checkbox').is(':checked')==true||$('#mobile-no-checkbox').is(':checked')==true||$('#website-checkbox').is(':checked')==true)
		{
				$('#all-checkbox').attr('checked', false);
		}
	});
	$("#all-checkbox").click(function()
	{
		$('#dob-checkbox').attr('checked', false);
		$('#loc-checkbox').attr('checked', false);
		$('#prof-checkbox').attr('checked', false);
		$('#about-self-checkbox').attr('checked', false);
		$('#rel-checkbox').attr('checked', false);
		$('#email-checkbox').attr('checked', false);
		$('#phone-no-checkbox').attr('checked', false);
		$('#mobile-no-checkbox').attr('checked', false);
		$('#website-checkbox').attr('checked', false);
	});	
	
	$("#dob2-checkbox, #loc2-checkbox, #prof2-checkbox, #rel2-checkbox, #about-self2-checkbox, #email2-checkbox, #phone-no2-checkbox, #mobile-no2-checkbox, #website2-checkbox").click(function()
	{
		if($('#dob2-checkbox').is(':checked')==true||$('#loc2-checkbox').is(':checked')==true||$('#prof2-checkbox').is(':checked')==true||$('#rel2-checkbox').is(':checked')==true||$('#about-self2-checkbox').is(':checked')==true||$('#email2-checkbox').is(':checked')==true||$('#phone-no2-checkbox').is(':checked')==true||$('#mobile-no2-checkbox').is(':checked')==true||$('#website2-checkbox').is(':checked')==true)
		{
				$('#all2-checkbox').attr('checked', false);
		}
	});
	
	$("#all2-checkbox").click(function()
	{
		$('#dob2-checkbox').attr('checked', false);
		$('#loc2-checkbox').attr('checked', false);
		$('#prof2-checkbox').attr('checked', false);
		$('#about-self2-checkbox').attr('checked', false);
		$('#rel2-checkbox').attr('checked', false);
		$('#email2-checkbox').attr('checked', false);
		$('#phone-no2-checkbox').attr('checked', false);
		$('#mobile-no2-checkbox').attr('checked', false);
		$('#website2-checkbox').attr('checked', false);
	});	
});

$(document).ready(function()
{
	$("#upload-button").click(function()
	{
		$('#logo-div').hide();
		$("#anime-logo-div").css("display","inline");
	});
});

$(document).ready(function()
{
	$('#change-password-box').hide();
	$("#change-password-error-box").hide();
	$('#change-password-link').click(function(e)
	{
		e.preventDefault();
		$('#change-password-box').fadeIn('slow');
	});
	$("#cancel-change-password").click(function(e)
	{
		$('#change-password-box').fadeOut('slow');
		document.getElementById("existing-password").value='';
		document.getElementById("new-password").value='';
	});
	$("#save-change-password").click(function(e)
	{
		e.preventDefault();
		var existing_password=$("#existing-password").val();
		var new_password=$("#new-password").val();
		var dbpassword=$("#dbpassword").val();
		if(existing_password==''||new_password=='')
		{
			$("#change-password-error-box").fadeIn('slow').html('Please fill in the fields.');
		}
		else if(existing_password!=dbpassword)
		{
			$("#change-password-error-box").fadeIn('slow').html('This password does not match.');
		}
		else if(new_password==existing_password)
		{
			$("#change-password-error-box").fadeIn('slow').html('The new password is the same.');
		}
		else if(new_password.length>16||new_password.length<8)
		{
			$("#change-password-error-box").fadeIn('slow').html('Enter new password with 8 to 20 characters.');
		}
		else
		{
			$('#logo-div').hide();
			$("#anime-logo-div").css("display","inline");
			$('#change-password-error-box').fadeOut('slow');
			var formData = {existing_password:existing_password,new_password:new_password,is_ajax:1};
			changepasswordsubmitForm(formData);			
		}
	});
});

function changepasswordsubmitForm(formData)
{
		$.ajax({	
		type: 'POST',
		url: 'reset-password.php',		
		data: formData,
		success:function(response)
		{
		if(response)
		{
			$('#change-password-error-box').css("border","#1F8532 inset 1px").css("color","#1F8532").html('Password Changed Successfully.').fadeIn('slow');
			$('#logo-div').show();
			$("#anime-logo-div").css("display","none");
			$('#change-password-box').fadeOut(3000);
		}
		else
		{
			$('#logo-div').show();
			$("#anime-logo-div").css("display","none");
			$('#change-password-error-box').html('Something went wrong.').fadeIn('slow');
		}
		}
	});
	return false;
}

$(document).ready(function()
{
	$('#delete-account-box').hide();
	$('#delete-account-error-box').hide();
	$('#delete-account-link').click(function(e)
	{
		e.preventDefault();
		$('#delete-account-box').fadeIn('slow');
	});
	$('#cancel-delete-account').click(function()
	{
		$('#delete-account-box').fadeOut('slow');
	});
	$('#delete-account-confirm').click(function(e)
	{
		e.preventDefault();
		var email=$('#dbemail').val();
		var formData={email:email,is_ajax:1};
		$('#logo-div').hide();
		$("#anime-logo-div").css("display","inline");
		
		$.ajax({	
		type: 'POST',
		url: 'delete-account.php',		
		data: formData,
		success:function(response)
		{
		if(response)
		{
			$('#delete-account-error-box').css("border","#1F8532 inset 1px").css("color","#1F8532").html('Account Deactivated Successfully.').fadeIn('slow');
			$('#logo-div').show();
			$("#anime-logo-div").css("display","none");
			$('#change-password-box').fadeOut(3000);
			window.location.reload();
		}
		else
		{
			$('#logo-div').show();
			$("#anime-logo-div").css("display","none");
			$('#change-password-error-box').html('Something went wrong.'+response).fadeIn('slow');
		}
		}
	});
	});
});