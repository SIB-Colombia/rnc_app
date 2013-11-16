<?php
/* @var $this CatalogoespeciesController */
/* @var $model Catalogoespecies */
Yii::app()->theme = 'catalogo_interno';

$this->breadcrumbs=array(
	'Catalogoespecies'=>array('index'),
	$model->catalogoespecies_id,
);

$this->widget('bootstrap.widgets.TbButtonGroup', array(
		'buttons'=>array(
				array('label'=>'Listar fichas', 'icon'=>'icon-list', 'url'=>array('index')),
		),
));
?>

<h1>Datos de ficha con ID No. <?php echo $model->catalogoespecies_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'catalogoespecies_id',
		'citacion_id',
		'contacto_id',
		'fechaactualizacion',
		'fechaelaboracion',
		'titulometadato',
		'jerarquianombrescomunes',
	),
)); ?>
