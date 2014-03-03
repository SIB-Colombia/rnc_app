<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');
$userRole  = Yii::app()->user->getState("roles");
?>

<div id="header-front">Colección número: <?php echo ($model->numero_registro == 0) ? "Sin Definir" : CHtml::encode($model->numero_registro); ?></div>

<div id="content-front">
<?php
$this->widget('bootstrap.widgets.TbButtonGroup', array(
		'buttons'=>array(
				array('label'=>'Listar Colecciones', 'icon'=>'icon-list', 'url'=>array('index')),
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
					'value' => CHtml::encode(($model->estado == 0) ? "Sin Aprobar" : "Aprobada")
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