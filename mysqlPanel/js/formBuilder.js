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
		name: 'Question[answer][' + this.iterator + ']',
		onblur: 'formBuilder.addField();',
		
	}));
	$('#checkboxlist').append($("<br>"));
	$('#checkboxlist').append($("<input>", 
	{
		type: 'checkbox',
		value: this.iterator,
		name: 'Question[rightAnswer][' + this.iterator + ']',
	}));

	$('#checkboxlist').append(" Answer " + this.iterator);
	this.iterator++;
}
formBuilder.typeAnswer = function ()
{
	if($("#typeAnswer option:selected").val() == 1)
		$('#checkboxList').css("display", "inline"); 
	if($("#typeAnswer option:selected").val() == 2)
		$('#checkboxList').css("display", "none"); 
}
