<?php

/**
 * This is the model class for table "seats".
 *
 * The followings are the available columns in table 'seats':
 * @property integer $id
 * @property string $name
 * @property integer $candidate_amount
 * @property integer $priority
 *
 * The followings are the available model relations:
 * @property Candidates[] $candidates
 * @property StationSeat[] $stationSeats
 */
class Seats extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Seats the static model class
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
		return 'seats';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('election_id', 'numerical', 'integerOnly'=>true),
			array('name, election_id, minimum_choice, candidate_amount, priority', 'required'),
			array('candidate_amount, minimum_choice, priority', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, election_id, name, minimum_choice, candidate_amount, priority', 'safe', 'on'=>'search'),
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
			'candidates' => array(self::HAS_MANY, 'Candidates', 'seat_id'),
			'election' => array(self::BELONGS_TO, 'Elections', 'election_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'election_id' => 'Election',
			'name' => 'Name',
			'minimum_choice' => 'Minimum Choice',
			'candidate_amount' => 'Maximum Choice',
			'priority' => 'Priority',
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
		$criteria->compare('election_id',$this->election_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('minimum_choice',$this->minimum_choice);
		$criteria->compare('candidate_amount',$this->candidate_amount);
		$criteria->compare('priority',$this->priority);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeDelete()
	{
		foreach($this->candidates() as $candidate){
			$candidate->delete();
		}
		return parent::beforeDelete();
	}
}
