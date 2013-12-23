<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'type'=>'striped bordered condensed',
    'id'=>'pqrs-sol-grid',
    'dataProvider'=>$listPqrs,
    'ajaxUrl'=>'',
	'columns'=>array(
    	'nombre',
			array('name' => 'tipo_solicitud','value' => ' CHtml::encode(($data->tipo_solicitud == 1) ? "Petición" : (($data->tipo_solicitud == 2) ? "Queja" : (($data->tipo_solicitud == 3) ? "Felicitación" : "No Asignado")))'),
		'fecha',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{val}',
			'buttons'=>array
			(
				'val' => array
				(
						'label'=>'Responder',
						'url'=>'Yii::app()->createUrl("pqrs/view", array("id"=>$data->id))',
						'options'=>array(
								'class'=>'btn btn-success btn-small',
						),
				)
			),
			'htmlOptions'=>array('style'=>'width: 50px'),
		)
	),
)); ?>