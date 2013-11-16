<?php
/* @var $this CatalogoespeciesController */
/* @var $model Catalogoespecies */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'catalogoespecies_id'); ?>
		<?php echo $form->textField($model,'catalogoespecies_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'citacion_id'); ?>
		<?php echo $form->textField($model,'citacion_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contacto_id'); ?>
		<?php echo $form->textField($model,'contacto_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechaactualizacion'); ?>
		<?php echo $form->textField($model,'fechaactualizacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fechaelaboracion'); ?>
		<?php echo $form->textField($model,'fechaelaboracion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'titulometadato'); ?>
		<?php echo $form->textField($model,'titulometadato',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jerarquianombrescomunes'); ?>
		<?php echo $form->textArea($model,'jerarquianombrescomunes',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->