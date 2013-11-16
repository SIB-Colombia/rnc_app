<?php
Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');

$userRole  = Yii::app()->user->getState("roles");
?>

<div id="header-front">Validar Entidad: <?php echo $model->titular; ?></div>

<div id="content-front">
<?php 
	if($userRole == "admin"){
		$this->widget('bootstrap.widgets.TbButtonGroup', array(
				'buttons'=>array(
						array('label'=>'Listar Entidades', 'icon'=>'icon-list', 'url'=>array('index')),
						array('label'=>'Inicio', 'icon'=>'icon-home', 'url'=>array('admin/panel')),
				),
		));
	}
	echo $this->renderPartial('_form_validar', array('model'=>$model)); 
?>
</div>
