<?php 
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'entidades_lista-grid',
	//'fixedHeader' => true,
	'dataProvider'=>$listComposicion,
	//'responsiveTable' => true,
	//'filter'=>$model,
	'columns'=>array(
		'grupo_taxonomico',
		'numero_ejemplares',
		'numero_catalogados',
		'numero_sistematizados',
		'numero_nivel_orden',
		'numero_nivel_familia',
		'numero_nivel_genero',
		'numero_nivel_especie'
	),
)); ?>