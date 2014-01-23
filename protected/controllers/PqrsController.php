<?php
class PqrsController extends Controller{
	
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
						'roles'=>array('admin'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update'),
						'users'=>array('@'),
						'roles'=>array('admin'),
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
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return CatalogoUser the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		
		$model=Pqrs::model()->findByPk($id);
		
		$modelEntidad=Entidad::model()->findByPk($model->entidad_id);
		$model->entidad = $modelEntidad;
		
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		if(Yii::app()->user->getId() !== null)
		{
			if(isset($_POST['Pqrs'])){
				$model = $this->loadModel($id);
				
				$model->estado = ($_REQUEST['Pqrs']['aprobado'] == 0) ? 1 : 0;
				$model->respuesta = $_REQUEST['Pqrs']['respuesta'];
				
				$success_saving_all = false;
				
				$transaction = Yii::app()->db->beginTransaction();
				
				try {
				
					if($model->save()){
						if(isset($_POST['Pqrs']['nombreArchivo']) && $_POST['Pqrs']['nombreArchivo'] != ''){
							$pathDir = 'rnc_files'.DIRECTORY_SEPARATOR."pqrs".DIRECTORY_SEPARATOR.$model->id;
							if(!file_exists($pathDir)){
								mkdir($pathDir);
							}
								
							$dataFiles_ar = explode(",", $_POST['Pqrs']['nombreArchivo']);
							foreach ($dataFiles_ar as $value){
								$dataFiles = explode("/", $value);
								if(file_exists("tmp".DIRECTORY_SEPARATOR.$dataFiles[0])){
									if(rename("tmp".DIRECTORY_SEPARATOR.$dataFiles[0], $pathDir.DIRECTORY_SEPARATOR.$dataFiles[0])){
										
										$archivoModel = new Archivos_Pqrs();
										$archivoModel->nombre	= $dataFiles[0];
										$archivoModel->ruta		= $pathDir;
										$archivoModel->pqrs_id	= $model->id;
										
										$archivoModel->save();
									}
								}
							}
							
						}
						$model->save();
						$success_saving_all = true;
					}
				
					$transaction->commit();
				
				} catch (Exception $e) {
					$transaction->rollback();
					print_r($e->getMessage());
					Yii::log("Ocurrió un error al enviar solicitud  " . $e->getMessage(), 'error');
					$success_saving_all = false;
					Yii::app()->end();
				}
				
				if($success_saving_all){
								
					$message 			= new YiiMailMessage;
					$message->view 		= "responderContacto";
					//$data 			= "Mensaje prueba";
					$params				= array('data' => $model);
					$message->subject	= 'Sistema RNC - Respuesta de Solicitud';
					$message->from		= 'hescobar@humboldt.org';
					$message->setBody($params,'text/html');
					$message->setTo($model->email);
					Yii::app()->mail->send($message);
				
				}
			}
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
		$model = new Pqrs;
		$model->registros = Registros::model();
		$userRole = Yii::app()->user->getState("roles");
		if(isset($_POST['Pqrs']))
		{
			$model->attributes	= $_POST['Pqrs'];
			$model->fecha		= Yii::app()->Date->now();
			$model->estado		= 0;
			
			$success_saving_all = false;
			
			$transaction = Yii::app()->db->beginTransaction();
			
			try {
				if(trim($model->numero_registro) != ""){
					$criteriaRegistro = new CDbCriteria;
					$criteriaRegistro->compare('numero_registro',$model->numero_registro);
					$criteriaRegistro->with = array('entidad');
						
					$registro = Registros::model()->find($criteriaRegistro);
					if($registro){
						$model->registros 		= $registro;
						$model->registros_id 	= $registro->id;
						$model->entidad_id		= $registro->entidad->id;
						
					}else {
						$model->registros_id 	= 0;
						$model->entidad_id		= 0;
					}
				}else {
					$model->entidad_id = 0;
				}
				
				if(isset($_POST['Pqrs']['entidad']) && $model->entidad_id == 0){
					
					$model->entidad_id = $_POST['Pqrs']['entidad'];
					$model->registros_id 	= 0;
					
				}else if($model->entidad_id == 0 && Yii::app()->user->getId() !== null && $userRole != "admin"){
					$usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
						
					$criteriaEntidad = new CDbCriteria;
					$criteriaEntidad->compare('usuario_id',$usuario->id);
						
					$entidad = Entidad::model()->find($criteriaEntidad);
					$model->entidad_id 		= $entidad->id;
					$model->registros_id 	= 0;
				}
				
				if($model->save()){
					
					if(isset($_POST['Pqrs']['nombreArchivo']) && $_POST['Pqrs']['nombreArchivo'] != ''){
						$pathDir = 'rnc_files'.DIRECTORY_SEPARATOR."pqrs".DIRECTORY_SEPARATOR.$model->id;
						if(!file_exists($pathDir)){
							mkdir($pathDir);
						}
							
						$dataFiles_ar = explode(",", $_POST['Pqrs']['nombreArchivo']);
						foreach ($dataFiles_ar as $value){
							$dataFiles = explode("/", $value);
							if(file_exists("tmp".DIRECTORY_SEPARATOR.$dataFiles[0])){
								if(rename("tmp".DIRECTORY_SEPARATOR.$dataFiles[0], $pathDir.DIRECTORY_SEPARATOR.$dataFiles[0])){
									
									$archivoModel = new Archivos_Pqrs();
									$archivoModel->nombre	= $dataFiles[0];
									$archivoModel->ruta		= $pathDir;
									$archivoModel->pqrs_id	= $model->id;
									$archivoModel->visitas_id = 0;
									$archivoModel->save();
								}
							}
						}
							
					}
					$model->save();
					$success_saving_all = true;
				}
				
				
				$transaction->commit();
				
			}catch (Exception $e) {
				$transaction->rollback();
				print_r($e->getMessage());
				Yii::log("Ocurrió un error al enviar solicitud" . $e->getMessage(), 'error');
				$success_saving_all = false;
				Yii::app()->end();
			}
			
			if($success_saving_all){
				
				$emailAdmin			= Usuario::model()->obtenerMailAdmin();
				$mails = array(0 => $model->email,1 => 'ksoacha@humboldt.org.co');
				
				$message 			= new YiiMailMessage;
				$message->view 		= "enviarContacto";
				//$data 			= "Mensaje prueba";
				$params				= array('data' => $model);
				$message->subject	= 'Sistema RNC - Envío de Solicitud';
				$message->from		= 'hescobar@humboldt.org';
				$message->setBody($params,'text/html');
				$message->setTo($mails);
				Yii::app()->mail->send($message);
				
				if(Yii::app()->user->getId() !== null){
					$this->redirect(array('view','id'=>$model->id));
				}else{
					$mensaje = new Mensaje();
					$mensaje->setTitulo("Envío Exitoso");
					$mensaje->setMensaje("La solicitud fué enviada con éxito, en los próximos días el administrador verificará la información y dará respuesta a la misma.");
					
					$this->render('mensaje',array(
							'model'=>$mensaje,
					));
				}
					
				Yii::app()->end();
			}
		}
		
		$this->render('create',array(
				'model'=>$model,
		));
			
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		if(Yii::app()->user->getId() !== null)
		{
			$model=new Pqrs();
			$model->unsetAttributes();  // clear any default values
			
			$userRole = Yii::app()->user->getState("roles");
			if($userRole == "entidad"){
				$usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
					
				$criteriaEntidad = new CDbCriteria;
				$criteriaEntidad->compare('usuario_id',$usuario->id);
					
				$entidad = Entidad::model()->find($criteriaEntidad);
			
				$model->entidad = $entidad;
				$model->entidad_id = $entidad->id;
			}
			
			if(isset($_GET['Pqrs']))
				$model->attributes=$_GET['Pqrs'];
	
			$this->render('index',array(
					'model'=>$model,
			));
		}else {
			$this->redirect(array("admin/login"));
		}
	}
	
	public function actionBusqueda(){
		if(Yii::app()->user->getId() !== null)
		{
			$model = new Pqrs('search');
			$model->unsetAttributes();
			
			$userRole = Yii::app()->user->getState("roles");
			if($userRole == "entidad"){
				$usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
					
				$criteriaEntidad = new CDbCriteria;
				$criteriaEntidad->compare('usuario_id',$usuario->id);
					
				$entidad = Entidad::model()->find($criteriaEntidad);
					
				$model->entidad = $entidad;
				$model->entidad_id = $entidad->id;
			}
			
			if(isset($_REQUEST['Pqrs'])){
				$model->attributes = $_GET['Pqrs'];
				$arr = $_GET;
				$this->renderPartial('_pqrs_table', array('listPqrs'=>$model->search(),'model' => $model));
			}
		}
	}
	
	public function actionDeleteFileAjax(){
		if(Yii::app()->user->getId() !== null)
		{
			if(isset($_POST['id'])){
	
				$modelArchivo = Archivos_Pqrs::model()->findByPk($_POST['id']);
				if(unlink($modelArchivo->ruta.DIRECTORY_SEPARATOR.$modelArchivo->nombre)){
					if($modelArchivo->delete()){
						echo 1;
					}else{
						echo 0;
					}
				}else {
					echo 0;
				}
			}else if(isset($_POST['name'])){
				if(unlink("tmp".DIRECTORY_SEPARATOR.$_POST['name'])){
					echo 1;
				}else {
					echo 0;
				}
			}
		}
	}
}
?>