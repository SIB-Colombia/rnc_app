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

	function validarActualizar(id){
		var idStr   = id.split("#");
		var id 		= idStr[idStr.length - 1];
		
		$.post('validarActualizar',{id: id},function(data){
			if(data == "Ok"){
				alert("La colección no puede actualizarce porque tiene un formulario en estado de Revisión");
				window.stop();
			}else{
				window.location.href ="<?=Yii::app()->createUrl("registros/actualizar", array());?>/"+id;
			}
			
		});
	}
</script>
<div id="header-front">Actualización de colecciones biológicas</div>

<div id="content-front">
	<?php 
	$this->widget('bootstrap.widgets.TbButtonGroup', array(
			'buttons'=>array(
					array('label'=>'Nuevo registro', 'icon'=>'icon-plus', 'url'=>array('create')),
					array('label'=>'Inicio', 'icon'=>'icon-home', 'url'=>array('admin/panel')),
			),
	));
	?>
	<div class="tabbable"> <!-- Only required for left/right tabs -->
	  
	  			
	  <div class="tab-content">
	       <?php echo $this->renderPartial('../registros/_registro_panel_lista', array('listRegistros' => $registro->listarPanelRegistro()));?>
	  </div>
	</div>

</div>