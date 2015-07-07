<?php
Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/jquery.dataTables.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.dataTables.js', CClientScript::POS_HEAD);
?>

<div id="header-front">Certificados de colecciones</div>

<div id="content-front">

<?php 
	$this->widget('bootstrap.widgets.TbButtonGroup', array(
			'buttons'=>array(
					array('label'=>'Listar certificados', 'icon'=>'icon-th-list', 'url'=>array('registros/listarCertificados')),
					array('label'=>'Inicio', 'icon'=>'icon-home', 'url'=>array('admin/panel')),
			),
	));
?>

	<div class="tabbable"> <!-- Only required for left/right tabs -->
	  
	  <div class="tab-content">
	       <?php echo $this->renderPartial('_certificados_table', array('listRegistros'=>$model->listarFolderCertificados($folder),'model' => $model)); ?>
	  </div>

	</div>

</div>