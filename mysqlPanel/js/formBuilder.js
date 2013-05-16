var formBuilder = {
	iterator: 1,
}

formBuilder.addField = function ()
{
	if (this.iterator > 5)
		return false;
	$('#answerList').append($("<br>"));

	$('#answerList').append($("<input>", 
	{
		type: 'text',
		name: 'Test[answer][' + this.iterator + ']',
		onchange: 'formBuilder.addField();',
		
	}));
	$('#checkboxlist').append($("<br>"));
	$('#checkboxlist').append($("<input>", 
	{
		type: 'checkbox',
		value: this.iterator,
		name: 'Test[rightAnswer][' + this.iterator + ']',
	}));

	$('#checkboxlist').append(" Answer " + this.iterator);
	this.iterator++;
}
