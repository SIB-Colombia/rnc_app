<?php
class ReporteController extends Controller{
	
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		if(Yii::app()->user->getId() !== null)
		{
			$model = new Reporte();
			$fechaReporte = Yii::app()->Date->now();
			if(isset($_POST['Reporte'])){
				
				
				$criteria = new CDbCriteria;
				$criteria->compare("t.estado", 2);
				$criteria->with = array('registros','registros.entidad','county','composicion_general','tamano_coleccion','tipos_en_coleccion','contactos','dilegenciadores','county','archivos');
				$registros_update = Registros_Update::model()->findAll($criteria);
				
				$dataReporte = array();
				$dataReporte[0]['entidadNombre'] 			= 'Entidad';
				$dataReporte[0]['coleccionNumero'] 			= 'No. Colección';
				$dataReporte[0]['coleccionFecha'] 			= 'Última Actualización';
				$dataReporte[0]['reporteNombre'] 			= 'Nombre de la colección';
				$dataReporte[0]['reporteAcronimo'] 			= 'Acrónimo';
				$dataReporte[0]['reporteFundacion'] 		= 'Año de fundación';
				$dataReporte[0]['reporteDescripcion'] 		= 'Descripción';
				$dataReporte[0]['reporteDireccion'] 		= 'Dirección de la colección';
				$dataReporte[0]['reporteCiudad'] 			= 'Ciudad';
				$dataReporte[0]['reporteTelefono'] 			= 'Teléfono';
				$dataReporte[0]['reporteEmail'] 			= 'Correo electrónico';
				$dataReporte[0]['coberturaTaxonomica'] 		= 'Cobertura taxonómica';
				$dataReporte[0]['coberturaGeografica'] 		= 'Cobertura geográfica';
				$dataReporte[0]['coberturaTemporal'] 		= 'Cobertura temporal';
				$dataReporte[0]['tamanoTipo']		 		= 'Tipo de preservación';
				$dataReporte[0]['tamanoUnidad']		 		= 'Unidad de medida';
				//$dataReporte[0]['tamanoCantidad']	 		= 'Cantidad de ejemplares';
				$dataReporte[0]['nivelGrupo']		 		= 'Grupo taxonómico o biológico';
				$dataReporte[0]['nivelEjemplares']	 		= 'No. Ejemplares';
				$dataReporte[0]['nivelCatalogados']	 		= 'Ejemplares catalogados';
				$dataReporte[0]['nivelSistematizados'] 		= 'Ejemplares sistematizados';
				$dataReporte[0]['nivelOrden']		 		= 'Ejemplares identificados al nivel de orden';
				$dataReporte[0]['nivelFamilia']		 		= 'Ejemplares identificados al nivel de familia';
				$dataReporte[0]['nivelGenero']		 		= 'Ejemplares identificados al nivel de genero';
				$dataReporte[0]['nivelEspecie']		 		= 'Ejemplares identificados al nivel de especie';
				$dataReporte[0]['sistematizacion']	 		= 'Sistematización y Publicación';
				$dataReporte[0]['tipoGrupo']		 		= 'Grupo';
				$dataReporte[0]['tipoEjemplar']		 		= 'Información sobre el ejemplar tipo';
				$dataReporte[0]['tipoNombreCientifico']		= 'Nombre Científico';
				//$dataReporte[0]['tipoCantidad']		 		= 'Cantidad de ejemplares';
				$dataReporte[0]['documentoAnexos']	 		= 'Listado de anexos';
				$dataReporte[0]['informacionAdicional']	 	= 'Información adicional';
				$dataReporte[0]['informacionPagina']	 	= 'Página web de la colección';
				$dataReporte[0]['contactoNombre']		 	= 'Persona de contacto';
				$dataReporte[0]['contactoCargo']		 	= 'Cargo';
				$dataReporte[0]['contactoDependencia']	 	= 'Dependencia';
				$dataReporte[0]['contactoDireccion']	 	= 'Dirección de correspondencia';
				$dataReporte[0]['contactoCiudad']		 	= 'Ciudad';
				$dataReporte[0]['contactoTelefono']		 	= 'Teléfono(s)';
				$dataReporte[0]['contactoEmail']		 	= 'Correo electrónico';
				
				$cont = 1;
				foreach ($registros_update as $data){
					
					$countTamano = count($data->tamano_coleccion);
					$countComposicion = count($data->composicion_general);
					$countTipo = count($data->tipos_en_coleccion);
					
					$dataM = '';
					if($countTamano >= $countComposicion && $countTamano >= $countTipo){
						$dataM = $data->tamano_coleccion;
					}else if($countComposicion >= $countTamano && $countComposicion >= $countTipo){
						$dataM = $data->composicion_general;
					}else if($countTipo >= $countTamano && $countTipo >= $countComposicion){
						$dataM = $data->tipos_en_coleccion;
					}
					
					foreach ($dataM as $k => $value){

						$dataReporte[$cont]['entidadNombre'] 		= $data->registros->entidad->titular;
						$dataReporte[$cont]['coleccionNumero'] 		= $data->registros->numero_registro;
						$dataReporte[$cont]['coleccionFecha'] 		= $data->registros->fecha_dil;
						$dataReporte[$cont]['reporteNombre'] 		= $data->nombre;
						$dataReporte[$cont]['reporteAcronimo'] 		= $data->acronimo;
						$dataReporte[$cont]['reporteFundacion'] 	= $data->fecha_fund;
						$dataReporte[$cont]['reporteDescripcion'] 	= $data->descripcion;
						$dataReporte[$cont]['reporteDireccion'] 	= $data->direccion;
						$dataReporte[$cont]['reporteCiudad'] 		= isset($data->county->county_name) ? $data->county->county_name : "";
						$dataReporte[$cont]['reporteTelefono'] 		= $data->telefono;
						$dataReporte[$cont]['reporteEmail'] 		= $data->email;
						$dataReporte[$cont]['coberturaTaxonomica'] 	= $data->cobertura_tax;
						$dataReporte[$cont]['coberturaGeografica'] 	= $data->cobertura_geog;
						$dataReporte[$cont]['coberturaTemporal'] 	= $data->cobertura_temp;
						
						if(isset($data->tamano_coleccion[$k])){
							$dataReporte[$cont]['tamanoTipo'] 			= $data->tamano_coleccion[$k]->tipo_preservacion;
							$dataReporte[$cont]['tamanoUnidad'] 		= $data->tamano_coleccion[$k]->unidad_medida;
							//$dataReporte[$cont]['tamanoCantidad']		= $data->tamano_coleccion[$k]->cantidad;
						}else {
							$dataReporte[$cont]['tamanoTipo'] 			= "-";
							$dataReporte[$cont]['tamanoUnidad'] 		= "-";
							//$dataReporte[$cont]['tamanoCantidad']		= "-";
						}
						
						if(isset($data->composicion_general[$k])){
							$dataReporte[$cont]['nivelGrupo']			= $data->composicion_general[$k]->grupo_taxonomico;
							$dataReporte[$cont]['nivelEjemplares']		= $data->composicion_general[$k]->numero_ejemplares;
							$dataReporte[$cont]['nivelCatalogados']		= $data->composicion_general[$k]->numero_catalogados;
							$dataReporte[$cont]['nivelSistematizados']	= $data->composicion_general[$k]->numero_sistematizados;
							$dataReporte[$cont]['nivelOrden']			= isset($data->composicion_general[$k]->numero_nivel_orden) ? $data->composicion_general[$k]->numero_nivel_orden : "";
							$dataReporte[$cont]['nivelFamilia']			= $data->composicion_general[$k]->numero_nivel_familia;
							$dataReporte[$cont]['nivelGenero']			= $data->composicion_general[$k]->numero_nivel_genero;
							$dataReporte[$cont]['nivelEspecie']			= $data->composicion_general[$k]->numero_nivel_especie;
							$dataReporte[$cont]['sistematizacion']		= $data->sistematizacion;
						}else {
							$dataReporte[$cont]['nivelGrupo']			= "-";
							$dataReporte[$cont]['nivelEjemplares']		= "-";
							$dataReporte[$cont]['nivelCatalogados']		= "-";
							$dataReporte[$cont]['nivelSistematizados']	= "-";
							$dataReporte[$cont]['nivelFamilia']			= "-";
							$dataReporte[$cont]['nivelGenero']			= "-";
							$dataReporte[$cont]['nivelEspecie']			= "-";
						}
							
						if(isset($data->tipos_en_coleccion[$k])){
							$dataReporte[$cont]['tipoGrupo']			= $data->tipos_en_coleccion[$k]->grupo;
							$dataReporte[$cont]['tipoEjemplar']			= $data->tipos_en_coleccion[$k]->informacion_ejemplar;
							$dataReporte[$cont]['tipoNombreCientifico']	= $data->tipos_en_coleccion[$k]->nombre_cientifico;
							//$dataReporte[$cont]['tipoCantidad']			= $data->tipos_en_coleccion[$k]->cantidad;
						}else {
							$dataReporte[$cont]['tipoEjemplar']			= "-";
							//$dataReporte[$cont]['tipoCantidad']			= "-";
						}
						
						$dataReporte[$cont]['documentoAnexos']			= $data->listado_anexos;
						$dataReporte[$cont]['informacionAdicional']		= $data->info_adicional;
						$dataReporte[$cont]['informacionPagina']		= $data->pagina_web;
						
						$dataReporte[$cont]['contactoNombre']			= $data->contactos->nombre;
						$dataReporte[$cont]['contactoCargo']			= $data->contactos->cargo;
						$dataReporte[$cont]['contactoDependencia']		= $data->contactos->dependencia;
						$dataReporte[$cont]['contactoDireccion']		= $data->contactos->direccion;
						$dataReporte[$cont]['contactoCiudad']			= $data->contactos->county->county_name;
						$dataReporte[$cont]['contactoTelefono']			= $data->contactos->telefono;
						$dataReporte[$cont]['contactoEmail']			= $data->contactos->email;
						$cont++;
					}					
					
					
				}
				
				
				// get a reference to the path of PHPExcel classes
				$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');
				
				// Turn off our amazing library autoload
				spl_autoload_unregister(array('YiiBase','autoload'));
				
				// making use of our reference, include the main class
				// when we do this, phpExcel has its own autoload registration
				// procedure (PHPExcel_Autoloader::Register();)
				include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
				
				$objPhpExcel = new PHPExcel();
				
				// Once we have finished using the library, give back the
				// power to Yii...
				spl_autoload_register(array('YiiBase','autoload'));
				
				$objPhpExcel->getProperties()->setCreator("Instituto Alexander Von Humboldt")
							->setTitle("Bitácora Colecciones")
							->setSubject("Bitácora Colecciones")
							->setDescription("Reporte detallado de las Colecciones Existentes");
				
				$objPhpExcel->getActiveSheet()->setTitle('Reporte RNC');
				
				$dataExcel = array();
				
				foreach ($dataReporte as $k => $value){
					$abc = 65;
					$mayor = false;
					foreach ($value as $j => $valueData){
						if($_POST['Reporte'][$j] == 1){//echo $abc."/";
							$alfa = chr($abc);
							if($abc > 90){
								$abc = 65;
								$mayor = true;
								$alfa = chr(65).chr($abc);
							}else if($mayor){
								$alfa = chr(65).chr($abc);
							}
							$objPhpExcel->setActiveSheetIndex(0) -> setCellValue($alfa.($k + 1), $valueData);
							$abc++;
						}
					}
				}
				
				//print_r($objPhpExcel);
				//Yii::app()->end();
				header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="ReporteRnc.xlsx"');
				header('Cache-control: max-age=1');
				
				$objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, 'Excel2007');
				$objWriter->save('php://output');
				Yii::app()->end();
				
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