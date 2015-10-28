<?php
Yii::app()->theme = 'rnc_theme';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');

?>

<fieldset>
	<legend style="border-bottom: 0px;margin-bottom: 0px">Listado de colecciones registradas</legend>
<div id="content-front">
<?php echo $this->renderPartial('_coleccion_table', array('listRegistros'=>$model->listarColecciones($datos),'model' => $model)); ?>
</div>
</fieldset>