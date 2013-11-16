<?php
/* @var $this AtributovalorController */
/* @var $model Atributovalor */
/* @var $form CActiveForm */

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'atributo-form',
	'type'=>'horizontal',
	'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
));
?>

<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textAreaRow($model, 'valor', array('rows'=>10, 'style'=>'width: 90%;', 'id'=>'textoValorAtributo')); ?>

<div id="atributo-botones-internos" class="form-actions pull-right">
	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'id'=>'atributo-form-interno-submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Guardar' : 'Actualizar')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'id'=>'atributo-form-interno-reset', 'label'=>'Limpiar campos')); ?>
</div>
    
<?php $this->endWidget(); ?>

<script type="text/javascript">
$('#textoValorAtributo').wysihtml5();
</script>