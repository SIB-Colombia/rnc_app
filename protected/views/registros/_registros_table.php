<?php 
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'registros_lista-grid',
	//'fixedHeader' => true,
	'dataProvider'=>$listRegistros,
	//'responsiveTable' => true,
	'filter'=>$model,
	'ajaxUrl'=>array('registros/busqueda'),
	'columns'=>array(
		'numero_registro',
		array('name' => 'acronimo_search','value' => 'CHtml::encode(isset($data->registros_update[0]->acronimo) ? $data->registros_update[0]->acronimo : "" )'),
		array('name' => 'titular_search','value' => 'CHtml::encode($data->entidad->titular)'),
		array('name' => 'ciudad_search','value' => 'CHtml::encode(isset($data->registros_update[0]->county->county_name) ? $data->registros_update[0]->county->county_name : "No Asignado")'),
		array('name' => 'estado_search','value' => '($data->estado == 0) ? "Sin Aprobar" : "Aprobado"'),
		'fecha_dil',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{val}',
			'buttons'=>array
			(
				'val' => array
				(
					'label'=>'Ver',
					'url'=>'Yii::app()->createUrl("registros/view", array("id"=>$data->id))',
					'options'=>array(
							'class'=>'btn btn-success btn-small',
					),
				)
			),
			'htmlOptions'=>array('style'=>'width: 50px'),
		)
	),
));

?>