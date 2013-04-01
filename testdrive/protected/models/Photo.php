<?php
class Photo extends CFormModel
{
	public $image;
    public $user_id;
    public $width;
    public $height;
    public $alt;
    public $url;
	public $type;
     
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
	
	public static function infIMG($type=FALSE,$param=FALSE)
    {
		$img =array(
				 "logo"=>array(
					  0=>200,
					  1=>300,
					  'prif'=>'logo_'
					),
				 "small_img"=>array(
					  0=>200,
					  1=>200,
					  'prif'=>'small_'
					),
				 "big_img"=>array(
					  0=>500,
					  1=>500,
					  'prif'=>'big_'
					),
				 "full_img"=>array(
					  0=>1024,
					  1=>786,
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
    
    public function rules()
    {
       return array(
		array('width, height, alt, url', 'required'),
		array('width, height', 'numerical', 'integerOnly'=>true),
		array('alt', 'length', 'max'=>250),
		array('url', 'length', 'max'=>150),
	//	array('url', 'filter', 'filter'=>array("TranslitFilter", "translitUrl")),
		array('url', 'unique','attributeName'=>'url','className'=>'Photo',
					'message'=>'такой url уже занят'),
           //устанавливаем правила для файла, позволяющие загружать
           // только картинки!
          // array('image', 'file', 'types'=>'jpg'),
       );
	}

     public function  attributeLabels() {
            return array(
               'url'=>"Уникальный Url фотографии",
               'alt'=>"Описание фотографии",
               "image"=>"Изображение",
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
     public function savePhoto($image,$type='full_img')
     {
         $img = Yii::app()->imagemod->load($image);
         //определение конечно высоты и ширины
         $img->image_resize =TRUE;
         $img->image_ratio_y         = true;
         $this->width = $img->image_x               = Photo::infIMG($type, 0);
         $this->height = round(($img->image_src_y * $img->image_x) / $img->image_src_x);
         $this->type = $type;
         if($this->validate())
         {
        //сохраняется и на жеский
                 
                
			$img->file_new_name_body = Photo::infIMG($this->type, 'prif').$this->url;;
            if( $img->process(yii::app()->getBasePath()."/../images"))
				return TRUE;
            else
                return FALSE;
         }
         else
         {
			return FALSE;
         }

	}
}

?>
