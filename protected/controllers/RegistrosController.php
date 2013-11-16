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
			$this->render('view',array(
					'model'=>$this->loadModel($id),
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
			$model=new Registros('search');
			$model->unsetAttributes();  // clear any default values
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
			
			if(isset($_POST['Registros'])){
				
				$model->numero_registro = 0;
				$model->estado			= $_POST['Registros']['estado'];
				
				$success_saving_all = true;
				
				$transaction = Yii::app()->db->beginTransaction();
				
				try{
					
					if(isset($_POST['Registros_Update'])){
						$model->registros_update->attributes 			= $_POST['Registros_Update'];
						$model->registros_update->contactos_id 			= 0;
						$model->registros_update->dilegenciadores_id 	= 0;
						$model->registros_update->fecha_act				= Yii::app()->Date->now();
												
						
						if(isset($_POST['Contactos'])){
							$model->registros_update->contactos->attributes = $_POST['Contactos'];
							
							if($model->registros_update->contactos->validate()){
								$model->registros_update->contactos->save(false);
								$model->registros_update->contactos_id = $model->registros_update->contactos->id;
							}
						}
						
						if(isset($_POST['Dilegenciadores'])){
							$model->registros_update->dilegenciadores->attributes = $_POST['Dilegenciadores'];
							
							if($model->registros_update->dilegenciadores->validate()){
								$model->registros_update->dilegenciadores->save(false);
								$model->registros_update->dilegenciadores_id = $model->registros_update->dilegenciadores->id;
							}
						}
						
						if($model->registros_update->validate()){	
							$model->registros_update->save(false);
							$model->Registros_update_id = $model->registros_update->id;
							
							if(isset($_POST['Tamano_Coleccion'])){
								for ($i = 0; $i < count($_POST['Tamano_Coleccion']); $i++) {
									$model->registros_update->tamano_coleccion	= new Tamano_Coleccion();
									
									$model->registros_update->tamano_coleccion->tipo_preservacion 	= $_POST['Tamano_Coleccion'][$i]['tipo_preservacion'];
									$model->registros_update->tamano_coleccion->unidad_medida		= $_POST['Tamano_Coleccion'][$i]['unidad_medida'];
									$model->registros_update->tamano_coleccion->cantidad			= $_POST['Tamano_Coleccion'][$i]['cantidad'];
									$model->registros_update->tamano_coleccion->Registros_update_id = $model->registros_update->id;
									
									if($model->registros_update->tamano_coleccion->validate()){
										$model->registros_update->tamano_coleccion->save(false);
									}
								}
							}
							
							if(isset($_POST['Tipos_En_Coleccion'])){
								for ($i = 0; $i < count($_POST['Tipos_En_Coleccion']); $i++) {
									$model->registros_update->tipos_en_coleccion	= new Tipos_En_Coleccion();
									
									$model->registros_update->tipos_en_coleccion->informacion_ejemplar	= $_POST['Tipos_En_Coleccion'][$i]['informacion_ejemplar'];
									$model->registros_update->tipos_en_coleccion->cantidad				= $_POST['Tipos_En_Coleccion'][$i]['cantidad'];
									$model->registros_update->tipos_en_coleccion->Registros_update_id	= $model->registros_update->id;
									
									if($model->registros_update->tipos_en_coleccion->validate()){
										$model->registros_update->tipos_en_coleccion->save(false);
									}
								}
							}
							
							if(isset($_POST['Composicion_General'])){
								for ($i = 0; $i < count($_POST['Composicion_General']); $i++) {
									$model->registros_update->composicion_general	= new Composicion_General();
									
									$model->registros_update->composicion_general->grupo_taxonomico			= $_POST['Composicion_General'][$i]['grupo_taxonomico'];
									$model->registros_update->composicion_general->numero_ejemplares		= $_POST['Composicion_General'][$i]['numero_ejemplares'];
									$model->registros_update->composicion_general->numero_catalogados		= $_POST['Composicion_General'][$i]['numero_catalogados'];
									$model->registros_update->composicion_general->numero_sistematizados	= $_POST['Composicion_General'][$i]['numero_sistematizados'];
									$model->registros_update->composicion_general->numero_nivel_familia		= $_POST['Composicion_General'][$i]['numero_nivel_familia'];
									$model->registros_update->composicion_general->numero_nivel_genero		= $_POST['Composicion_General'][$i]['numero_nivel_genero'];
									$model->registros_update->composicion_general->numero_nivel_especie		= $_POST['Composicion_General'][$i]['numero_nivel_especie'];
									$model->registros_update->composicion_general->Registros_update_id		= $model->registros_update->id;
									
									if($model->registros_update->composicion_general->validate()){
										$model->registros_update->composicion_general->save(false);
									}
								}
							}
							$model->save(false);
								
							$transaction->commit();
						}else {
							echo "error";
							$transaction->rollback();
							print_r($_POST['Registros_Update']);
							
							Yii::app()->end();
						}
						
						
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
}
?>