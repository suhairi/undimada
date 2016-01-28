<?php

class TokensController extends Controller
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
	'actions'=>array('admin','delete','print'),
	'users'=>array('admin'),
),
array('deny',  // deny all users
'users'=>array('*'),
			),
		);
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
		$model=new Tokens;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tokens']))
		{
			$model->attributes=$_POST['Tokens'];
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

		if(isset($_POST['Tokens']))
		{
			$model->attributes=$_POST['Tokens'];
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
		if(isset($_GET['election_id'])){
			$election=Elections::model()->findByPk($_GET['election_id']);
			$seats = Seats::model()->with(array(
				'candidates.votes'=>array('order'=>'candidates.name'),
			))->findAll(array('condition'=>'t.election_id='.$_GET['election_id'],'order'=>'priority asc'));
			$dataProvider=new CActiveDataProvider('Tokens',array(
				'criteria'=>array(
					'condition'=>'election_id='.$_GET['election_id'],
					'order'=>'token asc',
				),
			));
		}
		else{
			$this->redirect('Elections/index');
		}
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'seats'=>$seats,
			'election'=>$election,
		));
	}

	public function actionPrint()
	{
		$this->layout='blankback';
		if(isset($_GET['election_id'])){
			$election=Elections::model()->findByPk($_GET['election_id']);
			$seats = Seats::model()->with(array(
				'candidates.votes'=>array('order'=>'candidates.name'),
			))->findAll(array('condition'=>'t.election_id='.$_GET['election_id'],'order'=>'priority asc'));
			$dataProvider=Tokens::model()->findAll(array(
					'condition'=>'election_id='.$_GET['election_id'],
					'order'=>'token asc',
			));
		}
		else{
			$this->redirect('Elections/index');
		}
		$mPDF1 = Yii::app()->ePdf->mpdf();
		$mPDF1->WriteHTML(
			$this->render('print',array(
				'tokens'=>$dataProvider,
				'seats'=>$seats,
				'election'=>$election,
			),true)
		);
		$mPDF1->Output('tokensaudit-'.$election->name.'.pdf','I');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Tokens('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tokens']))
			$model->attributes=$_GET['Tokens'];

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
		$model=Tokens::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='tokens-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
