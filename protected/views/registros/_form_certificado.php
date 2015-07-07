<?php

?>
<script type="text/javascript">
<!--

//-->
function modalCertificado(id){
	
	$("#Registros_update_id").val(id);
	$("#modalCertificado").addClass("in");
	
	return false;
}

function cerrarModal(id){
	$("#"+id).addClass("hide");
}

function generarCertificado(){

	fecha 		= $("#Registros_update_fecha_act").val();
	numero 		= $("#Registros_numero_registro").val();
	aprobado 	= $('#Registros_update_aprobadop').val();
	elaborado 	= $('#Registros_update_elaborado').val();
	id 			= $('#Registros_update_id').val();
	
	$.post("../generarCertificado",{id: id,aprobado:aprobado,elaborado:elaborado,opt: 0,fechaAct: fecha,numCol: numero},function(data){
		//window.open("http://<?=$_SERVER['SERVER_NAME'];?>/rnc_app/"+data, "_blank");
		window.open("http://<?=$_SERVER['SERVER_NAME'];?>/"+data, "_blank");	
	});
	
}
</script>
<div class="form">
<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'registroCertificado-form',
		'type'=>'horizontal',
		'enableClientValidation'=>true,
		'enableAjaxValidation'=>false,
));
?>
<br>
<p class="note">Ingrese los siguientes datos para crear el certificado:</p>

<?php 
	echo $form->hiddenField($model, 'id');
	echo $form->textFieldRow($model, 'aprobadop');
	echo $form->textFieldRow($model, 'elaborado');
?>
<div id="catalogouser-botones-internos" class="form-actions pull-right">
<?php 
	$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'registro-cancel-form-submit', 'type'=>'success', 'label'=>'Generar certificado', 'htmlOptions' => array('onclick' => 'generarCertificado()')));
?>
</div>
<?php $this->endWidget(); ?>
</div>