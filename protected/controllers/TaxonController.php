<?php

class TaxonController extends Controller{
	
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';
	private $model;
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
				'postOnly + delete', // we only allow deletion via POST request
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
						'actions'=>array('index','search','test','view'),
						'users'=>array('*'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update'),
						'users'=>array('@'),
				),
		);
	}
	
	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		
	}
	
	public function actionBusqueda(){
		$this->model	= new Taxontree();
		
		if(isset($_REQUEST['Taxontree']['nombresTaxones']) && $_REQUEST['Taxontree']['nombresTaxones'] != '')
		{
			$this->model->setNombresTaxones($_REQUEST['Taxontree']['nombresTaxones']);
			$datosTaxones = $this->model->search();
			
			$this->renderPartial('_taxones_lista', array('listTaxones' => $datosTaxones));
			Yii::app()->end();
			
		}else {
			$this->render('index',array('model'=>$this->model));
		}
	}
	
	public function actionReadFile(){
		
			$dir		= "tmp/";
			$nombre		= $dir.$_REQUEST['archivo'];
			
			$dataArray 	= array();
			
			if($_REQUEST['tipo'] == ".xls" || $_REQUEST['tipo'] == ".xlsx"){
				
				// get a reference to the path of PHPExcel classes
				$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');
				
				// Turn off our amazing library autoload
				spl_autoload_unregister(array('YiiBase','autoload'));
				
				// making use of our reference, include the main class
				// when we do this, phpExcel has its own autoload registration
				// procedure (PHPExcel_Autoloader::Register();)
				include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
				
				//Yii::import('ext.phpexcel.Classes.PHPExcel', true);
				include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel'. DIRECTORY_SEPARATOR .'IOFactory.php');
				
				spl_autoload_register(array('YiiBase','autoload'));
				
				if($_REQUEST['tipo'] == ".xls"){
					$dataInfo = new PHPExcel_Reader_Excel5();
				}else if ($_REQUEST['tipo'] == ".xlsx") {
					$dataInfo = new PHPExcel_Reader_Excel2007();
				}
				
				$dataPhpExcel = $dataInfo->load($nombre);

				$dataArrayAux = $dataPhpExcel->getActiveSheet()->toArray(null,true,true,true);
				
				for ($i = 1; $i <= count($dataArrayAux); $i++) {
					$dataArray[] = $dataArrayAux[$i]['A']; 
				}
				
			}
			else if($_REQUEST['tipo'] == ".txt" || $_REQUEST['tipo'] == ".csv")
			{
				$dataArray = file($nombre,FILE_IGNORE_NEW_LINES);
			}
			else if($_REQUEST['tipo'] == ".csv")
			{
				if(($gestor = fopen($nombre, "r")) !== FALSE)
				{
					while (($dataArray = fgetcsv($gestor,0,",")) !== FALSE){}
					
					fclose($gestor);
				}
			}
			
			if(count($dataArray) > 0)
			{
				$dataRead = implode("\r", $dataArray);
				unlink($nombre);
				echo $dataRead;
			}
	}
	
	public function actionUpdateajaxmodifyTables(){
		
	}
	
	public function actionExportData($datos = array()){
				
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
		
		$objPhpExcel->getProperties()->setCreator("SIB Colombia")
									 ->setTitle("Resultados Taxonómicos")
									 ->setSubject("Resultados Taxonómicos")
									 ->setDescription("Resultados de la búsqueda de taxones");
		
		$objPhpExcel->setActiveSheetIndex(0)
					->setCellValue('A1', '#')
					->setCellValue('B1', 'Taxón')
					->setCellValue('C1', 'Reino')
					->setCellValue('D1', 'Reino ID')
					->setCellValue('E1', 'Phylum')
					->setCellValue('F1', 'Phylum ID')
					->setCellValue('G1', 'Clase')
					->setCellValue('H1', 'Clase ID')
					->setCellValue('I1', 'Orden')
					->setCellValue('J1', 'Orden ID')
					->setCellValue('K1', 'Familia')
					->setCellValue('L1', 'Familia ID')
					->setCellValue('M1', 'Género')
					->setCellValue('N1', 'Género ID')
					->setCellValue('O1', 'Epíteto Específico')
					->setCellValue('P1', 'Epíteto Infraespecífico')
					->setCellValue('Q1', 'Rango')
					->setCellValue('R1', 'Autor')
					->setCellValue('S1', 'Nombre Científico')
					->setCellValue('T1', 'LSID');
		
		$objPhpExcel->getActiveSheet()->setTitle('Taxonomía');
		
		$this->model	= new Taxontree();
		$datos_ar 		= array();	
		if(isset($_REQUEST['Taxontree']['datosExportar']) && $_REQUEST['Taxontree']['datosExportar'] != '')
		{
			$this->model->setNombresTaxones($_REQUEST['Taxontree']['datosExportar']);
			$this->model->search();
			$datos_ar = $this->model->datosExportar;
			$keysData = array_keys($datos_ar);
			$dataExport = array();
			
			for ($i = 0; $i < count($datos_ar); $i++) {
				$key = $keysData[$i];
				$dataExport[$i][9]['name']		= (isset($datos_ar[$key][9]['name'])) ? $datos_ar[$key][9]['name'] : $datos_ar[$key];
				$dataExport[$i][8]['name']		= (isset($datos_ar[$key][8]['name'])) ? $datos_ar[$key][8]['name'] : "-";
				$dataExport[$i][8]['lsid']		= (isset($datos_ar[$key][8]['lsid'])) ? $datos_ar[$key][8]['lsid'] : "-";
				$dataExport[$i][7]['name']		= (isset($datos_ar[$key][7]['name'])) ? $datos_ar[$key][7]['name'] : "-";
				$dataExport[$i][7]['lsid']		= (isset($datos_ar[$key][7]['lsid'])) ? $datos_ar[$key][7]['lsid'] : "-";
				$dataExport[$i][6]['name']		= (isset($datos_ar[$key][6]['name'])) ? $datos_ar[$key][6]['name'] : "-";
				$dataExport[$i][6]['lsid']		= (isset($datos_ar[$key][6]['lsid'])) ? $datos_ar[$key][6]['lsid'] : "-";
				$dataExport[$i][5]['name']		= (isset($datos_ar[$key][5]['name'])) ? $datos_ar[$key][5]['name'] : "-";
				$dataExport[$i][5]['lsid']		= (isset($datos_ar[$key][5]['lsid'])) ? $datos_ar[$key][5]['lsid'] : "-";
				$dataExport[$i][4]['name']		= (isset($datos_ar[$key][4]['name'])) ? $datos_ar[$key][4]['name'] : "-";
				$dataExport[$i][4]['lsid']		= (isset($datos_ar[$key][4]['lsid'])) ? $datos_ar[$key][4]['lsid'] : "-";
				$dataExport[$i][3]['name']		= (isset($datos_ar[$key][3]['name'])) ? $datos_ar[$key][3]['name'] : "-";
				$dataExport[$i][3]['lsid']		= (isset($datos_ar[$key][3]['lsid'])) ? $datos_ar[$key][3]['lsid'] : "-";
				$dataExport[$i][2]['name']		= (isset($datos_ar[$key][2]['name'])) ? $datos_ar[$key][2]['name'] : "-";
				$dataExport[$i][2]['lsid']		= (isset($datos_ar[$key][2]['lsid'])) ? $datos_ar[$key][2]['lsid'] : "-";
				$dataExport[$i][1]['name']		= (isset($datos_ar[$key][1]['name'])) ? $datos_ar[$key][1]['name'] : "-";
				$dataExport[$i][1]['lsid']		= (isset($datos_ar[$key][1]['lsid'])) ? $datos_ar[$key][1]['lsid'] : "-";
				$dataExport[$i][0]['name']		= (isset($datos_ar[$key][0]['name'])) ? $datos_ar[$key][0]['name'] : "-";
				$dataExport[$i][0]['lsid']		= (isset($datos_ar[$key][0]['lsid'])) ? $datos_ar[$key][0]['lsid'] : "-";
				
				$objPhpExcel->setActiveSheetIndex(0)
							->setCellValue('A'.($i+2), $i+1)
							->setCellValue('B'.($i+2), $dataExport[$i][9]['name'])
							->setCellValue('C'.($i+2), $dataExport[$i][8]['name'])
							->setCellValue('D'.($i+2), $dataExport[$i][8]['lsid'])
							->setCellValue('E'.($i+2), $dataExport[$i][7]['name'])
							->setCellValue('F'.($i+2), $dataExport[$i][7]['lsid'])
							->setCellValue('G'.($i+2), $dataExport[$i][6]['name'])
							->setCellValue('H'.($i+2), $dataExport[$i][6]['lsid'])
							->setCellValue('I'.($i+2), $dataExport[$i][5]['name'])
							->setCellValue('J'.($i+2), $dataExport[$i][5]['lsid'])
							->setCellValue('K'.($i+2), $dataExport[$i][4]['name'])
							->setCellValue('L'.($i+2), $dataExport[$i][4]['lsid'])
							->setCellValue('M'.($i+2), $dataExport[$i][3]['name'])
							->setCellValue('N'.($i+2), $dataExport[$i][3]['lsid'])
							->setCellValue('O'.($i+2), $dataExport[$i][2]['name'])
							->setCellValue('P'.($i+2), $dataExport[$i][2]['lsid'])
							->setCellValue('Q'.($i+2), $dataExport[$i][1]['name'])
							->setCellValue('R'.($i+2), $dataExport[$i][1]['lsid'])
							->setCellValue('S'.($i+2), $dataExport[$i][0]['name'])
							->setCellValue('T'.($i+2), $dataExport[$i][0]['lsid']);
			}
		}
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="BusquedaTaxonomica.xlsx"');
		header('Cache-control: max-age=1');
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, 'Excel2007');
		$objWriter->save('php://output');
		Yii::app()->end();
		
	}
	
}