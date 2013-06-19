<?php

class RouteController extends BackendController
{

	public function init() {
		parent::init();
		// css
		Yii::app()->ClientScript->registerCssFile(Yii::app()->baseUrl.'/css/admin/route.css');
	}


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->redirect(array('/site/index', '#' => "show/$id"));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{

		$this->layout = '//layouts/admin_fullwidth';

		$model = new Route;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Route'])) {

			$model->attributes = $_POST['Route'];

			if ($model->save()) {
                $this->insertPoints($model->id);
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->addRouteEditorScripts();

		$tplVars = array(
			'model' => $model,
		);
		$this->render('create', $tplVars);
	}

    public function insertPoints($route_id)
    {
        $routePoints = json_decode($_POST['routePoints'], true);
        //TODO remove duplicates

        foreach ($routePoints as $num => $routePoint) {
            $point = new Point;
            $point->route_id = $route_id;
            $point->pos = $num;
            $point->lat = $routePoint['lat'];
            $point->lng = $routePoint['lng'];
            if (isset($routePoint['stop_id'])) {
                $point->stop_id = $routePoint['stop_id'];
            }
            if (!$point->save()) {
                VarDumper::dump($point->getErrors());
                die();
            }
        }
    }

    /**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->layout = '//layouts/admin_fullwidth';
		
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Route']))
		{
			$model->attributes=$_POST['Route'];

            Point::model()->deleteAllByAttributes(array('route_id' => $id));
            $this->insertPoints($id);

			if($model->save()) {
				$this->redirect('/admin/route/admin');
            } else {
                VarDumper::dump($model->getErrors());
                die();
            }
		}

		$this->addRouteEditorScripts();

		$routePoints = array();
		foreach($model->points as $i => $routePoint) {
			$routePoints[$i]['lat'] = $routePoint->lat;
			$routePoints[$i]['lng'] = $routePoint->lng;
			$routePoints[$i]['id'] = $routePoint->id;
			if($routePoint->stop_id) {
				$routePoints[$i]['stopId'] = $routePoint->stop_id;
			}
		}

		$encodedRoutePoints = json_encode($routePoints);

		$this->render('update',array(
			'model'=>$model,
			'encodedRoutePoints'=>$encodedRoutePoints,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->redirect('admin');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Route('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Route']))
			$model->attributes=$_GET['Route'];

		$this->render('admin',array(
			'model'=>$model,
            'allRouteTypes' => RouteTypes::model()->findAll()
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
     * @return \Route
     */
	public function loadModel($id)
	{
		$model=Route::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param $model
	 *
	 * @internal param \the $CModel model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='route-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


	function addRouteEditorScripts() {
		Yii::app()->ClientScript->registerScriptFile('http://maps.googleapis.com/maps/api/js?sensor=false', CClientScript::POS_HEAD);
//		Yii::app()->ClientScript->registerScriptFile(Yii::app()->baseUrl.'/js/overlay.js', CClientScript::POS_END);
//		Yii::app()->ClientScript->registerScriptFile(Yii::app()->baseUrl.'/js/routes_editor.js', CClientScript::POS_END);
	}



}
