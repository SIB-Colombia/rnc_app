<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');
$userRole  = Yii::app()->user->getState("roles");
$dataMsj = "";
?>

<?php if(isset($_GET['status'])){
		if($_GET['status'] == 'Ok')
			$dataMsj = "El proceso se ha realizado con éxito";
		else $dataMsj = "Ocurrió un error durante el proceso.";
?>
<script>
	$(document).ready(function(){
		$("#modalMsj").addClass("in");
	});

</script>
<?php }?>

<script type="text/javascript">
	function cerrarModal(id){
		$("#"+id).addClass("hide");
	}
</script>
<div id="header-front">Colección número: <?php echo ($model->numero_registro == 0) ? "Sin Definir" : CHtml::encode($model->numero_registro); ?></div>

<div id="content-front">
<?php
$this->widget('bootstrap.widgets.TbButtonGroup', array(
		'buttons'=>array(
				array('label'=>'Listar colecciones', 'icon'=>'icon-list', 'url'=>array('index')),
				array('label'=>'Actualizar Colección', 'icon'=>'icon-edit', 'url' => Yii::app()->createUrl("registros/actualizar", array("id"=>$model->id)),'visible' => ($userRole == "entidad") ? true : false),
				array('label'=>'Cancelar Colección', 'icon'=>'icon-ban-circle','data-toggle' => 'modal','data-target' => '#modalCancel', 'url' => 'javascript:cancelaRegistro('.$model->id.')','visible' => ($model->estado != 2 && $userRole == "admin") ? true : false),
		),
));
?>
<div style="margin-top: 20px">
<i class="icon-print printR" onclick="print();"></i>
	<fieldset>
		<legend class="form_legend">Colección número: <?php echo ($model->numero_registro == 0) ? "Sin Definir" : CHtml::encode($model->numero_registro); ?></legend>
		<?php 
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'tipo_coleccion.nombre',
				'fecha_dil',
				array(
					'name' => 'estado',
					'type'	=> 'raw',
					'value' => CHtml::encode(($model->estado == 0) ? "Sin Aprobar" : (($model->estado == 2) ? "Cancelada" : "Aprobada"))
				),
			)
		));
		?>
	</fieldset>
	
	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Registros',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));
		
		echo $this->renderPartial('_registro_detalle_lista', array('listRegistros' => $registroUpdate->listarRegistrosDetalles($model->id))); 
	
	 	$this->endWidget();
	?>
</div>
</div>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modalMsj','htmlOptions' => array('style'=>'padding:20px'))); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal" onclick = "cerrarModal('modalMsj');">&times;</a>
    	<h3>Sistema RNC</h3>
	</div>
	
	<br>
	<p class="note"><?= $dataMsj;?></p>
	
	<?php 
	$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'registro-cancel-form-submit', 'type'=>'success', 'label'=>'Cerrar', 'htmlOptions' => array('onclick' => 'cerrarModal()')));
	?>
<?php $this->endWidget(); ?>