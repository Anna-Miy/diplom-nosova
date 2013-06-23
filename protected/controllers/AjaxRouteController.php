<?php

class AjaxRouteController extends CController {

	function actionIndex(){
		if(Yii::app()->request->isAjaxRequest){

			$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : die();
			$route = Route::getRouteById($id);
			echo json_encode($route);
			Yii::app()->end();
		}
	}


	function actionStopRoutes() {

		if(Yii::app()->request->isAjaxRequest){

			$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : die();
			$routes = array();
			$points = Point::model()->findAllByAttributes(array(
				'stop_id' => $id
			));
			foreach($points as $point) {
				$routes[] = Route::getRouteById($point['route_id']);
			}
			echo json_encode($routes);
			Yii::app()->end();
		}

	}

	/**
	 * Action to fill select
	 * @return void
	 */
	function actionRoutesOfType() {

		$data = Route::model()->findAll('route_type_id = :type', array(':type'=>(int) $_POST['routeTypes']));

		$data = CHtml::listData($data, 'id', 'name');
		foreach($data as $value => $name) {
			?>
				<option data-href="#show/<?= $value ?>"><?= $name ?></option>
			<?php
			//echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name), true);
		}
	}

	/**
	 * Action to fill select
	 * @return void
	 */
	function actionStopsOfRoute() {

//		$data = Stop::model()->findAll('route_type_id = :type', array(':type'=>(int) $_POST['routeTypes']));

		$data = Point::model()->findAll(array(
			'condition' => 'route_id = :route AND NOT ISNULL(stop_id)',
			'params' => array(':route' => $_POST['route_id']),
			'with' => 'stop'
		));

		$data = CHtml::listData($data, 'stop_id', 'stop.name');
		foreach($data as $value => $name) {
			?>
				<a href="#stop/<?= $value ?>" class="ddm"><span class="label"><?= $name ?></span></a>
			<?php
		}
	}

    function actionSaveVkRoute() {

//		$data = Stop::model()->findAll('route_type_id = :type', array(':type'=>(int) $_POST['routeTypes']));

        $model = new Vk();
        $model->route_id = $_POST['route_id'];
        $model->vk_id = $_POST['vk_id'];

        if (Vk::model()->findByAttributes(array("route_id" => $model->route_id, "vk_id" => $model->vk_id)) == null) {
            $model->save();
        }

	}
	

	function actionSearch() {

		if(Yii::app()->request->isAjaxRequest){
			$startPoint = $_POST['start'];
			$endPoint = $_POST['end'];

			$pointsPath = Route::findTheRoute($startPoint, $endPoint);

			if(empty($pointsPath)) {
				echo 'no routes founded';
				Yii::app()->end();
			}

//			$Points = Point::model()->findAll('`id` IN ('.join(',', $pointsPath).')');

			$first_point_of_part = true;
			$from_pos = $to_pos = null;
			$pathParts = array();
			$count = count($pointsPath);

			for($i = 0; $i < $count; $i++) {

				$current = $pointsPath[$i];
				$current_route = $current['route_id'];

				// first iteration:
				if($first_point_of_part) {
                    $route = Route::model()->findByPk($current['route_id']);
					$route_name = $route->name;
                    $route_type_id = $route->route_type_id;
//					$route_name = Route::model()->findByPk($current['route_id'])->name;
					$from_pos = $current['pos'];
					$first_point_of_part = false;
				}

				if(!isset($pointsPath[$i + 1]) || $pointsPath[$i + 1]['route_id'] != $current_route) {
					$to_pos = $current['pos'];

					$pathParts[] = array('name' => $route_name, 'route_type_id' => $route_type_id, 'points' => Route::getPathBetween2Points($from_pos, $to_pos, $current_route),);
					$first_point_of_part = true;
				}

			}

//            CVarDumper::dump($pathParts);
//            die;
			echo json_encode($pathParts);
			
			Yii::app()->end();
		}
	}


	/*
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Route::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


//	function actionTest() {
//
//		$startPoint = array(
//			'lat' => '49.98917',
//			'lng' => '36.34176',
//		);
//
//		$endPoint = array(
//			'lat' => '49.98717',
//			'lng' => '36.32320',
//		);
//
//		$pointsPath = Route::findTheRoute($startPoint, $endPoint);
//
//		VarDumper::dump($pointsPath);
//	}


}