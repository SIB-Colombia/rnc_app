<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
$userRole  = Yii::app()->user->getState("roles");
?>

<script type="text/javascript">
function enviarFormAjax(){

	$.post("../usuario/recuperaPassword", $("#userForm").serialize(),function(data){
		if(data.status == 'failure'){
			alert("El usuario con el correo ingresado no existe, favor enviar una solicitud de usuario.");
		}else{
			alert("Se ha enviado un correo con la información de ingreso.");
		}
	},"json");
}

</script>

<div class="form">
<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'userForm',
    'type'=>'search',
    'htmlOptions'=>array('class'=>'well'),
)); ?>
 
<?php echo $form->textFieldRow($model, 'email', array('class'=>'input-medium', 'prepend'=>'<i class="icon-envelope"></i>', 'style' => 'width:230px')); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'buttton', 'label'=>'Enviar','htmlOptions' => array('onclick' => 'enviarFormAjax()'))); ?>
 
<?php $this->endWidget(); ?>

</div>