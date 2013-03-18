<?php
class About extends CFormModel
{
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
