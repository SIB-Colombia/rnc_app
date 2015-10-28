<?php
Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');
$userRole = Yii::app()->user->getState("roles");
?>

<script>
function activarRegistro(id){
	
	if(confirm("Desea reabrir el formulario del registro?") == true){
		$.post("../activarRegistro", {idRegistro: id},function(data){
			
			if(data.status == 'failure'){
				alert("Ocurrió un problema y no se pudo cancelar el registro");
				window.location.href ="<?=Yii::app()->createUrl('registros'.DIRECTORY_SEPARATOR.$model->registros->id);?>";
			}else{
				alert("El registro fue reabierto con éxito.");
				window.location.href ="<?=Yii::app()->createUrl('registros'.DIRECTORY_SEPARATOR.$model->registros->id);?>";
			}
		},"json");
	}else{
		window.stop();
	}
	
}
</script>

<div id="header-front">Colección número: <?php echo ($model->registros->numero_registro == 0) ? "Sin Definir" : CHtml::encode($model->registros->numero_registro); ?></div>

<div id="content-front">
<?php
$this->widget('bootstrap.widgets.TbButtonGroup', array(
		'buttons'=>array(
				array('label'=>'Listar colecciones', 'icon'=>'icon-list', 'url'=>array('index')),
				array('label'=>'Volver a la colección', 'icon'=>'icon-list', 'url'=>Yii::app()->createUrl('registros'.DIRECTORY_SEPARATOR.$model->registros->id)),
				array('label'=>'Activar Registro', 'icon'=>'icon-check', 'url' => 'javascript:activarRegistro('.$model->id.')','visible' => ($model->estado == 2 && $userRole == "admin") ? true : false),
		),
));
?>

<div style="margin-top: 20px">
<ul class="nav nav-tabs">
		<li class="active"><a href="#tab1" data-toggle="tab">Titular</a></li>
		<li><a href="#tab2" data-toggle="tab">Información básica</a></li>
    	<li><a href="#tab3" data-toggle="tab">Contacto</a></li>
    	<li><a href="#tab4" data-toggle="tab">Elaborado por</a></li>
  	</ul>
  	
  	<div class="tab-content">
  		<i class="icon-print printR" onclick="document.getElementById('tab1').focus(); print();"></i>
	  	<div class="tab-pane fade " id="tab2">
	  		
			<fieldset>
				<legend class="form_legend">INFORMACIÓN BÁSICA DE LA COLECCIÓN</legend>
				<?php 
				$this->widget('zii.widgets.CDetailView', array(
					'data'=>$model,
					'attributes'=>array(
						'nombre',
						'registros.numero_registro',
						'registros.tipo_coleccion.nombre',
						'acronimo',
						'fecha_fund',
						'descripcion',
						'direccion',
						'county.department.department_name',
						'county.county_name',
						'telefono',
						'email',
						'registros.fecha_dil',
						'fecha_act',
						'fecha_rev',
					)
				));
				?>
			</fieldset>
			
			<fieldset>
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
			
			<fieldset>
				<legend class="form_legend">DOCUMENTOS ADJUNTOS</legend>
				<?php 
				$this->widget('zii.widgets.CDetailView', array(
					'data'=>$model,
					'attributes'=>array(
						'listado_anexos',
					)
				));
				?>
			</fieldset>
			
			<fieldset>
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
			
			<fieldset>
				<legend class="form_legend">Tipos de preservación</legend>
			       	<?php echo $this->renderPartial('_tamano_col_table', array('listTamano'=>$model->dataTamanoList($model->id))); ?>
			</fieldset>
			
			<fieldset>
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
			
			<fieldset>
				<legend class="form_legend">Nivel de catalogación, sistematización e identificación</legend>
			       	<?php echo $this->renderPartial('_composicion_col_table', array('listComposicion'=>$model->dataComposicionList($model->id))); ?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">Recursos web</legend>
			       	<?php echo $this->renderPartial('_urls_table', array('listUrls'=>$model->dataUrlsList($model->id))); ?>
			</fieldset>

			<fieldset>
				<legend class="form_legend">Archivos</legend>
			       	<?php echo $this->renderPartial('_archivos_col_table', array('listArchivos'=>$model->dataArchivosList($model->id))); ?>
			</fieldset>
		</div>
		
		<div class="tab-pane fade in active" id="tab1">
			<fieldset>
				<legend class="form_legend">DATOS DEL TITULAR</legend>
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
			</fieldset>
		</div>
		
		<div class="tab-pane fade" id="tab3">
			<fieldset>
				<legend class="form_legend">DATOS DE CONTACTO</legend>
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
			</fieldset>
		</div>
		
		<div class="tab-pane fade" id="tab4">
			<fieldset>
				<legend class="form_legend">ELABORACIÓN DEL REGISTRO</legend>
				<?php 
				$this->widget('zii.widgets.CDetailView', array(
					'data'=>$model,
					'attributes'=>array(
						'dilegenciadores.nombre',
						'dilegenciadores.dependencia',
						'dilegenciadores.cargo',
						'dilegenciadores.telefono',
						'dilegenciadores.email'
					)
				));
				?>
			</fieldset>
		</div>
	</div>
</div>

</div>