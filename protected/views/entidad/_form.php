<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCoreScript('jquery.ui');
$userRole  = Yii::app()->user->getState("roles");
?>

<script type="text/javascript">
<?php 
if($this->route != 'entidad/create'){
	echo 'urlAjaxCiudad	= "../cargaCiudad";';
}else{
	echo 'urlAjaxCiudad	= "cargaCiudad";';
}
?>
function enviarForm(){
	$("#entidad-form").submit();
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
	$.post(urlAjaxCiudad,{idDpto: $(dato).val()},function(data){
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
		'id'=>'entidad-form',
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
			echo $form->dropDownListRow($model, 'tipo_titular', $model->listarTipo(),array('prompt' => 'Seleccionar...','onchange' => 'activarTipo()'));
			echo $form->textFieldRow($model, 'titular', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo $form->dropDownListRow($model, 'tipo_nit', $model->listarTipoIdTit(),array('prompt' => 'Seleccionar...'));
			echo $form->textFieldRow($model, 'nit', array('size'=>32,'maxlength'=>64, 'class'=>'textareaA'));
			echo $form->textFieldRow($model, 'representante_legal', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
			echo $form->dropDownListRow($model, 'tipo_id_rep', $model->listarTipoIdRep(),array('prompt' => 'Seleccionar...','disabled'=>true));
			echo $form->textFieldRow($model, 'representante_id', array('size'=>32,'maxlength'=>64, 'class'=>'textareaA','disabled'=>true));
			echo $form->dropDownListRow($model, 'departamento_id', $model->ListarDepartamentos(),array('prompt' => 'Seleccione...','onChange' => 'actSelectCiudad(this,"Entidad_ciudad_id")'));
			echo $form->dropDownListRow($model, 'ciudad_id', $model->ListarCiudades($model->departamento_id,$model->ciudad_id),array('prompt' => 'Seleccionar...'));
			echo $form->textFieldRow($model, 'direccion', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo $form->textFieldRow($model, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo $form->textFieldRow($model, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA'));
			echo $form->dropDownListRow($model, 'tipo_institucion_id', Tipo_Institucion::model()->listarTipoInstitucion(),array('prompt' => 'Seleccionar...','onchange' => ''));
			echo $form->textAreaRow($model, 'colecciones', array('class'=>'span4', 'rows'=>5));
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
				
	<div id="catalogouser-botones-internos" class="form-actions pull-right">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'success', 'label'=>$model->isNewRecord ? 'Guardar' : 'Actualizar', 'htmlOptions' => array('onclick' => 'enviarForm()'))); ?>
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

</div><!-- form -->
		

<?php 
	if($userRole == "admin"){
		$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modalUser','htmlOptions' => array('style'=>'width:620px;padding:20px'))); ?>
	<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    	<h3>Crear Usuario</h3>
	</div>
<?php echo $this->renderPartial('../usuario/_form', array('model'=>$model->usuario,'ajaxMode' => true)); ?>
<?php 
	$this->endWidget(); 
	}
?>