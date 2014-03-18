<?php
Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');
?>

<div id="header-front">Archivo histórico de colecciones biológicas</div>

<div id="content-front">
	<?php 
	$this->widget('bootstrap.widgets.TbButtonGroup', array(
			'buttons'=>array(
					array('label'=>'Listar históricos', 'icon'=>'icon-th-list', 'url'=>array('registros/listarHistoricosFolder')),
					array('label'=>'Inicio', 'icon'=>'icon-home', 'url'=>array('admin/panel')),
			),
	));
	?>
	<div class="tabbable"> <!-- Only required for left/right tabs -->
	  
	  			
	  <div class="tab-content">
	       <?php echo $this->renderPartial('_registros_historicos_table', array('listRegistros'=>$model->listarFolderHistoricos($folder),'model' => $model)); ?>
	  </div>
	</div>

</div>