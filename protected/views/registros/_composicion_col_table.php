<?php 
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'nivel_cata_lista_grid',
	//'fixedHeader' => true,
	'dataProvider'=>$listComposicion,
	//'responsiveTable' => true,
	//'filter'=>$model,
	'columns'=>array(
		'grupo_taxonomico.nombre',
		array('name' => 'subgrupo_taxonomico.nombre','value' => '($data->subgrupo_taxonomico_id == 2) ? CHtml::encode($data->subgrupo_otro) : CHtml::encode($data->subgrupo_taxonomico->nombre)'),
		'numero_ejemplares',
		array('name' => 'numero_catalogados','value' => '$data->numero_catalogados." %"'),
		array('name' => 'numero_sistematizados','value' => '$data->numero_sistematizados." %"'),
		array('name' => 'numero_nivel_filum','value' => '$data->numero_nivel_filum." %"'),
		array('name' => 'numero_nivel_orden','value' => '$data->numero_nivel_orden." %"'),
		array('name' => 'numero_nivel_familia','value' => '$data->numero_nivel_familia." %"'),
		array('name' => 'numero_nivel_genero','value' => '$data->numero_nivel_genero." %"'),
		array('name' => 'numero_nivel_especie','value' => '$data->numero_nivel_especie." %"'),
	),
)); ?>