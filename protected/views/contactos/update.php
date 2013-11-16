<?php
/* @var $this ContactosController */
/* @var $model Contactos */
Yii::app()->theme = 'catalogo_interno'; ?>

<h1>Actualizar contacto <?php echo $model->contacto_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>