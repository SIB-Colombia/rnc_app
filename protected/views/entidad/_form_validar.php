<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
$userRole  = Yii::app()->user->getState("roles");

?>

<script type="text/javascript">
function resetForm(id) {
	$('#'+id).each(function(){
	        this.reset();
	});
}

function modalOpen(){
	$("#modalUser").removeClass("hide");
	$("#modalUser").addClass("in");
	
	return false;
}

function cerrarModal(id){
	$("#"+id).removeClass("in");
	$("#"+id).addClass("hide");
}
</script>

<div class="form">

<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'entidad-form-validar',
		'type'=>'horizontal',
		'enableClientValidation'=>true,
		'enableAjaxValidation'=>false,
));
?>

<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

<?php echo $form->errorSummary($model); ?>

<fieldset>
	<legend class="form_legend">Datos del titular de la colección</legend>
	<?php 
		echo $form->dropDownListRow($model, 'tipo_titular', $model->listarTipo(),array('prompt' => 'Seleccionar...','onchange' => 'activarTipo()','disabled'=>false));
		echo $form->textFieldRow($model, 'titular', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>false));
		echo $form->dropDownListRow($model, 'tipo_nit', $model->listarTipoIdTit(),array('prompt' => 'Seleccionar...','disabled'=>false));
		echo $form->textFieldRow($model, 'nit', array('size'=>32,'maxlength'=>64, 'class'=>'textareaA','disabled'=>false));
		echo $form->textFieldRow($model, 'representante_legal', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>false));
		echo $form->dropDownListRow($model, 'tipo_id_rep', $model->listarTipoIdRep(),array('prompt' => 'Seleccionar...','disabled'=>false));
		echo $form->textFieldRow($model, 'representante_id', array('size'=>32,'maxlength'=>64, 'class'=>'textareaA','disabled'=>false));
		echo $form->dropDownListRow($model, 'departamento_id', $model->ListarDepartamentos(),array('prompt' => 'Seleccione...','onChange' => 'actSelectCiudad(this,"Entidad_ciudad_id")'));
		echo $form->dropDownListRow($model, 'ciudad_id', $model->ListarCiudades($model->departamento_id),array('prompt' => 'Seleccionar...','disabled'=>false));
		echo $form->textFieldRow($model, 'direccion', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>false));
		echo $form->textFieldRow($model, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>false));
		echo $form->textFieldRow($model, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA','disabled'=>false));
		echo $form->dropDownListRow($model, 'tipo_institucion_id', Tipo_Institucion::model()->listarTipoInstitucion(),array('prompt' => 'Seleccionar...','disabled'=>false));
	?>
</fieldset>

<fieldset>
	<legend class="form_legend">Datos de la persona que realiza la solicitud</legend>
	<?php 
		echo $form->textFieldRow($model->dilegenciadores, 'nombre', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>false));
		echo $form->textFieldRow($model->dilegenciadores, 'dependencia', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>false));
		echo $form->textFieldRow($model->dilegenciadores, 'cargo', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>false));
		echo $form->textFieldRow($model->dilegenciadores, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>false));
		echo $form->textFieldRow($model->dilegenciadores, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA','disabled'=>false));
	?>
</fieldset>

<fieldset>
	<legend class="form_legend">Aprobar Entidad</legend>
	<?php 
		echo $form->radioButtonListInlineRow($model, 'aprobado', array('Si','No'));
		echo $form->textAreaRow($model, 'comentario', array('class'=>'span4', 'rows'=>5));
		echo $form->dropDownListRow($model, 'usuario_id', $model->ListarUsuarios("entidad"),array('prompt' => 'Seleccionar...'));
		
		$this->widget('bootstrap.widgets.TbButton', array(
				'label'=>'Crear Usuario',
				'type'=>'success',
				'htmlOptions'=>array(
						'data-toggle'=>'modal',
						'data-target'=>'#modalUser',
						'style'	=> 'float:left;margin-left: 10px',
						'onclick' => 'modalOpen()'
				),
		)); 
		
	?>
	
</fieldset>

<div id="catalogouser-botones-internos" class="form-actions pull-right">
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'success', 'label'=>$model->isNewRecord ? 'Guardar' : 'Actualizar')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'id'=>'catalogo-user-form-interno-reset', 'label'=>'Limpiar campos')); ?>
    <?php 
		$this->widget('bootstrap.widgets.TbButtonGroup', array(
			'buttons'=>array(
				array('label'=>'Cancel', 'url'=>array('admin/panel')),
			),
		));
	?>
</div>
<?php $this->endWidget(); ?>
</div>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modalUser','htmlOptions' => array('style'=>'width:620px;padding:20px'))); ?>
	<div class="modal-header">
    <a class="close" data-dismiss="modal"  onclick = "cerrarModal('modalUser');">&times;</a>
    	<h3>Crear Usuario</h3>
	</div>
<?php echo $this->renderPartial('../usuario/_form', array('model'=>$model->usuario,'ajaxMode' => true)); ?>
<?php $this->endWidget(); ?>