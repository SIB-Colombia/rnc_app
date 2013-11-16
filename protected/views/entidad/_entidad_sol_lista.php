<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'type'=>'striped bordered condensed',
    'id'=>'entidad-sol-grid',
    'dataProvider'=>$listEntidades,
    'ajaxUrl'=>'',
	'columns'=>array(
    	'fecha_creacion',
		'titular',
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
				)
			),
			'htmlOptions'=>array('style'=>'width: 50px'),
		)
	),
)); ?>