<?php
Yii::app()->theme = 'rnc_theme_empty';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/login.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/md5.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/utf8_encode.js', CClientScript::POS_HEAD);
$this->pageTitle=Yii::app()->name . ' - Ingreso';
?>

<script type="text/javascript">
$(document).ready(function() {
	$("#LoginForm_password").change(function (){
		valor_p = $("#LoginForm_password").val();
		valor_hash = md5(valor_p);
		$("#LoginForm_password").val(valor_hash);
		});
	});
</script>
<h1><?php echo CHtml::encode(Yii::app()->name); ?></h1>

<div id="ingreso">
	<div class="form" align="center">
		<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'registro-formulario',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
				)); 
		?>
		
		<h1>Iniciar sesión</h1>
		
		<div>
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username', array('class'=>'field')); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>
		
		<div>
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password', array('class'=>'field')); ?>
			<?php echo $form->error($model,'password'); ?>
		</div>
		
		<?php if(CCaptcha::checkRequirements()): ?>
		<div>
				<?php echo $form->labelEx($model,'codigoVerificacion'); ?>
				<?php echo $form->textField($model,'codigoVerificacion', array('class'=>'field')); ?>
				<?php $this->widget('CCaptcha'); ?>
				<div class="hint">
					Digite la letras que se muestran en el código de verificación.
					<br/>Puede escribirlas en mayúscula o minúscula.
				</div>
				<?php //echo $form->error($model,'codigoVerificacion'); ?>
		</div>
		<?php endif; ?>
		
		<div class="row buttons">
			<div class="btn-rememberme">
				<?php echo $form->checkBox($model,'rememberMe'); ?>
				<?php echo $form->label($model,'rememberMe'); ?>
				<?php echo $form->error($model,'rememberMe'); ?>
				
			</div>
			<?php 
				$this->widget('bootstrap.widgets.TbButton', array(
						'label'=>'Recuperar Contraseña',
						'type'=>'success',
						'htmlOptions'=>array(
								'data-toggle'=>'modal',
								'data-target'=>'#modalUser',
								'style'	=> 'float:left;margin-left: 10px;clear:left'
						),
				));
			?>
			
			<div class="btn-login">
				<?php echo CHtml::submitButton('Ingresar', array('class' => 'boton')); ?>
	        </div>
	        
		</div>
		<?php $this->endWidget(); ?>
	</div><!-- form -->
</div><!-- ingreso -->

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modalUser','htmlOptions' => array('style'=>'width:420px;padding:20px'))); ?>
	<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    	<h3 style="color:#007947">Recuperar Contraseña</h3>
	</div>
<?php echo $this->renderPartial('../usuario/_recuperaPassword', array('model'=>$modelUser,'ajaxMode' => true)); ?>
<?php $this->endWidget(); ?>
