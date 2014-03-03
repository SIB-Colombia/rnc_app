<?php
/* @var $this EntidadController */
/* @var $dataProvider CActiveDataProvider */

Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');

/*
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#catalogoespecies-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
*/

?>

<script type="text/javascript">

	function activarRepLegal(){
		tipoTitular = $("#Entidad_tipo_titular_s").val();
		if(tipoTitular == 2){
			$("#rep_leg_inp").fadeIn("slow");
		}else if(tipoTitular == 1){
			$("#rep_leg_inp").fadeOut("slow");
		}
	}
	
	function buscarEntidades(grid){
		$.fn.yiiGridView.update(grid, {data: $('#busquedaEntidad').serialize()});
	}
</script>

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
	       <?php echo $this->renderPartial('_registros_table', array('listRegistros'=>$model->search(),'model' => $model)); ?>
	  </div>
	</div>

</div>