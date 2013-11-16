<?php
/* @var $this CeAtributovalorController */
/* @var $model CeAtributovalor */

$this->breadcrumbs=array(
	'Ce Atributovalors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CeAtributovalor', 'url'=>array('index')),
	array('label'=>'Manage CeAtributovalor', 'url'=>array('admin')),
);
?>

<h1>Create CeAtributovalor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>