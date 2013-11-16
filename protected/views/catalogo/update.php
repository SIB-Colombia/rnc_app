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

<h1>Modificar ficha ID: <?php echo $model->catalogoespecies_id; ?>, <?php echo $model->pcaatCe->taxonnombre; ?> (<?php echo $model->pcaatCe->autor; ?>)</h1>

<?php echo $this->renderPartial('_form_modificar', array('model'=>$model,'citaciones'=>$citaciones, 'contactos'=>$contactos, 'nombresComunes'=>$nombresComunes, 'departamentos'=>$departamentos, 'corporaciones'=>$corporaciones, 'regionesNaturales'=>$regionesNaturales, 'organizaciones'=>$organizaciones, 'atributos'=>$atributos)); ?>