<?php
class RegistrosController extends Controller{
	
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
						'roles'=>array('admin,entidad'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update'),
						'users'=>array('@'),
						'roles'=>array('admin,entidad'),
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
			$registroUpdate = new Registros_Update();
			$this->render('view',array(
					'model'=>$this->loadModel($id),
					'registroUpdate' => $registroUpdate
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
			$model=new Registros();
			$model->unsetAttributes();  // clear any default values
			$userRole = Yii::app()->user->getState("roles");
			if($userRole == "entidad"){
				$usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
					
				$criteriaEntidad = new CDbCriteria;
				$criteriaEntidad->compare('usuario_id',$usuario->id);
					
				$entidad = Entidad::model()->find($criteriaEntidad);
				
				$model->entidad = $entidad;
				$model->Entidad_id = $entidad->id;
			}
			
			if(isset($_GET['Registros']))
				$model->attributes=$_GET['Registros'];
	
			$this->render('index',array(
					'model'=>$model,
			));
		}else {
			$this->redirect(array("admin/login"));
		}
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndexActualizar()
	{
		if(Yii::app()->user->getId() !== null)
		{
			$usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
			$entidad = new Entidad();
			$registro = new Registros();
			
			$criteriaEntidad = new CDbCriteria;
			$criteriaEntidad->compare('usuario_id',$usuario->id);
				
			$entidad = Entidad::model()->find($criteriaEntidad);
		
			$registro->entidad = $entidad;
			$registro->Entidad_id = $entidad->id;
			
			$this->render('indexActualizar',array(
					'registro' => $registro
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
		
		$criteria->with = array('entidad');

		//$criteria->addCondition('registros_update. IN ('.$sql.')');
		
		$model=Registros::model()->findByPk($id,$criteria);
		//$model->registros_update->tamano_coleccion		= Tamano_Coleccion::model();
		//$model->registros_update->composicion_general 	= Composicion_General::model();
		//$model->registros_update->tipos_en_coleccion	= Tipos_En_Coleccion::model();
		
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		if(Yii::app()->user->getId() !== null)
		{
			$model = new Registros;
			$model->fecha_dil = Yii::app()->Date->now();
						
			$usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
			
			$criteriaEntidad = new CDbCriteria;
			$criteriaEntidad->compare('usuario_id',$usuario->id);
			
			$entidad = Entidad::model()->find($criteriaEntidad);
			
			$model->Entidad_id 	= $entidad->id;
			$model->entidad		= $entidad;
			
			$model->registros_update 						= new Registros_Update();
			$model->registros_update->contactos 			= new Contactos();
			$model->registros_update->dilegenciadores 		= new Dilegenciadores();
			$model->registros_update->tamano_coleccion 		= new Tamano_Coleccion();
			$model->registros_update->tipos_en_coleccion 	= new Tipos_En_Coleccion();
			$model->registros_update->composicion_general	= new Composicion_General();
			
			$tamano_coleccion 		= Tamano_Coleccion::model();
			$tipos_en_coleccion		= Tipos_En_Coleccion::model();
			$composicion_general 	= Composicion_General::model();
			
			if(isset($_POST['Registros_Update'])){
				//print_r($_POST);
				//Yii::app()->end();
				$model->numero_registro = $_POST['Registros']['numero_registro'];
				$model->registros_update->estado			= $_POST['Registros_Update']['estado'];
				
				$success_saving_all = false;
				
				$transaction = Yii::app()->db->beginTransaction();
				
				try{
					
					$model->registros_update->attributes 			= $_POST['Registros_Update'];
					$model->registros_update->contactos_id 			= 0;
					$model->registros_update->dilegenciadores_id 	= 0;
					$model->registros_update->fecha_act				= Yii::app()->Date->now();
					$model->registros_update->registros_id			= 0;
					$model->registros_update->registros				= $model;
					
					if(isset($_POST['Contactos'])){
						$model->registros_update->contactos->attributes = $_POST['Contactos'];
						
						$model->registros_update->contactos->validate();
						$model->registros_update->contactos->save();
						$model->registros_update->contactos_id = $model->registros_update->contactos->id;
					}
					
					if(isset($_POST['Dilegenciadores'])){
						$model->registros_update->dilegenciadores->attributes = $_POST['Dilegenciadores'];
						
						$model->registros_update->dilegenciadores->validate();
						$model->registros_update->dilegenciadores->save();
						$model->registros_update->dilegenciadores_id = $model->registros_update->dilegenciadores->id;
					}
					
																
					if($model->registros_update->validate() && $model->registros_update->dilegenciadores->validate() && $model->registros_update->contactos->validate()){
						
						$model->save();
						
						$model->registros_update->registros_id	= $model->id;
						
						if(!$model->registros_update->save()){
							$success_saving_all = false;
						}else{
							$success_saving_all = true;
						}
						
						if(isset($_POST['Tamano_Coleccion'])){
							foreach ($_POST['Tamano_Coleccion'] as $valor_col){
								$model->registros_update->tamano_coleccion	= new Tamano_Coleccion();
								
								$model->registros_update->tamano_coleccion->tipo_preservacion 	= $valor_col['tipo_preservacion'];
								$model->registros_update->tamano_coleccion->unidad_medida		= $valor_col['unidad_medida'];
								//$model->registros_update->tamano_coleccion->cantidad			= $valor_col['cantidad'];
								$model->registros_update->tamano_coleccion->Registros_update_id = $model->registros_update->id;
									
								$model->registros_update->tamano_coleccion->save();
							}
						}
						
						if(isset($_POST['Tipos_En_Coleccion'])){
							foreach ($_POST['Tipos_En_Coleccion'] as $valor_tipo){
								$model->registros_update->tipos_en_coleccion	= new Tipos_En_Coleccion();
									
								$model->registros_update->tipos_en_coleccion->grupo					= $valor_tipo['grupo'];
								$model->registros_update->tipos_en_coleccion->informacion_ejemplar	= $valor_tipo['informacion_ejemplar'];
								$model->registros_update->tipos_en_coleccion->nombre_cientifico		= $valor_tipo['nombre_cientifico'];
								//$model->registros_update->tipos_en_coleccion->cantidad				= $valor_tipo['cantidad'];
								$model->registros_update->tipos_en_coleccion->Registros_update_id	= $model->registros_update->id;
									
								$model->registros_update->tipos_en_coleccion->save();
							}
						}
						
						if(isset($_POST['Composicion_General'])){
							foreach ($_POST['Composicion_General'] as $valor_comp){
								$model->registros_update->composicion_general	= new Composicion_General();
									
								$model->registros_update->composicion_general->grupo_taxonomico			= $valor_comp['grupo_taxonomico'];
								$model->registros_update->composicion_general->numero_ejemplares		= $valor_comp['numero_ejemplares'];
								$model->registros_update->composicion_general->numero_catalogados		= $valor_comp['numero_catalogados'];
								$model->registros_update->composicion_general->numero_sistematizados	= $valor_comp['numero_sistematizados'];
								$model->registros_update->composicion_general->numero_nivel_orden		= $valor_comp['numero_nivel_orden'];
								$model->registros_update->composicion_general->numero_nivel_familia		= $valor_comp['numero_nivel_familia'];
								$model->registros_update->composicion_general->numero_nivel_genero		= $valor_comp['numero_nivel_genero'];
								$model->registros_update->composicion_general->numero_nivel_especie		= $valor_comp['numero_nivel_especie'];
								$model->registros_update->composicion_general->Registros_update_id		= $model->registros_update->id;
									
								$model->registros_update->composicion_general->save();
							}
						}
						
						if(isset($_POST['Registros_Update']['archivosAnexos']) && $_POST['Registros_Update']['archivosAnexos'] != ''){
							$pathDir = 'rnc_files'.DIRECTORY_SEPARATOR.$model->registros_update->acronimo."_".$model->registros_update->id;
							if(!file_exists($pathDir)){
								mkdir($pathDir);
							}
							$pathFile = "archivosAnexos";
							if(!file_exists($pathDir.DIRECTORY_SEPARATOR.$pathFile)){
								mkdir($pathDir.DIRECTORY_SEPARATOR.$pathFile);
							}
							
							$dataFiles_ar = explode(",", $_POST['Registros_Update']['archivosAnexos']);
							foreach ($dataFiles_ar as $value){
								$dataFiles = explode("/", $value);
								if(file_exists("tmp".DIRECTORY_SEPARATOR.$dataFiles[0])){
									if(rename("tmp".DIRECTORY_SEPARATOR.$dataFiles[0], $pathDir.DIRECTORY_SEPARATOR.$pathFile.DIRECTORY_SEPARATOR.$dataFiles[0])){

										$archivoModel = new Archivos();
										$archivoModel->nombre 				= $dataFiles[0];
										$archivoModel->tipo					= $dataFiles[1];
										$archivoModel->size					= $dataFiles[2];
										$archivoModel->ruta					= $pathDir.DIRECTORY_SEPARATOR.$pathFile;
										$archivoModel->clase				= 1;
										$archivoModel->Registros_update_id 	= $model->registros_update->id;
										
										$archivoModel->save();
									}
								}
							}
							
						}
						
						if(isset($_POST['Registros_Update']['archivosColecciones'])  && $_POST['Registros_Update']['archivosColecciones'] != ''){
							$pathDir = 'rnc_files'.DIRECTORY_SEPARATOR.$model->registros_update->acronimo."_".$model->registros_update->id;
							if(!file_exists($pathDir)){
								mkdir($pathDir);
							}
							
							$pathFile = "archivosColecciones";
							if(!file_exists($pathDir.DIRECTORY_SEPARATOR.$pathFile)){
								mkdir($pathDir.DIRECTORY_SEPARATOR.$pathFile);
							}
							
							$dataFiles_ar = explode(",", $_POST['Registros_Update']['archivosColecciones']);
							foreach ($dataFiles_ar as $value){
								$dataFiles = explode("/", $value);
								if(file_exists("tmp".DIRECTORY_SEPARATOR.$dataFiles[0])){	
									if(rename("tmp".DIRECTORY_SEPARATOR.$dataFiles[0], $pathDir.DIRECTORY_SEPARATOR.$pathFile.DIRECTORY_SEPARATOR.$dataFiles[0])){
								
										$archivoModel = new Archivos();
										$archivoModel->nombre 				= $dataFiles[0];
										$archivoModel->tipo					= $dataFiles[1];
										$archivoModel->size					= $dataFiles[2];
										$archivoModel->ruta					= $pathDir.DIRECTORY_SEPARATOR.$pathFile;
										$archivoModel->clase				= 2;
										$archivoModel->Registros_update_id 	= $model->registros_update->id;
								
										$archivoModel->save();
									}
								}
							}
						}
						
					}
					
					
					$transaction->commit();
					
				}catch (Exception $e) {
					$transaction->rollback();
					print_r($e->getMessage());
					Yii::log("Ocurrió un error al enviar la informacion de registro: " . $e->getMessage(), 'error');
					$success_saving_all = false;
					Yii::app()->end();
				}
				
				if($success_saving_all){
					$mensaje = new Mensaje();
					$mensaje->setTitulo("Envío Exitoso");
					$mensaje->setMensaje("La solicitud fué enviada con éxito, en los próximos días el administrador verificará y hará la respectiva aprobación para el envío de su usuario y contraseña.");
					
					if($model->estado == 1){
						$this->redirect(array('view','id'=>$model->id));
						/*
						$this->render('mensaje',array(
								'model'=>$mensaje,
								'registro' => $model
						));
						Yii::app()->end();*/
					}else{
						$this->redirect(array('view','id'=>$model->id));
						/*$this->render('index',array(
								'model'=>$model
						));
						Yii::app()->end();*/
						//$this->redirect(array('view','id'=>$model->id));
					}
					
				}
			}
			
			$this->render('create',array(
					'model'=>$model,
					'composicion_general' => $composicion_general,
					'tamano_coleccion' => $tamano_coleccion,
					'tipos_en_coleccion' => $tipos_en_coleccion
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
	public function actionUpdateDetail($id)
	{
		if(Yii::app()->user->getId() !== null)
		{
			
			$criteria = new CDbCriteria;
			//$criteria->compare("estado", 0);
			$criteria->with = array('county','composicion_general','tamano_coleccion','tipos_en_coleccion','contactos','dilegenciadores','county','archivos');
			$registros_update = Registros_Update::model()->findByPk($id,$criteria);

			$model=$this->loadModel($registros_update->registros->id);
			$model->registros_update = $registros_update;
			
			$tamano_coleccion 		= Tamano_Coleccion::model();
			$tipos_en_coleccion		= Tipos_En_Coleccion::model();
			$composicion_general 	= Composicion_General::model();
			
			
			$success_saving_all = false;
			
			if(isset($_POST['Registros_Update'])){
				$success_saving_all = false;
				$model->fecha_dil = Yii::app()->Date->now();
				$model->registros_update->estado	= $_POST['Registros_Update']['estado'];
				
				$transaction = Yii::app()->db->beginTransaction();
				
				try{
					if($model->save()){
						$success_saving_all = true;
					}
											
					$model->registros_update->attributes 			= $_POST['Registros_Update'];
					$model->registros_update->contactos_id 			= 0;
					$model->registros_update->dilegenciadores_id 	= 0;
					$model->registros_update->fecha_act				= Yii::app()->Date->now();
			
			
					if(isset($_POST['Contactos'])){
						$model->registros_update->contactos->attributes = $_POST['Contactos'];
							
						$model->registros_update->contactos->validate();
						$model->registros_update->contactos->save();
						$model->registros_update->contactos_id = $model->registros_update->contactos->id;
					}
			
					if(isset($_POST['Dilegenciadores'])){
						$model->registros_update->dilegenciadores->attributes = $_POST['Dilegenciadores'];
							
						$model->registros_update->dilegenciadores->validate();
						$model->registros_update->dilegenciadores->save();
						$model->registros_update->dilegenciadores_id = $model->registros_update->dilegenciadores->id;
					}
			
			
					$model->registros_update->validate();
					if(!$model->registros_update->save()){
							$success_saving_all = false;
						}
									
					if($model->registros_update->validate()){
							
						if(isset($_POST['Tamano_Coleccion'])){
							
							foreach ($_POST['Tamano_Coleccion'] as $valor_col){
								
								if(isset($valor_col['id'])){
									$dataTamano	= Tamano_Coleccion::model()->findByPk($valor_col['id']);
									$model->registros_update->tamano_coleccion = $dataTamano;
									$model->registros_update->tamano_coleccion->tipo_preservacion 	= $valor_col['tipo_preservacion'];
									$model->registros_update->tamano_coleccion->unidad_medida		= $valor_col['unidad_medida'];
									$model->registros_update->tamano_coleccion->cantidad			= $valor_col['cantidad'];
									
									$model->registros_update->tamano_coleccion->save();
								}else{
									$model->registros_update->tamano_coleccion	= new Tamano_Coleccion();
									
									$model->registros_update->tamano_coleccion->tipo_preservacion 	= $valor_col['tipo_preservacion'];
									$model->registros_update->tamano_coleccion->unidad_medida		= $valor_col['unidad_medida'];
									$model->registros_update->tamano_coleccion->cantidad			= $valor_col['cantidad'];
									$model->registros_update->tamano_coleccion->Registros_update_id = $model->registros_update->id;
									
									$model->registros_update->tamano_coleccion->save();
								}
							}
						}
							
						if(isset($_POST['Tipos_En_Coleccion'])){
							foreach ($_POST['Tipos_En_Coleccion'] as $valor_tipo){
								
								if(isset($valor_tipo['id'])){
									$dataTamano	= Tipos_En_Coleccion::model()->findByPk($valor_tipo['id']);
									$model->registros_update->tipos_en_coleccion = $dataTamano;
									$model->registros_update->tipos_en_coleccion->informacion_ejemplar	= $valor_tipo['informacion_ejemplar'];
									$model->registros_update->tipos_en_coleccion->cantidad				= $valor_tipo['cantidad'];
								
									$model->registros_update->tipos_en_coleccion->save();
								}else{
									$model->registros_update->tipos_en_coleccion	= new Tipos_En_Coleccion();
									
									$model->registros_update->tipos_en_coleccion->informacion_ejemplar	= $valor_tipo['informacion_ejemplar'];
									$model->registros_update->tipos_en_coleccion->cantidad				= $valor_tipo['cantidad'];
									$model->registros_update->tipos_en_coleccion->Registros_update_id	= $model->registros_update->id;
									
									$model->registros_update->tipos_en_coleccion->save();
								}
							}
						}
							
						if(isset($_POST['Composicion_General'])){
							foreach ($_POST['Composicion_General'] as $valor_comp){
								
								if(isset($valor_comp['id'])){
									$dataTamano	= Composicion_General::model()->findByPk($valor_tipo['id']);
									$model->registros_update->composicion_general = $dataTamano;
									$model->registros_update->composicion_general->grupo_taxonomico			= $valor_comp['grupo_taxonomico'];
									$model->registros_update->composicion_general->numero_ejemplares		= $valor_comp['numero_ejemplares'];
									$model->registros_update->composicion_general->numero_catalogados		= $valor_comp['numero_catalogados'];
									$model->registros_update->composicion_general->numero_sistematizados	= $valor_comp['numero_sistematizados'];
									$model->registros_update->composicion_general->numero_nivel_familia		= $valor_comp['numero_nivel_familia'];
									$model->registros_update->composicion_general->numero_nivel_genero		= $valor_comp['numero_nivel_genero'];
									$model->registros_update->composicion_general->numero_nivel_especie		= $valor_comp['numero_nivel_especie'];
										
									$model->registros_update->composicion_general->save();
								}else{
									$model->registros_update->composicion_general	= new Composicion_General();
									
									$model->registros_update->composicion_general->grupo_taxonomico			= $valor_comp['grupo_taxonomico'];
									$model->registros_update->composicion_general->numero_ejemplares		= $valor_comp['numero_ejemplares'];
									$model->registros_update->composicion_general->numero_catalogados		= $valor_comp['numero_catalogados'];
									$model->registros_update->composicion_general->numero_sistematizados	= $valor_comp['numero_sistematizados'];
									$model->registros_update->composicion_general->numero_nivel_familia		= $valor_comp['numero_nivel_familia'];
									$model->registros_update->composicion_general->numero_nivel_genero		= $valor_comp['numero_nivel_genero'];
									$model->registros_update->composicion_general->numero_nivel_especie		= $valor_comp['numero_nivel_especie'];
									$model->registros_update->composicion_general->Registros_update_id		= $model->registros_update->id;
									
									$model->registros_update->composicion_general->save();
								}
								
							}
						}
							
						if(isset($_POST['Registros_Update']['archivosAnexos'])  && $_POST['Registros_Update']['archivosAnexos'] != ''){
							$pathDir = 'rnc_files'.DIRECTORY_SEPARATOR.$model->registros_update->acronimo."_".$model->registros_update->id;
							if(!file_exists($pathDir)){
								mkdir($pathDir);
							}
							$pathFile = "archivosAnexos";
							if(!file_exists($pathDir.DIRECTORY_SEPARATOR.$pathFile)){
								mkdir($pathDir.DIRECTORY_SEPARATOR.$pathFile);
							}
			
							$dataFiles_ar = explode(",", $_POST['Registros_Update']['archivosAnexos']);
							foreach ($dataFiles_ar as $value){
								$dataFiles = explode("/", $value);
								if(file_exists("tmp".DIRECTORY_SEPARATOR.$dataFiles[0])){
									if(rename("tmp".DIRECTORY_SEPARATOR.$dataFiles[0], $pathDir.DIRECTORY_SEPARATOR.$pathFile.DIRECTORY_SEPARATOR.$dataFiles[0])){
			
										$archivoModel = new Archivos();
										$archivoModel->nombre 				= $dataFiles[0];
										$archivoModel->tipo					= $dataFiles[1];
										$archivoModel->size					= $dataFiles[2];
										$archivoModel->ruta					= $pathDir.DIRECTORY_SEPARATOR.$pathFile;
										$archivoModel->clase				= 1;
										$archivoModel->Registros_update_id 	= $model->registros_update->id;
											
										$archivoModel->save();
									}
								}
							}
			
						}
							
						if(isset($_POST['Registros_Update']['archivosColecciones'])  && $_POST['Registros_Update']['archivosColecciones'] != ''){
							$pathDir = 'rnc_files'.DIRECTORY_SEPARATOR.$model->registros_update->acronimo."_".$model->registros_update->id;
							if(!file_exists($pathDir)){
								mkdir($pathDir);
							}
			
							$pathFile = "archivosColecciones";
							if(!file_exists($pathDir.DIRECTORY_SEPARATOR.$pathFile)){
								mkdir($pathDir.DIRECTORY_SEPARATOR.$pathFile);
							}
			
							$dataFiles_ar = explode(",", $_POST['Registros_Update']['archivosColecciones']);
							foreach ($dataFiles_ar as $value){
								$dataFiles = explode("/", $value);
								if(file_exists("tmp".DIRECTORY_SEPARATOR.$dataFiles[0])){
									if(rename("tmp".DIRECTORY_SEPARATOR.$dataFiles[0], $pathDir.DIRECTORY_SEPARATOR.$pathFile.DIRECTORY_SEPARATOR.$dataFiles[0])){
											
										$archivoModel = new Archivos();
										$archivoModel->nombre 				= $dataFiles[0];
										$archivoModel->tipo					= $dataFiles[1];
										$archivoModel->size					= $dataFiles[2];
										$archivoModel->ruta					= $pathDir.DIRECTORY_SEPARATOR.$pathFile;
										$archivoModel->clase				= 2;
										$archivoModel->Registros_update_id 	= $model->registros_update->id;
											
										$archivoModel->save();
									}
								}
							}
						}
							
					}
			
				
						
					$transaction->commit();
						
				}catch (Exception $e) {
					$transaction->rollback();
					print_r($e->getMessage());
					Yii::log("Ocurrió un error al enviar la informacion de registro: " . $e->getMessage(), 'error');
					$success_saving_all = false;
					Yii::app()->end();
				}
			}
			
			if($success_saving_all){
				$mensaje = new Mensaje();
				$mensaje->setTitulo("Envío Exitoso");
				$mensaje->setMensaje("La solicitud fué enviada con éxito, en los próximos días el administrador verificará y hará la respectiva aprobación para el envío de su usuario y contraseña.");
					
				if($model->registros_update->estado == 1){
					/*$this->render('mensaje',array(
							'model'=>$mensaje,
							'registro' => $model
					));
					Yii::app()->end();*/
					$this->redirect(array('view','id'=>$model->id));
				}else{
					/*
					$this->render('index',array(
							'model'=>$model
					));
					Yii::app()->end();*/
					$this->redirect(array('view','id'=>$model->id));
				}
					
			}
			
			$this->render('update',array(
					'model'=>$model,
					'composicion_general' => $composicion_general,
					'tamano_coleccion' => $tamano_coleccion,
					'tipos_en_coleccion' => $tipos_en_coleccion
			));
			
		}else{
			$this->redirect(array("admin/login"));
		}
	}
	
	public function actionValidar($id){
		if(Yii::app()->user->getId() !== null)
		{
			$criteria = new CDbCriteria;
			//$criteria->compare("estado", 0);
			$criteria->with = array('county','composicion_general','tamano_coleccion','tipos_en_coleccion','contactos','dilegenciadores','county','archivos');
			$registros_update = Registros_Update::model()->findByPk($id,$criteria);
			
			$model=$this->loadModel($registros_update->registros->id);
			$model->registros_update = $registros_update;
				
			$tamano_coleccion 		= Tamano_Coleccion::model();
			$tipos_en_coleccion		= Tipos_En_Coleccion::model();
			$composicion_general 	= Composicion_General::model();
			
			if(isset($_POST['Registros']) && isset($_POST['Registros_Update'])){
				
				$transaction = Yii::app()->db->beginTransaction();
				$success_saving_all = false;
				
				try{
					
					$criteria2 = new CDbCriteria;
					$criteria2->compare("estado", 2);
					$criteria2->compare("registros_id",$model->id);
					$registros_update_ant = Registros_Update::model()->find($criteria2);
					
					$model->numero_registro	= $_POST['Registros']['numero_registro'];
					$model->registros_update->comentario = $_POST['Registros_Update']['comentario'];
					
					if($_POST['Registros_Update']['aprobado'] == 0){
						if(isset($registros_update_ant->id)){
							$registros_update_ant->estado = 4;
							$registros_update_ant->save();
						}
						$model->registros_update->estado = 2;
						$model->estado = 1;
						$model->fecha_dil = Yii::app()->Date->now();
						$model->fecha_prox = Yii::app()->Date->toMysql(Yii::app()->Date->timestamp() + 63072000);
					}else {
						$model->registros_update->estado = 3;
					}
					
					$model->registros_update->fecha_rev = Yii::app()->Date->now();
					
					if(!$model->registros_update->save()){
						$success_saving_all = false;
					}else{
						$model->save();
						$success_saving_all = true;
					}
					
					$transaction->commit();
					
				}catch (Exception $e) {
					$transaction->rollback();
					print_r($e->getMessage());
					Yii::log("Ocurrió un error al enviar la informacion de registro: " . $e->getMessage(), 'error');
					$success_saving_all = false;
					Yii::app()->end();
				}
				
				if($success_saving_all){
					$mensaje = new Mensaje();
					$mensaje->setTitulo("Envío Exitoso");
					$mensaje->setMensaje("La solicitud fué enviada con éxito, en los próximos días el administrador verificará y hará la respectiva aprobación para el envío de su usuario y contraseña.");
						
					/*$this->render('mensaje',array(
							'model'=>$mensaje,
							'registro' => $model
					));
					Yii::app()->end();*/
					$this->redirect(array('view','id'=>$model->id));
				
				}
			}

			
			$this->render('validar',array(
					'model'=>$model,
					'composicion_general' => $composicion_general,
					'tamano_coleccion' => $tamano_coleccion,
					'tipos_en_coleccion' => $tipos_en_coleccion
			));
			
		}else{
			$this->redirect(array("admin/login"));
		}
	}
	
	public function actionActualizar($id){
		if(Yii::app()->user->getId() !== null)
		{
			$criteria = new CDbCriteria;
			$criteria->compare("estado", 2);
			$criteria->compare("Registros_id", $id);
			$criteria->with = array('county','composicion_general','tamano_coleccion','tipos_en_coleccion','contactos','dilegenciadores','county','archivos');
			$registros_update = Registros_Update::model()->find($criteria);
			
			$model=$this->loadModel($id);
			$model->registros_update = $registros_update;
			//$model->registros_update->estado = 0;
			$tamano_coleccion 		= Tamano_Coleccion::model();
			$tipos_en_coleccion		= Tipos_En_Coleccion::model();
			$composicion_general 	= Composicion_General::model();
			
			if(isset($_POST['Registros_Update'])){
				$modelRegistroUpdate = new Registros_Update();
				$modelRegistroUpdate->contactos 			= new Contactos();
				$modelRegistroUpdate->dilegenciadores 		= new Dilegenciadores();
				$modelRegistroUpdate->tamano_coleccion 		= new Tamano_Coleccion();
				$modelRegistroUpdate->tipos_en_coleccion 	= new Tipos_En_Coleccion();
				$modelRegistroUpdate->composicion_general	= new Composicion_General();
				
				$modelRegistroUpdate->estado	= $_POST['Registros_Update']['estado'];
				
				$success_saving_all = false;
				
				$transaction = Yii::app()->db->beginTransaction();
				
				try{
						
					$modelRegistroUpdate->attributes 			= $_POST['Registros_Update'];
					$modelRegistroUpdate->contactos_id 			= 0;
					$modelRegistroUpdate->dilegenciadores_id 	= 0;
					$modelRegistroUpdate->fecha_act				= Yii::app()->Date->now();
					$modelRegistroUpdate->registros_id			= $id;
					$modelRegistroUpdate->registros				= $model;
						
					if(isset($_POST['Contactos'])){
						$modelRegistroUpdate->contactos->attributes = $_POST['Contactos'];
				
						$modelRegistroUpdate->contactos->validate();
						$modelRegistroUpdate->contactos->save();
						$modelRegistroUpdate->contactos_id = $modelRegistroUpdate->contactos->id;
					}
						
					if(isset($_POST['Dilegenciadores'])){
						$modelRegistroUpdate->dilegenciadores->attributes = $_POST['Dilegenciadores'];
				
						$modelRegistroUpdate->dilegenciadores->validate();
						$modelRegistroUpdate->dilegenciadores->save();
						$modelRegistroUpdate->dilegenciadores_id = $modelRegistroUpdate->dilegenciadores->id;
					}
						
					if(!$modelRegistroUpdate->save()){
						$success_saving_all = false;
					}else{
						$success_saving_all = true;
					}
						
					if($success_saving_all){
				
						if(isset($_POST['Tamano_Coleccion'])){
							foreach ($_POST['Tamano_Coleccion'] as $valor_col){
								$modelRegistroUpdate->tamano_coleccion	= new Tamano_Coleccion();
				
								$modelRegistroUpdate->tamano_coleccion->tipo_preservacion 	= $valor_col['tipo_preservacion'];
								$modelRegistroUpdate->tamano_coleccion->unidad_medida		= $valor_col['unidad_medida'];
								$modelRegistroUpdate->tamano_coleccion->cantidad			= $valor_col['cantidad'];
								$modelRegistroUpdate->tamano_coleccion->Registros_update_id = $modelRegistroUpdate->id;
									
								$modelRegistroUpdate->tamano_coleccion->save();
							}
						}
				
						if(isset($_POST['Tipos_En_Coleccion'])){
							foreach ($_POST['Tipos_En_Coleccion'] as $valor_tipo){
								$modelRegistroUpdate->tipos_en_coleccion	= new Tipos_En_Coleccion();
									
								$modelRegistroUpdate->tipos_en_coleccion->informacion_ejemplar	= $valor_tipo['informacion_ejemplar'];
								$modelRegistroUpdate->tipos_en_coleccion->cantidad				= $valor_tipo['cantidad'];
								$modelRegistroUpdate->tipos_en_coleccion->Registros_update_id	= $modelRegistroUpdate->id;
									
								$modelRegistroUpdate->tipos_en_coleccion->save();
							}
						}
				
						if(isset($_POST['Composicion_General'])){
							foreach ($_POST['Composicion_General'] as $valor_comp){
								$modelRegistroUpdate->composicion_general	= new Composicion_General();
									
								$modelRegistroUpdate->composicion_general->grupo_taxonomico			= $valor_comp['grupo_taxonomico'];
								$modelRegistroUpdate->composicion_general->numero_ejemplares		= $valor_comp['numero_ejemplares'];
								$modelRegistroUpdate->composicion_general->numero_catalogados		= $valor_comp['numero_catalogados'];
								$modelRegistroUpdate->composicion_general->numero_sistematizados	= $valor_comp['numero_sistematizados'];
								$modelRegistroUpdate->composicion_general->numero_nivel_familia		= $valor_comp['numero_nivel_familia'];
								$modelRegistroUpdate->composicion_general->numero_nivel_genero		= $valor_comp['numero_nivel_genero'];
								$modelRegistroUpdate->composicion_general->numero_nivel_especie		= $valor_comp['numero_nivel_especie'];
								$modelRegistroUpdate->composicion_general->Registros_update_id		= $modelRegistroUpdate->id;
									
								$modelRegistroUpdate->composicion_general->save();
							}
						}
				
						if(isset($_POST['Registros_Update']['archivosAnexos']) && $_POST['Registros_Update']['archivosAnexos'] != ''){
							$pathDir = 'rnc_files'.DIRECTORY_SEPARATOR.$modelRegistroUpdate->acronimo."_".$modelRegistroUpdate->id;
							if(!file_exists($pathDir)){
								mkdir($pathDir);
							}
							$pathFile = "archivosAnexos";
							if(!file_exists($pathDir.DIRECTORY_SEPARATOR.$pathFile)){
								mkdir($pathDir.DIRECTORY_SEPARATOR.$pathFile);
							}
								
							$dataFiles_ar = explode(",", $_POST['Registros_Update']['archivosAnexos']);
							foreach ($dataFiles_ar as $value){
								$dataFiles = explode("/", $value);
								if(file_exists("tmp".DIRECTORY_SEPARATOR.$dataFiles[0])){
									if(rename("tmp".DIRECTORY_SEPARATOR.$dataFiles[0], $pathDir.DIRECTORY_SEPARATOR.$pathFile.DIRECTORY_SEPARATOR.$dataFiles[0])){
				
										$archivoModel = new Archivos();
										$archivoModel->nombre 				= $dataFiles[0];
										$archivoModel->tipo					= $dataFiles[1];
										$archivoModel->size					= $dataFiles[2];
										$archivoModel->ruta					= $pathDir.DIRECTORY_SEPARATOR.$pathFile;
										$archivoModel->clase				= 1;
										$archivoModel->Registros_update_id 	= $modelRegistroUpdate->id;
				
										$archivoModel->save();
									}
								}
							}
								
						}
				
						if(isset($_POST['Registros_Update']['archivosColecciones'])  && $_POST['Registros_Update']['archivosColecciones'] != ''){
							$pathDir = 'rnc_files'.DIRECTORY_SEPARATOR.$modelRegistroUpdate->acronimo."_".$modelRegistroUpdate->id;
							if(!file_exists($pathDir)){
								mkdir($pathDir);
							}
								
							$pathFile = "archivosColecciones";
							if(!file_exists($pathDir.DIRECTORY_SEPARATOR.$pathFile)){
								mkdir($pathDir.DIRECTORY_SEPARATOR.$pathFile);
							}
								
							$dataFiles_ar = explode(",", $_POST['Registros_Update']['archivosColecciones']);
							foreach ($dataFiles_ar as $value){
								$dataFiles = explode("/", $value);
								if(file_exists("tmp".DIRECTORY_SEPARATOR.$dataFiles[0])){
									if(rename("tmp".DIRECTORY_SEPARATOR.$dataFiles[0], $pathDir.DIRECTORY_SEPARATOR.$pathFile.DIRECTORY_SEPARATOR.$dataFiles[0])){
				
										$archivoModel = new Archivos();
										$archivoModel->nombre 				= $dataFiles[0];
										$archivoModel->tipo					= $dataFiles[1];
										$archivoModel->size					= $dataFiles[2];
										$archivoModel->ruta					= $pathDir.DIRECTORY_SEPARATOR.$pathFile;
										$archivoModel->clase				= 2;
										$archivoModel->Registros_update_id 	= $modelRegistroUpdate->id;
				
										$archivoModel->save();
									}
								}
							}
						}
				
					}
						
						
					$transaction->commit();
						
				}catch (Exception $e) {
					$transaction->rollback();
					print_r($e->getMessage());
					Yii::log("Ocurrió un error al enviar la informacion de registro: " . $e->getMessage(), 'error');
					$success_saving_all = false;
					Yii::app()->end();
				}
				
				if($success_saving_all){
					$mensaje = new Mensaje();
					$mensaje->setTitulo("Envío Exitoso");
					$mensaje->setMensaje("La solicitud fué enviada con éxito, en los próximos días el administrador verificará y hará la respectiva aprobación para el envío de su usuario y contraseña.");
						
					if($model->estado == 1){
						/*$this->render('mensaje',array(
								'model'=>$mensaje,
								'registro' => $model
						));
						Yii::app()->end();*/
						$this->redirect(array('view','id'=>$model->id));
					}else{
						/*$this->render('index',array(
								'model'=>$model
						));
						Yii::app()->end();*/
						$this->redirect(array('view','id'=>$model->id));
					}
						
				}
			}
			$this->render('actualizar',array(
					'model'=>$model,
					'composicion_general' => $composicion_general,
					'tamano_coleccion' => $tamano_coleccion,
					'tipos_en_coleccion' => $tipos_en_coleccion
			));
		}else{
			$this->redirect(array("admin/login"));
		}
	}
	
	public function actionViewDetail($id){
		
		if(Yii::app()->user->getId() !== null)
		{
			$criteria = new CDbCriteria;
			$criteria->with = array('registros','county','composicion_general','tamano_coleccion','tipos_en_coleccion','contactos','dilegenciadores','county','archivos');
			$modelRegistros_update = Registros_Update::model()->findByPk($id,$criteria);
			
			$this->render('viewDetail',array(
					'model'=>$modelRegistros_update,
			));
			
		}else{
			$this->redirect(array("admin/login"));
		}
	}
	
	public function actionDeleteDetail($id){
		if(Yii::app()->user->getId() !== null)
		{
			$criteria = new CDbCriteria;
			$criteria->with = array('registros','county','composicion_general','tamano_coleccion','tipos_en_coleccion','contactos','dilegenciadores','county','archivos');
			$modelRegistros_update = Registros_Update::model()->findByPk($id,$criteria);
			$modelRegistros_update->dilegenciadores->delete();
			$modelRegistros_update->contactos->delete();
			foreach ($modelRegistros_update->composicion_general as $value){
				$value->delete();
			}
			foreach ($modelRegistros_update->tamano_coleccion as $value){
				$value->delete();
			}
			foreach ($modelRegistros_update->tipos_en_coleccion as $value){
				$value->delete();
			}
			foreach ($modelRegistros_update->archivos as $value){
				$value->delete();
			}
				
			$modelRegistros_update->delete();
					
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}else{
			$this->redirect(array("admin/login"));
		}
	}
	
	public function actionDeleteFileAjax(){
		if(Yii::app()->user->getId() !== null)
		{
			if(isset($_POST['id'])){
				
				$modelArchivo = Archivos::model()->findByPk($_POST['id']);
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