function is_object(mixedVar)
{
	return mixedVar instanceof Object;
}

function isset(obj)
{
	if((typeof obj == 'undefined') || (obj === null)  || (obj === ""))
	{
		return false;
	}
	else
	{
		return true;
	}
}

var apiJs = {
				typeRequest: 'POST',
				urlRequest: '',
				typeResponse: 'json',
				stringParam: '',
			}
			
apiJs.paramArray = function (param)
{  
	if(is_object(param))
	{
		var symb = false;
		for(var key in param)
		{
			if(!symb)
			{
				this.stringParam = key + '=' + param[key];
				symb = true;
			}
			else
				this.stringParam += '&' + key + '=' + param[key];
		};
		
	}

}

apiJs.ajaxStart = function (callback)
{
	if(isset(this.typeRequest) && isset(this.urlRequest) && isset(this.typeResponse))
	{
		$.ajax
		({
			type: this.typeRequest,
			url: this.urlRequest,
			dataType: this.typeResponse,
			data: this.stringParam,
			success: function(response)
			{
				callback(response);		
			}   
		});
	}
}
			
