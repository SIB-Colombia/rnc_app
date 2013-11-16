<?php

class CatalogoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

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
				'actions'=>array('test','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','admin','delete','updateajaxmodifytables', 'deleteattribute'),
				//'users'=>array('amsuarez'),
				'roles'=>array('admin'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
					'actions'=>array('index','create','update','updateajaxmodifytables'),
					//'users'=>array('amsuarez'),
					'roles'=>array('editor'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Catalogoespecies;
		$citaciones= new Citacion('search');
		$contactos= new Contactos('search');
		$contactos->unsetAttributes(); // clear any default values
		$citaciones->unsetAttributes();  // clear any default values

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
		
		//if(isset($_POST['ajax']) && $_POST['ajax']==='catalogoespecies-form')
			
		if(Yii::app()->request->getIsAjaxRequest() && isset($_GET["ajax"]))
		{
			if($_GET['ajax'] === "citaciones-grid") {
				if(isset($_GET['Citacion']))
					$citaciones->attributes=$_GET['Citacion'];
				$this->renderPartial('_obras_citadas_admin_table', array('citaciones' => $citaciones));
				Yii::app()->end();
			} else if($_GET['ajax'] === "contactos-grid") {
				if(isset($_GET['Contactos']))
					$contactos->attributes=$_GET['Contactos'];
				$this->renderPartial('_contacto_ficha_admin_table', array('contactos' => $contactos));
				Yii::app()->end();
			}
		} else {
			if(isset($_POST['Catalogoespecies']))
			{
				$model->attributes=$_POST['Catalogoespecies'];
				$verificacion=new Verificacionce();
				$datosTaxonomicos=new PcaatCe();
				$model->validate();
				yii::log(var_dump($model->getErrors()));
				yii::log($model->getErrors());
				
				$success_saving_all = true;
				
				$transaction = Yii::app()->db->beginTransaction();
				
				try {
					// save the artist
					$model->save(false);
					
					// Guardar datos de verificación
					$verificacion->catalogoespecies_id=$model->catalogoespecies_id;
					
					// Guardo en contacto_id el correo electrónico del contacto
					$contacto=Contactos::model()->findByPk($model->contacto_id);
					$verificacion->contacto_id=$contacto->correo_electronico;
					
					// Guardo en contactoresponsable_id el correo electrónico del usuario que ingresó al sistema
					$contactoResponsable=Contactos::model()->findByPk(Yii::app()->user->getId());
					$verificacion->contactoresponsable_id=$contactoResponsable->correo_electronico;
					
					$verificacion->estado_id=$model->idEstadoVerificacion;
					$verificacion->fecha=$model->fechaactualizacion;
					$verificacion->comentarios=$model->comentarioVerificacion;
					
					$verificacion->validate();
					yii::log(var_dump($verificacion->getErrors()));
					yii::log($verificacion->getErrors());
					$verificacion->save(false);
					
					$model->verificacionce=$verificacion;
					// Fin de guardado datos de verificacion
					
					// Guardar datos taxonómicos
					$datosTaxonomicos->catalogoespecies_id=$model->catalogoespecies_id;
					$datosTaxonomicos->taxonnombre=$model->taxonNombre;
					$datosTaxonomicos->taxoncompleto=$model->jerarquiaTaxonomica;
					$datosTaxonomicos->autor=$model->autor;
					$datosTaxonomicos->paginaweb=$model->paginaWeb;
					$datosTaxonomicos->validate();
					yii::log(var_dump($datosTaxonomicos->getErrors()));
					yii::log($datosTaxonomicos->getErrors());
					$datosTaxonomicos->save(false);
					$model->pcaatCe=$datosTaxonomicos;
					
					$model->save(false);
					$transaction->commit();
				} catch (Exception $e) {
					$transaction->rollback();
					Yii::log("Error occurred while saving catalog species data. Rolling back... . Failure reason as reported in exception: " . $e->getMessage(), 'error');
					$success_saving_all = false;
				}
				
				if($success_saving_all) {
					$this->redirect(array('view','id'=>$model->catalogoespecies_id));
				} else {
					//$this->redirect(array("catalogo/index"));
				}
			}
		
			$date = date('Y-m-d');
		
			$model->fechaelaboracion=$date;
			$model->fechaactualizacion=$date;

			$this->render('create',array(
				'model'=>$model,
				'citaciones'=>$citaciones,
				'contactos'=>$contactos,
			));
		}
	}
	
	public function actionUpdateajaxmodifytables()
	{
		$citaciones= new Citacion('search');
		$contactos= new Contactos('search');
		$nombresComunes=new PctesaurosCe('search'); // Lista de nombres comunes disponibles
		$departamentos=new Departamentos('search'); // Lista de departamentos
		$corporaciones=new Corporaciones('search'); // Lista de corporaciones
		$regionesNaturales=new Regionesnaturales('search'); // Lista de regiones naturales
		$organizaciones=new Organizaciones('search'); // Lista de organizaciones
		$contactos->unsetAttributes(); // clear any default values
		$citaciones->unsetAttributes();  // clear any default values
		$nombresComunes->unsetAttributes();  // clear any default values
		$departamentos->unsetAttributes();  // clear any default values
		$corporaciones->unsetAttributes();  // clear any default values
		$regionesNaturales->unsetAttributes();  // clear any default values
		$organizaciones->unsetAttributes();  // clear any default values
		
		if(Yii::app()->request->getIsAjaxRequest() && isset($_GET["ajax"]))
		{
			if($_GET['ajax'] === "citaciones-grid") {
				if(isset($_GET['Citacion']))
					$citaciones->attributes=$_GET['Citacion'];
				$this->renderPartial('_obras_citadas_update_table', array('citaciones' => $citaciones));
				Yii::app()->end();
			} else if($_GET['ajax'] === "contactos-grid") {
				if(isset($_GET['Contactos']))
					$contactos->attributes=$_GET['Contactos'];
				$this->renderPartial('_contacto_ficha_update_table', array('contactos' => $contactos));
				Yii::app()->end();
			} else if($_GET['ajax'] === "nombrescomunes-grid") {
				if(isset($_GET['PctesaurosCe']))
					$nombresComunes->attributes=$_GET['PctesaurosCe'];
				$this->renderPartial('_nombres_comunes_ficha_update_table', array('nombresComunes' => $nombresComunes, 'idCatalogo'=>$this->id));
				Yii::app()->end();
			} else if($_GET['ajax'] === "departamentos-grid") {
				if(isset($_GET['Departamentos']))
					$departamentos->attributes=$_GET['Departamentos'];
				$this->renderPartial('_departamentos_ficha_update_table', array('departamentos' => $departamentos, 'idCatalogo'=>$this->id));
				Yii::app()->end();
			} else if($_GET['ajax'] === "corporaciones-grid") {
				if(isset($_GET['Corporaciones']))
					$corporaciones->attributes=$_GET['Corporaciones'];
				$this->renderPartial('_corporaciones_ficha_update_table', array('corporaciones' => $corporaciones, 'idCatalogo'=>$this->id));
				Yii::app()->end();
			} else if($_GET['ajax'] === "regionesnaturales-grid") {
				if(isset($_GET['Regionesnaturales']))
					$regionesNaturales->attributes=$_GET['Regionesnaturales'];
				$this->renderPartial('_regiones_naturales_ficha_update_table', array('regionesNaturales' => $regionesNaturales, 'idCatalogo'=>$this->id));
				Yii::app()->end();
			} else if($_GET['ajax'] === "organizaciones-grid") {
				if(isset($_GET['Organizaciones']))
					$organizaciones->attributes=$_GET['Organizaciones'];
				$this->renderPartial('_organizaciones_ficha_update_table', array('organizaciones' => $organizaciones, 'idCatalogo'=>$this->id));
				Yii::app()->end();
			}
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$citaciones= new Citacion('search');
		$contactos= new Contactos('search');
		$nombresComunes=new PctesaurosCe('search'); // Lista de nombres comunes disponibles
		$departamentos=new Departamentos('search'); // Lista de departamentos disponibles
		$corporaciones=new Corporaciones('search'); // Lista de corporaciones disponibles
		$regionesNaturales=new Regionesnaturales('search'); // Lista de regiones naturales disponibles
		$organizaciones=new Organizaciones('serach'); // Lista de organizaciones disponibles
		$contactos->unsetAttributes(); // clear any default values
		$citaciones->unsetAttributes();  // clear any default values
		$nombresComunes->unsetAttributes();  // clear any default values
		$departamentos->unsetAttributes(); // clear any default values
		$corporaciones->unsetAttributes(); // clear any default values
		$regionesNaturales->unsetAttributes(); // clear any default values
		$organizaciones->unsetAttributes(); // clear any default values
		
		// Asigno variables virtuales
		$model->idEstadoVerificacion=$model->verificacionce->estado_id;
		$model->comentarioVerificacion=$model->verificacionce->comentarios;
		$model->jerarquiaTaxonomica=$model->pcaatCe->taxoncompleto;
		$model->taxonNombre=$model->pcaatCe->taxonnombre;
		$model->autor=$model->pcaatCe->autor;
		$model->paginaWeb=$model->pcaatCe->paginaweb;
		$datosCitaActual=Citacion::model()->findByPk($model->citacion_id);
		$model->tituloCita=$datosCitaActual->documento_titulo;
		$model->autorCita=$datosCitaActual->autor;
		$datosContactoActual=Contactos::model()->findByPk($model->contacto_id);
		$model->personaContacto=$datosContactoActual->persona;
		$model->organizacionContacto=$datosContactoActual->organizacion;
		
		$atributos["Distribución altitudinal"]=array(); // 1
		$atributos["Estado de amenaza según categorías UICN"]=array(); // 2
		$atributos["Estado CITES"]=array(); // 5
		$atributos["Factores de amenaza"]=array(); // 6
		$atributos["Estado actual de la población"]=array(); // 7
		$atributos["Distribución geográfica en Colombia"]=array(); // 8
		$atributos["Ecosistema"]=array(); // 10
		$atributos["Región natural"]=array(); // 11
		$atributos["Descripción taxonómica"]=array(); // 12
		$atributos["Información de usos"]=array(); // 14
		$atributos["Información de alerta"]=array(); // 15
		$atributos["Medidas de conservación"]=array(); // 16
		$atributos["Ecología"]=array(); // 17
		$atributos["Otros recursos en Internet"]=array(); // 18
		$atributos["Autor(es)"]=array(); // 19
		$atributos["Editor(es)"]=array(); // 20
		$atributos["Recursos multimedia"]=array(); // 21
		$atributos["Alimentación"]=array(); // 22
		$atributos["Colaborador(es)"]=array(); // 24
		$atributos["Revisor(es)"]=array(); // 25
		$atributos["Comportamiento"]=array(); // 26
		$atributos["Claves taxonómicas"]=array(); // 27
		$atributos["Referencias bibliográficas"]=array(); // 28
		$atributos["Etimología del nombre científico"]=array(); // 30
		$atributos["Hábitat"]=array(); // 31
		$atributos["Vocalizaciones"]=array(); // 32
		$atributos["Reproducción"]=array(); // 35
		$atributos["Descripción general"]=array(); // 36
		$atributos["Imagen"]=array(); // 39
		$atributos["Mapa"]=array(); // 40
		$atributos["Video"]=array(); // 41
		$atributos["Sonido"]=array(); // 42
		$atributos["Créditos específicos"]=array(); // 436
		$atributos["Descripción de la invasión"]=array(); // 3529
		$atributos["Distribución geográfica en el mundo"]=array(); // 148
		$atributos["Hábito"]=array(); // 903
		$atributos["Impactos"]=array(); // 3530
		$atributos["Información de tipos"]=array(); // 150
		$atributos["Invasora"]=array(); // 6784
		$atributos["Mecanismos de control"]=array(); // 3531
		$atributos["Metadatos"]=array(); // 437
		$atributos["Origen"]=array(); // 904
		$atributos["Registros biológicos"]=array(); // 149
		$atributos["Sinónimos"]=array(); // 32210
		foreach($model->ceAtributovalors as $ceAtributoValor) {
			if($ceAtributoValor->etiqueta == "1") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Distribución altitudinal"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "2") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Estado de amenaza según categorías UICN"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "3") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				$atributos["Estado de amenaza según categorías UICN"]["En Colombia"] = array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor);
			} else if($ceAtributoValor->etiqueta == "4") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				$atributos["Estado de amenaza según categorías UICN"]["En el mundo"] = array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor);
			} else if($ceAtributoValor->etiqueta == "5") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Estado CITES"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "6") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Factores de amenaza"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "7") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Estado actual de la población"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "8") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Distribución geográfica en Colombia"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "10") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Ecosistema"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "11") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Región natural"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "12") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Descripción taxonómica"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "14") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Información de usos"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "15") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Información de alerta"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "16") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Medidas de conservación"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "17") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Ecología"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "18") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Otros recursos en Internet"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "19") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$autor=Contactos::model()->findByPk($atributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Autor(es)"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$autor->persona.', '.$autor->organizacion.', '.$autor->correo_electronico.', '.$autor->direccion));
			} else if($ceAtributoValor->etiqueta == "20") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$autor=Contactos::model()->findByPk($atributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Editor(es)"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$autor->persona.', '.$autor->organizacion.', '.$autor->correo_electronico.', '.$autor->direccion));
			} else if($ceAtributoValor->etiqueta == "21") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Recursos multimedia"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "22") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Alimentación"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "24") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$autor=Contactos::model()->findByPk($atributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Colaborador(es)"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$autor->persona.', '.$autor->organizacion.', '.$autor->correo_electronico.', '.$autor->direccion));
			} else if($ceAtributoValor->etiqueta == "25") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$autor=Contactos::model()->findByPk($atributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Revisor(es)"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$autor->persona.', '.$autor->organizacion.', '.$autor->correo_electronico.', '.$autor->direccion));
			} else if($ceAtributoValor->etiqueta == "26") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Comportamiento"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "27") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Claves taxonómicas"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "28") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$citacion=Citacion::model()->findByPk($atributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Referencias bibliográficas"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$citacion->autor.', '.$citacion->fecha.', '.$citacion->documento_titulo.', '.$citacion->editor.', '.$citacion->publicador.', '.$citacion->editorial.', '.$citacion->lugar_publicacion.', '.$citacion->hipervinculo));
			} else if($ceAtributoValor->etiqueta == "30") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Etimología del nombre científico"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "31") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Hábitat"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "32") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Vocalizaciones"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "35") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Reproducción"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "36") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Descripción general"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "39") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Imagen"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor, 'nombreCientifico'=>$model->pcaatCe->taxonnombre, 'autor'=>$model->pcaatCe->autor));
			} else if($ceAtributoValor->etiqueta == "40") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Mapa"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "41") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Video"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "42") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Sonido"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "436") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Créditos específicos"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "3529") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Descripción de la invasión"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "148") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Distribución geográfica en el mundo"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "903") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Hábito"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "3530") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Impactos"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "150") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Información de tipos"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "6784") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Invasora"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "3531") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Mecanismos de control"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "437") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Metadatos"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "904") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Origen"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "149") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Registros biológicos"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			} else if($ceAtributoValor->etiqueta == "32210") {
				$atributoValor=Atributovalor::model()->findByPk($ceAtributoValor->valor);
				$etiquetaValor=Atributovalor::model()->findByPk($ceAtributoValor->etiqueta);
				array_push($atributos["Sinónimos"], array('ceatributovalor_id'=>$ceAtributoValor->ceatributovalor_id, 'etiqueta'=>$ceAtributoValor->etiqueta, 'valor'=>$ceAtributoValor->valor, 'etiquetaValor'=>$etiquetaValor->valor, 'contenido'=>$atributoValor->valor));
			}
		}
		//Yii::trace(CVarDumper::dumpAsString($atributos),'vardump');
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Catalogoespecies']))
		{	
			$model->attributes=$_POST['Catalogoespecies'];
			
			$model->validate();
			yii::log(var_dump($model->getErrors()));
			yii::log($model->getErrors());
				
			$success_saving_all = true;
				
			$transaction = Yii::app()->db->beginTransaction();
			
			try {
				// Almaceno datos de verificación
				// Guardo en contacto_id el correo electrónico del contacto
				$contacto=Contactos::model()->findByPk($model->contacto_id);
				$model->verificacionce->contacto_id=$contacto->correo_electronico;
					
				// Guardo en contactoresponsable_id el correo electrónico del usuario que ingresó al sistema
				$contactoResponsable=Contactos::model()->findByPk(Yii::app()->user->getId());
				$model->verificacionce->contactoresponsable_id=$contactoResponsable->correo_electronico;
				
				$model->verificacionce->estado_id=$model->idEstadoVerificacion;
				$model->verificacionce->fecha=$model->fechaactualizacion;
				$model->verificacionce->comentarios=$model->comentarioVerificacion;
				// Fin de almacenamiento datos de verificación
				
				// Guardar datos taxonómicos
				$model->pcaatCe->taxonnombre=$model->taxonNombre;
				$model->pcaatCe->taxoncompleto=$model->jerarquiaTaxonomica;
				$model->pcaatCe->autor=$model->autor;
				$model->pcaatCe->paginaweb=$model->paginaWeb;
				// Fin de guardar datos taxonómicos
				
				$model->validate();
				yii::log(var_dump($model->getErrors()));
				yii::log($model->getErrors());
				
				$model->verificacionce->save(false);
				$model->pcaatCe->save(false);
				$model->save(false);
						
				$transaction->commit();
			} catch (Exception $e) {
				$transaction->rollback();
				Yii::log("Error occurred while saving catalog species data. Rolling back... . Failure reason as reported in exception: " . $e->getMessage(), 'error');
				$success_saving_all = false;
			}
			
			if($success_saving_all) {
				$this->redirect(array('view','id'=>$model->catalogoespecies_id));
			} else {
				$this->redirect(array("catalogo/index"));
			}
		}
		
		$date = date('Y-m-d');
			
		$model->fechaactualizacion=$date;
		
		$this->render('update',array(
			'model'=>$model,
			'citaciones'=>$citaciones,
			'contactos'=>$contactos,
			'nombresComunes'=>$nombresComunes,
			'departamentos'=>$departamentos,
			'corporaciones'=>$corporaciones,
			'regionesNaturales'=>$regionesNaturales,
			'organizaciones'=>$organizaciones,
			'atributos'=>$atributos,
		));
	}
	
	public function actionDeleteattribute()
	{
		if(isset($_GET["ajax"]))
		{
			if(isset($_GET["idAtributo"])) {
				$ceAttributeValue = CeAtributovalor::model()->findByAttributes(array('valor'=>$_GET["idAtributo"]))->delete();
				$attributeValue= Atributovalor::model()->findByPk($_GET["idAtributo"])->delete();
			}
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(isset($_GET["ajax"]))
		{
			// Solicitud de eliminación mediante AJAX
			if($_GET['ajax'] === "nombrescomunesasignados-grid") {
				if(isset($_GET["idTesauro"])) {
					$transaction = Yii::app()->db->beginTransaction();
					try {
						$success_deleting_all = true;
						
						PctesaurosCe::model()->findByPk($_GET["idTesauro"])->delete();
						
						$transaction->commit();
					} catch (Exception $e) {
						$transaction->rollback();
						Yii::log("Error occurred while deleting common name data. Rolling back... . Failure reason as reported in exception: " . $e->getMessage(), 'error');
						$success_deleting_all = false;
					}
					
					if($success_deleting_all) {
						$model=$this->loadModel($id);
					}
				}
			} else if($_GET['ajax'] === "departamentosasignados-grid") {
				if(isset($_GET["idDepartamento"])) {
					$transaction = Yii::app()->db->beginTransaction();
					try {
						$success_deleting_all = true;
				
						PcdepartamentosCe::model()->findByAttributes(array('catalogoespecies_id'=>$id,'id_departamento'=>$_GET["idDepartamento"]))->delete();
				
						$transaction->commit();
					} catch (Exception $e) {
						$transaction->rollback();
						Yii::log("Error occurred while deleting department data. Rolling back... . Failure reason as reported in exception: " . $e->getMessage(), 'error');
						$success_deleting_all = false;
					}
						
					if($success_deleting_all) {
						$model=$this->loadModel($id);
					}
				}
			} else if($_GET['ajax'] === "regionesnaturalessasignadas-grid") {
				if(isset($_GET["idRegionNatural"])) {
					$transaction = Yii::app()->db->beginTransaction();
					try {
						$success_deleting_all = true;
				
						PcregionnaturalCe::model()->findByAttributes(array('catalogoespecies_id'=>$id,'id_region_natural'=>$_GET["idRegionNatural"]))->delete();
				
						$transaction->commit();
					} catch (Exception $e) {
						$transaction->rollback();
						Yii::log("Error occurred while deleting natural region data. Rolling back... . Failure reason as reported in exception: " . $e->getMessage(), 'error');
						$success_deleting_all = false;
					}
						
					if($success_deleting_all) {
						$model=$this->loadModel($id);
					}
				}
			} else if($_GET['ajax'] === "corporacionesasignadas-grid") {
				if(isset($_GET["idCorporacion"])) {
					$transaction = Yii::app()->db->beginTransaction();
					try {
						$success_deleting_all = true;
				
						PccorporacionesCe::model()->findByAttributes(array('catalogoespecies_id'=>$id,'id_corporacion'=>$_GET["idCorporacion"]))->delete();
				
						$transaction->commit();
					} catch (Exception $e) {
						$transaction->rollback();
						Yii::log("Error occurred while deleting CAR data. Rolling back... . Failure reason as reported in exception: " . $e->getMessage(), 'error');
						$success_deleting_all = false;
					}
						
					if($success_deleting_all) {
						$model=$this->loadModel($id);
					}
				}
			} else if($_GET['ajax'] === "organizacionesasignadas-grid") {
				if(isset($_GET["idOrganizacion"])) {
					$transaction = Yii::app()->db->beginTransaction();
					try {
						$success_deleting_all = true;
				
						PcorganizacionesCe::model()->findByAttributes(array('catalogoespecies_id'=>$id,'id_organizacion'=>$_GET["idOrganizacion"]))->delete();
				
						$transaction->commit();
					} catch (Exception $e) {
						$transaction->rollback();
						Yii::log("Error occurred while deleting organization data. Rolling back... . Failure reason as reported in exception: " . $e->getMessage(), 'error');
						$success_deleting_all = false;
					}
						
					if($success_deleting_all) {
						$model=$this->loadModel($id);
					}
				}
			}
		}
		
		/*$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		*/
	}

	/**
	 * Lists all models.
	 */
	public function actionList()
	{
		$dataProvider=new CActiveDataProvider('Catalogoespecies');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Catalogoespecies('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Catalogoespecies']))
			$model->attributes=$_GET['Catalogoespecies'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Catalogoespecies('search');
		$model2=new Catalogoespeciesrevisadas('search');
		$model3=new Catalogoespeciesnorevisadas('search');
		$model4=new Catalogoespeciesverificadas('search');
		$model->unsetAttributes();  // clear any default values
		$model2->unsetAttributes();  // clear any default values
		$model3->unsetAttributes();  // clear any default values
		$model4->unsetAttributes();  // clear any default values
		
		
		$userRole  = Yii::app()->user->getState("roles");
		
		if ($userRole == "editor"){
			$modelUser	= CatalogoUser::model()->find('username = \''.Yii::app()->user->name.'\'');
			if($modelUser){
				if($modelUser->contacto_id != NULL){
					$modelContacto = Contactos::model()->findByPk($modelUser->contacto_id);
					$emailContacto = $modelContacto->correo_electronico;
					$modelVer 	= Catalogoespecies::model()->with('verificacionce')->findAll('"verificacionce"."contacto_id"=:contactoId', array(':contactoId' => $emailContacto));
					$ids		= array();
					
					if (count($modelVer) > 0) {
						for ($i = 0; $i < count($modelVer); $i++) {
							$ids[] = $modelVer[$i]->catalogoespecies_id;
						}
						$ids_st = implode(",", $ids);
						$model->ids_filter = $ids_st;
						$model2->ids_filter = $ids_st;
						$model3->ids_filter = $ids_st;
						$model4->ids_filter = $ids_st;
					}
					else {
						$model->ids_filter	 = '0';
						
					}
				}
				else{
					$model->ids_filter	 = '0';
				}
				
			}
		}
		
		if(isset($_GET['Catalogoespecies'])) {
			$model->attributes=$_GET['Catalogoespecies'];
		}
		if(isset($_GET['Catalogoespeciesrevisadas'])) {
			$model2->attributes=$_GET['Catalogoespeciesrevisadas'];
		}
		if(isset($_GET['Catalogoespeciesnorevisadas'])) {
			$model3->attributes=$_GET['Catalogoespeciesnorevisadas'];
		}
		if(isset($_GET['Catalogoespeciesverificadas'])) {
			$model4->attributes=$_GET['Catalogoespeciesverificadas'];
		}
		
		if(isset($_GET['ajax']))
		{
			$this->renderPartial('_fichas_existentes_admin_table', array('model' => $model));
			$this->renderPartial('_fichas_revisadas_admin_table', array('revisadas' => $model2));
			$this->renderPartial('_fichas_norevisadas_admin_table', array('norevisadas' => $model3));
			$this->renderPartial('_fichas_verificadas_admin_table', array('verificadas' => $model4));
		} else {
			$this->render('index',array(
				'model'=>$model,
				'revisadas'=>$model2,
				'norevisadas'=>$model3,
				'verificadas'=>$model4
			));
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Catalogoespecies the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Catalogoespecies::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Catalogoespecies $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='catalogoespecies-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
