<?php
/* @var $this AtributovalorController */
/* @var $model Atributovalor */

$this->breadcrumbs=array(
	'Atributovalors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Atributovalor', 'url'=>array('index')),
	array('label'=>'Manage Atributovalor', 'url'=>array('admin')),
);
?>

<h1>Create Atributovalor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>