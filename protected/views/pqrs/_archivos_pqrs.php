<?php 
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'pqrs_lista-grid',
	//'fixedHeader' => true,
	'dataProvider'=>$listArchivos,
	//'responsiveTable' => true,
	//'filter'=>$model,
	'columns'=>array(
		'nombre',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{val}',
			'buttons'=>array
			(
				'val' => array
				(
					'label'=>'Descargar',
					'url'=>'Yii::app()->createUrl("..".DIRECTORY_SEPARATOR.$data->ruta.DIRECTORY_SEPARATOR.$data->nombre)',
					'options'=>array(
							'class'=>'btn btn-success btn-small',
					),
				)
			),
			'htmlOptions'=>array('style'=>'width: 50px'),
		)
	),
)); ?>