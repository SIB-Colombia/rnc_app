<?php 
$config = array('keyField'=>'id_organizacion');
$dataProvider = new CArrayDataProvider($rawData=$model->pcorganizacionesCes, array(
	'keyField'=>'id_organizacion',
	'sort'=>array(
		'attributes'=>array(
			'organizaciones', 'id_organizacion',
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
    'id'=>'organizacionesasignadas-grid',
    'dataProvider'=>$dataProvider,
	'enablePagination' => true,
    'columns'=>array(
    	array( 'name'=>'Id', 'value'=>'$data->id_organizacion', 'htmlOptions'=>array('width'=>'80')),
    	array( 'name'=>'Organización', 'value'=>'$data->organizaciones'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'deleteButtonUrl'=>'Yii::app()->createUrl("/catalogo/delete", array("id"=>$data["catalogoespecies_id"], "idOrganizacion"=>$data["id_organizacion"]))',
		),
	),
));

?>