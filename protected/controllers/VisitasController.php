<?php
class VisitasController extends Controller{
	
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
			$model = $this->loadModel($id);
			
			if(isset($model->registros->id)){
				$criteria = new CDbCriteria;
				$criteria->compare('registros_id',$model->registros->id);
				$criteria->compare('estado',2);
				$modelRegistros_update = Registros_Update::model()->find($criteria);
				$model->registros->registros_update = $modelRegistros_update;
			}
			$this->render('view',array(
					'model'=>$model,
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
				$model = new Visitas;
				$model->dilegenciadores = new Dilegenciadores();
				$model->registros		= new Registros();
				
				if(isset($_POST['Visitas']) && isset($_POST['Registros']))
				{
					$model->attributes=$_POST['Visitas'];
					$model->fecha_visita = Yii::app()->Date->toMysql($model->fecha_visita);
					
					$success_saving_all = true;
					
					$transaction = Yii::app()->db->beginTransaction();
					
					try{
						if($_POST['Registros']['numero_registro'] != '' && $_POST['Registros']['numero_registro'] != 0){
							
							$criteria = new CDbCriteria;
							$criteria->compare("numero_registro", $_POST['Registros']['numero_registro']);
							$registros = Registros::model()->find($criteria);
							
							if($registros){
								$model->registros = $registros;
								$model->registros_id = $registros->id;
							}
						
						}else{
							$model->registros_id = 0;
						}
						
						if(isset($_POST['Dilegenciadores']))
						{
							$model->dilegenciadores->attributes = $_POST['Dilegenciadores'];
							$model->dilegenciadores->telefono 	= 0;
							$model->dilegenciadores->email		= "n@n.n";
							$model->dilegenciadores->save();
							
							$model->dilegenciadores_id = $model->dilegenciadores->id;
						}
						
						if(!$model->save()){
							$success_saving_all = false;
						}else {
							if(isset($_POST['Visitas']['nombreArchivo']) && $_POST['Visitas']['nombreArchivo'] != ''){
								$pathDir = 'rnc_files'.DIRECTORY_SEPARATOR."visitas".DIRECTORY_SEPARATOR.$model->id;
								if(!file_exists($pathDir)){
									mkdir($pathDir);
								}
									
								$dataFiles_ar = explode(",", $_POST['Visitas']['nombreArchivo']);
								foreach ($dataFiles_ar as $value){
									$dataFiles = explode("/", $value);
									if(file_exists("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0])){
										if(rename("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0], $pathDir.DIRECTORY_SEPARATOR.$dataFiles[0])){
												
											$archivoModel = new Archivos_Pqrs();
											$archivoModel->nombre	= $dataFiles[0];
											$archivoModel->ruta		= $pathDir;
											$archivoModel->visitas_id	= $model->id;
											$archivoModel->pqrs_id		= 0;
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
						Yii::log("Ocurrió un error al enviar la solicitud: " . $e->getMessage(), 'error');
						$success_saving_all = false;
						Yii::app()->end();
					}
					
					if($success_saving_all){
					
						$this->redirect(array('view','id'=>$model->id));
							
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
	 * Lists all models.
	 */
	public function actionIndex()
	{
		if(Yii::app()->user->getId() !== null)
		{
			$model=new Visitas();
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
		$criteria=new CDbCriteria;
		
		$criteria->with = array('registros','dilegenciadores','county');
		
		$model=Visitas::model()->findByPk($id,$criteria);
		if(!isset($model->registros)){
			$model->registros = Registros::model();
		}
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
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
			
			if(isset($_POST['Visitas']) && isset($_POST['Registros']))
			{
				$model->attributes = $_POST['Visitas'];
				$model->fecha_visita = Yii::app()->Date->toMysql($model->fecha_visita);
					
				$success_saving_all = true;
					
				$transaction = Yii::app()->db->beginTransaction();
					
				try{
					if($_POST['Registros']['numero_registro'] != ''){
							
						$criteria = new CDbCriteria;
						$criteria->compare("numero_registro", $_POST['Registros']['numero_registro']);
						$registros = Registros::model()->find($criteria);
							
						if($registros){
							$model->registros = $registros;
							$model->registros_id = $registros->id;
						}
			
					}
			
					if(isset($_POST['Dilegenciadores']))
					{
						$model->dilegenciadores->attributes = $_POST['Dilegenciadores'];
						$model->dilegenciadores->save();
							
						$model->dilegenciadores_id = $model->dilegenciadores->id;
					}
			
					if(!$model->save()){
						$success_saving_all = false;
					}else {
							if(isset($_POST['Visitas']['nombreArchivo']) && $_POST['Visitas']['nombreArchivo'] != ''){
								$pathDir = 'rnc_files'.DIRECTORY_SEPARATOR."visitas".DIRECTORY_SEPARATOR.$model->id;
								if(!file_exists($pathDir)){
									mkdir($pathDir);
								}
									
								$dataFiles_ar = explode(",", $_POST['Visitas']['nombreArchivo']);
								foreach ($dataFiles_ar as $value){
									$dataFiles = explode("/", $value);
									if(file_exists("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0])){
										if(rename("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0], $pathDir.DIRECTORY_SEPARATOR.$dataFiles[0])){
												
											$archivoModel = new Archivos_Pqrs();
											$archivoModel->nombre	= $dataFiles[0];
											$archivoModel->ruta		= $pathDir;
											$archivoModel->visitas_id	= $model->id;
											$archivoModel->pqrs_id		= 0;
												
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
					Yii::log("Ocurrió un error al enviar la solicitud: " . $e->getMessage(), 'error');
					$success_saving_all = false;
					Yii::app()->end();
				}
					
				if($success_saving_all){
						
					$this->redirect(array('view','id'=>$model->id));
						
					Yii::app()->end();
				}
			}
			
			$this->render('update',array(
					'model'=>$model,
			));
			
		}else {
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
			foreach ($model->archivos as $value){
				$value->delete();
			}
			$model->delete();
			$dilegenciadores->delete();
	
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}else{
			$this->redirect(array("admin/login"));
		}
	}
	
	public function actionBusqueda(){
		if(Yii::app()->user->getId() !== null)
		{
			$model = new Visitas('search');
			$model->unsetAttributes();
			
			if(isset($_REQUEST['Visitas'])){
				$model->attributes = $_GET['Visitas'];
				$arr = $_GET;
			}
			
			$this->renderPartial('_visitas_table', array('listVisitas'=>$model->search(),'model' => $model));
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
				if(unlink("temp_rnc".DIRECTORY_SEPARATOR.$_POST['name'])){
					echo 1;
				}else {
					echo 0;
				}
			}
		}
	}
}
?>