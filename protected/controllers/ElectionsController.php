<?php

class ElectionsController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','view','admin','delete','results','fixresults','resultform','generate','tokens'),
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
		$election=Elections::model()->findByPk($id);
		$station=$this->loadModel($id);
		$tokens = Tokens::model()->findAll('election_id=:election_id',array(':election_id'=>$id));
		$mPDF1 = Yii::app()->ePdf->mpdf();
		$mPDF1->WriteHTML($this->render('generate', array('election'=>$election,'tokens'=>$tokens), true));
		$mPDF1->Output('tokenscutout-'.$election->name.'.pdf','I');
		/*$this->render('generate',array(
			'election'=>$this->loadModel($id),
			'tokens'=>$tokens,
		));*/
	}

	public function actionGenerate($id)
	{
		$election=$this->loadModel($id);
		$oldtokens = Tokens::model()->findAll('election_id=:election_id',array(':election_id'=>$id));
		foreach($oldtokens as $oldtoken){
			Votes::model()->deleteAll('token_id=:token_id',array(':token_id'=>$oldtoken->id));
		}
		foreach($election->seats() as $seat){
			foreach($seat->candidates() as $candidate){
				$candidate->votescount=0;
				$candidate->save();
			}
		}
		Tokens::model()->deleteAll('election_id=:election_id',array(':election_id'=>$id));
		$tokens = array();
		for($i=0;$i<$election->voters_count;$i++){
			$token = new Tokens;
			$token->election_id=$id;
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
		$this->redirect(array('Tokens/index','election_id'=>$election->id));
	}

	public function actionResults($id)
	{
		$election = Elections::model()->with('tokens')->findByPk($id);
		$seats = Seats::model()->with(array(
			'candidates.votes'=>array('order'=>'candidates.name'),
		))->findAll(array('condition'=>'t.election_id='.$id,'order'=>'priority asc'));
		$duplicatevotes = Yii::app()->db->createCommand('select count(id) as votecount,token_id,candidate_id from votes group by token_id,candidate_id having count(id)>1')->queryAll();
		foreach($duplicatevotes as $duplicate){
			$fixvote = new FixVotes;
			$fixvote->token_id = $duplicate['token_id'];
			$fixvote->candidate_id = $duplicate['candidate_id'];
			$fixvote->votecount = $duplicate['votecount'];
			$fixvote->save();
			$delcommand = Yii::app()->db->createCommand('delete v1 from votes v1, votes v2 where v1.id<v2.id and v1.token_id=v2.token_id and v1.candidate_id=v2.candidate_id and v1.token_id='.$duplicate['token_id'].' and v1.candidate_id='.$duplicate['candidate_id']);
			$delcommand->execute();
		};
		$election->updatecount();
		$usedtokens = Tokens::model()->used($id)->findAll();
		$election = Elections::model()->with('tokens')->findByPk($id);
		$this->render('results',array(
			'seats'=>$seats,
			'election'=>$election,
			'usedtokens'=>$usedtokens,
		));
	}

	public function actionFixresults($id)
	{
		$election = Elections::model()->with('tokens')->findByPk($id);
		$seats = Seats::model()->with(array(
			'candidates.votes'=>array('order'=>'candidates.name'),
		))->findAll(array('condition'=>'t.election_id='.$id,'order'=>'priority asc'));
		$duplicatevotes = Yii::app()->db->createCommand('select count(id) as votecount,token_id,candidate_id from votes group by token_id,candidate_id having count(id)>1')->queryAll();
		foreach($duplicatevotes as $duplicate){
			$fixvote = new FixVotes;
			$fixvote->token_id = $duplicate['token_id'];
			$fixvote->candidate_id = $duplicate['candidate_id'];
			$fixvote->votecount = $duplicate['votecount'];
			$fixvote->save();
			$delcommand = Yii::app()->db->createCommand('delete v1 from votes v1, votes v2 where v1.id<v2.id and v1.token_id=v2.token_id and v1.candidate_id=v2.candidate_id and v1.token_id='.$duplicate['token_id'].' and v1.candidate_id='.$duplicate['candidate_id']);
			$delcommand->execute();
		};
		$election->updatecount();
		$usedtokens = Tokens::model()->used($id)->findAll();
		$this->render('fixresults',array(
			'seats'=>$seats,
			'election'=>$election,
			'usedtokens'=>$usedtokens,
		));
	}

	public function actionResultform($id)
	{
		$this->layout='blankback';

		$seats = Seats::model()->with(array(
			'candidates.votes'=>array('order'=>'candidates.votescount desc'),
		))->findAll(array('condition'=>'t.election_id='.$id,'order'=>'priority asc'));


		$election = Elections::model()->with('tokens')->findByPk($id);
		$usedtokens = Tokens::model()->used($id)->findAll();


		$mPDF1 = Yii::app()->ePdf->mpdf();
		$mPDF1->WriteHTML(
			$this->render('resultform',array(
				'seats'=>$seats,
				'election'=>$election,
				'usedtokens'=>$usedtokens,
			),true));
		$mPDF1->Output('results-'.$election->name.'.pdf','I');
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$election = Elections::model()->with('tokens')->findByPk($id);
		$duplicatevotes = Yii::app()->db->createCommand('select count(id) as votecount,token_id,candidate_id from votes group by token_id,candidate_id having count(id)>1')->queryAll();
		foreach($duplicatevotes as $duplicate){
			$fixvote = new FixVotes;
			$fixvote->token_id = $duplicate['token_id'];
			$fixvote->candidate_id = $duplicate['candidate_id'];
			$fixvote->votecount = $duplicate['votecount'];
			$fixvote->save();
			$delcommand = Yii::app()->db->createCommand('delete v1 from votes v1, votes v2 where v1.id<v2.id and v1.token_id=v2.token_id and v1.candidate_id=v2.candidate_id and v1.token_id='.$duplicate['token_id'].' and v1.candidate_id='.$duplicate['candidate_id']);
			$delcommand->execute();
		};
		$election->updatecount();
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
		$model=new Elections;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Elections']))
		{
			$model->attributes=$_POST['Elections'];
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

		if(isset($_POST['Elections']))
		{
			$model->attributes=$_POST['Elections'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$model->start_date = date("Y-m-d h:i:s",strtotime($model->start_date));
		$model->end_date = date("Y-m-d h:i:s",strtotime($model->end_date));
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
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$serverurl = explode('//',Yii::app()->getRequest()->hostInfo);
		if($serverurl[1]!=Yii::app()->params['adminUrl']){
			$this->redirect('Votes/welcome');
		}
		$dataProvider=new CActiveDataProvider('Elections');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Elections('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Elections']))
			$model->attributes=$_GET['Elections'];

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
		$model=Elections::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='elections-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
