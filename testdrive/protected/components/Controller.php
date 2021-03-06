<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column2';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	/**
	 * @var array allowed languages.
	 */
	public $languages=array('en','ru',);
	/**
	 * @var array languages titles for link.
	 */
	public $languagesTitles=array('ru'=>'Russian','en'=>'English');
	/**
	 * @var string default language.
	 */
	public $defaultLanguage='ru';
	/**
	 * @var string hidden input id.
	 */
	public function init()
	{
		$this->initLanguage();
	}
	private function initLanguage()
	{
		$language=Yii::app()->session->itemAt('language');
		
		if($language===null && $this->defaultLanguage)
			$language=$this->defaultLanguage;

		if($language===null && $this->autoDetect)
			$language=Yii::app()->getRequest()->getPreferredLanguage();

		if($language==='uk_ua')
			$language='uk';

		$languageId=array_search($language, $this->languages);
		$language=$this->languages[$languageId===false ? 0 : $languageId];
		Yii::app()->session['language']=$language;
		Yii::app()->setLanguage($language);
	}
}
