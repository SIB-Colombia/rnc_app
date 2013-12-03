<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'entidades_lista-grid',
	//'fixedHeader' => true,
	'dataProvider'=>$listEntidades,
	//'responsiveTable' => true,
	//'filter'=>$model,
	'ajaxUrl'=>array('entidad/busqueda'),
	'columns'=>array(
		'titular',
		array('name' => 'ciudad_id','value' => 'CHtml::encode(isset($data->county->county_name) ? $data->county->county_name : "No Asignado")'),
		array('name' => 'estado','value' => '($data->estado == 1) ? "En Espera" : (($data->estado == 2) ? "Aprobado" : "No Aprobado")'),
		array('name' => 'usuario_id','value' => 'isset($data->usuario->username) ? $data->usuario->username : "No Asignado"'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			
			'htmlOptions'=>array('style'=>'width: 50px'),
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{val}',
			'buttons'=>array
			(
				'val' => array
				(
					'label'=>'Validar',
					'url'=>'Yii::app()->createUrl("entidad/validar", array("id"=>$data->id))',
					'options'=>array(
							'class'=>'btn btn-success btn-small',
					),
					'visible' => '($data->estado == 1) ? "1" : 0'
				)
			),
			'htmlOptions'=>array('style'=>'width: 50px'),
		)
	),
)); ?>