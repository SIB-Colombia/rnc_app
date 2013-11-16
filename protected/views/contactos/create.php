<?php
/* @var $this ContactosController */
/* @var $model Contactos */
Yii::app()->theme = 'catalogo_interno'; ?>

<h1>Agregar nuevo contacto</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>