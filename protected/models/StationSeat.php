<?php

/**
 * This is the model class for table "station_seat".
 *
 * The followings are the available columns in table 'station_seat':
 * @property integer $id
 * @property integer $seat_id
 * @property integer $station_id
 *
 * The followings are the available model relations:
 * @property Stations $station
 * @property Seats $seat
 */
class StationSeat extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StationSeat the static model class
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
		return 'station_seat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('seat_id, station_id', 'required'),
			array('seat_id, station_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, seat_id, station_id', 'safe', 'on'=>'search'),
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
			'station' => array(self::BELONGS_TO, 'Stations', 'station_id'),
			'seat' => array(self::BELONGS_TO, 'Seats', 'seat_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'seat_id' => 'Seat',
			'station_id' => 'Station',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('seat_id',$this->seat_id);
		$criteria->compare('station_id',$this->station_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}