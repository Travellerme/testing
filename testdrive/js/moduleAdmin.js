function sendRequest()
{
	var request = new ajaxProperty('POST', 'folderAjax', 'json');
	request.paramArray({'folder':$("#dir option:selected").text()});	
	request.ajaxStart(optionBuilder);	
}

function optionBuilder(response)
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


