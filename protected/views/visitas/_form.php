<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCoreScript('jquery.ui');
$userRole  = Yii::app()->user->getState("roles");
?>
<script type="text/javascript">
function enviarForm(){
	$("#visita-form").submit();
}

function resetForm(id) {
	$('#'+id).each(function(){
	        this.reset();
	});
}

</script>

<div class="form">
<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'visita-form',
		'type'=>'horizontal',
		'enableClientValidation'=>true,
		'enableAjaxValidation'=>false,
));
?>
	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>
	<?php 	echo $form->errorSummary($model);
			echo $form->errorSummary($model->registros);
			echo $form->errorSummary($model->dilegenciadores);
	?>
	
	<fieldset>
		<legend class="form_legend">Datos de la Visita</legend>
		
		<?php 
			echo $form->textFieldRow($model->registros, 'numero_registro', array('size'=>32,'maxlength'=>64, 'class'=>'textareaA'));
			echo $form->dropDownListRow($model, 'ciudad_id', $model->ListarCiudades(),array('prompt' => 'Seleccionar...'));
			echo $form->datepickerRow($model, 'fecha_visita');
			echo $form->textAreaRow($model, 'concepto', array('class'=>'span4', 'rows'=>5));
		?>
	</fieldset>
	
	<fieldset>
		<legend class="form_legend">Datos de la persona que realizó la visita</legend>
		<?php 
			echo $form->textFieldRow($model->dilegenciadores, 'nombre', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo $form->textFieldRow($model->dilegenciadores, 'dependencia', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo $form->textFieldRow($model->dilegenciadores, 'cargo', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo $form->textFieldRow($model->dilegenciadores, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo $form->textFieldRow($model->dilegenciadores, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA'));
		?>
	</fieldset>
	
	<div id="catalogouser-botones-internos" class="form-actions pull-right">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Guardar' : 'Actualizar', 'htmlOptions' => array('onclick' => 'enviarForm()'))); ?>
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'id'=>'catalogo-user-form-interno-reset', 'label'=>'Limpiar campos')); ?>
    </div>
    
<?php $this->endWidget(); ?>
</div>