<?php 
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'urls_lista-grid',
	//'fixedHeader' => true,
	'dataProvider'=>$listUrls,
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
					'label'=>'Ir',
					'url'=>'$data->url',
					'options'=>array(
							'class'=>'btn btn-success btn-small',
							'target' => '_blank'
					),
				)
			),
			'htmlOptions'=>array('style'=>'width: 50px'),
		)
	),
)); ?>