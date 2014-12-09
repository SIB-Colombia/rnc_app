<?php

Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');
?>

<div id="header-front">Generar bitácora</div>

<div id="content-front">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>