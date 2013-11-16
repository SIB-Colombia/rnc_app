<?php
/* @var $this CeAtributovalorController */
/* @var $model CeAtributovalor */

$this->breadcrumbs=array(
	'Ce Atributovalors'=>array('index'),
	$model->ceatributovalor_id,
);

$this->menu=array(
	array('label'=>'List CeAtributovalor', 'url'=>array('index')),
	array('label'=>'Create CeAtributovalor', 'url'=>array('create')),
	array('label'=>'Update CeAtributovalor', 'url'=>array('update', 'id'=>$model->ceatributovalor_id)),
	array('label'=>'Delete CeAtributovalor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ceatributovalor_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CeAtributovalor', 'url'=>array('admin')),
);
?>

<h1>View CeAtributovalor #<?php echo $model->ceatributovalor_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ceatributovalor_id',
		'catalogoespecies_id',
		'etiqueta',
		'valor',
	),
)); ?>
