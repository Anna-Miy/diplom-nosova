<?php

/**
 * This is the model class for table "points".
 *
 * The followings are the available columns in table 'points':
 * @property string $id
 * @property string $route_id
 * @property string $stop_id
 * @property string $pos
 * @property string $lat
 * @property string $lng
 *
 * The followings are the available model relations:
 * @property Stops $stop
 * @property Routes $route
 */
class Point extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return Point the static model class
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
		return 'points';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('route_id, lat, lng, pos', 'required'),
			array('route_id, stop_id, lat, lng, pos', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, route_id, stop_id, lat, lng', 'safe', 'on'=>'search'),
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
			'stop' => array(self::BELONGS_TO, 'Stop', 'stop_id'),
			'route' => array(self::BELONGS_TO, 'Route', 'route_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'route_id' => 'Мршрут',
			'stop_id' => 'Остановка',
			'pos' => 'Позиция',
			'lat' => 'Широта',
			'lng' => 'Долгота',
		);
	}

	public function behaviors() {
		return array(
			'EJsonBehavior'=>array(
				'class'=>'application.behaviors.EJsonBehavior'
			),
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
		$criteria->compare('route_id',$this->route_id,true);
		$criteria->compare('stop_id',$this->stop_id,true);
		$criteria->compare('pos',$this->pos,true);
		$criteria->compare('lat',$this->lat,true);
		$criteria->compare('lng',$this->lng,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array('pageSize'=>30),
		));
	}

	

	public static function getPreviousStop($point) {

		return Yii::app()->db->createCommand(array(
			'from' => self::model()->tableName(),
			'where' => 'pos < :position  AND stop_id IS NOT NULL AND route_id = :route',
			'order' => 'pos DESC',
			'limit' => 1,
			'params' => array(':position' => $point['pos'], ':route' => $point['route_id'])
		))->queryRow();

	}

	public static function getNextStop($point) {

		return Yii::app()->db->createCommand(array(
			'from' => self::model()->tableName(),
			'where' => 'pos > :position
									AND stop_id IS NOT NULL
									AND route_id = :route',
			'order' => 'pos ASC',
			'limit' => 1,
			'params' => array(':position' => $point['pos'], ':route' => $point['route_id'])
		))->queryRow();

	}

	public static function getStopsInRadius($point, $radius) {

		$result =  Yii::app()->db->createCommand(array(
			'select' => '*, (6371 * acos( cos( radians('.$point['lat'].') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$point['lng'].') ) + sin( radians('.$point['lat'].') ) * sin( radians( lat ) ) ) ) AS distance',
			'from' => self::model()->tableName(),
			'where' => 'stop_id IS NOT NULL AND route_id <> :route',
			'having' => 'distance < :radius',
			'order' => 'distance',
			'params' => array(':radius' => $radius, ':route' => $point['route_id'])
		));
		return $result->queryAll();
	}
	public static function getNeighborStops($point) {

		$result =  Yii::app()->db->createCommand(array(
			'from' => self::model()->tableName(),
			'where' => 'stop_id = :stop AND route_id <> :route',
			'params' => array(':stop' => $point['stop_id'], ':route' => $point['route_id'])
		));
		return $result->queryAll();
	}

	public static function getClosestStop($latLng) {

		return Yii::app()->db->createCommand()
				->select('*, (6371 * acos( cos( radians('.$latLng['lat'].') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('.$latLng['lng'].') ) + sin( radians('.$latLng['lat'].') ) * sin( radians( lat ) ) ) ) AS distance')
				->from(self::model()->tableName())
				->order('distance')
				->where('stop_id IS NOT NULL')
				->limit(1)
				->queryRow();
	}

	static function groupPointsByRoutes($Points) {

		$groups = array();
		foreach ($Points as $Point) {
			$key = $Point->route_id;
			if (!isset($groups[$key])) {
				$groups[$key] = array();
			}
			$groups[$key][] = $Point;
		}

		return $groups;
	}


	
}