<?php
$dataProvider = new CArrayDataProvider($rawData=$model->pcdepartamentosCes, array(
	'keyField'=>'id_departamento',
	'sort'=>array(
		'attributes'=>array(
			'sub_nombre', 'id_departamento',
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
    'id'=>'departamentosasignados-grid',
    'dataProvider'=>$dataProvider,
	'enablePagination' => true,
    'columns'=>array(
    	array( 'name'=>'Id', 'value'=>'$data->id_departamento', 'htmlOptions'=>array('width'=>'80')),
    	array( 'name'=>'Nombre departamento', 'value'=>'$data->sub_nombre'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'deleteButtonUrl'=>'Yii::app()->createUrl("/catalogo/delete", array("id"=>$data["catalogoespecies_id"], "idDepartamento"=>$data["id_departamento"]))',
		),
	),
));

?>