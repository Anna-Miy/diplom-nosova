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
	public $layout='//layouts/column1';
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


	public $siteMenu = array();

	protected $body_classes = array('button-nav');


  function init() {
    parent::init();

      /** @var $clientScript CClientScript */
      $clientScript = Yii::app()->ClientScript;

      $clientScript->registerCssFile(Yii::app()->baseUrl.'/css/design/design.css');
      $clientScript->registerCssFile(Yii::app()->baseUrl.'/css/css3-buttons.css');

      $clientScript->registerCoreScript('jquery');
      $clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/plugins/chosen/chosen.jquery.js', CClientScript::POS_END);
      $clientScript->registerCssFile(Yii::app()->baseUrl.'/js/plugins/chosen/chosen.css');

      $clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/libs/underscore/underscore.js', CClientScript::POS_HEAD);
      $clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/libs/backbone/backbone.js', CClientScript::POS_HEAD);
      $clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/plugins.js', CClientScript::POS_END);
      $clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/initialize.js', CClientScript::POS_END);


  }

  function bodyClasses() {
    return join(' ', $this->body_classes);
  }


  function addBodyClass($class) {

    if(in_array($class, $this->body_classes)) {
      return;
    }

    $this->body_classes[] = $class;
    return $this;
  }

}