//FOR LOG IN FORM

$(document).ready(function() {
	
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
			
			$('#log-error-box').fadeOut('slow');
			var logformData = {'logemail':e,'logpassword':logpassword};
			logsubmitForm(logformData);			
		}	
	});
});

function logsubmitForm(logformData) {
	
	$.ajax({	
		type: 'POST',
		url: 'login.php',		
		data: logformData,
		dataType: 'json',
		cache: false,
		timeout: 3000,
		success: function(data) { 			
			
			$('#log-error-box').removeClass().addClass((data.error === true) ? 'error' : 'success')
						.html(data.msg).fadeIn('slow');	
						
			if ($('#log-error-box').hasClass('success')) {
				$('#log-error-box').hide();
				//setTimeout("$('#log-error-box').fadeOut('slow')", 5000);
				logredirect();
			}
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
						
			$('#log-error-box').removeClass().html('There was an ' + errorThrown +
							  ' error due to a ' + textStatus +
							  ' condition.').fadeIn('slow');	
		},				
		complete: function(XMLHttpRequest, status) { 			
			
			//$('#sign-up-form')[0].reset();
		}
	});	
};

function logredirect()
	{
		var t=setTimeout('window.location="home.php"',2000);
	}


