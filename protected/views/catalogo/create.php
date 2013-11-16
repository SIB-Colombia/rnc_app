<?php
/* @var $this CatalogoespeciesController */
/* @var $model Catalogoespecies */
Yii::app()->theme = 'catalogo_interno';

$this->breadcrumbs=array(
	'Catalogo'=>array('index'),
	'Create',
);

/*$this->menu=array(
	array('label'=>'Listar fichas', 'url'=>array('index')),
	array('label'=>'Manage Catalogoespecies', 'url'=>array('admin')),
);*/

$this->widget('bootstrap.widgets.TbButtonGroup', array(
	'buttons'=>array(
		array('label'=>'Listar fichas', 'icon'=>'icon-list', 'url'=>array('index')),
	),
));
?>

<h1>Adicionar nueva ficha</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'citaciones'=>$citaciones, 'contactos'=>$contactos)); ?>