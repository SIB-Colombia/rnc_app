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
	$("#visita-form").submit();
}

function resetForm(id) {
	$('#'+id).each(function(){
	        this.reset();
	});
}

function deleteFileAjax(divId,id){
	
	$.post(urlAjax, {id: id},function(data){
		if(data == 1){
			$("#"+divId).remove();
		}else{
			alert("Error al eliminar el archivo.");
		}
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
    $('#Visitas_archivo').uploadify({
    	'auto'     		: true,
    	'fileSizeLimit' : '20MB',
    	'buttonText'	: 'Seleccionar Archivo',
    	'width'         : 140,
    	'fileTypeExts'  : '*.pdf;*.doc;*.docx;jpg',
    	'multi'			: true,
    	'formData'		: {'randWord' : randWord},
    	'swf'      		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.swf',
        'uploader' 		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.php',
        'checkExisting' : '<?=Yii::app()->theme->baseUrl;?>/scripts/check-exists.php',
		'onUploadComplete' : function(file){
			
			dataFile = randWord+'_'+file.name+'/'+file.type+'/'+file.size;
			val_aux	 = $('#Visitas_nombreArchivo').val();

			if(val_aux.trim() == ''){
				$('#Visitas_nombreArchivo').val(dataFile);
			}else{
				val_aux	+= ','+dataFile;
				$('#Visitas_nombreArchivo').val(val_aux);
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
		'id'=>'visita-form',
		'type'=>'horizontal',
		'enableClientValidation'=>true,
		'enableAjaxValidation'=>false,
));
?>
	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>
	<?php 	echo $form->errorSummary($model);
			echo $form->errorSummary($model->registros);
			echo $form->errorSummary($model->dilegenciadores);
	?>
	
	<fieldset>
		<legend class="form_legend">Datos de la Visita</legend>
		
		<?php 
			echo $form->textFieldRow($model, 'entidad', array('size'=>32,'maxlength'=>64, 'class'=>'textareaA'));
			echo $form->textFieldRow($model->registros, 'numero_registro', array('size'=>32,'maxlength'=>64, 'class'=>'textareaA'));
			echo $form->dropDownListRow($model, 'ciudad_id', $model->ListarCiudades(),array('prompt' => 'Seleccionar...'));
			echo $form->datepickerRow($model, 'fecha_visita');
			echo $form->textAreaRow($model, 'concepto', array('class'=>'span4', 'rows'=>5));
			echo $form->fileFieldRow($model, 'archivo');
			echo $form->hiddenField($model, 'nombreArchivo');
		?>
		<div id = "adjFile">
		<?php 
			if(isset($model->id)){
				$criteria = new CDbCriteria;
				$criteria->compare('visitas_id',$model->id);
				$dataTipo	= Archivos_Pqrs::model()->findAll($criteria);
				$cont = 0;
				
				foreach ($dataTipo as $value){
					echo '<div id="fl_'.$cont.'" class="uploadify-queue-item" style="margin-left:220px">';
					echo '<div class="cancel">';
					echo '<a onclick = "deleteFileAjax(\'fl_'.$cont.'\','.$value->id.')">X</a></div>';
					
					$url = Yii::app()->createUrl('..'.DIRECTORY_SEPARATOR.$value->ruta.DIRECTORY_SEPARATOR.$value->nombre);
					echo '<span class="fileName">'.$value->nombre.'</span><span class="data"><a class="viewFileReg" target="_blank" href="'.$url.'">Ver</a></span>';
					echo '</div>';
		?>
        <?php }}?>
		</div>
	</fieldset>
	
	<fieldset>
		<legend class="form_legend">Datos de la persona que realizó la visita</legend>
		<?php 
			echo $form->textFieldRow($model->dilegenciadores, 'nombre', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo $form->textFieldRow($model->dilegenciadores, 'dependencia', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo $form->textFieldRow($model->dilegenciadores, 'cargo', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			/*echo $form->textFieldRow($model->dilegenciadores, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			echo $form->textFieldRow($model->dilegenciadores, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA'));*/
		?>
	</fieldset>
	
	<div id="catalogouser-botones-internos" class="form-actions pull-right">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'success', 'label'=>$model->isNewRecord ? 'Guardar' : 'Actualizar', 'htmlOptions' => array('onclick' => 'enviarForm()'))); ?>
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'id'=>'catalogo-user-form-interno-reset', 'label'=>'Limpiar campos')); ?>
    </div>
    
<?php $this->endWidget(); ?>
</div>