<?php
/* @var $this EntidadController */
/* @var $model Mensaje */

Yii::app()->theme = 'rnc_theme';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');

$this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
		'heading'=>$model->getTitulo(),
));


?>

<p style="color: #999"><?=$model->getMensaje();?></p>
<br>
<p><?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'primary',
        'size'=>'large',
        'label'=>'Inicio',
		'url' => '../site/index'
    )); ?>
</p>

<?php $this->endWidget(); ?>