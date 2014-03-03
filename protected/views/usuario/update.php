<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');

$userRole  = Yii::app()->user->getState("roles");

?>

<div id="header-front">Modificar usuario: <?php echo $model->username; ?></div>

<div id="content-front">
<?php 
	if($userRole == "admin"){
		$this->widget('bootstrap.widgets.TbButtonGroup', array(
				'buttons'=>array(
						array('label'=>'Listar usuarios', 'icon'=>'icon-list', 'url'=>array('index')),
						array('label'=>'Inicio', 'icon'=>'icon-home', 'url'=>array('admin/panel'))
				),
		));
	}else {
		$this->widget('bootstrap.widgets.TbButtonGroup', array(
				'buttons'=>array(
						array('label'=>'Inicio', 'icon'=>'icon-home', 'url'=>array('admin/panel'))
				),
		));
	}
	echo $this->renderPartial('_form', array('model'=>$model)); 
?>
</div>