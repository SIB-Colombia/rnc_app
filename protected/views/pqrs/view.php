<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');
$userRole  = Yii::app()->user->getState("roles");
?>

<script type="text/javascript">
function enviarForm(){
	$("#pqrs-form").submit();
}

function resetForm(id) {
	$('#'+id).each(function(){
	        this.reset();
	});
}
</script>

<div id="header-front">Detalle de la Solicitud: <?php echo $model->id; ?></div>

<div id="content-front">
<?php
$this->widget('bootstrap.widgets.TbButtonGroup', array(
		'buttons'=>array(
				array('label'=>'Listar Solicitudes', 'icon'=>'icon-list', 'url'=>array('index')),
		),
));
?>
<div style="margin-top: 20px">
<?php 
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			'nombre',
			'registros.numero_registro',
			'entidad.titular',
			'email',
			array(
				'name' => 'tipo_solicitud',
				'type'	=> 'raw',
				'value' => CHtml::encode(($model->tipo_solicitud == 1) ? "Petición" : (($model->tipo_solicitud == 2) ? "Queja" : (($model->tipo_solicitud == 3) ? "Felicitación" : "No Asignado")))
			),
			'descripcion',
			array(
				'name' => 'estado',
				'type'	=> 'raw',
				'value' => CHtml::encode(($model->estado == 0) ? "Pendiente" : "Cerrado")
			),
			'respuesta'
		),
	));

	
?>
<fieldset>
	<legend class="form_legend">Archivos</legend>
       	<?php echo $this->renderPartial('_archivos_pqrs', array('listArchivos'=>$model->dataArchivosList($model->id))); ?>
</fieldset>

<?php 
if($model->estado == 0 && $userRole == 'admin'){
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'pqrs-form',
		'type'=>'horizontal',
		'enableClientValidation'=>true,
		'enableAjaxValidation'=>false,
));
?>
<fieldset>
	<legend class="form_legend">Responder Solicitud</legend>
<?php 
	echo $form->radioButtonListInlineRow($model, 'aprobado', array('Si','No'));
	echo $form->textAreaRow($model, 'respuesta', array('class'=>'span4', 'rows'=>4));
?>
	<div id="catalogouser-botones-internos" class="form-actions pull-right">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'primary', 'label'=>'Responder', 'htmlOptions' => array('onclick' => 'enviarForm()'))); ?>
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'id'=>'catalogo-user-form-interno-reset', 'label'=>'Limpiar campos')); ?>
  	</div>
</fieldset>
<?php $this->endWidget(); }?>
</div>
</div>