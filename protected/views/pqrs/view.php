<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');

?>

<div id="header-front">Detalle de la Solicitud: <?php echo $model->id; ?></div>

<div id="content-front">
<?php
$this->widget('bootstrap.widgets.TbButtonGroup', array(
		'buttons'=>array(
				array('label'=>'Listar Solicitudes', 'icon'=>'icon-list', 'url'=>array('index')),
		),
));
?>
<div style="margin-top: 20px">
<?php 
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			'nombre',
			'registros.numero_registro',
			array(
				'name' => 'titular',
				'type'	=> 'raw',
				'value' => CHtml::encode($model->entidad->titular)
			),
			'email',
			array(
				'name' => 'tipo_solicitud',
				'type'	=> 'raw',
				'value' => CHtml::encode(($model->tipo_solicitud == 1) ? "Petición" : (($model->tipo_solicitud == 2) ? "Queja" : (($model->tipo_solicitud == 3) ? "Felicitación" : "No Asignado")))
			),
			'descripcion',
			array(
				'name' => 'estado',
				'type'	=> 'raw',
				'value' => CHtml::encode(($model->estado == 0) ? "Pendiente" : "Cerrado")
			),
			'respuesta'
		),
	));

	
?>
<fieldset>
	<legend class="form_legend">Archivos</legend>
       	<?php echo $this->renderPartial('_archivos_pqrs', array('listArchivos'=>$model->dataArchivosList($model->id))); ?>
</fieldset>
</div>
</div>