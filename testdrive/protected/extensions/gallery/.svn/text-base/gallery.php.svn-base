<?php
class Gallery
{
	public function execute()
	{
		if($_POST['scanImg'])
		{
			$this->scanImages();
		}
		if($_POST['checkImg'])
		{
			$this->checkImg();
		}
	}
	private function checkImg()
	{
		$file = $_POST['checkImg'];
		if(file_exists($_POST['checkImg']))
		{
			return true;
		}
		return false;
	}
	
	private function scanImages($childDir = 'images/photoGallery')
	{
		$dirSmall = $childDir.'/preview';
		$dirBig = $childDir.'/big';
		if($_POST['scanImg'])
		{
			$imgSmall = scandir($dirSmall);
			$imgBig = scandir($dirBig);
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
						$result['href'][]=$dirSmall . '/' . $valSmall;
						$result['img'][]= '/' . $valSmall;
					}
				}
				
			}
			$result['bigImg'] = $dirBig;
			echo json_encode($result);
		}
		
	}
}
$obj = new Gallery();
$obj->execute();
?>
