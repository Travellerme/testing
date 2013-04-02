<?php
class PhotoForm extends CFormModel
{

     public $image;
     public $user_id;
     public $width;
     public $height;
     public $alt;
     public $url;
     public $type;

    




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
        //если сохранена в базу данных то, сохраняется и на жеский
                  
                 /*if( $model->save())
                 {*/
                
                    $img->file_new_name_body = Photo::infIMG($this->type, 'prif').$this->url;;
                   if( $img->process( yii::app()->getBasePath()."/../images"))
                       return TRUE;
                   else
                       return FALSE;
                /* }
                 else
                     return FALSE;*/

          }
          else
          {
          // $this->addErrors($model->getErrors());
          return FALSE;
          }

      }

}
?>
