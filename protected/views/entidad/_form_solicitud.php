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

function actSelectCiudad(dato,id){
	$.post("cargaCiudad",{idDpto: $(dato).val()},function(data){
		var options = '';
		for(var i = 0; i < data.length; i++){
			options += '<option value="' + data[i].id + '">' + data[i].nombre + '</option>';
		}
		$("#"+id).html(options);
	},"json");
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
		Por favor diligencie el siguiente formulario, con la información del TITULAR de la(s) colección(es) biológica(s).
		Una vez aprobada su solicitud se enviará al correo electrónico registrado el usuario y la contraseña, que le permitirá registrar o actualizar la información de la o las colecciones biológicas que el titular tenga a su cargo.
		<br>TITULAR: organización o persona responsable jurídicamente de las colecciones biológicas. 
	</p>
	
	
	<?php echo $form->errorSummary($model); ?>
	
	<fieldset>
		<legend class="form_legend">Datos del titular de la colección</legend>
		<p class="note" style="color: #999;text-align: justify;margin-bottom: 20px">Los campos con <span class="required">*</span> son obligatorios.</p>
		<?php 
			echo $form->dropDownListRow($model, 'tipo_titular', $model->listarTipo(),array('onchange' => 'activarTipo()'));
			echo '<i class="icon-info-sign" rel="tooltip" title = "Clase de personalidad jurídica del titular de la colección (Natural o jurídica)"></i>';
			echo $form->textFieldRow($model, 'titular', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo '<i class="icon-info-sign" rel="tooltip" title = "Nombre de la organización o persona responsable jurídicamente de las colecciones"></i>';
			echo $form->dropDownListRow($model, 'tipo_nit', $model->listarTipoIdTit());
			echo '<i class="icon-info-sign" rel="tooltip" title = "Tipo de identificación del titular de la colección"></i>';
			echo $form->textFieldRow($model, 'nit', array('size'=>32,'maxlength'=>64, 'class'=>'textareaA'));
			echo '<i class="icon-info-sign" rel="tooltip" title = "El campo no permite guiones o espacios"></i>';
			echo $form->textFieldRow($model, 'representante_legal', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
			echo '<i class="icon-info-sign" rel="tooltip" title = "Nombre de la persona que actúa en representación legal de la organización titular de la colección"></i>';
			echo $form->dropDownListRow($model, 'tipo_id_rep', $model->listarTipoIdRep(),array('disabled'=>true));
			echo '<i class="icon-info-sign" rel="tooltip" title = "Tipo de identificación del representante legal de la colección"></i>';
			echo $form->textFieldRow($model, 'representante_id', array('size'=>32,'maxlength'=>64, 'class'=>'textareaA','disabled'=>true));
			echo '<i class="icon-info-sign" rel="tooltip" title = "El campo no permite guiones o espacios."></i>';
			echo $form->dropDownListRow($model, 'departamento_id', $model->ListarDepartamentos(),array('prompt' => 'Seleccione...','onChange' => 'actSelectCiudad(this,"Entidad_ciudad_id")'));
			echo '<i class="icon-info-sign" rel="tooltip" title = "Departamento donde se encuentra el titular de la colección"></i>';
			echo $form->dropDownListRow($model, 'ciudad_id', $model->ListarCiudades($model->departamento_id),array('prompt' => 'Seleccione...'));
			echo '<i class="icon-info-sign" rel="tooltip" title = "Municipio donde se encuentra el titular de la colección"></i>';
			echo $form->textFieldRow($model, 'direccion', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo '<i class="icon-info-sign" rel="tooltip" title = "Dirección del titular de la colección"></i>';
			echo $form->textFieldRow($model, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo '<i class="icon-info-sign" rel="tooltip" title = "Número telefónico del titular de la colección, si tiene una extensión por favor deje un espacio y escríbala"></i>';
			echo $form->textFieldRow($model, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA'));
			echo '<i class="icon-info-sign" rel="tooltip" title = " Correo electrónico (E-mail) de contacto del titular de la colección"></i>';
			echo $form->textAreaRow($model, 'colecciones', array('class'=>'span4', 'rows'=>5));
			echo '<i class="icon-info-sign" rel="tooltip" title = " Nombre de las colecciones a registrar"></i>';
			echo $form->dropDownListRow($model, 'tipo_institucion_id', Tipo_Institucion::model()->listarTipoInstitucion(),array('prompt' => 'Seleccionar...'));
			echo '<i class="icon-info-sign" rel="tooltip" title = " Tipo de institución"></i>';
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
    	<?php 
	    	$this->widget('bootstrap.widgets.TbButtonGroup', array(
	    			'buttons'=>array(
	    					array('label'=>'Cancel', 'url'=>array('site/index')),
	    			),
	    	));
    	?>
    </div>
	<?php $this->endWidget(); ?>
</div>