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

/*$this->menu=array(
	array('label'=>'List CatalogoUser', 'url'=>array('index')),
	array('label'=>'Create CatalogoUser', 'url'=>array('create')),
	array('label'=>'Update CatalogoUser', 'url'=>array('update', 'id'=>$model->username)),
	array('label'=>'Delete CatalogoUser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->username),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CatalogoUser', 'url'=>array('admin')),
);*/
?>

<div id="header-front">Detalle de Usuario: <?php echo $model->username; ?></div>

<div id="content-front">
<?php
$this->widget('bootstrap.widgets.TbButtonGroup', array(
		'buttons'=>array(
				array('label'=>'Listar Usuarios', 'icon'=>'icon-list', 'url'=>array('index')),
		),
));
?>
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