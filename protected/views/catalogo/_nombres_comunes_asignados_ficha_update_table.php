<?php 
$config = array('keyField'=>'id_tesauros');
$dataProvider = new CArrayDataProvider($rawData=$model->pctesaurosCes, $config);

$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped',
	//'fixedHeader' => true,
	'responsiveTable' => true,
	'template' => "{items}",
    'id'=>'nombrescomunesasignados-grid',
    'dataProvider'=>$dataProvider,
	//'ajaxUrl'=>'/index.php/catalogo/updateajaxmodifytables',
    'columns'=>array(
    	array( 'name'=>'Id tesauro', 'value'=>'$data->id_tesauros', 'htmlOptions'=>array('width'=>'80')),
    	array( 'name'=>'Nombre común', 'value'=>'$data->tesauronombre'),
    	array( 'name'=>'Grupo humano', 'value'=>'$data->grupohumano'),
    	array( 'name'=>'Idioma', 'value'=>'$data->idioma'),
    	array( 'name'=>'Región donde se usa', 'value'=>'$data->regionesgeograficas'),
    	array( 'name'=>'Tesauro completo', 'value'=>'$data->tesaurocompleto'),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'deleteButtonUrl'=>'Yii::app()->createUrl("/catalogo/delete", array("id"=>$data["catalogoespecies_id"], "idTesauro"=>$data["id_tesauros"]))',
		),
	),
));

?>