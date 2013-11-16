<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCoreScript('jquery.ui');
$userRole  = Yii::app()->user->getState("roles");
?>

<script type="text/javascript">
function resetForm(id) {
	$('#'+id).each(function(){
	        this.reset();
	});
}

</script>
<div class="form">

<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'usuario-form',
		'type'=>'horizontal',
		'enableClientValidation'=>true,
		'enableAjaxValidation'=>false,
));
?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	
		
		<?php 
			$action = $this->action->id;
			echo $form->textFieldRow($model, 'username', array('size'=>32,'maxlength'=>32, 'class'=>'textareaA')); 
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
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Guardar' : 'Actualizar')); ?>
    	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'id'=>'catalogo-user-form-interno-reset', 'label'=>'Limpiar campos')); ?>
    	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->