var moduleAdmin = Object.create(apiJs)
moduleAdmin.callback = function (response)
{
	$('#fileList').html('');
	$.each(response, function(key, value) 
	{
		$('#fileList').append($("<option>", 
		{
			value: key,
			text: value
		}));
	});
}
moduleAdmin.start = function()
{
	moduleAdmin.urlRequest = 'folderAjax';
	moduleAdmin.paramArray({'folder':$("#dir option:selected").text()});
	moduleAdmin.ajaxStart(this.callback);	
}
