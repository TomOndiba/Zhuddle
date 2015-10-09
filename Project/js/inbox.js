$(document).ready(function()
{
	
	$("#overlay").hide();
	$("#overlay2").hide();
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
	$("#close").click(function()
	{
		$("#overlay").fadeOut("slow");
	});
	$("#close2").click(function()
	{
		$("#overlay2").fadeOut("slow");
	});

});
$(document).ready(function()
{
	$("#save-change-pic").css("opacity","0.5");
	$($(".img-link")).focus(function()
	{
		x=$(this).attr('id');
		$($(".img-link").get(x)).click(function(e)
		{
			$("#save-change-pic").css("opacity","1");
			$("#save-change-pic").removeAttr('disabled');
			e.preventDefault();
			$($(".img").get(x)).css('border-radius','3px');
			$($(".img").get(x)).css('border','9px solid #fff');
			$("#save-change-pic").click(function(e)
			{
				e.preventDefault();
				var img_name=$($(".img").get(x)).attr("src");
				$('#logo-div').hide();
				$("#anime-logo-div").css("display","inline");
				var imgData = {img_name:img_name,is_ajax:1};
				submitImg(imgData);	
			});
			function submitImg(imgData)
			{
			$.ajax({	
				type: 'POST',
				url: 'img-update.php',		
				data: imgData,
				success:function(response)
				{
				if(response == 'success')
				{
					var t=setTimeout('window.location="home.php"',2000);
				}
				else
				{
					$('#logo-div').show();
					$("#anime-logo-div").css("display","none");
				}
				}
			});
			return false;
			}
		});
	});
	$($(".img-link")).focus(function()
	{
		var x=$(this).attr('id');
		$($(".img-link").get(x)).blur(function()
		{
			$("#save-change-pic").css("opacity","0.5");
			$($(".img").get(x)).css('border-radius','3px');
			$($(".img").get(x)).css('border','9px solid #E2E2E2');
			//$("#save-change-pic").attr("disabled", true);
			$(document.activeElement).click(function() {
  			var current=$(this).attr('id');
			if (current == 'save-change-pic')
			{
				$("#save-change-pic").removeAttr('disabled');
				//$("#save-change-pic").attr('value', current);
			}
			else
				$("#save-change-pic").attr("disabled", true);
				$("#save-change-pic").attr('value', current);
			});
		});
	});

});