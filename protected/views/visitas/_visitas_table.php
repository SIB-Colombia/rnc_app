<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'visitas_lista-grid',
	//'fixedHeader' => true,
	'dataProvider'=>$listVisitas,
	//'responsiveTable' => true,
	'filter'=>$model,
	'ajaxUrl'=>array('visitas/busqueda'),
	'columns'=>array(
			'entidad',
			array('name' => 'numero_registro_search','value' => 'CHtml::encode(isset($data->registros->numero_registro) ? $data->registros->numero_registro : "")'),
			array('name' => 'titular_search','value' => 'CHtml::encode(isset($data->registros->entidad->titular) ? $data->registros->entidad->titular : "")'),
			array('name' => 'departamento_search','value' => 'CHtml::encode(isset($data->county->department->department_name) ? $data->county->department->department_name : "")'),
			array('name' => 'municipio_search','value' => 'CHtml::encode(isset($data->county->county_name) ? $data->county->county_name : "")'),
			'fecha_visita',
			'concepto',
			array(
					'class'=>'bootstrap.widgets.TbButtonColumn',
						
					'htmlOptions'=>array('style'=>'width: 50px'),
			)
	),
)); ?>