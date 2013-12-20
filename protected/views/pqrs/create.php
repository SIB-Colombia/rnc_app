<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

if(Yii::app()->user->getId() !== null){
	Yii::app()->theme = 'rnc_theme_panel';
}else {
	Yii::app()->theme = 'rnc_theme';
}

Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');


/*$this->menu=array(
	array('label'=>'List CatalogoUser', 'url'=>array('index')),
	array('label'=>'Manage CatalogoUser', 'url'=>array('admin')),
);*/
?>

<?php 
if(Yii::app()->user->getId() !== null){
?>
	<div id="header-front">Crear Nueva Solicitud</div>
	<div id="content-front">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
<?php }else{?>
	<fieldset>
	<legend style="border-bottom: 0px">Formulario de Contacto</legend>
	<div id="content-front">
	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</fieldset>
<?php }?>
