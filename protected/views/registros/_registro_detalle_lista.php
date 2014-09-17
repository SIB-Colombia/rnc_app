<?php
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'registros_lista-grid',
	'dataProvider'=>$listRegistros,
	'ajaxUrl'=>'',
	'columns'=>array(
		'acronimo',
		array('name' => 'Municipio','value' => 'CHtml::encode(isset($data->county->county_name) ? $data->county->county_name : "No Asignado")'),
		'estado_registro.nombre',
		'fecha_act',
		'fecha_rev',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=> '{view}{update}{delete}',
			'buttons' => array('view' => array("url" => 'Yii::app()->createUrl("registros/viewDetail", array("id"=>$data->id))','visible' => '1'),
						'update' => array("url" => 'Yii::app()->createUrl("registros/updateDetail", array("id"=>$data->id))','visible' => '($data->estado == 0 || $data->estado == 3) ? "1" : 0'),
						'delete' => array("url" => 'Yii::app()->createUrl("registros/deleteDetail", array("id"=>$data->id))','visible' => '($data->estado == 0 || $data->estado == 3) ? "1" : 0')),
			'htmlOptions'=>array('style'=>'width: 50px'),
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{val}',
			'buttons'=>array
			(
				'val' => array
				(
					'label'=>'Cancelar',
					'url'=>'$data->id',
					'click' => 'function(){cancelaRegistro($(this).attr("href"))}',
					'visible' => '(Yii::app()->user->getState("roles") == "admin") ? "1" : 0',
						
					'options'=>array(
							'class'=>'btn btn-success btn-small',
							'data-toggle' => 'modal',
							'data-target' => '#modalCancel',
					),
				)
			),
			'htmlOptions'=>array('style'=>'width: 50px'),
		)
	),
)); ?>

<script>
function cancelaRegistro(id){
	
	$("#Registros_update_id").val(id);
	$("#modalCancel").css("display","block");
	$("#modalCancel").addClass("in");
	
	return false;
}
</script>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modalCancel','htmlOptions' => array('style'=>'width:620px;padding:20px'))); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    	<h3>Cancelar Registro</h3>
	</div>
<?php echo $this->renderPartial('_formCancelar', array('model'=>Registros_Update::model(),'ajaxMode' => true)); ?>
<?php $this->endWidget(); ?>