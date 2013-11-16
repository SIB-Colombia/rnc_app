<?php
/* @var $this CeAtributovalorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ce Atributovalors',
);

$this->menu=array(
	array('label'=>'Create CeAtributovalor', 'url'=>array('create')),
	array('label'=>'Manage CeAtributovalor', 'url'=>array('admin')),
);
?>

<h1>Ce Atributovalors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
