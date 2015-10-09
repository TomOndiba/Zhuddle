//FOR SIGN UP FORM

$(document).ready(function() {
	
	$('#error-box').hide();
	
	$('#reset-button').click(function(){
			$('#error-box').fadeOut('slow');
			$('#log-error-box').fadeOut('slow');
	});
	
	$('#sign-up-button').click(function(e) {
		
		// prevent forms default action until
		// error check has been performed
		e.preventDefault();
				
		// grab form field values
		var valid = '';
		var fname = $('#fname').val();
		var n=fname.substring(0,1).toUpperCase()+fname.substring(1,fname.length);
		var lname = $('#lname').val();
		var m=lname.substring(0,1).toUpperCase()+lname.substring(1,lname.length);
		var email = $('#emailid').val();
		var e=email.toLowerCase();
		var password = $('#userpassword').val();
		var gender = $('#gender-select').val();
		var g=gender.substring(0,1).toUpperCase()+gender.substring(1,gender.length);
		var letters = /^[A-Za-z]+$/;
		
		// perform error checking
		
		if (fname == '' || lname == ''||email==''||password==''||gender=='Select')
		{
			valid = 'Please fill in all the details.';	
		}

		else if(fname.length>20||fname.length<3)
		{
			valid = 'Enter first name between 3 and 20 characters.';
		}
		
		else if(lname.length>20||lname.length<3)
		{
			valid = 'Enter last name between 3 and 20 characters.';
		}
		
		else if(!fname.match(letters))
		{
			valid = 'Please enter only alphabets.';
		}
		else if(!lname.match(letters))
		{
			valid = 'Please enter only alphabets.';
		}
		else if (!email.match(/^([a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,4}$)/i))
		{
			valid = 'Enter valid email address.';												  
		}
		else if(password.length>16||password.length<8)
		{
			valid = 'Enter password with 8 to 20 characters.';
		}
		// let the user know if there are erros with the form
		if (valid != '') {
			
			$('#error-box').html(''+valid).fadeIn('slow');			
		}
		// let the user know something is happening behind the scenes
		// serialize the form data and send to our ajax function
		else {
			$('#logo-div').hide();
			$("#anime-logo-div").css("display","inline");
			//$('#error-box').fadeOut('slow');			
			var formData={'fname':n,'lname':m,'signupemail':e,'signuppassword':password,'signupgender':g};
			submitForm(formData);			
		}	
		
	});
});

// make our ajax request to the server
function submitForm(formData) {
	
	$.ajax({	
		type: 'POST',
		url: 'insert.php',		
		data: formData,
		dataType: 'json',
		cache: false,
		timeout: 3000,
		success: function(data) { 			
			
			$('#error-box').removeClass().addClass((data.error === true) ? 'error' : 'success')
						.html(data.msg).fadeIn('slow');	
						
			if ($('#error-box').hasClass('success')) {
				$('#error-box').hide();
				//setTimeout("$('#error-box').fadeOut('slow')", 2000);
				redirect();
			}
			else if($('#error-box').hasClass('error')) {
			$('#logo-div').show();
			$("#anime-logo-div").css("display","none");
			}
		
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
						
			$('#error-box').removeClass().html('There was an ' + errorThrown +
							  ' error due to a ' + textStatus +
							  ' condition.').fadeIn('slow');			
		},				
		complete: function(XMLHttpRequest, status) { 			
			
			//$('#sign-up-form')[0].reset();
			//redirect();
		}
	});	
};

function redirect()
	{
		var t=setTimeout('window.location="confirm_account.php"',500);
	}
