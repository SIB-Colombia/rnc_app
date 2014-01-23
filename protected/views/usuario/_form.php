<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCoreScript('jquery.ui');
$userRole  = Yii::app()->user->getState("roles");
?>

<script type="text/javascript">
function enviarForm(){
	$("#usuario-form").submit();
}

function resetForm(id) {
	$('#'+id).each(function(){
	        this.reset();
	});
}

function enviarFormAjax(){

	$.post("../../usuario/create", $("#usuario-form").serialize(),function(data){
		if(data.status == 'failure'){
			$("#usuario-form").remove();
			$("#modalUser").append(data.div);
		}else{
			window.location.href ="<?=Yii::app()->request->requestUri;?>";
		}
	},"json");
}

<?php 
	if(isset($ajaxMode)){
		echo 'urlAjax 			= "../../usuario/validarUsuarioAjax";';
	}else if(isset($model->id)){
		echo 'urlAjax 			= "../validarUsuarioAjax";';
	}else{
		echo 'urlAjax 			= "validarUsuarioAjax";';
	}
?>
	
function validarUsuario(obj,user){
	$.post(urlAjax,{usuario: user},function(data){
			if(data == 1){
				$(obj).addClass("error");
				$(obj).focus();
				alert("El Usuario "+user+" ya existe en el sistema.");
			}else{
				$(obj).removeClass("error");
			}
		});
}


</script>
<div class="form">

<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'usuario-form',
		'type'=>'horizontal',
		'enableClientValidation'=>true,
		'enableAjaxValidation'=>true,
));
?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	
		
		<?php 
			$action = $this->action->id;
			echo $form->textFieldRow($model, 'username', array('size'=>32,'maxlength'=>32, 'class'=>'textareaA', 'onchange' => 'validarUsuario(this,this.value);')); 
			echo $form->passwordFieldRow($model, 'password', array('size'=>64,'maxlength'=>64, 'class'=>'textareaA'));
			if($action == "update"){
				echo $form->passwordFieldRow($model, 'newpassword', array('size'=>64,'maxlength'=>64, 'class'=>'textareaA'));
			}
			echo $form->passwordFieldRow($model, 'password2', array('size'=>64,'maxlength'=>64, 'class'=>'textareaA'));
			echo $form->textFieldRow($model, 'email', array('size'=>32,'maxlength'=>32, 'class'=>'textareaA'));
			$disable = true;
			if($userRole == "admin"){
				$disable = false;
			}
			echo $form->dropDownListRow($model, 'role', array('admin' => 'Admin', 'entidad' => 'Entidad'),array('prompt'=>'Seleccione','disabled'=>$disable));
			
		?>
				
		<div id="catalogouser-botones-internos" class="form-actions pull-right">
		<?php 
			if(isset($ajaxMode)){
				$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'success', 'label'=>$model->isNewRecord ? 'Crear' : 'Crear', 'htmlOptions' => array('onclick' => 'enviarFormAjax()'))); 
			}else{
				$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'success', 'label'=>$model->isNewRecord ? 'Guardar' : 'Actualizar', 'htmlOptions' => array('onclick' => 'enviarForm()')));
			}
		?>
    	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'id'=>'catalogo-user-form-interno-reset', 'label'=>'Limpiar campos')); ?>
    	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->