var formBuilder = {
	iterator: 1,
}

formBuilder.addField = function ()
{
	if (this.iterator > 4)
		return false;
	$('#answerList').append($("<br>"));
	$('#answerList').append($("<input>", 
	{
		type: 'text',
		name: 'answer[]',
		onchange: 'formBuilder.addField();',
		
	}));
	$('#checkboxlist').append($("<br>"));
	$('#checkboxlist').append($("<input>", 
	{
		type: 'checkbox',
		value: this.iterator,
	}));
	var num = 1 + this.iterator
	$('#checkboxlist').append(" Answer "+num);
	this.iterator++;
}
