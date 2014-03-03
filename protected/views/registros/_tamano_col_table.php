<?php 
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'entidades_lista-grid',
	//'fixedHeader' => true,
	'dataProvider'=>$listTamano,
	//'responsiveTable' => true,
	//'filter'=>$model,
	'columns'=>array(
		'tipo_preservacion.nombre',
		'otro',
		'unidad_medida'
	),
)); ?>