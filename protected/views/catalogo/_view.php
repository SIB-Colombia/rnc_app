<?php
/* @var $this CatalogoespeciesController */
/* @var $data Catalogoespecies */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('catalogoespecies_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->catalogoespecies_id), array('view', 'id'=>$data->catalogoespecies_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('citacion_id')); ?>:</b>
	<?php echo CHtml::encode($data->citacion_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contacto_id')); ?>:</b>
	<?php echo CHtml::encode($data->contacto_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaactualizacion')); ?>:</b>
	<?php echo CHtml::encode($data->fechaactualizacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fechaelaboracion')); ?>:</b>
	<?php echo CHtml::encode($data->fechaelaboracion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titulometadato')); ?>:</b>
	<?php echo CHtml::encode($data->titulometadato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jerarquianombrescomunes')); ?>:</b>
	<?php echo CHtml::encode($data->jerarquianombrescomunes); ?>
	<br />


</div>