<?php
class Photo extends CFormModel
{
	public $image;
    public $width;
    public $height;
    public $name;
	public $type;
	public $dir;
	public static $pathFile = array();
     
	public static function gallery($listImg)
	{
		$str = '';
		$class = "imgGallery";
		$cnt = count($listImg['href']);
		for ($i=0; $i<$cnt; $i++)
		{
			if($i%3 == 0) 
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
	
	public function rules()
	{
		return array(
			array('dir', 'required'),
			array('dir', 'safe'),
			
		);
	}
	
    public function searchImg($childDir, $compareImg = null)
    {
		$url = Yii::app()->baseUrl . '/' . $childDir;
		$dir = Yii::app()->getBasePath()."/../".$childDir;
		$img = scandir($dir);
		
		$result = array();
		foreach ($img as $key => $val)
		{
			if($val=="." || $val=="..")
			{
				continue;
			}
			
			if(preg_match('/^(small_)(.*)/i',$val,$out))
			{
				$result['href'][]=$url . '/' . $val;
				$result['img'][]= '/full_' . $out[2];
			}
			$result['hrefFull'][]=$val;
			if($compareImg)
			{
				if(preg_match('/^[small_|full_].*(\..*)/i',$val,$out))
				{
					if($compareImg . $out[1] == $val )
						return false;
				}
			}	
		
		}
		$result['bigImg'] = $url;
		return $result;
	}
	
	public function infIMG($type=FALSE,$param=FALSE)
    {
		$img =array(
				 "logo"=>array(
					  0=>200,
					  1=>300,
					  'prif'=>'logo_'
					),
				 "small_img"=>array(
					  0=>200,
					  1=>150,
					  'prif'=>'small_'
					),
				 "big_img"=>array(
					  0=>500,
					  1=>500,
					  'prif'=>'big_'
					),
				 "full_img"=>array(
					  0=>786,
					  1=>1024,
					  'prif'=>'full_'
					),
				);
	  
		if($type===FALSE && $param===FALSE)
		{
			if(isset ($img))
				return $img;
			else            return FALSE;
		}
			elseif($type!==FALSE && $param===FALSE)
		{
			if(isset ($img[$type]))
				return $img[$type];
			else            return FALSE;
		}
			elseif($type!==FALSE && $param!==FALSE)
		{
			if(isset ($img[$type][$param]))
				return $img[$type][$param];
			else            return FALSE;
		}
    }
   
   
     public function  attributeLabels() {
            return array(
				'image'=>Yii::t("main", "Image"),
				'dir'=>Yii::t("main", "Directory for saving image"),
            );
     }
     /**
     *функция загружает картинку, подгоняет размер, сохраняет информацию в БД
     * потом на жеский диск
     *
     * входящие параметры картинка тип картинки
     * выходящии
     * запись в БД,
     * запись на жеский диск,
     *
     * @param file $image картинка
     * @param string $type тип картинки, доступные типы картинки можно определить Photo::infIMG
     * @return bool сохраенена или нет
     */
     public function savePhoto($image,$type='full_img',$path = 'images/gallery')
     {	
		
         $img = Yii::app()->imagemod->load($image);
         //определение конечно высоты и ширины
         /*$img->image_resize          = true;
		 $img->image_ratio_x         = true;
		 $img->image_y               = $this->infIMG($type, 1);*/
		 	 
		 $img->image_resize          = true;
		 $img->image_ratio_crop      = true;
		 $img->image_y               = $this->infIMG($type, 1);
		 $img->image_x 				 = $this->infIMG($type, 1);
		 
         /*$img->image_resize =true;
         $img->image_ratio_y = true;
         $this->width = $img->image_x = $this->infIMG($type, 0);
         $this->height = round(($img->image_src_y * $img->image_x) / $img->image_src_x);
        */ $this->type = $type;
        
        if (preg_match('/(.*)\..*$/i',$image['name'],$compare))
		{ 
			$this->name = $compare[1];
		}
		else
		{
			$this->addError('image',Yii::t("main", "Incorrect format"));
			return false;
		}
        $img->file_new_name_body = $this->infIMG($this->type, 'prif') . $this->name;
		
        if(!$this->searchImg($path,$img->file_new_name_body))
		{
			$this->addError('image',Yii::t("main", "This image already exist"));
			return false;
		}
		$img->process(yii::app()->getBasePath() . "/../" . $path);
		if(!file_exists(yii::app()->getBasePath() . "/../" . $path . '/' . $image['name']))
		{
			$this->addError('image',Yii::t("main", "Error occurred, maybe incorrect image format"));
			return false;
		}
		return true;
		
	}
	public static function imgList($path)
	{
		$files = scandir($path);
		if ($files)
		{
			if (($files == '.') || ($files == '..')) continue;

			$result = array();
			foreach ($files as $key=>$val)
			{
				$pathFile = $path.'/'.$val;
				if (!is_dir($pathFile))
				{ 
					$result[$val]= $val;
				}
			}
			return $result;
		}
		return false;
    
	}
	
	public static function allImgDir($path,$item = array())
	{
		$images = self::searchImg($path);
		$result = $item;
		foreach ($images['hrefFull'] as $key)
		{
			$result[$key] = $key;
		}
		return $result;
	}
	
	public function valid($image)
	{
		if(!$image)
		{
			$this->addError('image',Yii::t("main", "You must enter image"));
			return false;
		}
		return true;
		
	}
}

?>
