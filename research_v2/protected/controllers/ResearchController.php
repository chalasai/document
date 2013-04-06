<?php

class ResearchController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('admin','delete'),
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
		// new model Research and Research file
		$model=new Research;
		$model_file=new ResearchFile;
	
		// get all research group for dropdownlist
		$research_group=$model->findAllResearchGroup();
		
		// defind path for upload file
		$path =Yii::getPathOfAlias('webroot').'/files/';

		// form submit
		if(isset($_POST['Research']))
		{
			// collect value from form to model object
			$model->attributes=$_POST['Research'];
			$model_file->attributes=$_POST['ResearchFile'];
			
			$valid = $model->validate();
			if($valid)
			{
				$model->user_id = 1;  //TODO for login
				$model->create_date = date('Y-m-d H:i:s');
				$model->save(false);

				// collect file field
				if($file = CUploadedFile::getInstance($model_file,'file'))
				{
					$groupname = researchGroup::model()->find('id=:id', array(':id'=>$model->research_group_id));
					// make the directory to store the pic:
					if(!is_dir($path.'/'. $groupname->code))
					{
						mkdir($path.'/'. $groupname->code);
						chmod($path.'/'. $groupname->code, 0755);
					}
					$realpath = $path.'/'. $groupname->code.'/';
					// generate file name from research title
					$filename = $model->title.'.'.$file->getExtensionName();
					// set value for research file
					$model_file->name = $filename;
					$model_file->research_id = $model->id;
					$model_file->path = $realpath;
					$model_file->type = $file->getExtensionName();
						
					if($model_file->save(false))
						$file->saveAs($realpath.$filename);
				}
				$this->redirect(array('view','id'=>$model->id));
			}	
		}

		$this->render('create',array(
			'model'=>$model,
			'research_group'=>$research_group,
			'model_file'=>$model_file,
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

		if(isset($_POST['Research']))
		{
			$model->attributes=$_POST['Research'];
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Research');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Research('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Research']))
			$model->attributes=$_GET['Research'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Research the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Research::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Research $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='research-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function downloadfile()
	{
		// TODO 
	}
}
