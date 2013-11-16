<?php
class EntidadController extends Controller{
	
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
			$model=new Entidad;
			$model->dilegenciadores = new Dilegenciadores('search');
			$model->dilegenciadores->unsetAttributes();
			
			if(isset($_POST['Entidad']))
			{
				$model->attributes=$_POST['Entidad'];
				$model->validate();
				
				$success_saving_all = true;
				
				$transaction = Yii::app()->db->beginTransaction();
				
				try {
					
					if(isset($_POST['Dilegenciadores']))
					{
						$model->dilegenciadores->attributes = $_POST['Dilegenciadores'];
						$model->dilegenciadores->validate();
						$model->dilegenciadores->save(false);
					}
					
									
					$model->dilegenciadores_id	= $model->dilegenciadores->id;
					//$model->dilegenciadores 	= $dilegenciadores;
					$model->estado				= 1;
					$model->fecha_creacion		= Yii::app()->Date->now();
					$model->save(false);
					
					$transaction->commit();
					
				} catch (Exception $e) {
					$transaction->rollback();
					print_r($e->getMessage());
					Yii::log("Ocurrió un error al enviar solicitud de usuario y contraseña: " . $e->getMessage(), 'error');
					$success_saving_all = false;
					Yii::app()->end();
				}
				
				if($success_saving_all){
					$mensaje = new Mensaje();
					$mensaje->setTitulo("Envío Exitoso");
					$mensaje->setMensaje("La solicitud fué enviada con éxito, en los próximos días el administrador verificará y hará la respectiva aprobación para el envío de su usuario y contraseña.");
					
					$this->redirect(array('view','id'=>$model->id));
					
					Yii::app()->end();
					
				}else {
					$this->render('create',array(
							'model'=>$model,
					));
					Yii::app()->end();
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
	
			if(isset($_POST['Entidad']))
			{
				$model->attributes=$_POST['Entidad'];
				$model->validate();
				
				$success_saving_all = true;
				
				$transaction = Yii::app()->db->beginTransaction();
				
				try {
						
					if(isset($_POST['Dilegenciadores']))
					{
						$model->dilegenciadores->attributes = $_POST['Dilegenciadores'];
						$model->dilegenciadores->validate();
						$model->dilegenciadores->save(false);
					}
						
						
					$model->dilegenciadores_id	= $model->dilegenciadores->id;
					//$model->dilegenciadores 	= $dilegenciadores;
					$model->estado				= 1;
					$model->fecha_creacion		= Yii::app()->Date->now();
					$model->save(false);
						
					$transaction->commit();
						
				} catch (Exception $e) {
					$transaction->rollback();
					print_r($e->getMessage());
					Yii::log("Ocurrió un error al enviar solicitud de usuario y contraseña: " . $e->getMessage(), 'error');
					$success_saving_all = false;
					Yii::app()->end();
				}
				
				if($success_saving_all){
					$mensaje = new Mensaje();
					$mensaje->setTitulo("Envío Exitoso");
					$mensaje->setMensaje("La solicitud fué enviada con éxito, en los próximos días el administrador verificará y hará la respectiva aprobación para el envío de su usuario y contraseña.");
						
					$this->redirect(array('view','id'=>$model->id));
						
					Yii::app()->end();
						
				}else {
					$this->render('create',array(
							'model'=>$model,
					));
					Yii::app()->end();
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
			$model = $this->loadModel($id);
			$dilegenciadores = $model->dilegenciadores; 
			$model->delete();
			$dilegenciadores->delete();
	
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
			$model=new Entidad('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['Entidad']))
				$model->attributes=$_GET['Entidad'];
	
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
		$model=Entidad::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='entidad-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionSolicitud(){
		
		$model=new Entidad;
		$model->dilegenciadores = new Dilegenciadores('search');
		$model->dilegenciadores->unsetAttributes();
		
		if(isset($_POST['Entidad']))
		{
			$model->attributes=$_POST['Entidad'];
			$model->validate();
			
			$success_saving_all = true;
			
			$transaction = Yii::app()->db->beginTransaction();
			
			try {
				
				if(isset($_POST['Dilegenciadores']))
				{
					$model->dilegenciadores->attributes = $_POST['Dilegenciadores'];
					$model->dilegenciadores->validate();
					$model->dilegenciadores->save(false);
				}
				
								
				$model->dilegenciadores_id	= $model->dilegenciadores->id;
				//$model->dilegenciadores 	= $dilegenciadores;
				$model->estado				= 1;
				$model->fecha_creacion		= Yii::app()->Date->now();
				$model->save(false);
				
				$transaction->commit();
				
			} catch (Exception $e) {
				$transaction->rollback();
				print_r($e->getMessage());
				Yii::log("Ocurrió un error al enviar solicitud de usuario y contraseña: " . $e->getMessage(), 'error');
				$success_saving_all = false;
				Yii::app()->end();
			}
			
			if($success_saving_all){
				$mensaje = new Mensaje();
				$mensaje->setTitulo("Envío Exitoso");
				$mensaje->setMensaje("La solicitud fué enviada con éxito, en los próximos días el administrador verificará y hará la respectiva aprobación para el envío de su usuario y contraseña.");
				
				$this->render('mensaje',array(
						'model'=>$mensaje,
				));
				
				Yii::app()->end();
				
			}else {
				$this->redirect(array('entidad/solicitud'));
			}
		}
				
		$this->render('createSolicitud',array(
				'model'=>$model,
		));
	}
	
	public function actionBusqueda(){
		
		$model = new Entidad();
		
		if(isset($_REQUEST['Entidad'])){
			
			$model->tipo_titular 		= $_REQUEST['Entidad']['tipo_titular_s'];
			$model->titular 			= $_REQUEST['Entidad']['titular_s'];
			$model->tipo_nit			= $_REQUEST['Entidad']['tipo_nit_s'];
			$model->nit					= $_REQUEST['Entidad']['nit_s'];
			$model->tipo_id_rep			= isset($_REQUEST['Entidad']['tipo_id_rep_s']) ? $_REQUEST['Entidad']['tipo_id_rep_s'] : '';
			$model->representante_id	= isset($_REQUEST['Entidad']['representante_id_s']) ? $_REQUEST['Entidad']['representante_id_s'] : '';
			$model->representante_legal	= isset($_REQUEST['Entidad']['representante_legal_s']) ? $_REQUEST['Entidad']['representante_legal_s'] : '';
			$model->ciudad_id			= $_REQUEST['Entidad']['ciudad_id_s'];
			$model->estado				= $_REQUEST['Entidad']['estado_s'];
			$model->usuario_id			= $_REQUEST['Entidad']['usuario_id_s'];
			
			$listEntidades = $model->search();
			
			$this->renderPartial('_entidades_table', array('listEntidades' => $listEntidades));
			Yii::app()->end();
		}
	}
	
	public function actionValidar($id){
		
		if(Yii::app()->user->getId() !== null)
		{
			$model=$this->loadModel($id);
			
			if(isset($_REQUEST['Entidad']['aprobado']))
			{
				$model->estado = ($_REQUEST['Entidad']['aprobado'] == 0) ? 2 : (($_REQUEST['Entidad']['aprobado'] == 1) ? 3 : 1);
				$model->comentario = $_REQUEST['Entidad']['comentario'];
				$model->usuario_id = $_REQUEST['Entidad']['usuario_id'];
				
				$success_saving_all = true;
				
				$transaction = Yii::app()->db->beginTransaction();
				
				try {
				
					$model->save(false);
				
					$transaction->commit();
				
				} catch (Exception $e) {
					$transaction->rollback();
					print_r($e->getMessage());
					Yii::log("Ocurrió un error al enviar solicitud  " . $e->getMessage(), 'error');
					$success_saving_all = false;
					Yii::app()->end();
				}
				
				if($success_saving_all){
								
					$this->redirect(array('index'));
				
					Yii::app()->end();
				
				}else {
					$this->render('create',array(
							'model'=>$model,
					));
					Yii::app()->end();
				}
				
			}
			$this->render('validar',array(
					'model'=>$model,
			));
			
		}else{
			$this->redirect(array("admin/login"));
		}
	}
	
}
?>