<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');

?>

<div id="header-front">Detalle de la Visita: <?php echo $model->entidad; ?></div>

<div id="content-front">
<?php
$this->widget('bootstrap.widgets.TbButtonGroup', array(
		'buttons'=>array(
				array('label'=>'Listar Visitas', 'icon'=>'icon-list', 'url'=>array('index')),
		),
));
?>
<div style="margin-top: 20px">
<?php 
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'entidad',
		'registros.numero_registro',
		'registros.registros_update.acronimo',
		'registros.entidad.titular',
		'fecha_visita',
		'concepto',
		'county.county_name'
	),
)); ?>
<br>
<fieldset>
		<legend class="form_legend">Datos de quien hizo la visita</legend>
		
		<?php 
			$this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					'dilegenciadores.nombre',
					'dilegenciadores.dependencia',
					'dilegenciadores.cargo',
				),
			)); 
		?>
</fieldset>

<fieldset>
	<legend class="form_legend">Archivos</legend>
       	<?php echo $this->renderPartial('_archivos_visitas', array('listArchivos'=>$model->dataArchivosList($model->id))); ?>
</fieldset>

</div>
</div>