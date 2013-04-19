//function Request()
function sendRequest()
{
	var request = new ajaxProperty('POST', 'folderAjax', 'json');
	request.paramArray({'folder':$("#dir option:selected").text()});	
	request.ajaxStart(optionBuilder);	
}
/*extend(Request,ajaxProperty);
Request.prototype.optionBuilder = function (response)
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
Request.prototype.sendRequest = function ()
{
	this.superclass.paramArray.apply(this,{'folder':$("#dir option:selected").text()});
	this.superclass.ajaxStart.apply(this,this.optionBuilder);
}
objRequest = new Request();
console.log(objRequest);
objRequest.sendRequest();*/
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


