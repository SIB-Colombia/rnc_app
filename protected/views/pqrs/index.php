<?php
/* @var $this EntidadController */
/* @var $dataProvider CActiveDataProvider */

Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');

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

<div id="header-front">Listado de Solicitudes</div>

<div id="content-front">
			
	  <div class="tab-content">
	       <?php echo $this->renderPartial('_pqrs_table', array('listPqrs'=>$model->search())); ?>
	  </div>
	</div>

</div>