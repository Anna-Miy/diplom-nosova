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
class Vk extends CActiveRecord
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
		return 'vk';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('route_id, vk_id', 'required'),
			array('route_id, vk_id', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, route_id, vk_id', 'safe', 'on'=>'search'),
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
			'route_id' => 'Маршрут',
			'vk_id' => 'Пользователь'
		);
	}

	public function behaviors() {
		return array(
			'EJsonBehavior'=>array(
				'class'=>'application.behaviors.EJsonBehavior'
			),
		);
	}
	
}