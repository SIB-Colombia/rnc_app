<?php
class ApiController extends Controller
{
	// Members
	/**
	 * Key which has to be in HTTP USERNAME and PASSWORD headers
	 */
	Const APPLICATION_ID = 'CLIENTE98797876X23V1';

	/**
	 * Default response format
	 * either 'json' or 'xml'
	 */
	private $format = 'json';
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array();
	}

	// Actions

	public function actionCarrusel() {
		// Get the respective model instance
		switch($_GET['model'])
		{
			case 'carrusel':
				if(isset($_GET['count'])) {
					$totalLimit = $_GET['count'];
				} else {
					$totalLimit = '1';
				}
				$fichasConImagen = Yii::app()->db->createCommand()
					->select('catalogoespecies.catalogoespecies_id')
					->from('public.catalogoespecies, public.ce_atributovalor, public.atributos')
					->where("catalogoespecies.catalogoespecies_id = ce_atributovalor.catalogoespecies_id AND ce_atributovalor.id_atributo = atributos.id AND atributos.nombre = 'Imagen'")
					->group('catalogoespecies.catalogoespecies_id')
					->order('random()')
					->limit($totalLimit)
					->queryAll();
				if(is_null($fichasConImagen))
					$this->_sendResponse(404, 'No Items with image has been found with id '.$_GET['id']);
				$rows = array();
				foreach ($fichasConImagen as $value) {
					$model = Catalogoespecies::model()->findByPk($value["catalogoespecies_id"]);
					if(is_null($model)) {
						$this->_sendResponse(404, 'No Item found with id '.$value["catalogoespecies_id"]);
					} else {
						// Prepare response
						$rows[$model->catalogoespecies_id] = $model->attributes;
						if(isset($model->pcaatCe)) {
							$rows[$model->catalogoespecies_id]["info_taxonomica"] = $model->pcaatCe->attributes;
						}
						if(isset($model->pctesaurosCes)) {
							$nombresComunes=$model->pctesaurosCes;
							foreach($nombresComunes as $nombreComun) {
								$rows[$model->catalogoespecies_id]["nombres_comunes"][]=$nombreComun->attributes;
							}
						}
						if(isset($model->ceAtributovalors)) {
							$atributos=$model->ceAtributovalors;
							foreach($atributos as $atributo) {
								if(isset($atributo->atributo)) {
									if($atributo->atributo->nombre == "Imagen") {
										$rows[$model->catalogoespecies_id]["atributos"][$atributo->atributo->nombre][]=$atributo->valor0->valor;
									}
								}
							}
						}
						if(isset($rows[$model->catalogoespecies_id]["atributos"]["Imagen"])) {
							$counterArray=0;
							foreach ($rows[$model->catalogoespecies_id]["atributos"]["Imagen"] as $imagen) {
								$images_path = $_SERVER['DOCUMENT_ROOT'].'/imagen';
								$extension = end(explode('.', $imagen));
								$filename = current(explode('.', $imagen));
								if (!is_dir($images_path.'/resampled/'.$model->catalogoespecies_id)) {
									mkdir($images_path.'/resampled/'.$model->catalogoespecies_id, 0755, true);
								}
								if(!file_exists($images_path.'/resampled/'.$model->catalogoespecies_id.'/'.$filename.'_140x140.'.$extension)) {
									$this->image_resize($images_path.'/'.$imagen, $images_path.'/resampled/'.$model->catalogoespecies_id.'/'.$filename.'_140x140.'.$extension, 140, 140, 1);
								}
								$rows[$model->catalogoespecies_id]["atributos"]["ImagenThumb140"][$counterArray] = 'http://admin.catalogo.local'.Yii::app()->request->baseUrl.'/imagen/resampled/'.$model->catalogoespecies_id.'/'.$filename.'_140x140.'.$extension;
								$rows[$model->catalogoespecies_id]["atributos"]["Imagen"][$counterArray] = 'http://admin.catalogo.local'.'/imagen/'.$imagen;
								$counterArray++;
							}
						}
					}
				}
				$this->_sendResponse(200, CJSON::encode($rows));
				break;
			default:
				// Model not implemented error
				$this->_sendResponse(501, sprintf(
				'Error: Mode <b>carrusel</b> is not implemented for model <b>%s</b>',
				$_GET['model']) );
				Yii::app()->end();
		}
	}

	public function actionList()
	{
		// Get the respective model instance
		switch($_GET['model'])
		{
			case 'fichas':
				if(isset($_GET['page'])) {
					$offset = ($_GET['page'] - 1) * 20;
					$condition= new CDbCriteria();
					$condition->join = 'INNER JOIN "pcaat_ce" "pcaatCe" ON ("pcaatCe"."catalogoespecies_id"="t"."catalogoespecies_id")';
					$condition->join .= 'INNER JOIN "verificacionce" "verificacionce" ON ("verificacionce"."catalogoespecies_id"="t"."catalogoespecies_id")';
					//$condition->with = array('pcaatCe', 'citacion', 'verificacionce', 'pctesaurosCes', 'pcdepartamentosCes', 'pcregionnaturalCes', 'pccorporacionesCes', 'pcorganizacionesCes', 'ceAtributovalors');
					if(isset($_GET['scientificname'])) {
						$condition->compare('LOWER("pcaatCe".taxonnombre)', strtolower($_GET['scientificname']), true );
					}
					if(isset($_GET['taxon'])) {
						$condition->compare('LOWER("pcaatCe".taxoncompleto)', strtolower($_GET['taxon']), true );
					}
					if(isset($_GET['id'])) {
						$condition->compare('t.catalogoespecies_id',$_GET['id']);
					}
					$sql='';
					if(isset($_GET['commonname'])) {
						$sql = "SELECT DISTINCT catalogoespecies.catalogoespecies_id "
							."FROM catalogoespecies "
							."INNER JOIN pctesauros_ce ON catalogoespecies.catalogoespecies_id = pctesauros_ce.catalogoespecies_id "
							."WHERE LOWER(pctesauros_ce.tesauronombre) LIKE '%".strtolower($_GET['commonname'])."%'";
						$condition->addCondition('t.catalogoespecies_id IN ('.$sql.')', 'OR');
					}
					if(isset($_GET['onlyimages'])) {
						if($_GET['onlyimages'] == "true") {
							$sql = "SELECT DISTINCT catalogoespecies.catalogoespecies_id "
								."FROM public.catalogoespecies, public.ce_atributovalor, public.atributos "
								."WHERE catalogoespecies.catalogoespecies_id = ce_atributovalor.catalogoespecies_id AND ce_atributovalor.id_atributo = atributos.id AND atributos.nombre = 'Imagen'";
							$condition->addCondition('t.catalogoespecies_id IN ('.$sql.')');
						}
					}
					if(isset($_GET['order'])) {
						if($_GET['order'] == "scientificname") {
							$condition->order = '"pcaatCe".taxonnombre';
						} else if($_GET['order'] == "author") {
							$condition->order = '"pcaatCe".autor';
						} else {
							$condition->order = "fechaelaboracion";
						}
					} else {
						$condition->order = "fechaelaboracion";
					}
					if(isset($_GET['orderdirection'])) {
						if($_GET['orderdirection'] == "asc") {
							$condition->order = 	$condition->order." ASC";
						} else {
							$condition->order = 	$condition->order." DESC";
						}
					} else {
						$condition->order = 	$condition->order." DESC";
					}
					$condition->limit=20;
					$condition->offset=$offset;
					$models = Catalogoespecies::model()->findAll($condition);
				} else {
					// Model not implemented error
					$this->_sendResponse(501, sprintf(
						'Error: Full list is not implemented for model <b>%s</b>', $_GET['model']) );
					Yii::app()->end();
				}
				break;
			default:
				// Model not implemented error
				$this->_sendResponse(501, sprintf(
				'Error: Mode <b>list</b> is not implemented for model <b>%s</b>',
				$_GET['model']) );
				Yii::app()->end();
		}
		// Did we get some results?
		if(empty($models)) {
			// No
			$this->_sendResponse(200,
					sprintf('No items where found for model <b>%s</b>', $_GET['model']) );
		} else {
			// Prepare response
			$rows = array();
			foreach($models as $model) {
				$rows[$model->catalogoespecies_id] = $model->attributes;
				if(isset($model->pcaatCe)) {
					$rows[$model->catalogoespecies_id]["info_taxonomica"] = $model->pcaatCe->attributes;
				}
				if(isset($model->contacto)) {
					$rows[$model->catalogoespecies_id]["contacto"] = $model->contacto->attributes;
					if(isset($model->contacto->idReferenteGeografico)) {
						$rows[$model->catalogoespecies_id]["contacto"]["pais"] = $model->contacto->idReferenteGeografico->idPais->paisAbreviatura->paisAbreviatura->pais_nombre;
						$rows[$model->catalogoespecies_id]["contacto"]["departamento_estado_provincia"] = $model->contacto->idReferenteGeografico->idSub->subAbreviatura->sub_nombre;
						$rows[$model->catalogoespecies_id]["contacto"]["municipio"] = $model->contacto->idReferenteGeografico->idCm->ciudad_municipio_nombre;
					}
				}
				if(isset($model->pctesaurosCes)) {
					$nombresComunes=$model->pctesaurosCes;
					foreach($nombresComunes as $nombreComun) {
						$rows[$model->catalogoespecies_id]["nombres_comunes"][]=$nombreComun->attributes;
					}
				}
				if(isset($model->pcdepartamentosCes)) {
					$departamentos=$model->pcdepartamentosCes;
					foreach($departamentos as $departamento) {
						$rows[$model->catalogoespecies_id]["distribucion_geografica"]["departamentos"][]=$departamento->departamento->departamento;
					}
				}
				if(isset($model->pcorganizacionesCes)) {
					$organizaciones=$model->pcorganizacionesCes;
					foreach($organizaciones as $organizacio) {
						$rows[$model->catalogoespecies_id]["distribucion_geografica"]["organizaciones"][]=$organizacio->organizacion->organizacion;
					}
				}
				if(isset($model->ceAtributovalors)) {
					$atributos=$model->ceAtributovalors;
					foreach($atributos as $atributo) {
						if(isset($atributo->atributo)) {
							if($atributo->atributo->nombre == "Imagen") {
								$rows[$model->catalogoespecies_id]["atributos"][$atributo->atributo->nombre][]=$atributo->valor0->valor;
							}
						}
					}
				}
				if(isset($rows[$model->catalogoespecies_id]["atributos"]["Imagen"])) {
					$counterArray=0;
					foreach ($rows[$model->catalogoespecies_id]["atributos"]["Imagen"] as $imagen) {
						$images_path = $_SERVER['DOCUMENT_ROOT'].'/imagen';
						$extension = end(explode('.', $imagen));
						$filename = current(explode('.', $imagen));
						if (!is_dir($images_path.'/resampled/'.$model->catalogoespecies_id)) {
							mkdir($images_path.'/resampled/'.$model->catalogoespecies_id, 0755, true);
						}
						if(!file_exists($images_path.'/resampled/'.$model->catalogoespecies_id.'/'.$filename.'_140x140.'.$extension)) {
							$this->image_resize($images_path.'/'.$imagen, $images_path.'/resampled/'.$model->catalogoespecies_id.'/'.$filename.'_140x140.'.$extension, 140, 140, 1);
						}
						if(!file_exists($images_path.'/resampled/'.$model->catalogoespecies_id.'/'.$filename.'_270x270.'.$extension)) {
							$this->image_resize($images_path.'/'.$imagen, $images_path.'/resampled/'.$model->catalogoespecies_id.'/'.$filename.'_270x270.'.$extension, 270, 270, 1);
						}
						$rows[$model->catalogoespecies_id]["atributos"]["ImagenThumb140"][$counterArray] = 'http://admin.catalogo.local'.Yii::app()->request->baseUrl.'/imagen/resampled/'.$model->catalogoespecies_id.'/'.$filename.'_140x140.'.$extension;
						$rows[$model->catalogoespecies_id]["atributos"]["ImagenThumb270"][$counterArray] = 'http://admin.catalogo.local'.Yii::app()->request->baseUrl.'/imagen/resampled/'.$model->catalogoespecies_id.'/'.$filename.'_270x270.'.$extension;
						$rows[$model->catalogoespecies_id]["atributos"]["Imagen"][$counterArray] = 'http://admin.catalogo.local'.'/imagen/'.$imagen;
						$counterArray++;
					}
				}
			}
			// Send the response
			$this->_sendResponse(200, CJSON::encode($rows));
		}
	}

	public function actionListFull()
	{
		// Get the respective model instance
		switch($_GET['model'])
		{
			case 'fichas':
				if(isset($_GET['page'])) {
					$offset = ($_GET['page'] - 1) * 20;
					$condition= new CDbCriteria();
					//$condition->with = array('pcaatCe', 'citacion', 'verificacionce', 'pctesaurosCes', 'pcdepartamentosCes', 'pcregionnaturalCes', 'pccorporacionesCes', 'pcorganizacionesCes', 'ceAtributovalors');
					$condition->order = "fechaelaboracion DESC, catalogoespecies_id DESC";
					$condition->limit=20;
					$condition->offset=$offset;
					$models = Catalogoespecies::model()->findAll($condition);
				} else {
					// Model not implemented error
					$this->_sendResponse(501, sprintf(
						'Error: Full list is not implemented for model <b>%s</b>', $_GET['model']) );
					Yii::app()->end();
				}
				break;
			default:
				// Model not implemented error
				$this->_sendResponse(501, sprintf(
				'Error: Mode <b>list</b> is not implemented for model <b>%s</b>',
				$_GET['model']) );
				Yii::app()->end();
		}
		// Did we get some results?
		if(empty($models)) {
			// No
			$this->_sendResponse(200,
					sprintf('No items where found for model <b>%s</b>', $_GET['model']) );
		} else {
			// Prepare response
			$rows = array();
			foreach($models as $model) {
				$rows[$model->catalogoespecies_id] = $model->attributes;
				if(isset($model->pcaatCe)) {
					$rows[$model->catalogoespecies_id]["info_taxonomica"] = $model->pcaatCe->attributes;
				}
				if(isset($model->contacto)) {
					$rows[$model->catalogoespecies_id]["contacto"] = $model->contacto->attributes;
					if(isset($model->contacto->idReferenteGeografico)) {
						$rows[$model->catalogoespecies_id]["contacto"]["pais"] = $model->contacto->idReferenteGeografico->idPais->paisAbreviatura->paisAbreviatura->pais_nombre;
						$rows[$model->catalogoespecies_id]["contacto"]["departamento_estado_provincia"] = $model->contacto->idReferenteGeografico->idSub->subAbreviatura->sub_nombre;
						$rows[$model->catalogoespecies_id]["contacto"]["municipio"] = $model->contacto->idReferenteGeografico->idCm->ciudad_municipio_nombre;
					}
				}
				if(isset($model->citacion)) {
					$rows[$model->catalogoespecies_id]["citacion"] = $model->citacion->attributes;
					if(isset($model->citacion->citaciontipo)) {
						$rows[$model->catalogoespecies_id]["citacion"]["citacion_tipo_nombre"] = $model->citacion->citaciontipo->citaciontipo_nombre;
					}
					if(isset($model->citacion->repositorioCitacion)) {
						$rows[$model->catalogoespecies_id]["citacion"]["persona_repositorio_citacion"] = $model->citacion->repositorioCitacion->persona;
						$rows[$model->catalogoespecies_id]["citacion"]["organizacion_repositorio_citacion"] = $model->citacion->repositorioCitacion->organizacion;
					}
					if(isset($model->citacion->citacionSuperior)) {
						$rows[$model->catalogoespecies_id]["citacion"]["citacion_superior"] = $model->citacion->citacionSuperior->attributes;
						if(isset($model->citacion->citacionSuperior->citaciontipo)) {
							$rows[$model->catalogoespecies_id]["citacion"]["citacion_superior"]["citacion_tipo_nombre"] = $model->citacion->citacionSuperior->citaciontipo->citaciontipo_nombre;
						}
						if(isset($model->citacion->citacionSuperior->repositorioCitacion)) {
							$rows[$model->catalogoespecies_id]["citacion"]["citacion_superior"]["persona_repositorio_citacion"] = $model->citacion->repositorioCitacion->persona;
							$rows[$model->catalogoespecies_id]["citacion"]["citacion_superior"]["organizacion_repositorio_citacion"] = $model->citacion->citacionSuperior->repositorioCitacion->organizacion;
						}
					}
				}
				if(isset($model->verificacionce)) {
					$rows[$model->catalogoespecies_id]["verificacion"]["estado_de_verificacion"] = $model->verificacionce->estado->nombre;
					$rows[$model->catalogoespecies_id]["verificacion"]["fecha_de_ultima_verificacion"] = $model->verificacionce->fecha;
					$rows[$model->catalogoespecies_id]["verificacion"]["comentarios"] = $model->verificacionce->comentarios;
				}
				if(isset($model->pctesaurosCes)) {
					$nombresComunes=$model->pctesaurosCes;
					foreach($nombresComunes as $nombreComun) {
						$rows[$model->catalogoespecies_id]["nombres_comunes"][]=$nombreComun->attributes;
					}
				}
				if(isset($model->pcdepartamentosCes)) {
					$departamentos=$model->pcdepartamentosCes;
					foreach($departamentos as $departamento) {
						$rows[$model->catalogoespecies_id]["distribucion_geografica"]["departamentos"][]=$departamento->departamento->departamento;
					}
				}
				if(isset($model->pcregionnaturalCes)) {
					$regionesNaturales=$model->pcregionnaturalCes;
					foreach($regionesNaturales as $regionNatural) {
						$rows[$model->catalogoespecies_id]["distribucion_geografica"]["regiones_naturales"][]=$regionNatural->region_natural->region_natural;
					}
				}
				if(isset($model->pccorporacionesCes)) {
					$corporacionesAutonomasRegionales=$model->pccorporacionesCes;
					foreach($corporacionesAutonomasRegionales as $corporacionAutonomaRegional) {
						$rows[$model->catalogoespecies_id]["distribucion_geografica"]["corporaciones_autonomas_regionales"][]=$corporacionAutonomaRegional->corporacion->corporacion;
					}
				}
				if(isset($model->pcorganizacionesCes)) {
					$organizaciones=$model->pcorganizacionesCes;
					foreach($organizaciones as $organizacio) {
						$rows[$model->catalogoespecies_id]["distribucion_geografica"]["organizaciones"][]=$organizacio->organizacion->organizacion;
					}
				}
				if(isset($model->ceAtributovalors)) {
					$atributos=$model->ceAtributovalors;
					foreach($atributos as $atributo) {
						if(isset($atributo->atributo)) {
							if($atributo->etiqueta == 3 || $atributo->etiqueta == 4) {
								$rows[$model->catalogoespecies_id]["atributos"]["Estado de amenaza según categorías UICN"][$atributo->atributo->nombre][]=$atributo->valor0->valor;
							} else if($atributo->atributo->nombre == "Referencias bibliográficas") {
								$citacion=Citacion::model()->findByPk($atributo->valor0->valor);
								$arreglo=$citacion->attributes;
								if(isset($citacion->citaciontipo)) {
									$arreglo["citacion_tipo_nombre"]=$citacion->citaciontipo->citaciontipo_nombre;
								}
								if(isset($citacion->repositorioCitacion)) {
									$arreglo["persona_repositorio_citacion"]=$citacion->repositorioCitacion->persona;
									$arreglo["organizacion_repositorio_citacion"]=$citacion->repositorioCitacion->organizacion;
								}
								$rows[$model->catalogoespecies_id]["atributos"][$atributo->atributo->nombre][]=$arreglo;
							} else if($atributo->atributo->nombre == "Autor(es)" || $atributo->atributo->nombre == "Editor(es)" || $atributo->atributo->nombre == "Revisor(es)" || $atributo->atributo->nombre == "Colaborador(es)") {
								$contacto=Contactos::model()->findByPk($atributo->valor0->valor);
								$arreglo2=$contacto->attributes;
								if(isset($contacto->idReferenteGeografico)) {
									$arreglo2["pais"] = $contacto->idReferenteGeografico->idPais->paisAbreviatura->paisAbreviatura->pais_nombre;
									$arreglo2["departamento_estado_provincia"] = $contacto->idReferenteGeografico->idSub->subAbreviatura->sub_nombre;
									$arreglo2["municipio"] = $contacto->idReferenteGeografico->idCm->ciudad_municipio_nombre;
								}
								$rows[$model->catalogoespecies_id]["atributos"][$atributo->atributo->nombre][]=$arreglo2;
							} else if($atributo->etiqueta != 2) {
								$rows[$model->catalogoespecies_id]["atributos"][$atributo->atributo->nombre][]=$atributo->valor0->valor;
							}
						}
					}
				}
			}
			// Send the response
			$this->_sendResponse(200, CJSON::encode($rows));
		}
	}
	
	public function actionView()
	{
		// Check if id was submitted via GET
		if(!isset($_GET['id']))
			$this->_sendResponse(500, 'Error: Parameter <b>id</b> is missing' );
		
		switch($_GET['model'])
		{
			// Find respective model
			case 'ficha':
				$model = Catalogoespecies::model()->findByPk($_GET['id']);
				break;
			default:
				$this->_sendResponse(501, sprintf(
				'Mode <b>view</b> is not implemented for model <b>%s</b>',
				$_GET['model']) );
				Yii::app()->end();
		}
		// Did we find the requested model? If not, raise an error
		if(is_null($model)) {
			$this->_sendResponse(404, 'No Item found with id '.$_GET['id']);
		} else {
			// Prepare response
			$rows = array();
			$rows[$model->catalogoespecies_id] = $model->attributes;
			if(isset($model->pcaatCe)) {
				$rows[$model->catalogoespecies_id]["info_taxonomica"] = $model->pcaatCe->attributes;
			}
			if(isset($model->contacto)) {
				$rows[$model->catalogoespecies_id]["contacto"] = $model->contacto->attributes;
				if(isset($model->contacto->idReferenteGeografico)) {
					$rows[$model->catalogoespecies_id]["contacto"]["pais"] = $model->contacto->idReferenteGeografico->idPais->paisAbreviatura->paisAbreviatura->pais_nombre;
					$rows[$model->catalogoespecies_id]["contacto"]["departamento_estado_provincia"] = $model->contacto->idReferenteGeografico->idSub->subAbreviatura->sub_nombre;
					$rows[$model->catalogoespecies_id]["contacto"]["municipio"] = $model->contacto->idReferenteGeografico->idCm->ciudad_municipio_nombre;
				}
			}
			if(isset($model->citacion)) {
				$rows[$model->catalogoespecies_id]["citacion"] = $model->citacion->attributes;
				if(isset($model->citacion->citaciontipo)) {
					$rows[$model->catalogoespecies_id]["citacion"]["citacion_tipo_nombre"] = $model->citacion->citaciontipo->citaciontipo_nombre;
				}
				if(isset($model->citacion->repositorioCitacion)) {
					$rows[$model->catalogoespecies_id]["citacion"]["persona_repositorio_citacion"] = $model->citacion->repositorioCitacion->persona;
					$rows[$model->catalogoespecies_id]["citacion"]["organizacion_repositorio_citacion"] = $model->citacion->repositorioCitacion->organizacion;
				}
				if(isset($model->citacion->citacionSuperior)) {
					$rows[$model->catalogoespecies_id]["citacion"]["citacion_superior"] = $model->citacion->citacionSuperior->attributes;
					if(isset($model->citacion->citacionSuperior->citaciontipo)) {
						$rows[$model->catalogoespecies_id]["citacion"]["citacion_superior"]["citacion_tipo_nombre"] = $model->citacion->citacionSuperior->citaciontipo->citaciontipo_nombre;
					}
					if(isset($model->citacion->citacionSuperior->repositorioCitacion)) {
						$rows[$model->catalogoespecies_id]["citacion"]["citacion_superior"]["persona_repositorio_citacion"] = $model->citacion->repositorioCitacion->persona;
						$rows[$model->catalogoespecies_id]["citacion"]["citacion_superior"]["organizacion_repositorio_citacion"] = $model->citacion->citacionSuperior->repositorioCitacion->organizacion;
					}
				}
			}
			if(isset($model->verificacionce)) {
				$rows[$model->catalogoespecies_id]["verificacion"]["estado_de_verificacion"] = $model->verificacionce->estado->nombre;
				$rows[$model->catalogoespecies_id]["verificacion"]["fecha_de_ultima_verificacion"] = $model->verificacionce->fecha;
				$rows[$model->catalogoespecies_id]["verificacion"]["comentarios"] = $model->verificacionce->comentarios;
			}
			if(isset($model->pctesaurosCes)) {
				$nombresComunes=$model->pctesaurosCes;
				foreach($nombresComunes as $nombreComun) {
					$rows[$model->catalogoespecies_id]["nombres_comunes"][]=$nombreComun->attributes;
				}
			}
			if(isset($model->pcdepartamentosCes)) {
				$departamentos=$model->pcdepartamentosCes;
				foreach($departamentos as $departamento) {
					$rows[$model->catalogoespecies_id]["distribucion_geografica"]["departamentos"][]=$departamento->departamento->departamento;
				}
			}
			if(isset($model->pcregionnaturalCes)) {
				$regionesNaturales=$model->pcregionnaturalCes;
				foreach($regionesNaturales as $regionNatural) {
					$rows[$model->catalogoespecies_id]["distribucion_geografica"]["regiones_naturales"][]=$regionNatural->region_natural->region_natural;
				}
			}
			if(isset($model->pccorporacionesCes)) {
				$corporacionesAutonomasRegionales=$model->pccorporacionesCes;
				foreach($corporacionesAutonomasRegionales as $corporacionAutonomaRegional) {
					$rows[$model->catalogoespecies_id]["distribucion_geografica"]["corporaciones_autonomas_regionales"][]=$corporacionAutonomaRegional->corporacion->corporacion;
				}
			}
			if(isset($model->pcorganizacionesCes)) {
				$organizaciones=$model->pcorganizacionesCes;
				foreach($organizaciones as $organizacio) {
					$rows[$model->catalogoespecies_id]["distribucion_geografica"]["organizaciones"][]=$organizacio->organizacion->organizacion;
				}
			}
			if(isset($model->ceAtributovalors)) {
				$atributos=$model->ceAtributovalors;
				foreach($atributos as $atributo) {
					if(isset($atributo->atributo)) {
						if($atributo->etiqueta == 3 || $atributo->etiqueta == 4) {
							$rows[$model->catalogoespecies_id]["atributos"]["Estado de amenaza según categorías UICN"][$atributo->atributo->nombre][]=$atributo->valor0->valor;
						} else if($atributo->atributo->nombre == "Referencias bibliográficas") {
							$citacion=Citacion::model()->findByPk($atributo->valor0->valor);
							$arreglo=$citacion->attributes;
							if(isset($citacion->citaciontipo)) {
								$arreglo["citacion_tipo_nombre"]=$citacion->citaciontipo->citaciontipo_nombre;
							}
							if(isset($citacion->repositorioCitacion)) {
								$arreglo["persona_repositorio_citacion"]=$citacion->repositorioCitacion->persona;
								$arreglo["organizacion_repositorio_citacion"]=$citacion->repositorioCitacion->organizacion;
							}
							$rows[$model->catalogoespecies_id]["atributos"][$atributo->atributo->nombre][]=$arreglo;
						} else if($atributo->atributo->nombre == "Autor(es)" || $atributo->atributo->nombre == "Editor(es)" || $atributo->atributo->nombre == "Revisor(es)" || $atributo->atributo->nombre == "Colaborador(es)") {
							$contacto=Contactos::model()->findByPk($atributo->valor0->valor);
							$arreglo2=$contacto->attributes;
							if(isset($contacto->idReferenteGeografico)) {
								$arreglo2["pais"] = $contacto->idReferenteGeografico->idPais->paisAbreviatura->paisAbreviatura->pais_nombre;
								$arreglo2["departamento_estado_provincia"] = $contacto->idReferenteGeografico->idSub->subAbreviatura->sub_nombre;
								$arreglo2["municipio"] = $contacto->idReferenteGeografico->idCm->ciudad_municipio_nombre;
							}
							$rows[$model->catalogoespecies_id]["atributos"][$atributo->atributo->nombre][]=$arreglo2;
						} else if($atributo->etiqueta != 2) {
							$rows[$model->catalogoespecies_id]["atributos"][$atributo->atributo->nombre][]=$atributo->valor0->valor;
						}
					}
				}
			}
			// Send the response
			//$this->_sendResponse(200, CJSON::encode($rows));
			if(isset($rows[$model->catalogoespecies_id]["atributos"]["Imagen"])) {
				$counterArray=0;
				foreach ($rows[$model->catalogoespecies_id]["atributos"]["Imagen"] as $imagen) {
					$images_path = $_SERVER['DOCUMENT_ROOT'].'/imagen';
					$extension = end(explode('.', $imagen));
					$filename = current(explode('.', $imagen));
					if (!is_dir($images_path.'/resampled/'.$model->catalogoespecies_id)) {
						mkdir($images_path.'/resampled/'.$model->catalogoespecies_id, 0755, true);
					}
					if(!file_exists($images_path.'/resampled/'.$model->catalogoespecies_id.'/'.$filename.'_140x140.'.$extension)) {
						$this->image_resize($images_path.'/'.$imagen, $images_path.'/resampled/'.$model->catalogoespecies_id.'/'.$filename.'_140x140.'.$extension, 140, 140, 1);
					}
					if(!file_exists($images_path.'/resampled/'.$model->catalogoespecies_id.'/'.$filename.'_270x270.'.$extension)) {
						$this->image_resize($images_path.'/'.$imagen, $images_path.'/resampled/'.$model->catalogoespecies_id.'/'.$filename.'_270x270.'.$extension, 270, 270, 1);
					}
					$rows[$model->catalogoespecies_id]["atributos"]["ImagenThumb140"][$counterArray] = 'http://admin.catalogo.local'.Yii::app()->request->baseUrl.'/imagen/resampled/'.$model->catalogoespecies_id.'/'.$filename.'_140x140.'.$extension;
					$rows[$model->catalogoespecies_id]["atributos"]["Imagen"][$counterArray] = 'http://admin.catalogo.local'.'/imagen/'.$imagen;
					$counterArray++;
				}
			}
			$this->_sendResponse(200, CJSON::encode($rows));
		}
	}
	
	private function _sendResponse($status = 200, $body = '', $content_type = 'application/json')
	{
		// set the status
		$status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
		header($status_header);
		// and the content type
		header('Content-type: ' . $content_type);
		header('Access-control-allow-origin: *');
		header('Access-Control-Allow-Methods: GET');

		if(isset($_GET['callback'])) {
			if($this->_is_valid_callback($_GET['callback'])) {
				$body = $_GET['callback'].'('.$body.')';
			} else {
				$body = $_GET['callback'].'('.$body.')';
			}
		}
	
		// pages with body are easy
		if($body != '')
		{
			// send the body
			echo $body;
		}
		// we need to create the body if none is passed
		else
		{
			// create some body messages
			$message = '';
	
			// this is purely optional, but makes the pages a little nicer to read
			// for your users.  Since you won't likely send a lot of different status codes,
			// this also shouldn't be too ponderous to maintain
			switch($status)
			{
				case 401:
					$message = 'You must be authorized to view this page.';
					break;
				case 404:
					$message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
					break;
				case 500:
					$message = 'The server encountered an error processing your request.';
					break;
				case 501:
					$message = 'The requested method is not implemented.';
					break;
			}
	
			// servers don't always have a signature turned on
			// (this is an apache directive "ServerSignature On")
			$signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];
	
			// this should be templated in a real-world solution
			$body = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
</head>
<body>
    <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
    <p>' . $message . '</p>
    <hr />
    <address>' . $signature . '</address>
</body>
</html>';
	
			echo $body;
		}
		Yii::app()->end();
	}
	
	private function _getStatusCodeMessage($status)
	{
		// these could be stored in a .ini file and loaded
		// via parse_ini_file()... however, this will suffice
		// for an example
		$codes = Array(
				200 => 'OK',
				400 => 'Bad Request',
				401 => 'Unauthorized',
				402 => 'Payment Required',
				403 => 'Forbidden',
				404 => 'Not Found',
				500 => 'Internal Server Error',
				501 => 'Not Implemented',
		);
		return (isset($codes[$status])) ? $codes[$status] : '';
	}

	private function _is_valid_callback($subject) {
		$identifier_syntax = '/^[$_\p{L}][$_\p{L}\p{Mn}\p{Mc}\p{Nd}\p{Pc}\x{200C}\x{200D}]*+$/u';

		$reserved_words = array('break', 'do', 'instanceof', 'typeof', 'case',
			'else', 'new', 'var', 'catch', 'finally', 'return', 'void', 'continue', 
			'for', 'switch', 'while', 'debugger', 'function', 'this', 'with', 
			'default', 'if', 'throw', 'delete', 'in', 'try', 'class', 'enum', 
			'extends', 'super', 'const', 'export', 'import', 'implements', 'let', 
			'private', 'public', 'yield', 'interface', 'package', 'protected', 
			'static', 'null', 'true', 'false');

		return preg_match($identifier_syntax, $subject) && !in_array(mb_strtolower($subject, 'UTF-8'), $reserved_words);
	}
	
	protected function beforeAction($action)
	{
		foreach (Yii::app()->log->routes as $route)
		{
			if ($route instanceof CWebLogRoute)
			{
				$route->enabled = false;
			}
		}
		return true;
	}

	private function image_resize($src, $dst, $width, $height, $crop=0) {
		if(!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";

		$type = strtolower(substr(strrchr($src,"."),1));
		if($type == 'jpeg') $type = 'jpg';
		switch($type) {
			//case 'bmp': $img = imagecreatefromwbmp($src); break;
			case 'gif': $img = imagecreatefromgif($src); break;
			case 'jpg': $img = imagecreatefromjpeg($src); break;
			case 'png': $img = imagecreatefrompng($src); break;
			default : return "Unsupported picture type!";
		}

		// resize
		if($crop) {
			if($w < $width or $h < $height) return "Picture is too small!";
			$ratio = max($width/$w, $height/$h);
			$h = $height / $ratio;
			$x = ($w - $width / $ratio) / 2;
			$w = $width / $ratio;
		} else {
			if($w < $width and $h < $height) 
				return "Picture is too small!";$ratio = min($width/$w, $height/$h);
			$width = $w * $ratio;
			$height = $h * $ratio;
			$x = 0;
		}

		$new = imagecreatetruecolor($width, $height);

		// preserve transparency
		if($type == "gif" or $type == "png") {
			imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
			imagealphablending($new, false);
			imagesavealpha($new, true);
		}

		imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);

		switch($type) {
			case 'bmp': imagewbmp($new, $dst); break;
			case 'gif': imagegif($new, $dst); break;
			case 'jpg': imagejpeg($new, $dst); break;
			case 'png': imagepng($new, $dst); break;
		}
		return true;
	}

	private function CroppedThumbnail($imgSrc,$thumbnail_width,$thumbnail_height) { 
		//$imgSrc is a FILE - Returns an image resource.
		//getting the image dimensions  
		list($width_orig, $height_orig) = getimagesize($imgSrc);   
		$myImage = imagecreatefromjpeg($imgSrc);
		$ratio_orig = $width_orig/$height_orig;

		if ($thumbnail_width/$thumbnail_height > $ratio_orig) {
			$new_height = $thumbnail_width/$ratio_orig;
			$new_width = $thumbnail_width;
		} else {
			$new_width = $thumbnail_height*$ratio_orig;
			$new_height = $thumbnail_height;
		}

		$x_mid = $new_width/2;  //horizontal middle
		$y_mid = $new_height/2; //vertical middle

		$process = imagecreatetruecolor(round($new_width), round($new_height));
		imagecopyresampled($process, $myImage, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);
		$thumb = imagecreatetruecolor($thumbnail_width, $thumbnail_height); 
		imagecopyresampled($thumb, $process, 0, 0, ($x_mid-($thumbnail_width/2)), ($y_mid-($thumbnail_height/2)), $thumbnail_width, $thumbnail_height, $thumbnail_width, $thumbnail_height);

		imagedestroy($process);
		imagedestroy($myImage);
		return $thumb;
	}
}
?>