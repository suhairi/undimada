<?php

/**
 * This is the model class for table "tokens".
 *
 * The followings are the available columns in table 'tokens':
 * @property integer $id
 * @property string $token
 * @property integer $election_id
 *
 * The followings are the available model relations:
 * @property Elections $election
 * @property Votes[] $votes
 */
class Tokens extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tokens the static model class
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
		return 'tokens';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('token, election_id', 'required'),
			array('election_id', 'numerical', 'integerOnly'=>true),
			array('token', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, token, election_id', 'safe', 'on'=>'search'),
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
			'election' => array(self::BELONGS_TO, 'Elections', 'election_id'),
			'votes' => array(self::HAS_MANY, 'Votes', 'token_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'token' => 'Token',
			'election_id' => 'Election',
			'done_vote' => 'Already Voted',
			'date_vote' => 'Date Voted',
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
		$criteria->compare('token',$this->token,true);
		$criteria->compare('election_id',$this->election_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function used($election_id)
	{
		$this->getDbCriteria()->mergeWith(array(
			'condition'=>'done_vote=1 and election_id='.$election_id,
		));
		return $this;
	}
}
