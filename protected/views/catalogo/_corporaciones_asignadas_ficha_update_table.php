<?php
$dataProvider = new CArrayDataProvider($rawData=$model->pccorporacionesCes, array(
	'keyField'=>'id_corporacion',
	'sort'=>array(
		'attributes'=>array(
			'coorporaciones', 'id_corporacion',
		),
	),
	'pagination'=>array(
		'pageSize'=>10,
	),
));

$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
	//'fixedHeader' => true,
	'responsiveTable' => true,
	//'template' => "{items}",
    'id'=>'corporacionesasignadas-grid',
    'dataProvider'=>$dataProvider,
	'enablePagination' => true,
    'columns'=>array(
    	array( 'name'=>'Id', 'value'=>'$data->id_corporacion', 'htmlOptions'=>array('width'=>'80')),
    	array( 'name'=>'CAR', 'value'=>'$data->coorporaciones'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'deleteButtonUrl'=>'Yii::app()->createUrl("/catalogo/delete", array("id"=>$data["catalogoespecies_id"], "idCorporacion"=>$data["id_corporacion"]))',
		),
	),
));

?>