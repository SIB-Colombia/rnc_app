<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'type'=>'striped bordered condensed',
    'id'=>'organizaciones-grid',
    'dataProvider'=>$organizaciones->search(),
    'filter'=>$organizaciones,
	'ajaxUrl'=>array('catalogo/updateajaxmodifytables'),
	'bulkActions' => array(
		'actionButtons' => array(
			array(
				'buttonType' => 'button',
				'type' => 'primary',
				'size' => 'small',
				'label' => 'Agregar organizaciones seleccionadas a la lista',
				'click' => 'js:function(checked){
								var values = [];
								checked.each(function(){
									values.push($(this).val());
								}); 
								// now we go the values, do ajax call (for example, you can also do document.href)
								// we are going to push all selected values in a parameter named "IDS" and the ids will be separated by 
								// comma. I assume that you know how to handle that parameter with Yii
								$.ajax({
									url:"'.Yii::app()->createAbsoluteUrl("pcorganizacionesCe/include").'",
									type: "POST",
									data: {ids:values.join(","),idCatalogo:'.$idCatalogo.'},
									success:function(data){
										alert("Las organizaciones seleccionadas han sido asignadas a la ficha.");
										// update the grid now
										$("#organizacionesasignadas-grid").yiiGridView("update");
									}
								});
				}',
				'id' => 'boton_actualizar_organizaciones',
			)
		),
		// if grid doesn't have a checkbox column type, it will attach
		// one and this configuration will be part of it
		'checkBoxColumnConfig' => array(
			'name' => 'id_organizacion'
		),
	),
    'columns'=>array(
    	array( 'name'=>'id_organizacion', 'htmlOptions'=>array('width'=>'80')),
		'organizacion',
		/*array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view}{update}{delete}',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'viewButtonUrl'=>'Yii::app()->createUrl("/Model/view", array("id"=>$data["id_tesauros"]))',
			'updateButtonUrl'=>'Yii::app()->createUrl("/Model/update", array("id"=>$data["id_tesauros"]))',
			'deleteButtonUrl'=>'Yii::app()->createUrl("/Model/delete", array("id"=>$data["id_tesauros"]))',
		),*/
	),
)); ?>