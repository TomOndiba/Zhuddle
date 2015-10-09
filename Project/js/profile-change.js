// Profile Change
$(document).ready(function()
{
	 //Your delay in milliseconds
	$("#close-prev-1").click(function()
	{
		var delay = 1000;
		setTimeout(function(){ window.location = "profile-setup.php"; }, delay);
	});
	$("#close-prev-2").click(function()
	{
		var delay = 1000;
		setTimeout(function(){ window.location = "profile.php"; }, delay);
	});
	$("#close-prev-3").click(function()
	{
		var delay = 1000;
		setTimeout(function(){ window.location = "home.php"; }, delay);
	});
	$("#close-prev-4").click(function()
	{
		var delay = 1000;
		setTimeout(function(){ window.location = "profile-setup.php"; }, delay);
	});
	$("#close-prev-5").click(function()
	{
		var delay = 1000;
		setTimeout(function(){ window.location = "profile.php"; }, delay);
	});
	$("#close-prev-6").click(function()
	{
		var delay = 1000;
		setTimeout(function(){ window.location = "home.php"; }, delay);
	});
	$("#cancel-prev-1").click(function(e)
	{
		e.preventDefault();
		var image_name=$("#cropbox1").attr("src");
		var prev_page=1;
		var formData={image_name:image_name,prev_page:prev_page,is_ajax:1};
		submitForm(formData);	
	});
	$("#cancel-prev-2").click(function(e)
	{
		e.preventDefault();
		var image_name=$("#cropbox1").attr("src");
		var prev_page=2;
		var formData={image_name:image_name,prev_page:prev_page,is_ajax:1};
		submitForm(formData);	
	});
	$("#cancel-prev-3").click(function(e)
	{
		e.preventDefault();
		var image_name=$("#cropbox1").attr("src");
		var prev_page=3;
		var formData={image_name:image_name,prev_page:prev_page,is_ajax:1};
		submitForm(formData);	
	});
});

$(document).ready(function(){
	$("#cancel-prev-1,#cancel-prev-2,#cancel-prev-3").click(function()
	{
		$('#logo-div').hide();
		$("#anime-logo-div").css("display","inline");
	});
});

function submitForm(formData) {
	
	$.ajax({	
		type: 'POST',
		url: 'file_delete.php',		
		data: formData,
		success:function(response)
		{
		if(response == 'success1')
		{
			var t=setTimeout('window.location="profile-setup.php"',1000);
		}
		else if(response == 'success2')
		{
			var t=setTimeout('window.location="profile.php"',1000);
		}
		else if(response == 'success3')
		{
			var t=setTimeout('window.location="home.php"',1000);
		}
		else
		{
			$('#logo-div').show();
			$("#anime-logo-div").css("display","none");
			$('#image-error-box').css("border","#AE002C inset 1px").css("color","#AE002C").html('Something went wrong.').fadeIn('slow');
		}
		}
	});
	return false;
}


