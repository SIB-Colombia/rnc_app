<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerCoreScript('jquery.ui');
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

$(function() {
    $('#Pqrs_archivo').uploadify({
    	'auto'     		: true,
    	'fileSizeLimit' : '20MB',
    	'buttonText'	: 'Seleccionar Archivo',
    	'width'         : 140,
    	'fileTypeExts'  : '*.pdf;*.doc;*.docx;jpg',
    	'multi'			: true,
    	'swf'      		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.swf',
        'uploader' 		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.php',
        'checkExisting' : '<?=Yii::app()->theme->baseUrl;?>/scripts/check-exists.php',
		'onUploadComplete' : function(file){
			
			dataFile = file.name+'/'+file.type+'/'+file.size;
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
<div class="form">

<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'pqrs-form',
		'type'=>'horizontal',
		'enableClientValidation'=>true,
		'enableAjaxValidation'=>false,
));
?>
	
	<?php 
	if(Yii::app()->user->getId() !== null){
	?>
		<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>
	<?php }else{?>
		<p class="note" style="color: #999">Los campos con <span class="required">*</span> son obligatorios.</p>
	<?php }?>

	

	<?php echo $form->errorSummary($model); ?>

	<fieldset>
		<legend class="form_legend">Datos de la solicitud</legend>
		<?php 
			echo $form->textFieldRow($model, 'nombre', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo $form->textFieldRow($model, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA'));
			echo $form->textFieldRow($model, 'numero_registro', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			
			if(Yii::app()->user->getId() === null){
				echo $form->dropDownListRow($model, 'entidad', Entidad::model()->listarEntidades(),array('prompt' => 'Seleccionar...','onchange' => ''));
			}
			
			echo $form->dropDownListRow($model, 'tipo_solicitud', $model->listarTipoSolicitud(),array('prompt' => 'Seleccionar...'));
			echo $form->textAreaRow($model, 'descripcion', array('class'=>'span4', 'rows'=>4));
			echo $form->fileFieldRow($model, 'archivo');
			echo $form->hiddenField($model, 'nombreArchivo');
		?>
	</fieldset>
	
	<div id="catalogouser-botones-internos" class="form-actions pull-right">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Guardar' : 'Actualizar', 'htmlOptions' => array('onclick' => 'enviarForm()'))); ?>
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'id'=>'catalogo-user-form-interno-reset', 'label'=>'Limpiar campos')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->