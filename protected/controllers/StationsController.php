<?php

class StationsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
			'actions'=>array('index','view'),
			'users'=>array('*'),
		),
		array('allow', // allow authenticated user to perform 'create' and 'update' actions
		'actions'=>array('create','update'),
		'users'=>array('@'),
	),
	array('allow', // allow admin user to perform 'admin' and 'delete' actions
	'actions'=>array('admin','delete','generate','tokens'),
	'users'=>array('admin'),
),
array('deny',  // deny all users
'users'=>array('*'),
			),
		);
	}

	public function generatePassword($length = 8)
	{
		// start with a blank password
		$password = "";

		// define possible characters - any character in this string can be
		// picked for use in the password, so if you want to put vowels back in
		// or add special characters such as exclamation marks, this is where
		// you should do it
		$possible = "2346789";

		// we refer to the length of $possible a few times, so let's grab it now
		$maxlength = strlen($possible);

		// check for length overflow and truncate if necessary
		if ($length > $maxlength) {
			$length = $maxlength;
		}

		// set up a counter for how many characters are in the password so far
		$i = 0; 

		// add random characters to $password until $length is reached
		while ($i < $length) { 

			// pick a random character from the possible ones
			$char = substr($possible, mt_rand(0, $maxlength-1), 1);

			// have we already used this character in $password?
			if (!strstr($password, $char)) { 
				// no, so it's OK to add it onto the end of whatever we've already got...
				$password .= $char;
				// ... and increase the counter by one
				$i++;
			}

		}

		// done!
		return $password;

	}

	public function actionTokens($id)
	{
		$election=Elections::model()->findAll();
		$station=$this->loadModel($id);
		$tokens = Tokens::model()->findAll('station_id=:station_id',array(':station_id'=>$id));
		$this->render('generate',array(
			'election'=>$election[0],
			'tokens'=>$tokens,
			'station'=>$station,
		));
	}

	public function actionGenerate($id)
	{
		$station=$this->loadModel($id);
		$election=Elections::model()->findAll();
		$oldtokens = Tokens::model()->findAll('station_id=:station_id',array(':station_id'=>$id));
		foreach($oldtokens as $oldtoken){
			Votes::model()->deleteAll('token_id=:token_id',array(':token_id'=>$oldtoken->id));
		}
		Tokens::model()->deleteAll('station_id=:station_id',array(':station_id'=>$id));
		$tokens = array();
		for($i=0;$i<$station->voters_count;$i++){
			$token = new Tokens;
			$token->election_id=$election[0]->id;
			$token->station_id=$id;
			$token->token=$this->generatePassword();
			$prevtoken = Tokens::model()->findAll('token=:token',array(':token'=>$token->token));
			while($prevtoken){
				$token->token=$this->generatePassword();
				$prevtoken = Tokens::model()->findAll('token=:token',array(':token'=>$token->token));
			}
			$token->done_vote=0;
			$token->save();
			$tokens[]=$token;
		}
		$this->render('generate',array(
			'election'=>$election[0],
			'tokens'=>$tokens,
			'station'=>$station,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Stations;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Stations']))
		{
			$model->attributes=$_POST['Stations'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Stations']))
		{
			$model->attributes=$_POST['Stations'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Stations');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Stations('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Stations']))
			$model->attributes=$_GET['Stations'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Stations::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='stations-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
