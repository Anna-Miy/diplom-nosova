<?php

class SiteController extends FrontendController
{

	 public $layout='//layouts/_map';
	
	/*
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{

		Yii::app()->ClientScript->registerScriptFile('http://maps.googleapis.com/maps/api/js?sensor=false', CClientScript::POS_END);
		Yii::app()->ClientScript->registerScriptFile(Yii::app()->baseUrl.'/js/overlay.js', CClientScript::POS_END);
		Yii::app()->ClientScript->registerScriptFile(Yii::app()->baseUrl.'/js/views/map.js', CClientScript::POS_END);
		Yii::app()->ClientScript->registerScriptFile(Yii::app()->baseUrl.'/js/views/view_route_controls.js', CClientScript::POS_END);
		Yii::app()->ClientScript->registerScriptFile(Yii::app()->baseUrl.'/js/views/map_route.js', CClientScript::POS_END);
		Yii::app()->ClientScript->registerScriptFile(Yii::app()->baseUrl.'/js/views/map_stop.js', CClientScript::POS_END);
		Yii::app()->ClientScript->registerScriptFile(Yii::app()->baseUrl.'/js/views/map_point.js', CClientScript::POS_END);
		Yii::app()->ClientScript->registerScriptFile(Yii::app()->baseUrl.'/js/views/stop_list_item.js', CClientScript::POS_END);
		Yii::app()->ClientScript->registerScriptFile(Yii::app()->baseUrl.'/js/views/routes_legend.js', CClientScript::POS_END);
		Yii::app()->ClientScript->registerScriptFile(Yii::app()->baseUrl.'/js/models/route.js', CClientScript::POS_END);
		Yii::app()->ClientScript->registerScriptFile(Yii::app()->baseUrl.'/js/models/routes.js', CClientScript::POS_END);
		Yii::app()->ClientScript->registerScriptFile(Yii::app()->baseUrl.'/js/models/stop.js', CClientScript::POS_END);
		Yii::app()->ClientScript->registerScriptFile(Yii::app()->baseUrl.'/js/models/point.js', CClientScript::POS_END);
		Yii::app()->ClientScript->registerScriptFile(Yii::app()->baseUrl.'/js/application.js', CClientScript::POS_END);
		$this->render('index', array(
			'allRoutes' => RouteTypes::model()->findAll(),
		));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{

		$this->layout = '//layouts/admin';

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}


	public function actionTest() {

		$start = array(
			'lat' => '49.98945',
			'lng' => '36.34203'
		);
		
		$end = array(
			'lat' => '49.9933300',
			'lng' => '36.2289800'
		);

		$result = Route::findTheRoute($start, $end);
		VarDumper::dump($result);

	}

}