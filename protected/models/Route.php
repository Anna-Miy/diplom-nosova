<?php

/**
 * This is the model class for table "routes".
 *
 * The followings are the available columns in table 'routes':
 * @property string $id
 * @property string $route_type_id
 * @property string $name
 * @property string $description
 * @property string $time_from
 * @property string $time_to
 * @property string $interval
 *
 * The followings are the available model relations:
 * @property Points[] $points
 * @property RouteTypes $routeType
 */
class Route extends CActiveRecord
{

	/*
	 * Returns the static model of the specified AR class.
	 * @return Route the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'routes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('route_type_id, name', 'required'),
			array('route_type_id', 'length', 'max'=>10),
			array('name', 'length', 'max'=>50),
			array('time_from, time_to, interval', 'date', 'format'=>'HH:mm'),
			array('time_from, time_to, interval', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, route_type_id, name, description, time_from, time_to, interval', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'points' => array(self::HAS_MANY, 'Point', 'route_id', 'order'=>'pos',),
			'routeType' => array(self::BELONGS_TO, 'RouteTypes', 'route_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'route_type_id' => 'Тип',
			'name' => 'Название',
			'description' => 'Описание',
			'time_from' => 'Время начала работы маршрута',
			'time_to' => 'Время завершения работы маршрута',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('route_type_id',$this->route_type_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	public function behaviors() {
		return array(
			'EJsonBehavior'=>array(
				'class'=>'application.behaviors.EJsonBehavior'
			),
		);
	}


	static function getRouteById($id) {

		$route = Yii::app()->db->createCommand(array(
			'from' => Route::model()->tableName(),
			'where' => 'id = :id',
			'limit' => 1,
			'params' => array(':id'=>$id)
		))->queryRow();

		$route['points'] = Yii::app()->db->createCommand(array(
			'from' => Point::model()->tableName(),
			'where' => 'route_id = :id',
			'join' => 'LEFT JOIN stops ON stop_id = stops.id',
			'params' => array(':id'=>$id)
		))->queryAll();

		return $route;
	}


	static function getPathBetween2Points($from_pos, $to_pos, $route_id) {

		$from_pos = (int)$from_pos;
		$to_pos = (int)$to_pos;

		$direction = $from_pos < $to_pos ? 'asc' : 'desc';
		
		if($from_pos > $to_pos) {
			$tmp = $from_pos;
			$from_pos = $to_pos;
			$to_pos = $tmp;
		}

		return Yii::app()->db->createCommand(array(
			'from' => Point::model()->tableName(),
			'where' => 'route_id = :route_id AND pos BETWEEN :from AND :to',
			'join' => 'LEFT JOIN stops ON stop_id = stops.id',
			'order' => 'pos ' . $direction,
			'params' => array(':from' => $from_pos, ':to' => $to_pos, ':route_id' => (int)$route_id)
		))->queryAll();

	}



	static function findTheRoute($startPoint, $endPoint, $endDistance = 0.25) {

		$openList = array();
		$closedList = array();

		$startNode = Point::getClosestStop($startPoint);

		$startNode['f'] = 0;
		$startNode['g'] = 0;
		$openList[] = $startNode;

//        CVarDumper::dump($startNode,10, true);
//        CVarDumper::dump($openList,10, true);
//        die;

		while (!empty($openList)) {

			// Grab the lowest f(x) to process next
			$lowInd = 0;
			foreach($openList as $i => $el) {
				if($el['f'] < $openList[$lowInd]['f']) {
					$lowInd = $i;
				}
			}

			$currentNode = $openList[$lowInd];

			// End case -- result has been found, return the traced path
			if(self::model()->distanceBetweenNodes($currentNode, $endPoint) < $endDistance) {
				$ret = array();
				$ret[] = $currentNode;
				$parent = $currentNode['parent'];
				while(isset($parent)) {
					$ret[] = $parent;
					$parent = isset($parent['parent']) ? $parent['parent'] : null;
				}

				return array_reverse($ret);
			}

			//delete current from open list
			foreach($openList as $key => $value) {
				if ($value['id'] == $currentNode['id']) unset($openList[$key]);
			}
			// reindex
			$openList = array_values($openList);

			$closedList[] = $currentNode;

			$neighbors = self::getNeighbors($currentNode);

			foreach ($neighbors as &$neighbor) {

                $neighbor['g'] = isset($neighbor['g']) ? $neighbor['g'] : 0;
                $neighbor['h'] = isset($neighbor['h']) ? $neighbor['h'] : 0;
                $neighbor['parent'] = isset($neighbor['parent']) ? $neighbor['parent'] : null;

				if(self::findNodeInList($closedList, $neighbor)) {
					continue;
				}

				// g score is the shortest distance from start to current node, we need to check if
				//	 the path we have arrived at this neighbor is the shortest one we have seen yet
				$g_score = self::model()->getGScore($currentNode, $neighbor);
				$g_score_is_best = false;

				if(!self::findNodeInList($openList, $neighbor)) {
					// This the the first time we have arrived at this node, it must be the best
					// Also, we need to take the h (heuristic) score since we haven't done so yet
					$g_score_is_best = true;
					$neighbor['h'] = self::model()->heuristic($neighbor, $endPoint);
					$openList[] = &$neighbor;
				}
				elseif ($g_score < $neighbor['g']) {
					// We have already seen the node, but last time it had a worse g (distance from start)
					$g_score_is_best = true;
				}

				if($g_score_is_best) {
					$neighbor['parent'] = $currentNode;
					$neighbor['g'] = $g_score;
					$neighbor['f'] = $neighbor['g'] + $neighbor['h'];
				}
			}
		}

		if($endDistance < 2) {
			return self::findTheRoute($startPoint, $endPoint, $endDistance + 0.2);
		}
	}


	function distanceBetweenNodes($n1, $n2) {
		return self::distance($n1['lat'], $n1['lng'], $n2['lat'], $n2['lng']);
	}


	function getGScore($current, $neighbor) {
		if(!isset($current['g'])) {
			$current['g'] = 0;
		}

		$additional_g = 0;
		if(isset($neighbor['is_another_route']) && $neighbor['is_another_route']) {
			$additional_g += 3;
		}

		return $current['g'] + self::distance($current['lat'], $current['lng'], $neighbor['lat'], $neighbor['lng']) + $additional_g;
	}

	private function heuristic($neighbor, $endPoint) {
//		return (6371 * acos(cos(rad2deg($endPoint['lat'])) * cos(rad2deg($neighbor['lat'])) * cos(rad2deg($neighbor['lng']) - rad2deg($endPoint['lng'])) + sin(rad2deg($endPoint['lat'])) * sin(rad2deg($neighbor['lat']))));
		return self::distance($neighbor['lat'], $neighbor['lng'], $endPoint['lat'], $endPoint['lng']);
	}


	private static function findNodeInList($list, $node) {
		foreach($list as $key => $value) {
			if ($value['id'] == $node['id'])
				return $list[$key];
		}
		return false;
	}


	public static function getNeighbors($point) {

		$prev = Point::getPreviousStop($point);
		$next = Point::getNextStop($point);
		$inRadius = Point::getNeighborStops($point);
//		$inRadius = Point::getStopsInRadius($point, 0.35);

		$neighbors = array();

		if(!empty($prev)) {
			$neighbors[] = $prev;
		}
		if(!empty($next)) {
			$neighbors[] = $next;
		}
		foreach($inRadius as $p) {
			$p['is_another_route'] = true;
			$neighbors[] = $p;
		}

		return $neighbors;
	}


    private function distance($lat1, $lon1, $lat2, $lon2, $unit = 'k')
    {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    protected function beforeSave()
    {
        return parent::beforeSave();
    }
}