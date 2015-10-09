// JavaScript Document
$(document).ready(function()
{   
    $("#autosuggest-container").hide();
	var autoSugg=$('#search-textbox').val();
	$('#search-textbox').keydown(function()
	{
		var autoSugg2=$('#search-textbox').val();
		if(autoSugg2=='')
		{
		$("#autosuggest-container").empty();
		}
		else
		$("#autosuggest-container").show();
	});
	$('#autosuggest-container').mouseleave(function()
	{
		$("#autosuggest-container").hide();
	});

	$('#search-textbox').click(function()
	{
		var autoSugg1=$('#search-textbox').val();
		if(autoSugg1!='')
		{
		$("#autosuggest-container").show();
		}
		else
		$("#autosuggest-container").empty();
		$("#autosuggest-container").show();
	});
	$("#search-button").click(function(e)
	{	
		var autoSugg=$('#search-textbox').val();
		if(autoSugg=='')
		e.preventDefault();
	});
});
