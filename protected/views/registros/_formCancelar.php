<script type="text/javascript">
function enviarFormAjax(){
	
	$.post("cancelarRegistro", $("#registroCancelar-form").serialize(),function(data){
		if(data.status == 'failure'){
			alert("Ocurrió un problema y no se pudo cancelar el registro");
			window.location.href ="<?=Yii::app()->request->requestUri;?>";
		}else{
			alert("El registro fue cancelado con éxito.");
			window.location.href ="<?=Yii::app()->request->requestUri;?>";
		}
	},"json");
}
</script>
<div class="form">
<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'registroCancelar-form',
		'type'=>'horizontal',
		'enableClientValidation'=>true,
		'enableAjaxValidation'=>false,
));
?>
<br>
<p class="note">Si está seguro de cancelar el registro favor complete la siguiente información:</p>

<?php 
	echo $form->hiddenField($model, 'id');
	echo $form->textAreaRow($model, 'comentarioCancelar', array('class'=>'span4', 'rows'=>4));
?>
<div id="catalogouser-botones-internos" class="form-actions pull-right">
<?php 
	$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'registro-cancel-form-submit', 'type'=>'success', 'label'=>'Cancelar registro', 'htmlOptions' => array('onclick' => 'enviarFormAjax()')));
?>
</div>
<?php $this->endWidget(); ?>
</div>