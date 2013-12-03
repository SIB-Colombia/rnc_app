<?php
Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');

?>

<div id="header-front">Colección Número: <?php echo ($model->registros->numero_registro == 0) ? "Sin Definir" : CHtml::encode($model->registros->numero_registro); ?></div>

<div id="content-front">
<?php
$this->widget('bootstrap.widgets.TbButtonGroup', array(
		'buttons'=>array(
				array('label'=>'Listar Colecciones', 'icon'=>'icon-list', 'url'=>array('index')),
				array('label'=>'Volver a la Colección', 'icon'=>'icon-list', 'url'=>Yii::app()->createUrl('registros'.DIRECTORY_SEPARATOR.$model->registros->id)),
		),
));
?>

<div style="margin-top: 20px">
<ul class="nav nav-tabs">
    	<li class="active"><a href="#tab1" data-toggle="tab">Información Básica</a></li>
    	<li><a href="#tab2" data-toggle="tab">Contacto</a></li>
    	<li><a href="#tab3" data-toggle="tab">Elaborado Por</a></li>
  	</ul>
  	
  	<div class="tab-content">
	  	<div class="tab-pane fade in active" id="tab1">
			<fieldset>
				<legend class="form_legend">INFORMACIÓN BÁSICA DE LA COLECCIÓN</legend>
				<?php 
				$this->widget('zii.widgets.CDetailView', array(
					'data'=>$model,
					'attributes'=>array(
						'nombre',
						'acronimo',
						'fecha_fund',
						'descripcion',
						'direccion',
						'county.county_name',
						'telefono',
						'email'
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
						'info_adicional',
						'pagina_web'
					)
				));
				?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">Tamaño de la colección</legend>
			       	<?php echo $this->renderPartial('_tamano_col_table', array('listTamano'=>$model->dataTamanoList($model->id))); ?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">Tipos en la colección</legend>
			       	<?php echo $this->renderPartial('_tipo_col_table', array('listTipo'=>$model->dataTipoList($model->id))); ?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">Nivel de catalogación, sistematización e identificación</legend>
			       	<?php echo $this->renderPartial('_composicion_col_table', array('listComposicion'=>$model->dataComposicionList($model->id))); ?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">Archivos</legend>
			       	<?php echo $this->renderPartial('_archivos_col_table', array('listArchivos'=>$model->dataArchivosList($model->id))); ?>
			</fieldset>
		</div>
		
		<div class="tab-pane fade" id="tab2">
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
						'contactos.county.county_name',
						'contactos.telefono',
						'contactos.email',
					)
				));
				?>
			</fieldset>
		</div>
		
		<div class="tab-pane fade" id="tab3">
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