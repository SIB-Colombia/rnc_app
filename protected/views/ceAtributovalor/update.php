<?php
/* @var $this CeAtributovalorController */
/* @var $model CeAtributovalor */

$this->breadcrumbs=array(
	'Ce Atributovalors'=>array('index'),
	$model->ceatributovalor_id=>array('view','id'=>$model->ceatributovalor_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CeAtributovalor', 'url'=>array('index')),
	array('label'=>'Create CeAtributovalor', 'url'=>array('create')),
	array('label'=>'View CeAtributovalor', 'url'=>array('view', 'id'=>$model->ceatributovalor_id)),
	array('label'=>'Manage CeAtributovalor', 'url'=>array('admin')),
);
?>

<h1>Update CeAtributovalor <?php echo $model->ceatributovalor_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>