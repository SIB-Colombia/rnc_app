<?php
class UsuarioController extends Controller{
	
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
				//'accessControl', // perform access control for CRUD operations
				//'postOnly + delete', // we only allow deletion via POST request
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
						'users'=>array('@'),
						'roles'=>array('admin','entidad'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update'),
						'users'=>array('@'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('admin','delete'),
						'roles'=>array('admin'),
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
		if(Yii::app()->user->getId() !== null)
		{
			$this->render('view',array(
					'model'=>$this->loadModel($id),
			));
		}else{
			$this->redirect(array("admin/login"));
		}
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		
		if(Yii::app()->user->getId() !== null)
		{
			$model=new Usuario;
		
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
		
			if(isset($_POST['Usuario']))
			{
				$model->attributes=$_POST['Usuario'];
				//$this->performAjaxValidation($model);
				if($model->password != "" && $model->password2 != ""){
					
					if($model->password === $model->password2){
						if($model->role == "admin"){
							$model->password	= md5($model->password);
							$model->password	= crypt($model->password, self::blowfishSalt());
							$model->password2	= $model->password;
						}
					}
				}
					
				if($model->save()){
					if (Yii::app()->request->isAjaxRequest){
						echo CJSON::encode(array(
								'status'=>'success',
								'idUser'=> $model->id
						));
						exit;
					}else{
						$this->redirect(array('view','id'=>$model->id));
					}
				}else{
					if (Yii::app()->request->isAjaxRequest)
					{
						echo CJSON::encode(array(
								'status'=>'failure',
								'div'=>$this->renderPartial('_form', array('model'=>$model), true)));
						exit;
					}
				}
					
			}
		
			$this->render('create',array(
					'model'=>$model,
			));
		}else{
			$this->redirect(array("admin/login"));
		}
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		if(Yii::app()->user->getId() !== null)
		{
			$model=$this->loadModel($id);
		
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
		
			if(isset($_POST['Usuario']))
			{
				$model->attributes=$_POST['Usuario'];
				
				$model->newpassword = $_POST['Usuario']['newpassword'];
				$model->password = $model->newpassword;
				$password = "";
				if($model->password === $model->password2){
					$password			= $model->password;
					
					$model->password	= md5($model->password);
					$model->password	= crypt($model->password, self::blowfishSalt());
					$model->newpassword = $model->password;
					$model->password2	= $model->password;
				}
				if($model->save()){
					$message 			= new YiiMailMessage;
					$message->view 		= "actualizaUsuario";
					$params				= array('data' => $model,'user' => $model->username,'pass' => $password);
					$message->subject	= 'Actualizar Usuario Sistema RNC';
					$message->from		= 'hescobar@humboldt.org';
					$message->setBody($params,'text/html');
					$message->addto($model->email);
					Yii::app()->mail->send($message);
					
					$this->redirect(array('view','id'=>$model->id));
				}
			}
		
			$this->render('update',array(
					'model'=>$model,
			));
		}else{
			$this->redirect(array("admin/login"));
		}
	}
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->user->getId() !== null)
		{
			$this->loadModel($id)->delete();
		
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}else{
			$this->redirect(array("admin/login"));
		}
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		if(Yii::app()->user->getId() !== null)
		{
			$model=new Usuario('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['Usuario']))
				$model->attributes=$_GET['Usuario'];
		
			$this->render('index',array(
					'model'=>$model,
			));
		}else {
			$this->redirect(array("admin/login"));
		}
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CatalogoUser the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Usuario::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * Performs the AJAX validation.
	 * @param CatalogoUser $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='usuario-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * Generate a random salt in the crypt(3) standard Blowfish format.
	 *
	 * @param int $cost Cost parameter from 4 to 31.
	 *
	 * @throws Exception on invalid cost parameter.
	 * @return string A Blowfish hash salt for use in PHP's crypt()
	 */
	function blowfishSalt($cost = 13){
		if(!is_numeric($cost) || $cost < 4 || $cost > 13){
			throw new Exception("El costo debe estar entre 4 y 31");
		}
	
		$rand = array();
		for ($i = 0; $i < 8; $i++) {
			$rand[] = pack('S', mt_rand(0, 0xffff));
		}
		$rand[] = substr(microtime(), 2, 6);
		$rand 	= sha1(implode('', $rand), true);
		$salt	= '$2a$'.sprintf('%02d',$cost).'$';
		$salt	.= strtr(substr(base64_encode($rand), 0, 22), array('+' => '.'));
		return  $salt;
	}
	
	public function actionValidarUsuarioAjax(){
		if(Yii::app()->user->getId() !== null)
		{
			if(isset($_POST['usuario'])){
				$criteria = new CDbCriteria;
				$criteria->compare("username", $_POST['usuario']);
			
				$modelUsuario = Usuario::model()->find($criteria);
			
				if($modelUsuario){
					echo 1;
				}else {
					echo 0;
				}
			}
		}
	}
	
	public function actionRecuperaPassword(){
		if(isset($_POST['Usuario'])){
			$criteria = new CDbCriteria;
			$criteria->compare("email", $_POST['Usuario']['email']);
			
			$modelUsuario = Usuario::model()->find($criteria);
			
			if($modelUsuario){
				$pass = Usuario::model()->generaPassword();
				
				$modelUsuario->password	= md5($pass);
				$modelUsuario->password	= crypt($modelUsuario->password, self::blowfishSalt());
				
				if($modelUsuario->save()){
					$mails = array(0 => $modelUsuario->email);
					$message 			= new YiiMailMessage;
					$message->view 		= "recuperaPassword";
					//$data 			= "Mensaje prueba";
					$params				= array('data' => $modelUsuario, 'pass' => $pass);
					$message->subject	= 'Datos de Acceso de Usuario Sistema RNC';
					$message->from		= 'hescobar@humboldt.org';
					$message->setBody($params,'text/html');
					$message->setTo($mails);
					Yii::app()->mail->send($message);
				}
				
				echo json_encode(array('status' => 'ok','pass'=>$pass));
			}else{
				echo json_encode(array('status' => 'failure'));
			}
		}
	}
}
?>