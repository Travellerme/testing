function viewImg(id,cnt)
{
	
		var nextImg =id+1;
		var prevImg = id-1;
		
		var curImg = 'img'+id;
		if(id == 0)
		{
			prevImg = cnt-1;
		}
		
		if(id == cnt-1)
		{
			nextImg = 0;
		}
		var link = $('#'+curImg).attr('src');
		var reg = /(small_)/;
		var rep = 'full_';
		var bigImg = '<img src="'+link.replace(reg,rep)+'" width="75%" '
		+'onclick="viewImg('+nextImg+','+cnt+');" id="bigImg" hidden />';
		var buttons = '<img src="/testdrive/images/skins/prev.png" id="buttonPrev" onclick="viewImg('
		+prevImg+','+cnt+');" hidden />'+
		'<img src="/testdrive/images/skins/close.png" id="buttonClose" onclick="closeImg();" hidden />'+
		'<img src="/testdrive/images/skins/next.png" id="buttonNext" onclick="viewImg('
		+nextImg+','+cnt+');" hidden />';
		$('#view').html(buttons+bigImg);
		
		
		$('#TB_overlay').fadeIn(1500);
		$('#buttonPrev').fadeIn(1500);
		$('#buttonNext').fadeIn(1500);
		$('#buttonClose').fadeIn(1500);
		$('#bigImg').fadeIn(1500);
	
}
function closeImg()
{
	$('#TB_overlay').fadeOut(1500);
	$('#buttonPrev').fadeOut(1500);
	$('#buttonNext').fadeOut(1500);
	$('#buttonClose').fadeOut(1500);
	$('#bigImg').fadeOut(1500);
}
