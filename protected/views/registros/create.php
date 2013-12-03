<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');


/*$this->menu=array(
	array('label'=>'List CatalogoUser', 'url'=>array('index')),
	array('label'=>'Manage CatalogoUser', 'url'=>array('admin')),
);*/
?>

<div id="header-front">Registro de colecciones biológicas</div>

<div id="content-front">
<?php echo $this->renderPartial('_form', array('model'=>$model,'tamano_coleccion' => $tamano_coleccion, 'tipos_en_coleccion' => $tipos_en_coleccion, 'composicion_general' => $composicion_general)); ?>
</div>