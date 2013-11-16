<?php 
$dataProvider = new CArrayDataProvider($rawData=$model->pcregionnaturalCes, array(
	'keyField'=>'id_region_natural',
	'sort'=>array(
		'attributes'=>array(
			'regionnatural', 'id_region_natural',
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
    'id'=>'regionesnaturalessasignadas-grid',
    'dataProvider'=>$dataProvider,
	'enablePagination' => true,
    'columns'=>array(
    	array( 'name'=>'Id', 'value'=>'$data->id_region_natural', 'htmlOptions'=>array('width'=>'80')),
    	array( 'name'=>'Región natural', 'value'=>'$data->regionnatural'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'deleteButtonUrl'=>'Yii::app()->createUrl("/catalogo/delete", array("id"=>$data["catalogoespecies_id"], "idRegionNatural"=>$data["id_region_natural"]))',
		),
	),
));

?>