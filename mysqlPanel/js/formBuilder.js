var formBuilder = {
	iterator: 0,
}

formBuilder.addField = function ()
{
	if (this.iterator > 4)
		return false;
	$('#answerList').append($("<br>"));
	var num = this.iterator + 1;
	$('#answerList').append($("<input>", 
	{
		type: 'text',
		name: 'Test[answer][]',
		onchange: 'formBuilder.addField();',
		
	}));
	$('#checkboxlist').append($("<br>"));
	$('#checkboxlist').append($("<input>", 
	{
		type: 'checkbox',
		value: num,
		name: 'Test[rightAnswer][]',
	}));

	$('#checkboxlist').append(" Answer " + num);
	this.iterator++;
}
