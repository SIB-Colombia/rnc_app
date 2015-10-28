<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');

$userRole  = Yii::app()->user->getState("roles");
//print_r($model->registros_update->composicion_general[0]);
//Yii::app()->end();
?>

<div id="header-front">Modificar registro: <?php echo $model->registros_update->nombre; ?></div>

<div id="content-front">
<i class="icon-print printR" onclick="print();"></i>
<?php 
	
	$this->widget('bootstrap.widgets.TbButtonGroup', array(
			'buttons'=>array(
					array('label'=>'Listar registros', 'icon'=>'icon-list', 'url'=>array('index')),
					array('label'=>'Inicio', 'icon'=>'icon-home', 'url'=>array('admin/panel')),
			),
	));
	
	echo $this->renderPartial('_form', array('model'=>$model,'tamano_coleccion' => $tamano_coleccion, 'tipos_en_coleccion' => $tipos_en_coleccion, 'composicion_general' => $composicion_general, 'urls_registros' => $urls_registros)); 
?>
</div>