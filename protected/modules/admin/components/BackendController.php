<?php

class BackendController extends Controller
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/admin';
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


	public $siteMenu = array(
		array('label' => 'Типы', 'url' => array('routeTypes/admin')),
		array('label' => 'Маршруты', 'url' => array('route/admin')),
		array('label' => 'Остановки', 'url' => array('stop/admin')),
		array('label' => 'Точки', 'url' => array('point/admin')),
	);


	function init() {
		parent::init();

		$this->addBodyClass('no-topbar-shine');
		Yii::app()->ClientScript->registerCssFile(Yii::app()->baseUrl.'/css/admin/admin.css');

	}

}