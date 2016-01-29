<?php
$this->pageTitle=Yii::app()->name;
Yii::app()->theme = 'rnc_theme';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<div class="col-lg-10">
	<div class="area-contenido">
		<div id="content">
			<div id="header-front">Colección número: <?php echo ($model->registros->numero_registro == 0) ? "Sin Definir" : CHtml::encode($model->registros->numero_registro); ?>
				<i class="icon-print printR" aria-hidden="true" onclick="print();"></i>
			</div>
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
	      					<h4 class="panel-title">
		        				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
		          					DATOS DE CONTACTO
		        				</a>
	      					</h4>
	    				</div>
	    				<div id="collapseOne" class="panel-collapse collapse  in" role="tabpanel" aria-labelledby="headingOne">
	      					<div class="panel-body">
	      						<?php 
									$this->widget('zii.widgets.CDetailView', array(
										'data'=>$model,
										'attributes'=>array(
											'contactos.nombre',
											'contactos.cargo',
											'contactos.dependencia',
											'contactos.direccion',
											'contactos.county.department.department_name',
											'contactos.county.county_name',
											'contactos.telefono',
											'contactos.email',
										)
									));
									?>
	      					</div>
	      				</div>
					</div>
					<div class="panel-heading" role="tab" id="headingTwo">
      					<h4 class="panel-title">
	        				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
	          					INFORMACIÓN BÁSICA DE LA COLECCIÓN
	        				</a>
      					</h4>
    				</div>
    				<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      					<div class="panel-body">
        					<?php 
								$this->widget('zii.widgets.CDetailView', array(
									'data'=>$model,
									'attributes'=>array(
										'nombre',
										'registros.numero_registro',
										'registros.tipo_coleccion.nombre',
										'registros.fecha_dil',
										'acronimo',
										'fecha_fund',
										'descripcion',
										'direccion',
										'county.department.department_name',
										'county.county_name',
										'telefono',
										'email',
										'fecha_act'
									)
								));
								?>
							<fieldset class="fieldsetFront">
								<legend class="form_legend">Cobertura</legend>
								<?php 
								$this->widget('zii.widgets.CDetailView', array(
									'data'=>$model,
									'attributes'=>array(
										'cobertura_tax',
										'cobertura_geog',
										'cobertura_temp',
									)
								));
								?>
							</fieldset>

							<fieldset class="fieldsetFront">
								<legend class="form_legend">INFORMACIÓN COMPLEMENTARIA</legend>
								<?php 
								$this->widget('zii.widgets.CDetailView', array(
									'data'=>$model,
									'attributes'=>array(
										'deorreferenciados',
										'sistematizacion',
										'info_adicional',
										'comentario'
									)
								));
								?>
							</fieldset>

							<fieldset class="fieldsetFront">
								<legend class="form_legend">Tipos de preservación</legend>
							       	<?php echo $this->renderPartial('_tamano_col_table', array('listTamano'=>$model->dataTamanoList($model->id))); ?>
							</fieldset>

							<fieldset class="fieldsetFront">
								<legend class="form_legend">Tipos en la colección</legend>
									<?php 
										$this->widget('zii.widgets.CDetailView', array(
											'data'=>$model,
											'attributes'=>array(
												array(
													'name' => 'ejemplar_tipo',
													'type'	=> 'raw',
													'value' => CHtml::encode(($model->ejemplar_tipo == 0) ? "Si" : "No")
												),
												'ej_tipo_cantidad',
											)
										));
									?>
							       	<?php echo $this->renderPartial('_tipo_col_table', array('listTipo'=>$model->dataTipoList($model->id))); ?>
							</fieldset>

							<fieldset class="fieldsetFront">
								<legend class="form_legend">Nivel de catalogación, sistematización e identificación</legend>
							       	<?php echo $this->renderPartial('_composicion_col_table', array('listComposicion'=>$model->dataComposicionList($model->id))); ?>
							</fieldset>
							
							<fieldset class="fieldsetFront">
								<legend class="form_legend">Recursos web</legend>
							       	<?php echo $this->renderPartial('_urls_table', array('listUrls'=>$model->dataUrlsList($model->id))); ?>
							</fieldset>
				      	</div>
    				</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingThree">
      					<h4 class="panel-title">
	        				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="collapsed">
	          					DATOS DEL TITULAR
	        				</a>
      					</h4>
    				</div>
    				<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      					<div class="panel-body">

	    				<?php 
							$this->widget('zii.widgets.CDetailView', array(
								'data'=>$model->registros,
								'attributes'=>array(
									array(
										'name' => 'entidad.tipo_titular',
										'type'	=> 'raw',
										'value' => CHtml::encode(($model->registros->entidad->tipo_titular == 1) ? "Persona Natural" : (($model->registros->entidad->tipo_titular == 2) ? "Persona Jurídica" : "No Asignado"))
									),
									'entidad.titular',
									'entidad.nit',
									'entidad.representante_legal',
									array(
										'name' => 'entidad.tipo_id_rep',
										'type'	=> 'raw',
										'value' => CHtml::encode(($model->registros->entidad->tipo_id_rep == 1) ? "Cédula de Ciudadanía" : (($model->registros->entidad->tipo_id_rep == 2) ? "Cédula de Extranjería" : "No Asignado"))
									),
									'entidad.representante_id',
									'entidad.county.department.department_name',
									'entidad.county.county_name',
									'entidad.telefono',
									'entidad.direccion',
									'entidad.email',
									'entidad.tipo_institucion.nombre'
								)
							));
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>