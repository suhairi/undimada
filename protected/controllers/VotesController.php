<?php

class VotesController extends Controller
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
			'actions'=>array('index','view','welcome','vote','verify','thanks'),
			'users'=>array('*'),
		),
		array('allow', // allow authenticated user to perform 'create' and 'update' actions
		'actions'=>array('create','update'),
		'users'=>array('@'),
	),
	array('allow', // allow admin user to perform 'admin' and 'delete' actions
	'actions'=>array('admin','delete'),
	'users'=>array('admin'),
),
array('deny',  // deny all users
'users'=>array('*'),
			),
		);
	}

	public function actionWelcome($error_msg=null)
	{
		$serverurl = explode('//',Yii::app()->getRequest()->hostInfo);
		if($serverurl[1]==Yii::app()->params['adminUrl'] && !Yii::app()->user->isGuest){
			$this->redirect(array('Elections/index'));
		}
		$this->layout="vote";
		unset(Yii::app()->session['chosenones']);
		$this->render('welcome',array(
			'model'=>Elections::model()->find(),
			'error_msg'=>$error_msg,
		));
	}

	public function actionVote()
	{
		$this->layout="vote";
		if(isset($_POST['token'])){
			$token = Tokens::model()->find('token=:token',array(':token'=>trim($_POST['token'])));
		}
		elseif(isset($_POST['token_id'])){
			$token = Tokens::model()->find('id=:token',array(':token'=>$_POST['token_id']));
		}
		if($token){
			if($token->done_vote){
				$this->redirect(array('Votes/welcome','error_msg'=>'Nombor token ini telah digunakan sebelum ini'));
			}
			$curtime = date('Y-m-d H:i:s');
			if($curtime<$token->election()->start_date){
				$this->redirect(array('Votes/welcome','error_msg'=>'Pilihanraya '.$token->election()->name.' belum lagi bermula'));
			}
			if($curtime>$token->election()->end_date){
				$this->redirect(array('Votes/welcome','error_msg'=>'Pilihanraya '.$token->election()->name.' telah tamat'));
			}
		}
		else{
			$this->redirect(array('Votes/welcome','error_msg'=>'Sila masukkan nombor token yang sah'));
		}
		$oldchosen=Yii::app()->session['chosenones'];
		if(isset($_POST['seat_id'])){
			$curseat=Seats::model()->findByPk($_POST['seat_id']);
			$chosen=Yii::app()->session['chosenones'];
			unset($chosen[$_POST['seat_id']]);
			foreach($_POST as $ckey=>$cval){
				if(substr($ckey,0,5)=='calon' && $cval){
					$chosen[$_POST['seat_id']][]=substr($ckey,5);
				}
			}
			Yii::app()->session['chosenones']=$chosen;
		}
		else{
			Yii::app()->session['chosenones']=null;
		}
		if(isset($_POST['election_id'])){
			$election = Elections::model()->find('id=:election',array(':election'=>$_POST['election_id']));
		}
		else{
			$election = Elections::model()->find('id=:election',array(':election'=>$token->election_id));
		}
		if($election){
			if($token && $election){
				$candidates=null;
				$seat=null;
				$nextseat=null;
				if(!isset($_POST['nextseat_id'])){
					$nextseats = Seats::model()->findAll(array(
						"condition"=>"election_id=".$election->id,
						"order"=>"priority asc"
					));
					if(sizeOf($nextseats)){
						$seat = $nextseats[0];
						if(!isset($_POST['correction']) && sizeOf($nextseats)>1){
							$nextseat=$nextseats[1];
						}
					}
				}
				else{
					$seat=Seats::model()->findByPk($_POST['nextseat_id']);
					if(!isset($_POST['correction'])){
						$nextseat = Seats::model()->find(array(
							"condition"=>"election_id=".$election->id." and priority>".$seat->priority,
							"order"=>"priority asc"
						));
					}
				}
				if($seat){
					$candidates=Candidates::model()->findAll(array(
						'condition'=>'election_id='.$election->id.' and seat_id='.$seat->id,
						'order'=>'name asc',
					));
					$curpos=1;
					$cnumber=Yii::app()->session['cnumber'];
					foreach($candidates as $candidate){
						$cnumber[$candidate->id]=$curpos;
						$curpos++;
					}
					Yii::app()->session['cnumber']=$cnumber;
				}
				$this->render('vote',array(
					'election'=>$election,
					'token'=>$token,
					'seat'=>$seat,
					'candidates'=>$candidates,
					'nextseat'=>$nextseat,
					'chosen'=>$oldchosen,
				));
			}
		};
	}

	public function actionVerify()
	{
		$this->layout="vote";
		if(isset($_POST['seat_id'])){
			$chosen=Yii::app()->session['chosenones'];
			unset($chosen[$_POST['seat_id']]);
			foreach($_POST as $ckey=>$cval){
				if(substr($ckey,0,5)=='calon' && $cval){
					$chosen[$_POST['seat_id']][]=substr($ckey,5);
				}
			}
			Yii::app()->session['chosenones']=$chosen;
		}
		if(isset($_POST['election_id'])){
			if(isset($_POST['token_id'])){
				$token = Tokens::model()->find('id=:token',array(':token'=>$_POST['token_id']));
			}
			$election = Elections::model()->find('id=:election',array(':election'=>$_POST['election_id']));
			$chosen=Yii::app()->session['chosenones'];
			$seats = Seats::model()->findAll(array(
				"condition"=>"election_id=".$election->id,
				"order"=>"priority asc"
			));
			foreach($seats as $seat){
				$candidates[$seat->id]=Candidates::model()->findAll(array(
					'condition'=>'id in ('.join($chosen[$seat->id],',').')',
					'order'=>'name asc',
				));
			}

			if($token && $election){
				$this->render('verify',array(
					'election'=>$election,
					'token'=>$token,
					'candidates'=>$candidates,
					'seats'=>$seats,
					'cnumber'=>Yii::app()->session['cnumber'],
				));
			}
		}
	}

	public function actionThanks()
	{
		$this->layout="vote";
		if(isset($_POST['election_id'])){
			$chosen=Yii::app()->session['chosenones'];
			$donevote = true;
			if(isset($_POST['token_id'])){
				$token = Tokens::model()->find('id=:token',array(':token'=>$_POST['token_id']));
				if(!$token->done_vote){
					$token->done_vote=1;
					$token->date_vote=date('Y-m-d H:i');
					$token->save();
					$donevote = false;
				}
			}
			if(!$donevote){
				$seats = Seats::model()->findAll(array(
					"condition"=>"election_id=".$_POST['election_id'],
					"order"=>"priority asc"
				));
				foreach($seats as $seat){
					foreach($chosen[$seat->id] as $candidate_id){
						$vote = new Votes;
						$vote->token_id = $token->id;
						$vote->candidate_id = $candidate_id;
						$vote->save();
					}
				}
			}

			$this->render('thanks',array(
				'election'=>Elections::model()->find('id=:election_id',array(':election_id'=>$_POST['election_id'])),
			));
		}
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
		$model=new Votes;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Votes']))
		{
			$model->attributes=$_POST['Votes'];
			if($model->save())
				$this->redirect(array('Votes/view','id'=>$model->id));
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

		if(isset($_POST['Votes']))
		{
			$model->attributes=$_POST['Votes'];
			if($model->save())
				$this->redirect(array('Votes/view','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('Votes');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Votes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Votes']))
			$model->attributes=$_GET['Votes'];

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
		$model=Votes::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='votes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
