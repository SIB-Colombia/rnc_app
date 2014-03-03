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

<?php 
	if(isset($model->id)){
		echo 'urlAjax 			= "../deleteFileAjax";';
	}else{
		echo 'urlAjax 			= "deleteFileAjax";';
	}
?>

function enviarForm(){
	$("#pqrs-form").submit();
}

function resetForm(id) {
	$('#'+id).each(function(){
	        this.reset();
	});
}

function deleteFileUpAjax(divId,name){
	
	$.post(urlAjax, {name: name},function(data){
		if(data == 1){
			$("#"+divId).remove();
		}else{
			alert("Error al eliminar el archivo.");
		}
	});
}

randWord = Math.floor((Math.random()*1000)+1);
contUp = 0;
$(function() {
    $('#Pqrs_archivo').uploadify({
    	'auto'     		: true,
    	'fileSizeLimit' : '20MB',
    	'buttonText'	: 'Seleccionar archivo',
    	'width'         : 140,
    	'fileTypeExts'  : '*.pdf;*.doc;*.docx;jpg',
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

			html = '<div id="flup_'+contUp+'" class="uploadify-queue-item" style="margin-left:220px">';
			html += '<div class="cancel">';
			html += '<a onclick = "deleteFileUpAjax(\'flup_'+contUp+'\',\''+randWord+'_'+file.name+'\')">X</a></div>';
			html += '<span class="fileName">'+file.name+'</span><span class="data"></span>';
			html += '</div>';
			$("#adjFile").append(html);
			contUp++;
			
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

	<p class="note" style="color: #999">
	Relacione sus inquietudes, sugerencias y comentarios en este formulario. Si lo requiere anexe los documentos que acompañan su comunicación.
	</p>

	<?php echo $form->errorSummary($model); ?>

	<fieldset>
		<legend class="form_legend">Datos de la solicitud</legend>
		<?php 
			if(Yii::app()->user->getId() !== null){
		?>
			<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>
		<?php }else{?>
			<p class="note" style="color: #999;text-align: justify;margin-bottom: 20px">Los campos con <span class="required">*</span> son obligatorios.</p>
		<?php }?>
		
		<?php 
			echo $form->textFieldRow($model, 'nombre', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo $form->textFieldRow($model, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA'));
			
			if(Yii::app()->user->getId() === null || $userRole == "admin"){
				echo $form->dropDownListRow($model, 'entidad', Entidad::model()->listarEntidades(),array('prompt' => 'Seleccionar...','onchange' => ''));
				echo $form->textFieldRow($model, 'entidad_otra', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			}
			
			if(Yii::app()->user->getId() === null || $userRole == "admin"){
				echo $form->textFieldRow($model, 'numero_registro', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			}else{
				echo $form->dropDownListRow($model, 'numero_registro', $model->listarColeccion(),array('prompt' => 'Seleccionar...','onchange' => ''));
			}
			echo '<i class="icon-info-sign" rel="tooltip" title = "Si la consulta no está relacionada con una colección registrada por favor escriba 0"></i>';
			if($userRole == 'admin'){
				echo $form->dropDownListRow($model, 'tipo_solicitud', $model->listarTipoSolicitud(),array('prompt' => 'Seleccionar...'));
			}
			echo $form->textAreaRow($model, 'descripcion', array('class'=>'span4', 'rows'=>4));
			echo $form->fileFieldRow($model, 'archivo');
			echo $form->hiddenField($model, 'nombreArchivo');
		?>
		<div id = "adjFile">
		</div>
		<label class="control-label inlineLabel2" style="clear: left;margin-left: 220px;width: auto">Formatos válidos: PDF (*.pdf), World  (*.doc,*.docx) e Imágenes (*.jpg). Tamaño máximo 20MB.</label>
	</fieldset>
	
	<div id="catalogouser-botones-internos" class="form-actions pull-right">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'success', 'label'=>$model->isNewRecord ? 'Enviar' : 'Actualizar', 'htmlOptions' => array('onclick' => 'enviarForm()'))); ?>
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'id'=>'catalogo-user-form-interno-reset', 'label'=>'Limpiar campos')); ?>
	    <?php 
	    if(Yii::app()->user->getId() !== null){
			$this->widget('bootstrap.widgets.TbButtonGroup', array(
				'buttons'=>array(
					array('label'=>'Cancel', 'url'=>array('admin/panel')),
				),
			));
		}else{
			$this->widget('bootstrap.widgets.TbButtonGroup', array(
				'buttons'=>array(
						array('label'=>'Cancel', 'url'=>array('site/index')),
				),
			));
		}
		?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->