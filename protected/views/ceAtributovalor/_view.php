<?php
/* @var $this CeAtributovalorController */
/* @var $data CeAtributovalor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ceatributovalor_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ceatributovalor_id), array('view', 'id'=>$data->ceatributovalor_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('catalogoespecies_id')); ?>:</b>
	<?php echo CHtml::encode($data->catalogoespecies_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('etiqueta')); ?>:</b>
	<?php echo CHtml::encode($data->etiqueta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor')); ?>:</b>
	<?php echo CHtml::encode($data->valor); ?>
	<br />


</div>