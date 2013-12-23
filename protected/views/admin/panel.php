<?php
Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');
?>

<?php 
	$userRole = Yii::app()->user->getState("roles");
	
	if($userRole == "admin"){
?>
	<div id="header-front">Tareas</div>
	
	<div class="table-panel">
	<?php 
		$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
				'title' => 'Solicitud Usuarios',
	    		'headerIcon' => 'icon-th-list',
	    		// when displaying a table, if we include bootstra-widget-table class
	    		// the table will be 0-padding to the box
	    		'htmlOptions' => array('class'=>'bootstrap-widget-table panelInicio'),
	    ));
	?>
	<?php echo $this->renderPartial('../entidad/_entidad_sol_lista', array('listEntidades' => $entidad->ListarSolicitudEntidad()));?>
	<?php $this->endWidget();?>
	
	</div>
	
	<div class="table-panel">
	<?php 
		$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
				'title' => 'Registros',
	    		'headerIcon' => 'icon-th-list',
	    		// when displaying a table, if we include bootstra-widget-table class
	    		// the table will be 0-padding to the box
	    		'htmlOptions' => array('class'=>'bootstrap-widget-table panelInicio'),
	    ));
	?>
	<?php echo $this->renderPartial('../registros/_registro_sol_lista', array('listRegistros' => $registro->listarSolicitudRegistro()));?>
	<?php $this->endWidget();?>
	
	</div>
	
	<div class="table-panel">
	<?php 
		$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
				'title' => 'Contactos',
	    		'headerIcon' => 'icon-th-list',
	    		// when displaying a table, if we include bootstra-widget-table class
	    		// the table will be 0-padding to the box
	    		'htmlOptions' => array('class'=>'bootstrap-widget-table panelInicio'),
	    ));
	?>
	<?php echo $this->renderPartial('../pqrs/_pqrs_sol_lista', array('listPqrs' => $pqrs->listarSolicitudPqrs()));?>
	<?php $this->endWidget();?>
	
	</div>

<?php 
	}else if($userRole == "entidad"){
	
?>
	<div id="header-front">Panel</div>
	
	<div class="table-panel">
	
	<?php 
		$box = $this->beginWidget('bootstrap.widgets.TbBox', array(
				'title' => 'Colecciones',
	    		'headerIcon' => 'icon-th-list',
	    		// when displaying a table, if we include bootstra-widget-table class
	    		// the table will be 0-padding to the box
	    		'htmlOptions' => array('class'=>'bootstrap-widget-table panelInicio'),
	    ));
	?>
	<?php echo $this->renderPartial('../registros/_registro_panel_lista', array('listRegistros' => $registro->listarPanelRegistro()));?>
	<?php $this->endWidget();?>
	</div>
<?php }?>