// Profile Set Up

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
}
else if(X=='contact-info')
{
	$("#views-box").hide();
	$("#basic-info-box").hide();
	$("#contact-info-box").show();
	$("#privacy-box").hide();
	$("#customize-box").hide();
	$("#contact-info").css("background-color","#dedede");
	$("#basic-info").css("background-color","#fff");
	$("#views").css("background-color","#fff");
	$("#privacy").css("background-color","#fff");
	$("#customize").css("background-color","#fff");
}
else if(X=='views')
{
	$("#views-box").show();
	$("#basic-info-box").hide();
	$("#contact-info-box").hide();
	$("#privacy-box").hide();
	$("#customize-box").hide();
	$("#contact-info").css("background-color","#fff");
	$("#basic-info").css("background-color","#fff");
	$("#views").css("background-color","#dedede");
	$("#privacy").css("background-color","#fff");
	$("#customize").css("background-color","#fff");
}
else if(X=='privacy')
{
	$("#views-box").hide();
	$("#basic-info-box").hide();
	$("#contact-info-box").hide();
	$("#privacy-box").show();
	$("#customize-box").hide();
	$("#contact-info").css("background-color","#fff");
	$("#basic-info").css("background-color","#fff");
	$("#views").css("background-color","#fff");
	$("#privacy").css("background-color","#dedede");
	$("#customize").css("background-color","#fff");
}
else if(X=='customize')
{
	$("#views-box").hide();
	$("#basic-info-box").hide();
	$("#contact-info-box").hide();
	$("#privacy-box").hide();
	$("#customize-box").show();
	$("#contact-info").css("background-color","#fff");
	$("#basic-info").css("background-color","#fff");
	$("#views").css("background-color","#fff");
	$("#privacy").css("background-color","#fff");
	$("#customize").css("background-color","#dedede");
}	});
});

$(document).ready(function(){

	$('#profile-setup-error-box').hide();
	$('#reset-button').click(function(){
			$('#profile-setup-error-box').fadeOut('slow');
			$('.city-selection').hide();
	});
	$('#save-button').click(function(e) {
		
		// prevent forms default action until
		// error check has been performed
		e.preventDefault();
		var valid = '';
		var dob=$('#datepicker').val();
		var phone_no=$('#phone-no-picker').val();
		var mobile_no=$('#mobile-no-picker').val();
		var website=$('#website-picker').val();
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
		var loc_country=$('#parentdrop1').val();
		var loc_city=$('#childdrop51567d9e4e1bb').val();
		var prof=$('#prof-selection').val();
		var relation=$('#relation-selection').val();
		var about_self=$('#about-self').val();
		var website=$('#website-picker').val();
		
		var personal_view=$('#personal-view-textarea').val();
		var social_view=$('#social-view-textarea').val();
		var cultural_view=$('#cultural-view-textarea').val();
		var political_view=$('#political-view-textarea').val();
		
		var bg_color=$("#colorpicker").val();
		var header_color=$("#colorpicker2").val();
		
		if(about_self=='Say something about yourself.')
		{
			about_self='';
		}
		if(relation=='Select')
		{
			relation='';
		}
		if(dob=='DD/MM/YYYY'||prof=='Select'||loc_country=='Country'||loc_city==''||prof=='Select')
		{
			valid='Please fill in the required details.';
		}
		else if(!dob.match(/^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/))
		{
			valid='Please enter valid date format.';
		}
		else if(phone_no!='(022)')
		{
			if(!phone_no.match(/^\(0\d{2}\)\s?\d{8}$/))
			{
				valid='Please enter valid phone number.';
				$("#phone-no-picker").val('(022)');
			}
			else
			{
				if(mobile_no!='+91')
				{
					if(!mobile_no.match(		/^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1}){0,1}9[0-9](\s){0,1}(\-){0,1}(\s){0,1}[1-9]{1}[0-9]{7}$/))
					{
						valid='Please enter valid mobile number.';
						$("#mobile-no-picker").val('+91');
					}	
				}
			}
		}
		else if(mobile_no!='+91')
		{
			if(!mobile_no.match(
/^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1}){0,1}9[0-9](\s){0,1}(\-){0,1}(\s){0,1}[1-9]{1}[0-9]{7}$/))
			{
				valid='Please enter valid mobile number.';
				$("#mobile-no-picker").val('+91');
			}
			else
			{
				if(phone_no!='(022)')
				{
					if(!phone_no.match(/^\(0\d{2}\)\s?\d{8}$/))
					{
						valid='Please enter valid phone number.';
						$("#phone-no-picker").val('(022)');
					}
				}
			}
		}
		else if(website!='')
		{
			if(!website.match( /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/))
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
		if (valid != '') {
			
			$('#profile-setup-error-box').html(''+valid).fadeIn('slow');			
		}
		else {

			//$('#log-error-box').fadeOut('slow');
			$('#logo-div').hide();
			$('#profile-setup-error-box').fadeOut('slow');
			$("#anime-logo-div").css("display","inline");
			var logformData = {dob:dob,loc_country:loc_country,loc_city:loc_city,prof:prof,relation:relation,about_self:about_self,phone_no:phone_no,mobile_no:mobile_no,website:website,pri_dob_1:pri_dob_1,pri_loc_1:pri_loc_1,pri_prof_1:pri_prof_1,pri_rel_1:pri_rel_1,pri_about_self_1:pri_about_self_1,pri_email_1:pri_email_1,pri_phone_no_1:pri_phone_no_1,pri_mobile_no_1:pri_mobile_no_1,pri_website_1:pri_website_1,pri_all_1:pri_all_1,pri_dob_2:pri_dob_2,pri_loc_2:pri_loc_2,pri_prof_2:pri_prof_2,pri_rel_2:pri_rel_2,pri_about_self_2:pri_about_self_2,pri_email_2:pri_email_2,pri_phone_no_2:pri_phone_no_2,pri_mobile_no_2:pri_mobile_no_2,pri_website_2:pri_website_2,pri_all_2:pri_all_2,bg_color:bg_color,header_color:header_color,personal_view:personal_view,social_view:social_view,cultural_view:cultural_view,political_view:political_view,is_ajax:1};
			logsubmitForm(logformData);			
		}	
	});
});

