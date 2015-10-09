$(document).ready(function() {
	$("#test").hide();
	$('#log-error-box').hide();
	
$('#log-in-button').click(function(e) {
		
		// prevent forms default action until
		// error check has been performed
		e.preventDefault();
		var valid1 = '';
		var logemail=$('#email').val();
		var e=logemail.toLowerCase();
		var logpassword=$('#password').val();
		
		if (logemail==''||logpassword=='')
		{
			valid1 = 'Please fill in all the details.';	
		}
		if (valid1 != '') {
			
			$('#log-error-box').html(''+valid1).fadeIn('slow');			
		}
		// let the user know something is happening behind the scenes
		// serialize the form data and send to our ajax function
		else {
			
			//$('#log-error-box').fadeOut('slow');
			$('#logo-div').hide();
			$("#anime-logo-div").css("display","inline");
			var logformData = {logemail:e,logpassword:logpassword,is_ajax:1};
			logsubmitForm(logformData);			
		}	
	});
});

function logsubmitForm(logformData) {
	
	$.ajax({	
		type: 'POST',
		url: 'login1.php',		
		data: logformData,
		success:function(response)
		{
		if(response == 'successhome')
		{
			logredirecthome();
		}
		else if(response == 'successwelcome')
		{
			logredirectwelcome();
		}
		else if(response=='successadmin')
		{
			admin();
		}	
		else if(response=='successconfirm')
		{
			logredirectconfirm();
		}
		else
		{
			$('#logo-div').show();
			$("#anime-logo-div").css("display","none");
			$('#log-error-box').html('Invalid email or password.').fadeIn('slow');
		}
		}
	});
	return false;
}
		
	function logredirecthome()
	{
		var t=setTimeout('window.location="home.php"',2000);
	}
	
	function logredirectwelcome()
	{
		var t=setTimeout('window.location="welcome.php"',2000);
	}
	function admin()
	{
		var t=setTimeout('window.location="Admin/admin.php"',2000);
	}
	function logredirectconfirm()
	{
		var t=setTimeout('window.location="confirm_account.php"',2000);
	}


		