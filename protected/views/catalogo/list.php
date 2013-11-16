<?php
/* @var $this CatalogoespeciesController */
/* @var $dataProvider CActiveDataProvider */
Yii::app()->theme = 'catalogo_interno';

$this->breadcrumbs=array(
	'Catalogo',
);

$this->menu=array(
	array('label'=>'Crear ficha', 'url'=>array('create')),
	array('label'=>'Gestionar ficha', 'url'=>array('admin')),
);
?>

<h1>Catalogoespecies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
