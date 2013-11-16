<?php
/* @var $this ContactosController */
/* @var $data Contactos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('contacto_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->contacto_id), array('view', 'id'=>$data->contacto_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion')); ?>:</b>
	<?php echo CHtml::encode($data->direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_referente_geografico')); ?>:</b>
	<?php echo CHtml::encode($data->id_referente_geografico); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono')); ?>:</b>
	<?php echo CHtml::encode($data->telefono); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('acronimo')); ?>:</b>
	<?php echo CHtml::encode($data->acronimo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('persona')); ?>:</b>
	<?php echo CHtml::encode($data->persona); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fax')); ?>:</b>
	<?php echo CHtml::encode($data->fax); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('correo_electronico')); ?>:</b>
	<?php echo CHtml::encode($data->correo_electronico); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('organizacion')); ?>:</b>
	<?php echo CHtml::encode($data->organizacion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cargo')); ?>:</b>
	<?php echo CHtml::encode($data->cargo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('instrucciones')); ?>:</b>
	<?php echo CHtml::encode($data->instrucciones); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_inicial')); ?>:</b>
	<?php echo CHtml::encode($data->hora_inicial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hora_final')); ?>:</b>
	<?php echo CHtml::encode($data->hora_final); ?>
	<br />

	*/ ?>

</div>