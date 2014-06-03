<div style="width:730px; margin:0 auto"><?php
/* @var $this UsuarioController */
/* @var $model Usuario */

Yii::app()->theme = 'rnc_theme';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');


/*$this->menu=array(
	array('label'=>'List CatalogoUser', 'url'=>array('index')),
	array('label'=>'Manage CatalogoUser', 'url'=>array('admin')),
);*/
?>

<fieldset>
<h1>Formulario de solicitud de usuario y contraseña</h1>

<div id="content-front">
<?php echo $this->renderPartial('_form_solicitud', array('model'=>$model)); ?>
</div>
</fieldset></div>