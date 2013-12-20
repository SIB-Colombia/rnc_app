<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
Yii::app()->theme = 'rnc_theme';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
?>

<img src="<?=Yii::app()->theme->baseUrl?>/img/camaleon.jpg" width="845px" height="463px" style="margin-left: 40px"/>
