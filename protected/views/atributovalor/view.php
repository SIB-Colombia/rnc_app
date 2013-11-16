<?php
/* @var $this AtributovalorController */
/* @var $model Atributovalor */

$this->breadcrumbs=array(
	'Atributovalors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Atributovalor', 'url'=>array('index')),
	array('label'=>'Create Atributovalor', 'url'=>array('create')),
	array('label'=>'Update Atributovalor', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Atributovalor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Atributovalor', 'url'=>array('admin')),
);
?>

<h1>View Atributovalor #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'valor',
		'atributotipo_id',
	),
)); ?>
