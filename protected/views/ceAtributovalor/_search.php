<?php
/* @var $this CeAtributovalorController */
/* @var $model CeAtributovalor */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ceatributovalor_id'); ?>
		<?php echo $form->textField($model,'ceatributovalor_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'catalogoespecies_id'); ?>
		<?php echo $form->textField($model,'catalogoespecies_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'etiqueta'); ?>
		<?php echo $form->textField($model,'etiqueta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valor'); ?>
		<?php echo $form->textField($model,'valor'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->