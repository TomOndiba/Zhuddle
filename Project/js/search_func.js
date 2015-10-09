// JavaScript Document

function autoSuggest()
{
	var autoSugg=$('#search-textbox').val();
	var id=$('#id-textbox').val();
	if( autoSugg!='')
	{
		$.ajax({
			url:'autosuggest.php?query='+autoSugg,
			data:{id:id},
			success:function(result)
			    {
					$('#autosuggest-container').html(result);
				}
		});
	}
}

