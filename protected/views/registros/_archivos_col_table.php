<?php 
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'entidades_lista-grid',
	//'fixedHeader' => true,
	'dataProvider'=>$listArchivos,
	//'responsiveTable' => true,
	//'filter'=>$model,
	'columns'=>array(
		'nombre',
		array('name' => 'clase','value' => '($data->clase == 1) ? "Anexos" : (($data->clase == 2) ? "Fotos y videos de la colección" : "")'),
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