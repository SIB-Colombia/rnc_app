<?php
/* @var $this EntidadController */
/* @var $model Entidad */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCoreScript('jquery.ui');

?>
<script type="text/javascript">
function enviarForm(){
	$("#solicitud-form").submit();
}

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
			'id'=>'solicitud-form',
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
			echo '<i class="icon-info-sign" rel="tooltip" title = "1) Persona Natural 2) Persona Jurídica"></i>';
			echo $form->textFieldRow($model, 'titular', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo '<i class="icon-info-sign" rel="tooltip" title = "Nombre de la institución, entidad, organización o persona que alberga la colección."></i>';
			echo $form->dropDownListRow($model, 'tipo_nit', $model->listarTipoIdTit());
			echo '<i class="icon-info-sign" rel="tooltip" title = "1) Nit 2) Cédula."></i>';
			echo $form->textFieldRow($model, 'nit', array('size'=>32,'maxlength'=>64, 'class'=>'textareaA'));
			echo '<i class="icon-info-sign" rel="tooltip" title = "El campo no permite guiones o espacios"></i>';
			echo $form->textFieldRow($model, 'representante_legal', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
			echo '<i class="icon-info-sign" rel="tooltip" title = "Nombre de la persona que actúa legalmente en representación de la institución anfitriona de la colección biológica."></i>';
			echo $form->dropDownListRow($model, 'tipo_id_rep', $model->listarTipoIdRep(),array('disabled'=>true));
			echo '<i class="icon-info-sign" rel="tooltip" title = "1) Cédula 2) Cédula Extranjería"></i>';
			echo $form->textFieldRow($model, 'representante_id', array('size'=>32,'maxlength'=>64, 'class'=>'textareaA','disabled'=>true));
			echo '<i class="icon-info-sign" rel="tooltip" title = "El campo no permite guiones o espacios."></i>';
			echo $form->dropDownListRow($model, 'ciudad_id', $model->ListarCiudades());
			echo '<i class="icon-info-sign" rel="tooltip" title = "Ciudad del Titular."></i>';
			echo $form->textFieldRow($model, 'direccion', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo '<i class="icon-info-sign" rel="tooltip" title = "Dirección del Titular."></i>';
			echo $form->textFieldRow($model, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo '<i class="icon-info-sign" rel="tooltip" title = "Telefono Titular."></i>';
			echo $form->textFieldRow($model, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA'));
			echo '<i class="icon-info-sign" rel="tooltip" title = " Dirección electrónica (e-mail) de contacto de la institución anfitriona."></i>';
		?>
	</fieldset>
	
	<fieldset>
		<legend class="form_legend">Datos de la persona que realiza la solicitud</legend>
		<?php 
			echo $form->textFieldRow($model->dilegenciadores, 'nombre', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo '<i class="icon-info-sign" rel="tooltip" title = "Nombre de la persona que realiza la solicitud de registro del titular de la colección."></i>';
			echo $form->textFieldRow($model->dilegenciadores, 'dependencia', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo '<i class="icon-info-sign" rel="tooltip" title = "Área o dependencia en la que se desempeña el solicitante del registro de la entidad."></i>';
			echo $form->textFieldRow($model->dilegenciadores, 'cargo', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo '<i class="icon-info-sign" rel="tooltip" title = "Cargo de quien realiza la solictud."></i>';
			echo $form->textFieldRow($model->dilegenciadores, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo '<i class="icon-info-sign" rel="tooltip" title = "Telefono de quien hace la solictud."></i>';
			echo $form->textFieldRow($model->dilegenciadores, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA'));
			echo '<i class="icon-info-sign" rel="tooltip" title = " Dirección electrónica (e-mail) de quien realiza la solicitud ."></i>';
		?>
	</fieldset>
	
	<div id="catalogouser-botones-internos" class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'success', 'label'=>$model->isNewRecord ? 'Enviar' : 'Actualizar', 'htmlOptions' => array('onclick' => 'enviarForm()'))); ?>
    	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'id'=>'catalogo-user-form-interno-reset', 'label'=>'Limpiar campos')); ?>
    </div>
	<?php $this->endWidget(); ?>
</div>