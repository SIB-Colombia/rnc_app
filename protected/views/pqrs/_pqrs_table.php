<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'entidades_lista-grid',
	//'fixedHeader' => true,
	'dataProvider'=>$listPqrs,
	//'responsiveTable' => true,
	'filter'=>$model,
	'ajaxUrl'=>array('pqrs/busqueda'),
	'columns'=>array(
		'nombre',
		array('name' => 'entidad_search','value' => 'CHtml::encode((Entidad::model()->findByPk($data->entidad_id) !== null) ? Entidad::model()->findByPk($data->entidad_id)->titular : (($data->entidad_otra != "") ? $data->entidad_otra : ""))'),
		array('name' => 'numero_registro_search','value' => 'CHtml::encode(isset($data->registros->numero_registro) ? $data->registros->numero_registro : "")'),
		array('name' => 'tipoSol_search','value' => ' CHtml::encode(($data->tipo_solicitud == 1) ? "Petición" : (($data->tipo_solicitud == 2) ? "Queja" : (($data->tipo_solicitud == 3) ? "Felicitación" : "No Asignado")))'),
		array('name' => 'estado_search','value' => '($data->estado == 0) ? "Pendiente" : "Cerrado"'),
		'fecha',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=> '{view}',
			'buttons' => array('view'),
			'htmlOptions'=>array('style'=>'width: 50px'),
		)
	),
)); ?>