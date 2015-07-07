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
	
	public function actionReporte(){
		if(Yii::app()->user->getId() !== null)
		{
			$model = new Visitas();
			$fechaReporte = Yii::app()->Date->now();
				
			try{
				$criteria = new CDbCriteria;
				$criteria->with = array('registros','dilegenciadores','county');
				$pqrs = Visitas::model()->findAll($criteria);
	
				$dataReporte = array();
				$dataReporte[0]['entidad']			= 'Entidad';
				$dataReporte[0]['numero_registro']	= 'Colección No.';
				$dataReporte[0]['titular'] 			= 'Titular';
				$dataReporte[0]['departamento']		= 'Departamento';
				$dataReporte[0]['municipio'] 		= 'Municipio';
				$dataReporte[0]['fecha_visita']		= 'Fecha de la visita';
				$dataReporte[0]['concepto']			= 'Concepto';
				$dataReporte[0]['nombre']			= 'Diligenciador';
				$dataReporte[0]['dependencia']		= 'Dependencia';
				$dataReporte[0]['cargo']			= 'Cargo';
					
				$cont = 1;
					
				foreach ($pqrs as $data){

					$dataReporte[$cont]['entidad'] 			= (isset($data->entidad)) ? $data->entidad : "";
					$dataReporte[$cont]['numero_registro'] 	= (isset($data->registros->numero_registro)) ? $data->registros->numero_registro : "";
					$dataReporte[$cont]['titular'] 			= (isset($data->registros->entidad->titular)) ? $data->registros->entidad->titular : "";;
					$dataReporte[$cont]['departamento'] 	= (isset($data->county->department->department_name)) ? $data->county->department->department_name : "";
					$dataReporte[$cont]['municipio'] 		= (isset($data->county->county_name)) ? $data->county->county_name : "";
					$dataReporte[$cont]['fecha_visita'] 	= $data->fecha_visita;
					$dataReporte[$cont]['concepto'] 		= $data->concepto;
					$dataReporte[$cont]['nombre']			= $data->dilegenciadores->nombre;
					$dataReporte[$cont]['dependencia']		= $data->dilegenciadores->dependencia;
					$dataReporte[$cont]['cargo']			= $data->dilegenciadores->cargo;
											
					$cont++;
				}
	
				$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');
	
				spl_autoload_unregister(array('YiiBase','autoload'));
	
				include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
	
				$objPhpExcel = new PHPExcel();
	
				spl_autoload_register(array('YiiBase','autoload'));
	
				$objPhpExcel->getProperties()->setCreator("Instituto Alexander Von Humboldt")
				->setTitle("Reporte de visitas")
				->setSubject("Reporte de visitas")
				->setDescription("Reporte detallado de las visitas");
	
				$objPhpExcel->getActiveSheet()->setTitle('Reporte Visitas');
	
				$dataExcel = array();
	
				foreach ($dataReporte as $k => $value){
					$abc = 65;
					$abc_aux = 64;
					$mayor = false;
					foreach ($value as $j => $valueData){
						//echo $abc."/";
						$alfa = chr($abc);
							
						if($abc > 90){
							$abc = 65;
							$abc_aux++;
							$mayor = true;
							$alfa = chr($abc_aux).chr($abc);
						}else if($mayor){
							$alfa = chr($abc_aux).chr($abc);
						}
						$objPhpExcel->setActiveSheetIndex(0) -> setCellValue($alfa.($k + 1), $valueData);
						$abc++;
					}
				}
	
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="ReporteVisitas.xlsx"');
				header('Cache-control: max-age=1');
	
				$objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, 'Excel2007');
				$objWriter->save('php://output');
	
				$mensaje = new Mensaje();
				$mensaje->setTitulo("Descarga exitosa");
				$mensaje->setMensaje("La descarga del reporte fue realizada con éxito.");
	
				$this->render('mensaje',array(
						'model'=>$mensaje,
				));
	
			}catch (Exception $e) {
				//$transaction->rollback();
				print_r($e->getMessage());
				Yii::log("Ocurrió un error al enviar la informacion de registro: " . $e->getMessage(), 'error');
				$success_saving_all = false;
				Yii::app()->end();
			}
		}
	}
}
?>