function logsubmitForm(logformData) {
	
	$.ajax({	
		type: 'POST',
		url: 'profile-setup-insert.php',		
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
			$('#profile-setup-error-box').html('Something went wrong.').fadeIn('slow');
		}
		}
	});
	return false;
}
		
	function logredirect()
	{
		var t=setTimeout('window.location="home.php"',2000);
	}

$(document).ready(function()
{	
	$('#edit-location').click(function()
	{
		$("#location").css("display","inline");
	});
	$('#reset-button').click(function()
	{
		$('#error-box').fadeOut('slow');
	});
});



$(document).ready(function()
{
	$('#about-self').focus(function()
	{
		$(this).html("");
		$(this).css("background","#F0F0F0");
	});
	$('#about-self').blur(function()
	{
		$(this).html("Say something about yourself.");
		$(this).css("background","#cbcbcb");
	});
	$('#personal-view-textarea,#social-view-textarea,#cultural-view-textarea,#political-view-textarea').focus(function()
	{
		$(this).html("");
		$(this).css("background","#F0F0F0");
	});
	$('#personal-view-textarea,#social-view-textarea,#cultural-view-textarea,#political-view-textarea').blur(function()
	{
		$(this).html("Share your view.");
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
	});
	$("#close3").click(function()
	{
		$("#overlay-bg").fadeOut("slow");
	});
});

$(document).ready(function()
{
	$(".img-link").click(function(e)
	{
		e.preventDefault();
		$(this).css("background","url(../images/form-bg.png)");
		$(".img").css("padding","5px");
		$(".img").css("border","solid 1px #808080");
	});
	$(".img-link").focus(function(e)
	{
		e.preventDefault();
		$(this).css("background","url(../images/form-bg.png)");
	});
});

$(document).ready(function()
{
	$('#all-checkbox').attr('checked', true);
	$('#all2-checkbox').attr('checked', true);
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
