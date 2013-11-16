<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'catalogoespeciesverificadas-grid',
	//'fixedHeader' => true,
	'dataProvider'=>$verificadas->search(),
	//'responsiveTable' => true,
	'filter'=>$verificadas,
	'ajaxUrl'=>'index',
	'columns'=>array(
		'catalogoespecies_id',
		array( 'name'=>'taxonnombre_search', 'htmlOptions'=>array('width'=>'280'), 'value'=>'$data->pcaatCe!==null?$data->pcaatCe->taxonnombre:"None"', 'type'=>'raw'),
		//'citacion_id',
		//'contacto_id',
		//'fechaactualizacion',
		'fechaelaboracion',
		//'titulometadato',
		array( 'name'=>'taxonnombrecompleto_search', 'htmlOptions'=>array('width'=>'280'), 'value'=>'$data->pcaatCe!==null?$data->pcaatCe->taxoncompleto:"None"'),
		array( 'name'=>'nombresComunes_search', 'htmlOptions'=>array('width'=>'280'), 'value'=>'$data->listaNombresComunes!==null?$data->listaNombresComunes:"None"', 'type'=>'raw'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'htmlOptions'=>array('style'=>'width: 50px'),
		),
	),
)); ?>