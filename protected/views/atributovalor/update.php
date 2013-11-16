<?php
/* @var $this AtributovalorController */
/* @var $model Atributovalor */

$this->breadcrumbs=array(
	'Atributovalors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Atributovalor', 'url'=>array('index')),
	array('label'=>'Create Atributovalor', 'url'=>array('create')),
	array('label'=>'View Atributovalor', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Atributovalor', 'url'=>array('admin')),
);
?>

<h1>Update Atributovalor <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>