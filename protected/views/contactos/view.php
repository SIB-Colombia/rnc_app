<?php
/* @var $this ContactosController */
/* @var $model Contactos */

$this->breadcrumbs=array(
	'Contactoses'=>array('index'),
	$model->contacto_id,
);

$this->menu=array(
	array('label'=>'List Contactos', 'url'=>array('index')),
	array('label'=>'Create Contactos', 'url'=>array('create')),
	array('label'=>'Update Contactos', 'url'=>array('update', 'id'=>$model->contacto_id)),
	array('label'=>'Delete Contactos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->contacto_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Contactos', 'url'=>array('admin')),
);
?>

<h1>View Contactos #<?php echo $model->contacto_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'contacto_id',
		'direccion',
		'id_referente_geografico',
		'telefono',
		'acronimo',
		'persona',
		'fax',
		'correo_electronico',
		'organizacion',
		'cargo',
		'instrucciones',
		'hora_inicial',
		'hora_final',
	),
)); ?>
