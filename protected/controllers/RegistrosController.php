<?php
class RegistrosController extends Controller{
	
	public function actions()
	{
		return array(
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha'=>array(
						'class'=>'CCaptchaAction',
						'backColor'=>0xFFFFFF,
				),
	
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
			$registroUpdate = new Registros_update();
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
			$model->entidad = Entidad::model();
			$model->registros_update = Registros_update::model();
			
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
		if(Yii::app()->user->getId() !== null && Yii::app()->user->getState("roles") == "entidad")
		{
			$model = new Registros;
						
			$usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
			
			$criteriaEntidad = new CDbCriteria;
			$criteriaEntidad->compare('usuario_id',$usuario->id);
			
			$entidad = Entidad::model()->find($criteriaEntidad);
			
			$model->Entidad_id 	= $entidad->id;
			$model->entidad		= $entidad;
			
			$model->registros_update 						= new Registros_update();
			$model->registros_update->contactos 			= new Contactos();
			$model->registros_update->dilegenciadores 		= new Dilegenciadores();
			$model->registros_update->tamano_coleccion 		= new Tamano_Coleccion();
			$model->registros_update->tipos_en_coleccion 	= new Tipos_En_Coleccion();
			$model->registros_update->composicion_general	= new Composicion_General();
			
			$tamano_coleccion 		= Tamano_Coleccion::model();
			$tipos_en_coleccion		= Tipos_En_Coleccion::model();
			$composicion_general 	= Composicion_General::model();
			$urls_registros			= Urls_Registros::model();
			
			if(isset($_POST['Registros_update'])){
				//print_r($_POST);
				//Yii::app()->end();
				//$model->fecha_dil = $_POST['Registros']['fecha_dil'];
				$model->numero_registro = $_POST['Registros']['numero_registro'];
				$model->tipo_coleccion_id = $_POST['Registros']['tipo_coleccion_id'];
				$model->registros_update->estado	= $_POST['Registros_update']['estado'];
				
				$success_saving_all = false;
				$success_saving_all_1 = false;
				$success_saving_all_2 = false;
				$success_saving_all_3 = false;
				
				$transaction = Yii::app()->db->beginTransaction();
				
				try{
					
					if(isset($_POST['Entidad'])){
						$model->entidad->attributes = $_POST['Entidad'];
						if($model->entidad->colecciones == ""){
							$model->entidad->colecciones = "-";
						}			
						$model->entidad->save(false);
						
					}
					
					$model->registros_update->attributes 			= $_POST['Registros_update'];
					$model->registros_update->contactos_id 			= 0;
					$model->registros_update->dilegenciadores_id 	= 0;
					//$model->registros_update->fecha_act				= $_POST['Registros']['fecha_dil'];
					$model->registros_update->fecha_env				= Yii::app()->Date->now();
					$model->registros_update->registros_id			= 0;
					$model->registros_update->registros				= $model;
					$model->registros_update->ejemplar_tipo		 	= $_POST['Registros_update']['ejemplar_tipo'];
					
					if($model->registros_update->terminos == 0){
						$model->registros_update->terminos = '';
					}
					
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
								
								$model->registros_update->tamano_coleccion->tipo_preservacion_id 	= $valor_col['tipo_preservacion_id'];
								$model->registros_update->tamano_coleccion->unidad_medida			= $valor_col['unidad_medida'];
								//$model->registros_update->tamano_coleccion->cantidad			= $valor_col['cantidad'];
								$model->registros_update->tamano_coleccion->Registros_update_id = $model->registros_update->id;
								
								if($model->registros_update->tamano_coleccion->tipo_preservacion_id == 22){
									$model->registros_update->tamano_coleccion->otro = $valor_col['otro'];
								}
																
								if($model->registros_update->tamano_coleccion->save()){
									$success_saving_all_1 = true;									
								}
								
							}
						}
						
						if(isset($_POST['Tipos_En_Coleccion'])){
							foreach ($_POST['Tipos_En_Coleccion'] as $valor_tipo){
								$model->registros_update->tipos_en_coleccion	= new Tipos_En_Coleccion();
									
								$model->registros_update->tipos_en_coleccion->grupo					= $valor_tipo['grupo'];
								//$model->registros_update->tipos_en_coleccion->informacion_ejemplar	= $valor_tipo['informacion_ejemplar'];
								//$model->registros_update->tipos_en_coleccion->nombre_cientifico		= $valor_tipo['nombre_cientifico'];
								$model->registros_update->tipos_en_coleccion->cantidad				= $valor_tipo['cantidad'];
								$model->registros_update->tipos_en_coleccion->Registros_update_id	= $model->registros_update->id;
									
								if($model->registros_update->tipos_en_coleccion->save()){
									$success_saving_all_2 = true;
								}
							}
						}
						
						if(isset($_POST['Composicion_General'])){
							foreach ($_POST['Composicion_General'] as $valor_comp){
								$model->registros_update->composicion_general	= new Composicion_General();
									
								$model->registros_update->composicion_general->grupo_taxonomico_id 		= ($valor_comp['grupo_taxonomico_id'] != '') ? $valor_comp['grupo_taxonomico_id'] : 0;
								$model->registros_update->composicion_general->subgrupo_taxonomico_id	= ($valor_comp['subgrupo_taxonomico_id'] != '') ? $valor_comp['subgrupo_taxonomico_id'] : 0;
								$model->registros_update->composicion_general->numero_ejemplares		= $valor_comp['numero_ejemplares'];
								$model->registros_update->composicion_general->numero_catalogados		= $valor_comp['numero_catalogados'];
								$model->registros_update->composicion_general->numero_sistematizados	= $valor_comp['numero_sistematizados'];
								$model->registros_update->composicion_general->numero_nivel_filum		= $valor_comp['numero_nivel_filum'];
								$model->registros_update->composicion_general->numero_nivel_orden		= $valor_comp['numero_nivel_orden'];
								$model->registros_update->composicion_general->numero_nivel_familia		= $valor_comp['numero_nivel_familia'];
								$model->registros_update->composicion_general->numero_nivel_genero		= $valor_comp['numero_nivel_genero'];
								$model->registros_update->composicion_general->numero_nivel_especie		= $valor_comp['numero_nivel_especie'];
								$model->registros_update->composicion_general->Registros_update_id		= $model->registros_update->id;
								
								if($model->registros_update->composicion_general->subgrupo_taxonomico_id == 2){
									$model->registros_update->composicion_general->subgrupo_otro = $valor_comp['subgrupo_otro'];
								}
								if($model->registros_update->composicion_general->save()){
									$success_saving_all_3 = true;
								}
							}
						}
						
						if(isset($_POST['Registros_update']['archivosAnexos']) && $_POST['Registros_update']['archivosAnexos'] != ''){
							$pathDir = 'rnc_files'.DIRECTORY_SEPARATOR.'Registro_Colecciones_Biologicas'.DIRECTORY_SEPARATOR.$model->registros_update->id."_".$model->registros_update->acronimo;
							if(!file_exists($pathDir)){
								mkdir($pathDir);
							}
							$pathFile = "archivosAnexos";
							if(!file_exists($pathDir.DIRECTORY_SEPARATOR.$pathFile)){
								mkdir($pathDir.DIRECTORY_SEPARATOR.$pathFile);
							}
							
							$dataFiles_ar = explode(",", $_POST['Registros_update']['archivosAnexos']);
							foreach ($dataFiles_ar as $value){
								$dataFiles = explode("/", $value);
								if(file_exists("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0])){
									if(rename("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0], $pathDir.DIRECTORY_SEPARATOR.$pathFile.DIRECTORY_SEPARATOR.$dataFiles[0])){

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
						
						if(isset($_POST['Registros_update']['archivosColecciones'])  && $_POST['Registros_update']['archivosColecciones'] != ''){
							$pathDir = 'rnc_files'.DIRECTORY_SEPARATOR.'Registro_Colecciones_Biologicas'.DIRECTORY_SEPARATOR.$model->registros_update->id."_".$model->registros_update->acronimo;
							if(!file_exists($pathDir)){
								mkdir($pathDir);
							}
							
							$pathFile = "archivosColecciones";
							if(!file_exists($pathDir.DIRECTORY_SEPARATOR.$pathFile)){
								mkdir($pathDir.DIRECTORY_SEPARATOR.$pathFile);
							}
							
							$dataFiles_ar = explode(",", $_POST['Registros_update']['archivosColecciones']);
							foreach ($dataFiles_ar as $value){
								$dataFiles = explode("/", $value);
								if(file_exists("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0])){	
									if(rename("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0], $pathDir.DIRECTORY_SEPARATOR.$pathFile.DIRECTORY_SEPARATOR.$dataFiles[0])){
								
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
					
					if(!$success_saving_all_1 || !$success_saving_all_2 || !$success_saving_all_3){
						$success_saving_all = false;
					}else {
						$transaction->commit();
					}
					
					
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
					
					if($model->registros_update->estado == 1){
						
						$mails = array(0 => $model->entidad->email,1 => 'rnc@humboldt.org.co');
						//$mails = array(0 => 'rnc@humboldt.org.co');
						$message 			= new YiiMailMessage;
						$message->view 		= "crearRegistro";
						$params				= array('data' => $model);
						$message->subject	= 'Envío de Registro de Colección '.$model->registros_update->nombre.'- Sistema RNC';
						$message->from		= 'hescobar@humboldt.org';
						$message->setBody($params,'text/html');
						$message->setTo($mails);
						Yii::app()->mail->send($message);
						
						
						$this->redirect(array('view','id'=>$model->id,'status'=>'Ok'));
						
					}else{
						$this->redirect(array('view','id'=>$model->id,'status'=>'Ok'));
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
					'tipos_en_coleccion' => $tipos_en_coleccion,
					'urls_registros'	=> $urls_registros,
			));
		}else{
			$this->redirect(array("admin/panel"));
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
			$registros_update = Registros_update::model()->findByPk($id,$criteria);

			$model=$this->loadModel($registros_update->registros->id);
			$model->registros_update = $registros_update;
			
			$tamano_coleccion 		= Tamano_Coleccion::model();
			$tipos_en_coleccion		= Tipos_En_Coleccion::model();
			$composicion_general 	= Composicion_General::model();
			$urls_registros			= Urls_Registros::model();
			
			$success_saving_all = false;
			
			if(isset($_POST['Registros_update'])){
				$success_saving_all = false;
				//$model->fecha_dil = $_POST['Registros']['fecha_dil'];
				$model->registros_update->estado	= $_POST['Registros_update']['estado'];
				$model->numero_registro = $_POST['Registros']['numero_registro'];
				$model->tipo_coleccion_id = $_POST['Registros']['tipo_coleccion_id'];
				
				$transaction = Yii::app()->db->beginTransaction();
				
				try{
					
					if(isset($_POST['Entidad'])){
					
						$model->entidad->attributes = $_POST['Entidad'];
					
						if($model->entidad->colecciones == ""){
							$model->entidad->colecciones = "-";
						}
						$model->entidad->save(false);
						//print_r($model->registros_update->registros->entidad->attributes);
						//Yii::app()->end();
					}
					
					if($model->save()){
						$success_saving_all = true;
					}
					
					
											
					$model->registros_update->attributes 			= $_POST['Registros_update'];
					$model->registros_update->contactos_id 			= 0;
					$model->registros_update->dilegenciadores_id 	= 0;
					//$model->registros_update->fecha_act				= Yii::app()->Date->now();
					$model->registros_update->fecha_env				= Yii::app()->Date->now();
					$model->registros_update->ejemplar_tipo		 	= $_POST['Registros_update']['ejemplar_tipo'];
			
					if(isset($_POST['Contactos'])){
						$model->registros_update->contactos->attributes = $_POST['Contactos'];
							
						//$model->registros_update->contactos->validate();
						if($model->registros_update->contactos->save()){
							$success_saving_all = true;
							$model->registros_update->contactos_id = $model->registros_update->contactos->id;
						}else {
							$success_saving_all = false;
						}
						
					}
			
					if(isset($_POST['Dilegenciadores'])){
						$model->registros_update->dilegenciadores->attributes = $_POST['Dilegenciadores'];

						if($model->registros_update->dilegenciadores->save() && $success_saving_all){
							$success_saving_all = true;
							$model->registros_update->dilegenciadores_id = $model->registros_update->dilegenciadores->id;
						}else {
							$success_saving_all = false;
						}
						
						
					}
			
					if($success_saving_all){
						$model->registros_update->validate();
						if(!$model->registros_update->save()){
							$success_saving_all = false;
						}
					}
									
					if($model->registros_update->validate()){
							
						if(isset($_POST['Tamano_Coleccion'])){
							
							foreach ($_POST['Tamano_Coleccion'] as $valor_col){
								
								if(isset($valor_col['id'])){
									$dataTamano	= Tamano_Coleccion::model()->findByPk($valor_col['id']);
									$model->registros_update->tamano_coleccion = $dataTamano;
									$model->registros_update->tamano_coleccion->tipo_preservacion_id = $valor_col['tipo_preservacion_id'];
									$model->registros_update->tamano_coleccion->unidad_medida		 = $valor_col['unidad_medida'];
									
									if($model->registros_update->tamano_coleccion->tipo_preservacion_id == 22){
										$model->registros_update->tamano_coleccion->otro = $valor_col['otro'];
									}
									//$model->registros_update->tamano_coleccion->cantidad			= $valor_col['cantidad'];
									
									$model->registros_update->tamano_coleccion->save();
								}else{
									$model->registros_update->tamano_coleccion	= new Tamano_Coleccion();
									
									$model->registros_update->tamano_coleccion->tipo_preservacion_id 	= $valor_col['tipo_preservacion_id'];
									$model->registros_update->tamano_coleccion->unidad_medida			= $valor_col['unidad_medida'];
									//$model->registros_update->tamano_coleccion->cantidad			= $valor_col['cantidad'];
									$model->registros_update->tamano_coleccion->Registros_update_id = $model->registros_update->id;
									
									if($model->registros_update->tamano_coleccion->tipo_preservacion_id == 22){
										$model->registros_update->tamano_coleccion->otro = $valor_col['otro'];
									}
									
									$model->registros_update->tamano_coleccion->save();
								}
							}
						}
							
						if(isset($_POST['Tipos_En_Coleccion'])){
							foreach ($_POST['Tipos_En_Coleccion'] as $valor_tipo){
								
								if(isset($valor_tipo['id'])){
									$dataTamano	= Tipos_En_Coleccion::model()->findByPk($valor_tipo['id']);
									$model->registros_update->tipos_en_coleccion = $dataTamano;
									//$model->registros_update->tipos_en_coleccion->informacion_ejemplar	= $valor_tipo['informacion_ejemplar'];
									$model->registros_update->tipos_en_coleccion->grupo					= $valor_tipo['grupo'];
									$model->registros_update->tipos_en_coleccion->cantidad				= $valor_tipo['cantidad'];
								
									$model->registros_update->tipos_en_coleccion->save();
								}else{
									$model->registros_update->tipos_en_coleccion	= new Tipos_En_Coleccion();
									
									//$model->registros_update->tipos_en_coleccion->informacion_ejemplar	= $valor_tipo['informacion_ejemplar'];
									$model->registros_update->tipos_en_coleccion->grupo					= $valor_tipo['grupo'];
									$model->registros_update->tipos_en_coleccion->cantidad				= $valor_tipo['cantidad'];
									$model->registros_update->tipos_en_coleccion->Registros_update_id	= $model->registros_update->id;
									
									$model->registros_update->tipos_en_coleccion->save();
								}
							}
						}
							
						if(isset($_POST['Composicion_General'])){
							
							foreach ($_POST['Composicion_General'] as $valor_comp){
								
								if(isset($valor_comp['id'])){
									$dataTamano	= Composicion_General::model()->findByPk($valor_comp['id']);
									$model->registros_update->composicion_general = $dataTamano;
									$model->registros_update->composicion_general->grupo_taxonomico_id 		= ($valor_comp['grupo_taxonomico_id'] != '') ? $valor_comp['grupo_taxonomico_id'] : 0;
									$model->registros_update->composicion_general->subgrupo_taxonomico_id	= ($valor_comp['subgrupo_taxonomico_id'] != '') ? $valor_comp['subgrupo_taxonomico_id'] : 0;
									$model->registros_update->composicion_general->numero_ejemplares		= $valor_comp['numero_ejemplares'];
									$model->registros_update->composicion_general->numero_catalogados		= $valor_comp['numero_catalogados'];
									$model->registros_update->composicion_general->numero_sistematizados	= $valor_comp['numero_sistematizados'];
									$model->registros_update->composicion_general->numero_nivel_filum		= $valor_comp['numero_nivel_filum'];
									$model->registros_update->composicion_general->numero_nivel_orden		= $valor_comp['numero_nivel_orden'];
									$model->registros_update->composicion_general->numero_nivel_familia		= $valor_comp['numero_nivel_familia'];
									$model->registros_update->composicion_general->numero_nivel_genero		= $valor_comp['numero_nivel_genero'];
									$model->registros_update->composicion_general->numero_nivel_especie		= $valor_comp['numero_nivel_especie'];
									
									if($model->registros_update->composicion_general->subgrupo_taxonomico_id == 2){
										$model->registros_update->composicion_general->subgrupo_otro = $valor_comp['subgrupo_otro'];
									}
									$model->registros_update->composicion_general->save();
								}else{
									$model->registros_update->composicion_general	= new Composicion_General();
									
									$model->registros_update->composicion_general->grupo_taxonomico_id 		= ($valor_comp['grupo_taxonomico_id'] != '') ? $valor_comp['grupo_taxonomico_id'] : 0;
									$model->registros_update->composicion_general->subgrupo_taxonomico_id	= ($valor_comp['subgrupo_taxonomico_id'] != '') ? $valor_comp['subgrupo_taxonomico_id'] : 0;
									$model->registros_update->composicion_general->numero_ejemplares		= $valor_comp['numero_ejemplares'];
									$model->registros_update->composicion_general->numero_catalogados		= $valor_comp['numero_catalogados'];
									$model->registros_update->composicion_general->numero_sistematizados	= $valor_comp['numero_sistematizados'];
									$model->registros_update->composicion_general->numero_nivel_filum		= $valor_comp['numero_nivel_filum'];
									$model->registros_update->composicion_general->numero_nivel_orden		= $valor_comp['numero_nivel_orden'];
									$model->registros_update->composicion_general->numero_nivel_familia		= $valor_comp['numero_nivel_familia'];
									$model->registros_update->composicion_general->numero_nivel_genero		= $valor_comp['numero_nivel_genero'];
									$model->registros_update->composicion_general->numero_nivel_especie		= $valor_comp['numero_nivel_especie'];
									$model->registros_update->composicion_general->Registros_update_id		= $model->registros_update->id;
									
									if($model->registros_update->composicion_general->subgrupo_taxonomico_id == 2){
										$model->registros_update->composicion_general->subgrupo_otro = $valor_comp['subgrupo_otro'];
									}
									
									$model->registros_update->composicion_general->save();
								}
								
							}
						}
							
						if(isset($_POST['Registros_update']['archivosAnexos'])  && $_POST['Registros_update']['archivosAnexos'] != ''){
							$pathDir = 'rnc_files'.DIRECTORY_SEPARATOR.'Registro_Colecciones_Biologicas'.DIRECTORY_SEPARATOR.$model->registros_update->id."_".$model->registros_update->acronimo;
							if(!file_exists($pathDir)){
								mkdir($pathDir);
							}
							$pathFile = "archivosAnexos";
							if(!file_exists($pathDir.DIRECTORY_SEPARATOR.$pathFile)){
								mkdir($pathDir.DIRECTORY_SEPARATOR.$pathFile);
							}
			
							$dataFiles_ar = explode(",", $_POST['Registros_update']['archivosAnexos']);
							foreach ($dataFiles_ar as $value){
								$dataFiles = explode("/", $value);
								if(file_exists("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0])){
									if(rename("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0], $pathDir.DIRECTORY_SEPARATOR.$pathFile.DIRECTORY_SEPARATOR.$dataFiles[0])){
			
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
							
						if(isset($_POST['Registros_update']['archivosColecciones'])  && $_POST['Registros_update']['archivosColecciones'] != ''){
							$pathDir = 'rnc_files'.DIRECTORY_SEPARATOR.'Registro_Colecciones_Biologicas'.DIRECTORY_SEPARATOR.$model->registros_update->id."_".$model->registros_update->acronimo;
							if(!file_exists($pathDir)){
								mkdir($pathDir);
							}
			
							$pathFile = "archivosColecciones";
							if(!file_exists($pathDir.DIRECTORY_SEPARATOR.$pathFile)){
								mkdir($pathDir.DIRECTORY_SEPARATOR.$pathFile);
							}
			
							$dataFiles_ar = explode(",", $_POST['Registros_update']['archivosColecciones']);
							foreach ($dataFiles_ar as $value){
								$dataFiles = explode("/", $value);
								if(file_exists("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0])){
									if(rename("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0], $pathDir.DIRECTORY_SEPARATOR.$pathFile.DIRECTORY_SEPARATOR.$dataFiles[0])){
											
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
					
					$mails = array(0 => $model->entidad->email,1 => 'rnc@humboldt.org.co');
					//$mails = array(0 => 'rnc@humboldt.org.co');
					$message 			= new YiiMailMessage;
					$message->view 		= "crearRegistro";
					$params				= array('data' => $model);
					$message->subject	= 'Envío de Registro de Colección '.$model->registros_update->nombre.'- Sistema RNC';
					$message->from		= 'hescobar@humboldt.org';
					$message->setBody($params,'text/html');
					$message->setTo($mails);
					//Yii::app()->mail->send($message);
					
					$this->redirect(array('view','id'=>$model->id,'status'=>'Ok'));
				}else{
					/*
					$this->render('index',array(
							'model'=>$model
					));
					Yii::app()->end();*/
					$this->redirect(array('view','id'=>$model->id,'status'=>'Ok'));
				}
					
			}
			
			$this->render('update',array(
					'model'=>$model,
					'composicion_general' => $composicion_general,
					'tamano_coleccion' => $tamano_coleccion,
					'tipos_en_coleccion' => $tipos_en_coleccion,
					'urls_registros'	=> $urls_registros,
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
			$criteria->with = array('county','composicion_general','tamano_coleccion','tipos_en_coleccion','contactos','dilegenciadores','county','archivos','urls_registros');
			$registros_update = Registros_update::model()->findByPk($id,$criteria);
			
			$model=$this->loadModel($registros_update->registros->id);
			$model->registros_update = $registros_update;
				
			$tamano_coleccion 		= Tamano_Coleccion::model();
			$tipos_en_coleccion		= Tipos_En_Coleccion::model();
			$composicion_general 	= Composicion_General::model();
			$urls_registros			= Urls_Registros::model();
			
			if(isset($_POST['Registros']) && isset($_POST['Registros_update'])){
				
				$transaction = Yii::app()->db->beginTransaction();
				$success_saving_all = false;
				
				try{
					
					if(isset($_POST['Entidad'])){
							
						$model->entidad->attributes = $_POST['Entidad'];
							
						if($model->entidad->colecciones == ""){
							$model->entidad->colecciones = "-";
						}
						$model->entidad->save(false);
						//print_r($model->registros_update->registros->entidad->attributes);
						//Yii::app()->end();
					}
					
					$criteria2 = new CDbCriteria;
					$criteria2->compare("estado", 2);
					$criteria2->compare("registros_id",$model->id);
					$registros_update_ant = Registros_Update::model()->find($criteria2);
					
					$model->tipo_coleccion_id = $_POST['Registros']['tipo_coleccion_id'];
					$model->fecha_dil = $_POST['Registros']['fecha_dil'];
					$model->numero_registro	= $_POST['Registros']['numero_registro'];
										
					$model->registros_update->attributes 			= $_POST['Registros_update'];
					$model->registros_update->contactos_id 			= 0;
					$model->registros_update->dilegenciadores_id 	= 0;
					//$model->registros_update->fecha_act				= Yii::app()->Date->now();
					$model->registros_update->fecha_env				= Yii::app()->Date->now();
					$model->registros_update->ejemplar_tipo		 	= $_POST['Registros_update']['ejemplar_tipo'];
					$model->registros_update->fecha_act	 			= $_POST['Registros_update']['fecha_act'];
					$model->registros_update->comentario 			= $_POST['Registros_update']['comentario'];
					$model->registros_update->aprobado 				= $_POST['Registros_update']['aprobado'];
					
					$estReg = $model->estado;
					
					if($_POST['Registros_update']['estado'] == 2){
						if($_POST['Registros_update']['aprobado'] == 0){
							if(isset($registros_update_ant->id)){
								$registros_update_ant->estado = 4;
								$registros_update_ant->save();
							}
							$model->registros_update->estado = 2;
							$model->estado = 1;
							//$model->fecha_dil = Yii::app()->Date->now();
							$model->fecha_prox = Yii::app()->Date->toMysql(Yii::app()->Date->timestamp() + 63072000);
						}else {
							$model->registros_update->estado = 3;
						}
					}else {
						$model->registros_update->estado = 1;
					}
					
					$model->registros_update->fecha_rev = Yii::app()->Date->now();
					
					if(isset($_POST['Contactos'])){
						$model->registros_update->contactos->attributes = $_POST['Contactos'];
							
						//$model->registros_update->contactos->validate();
						if($model->registros_update->contactos->save()){
							$success_saving_all = true;
							$model->registros_update->contactos_id = $model->registros_update->contactos->id;
						}else {
							$success_saving_all = false;
						}
					
					}
						
					if(isset($_POST['Dilegenciadores'])){
						$model->registros_update->dilegenciadores->attributes = $_POST['Dilegenciadores'];
					
						if($model->registros_update->dilegenciadores->save() && $success_saving_all){
							$success_saving_all = true;
							$model->registros_update->dilegenciadores_id = $model->registros_update->dilegenciadores->id;
						}else {
							$success_saving_all = false;
						}
					
					
					}
					
					if(!$model->registros_update->save()){
						$success_saving_all = false;
					}else{
						$model->save();
						
						if(isset($_POST['Tamano_Coleccion'])){
								
							foreach ($_POST['Tamano_Coleccion'] as $valor_col){
						
								if(isset($valor_col['id'])){
									$dataTamano	= Tamano_Coleccion::model()->findByPk($valor_col['id']);
									$model->registros_update->tamano_coleccion = $dataTamano;
									$model->registros_update->tamano_coleccion->tipo_preservacion_id = $valor_col['tipo_preservacion_id'];
									$model->registros_update->tamano_coleccion->unidad_medida		 = $valor_col['unidad_medida'];
										
									if($model->registros_update->tamano_coleccion->tipo_preservacion_id == 22){
										$model->registros_update->tamano_coleccion->otro = $valor_col['otro'];
									}
									//$model->registros_update->tamano_coleccion->cantidad			= $valor_col['cantidad'];
										
									$model->registros_update->tamano_coleccion->save();
								}else{
									$model->registros_update->tamano_coleccion	= new Tamano_Coleccion();
										
									$model->registros_update->tamano_coleccion->tipo_preservacion_id 	= $valor_col['tipo_preservacion_id'];
									$model->registros_update->tamano_coleccion->unidad_medida			= $valor_col['unidad_medida'];
									//$model->registros_update->tamano_coleccion->cantidad			= $valor_col['cantidad'];
									$model->registros_update->tamano_coleccion->Registros_update_id = $model->registros_update->id;
										
									if($model->registros_update->tamano_coleccion->tipo_preservacion_id == 22){
										$model->registros_update->tamano_coleccion->otro = $valor_col['otro'];
									}
										
									$model->registros_update->tamano_coleccion->save();
								}
							}
						}
							
						if(isset($_POST['Tipos_En_Coleccion'])){
							foreach ($_POST['Tipos_En_Coleccion'] as $valor_tipo){
						
								if(isset($valor_tipo['id'])){
									$dataTamano	= Tipos_En_Coleccion::model()->findByPk($valor_tipo['id']);
									$model->registros_update->tipos_en_coleccion = $dataTamano;
									//$model->registros_update->tipos_en_coleccion->informacion_ejemplar	= $valor_tipo['informacion_ejemplar'];
									$model->registros_update->tipos_en_coleccion->grupo					= $valor_tipo['grupo'];
									$model->registros_update->tipos_en_coleccion->cantidad				= $valor_tipo['cantidad'];
						
									$model->registros_update->tipos_en_coleccion->save();
								}else{
									$model->registros_update->tipos_en_coleccion	= new Tipos_En_Coleccion();
										
									//$model->registros_update->tipos_en_coleccion->informacion_ejemplar	= $valor_tipo['informacion_ejemplar'];
									$model->registros_update->tipos_en_coleccion->grupo					= $valor_tipo['grupo'];
									$model->registros_update->tipos_en_coleccion->cantidad				= $valor_tipo['cantidad'];
									$model->registros_update->tipos_en_coleccion->Registros_update_id	= $model->registros_update->id;
										
									$model->registros_update->tipos_en_coleccion->save();
								}
							}
						}

						if(isset($_POST['Urls_Registros'])){
							foreach ($_POST['Urls_Registros'] as $url){
						
								if(isset($url['id'])){
									$dataUrl	= Urls_Registros::model()->findByPk($url['id']);
									$model->registros_update->urls_registros = $dataUrl;
									$model->registros_update->urls_registros->nombre			= $url['nombre'];
									$model->registros_update->urls_registros->url				= $url['url'];
									$model->registros_update->urls_registros->tipo				= $url['tipo'];
						
									$model->registros_update->urls_registros->save();
								}else{
									$model->registros_update->urls_registros	= new Urls_Registros();
										
									$model->registros_update->urls_registros->nombre			= $url['nombre'];
									$model->registros_update->urls_registros->url				= $url['url'];
									$model->registros_update->urls_registros->tipo				= $url['tipo'];
									$model->registros_update->urls_registros->registros_update_id	= $model->registros_update->id;
										
									$model->registros_update->urls_registros->save();
								}
							}
						}
							
						if(isset($_POST['Composicion_General'])){
								
							foreach ($_POST['Composicion_General'] as $valor_comp){
						
								if(isset($valor_comp['id'])){
									$dataTamano	= Composicion_General::model()->findByPk($valor_comp['id']);
									$model->registros_update->composicion_general = $dataTamano;
									$model->registros_update->composicion_general->grupo_taxonomico_id 		= ($valor_comp['grupo_taxonomico_id'] != '') ? $valor_comp['grupo_taxonomico_id'] : 0;
									$model->registros_update->composicion_general->subgrupo_taxonomico_id	= ($valor_comp['subgrupo_taxonomico_id'] != '') ? $valor_comp['subgrupo_taxonomico_id'] : 0;
									$model->registros_update->composicion_general->numero_ejemplares		= $valor_comp['numero_ejemplares'];
									$model->registros_update->composicion_general->numero_catalogados		= $valor_comp['numero_catalogados'];
									$model->registros_update->composicion_general->numero_sistematizados	= $valor_comp['numero_sistematizados'];
									$model->registros_update->composicion_general->numero_nivel_filum		= $valor_comp['numero_nivel_filum'];
									$model->registros_update->composicion_general->numero_nivel_orden		= $valor_comp['numero_nivel_orden'];
									$model->registros_update->composicion_general->numero_nivel_familia		= $valor_comp['numero_nivel_familia'];
									$model->registros_update->composicion_general->numero_nivel_genero		= $valor_comp['numero_nivel_genero'];
									$model->registros_update->composicion_general->numero_nivel_especie		= $valor_comp['numero_nivel_especie'];
										
									if($model->registros_update->composicion_general->subgrupo_taxonomico_id == 2){
										$model->registros_update->composicion_general->subgrupo_otro = $valor_comp['subgrupo_otro'];
									}
									$model->registros_update->composicion_general->save();
								}else{
									$model->registros_update->composicion_general	= new Composicion_General();
										
									$model->registros_update->composicion_general->grupo_taxonomico_id 		= ($valor_comp['grupo_taxonomico_id'] != '') ? $valor_comp['grupo_taxonomico_id'] : 0;
									$model->registros_update->composicion_general->subgrupo_taxonomico_id	= ($valor_comp['subgrupo_taxonomico_id'] != '') ? $valor_comp['subgrupo_taxonomico_id'] : 0;
									$model->registros_update->composicion_general->numero_ejemplares		= $valor_comp['numero_ejemplares'];
									$model->registros_update->composicion_general->numero_catalogados		= $valor_comp['numero_catalogados'];
									$model->registros_update->composicion_general->numero_sistematizados	= $valor_comp['numero_sistematizados'];
									$model->registros_update->composicion_general->numero_nivel_filum		= $valor_comp['numero_nivel_filum'];
									$model->registros_update->composicion_general->numero_nivel_orden		= $valor_comp['numero_nivel_orden'];
									$model->registros_update->composicion_general->numero_nivel_familia		= $valor_comp['numero_nivel_familia'];
									$model->registros_update->composicion_general->numero_nivel_genero		= $valor_comp['numero_nivel_genero'];
									$model->registros_update->composicion_general->numero_nivel_especie		= $valor_comp['numero_nivel_especie'];
									$model->registros_update->composicion_general->Registros_update_id		= $model->registros_update->id;
										
									if($model->registros_update->composicion_general->subgrupo_taxonomico_id == 2){
										$model->registros_update->composicion_general->subgrupo_otro = $valor_comp['subgrupo_otro'];
									}
										
									$model->registros_update->composicion_general->save();
								}
						
							}
						}
							
						if(isset($_POST['Registros_update']['archivosAnexos'])  && $_POST['Registros_update']['archivosAnexos'] != ''){
							$pathDir = 'rnc_files'.DIRECTORY_SEPARATOR.'Registro_Colecciones_Biologicas'.DIRECTORY_SEPARATOR.$model->registros_update->id."_".$model->registros_update->acronimo;
							if(!file_exists($pathDir)){
								mkdir($pathDir);
							}
							$pathFile = "archivosAnexos";
							if(!file_exists($pathDir.DIRECTORY_SEPARATOR.$pathFile)){
								mkdir($pathDir.DIRECTORY_SEPARATOR.$pathFile);
							}
								
							$dataFiles_ar = explode(",", $_POST['Registros_update']['archivosAnexos']);
							foreach ($dataFiles_ar as $value){
								$dataFiles = explode("/", $value);
								if(file_exists("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0])){
									if(rename("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0], $pathDir.DIRECTORY_SEPARATOR.$pathFile.DIRECTORY_SEPARATOR.$dataFiles[0])){
											
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
							
						if(isset($_POST['Registros_update']['archivosColecciones'])  && $_POST['Registros_update']['archivosColecciones'] != ''){
							$pathDir = 'rnc_files'.DIRECTORY_SEPARATOR.'Registro_Colecciones_Biologicas'.DIRECTORY_SEPARATOR.$model->registros_update->id."_".$model->registros_update->acronimo;
							if(!file_exists($pathDir)){
								mkdir($pathDir);
							}
								
							$pathFile = "archivosColecciones";
							if(!file_exists($pathDir.DIRECTORY_SEPARATOR.$pathFile)){
								mkdir($pathDir.DIRECTORY_SEPARATOR.$pathFile);
							}
								
							$dataFiles_ar = explode(",", $_POST['Registros_update']['archivosColecciones']);
							foreach ($dataFiles_ar as $value){
								$dataFiles = explode("/", $value);
								if(file_exists("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0])){
									if(rename("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0], $pathDir.DIRECTORY_SEPARATOR.$pathFile.DIRECTORY_SEPARATOR.$dataFiles[0])){
											
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
						
						if($estReg == 0){
							if(isset($_POST['Registros_update']['archivoCertificados']) && $_POST['Registros_update']['archivoCertificados'] != ""){
								$pathDir = 'rnc_files'.DIRECTORY_SEPARATOR.'Certificados'.DIRECTORY_SEPARATOR.$model->registros_update->acronimo;
								//$pathDir = 'Certificados'.DIRECTORY_SEPARATOR.$model->registros_update->acronimo;
								if(!file_exists($pathDir)){
									mkdir($pathDir);
								}
								$archivos = array();
								$dataFiles_cer = explode(",", $_POST['Registros_update']['archivoCertificados']);
								foreach ($dataFiles_cer as $value){
									$dataFiles = explode("/", $value);
										
									if(file_exists("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0])){
										if(rename("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0], $pathDir.DIRECTORY_SEPARATOR.$dataFiles[0])){
							
											$archivoModel = new Archivos();
											$archivoModel->nombre 				= $dataFiles[0];
											$archivoModel->tipo					= $dataFiles[1];
											$archivoModel->size					= $dataFiles[2];
											$archivoModel->ruta					= $pathDir;
											$archivoModel->clase				= 3;
											$archivoModel->Registros_update_id 	= $model->registros_update->id;
							
											$archivoModel->save();
											$archivos[] = $archivoModel;
												
											$modelCertificado = new Certificados();
											$modelCertificado->nombre 	= $dataFiles[0];
											$modelCertificado->fecha 	= Yii::app()->Date->now();
											$modelCertificado->tipo_certificado = 0;
												
											$modelCertificado->registros_update_id = $model->registros_update->id;
											$modelCertificado->save();
										}
									}
								}
							}
						}else{
							if($model->registros_update->estado == 2){
								$modelCer = $this->actionGenerarCertificado($model->registros_update->id);
							}
						}
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
					
					if($model->registros_update->estado != 1){
						if($_POST['Registros_update']['notificar'] == 1){
							$mails = array(0 => $model->registros_update->contactos->email,1 => 'rnc@humboldt.org.co',2=>$model->registros_update->dilegenciadores->email);
						}else {
							$mails = array(0 => 'rnc@humboldt.org.co');
						}
						
						$message 			= new YiiMailMessage;
						$message->view 		= "aprobarRegistro";
						$params				= array('data' => $model);
						$message->subject	= 'Aprobación de Registro de Colección '.$model->numero_registro.'- Sistema RNC';
						$message->from		= 'hescobar@humboldt.org';
						$message->setBody($params,'text/html');
						$message->setTo($mails);
						
						if($estReg == 0){
							if(isset($archivos) && count($archivos) > 0){
								foreach ($archivos as $archivo){
									$message->attach(Swift_Attachment::fromPath($archivo->ruta.DIRECTORY_SEPARATOR.$archivo->nombre,'multipart/mixed')->setFilename($archivo->nombre));
								}
							}
						}else{
							
							if(isset($modelCer)){
								$message->attach(Swift_Attachment::fromPath($modelCer->ruta.DIRECTORY_SEPARATOR.$modelCer->nombre,'multipart/mixed')->setFilename($modelCer->nombre));
							}
						}
						
						Yii::app()->mail->send($message);
					}
					
					/*$this->render('mensaje',array(
							'model'=>$mensaje,
							'registro' => $model
					));
					Yii::app()->end();*/
					$this->redirect(array('view','id'=>$model->id,'status'=>'Ok'));
				
				}
			}

			$this->render('validar',array(
					'model'=>$model,
					'composicion_general' => $composicion_general,
					'tamano_coleccion' => $tamano_coleccion,
					'tipos_en_coleccion' => $tipos_en_coleccion,
					'urls_registros'	=> $urls_registros,
			));
			
		}else{
			$this->redirect(array("admin/login"));
		}
	}
	
	public function actionActualizar($id){
		if(Yii::app()->user->getId() !== null)
		{
			$criteria = new CDbCriteria;
			//$criteria->compare("estado", 2);
			$criteria->condition = "estado = 2 OR estado = 3";
			$criteria->order = "fecha_act DESC";
			$criteria->compare("Registros_id", $id);
			$criteria->with = array('county','composicion_general','tamano_coleccion','tipos_en_coleccion','contactos','dilegenciadores','county','archivos');
			$registros_update = Registros_update::model()->find($criteria);
			
			$model=$this->loadModel($id);
			//$model->fecha_dil = $_POST['Registros']['fecha_dil'];
			$model->save();
			
			$model->registros_update = $registros_update;
			//$model->registros_update->estado = 0;
			$tamano_coleccion 		= Tamano_Coleccion::model();
			$tipos_en_coleccion		= Tipos_En_Coleccion::model();
			$composicion_general 	= Composicion_General::model();
			$urls_registros			= Urls_Registros::model();
			
			if(isset($_POST['Registros_update'])){
				$modelRegistroUpdate = new Registros_update();
				$modelRegistroUpdate->contactos 			= new Contactos();
				$modelRegistroUpdate->dilegenciadores 		= new Dilegenciadores();
				$modelRegistroUpdate->tamano_coleccion 		= new Tamano_Coleccion();
				$modelRegistroUpdate->tipos_en_coleccion 	= new Tipos_En_Coleccion();
				$modelRegistroUpdate->composicion_general	= new Composicion_General();
				
				$modelRegistroUpdate->estado	= $_POST['Registros_update']['estado'];
				
				$success_saving_all = false;
				
				$transaction = Yii::app()->db->beginTransaction();
				
				try{
					
					if(isset($_POST['Entidad'])){
						$model->entidad->attributes = $_POST['Entidad'];
						if($model->entidad->colecciones == ""){
							$model->entidad->colecciones = "-";
						}
						$model->entidad->save(false);
					
					}
						
					$modelRegistroUpdate->attributes 			= $_POST['Registros_update'];
					$modelRegistroUpdate->contactos_id 			= 0;
					$modelRegistroUpdate->dilegenciadores_id 	= 0;
					//$modelRegistroUpdate->fecha_act				= Yii::app()->Date->now();
					$modelRegistroUpdate->fecha_env				= Yii::app()->Date->now();
					$modelRegistroUpdate->registros_id			= $id;
					$modelRegistroUpdate->registros				= $model;
						
					if(isset($_POST['Contactos'])){
						$modelRegistroUpdate->contactos->attributes = $_POST['Contactos'];
				
						//$modelRegistroUpdate->contactos->validate();
						if($modelRegistroUpdate->contactos->save()){
							$success_saving_all = true;
							$modelRegistroUpdate->contactos_id = $modelRegistroUpdate->contactos->id;
						}
					}
						
					if(isset($_POST['Dilegenciadores'])){
						$modelRegistroUpdate->dilegenciadores->attributes = $_POST['Dilegenciadores'];
				
						//$modelRegistroUpdate->dilegenciadores->validate();
						if($modelRegistroUpdate->dilegenciadores->save() && $success_saving_all){
							$success_saving_all = true;
							$modelRegistroUpdate->dilegenciadores_id = $modelRegistroUpdate->dilegenciadores->id;
						}else {
							$success_saving_all = false;
						}
					}
						
					if($success_saving_all){
						
						if(!$modelRegistroUpdate->save()){
							$success_saving_all = false;
						}else{
							$success_saving_all = true;
						}
					}
					
					if($success_saving_all){
				
						if(isset($_POST['Tamano_Coleccion'])){
							foreach ($_POST['Tamano_Coleccion'] as $valor_col){
								$modelRegistroUpdate->tamano_coleccion	= new Tamano_Coleccion();
				
								$modelRegistroUpdate->tamano_coleccion->tipo_preservacion_id = $valor_col['tipo_preservacion_id'];
								$modelRegistroUpdate->tamano_coleccion->unidad_medida		= $valor_col['unidad_medida'];
								//$modelRegistroUpdate->tamano_coleccion->cantidad			= $valor_col['cantidad'];
								$modelRegistroUpdate->tamano_coleccion->Registros_update_id = $modelRegistroUpdate->id;

								if($modelRegistroUpdate->tamano_coleccion->tipo_preservacion_id == 22){
									$modelRegistroUpdate->tamano_coleccion->otro = $valor_col['otro'];
								}
								$modelRegistroUpdate->tamano_coleccion->save();
							}
						}
				
						if(isset($_POST['Tipos_En_Coleccion'])){
							foreach ($_POST['Tipos_En_Coleccion'] as $valor_tipo){
								$modelRegistroUpdate->tipos_en_coleccion	= new Tipos_En_Coleccion();
								
								$modelRegistroUpdate->tipos_en_coleccion->grupo					= $valor_tipo['grupo'];
								//$modelRegistroUpdate->tipos_en_coleccion->nombre_cientifico		= $valor_tipo['nombre_cientifico'];
								//$modelRegistroUpdate->tipos_en_coleccion->informacion_ejemplar	= $valor_tipo['informacion_ejemplar'];
								$modelRegistroUpdate->tipos_en_coleccion->cantidad				= $valor_tipo['cantidad'];
								$modelRegistroUpdate->tipos_en_coleccion->Registros_update_id	= $modelRegistroUpdate->id;
									
								$modelRegistroUpdate->tipos_en_coleccion->save();
							}
						}
				
						if(isset($_POST['Composicion_General'])){
							foreach ($_POST['Composicion_General'] as $valor_comp){
								$modelRegistroUpdate->composicion_general	= new Composicion_General();

								$modelRegistroUpdate->composicion_general->grupo_taxonomico_id 		= ($valor_comp['grupo_taxonomico_id'] != '') ? $valor_comp['grupo_taxonomico_id'] : 0;
								$modelRegistroUpdate->composicion_general->subgrupo_taxonomico_id	= ($valor_comp['subgrupo_taxonomico_id'] != '') ? $valor_comp['subgrupo_taxonomico_id'] : 0;
								$modelRegistroUpdate->composicion_general->numero_ejemplares		= ($valor_comp['numero_ejemplares'] != '') ? $valor_comp['numero_ejemplares'] : 0;
								$modelRegistroUpdate->composicion_general->numero_catalogados		= ($valor_comp['numero_catalogados'] != '') ? $valor_comp['numero_catalogados'] : 0;
								$modelRegistroUpdate->composicion_general->numero_sistematizados	= ($valor_comp['numero_sistematizados'] != '') ? $valor_comp['numero_sistematizados'] : 0;
								$modelRegistroUpdate->composicion_general->numero_nivel_filum		= ($valor_comp['numero_nivel_filum'] != '') ? $valor_comp['numero_nivel_filum'] : 0;
								$modelRegistroUpdate->composicion_general->numero_nivel_orden		= ($valor_comp['numero_nivel_orden'] != '') ? $valor_comp['numero_nivel_orden'] : 0;
								$modelRegistroUpdate->composicion_general->numero_nivel_familia		= ($valor_comp['numero_nivel_familia'] != '') ? $valor_comp['numero_nivel_familia'] : 0;
								$modelRegistroUpdate->composicion_general->numero_nivel_genero		= ($valor_comp['numero_nivel_genero'] != '') ? $valor_comp['numero_nivel_genero'] : 0;
								$modelRegistroUpdate->composicion_general->numero_nivel_especie		= ($valor_comp['numero_nivel_especie'] != '') ? $valor_comp['numero_nivel_especie'] : 0;
								$modelRegistroUpdate->composicion_general->Registros_update_id		= $modelRegistroUpdate->id;
								
								if($modelRegistroUpdate->composicion_general->subgrupo_taxonomico_id == 2){
									$modelRegistroUpdate->composicion_general->subgrupo_otro = $valor_comp['subgrupo_otro'];
								}
								
								$modelRegistroUpdate->composicion_general->save();
							}
						}
				
						if(isset($_POST['Registros_update']['archivosAnexos']) && $_POST['Registros_update']['archivosAnexos'] != ''){
							$pathDir = 'rnc_files'.DIRECTORY_SEPARATOR.'Registro_Colecciones_Biologicas'.DIRECTORY_SEPARATOR.$modelRegistroUpdate->id."_".$modelRegistroUpdate->acronimo;
							//$pathDir = 'Registro_Colecciones_Biologicas'.DIRECTORY_SEPARATOR.$modelRegistroUpdate->id."_".$modelRegistroUpdate->acronimo;
							if(!file_exists($pathDir)){
								mkdir($pathDir);
							}
							$pathFile = "archivosAnexos";
							if(!file_exists($pathDir.DIRECTORY_SEPARATOR.$pathFile)){
								mkdir($pathDir.DIRECTORY_SEPARATOR.$pathFile);
							}
								
							$dataFiles_ar = explode(",", $_POST['Registros_update']['archivosAnexos']);
							foreach ($dataFiles_ar as $value){
								$dataFiles = explode("/", $value);
								if(file_exists("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0])){
									if(rename("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0], $pathDir.DIRECTORY_SEPARATOR.$pathFile.DIRECTORY_SEPARATOR.$dataFiles[0])){
				
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
				
						if(isset($_POST['Registros_update']['archivosColecciones'])  && $_POST['Registros_update']['archivosColecciones'] != ''){
							$pathDir = 'rnc_files'.DIRECTORY_SEPARATOR.'Registro_Colecciones_Biologicas'.DIRECTORY_SEPARATOR.$modelRegistroUpdate->id."_".$modelRegistroUpdate->acronimo;
							//$pathDir = 'Registro_Colecciones_Biologicas'.DIRECTORY_SEPARATOR.$modelRegistroUpdate->id."_".$modelRegistroUpdate->acronimo;
							if(!file_exists($pathDir)){
								mkdir($pathDir);
							}
								
							$pathFile = "archivosColecciones";
							if(!file_exists($pathDir.DIRECTORY_SEPARATOR.$pathFile)){
								mkdir($pathDir.DIRECTORY_SEPARATOR.$pathFile);
							}
								
							$dataFiles_ar = explode(",", $_POST['Registros_update']['archivosColecciones']);
							foreach ($dataFiles_ar as $value){
								$dataFiles = explode("/", $value);
								if(file_exists("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0])){
									if(rename("temp_rnc".DIRECTORY_SEPARATOR.$dataFiles[0], $pathDir.DIRECTORY_SEPARATOR.$pathFile.DIRECTORY_SEPARATOR.$dataFiles[0])){
				
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
						
					if($model->registros_update->estado == 1){
						
						$mails = array(0 => $model->entidad->email,1 => 'rnc@humboldt.org.co');
						$message 			= new YiiMailMessage;
						$message->view 		= "crearRegistro";
						$params				= array('data' => $model);
						$message->subject	= 'Envío de Registro de Colección '.$model->registros_update->nombre.'- Sistema RNC';
						$message->from		= 'hescobar@humboldt.org';
						$message->setBody($params,'text/html');
						$message->setTo($mails);
						Yii::app()->mail->send($message);
						
						$this->redirect(array('view','id'=>$model->id,'status'=>'Ok'));
					}else{
						/*$this->render('index',array(
								'model'=>$model
						));
						Yii::app()->end();*/
						$this->redirect(array('view','id'=>$model->id,'status'=>'Ok'));
					}
						
				}
			}
			$this->render('actualizar',array(
					'model'=>$model,
					'composicion_general' => $composicion_general,
					'tamano_coleccion' => $tamano_coleccion,
					'tipos_en_coleccion' => $tipos_en_coleccion,
					'urls_registros'	=> $urls_registros,
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
			$modelRegistros_update = Registros_update::model()->findByPk($id,$criteria);
			
			$this->render('viewDetail',array(
					'model'=>$modelRegistros_update,
			));
			
		}else{
			$this->redirect(array("admin/login"));
		}
	}
	
	public function actionDeleteLevels(){
		if(Yii::app()->user->getId() !== null){
				$id = $_POST['id'];
				$modelComposicion = Composicion_General::model()->findByPk($id);
				if($modelComposicion->delete()){
					echo CJSON::encode(array(
							'status'=>'ok',
							));
				}else{
					echo CJSON::encode(array(
							'status'=>'failure',
							));
				}
		}

	}
	public function actionDeleteDetail($id){
		if(Yii::app()->user->getId() !== null)
		{
			$criteria = new CDbCriteria;
			$criteria->with = array('registros','county','composicion_general','tamano_coleccion','tipos_en_coleccion','contactos','dilegenciadores','county','archivos');
			$modelRegistros_update = Registros_update::model()->findByPk($id,$criteria);
			
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
			$modelRegistros_update->dilegenciadores->delete();
			$modelRegistros_update->contactos->delete();
					
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
				if(unlink("temp_rnc".DIRECTORY_SEPARATOR.$_POST['name'])){
					echo 1;
				}else {
					echo 0;
				}
			}
		}
	}
	
	public function actionValidarColeccionAjax(){
		if(Yii::app()->user->getId() !== null)
		{
			if(isset($_POST['coleccion'])){
				$criteria = new CDbCriteria;
				$criteria->compare("numero_registro", $_POST['coleccion']);
				
				$modelRegistro = Registros::model()->find($criteria);
				
				if($modelRegistro && $_POST['coleccion'] != 0){
					echo 1;
				}else {
					echo 0;
				}
			}
		}
	}
	
	public function actionValidarAcronimoAjax(){
		if(Yii::app()->user->getId() !== null)
		{
			if(isset($_POST['dato'])){
				$criteria = new CDbCriteria;
				$criteria->compare("acronimo", $_POST['dato']);
				$criteria->compare("estado", 2);
	
				$modelRegistro = Registros_Update::model()->find($criteria);
	
				if($modelRegistro){
					echo 1;
				}else {
					echo 0;
				}
			}
		}
	}
	
	public function actionBusqueda(){
		if(Yii::app()->user->getId() !== null)
		{
			$model = new Registros('search');
			$model->unsetAttributes();
			
			$model->entidad = Entidad::model();
			$model->registros_update = Registros_update::model();
				
			$userRole = Yii::app()->user->getState("roles");
			if($userRole == "entidad"){
				$usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
					
				$criteriaEntidad = new CDbCriteria;
				$criteriaEntidad->compare('usuario_id',$usuario->id);
					
				$entidad = Entidad::model()->find($criteriaEntidad);
			
				$model->entidad = $entidad;
				$model->Entidad_id = $entidad->id;
			}
			
			if(isset($_REQUEST['Registros'])){
				$model->attributes = $_GET['Registros'];
				$arr = $_GET;
				$this->renderPartial('_registros_table', array('listRegistros'=>$model->search(),'model' => $model));
			}
		}
	}
	
	public function actionListarValidar(){
		if(Yii::app()->user->getId() !== null)
		{
			$model=new Registros();
			$model->entidad = Entidad::model();
			$model->registros_update = Registros_update::model();
				
			$this->render('listarValidar',array(
					'model'=>$model,
			));
		}else{
			$this->redirect(array("admin/login"));
		}
	}
	
	public function actionListarHistoricosFolder(){
		if(Yii::app()->user->getId() !== null)
		{
			if(isset($_GET['name'])){
				$name = $_GET['name'];
			}else {
				$name = "";
			}
			
			//$dirPath	= "rnc_files".DIRECTORY_SEPARATOR."Registro_Colecciones_Biologicas_Historicos".DIRECTORY_SEPARATOR.$name;

			$dirPath    = "..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."media".DIRECTORY_SEPARATOR."disk2".DIRECTORY_SEPARATOR."rnc_files".DIRECTORY_SEPARATOR."Registro_Colecciones_Biologicas_Historicos".DIRECTORY_SEPARATOR.$name;
			
			if(is_dir($dirPath)){
				
				$model = Registros::model();
				
				$this->render('listarHistoricosFolder',array(
						'model' => $model,
						'folder' => $name,
				));
			}else{
				$filename = $dirPath;
				header("Expires: -1");
				header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
				header("Content-type: application/pdf;\n"); //or yours?
				header("Content-Transfer-Encoding: binary");
				header("Cache-Control: no-store, no-cache, must-revalidate");
				header("Cache-Control: post-check=0, pre-check=0");
				header("Pragma: no-cache");
				$len = filesize($filename);
				header("Content-Length: $len;\n");
				$outname=$name;
				header("Content-Disposition: attachment; filename=".$outname.";\n\n");
				readfile($filename);
				
				//$this->redirect(Yii::app()->createUrl("..".DIRECTORY_SEPARATOR.$dirPath));
			}
			
		}else{
			$this->redirect(array("admin/login"));
		}
	}
	
	public function actionListarHistoricosFiles($name = ""){
		if(Yii::app()->user->getId() !== null && Yii::app()->user->getState("roles") == "admin")
		{
			$model = Registros::model();
			$this->render('listarHistoricosFiles',array(
					'model' => $model,
					'name'	=> $name
			));
		}else{
			$this->redirect(array("admin/login"));
		}
	}
	
	public function actionActSelectSubgrupoAjax(){
		if(Yii::app()->user->getId() !== null)
		{
			$criteria = new CDbCriteria;
			$criteria->compare("grupo_taxonomico_id",$_POST['idGrupo']);
			$criteria->order = "nombre ASC";
			$subgrupo = Subgrupo_Taxonomico::model()->findAll($criteria);
			$lista = array();
			if(isset($subgrupo)){
				foreach ($subgrupo as $dato){
					$lista[] = array("id" => $dato->id,"nombre" => $dato->nombre);
				}
			}
			
			$lista[] = array("id" => 2,"nombre" => "Otro");
			
			echo json_encode($lista);
		}
	}
	
	public function actionCancelarRegistro(){
		if(Yii::app()->user->getId() !== null)
		{
			if(isset($_POST['Registros_update']) && $_POST['Registros']){
				$modelRegistro = Registros::model()->findByPk($_POST['Registros']['id']);
				$modelRegistro->estado = 2;
				
				$criteria = new CDbCriteria;
				$criteria->compare("registros_id",$modelRegistro->id);
				
				$modelRegistroUpdate = Registros_update::model()->findAll($criteria);
				if(isset($modelRegistroUpdate)){
					foreach ($modelRegistroUpdate as $dato){
						$dato->comentario = $dato->comentario."\n Motivo de Cancelación: \n".$_POST['Registros_update']['comentarioCancelar'];
						$dato->estado = 5;
						$dato->save();
					}
				}
				
				
				if($modelRegistro->save()){
					
					$mails = array(0 => $modelRegistroUpdate[0]->registros->entidad->email,1 => 'rnc@humboldt.org.co');
					//$mails = array(0 => 'hescobar@humboldt.org.co');
					$message 			= new YiiMailMessage;
					$message->view 		= "cancelarRegistro";
					$params				= array('data' => $modelRegistroUpdate[0],'comentario' => $_POST['Registros_update']['comentarioCancelar']);
					$message->subject	= 'Envío de Registro de Colección '.$modelRegistroUpdate[0]->nombre.'- Sistema RNC';
					$message->setFrom(array('rnc@humboldt.org.co'));
					$message->setBody($params,'text/html');
					$message->setTo($mails);
					Yii::app()->mail->send($message);
					
					echo CJSON::encode(array(
							'status'=>'ok',
							));
					exit;
				}else {
					echo CJSON::encode(array(
							'status'=>'failure',
						));
					exit;
				}
				
			}
		}
	}
	
	public function actionGenerarCertificado($id = 0){
		if(Yii::app()->user->getId() !== null)
		{
			$modelRegistros_update = "";
			
			if(isset($_POST['id']) && isset($_POST['opt'])){
				$criteria = new CDbCriteria;
				$criteria->with = array('registros','county');
				$modelRegistros_update = Registros_update::model()->findByPk($_POST['id'],$criteria);
			
			}elseif ($id != 0){
				$criteria = new CDbCriteria;
				$criteria->with = array('registros','county');
				$modelRegistros_update = Registros_update::model()->findByPk($id);
			}
			
			$pathDir = 'rnc_files/Certificados/'.$modelRegistros_update->acronimo;
			if(!file_exists($pathDir)){
				mkdir($pathDir);
			}
			
			$modelCertificado = new Certificados();
			$modelCertificado->nombre 	= "certificado_rnc";
			$modelCertificado->fecha 	= Yii::app()->Date->now();
			
			if($id == 0){
				$modelCertificado->tipo_certificado = 0;
			}else{
				$modelCertificado->tipo_certificado = 1;
			}
			
			
			$modelCertificado->registros_update_id = $modelRegistros_update->id;
			$modelCertificado->save();
			$modelCertificado->nombre = $modelCertificado->nombre."_".$modelCertificado->id.".pdf";
			$modelCertificado->save();
			
			$fechaCert = strtotime($modelCertificado->fecha);
			$fechaCert = getdate($fechaCert);
			
			if($id == 0){
				$fechaAct = strtotime($_POST['fechaAct']);
			}else{
				$fechaAct = strtotime($modelRegistros_update->fecha_act);
			}
			
			$fechaAct = getdate($fechaAct);
					
			$pdf = new RNCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			//spl_autoload_register(array('YiiBase','autoload'));
			
			$pdf->SetCreator('Instituto Alexander Von Humboldt');
			$pdf->SetTitle("Certificado RNC - 2014");
			$pdf->SetAuthor('Instituto Alexander Von Humboldt');
			$pdf->SetHeaderData('../../../themes/rnc_theme_panel/images/header.jpg',180, '', '', array(0,0,0), array(255,255,255));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(3);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			$pdf->SetFont('helvetica', '', 8);
			$pdf->SetTextColor(80,80,80);
			$pdf->AddPage();
			
			//Write the html
			if($id != 0){
				$html = $this->renderPartial('certificadoActualizar',array(
						'model' => $modelRegistros_update,
						'idCert' => $modelCertificado->id,
						'fecha'	 => $fechaCert,
						'fechaAct' => $fechaAct,
						'ruta' 	 => "http://rnc.humboldt.org.co/".$pathDir."/".$modelCertificado->nombre,
				),true);
				//Convert the Html to a pdf document
				$pdf->writeHTML($html);
				$pdf->writeHTML('<br><br><br><img style="margin-top:150px" src="themes/rnc_theme_panel/images/footer.jpg" />');
				$pdf->lastPage();
			}else{
				$elaborado = $_POST['elaborado'];
				$aprobado = $_POST['aprobado'];
				
				$html = $this->renderPartial('certificadoAprobar',array(
						'model' => $modelRegistros_update,
						'idCert' => $modelCertificado->id,
						'fecha'	 => $fechaCert,
						'fechaAct' => $fechaAct,
						'ruta'	 => "http://rnc.humboldt.org.co/".$pathDir."/".$modelCertificado->nombre,
						'col'		=> $_POST['numCol'],
						'aprobado' => $aprobado,
						'elaborado' => $elaborado
				),true);
				//Convert the Html to a pdf document
				$pdf->writeHTML($html);
				$pdf->writeHTML('<img style="margin-top:150px" src="themes/rnc_theme_panel/images/footer.jpg" />');
				$pdf->lastPage();
			}
			
			//Close and output PDF document
			if($id == 0){
				$pdf->Output($pathDir.DIRECTORY_SEPARATOR.$modelCertificado->nombre, 'F');
				echo $pathDir."/".$modelCertificado->nombre;
				Yii::app()->end();
				//$pdf->Output("php://output", 'D');
			}else{
								
				$modelArchivo = new Archivos();
				$modelArchivo->nombre 	= $modelCertificado->nombre;
				$modelArchivo->tipo		= ".pdf";
				$modelArchivo->ruta		= $pathDir;
				$modelArchivo->clase	= 3;
				$modelArchivo->Registros_update_id = $modelRegistros_update->id;
				$modelArchivo->save();
								
				$pdf->Output($pathDir.DIRECTORY_SEPARATOR.$modelCertificado->nombre, 'F');
				
				return $modelArchivo;
			}
			
		}
	}
	
	public function actionColeccionesdos(){
		
		$pathDir = 'rnc_files/colecciones.xls';
		
		$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');
		
		// Turn off our amazing library autoload
		spl_autoload_unregister(array('YiiBase','autoload'));
		
		include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
		
		include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel'. DIRECTORY_SEPARATOR .'IOFactory.php');
		
		spl_autoload_register(array('YiiBase','autoload'));
		
		$dataInfo = new PHPExcel_Reader_Excel5();
		
		$dataPhpExcel = $dataInfo->load($pathDir);
		
		$arrg = $dataPhpExcel->getActiveSheet()->toArray(null,true,true,true);
		
		$model = Registros::model();
		
		$datos = array();
		
		for ($i = 1; $i <= count($arrg); $i++) {
			$datos[] = array($arrg[$i]['A'],$arrg[$i]['B'],$arrg[$i]['C'],$arrg[$i]['D'],$arrg[$i]['E'],$arrg[$i]['F'],$arrg[$i]['G'],$arrg[$i]['H'],$arrg[$i]['I'],$arrg[$i]['J'],$arrg[$i]['K'],$arrg[$i]['L'],$arrg[$i]['M']);
		}
		
		
		$this->render('colecciones',array(
				'model' => $model,
				'datos' => json_encode($datos),
		));
	}
	
	public function actionColecciones(){
		
		$datos = array();
		$model = Registros_update::model();
		
		$criteria=new CDbCriteria;
		$criteria->compare('t.estado', 2);
		$criteria->with = array('registros','county','contactos','urls_registros');
		
		$dataRegitros = $model->findAll($criteria);
		
		foreach ($dataRegitros as $registro){
			$link_detail = '<a class="btn btn-success" href="'.Yii::app()->createUrl("registros/detail", array("id"=>$registro->id)).'" role="button">Detalle</a>';
			$datos[] = array($registro->registros->numero_registro.$this->getUrlColection($registro->urls_registros),$registro->registros->entidad->titular,$registro->nombre,$registro->acronimo,$registro->county->department->department_name,$registro->county->county_name,date_format(date_create($registro->fecha_act), "Y-m-d"),$registro->contactos->nombre,$registro->contactos->cargo,$registro->contactos->email,$registro->contactos->telefono,$link_detail);
		}
			
		$this->render('colecciones',array(
				'model' => $model,
				'datos' => json_encode($datos),
		));
	}
	
	private function getUrlColection($urls){
		if(is_array($urls)){
			$urlP = Yii::app();
			//print_r($urlP);
			//Yii::app()->end();
			$html = '<ul style="float:right;margin: 0">';
			foreach ($urls as $url) {
				if($url->tipo == 0){
					$html .= '<li style="float:left; margin-left: 5px"><a href="'.$url->url.'" target="_blank" title="'.$url->nombre.'"><img width="30" src="/themes/rnc_theme/images/sib-40.png"/></a></li>';
				}else if($url->tipo == 1){
					$html .= '<li style="float:left; margin-left: 5px"><a href="'.$url->url.'" target="_blank" title="'.$url->nombre.'"><img width="30" src="/themes/rnc_theme/images/otro-40.png"/></a></li>';
				}
			}
			$html .= "</ul>";
			return $html;
		}else{
			$html = "<ul>";
			$html .= '<li><a href="'.$url->url.'" target="_blank">'.$url->nombre.'</a></li>';
			$html .= "</ul>";
			return $html;
		}
	}

	public function actionValidarActualizar(){
		if(isset($_POST['id'])){
			$modelRegUp = Registros_update::model();
			
			$criteria = new CDbCriteria;
			//$criteria->compare('t.id',$_POST['id']);
			$criteria->compare('t.estado',1);
			$criteria->compare('registros.id',$_POST['id']);
			$criteria->with = array('registros','county','contactos');
			
			$dataRegitros = $modelRegUp->findAll($criteria);
			
			if(count($dataRegitros) > 0){
				echo "Ok";
			}else{
				echo -1;
			}
			
		}else{
			echo -1;
		}
	}
	
	public function actionListarCertificados(){
		
		if(Yii::app()->user->getId() !== null)
		{
			if(isset($_GET['name'])){
				$name = $_GET['name'];
			}else {
				$name = "";
			}
			
			
			$dirPath	= "rnc_files".DIRECTORY_SEPARATOR."Certificados".DIRECTORY_SEPARATOR.$name;
			
			if(is_dir($dirPath)){
			
				$model = Registros::model();
				
				$this->render('certificados',array(
						'model' => $model,
						'folder' => $name,
				));
			
			}else{
				$filename = $dirPath;
				header("Expires: -1");
				header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
				header("Content-type: application/pdf;\n"); //or yours?
				header("Content-Transfer-Encoding: binary");
				header("Cache-Control: no-store, no-cache, must-revalidate");
				header("Cache-Control: post-check=0, pre-check=0");
				header("Pragma: no-cache");
				$len = filesize($filename);
				header("Content-Length: $len;\n");
				$outname=$name;
				header("Content-Disposition: attachment; filename=".$outname.";\n\n");
				readfile($filename);
			
				//$this->redirect(Yii::app()->createUrl("..".DIRECTORY_SEPARATOR.$dirPath));
			}
		}else{
			$this->redirect(array("admin/login"));
		}
	}
	
	public function actionActivarRegistro(){
		if(Yii::app()->user->getId() !== null)
		{
			if(isset($_POST['idRegistro'])){
				$modelRegistroUpdate = Registros_update::model()->findByPk($_POST['idRegistro']);
				
				$criteria2 = new CDbCriteria;
				$criteria2->compare("estado", 4);
				$criteria2->compare("registros_id",$modelRegistroUpdate->registros_id);
				$criteria2->order = "fecha_act DESC";
				$registros_update_ant = Registros_Update::model()->findAll($criteria2);
	
				if(count($registros_update_ant) > 0){
					$modelRegistroUpdate->estado = 1;
					$registros_update_ant[0]->estado = 2;
					$registros_update_ant[0]->save();
				}else{
					$modelRegistroUpdate->estado = 1;
				}
				
				if($modelRegistroUpdate->save()){
						
					echo CJSON::encode(array(
							'status'=>'ok',
					));
					exit;
				}else {
					echo CJSON::encode(array(
							'status'=>'failure',
					));
					exit;
				}
	
			}
		}
	}

	public function actionDetail($id){
		
		$criteria = new CDbCriteria;
		$criteria->with = array('registros','county','composicion_general','tamano_coleccion','tipos_en_coleccion','contactos','dilegenciadores','county','archivos');
		$modelRegistros_update = Registros_update::model()->findByPk($id,$criteria);
		
		$this->render('detail',array(
				'model'=>$modelRegistros_update,
		));
		
	}
	
}
?>