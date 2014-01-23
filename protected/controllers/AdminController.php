<?php
class AdminController extends Controller{
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha'=>array(
						'class'=>'CCaptchaAction',
						'backColor'=>0xFFFFFF,
				),
				// page action renders "static" pages stored under 'protected/views/site/pages'
				// They can be accessed via: index.php?r=site/page&view=FileName
				'page'=>array(
						'class'=>'CViewAction',
				),
		);
	}
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// Cargar el modelo formulario de registro para autenticar al aplicante basada en m�todo Natalia
		// A futuro reemplazar por autenticacion RBAC
		//$model=new LoginForm;
			
		// Verificar si el usuario previamente estaba autenticado
		if(Yii::app()->user->getId() === null)
		{
			// El usuario no se ha autenticado, llamar al controlador de autenticación
			$this->redirect(array("admin/login"));
		} else {
			$this->redirect(array("admin/panel"));
		}
	
	}
	
	public function actionPanel()
	{
		if(Yii::app()->user->getId() !== null)
		{
			$model = new Admin();
			$entidad = new Entidad();
			$registro = new Registros();
			$pqrs = Pqrs::model();
			
			$userRole = Yii::app()->user->getState("roles");
			if($userRole == "entidad"){
				$usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
					
				$criteriaEntidad = new CDbCriteria;
				$criteriaEntidad->compare('usuario_id',$usuario->id);
					
				$entidad = Entidad::model()->find($criteriaEntidad);
			
				$registro->entidad = $entidad;
				$registro->Entidad_id = $entidad->id;
				
			}
			
			$this->cleanFileTmp();
			$this->render('panel',array('model'=>$model,'entidad' => $entidad,'registro' => $registro,'pqrs' => $pqrs));
		}else{
			$this->redirect(array("admin/login"));
		}
		
		
	}
	
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;
	
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(array("admin/index"));
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function cleanFileTmp(){
	
		$dirPath	= "tmp/";
		$directorio = opendir($dirPath);
	
		while ($archivo = readdir($directorio)){
			$path		= $dirPath.$archivo;
			if (is_file($path)) {
				$op_file = pathinfo($path);
				
				$filetime = time() - filemtime($path);
				if($filetime >= (60*60*1)){
					unlink($path);
				}
				
			}
		}
	
		closedir($directorio);
	}
}