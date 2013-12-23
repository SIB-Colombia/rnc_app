<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'type'=>'striped bordered condensed',
    'id'=>'registros-sol-grid',
    'dataProvider'=>$listRegistros,
    'ajaxUrl'=>'',
	'columns'=>array(
		array('name' => 'numero_registro','value' => '($data->registros->numero_registro == 0) ? "Sin Definir" : CHtml::encode($data->registros->numero_registro)'),
    	array('name' => 'acronimo','value' => 'CHtml::encode($data->acronimo)'),
		array('name' => 'titular','value' => 'CHtml::encode($data->registros->entidad->titular)'),
		'fecha_act',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{val}',
			'buttons'=>array
			(
				'val' => array
				(
					'label'=>'Validar',
					'url'=>'Yii::app()->createUrl("registros/validar", array("id"=>$data->id))',
					'options'=>array(
							'class'=>'btn btn-success btn-small',
					),
				)
			),
			'htmlOptions'=>array('style'=>'width: 50px'),
		)
	),
)); ?>