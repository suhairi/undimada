<?php

/**
 * This is the model class for table "elections".
 *
 * The followings are the available columns in table 'elections':
 * @property integer $id
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 *
 * The followings are the available model relations:
 * @property Candidates[] $candidates
 * @property Tokens[] $tokens
 */
class Elections extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Elections the static model class
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
		return 'elections';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, voters_count, start_date, end_date', 'required'),
			array('voters_count', 'numerical', 'integerOnly'=>true),
			array('voters_count', 'numerical', 'min'=>1),
			array('name', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, voters_count, start_date, end_date', 'safe', 'on'=>'search'),
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
			'seats' => array(self::HAS_MANY, 'Seats', 'election_id'),
			'candidates' => array(self::HAS_MANY, 'Candidates', 'election_id'),
			'tokens' => array(self::HAS_MANY, 'Tokens', 'election_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeDelete()
	{
		foreach($this->seats() as $seat){
			$seat->delete();
		}
		foreach($this->tokens() as $token){
			$token->delete();
		}
		return parent::beforeDelete();
	}

	public function updatecount() 
	{
		foreach($this->candidates() as $candidate){
			$candidate->updatecount();
		}
	}
}
