<?php

/**
 * This is the model class for table "candidates".
 *
 * The followings are the available columns in table 'candidates':
 * @property integer $id
 * @property string $name
 * @property string $picture
 * @property integer $election_id
 * @property integer $seat_id
 *
 * The followings are the available model relations:
 * @property Seats $seat
 * @property Elections $election
 * @property Votes[] $votes
 */
class Candidates extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Candidates the static model class
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
		return 'candidates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, election_id, seat_id', 'required'),
			array('election_id, seat_id', 'numerical', 'integerOnly'=>true),
			array('name, nickname, picture', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, nickname, picture, election_id, seat_id, votescount', 'safe', 'on'=>'search'),
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
			'seat' => array(self::BELONGS_TO, 'Seats', 'seat_id'),
			'election' => array(self::BELONGS_TO, 'Elections', 'election_id'),
			'votes' => array(self::HAS_MANY, 'Votes', 'candidate_id'),
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
			'nickname' => 'Nick Name',
			'picture' => 'Picture',
			'election_id' => 'Election',
			'seat_id' => 'Seat',
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
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('election_id',$this->election_id);
		$criteria->compare('seat_id',$this->seat_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function beforeDelete()
	{
		foreach($this->votes() as $vote){
			$vote->delete();
		}
		return parent::beforeDelete();
	}

	public function updatecount()
	{
		$votes = Votes::model()->findAll(array(
			"condition"=>"candidate_id=".$this->id,
		));
		$this->votescount = count($votes);
		$duplicates = FixVotes::model()->findAll(array(
			"condition"=>"candidate_id=".$this->id,
		));
		$fixduplicate = 0;
		foreach($duplicates as $duplicate){
			$fixduplicate += $duplicate->votecount - 1;
		}
		$this->fixduplicate = $fixduplicate;
		$this->save(false);
	}
}
