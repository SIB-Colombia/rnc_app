<?php

class SiteController extends Controller
{
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
		$model=new LoginForm;
		 
		// Verificar si el usuario previamente estaba autenticado
		/*if(Yii::app()->user->getId() === null)
		{
			// El usuario no se ha autenticado, llamar al controlador de autenticación
			$this->redirect(array("site/login"));
		} else {
			$this->redirect(array("catalogo/index"));
		}*/
		
		$this->render('index');
		
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
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
				$this->redirect(Yii::app()->user->returnUrl);
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
	
	public function actionInstructivo(){
		$this->render('instructivo');
	}
	
	public function actionArchivoAuto(){
		$filename = "rnc_files".DIRECTORY_SEPARATOR."Certificado_autodeclaracion.docx";
		header("Expires: -1");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Content-type: application/docx;\n"); //or yours?
		header("Content-Transfer-Encoding: binary");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0");
		header("Pragma: no-cache");
		$len = filesize($filename);
		header("Content-Length: $len;\n");
		$outname="Certificado_autodeclaracion.docx";
		header("Content-Disposition: attachment; filename=".$outname.";\n\n");
		readfile($filename);
	}
	
	public function actionArchivoInstructivo(){
		$filename = "rnc_files".DIRECTORY_SEPARATOR."Instructivo_RNC_1.1.pdf";
		header("Expires: -1");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Content-type: application/xlsx;\n"); //or yours?
		header("Content-Transfer-Encoding: binary");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0");
		header("Pragma: no-cache");
		$len = filesize($filename);
		header("Content-Length: $len;\n");
		$outname="Instructivo_RNC_1.1.pdf";
		header("Content-Disposition: attachment; filename=".$outname.";\n\n");
		readfile($filename);
	}
}