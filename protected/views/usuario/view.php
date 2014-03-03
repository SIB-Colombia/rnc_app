<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');

$this->breadcrumbs=array(
	'Catalogo Users'=>array('index'),
	$model->username,
);

?>

<div id="header-front">Detalle de usuario: <?php echo $model->username; ?></div>

<div id="content-front">
<?php
$this->widget('bootstrap.widgets.TbButtonGroup', array(
		'buttons'=>array(
				array('label'=>'Listar usuarios', 'icon'=>'icon-list', 'url'=>array('index')),
		),
));
?>
<i class="icon-print printR" onclick="print();"></i>
<div style="margin-top: 20px">
<?php 
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'email',
		'role',
	),
)); ?>
</div>
</div>