<?php
Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');

?>

<div id="header-front">Registros de colecciones biológicas</div>

<div id="content-front">
	<?php 
	$this->widget('bootstrap.widgets.TbButtonGroup', array(
			'buttons'=>array(
					array('label'=>'Nuevo registro', 'icon'=>'icon-plus', 'url'=>array('create')),
					array('label'=>'Inicio', 'icon'=>'icon-home', 'url'=>array('admin/panel')),
			),
	));
	?>
	<i class="icon-print printR" onclick="print();"></i>
	<div class="tabbable"> <!-- Only required for left/right tabs -->
	  			
	  <div class="tab-content">
	       <?php echo $this->renderPartial('_registro_sol_lista', array('listRegistros'=>$model->listarSolicitudRegistro(),'model' => $model)); ?>
	  </div>
	</div>

</div>