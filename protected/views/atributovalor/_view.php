<?php
/* @var $this AtributovalorController */
/* @var $data Atributovalor */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor')); ?>:</b>
	<?php echo CHtml::encode($data->valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('atributotipo_id')); ?>:</b>
	<?php echo CHtml::encode($data->atributotipo_id); ?>
	<br />


</div>