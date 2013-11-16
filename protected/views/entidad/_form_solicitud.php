<?php
/* @var $this EntidadController */
/* @var $model Entidad */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCoreScript('jquery.ui');

?>
<script type="text/javascript">
function resetForm(id) {
	$('#'+id).each(function(){
	        this.reset();
	});
}

function activarTipo()
{
	tipoTitular = $("#Entidad_tipo_titular").val();
	//alert(tipoTitular);
	if(tipoTitular == 2){
		$("#Entidad_representante_legal").removeAttr("disabled");
		$("#Entidad_tipo_id_rep").removeAttr("disabled");
		$("#Entidad_representante_id").removeAttr("disabled");
	}else if (tipoTitular == 1) {
		$("#Entidad_representante_legal").attr("disabled",true);
		$("#Entidad_tipo_id_rep").attr("disabled",true);
		$("#Entidad_representante_id").attr("disabled",true);
	}
}

</script>

<div class="form">

	<?php 
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id'=>'entidad-form',
			'type'=>'horizontal',
			'enableClientValidation'=>true,
			'enableAjaxValidation'=>false,
	));
	?>
	<p class="note" style="color: #999">
		Apreciado usuario: diligencie la siguiente información que será validada por el administrador del Registro Nacional de Colecciones. 
		Una vez aprobada su solicitud se enviará al correo electrónico registrado el usuario y contraseña, con los cuales podrá registrar o actualizar las colecciones biológicas de la entidad o persona titular.
	</p>
	<p class="note" style="color: #999">Los campos con <span class="required">*</span> son obligatorios.</p>
	
	<?php echo $form->errorSummary($model); ?>
	
	<fieldset>
		<legend class="form_legend">Datos del titular de la colección</legend>
		<?php 
			echo $form->dropDownListRow($model, 'tipo_titular', $model->listarTipo(),array('onchange' => 'activarTipo()'));
			echo $form->textFieldRow($model, 'titular', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo $form->dropDownListRow($model, 'tipo_nit', $model->listarTipoIdTit());
			echo $form->textFieldRow($model, 'nit', array('size'=>32,'maxlength'=>64, 'class'=>'textareaA'));
			echo $form->textFieldRow($model, 'representante_legal', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
			echo $form->dropDownListRow($model, 'tipo_id_rep', $model->listarTipoIdRep(),array('disabled'=>true));
			echo $form->textFieldRow($model, 'representante_id', array('size'=>32,'maxlength'=>64, 'class'=>'textareaA','disabled'=>true));
			echo $form->dropDownListRow($model, 'ciudad_id', $model->ListarCiudades());
			echo $form->textFieldRow($model, 'direccion', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo $form->textFieldRow($model, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo $form->textFieldRow($model, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA'));
		?>
	</fieldset>
	
	<fieldset>
		<legend class="form_legend">Datos de la persona que realiza la solicitud</legend>
		<?php 
			echo $form->textFieldRow($model->dilegenciadores, 'nombre', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo $form->textFieldRow($model->dilegenciadores, 'dependencia', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo $form->textFieldRow($model->dilegenciadores, 'cargo', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo $form->textFieldRow($model->dilegenciadores, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo $form->textFieldRow($model->dilegenciadores, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA'));
		?>
	</fieldset>
	
	<div id="catalogouser-botones-internos" class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Enviar' : 'Actualizar')); ?>
    	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'id'=>'catalogo-user-form-interno-reset', 'label'=>'Limpiar campos')); ?>
    </div>
	<?php $this->endWidget(); ?>
</div>