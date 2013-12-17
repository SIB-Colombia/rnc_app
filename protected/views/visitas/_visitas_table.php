<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'visitas_lista-grid',
	//'fixedHeader' => true,
	'dataProvider'=>$listVisitas,
	//'responsiveTable' => true,
	//'filter'=>$model,
	'ajaxUrl'=>array('visitas/busqueda'),
	'columns'=>array(
			'registros.numero_registro',
			'registros.entidad.titular',
			'county.county_name',
			'fecha_visita',
			'concepto',
			array(
					'class'=>'bootstrap.widgets.TbButtonColumn',
						
					'htmlOptions'=>array('style'=>'width: 50px'),
			)
	),
)); ?>