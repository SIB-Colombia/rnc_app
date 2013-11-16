<?php
/* @var $this AtributovalorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Atributovalors',
);

$this->menu=array(
	array('label'=>'Create Atributovalor', 'url'=>array('create')),
	array('label'=>'Manage Atributovalor', 'url'=>array('admin')),
);
?>

<h1>Atributovalors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
