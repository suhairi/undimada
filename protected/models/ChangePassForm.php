<?php

class ChangePassForm extends CFormModel
{
	public $oldpass;
	public $newpass;
	public $newpass2;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('oldpass, newpass, newpass2', 'required'),
			array('oldpass','sameoldpass'),
			array('newpass2','samenewpass'),
		);
	}

	public function samenewpass(){
		if($this->newpass!==$this->newpass2){
			$this->addError('newpass2','New passwords do not match');
		}
	}

	public function sameoldpass(){
		$userpass = Yii::app()->settings->get("users","admin");
		if($userpass){
			if($this->oldpass!==$userpass){
				$this->addError('oldpass','Wrong old password');
			}
		}
		else{
			if($this->oldpass!=='admin'){
				$this->addError('oldpass','Wrong old password');
			}
		}
	}

	public function changepass(){
		Yii::app()->settings->set("users","admin",$this->newpass);
		$userpass = Yii::app()->settings->get("users","admin");
		if($userpass==$this->newpass){
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'oldpass'=>'Previous Password',
			'newpass'=>'New Password',
			'newpass2'=>'Repeat New Password',
		);
	}
}
