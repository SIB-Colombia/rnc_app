<?php
$dataProvider = new CArrayDataProvider($estadoCites, array(
	'keyField'=>'valor',
	'sort'=>array(
		'attributes'=>array(
			'contenido', 'valor',
		),
	),
	'pagination'=>array(
		'pageSize'=>10,
		'route'=>'catalogo/update'
	),
));


$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
	//'fixedHeader' => true,
	'responsiveTable' => true,
	//'template' => "{items}",
    'id'=>'atributo-estado-cites-asignados-grid',
    'dataProvider'=>$dataProvider,
	'enablePagination' => true,
    'columns'=>array(
    	array( 'name'=>'Id', 'value'=>'$data["valor"]', 'htmlOptions'=>array('width'=>'80')),
    	array( 'name'=>'Nombre', 'value'=>'$data["contenido"]', 'type'=>'raw'),
		array(
    		'class'=>'bootstrap.widgets.TbButtonColumn',
    		'template'=>'{update}{delete}',
    		'htmlOptions'=>array('style'=>'width: 50px'),
    		'buttons'=>array (
    			'update' => array (
    				'label'=>'Modificar',
    				'url'=>'Yii::app()->createUrl("atributovalor/update", array("id"=>$data["valor"]))',
    				'options'=>array(
    					'onClick'=>'callAjaxUpdateAttribute($(this).parent().parent().children(":nth-child(1)").text(), "atributo-estado-cites-asignados-grid");',
    					'data-toggle' => 'modal',
    					'data-target' => '#editarAtributoModal',
    				),
    			),
    			'delete' => array (
    				'label'=>'Borrar',
    				'url'=>'Yii::app()->createUrl("/catalogo/deleteattribute", array("idAtributo"=>$data["valor"]))',
    			),
    		),
    	),
	),
));

?>