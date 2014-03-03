<?php 
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'entidades_lista-grid',
	//'fixedHeader' => true,
	'dataProvider'=>$listTipo,
	//'responsiveTable' => true,
	//'filter'=>$model,
	'columns'=>array(
		'grupo',
		'cantidad',
	),
)); ?>