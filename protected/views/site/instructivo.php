<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
Yii::app()->theme = 'rnc_theme';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
?>
<div style="text-align: center;">
<img src="<?=Yii::app()->theme->baseUrl?>/images/Guia_RNC_en_linea.jpg" width="543px" style="margin: 0 auto"/>

</div>
<div style="margin: 0 auto;width: 670px">
<?php 
	$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'type'=>'info','label'=>'Formato de autodeclaración para colecciones biológicas','htmlOptions' => array('style' => 'width: 300px;margin:20px 20px 0 auto','onclick' => 'window.location="'.Yii::app()->createUrl("site/archivoAuto").'"')));
	$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'type'=>'info','label'=>'Instructivo para el registro o actualización de la colección biológica','htmlOptions' => array('style' => 'width: 350px;margin:20px auto 0 auto','onclick' => 'window.location="'.Yii::app()->createUrl("site/archivoInstructivo").'"')));
?>
</div>