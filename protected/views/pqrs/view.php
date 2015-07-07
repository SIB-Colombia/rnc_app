<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');
$userRole  = Yii::app()->user->getState("roles");

Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.uploadify.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/uploadify.css');
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

randWord = Math.floor((Math.random()*1000)+1);

$(function() {
    $('#Pqrs_archivo').uploadify({
    	'auto'     		: true,
    	'fileSizeLimit' : '20MB',
    	'buttonText'	: 'Seleccionar archivo',
    	'width'         : 140,
    	'fileTypeExts'  : '*.pdf;*.doc;*.docx;*.jpg;*.xls;*.xlsx',
    	'multi'			: true,
    	'formData'		: {'randWord' : randWord},
    	'swf'      		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.swf',
        'uploader' 		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.php',
        'checkExisting' : '<?=Yii::app()->theme->baseUrl;?>/scripts/check-exists.php',
		'onUploadComplete' : function(file){
			
			dataFile = randWord+'_'+file.name+'/'+file.type+'/'+file.size;
			val_aux	 = $('#Pqrs_nombreArchivo').val();

			if(val_aux.trim() == ''){
				$('#Pqrs_nombreArchivo').val(dataFile);
			}else{
				val_aux	+= ','+dataFile;
				$('#Pqrs_nombreArchivo').val(val_aux);
			}
			
		}
	});
});

</script>

<div id="header-front">Detalle de la solicitud: <?php echo $model->nombre; ?></div>

<div id="content-front">
<?php
$this->widget('bootstrap.widgets.TbButtonGroup', array(
		'buttons'=>array(
				array('label'=>'Listar Solicitudes', 'icon'=>'icon-list', 'url'=>array('index')),
		),
));
?>
<i class="icon-print printR" onclick="print();"></i>
<div style="margin-top: 20px">
<?php 
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			'fecha',
			'nombre',
			'registros.numero_registro',
			array(
				'name' => 'entidad.titular',
				'type'	=> 'raw',
				'value' => CHtml::encode(($model->entidad_id != "") ? $model->entidad->titular : (($model->entidad_otra != "") ? $model->entidad_otra : "No asignado"))
			),
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
			'respuesta',
			'fecha_respuesta'
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
	echo $form->fileFieldRow($model, 'archivo');
	echo $form->hiddenField($model, 'nombreArchivo');
?>
	<div id="catalogouser-botones-internos" class="form-actions pull-right">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'success', 'label'=>'Responder', 'htmlOptions' => array('onclick' => 'enviarForm()'))); ?>
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'id'=>'catalogo-user-form-interno-reset', 'label'=>'Limpiar campos')); ?>
  	</div>
</fieldset>
<?php $this->endWidget(); }?>
</div>
</div>