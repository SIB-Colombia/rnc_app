<?php 
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'registros_lista-grid',
	'dataProvider'=>$listRegistros,
	'ajaxUrl'=>'',
	'columns'=>array(
		'acronimo',
		array('name' => 'Ciudad','value' => 'CHtml::encode(isset($data->county->county_name) ? $data->county->county_name : "No Asignado")'),
		array('name' => 'estado','value' => '($data->estado == 0) ? "Sin Enviar" : (($data->estado == 1) ? "En Revisión" : (($data->estado == 2) ? "Aprobado" : "No Aprobado"))'),
		'fecha_act',
		'fecha_rev',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=> '{view}{update}{delete}',
			'buttons' => array('view' => array("url" => 'Yii::app()->createUrl("registros/viewDetail", array("id"=>$data->id))','visible' => '1'),
						'update' => array("url" => 'Yii::app()->createUrl("registros/updateDetail", array("id"=>$data->id))','visible' => '($data->estado == 0) ? "1" : 0'),
						'delete' => array("url" => 'Yii::app()->createUrl("registros/deleteDetail", array("id"=>$data->id))','visible' => '($data->estado == 0) ? "1" : 0')),
			'htmlOptions'=>array('style'=>'width: 50px'),
		)
	),
)); ?>