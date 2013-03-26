<?php
class About extends CFormModel
{
	
	public static function gallery($listImg)
	{
		$str = '';
		$class = "imgGallery";
		$cnt = count($listImg['href']);
		for ($i=0; $i<$cnt; $i++)
		{
			if($i%4 == 0) 
			{
				$str .= '<br />';
			}
			//$src = preg_replace('/(preview)/i','big',$listImg['href'][$i]);
			$src = $listImg['href'][$i];
			$event = "viewImg($i,$cnt);";
			$id='img'.$i;
			$str .= "<img src=\"$src\" class=\"imgGallery\" onclick=\"$event\"
				id=\"$id\" />";
			
		}
		return $str;
	}
	
    public function searchImg($childDir)
    {
		$dirSmall = Yii::app()->baseUrl . DIRECTORY_SEPARATOR
		. $childDir . DIRECTORY_SEPARATOR . 'preview';
		$dirBig = Yii::app()->baseUrl . DIRECTORY_SEPARATOR
		. $childDir . DIRECTORY_SEPARATOR . 'big';
		$main = '/var/www/';
		$imgSmall = scandir($main . $dirSmall);
		$imgBig = scandir($main . $dirBig);
		$result = array();
		foreach ($imgSmall as $key => $valSmall)
		{
			if($valSmall=="." || $valSmall=="..")
			{
				continue;
			}
			foreach ($imgBig as $key=>$valBig)
			{
				if($valSmall == $valBig)
				{
					$result['href'][]=$dirSmall . DIRECTORY_SEPARATOR . $valSmall;
					$result['img'][]= DIRECTORY_SEPARATOR . $valSmall;
				}
			}
			
		}
		$result['bigImg'] = $dirBig;
		return $result;
	}
}

?>
