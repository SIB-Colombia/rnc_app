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
		echo 'urlAjaxValidar 	= "../validarColeccionAjax";';
		echo 'urlAjaxValidarAcr	= "../validarAcronimoAjax";';
	}else{
		echo 'urlAjax 			= "deleteFileAjax";';
		echo 'urlAjaxValidar 	= "validarColeccionAjax";';
		echo 'urlAjaxValidarAcr	= "validarAcronimoAjax";';
	}
?>
contTipo 		= 0;
contTipoCol 	= 0;
contNivelCat 	= 0;

function validarNumeroColeccion(obj,numero){
	$.post(urlAjaxValidar,{coleccion: numero},function(data){
			if(data == 1){
				$(obj).addClass("error");
				$(obj).focus();
				alert("La Colección "+numero+" ya existe en el sistema, diríjase a Actualizar para hacer uso de ella.");
			}else{
				$(obj).removeClass("error");
			}
		});
}

function validarAcronimo(obj,acronimo){
	$.post(urlAjaxValidarAcr,{dato: acronimo},function(data){
			if(data == 1){
				$(obj).addClass("error");
				$(obj).focus();
				alert("El Acrónimo "+acronimo+" ya existe en el sistema.");
			}else{
				$(obj).removeClass("error");
			}
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

function enviarForm(){
	$("#Registros_Update_estado").val("0");
	$("#registro-form").submit();
}

function resetForm(id) {
	$('#'+id).each(function(){
	        this.reset();
	});
}

function activarTipo()
{
	tipoTitular = $("#Entidad_tipo_titular").val();
	//alert(tipoTitular);
	if(tipoTitular == 2){
		$("#Entidad_representante_legal").removeAttr("disabled");
		$("#Entidad_tipo_id_rep").removeAttr("disabled");
		$("#Entidad_representante_id").removeAttr("disabled");
	}else if (tipoTitular == 1) {
		$("#Entidad_representante_legal").attr("disabled",true);
		$("#Entidad_tipo_id_rep").attr("disabled",true);
		$("#Entidad_representante_id").attr("disabled",true);
	}
}

function agregarTipoPres(){
	contTipo++;
	htmlCode  = '<div id="tp_'+contTipo+'">';
	htmlCode += '<input name="Tamano_Coleccion['+contTipo+'][tipo_preservacion]" size="32" maxlength="150" class="textareaA textInline" placeholder="<?=$tamano_coleccion->attributeLabels()['tipo_preservacion'];?>" id="Tamano_Coleccion_tipo_preservacion_'+contTipo+'" type="text">';
	htmlCode += '<input name="Tamano_Coleccion['+contTipo+'][unidad_medida]" size="32" maxlength="150" class="textareaA textInline" placeholder="<?=$tamano_coleccion->attributeLabels()['unidad_medida'];?>" id="Tamano_Coleccion_unidad_medida_'+contTipo+'" type="text">';
	//htmlCode += '<input onchange="sumarTipo(\'cantSum\',\'Registros_Update_tamano_coleccion_total\')" name="Tamano_Coleccion['+contTipo+'][cantidad]" size="32" maxlength="150" class="textareaA textInline cantSum" placeholder="<?=$tamano_coleccion->attributeLabels()['cantidad'];?>" id="Tamano_Coleccion_cantidad_'+contTipo+'" type="text">';
	htmlCode += '<a class="addType btn btn-danger btn-small" onclick="eliminarTipoPres(\'tp_'+contTipo+'\',\'cantSum\',\'Registros_Update_tamano_coleccion_total\')" id="yw'+contTipo+'">-</a>';
	htmlCode += '</div>';

	
	$("#tamCole").append(htmlCode);
}

function agregarTipoCol(){
	contTipoCol++;
	htmlCode  = '<div id="tc_'+contTipoCol+'">';
	htmlCode += '<input name="Tipos_En_Coleccion['+contTipoCol+'][grupo]" size="32" maxlength="150" class="textareaA textInline" placeholder="<?=$tipos_en_coleccion->attributeLabels()['grupo'];?>" id="Tipos_En_Coleccion_grupo_'+contTipoCol+'" type="text">';
	htmlCode += '<input name="Tipos_En_Coleccion['+contTipoCol+'][informacion_ejemplar]" size="32" maxlength="150" class="textareaA textInline" placeholder="<?=$tipos_en_coleccion->attributeLabels()['informacion_ejemplar'];?>" id="Tipos_En_Coleccion_informacion_ejemplar_'+contTipoCol+'" type="text">';
	htmlCode += '<input name="Tipos_En_Coleccion['+contTipoCol+'][nombre_cientifico]" size="32" maxlength="150" class="textareaA textInline" placeholder="<?=$tipos_en_coleccion->attributeLabels()['nombre_cientifico'];?>" id="Tipos_En_Coleccion_nombre_cientifico_'+contTipoCol+'" type="text">';
	//htmlCode += '<input onchange="sumarTipo(\'cantSumTipo\',\'Registros_Update_tipo_coleccion_total\')" name="Tipos_En_Coleccion['+contTipoCol+'][cantidad]" size="32" maxlength="150" class="textareaA textInline cantSumTipo" placeholder="<?=$tipos_en_coleccion->attributeLabels()['cantidad'];?>" id="Tipos_En_Coleccion_cantidad_'+contTipoCol+'" type="text">';
	htmlCode += '<a class="addType btn btn-danger btn-small" onclick="eliminarTipoPres(\'tc_'+contTipoCol+'\',\'cantSumTipo\',\'Registros_Update_tipo_coleccion_total\')" id="yw'+contTipoCol+'">-</a>';
	htmlCode += '</div>';

	
	$("#tipoCole").append(htmlCode);
}

function agregarNivelCat(){
	contNivelCat++;
	htmlCode	 = '<div style="margin-top: 10px;" id="nc_'+contNivelCat+'">';
	htmlCode	+= '<input style="width:150px !important; margin-right: 5px" name="Composicion_General['+contNivelCat+'][grupo_taxonomico]" size="32" maxlength="150" class="textareaA " placeholder="<?=$composicion_general->attributeLabels()['grupo_taxonomico'];?>" id="Composicion_General_grupo_taxonomico_'+contNivelCat+'" type="text">';
	htmlCode	+= '<input style="width:80px !important" name="Composicion_General['+contNivelCat+'][numero_ejemplares]" size="32" maxlength="150" class="textareaA valNum" placeholder="0" id="Composicion_General_numero_ejemplares_'+contNivelCat+'" type="text" value="0">';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General['+contNivelCat+'][numero_catalogados]" size="32" maxlength="150" class="textareaA valNumP" placeholder="0" id="Composicion_General_numero_catalogados_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General['+contNivelCat+'][numero_sistematizados]" size="32" maxlength="150" class="textareaA valNumP" placeholder="0" id="Composicion_General_numero_sistematizados_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General['+contNivelCat+'][numero_nivel_orden]" size="32" maxlength="150" class="textareaA valNumP" placeholder="0" id="Composicion_General_numero_nivel_orden_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General['+contNivelCat+'][numero_nivel_familia]" size="32" maxlength="150" class="textareaA valNumP" placeholder="0" id="Composicion_General_numero_nivel_familia_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General['+contNivelCat+'][numero_nivel_genero]" size="32" maxlength="150" class="textareaA valNumP" placeholder="0" id="Composicion_General_numero_nivel_genero_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General['+contNivelCat+'][numero_nivel_especie]" size="32" maxlength="150" class="textareaA compGeneral valNumP" placeholder="0" id="Composicion_General_numero_nivel_especie_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode 	+= '<a style="margin-left:4px" class="btn btn-danger btn-small" onclick="eliminarTipoPres(\'nc_'+contNivelCat+'\',\'compGeneral\',\'\')" id="yw'+contNivelCat+'">-</a>';
	htmlCode	+= '</div>';

	$("#nivelCat").append(htmlCode);
}

function eliminarTipoPres(idDiv,clase,id){
	clase = clase.trim();
	
	$("#"+idDiv).remove();
	
	if(clase != "" && id != ""){
		sumarTipo(clase,id);
	}
}

function sumarTipo(clase, id){
	total = 0;
	clase = clase.trim();
	$("."+clase).each(
		function (index,value){
			valor = 0;
			if(!isNaN($(this).val()) && eval($(this).val()) != null)
			{
				valor = eval($(this).val());
				$(this).removeClass("error");
			}else{
				$(this).addClass("error");
				alert("El valor debe ser numérico");
				valor = 0;
				$(this).focus();
			}
			total = total + valor;
		}
	);

	$("#"+id).val(total);
}

$( document ).ready(function() {
	$(".valNum").change(function(){
		if(!isNaN($(this).val()))
		{
			$(this).removeClass("error");
		}else{
			$(this).addClass("error");
			alert("El valor debe ser numérico");
			$(this).focus();
		}
	});

	$(".valNumP").change(function(){
		if(!isNaN($(this).val()))
		{
			if(eval($(this).val()) <= 100){
				$(this).removeClass("error");
			}else{
				$(this).addClass("error");
				alert("El valor debe ser menor a 100");
				$(this).focus();
			}
			
		}else{
			$(this).addClass("error");
			alert("El valor debe ser numérico");
			$(this).focus();
		}
	});
});

function enviarData(){
	$("#Registros_Update_estado").val("1");
	$("#registro-form").submit();
}

contUp = 0;
randWord = Math.floor((Math.random()*1000)+1);
$(function() {
    $('#Registros_Update_archivoAnexo').uploadify({
    	'auto'     		: true,
    	'fileSizeLimit' : '20MB',
    	'buttonText'	: 'Seleccionar Archivo',
    	'width'         : 140,
    	'fileTypeExts'  : '*.pdf;*.zip',
    	'multi'			: true,
    	'formData'		: {'randWord' : randWord},
    	'swf'      		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.swf',
        'uploader' 		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.php',
        'checkExisting' : '<?=Yii::app()->theme->baseUrl;?>/scripts/check-exists.php',
        
		'onUploadComplete' : function(file){
			
			dataFile = randWord+'_'+file.name+'/'+file.type+'/'+file.size;
			val_aux	 = $('#Registros_Update_archivosAnexos').val();

			if(val_aux.trim() == ''){
				$('#Registros_Update_archivosAnexos').val(dataFile);
			}else{
				val_aux	+= ','+dataFile;
				$('#Registros_Update_archivosAnexos').val(val_aux);
			}

			html = '<div id="flup_'+contUp+'" class="uploadify-queue-item" style="margin-left:220px">';
			html += '<div class="cancel">';
			html += '<a onclick = "deleteFileUpAjax(\'flup_'+contUp+'\',\''+file.name+'\')">X</a></div>';
			html += '<span class="fileName">'+file.name+'</span><span class="data"></span>';
			html += '</div>';
			$("#adjFile").append(html);
			contUp++;
		}
    });
    
    contUp2 = 0;
    
    $('#Registros_Update_archivoColeccion').uploadify({
    	'auto'     		: true,
    	'fileSizeLimit' : '40MB',
    	'buttonText'	: 'Seleccionar Archivo',
    	'width'         : 140,
    	'fileTypeExts'  : '*.jpg;*.gif;*.jpeg;*.avi;*.mp4;*.mp3;*.pdf;*.jpg;*.gif;*.jpeg',
    	'multi'			: true,
    	'formData'		: {'randWord' : randWord},
    	'swf'      		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.swf',
        'uploader' 		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.php',
        'checkExisting' : '<?=Yii::app()->theme->baseUrl;?>/scripts/check-exists.php',
		'onUploadComplete' : function(file){

			dataFile = randWord+'_'+file.name+'/'+file.type+'/'+file.size;
			val_aux	 = $('#Registros_Update_archivosColecciones').val();

			if(val_aux.trim() == ''){
				$('#Registros_Update_archivosColecciones').val(dataFile);
			}else{
				val_aux	+= ','+dataFile;
				$('#Registros_Update_archivosColecciones').val(val_aux);
			}

			html = '<div id="flcolup_'+contUp2+'" class="uploadify-queue-item" style="margin-left:220px">';
			html += '<div class="cancel">';
			html += '<a onclick = "deleteFileUpAjax(\'flcolup_'+contUp2+'\',\''+file.name+'\')">X</a></div>';
			html += '<span class="fileName">'+file.name+'</span><span class="data"></span>';
			html += '</div>';
			$("#archColFile").append(html);
			contUp2++;
		}
    });

});


</script>
<style>
<!--
.area-contenido{
	min-width: 770px
}
-->
</style>
<div class="form">

<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'registro-form',
		'type'=>'horizontal',
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		'enableClientValidation'=>true,
		'enableAjaxValidation'=>false,
));
?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>
	
	<ul class="nav nav-tabs">
    	<li class="active"><a href="#tab1" data-toggle="tab">Titular</a></li>
    	<li><a href="#tab2" data-toggle="tab">Información Básica</a></li>
    	<li><a href="#tab3" data-toggle="tab">Contacto</a></li>
    	<li><a href="#tab4" data-toggle="tab">Elaborado Por</a></li>
  	</ul>
	<?php echo $form->errorSummary($model);
		  echo $form->errorSummary($model->entidad);
		  echo $form->errorSummary($model->registros_update);
		  echo $form->errorSummary($model->registros_update->tamano_coleccion);
		  echo $form->errorSummary($model->registros_update->tipos_en_coleccion);
		  echo $form->errorSummary($model->registros_update->composicion_general);
		  echo $form->errorSummary($model->registros_update->contactos);
		  echo $form->errorSummary($model->registros_update->dilegenciadores);
	?>
	
	<div class="tab-content">
		<div class="tab-pane fade in active" id="tab1">
			<fieldset>
				<legend class="form_legend">REGISTRO</legend>
				<?php 
					echo $form->textFieldRow($model, 'fecha_dil', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->hiddenField($model->registros_update, 'estado');
					if(isset($act)){
						echo $form->textFieldRow($model, 'numero_registro', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA', 'disabled'=>true));
					}else{
						echo $form->textFieldRow($model, 'numero_registro', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA', 'onchange' => 'validarNumeroColeccion(this,this.value);'));
						echo '<i class="icon-info-sign" rel="tooltip" title = "Ingrese el número de Colección asignado, de lo contrario ingrese 0."></i>';
					}
				?>
			</fieldset>
			<fieldset>
				<legend class="form_legend">TITULAR DE LA COLECCIÓN</legend>
				<?php 
					echo $form->textFieldRow($model->entidad, 'titular', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->dropDownListRow($model->entidad, 'tipo_titular', $model->entidad->listarTipo(),array('prompt' => 'Seleccionar...','onchange' => 'activarTipo()','disabled'=>true));
					echo $form->textFieldRow($model->entidad, 'nit', array('size'=>32,'maxlength'=>64, 'class'=>'textareaA','disabled'=>true));
					echo $form->textFieldRow($model->entidad, 'representante_legal', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->dropDownListRow($model->entidad, 'tipo_id_rep', $model->entidad->listarTipoIdRep(),array('prompt' => 'Seleccionar...','disabled'=>true));
					echo $form->textFieldRow($model->entidad, 'representante_id', array('size'=>32,'maxlength'=>64, 'class'=>'textareaA','disabled'=>true));
					echo $form->textFieldRow($model->entidad, 'direccion', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->dropDownListRow($model->entidad, 'ciudad_id', $model->entidad->ListarCiudades(),array('prompt' => 'Seleccionar...','disabled'=>true));
					echo $form->textFieldRow($model->entidad, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->textFieldRow($model->entidad, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA','disabled'=>true));
				?>
			</fieldset>
		</div>
		
		<div class="tab-pane fade" id="tab2">
			<fieldset>
				<legend class="form_legend">INFORMACIÓN BÁSICA DE LA COLECCIÓN</legend>
				<?php 
					echo $form->textFieldRow($model->registros_update, 'nombre', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Nombre con el que se conoce la colección."></i>';
					echo $form->textFieldRow($model->registros_update, 'acronimo', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA', 'onchange' => 'validarAcronimo(this,this.value);'));
					echo '<i class="icon-info-sign" rel="tooltip" title = " Es la sigla que identifica la colección ante el mundo, por lo tanto debe ser única."></i>';
					echo $form->dropDownListRow($model->registros_update, 'fecha_fund', $model->registros_update->listYearFund(),array('prompt' => 'Seleccionar...'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Año de la fundación de la colección, de acuerdo con los documentos que acreditan la creación de la colección, según el artículo 175 del Decreto 1608 de 1978."></i>';
					echo $form->textAreaRow($model->registros_update, 'descripcion', array('class'=>'span4', 'rows'=>4));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Texto que describe la colección y que incluye características sobresalientes de la misma, está orientado al público en general."></i>';
					echo $form->textFieldRow($model->registros_update, 'direccion', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Direccion."></i>';
					echo $form->dropDownListRow($model->registros_update, 'ciudad_id', $model->registros_update->ListarCiudades(),array('prompt' => 'Seleccionar...'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Ciudad."></i>';
					echo $form->textFieldRow($model->registros_update, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Telefono."></i>';
					echo $form->textFieldRow($model->registros_update, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Email."></i>';
				?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">Cobertura</legend>
				
				<?php 
					echo $form->textFieldRow($model->registros_update, 'cobertura_tax', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo $form->textFieldRow($model->registros_update, 'cobertura_geog', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo $form->textFieldRow($model->registros_update, 'cobertura_temp', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
				?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">Tipos de preservación</legend>
				<div class="InlineFormDiv" id="tamCole">
					
					<?php 
						if(!isset($model->registros_update->id)){
							echo "<div>";
							echo $form->textField($model->registros_update->tamano_coleccion, 'tipo_preservacion', array('name'=>'Tamano_Coleccion[0][tipo_preservacion]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $model->registros_update->tamano_coleccion->attributeLabels()['tipo_preservacion']));
							echo $form->textField($model->registros_update->tamano_coleccion, 'unidad_medida', array('name'=>'Tamano_Coleccion[0][unidad_medida]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $model->registros_update->tamano_coleccion->attributeLabels()['unidad_medida']));
							//echo $form->textField($model->registros_update->tamano_coleccion, 'cantidad', array('onchange' => 'sumarTipo("cantSum","Registros_Update_tamano_coleccion_total")','name'=>'Tamano_Coleccion[0][cantidad]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline cantSum', 'placeholder' => $model->registros_update->tamano_coleccion->attributeLabels()['cantidad']));
							
							$this->widget('bootstrap.widgets.TbButton', array(
									'label'=>'+',
									'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
									'size'=>'small', // null, 'large', 'small' or 'mini'
									'htmlOptions'=>array('class'=>'addType','onclick' => 'agregarTipoPres()')
							));
							echo "</div>";
						}else {
							$dataTamano = $model->registros_update->tamano_coleccion;
							$cont = 0;
							foreach ($dataTamano as $value){
								echo '<div id="tp_'.$cont.'">';
								echo $form->textField($value, 'tipo_preservacion', array('value' => $value->tipo_preservacion, 'name'=>'Tamano_Coleccion['.$cont.'][tipo_preservacion]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $tamano_coleccion->attributeLabels()['tipo_preservacion']));
								echo $form->textField($value, 'unidad_medida', array('value' => $value->unidad_medida, 'name'=>'Tamano_Coleccion['.$cont.'][unidad_medida]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $tamano_coleccion->attributeLabels()['unidad_medida']));
								//echo $form->textField($value, 'cantidad', array('value' => $value->cantidad, 'onchange' => 'sumarTipo("cantSum","Registros_Update_tamano_coleccion_total")','name'=>'Tamano_Coleccion['.$cont.'][cantidad]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline cantSum', 'placeholder' => $tamano_coleccion->attributeLabels()['cantidad']));
								echo $form->hiddenField($value, 'id',array('value' => $value->id,'name'=>'Tamano_Coleccion['.$cont.'][id]'));	
								
								$this->widget('bootstrap.widgets.TbButton', array(
										'label'=>($cont == 0) ? "+" : "-",
										'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
										'size'=>'small', // null, 'large', 'small' or 'mini'
										'htmlOptions'=>array('class'=>($cont == 0) ? "addType" : "addType btn-danger",'onclick' => ($cont == 0) ? "agregarTipoPres()" : "eliminarTipoPres('tp_".$cont."','cantSum','Registros_Update_tamano_coleccion_total')")
								));
								$cont++;
								echo "</div>";
							}
							
							$cont = $cont - 1;
							echo '<script type="text/javascript">
									contTipo 		= '.$cont.';
								</script>';
						}
					?>
					
				</div>
				
				<?php 
					//echo $form->textFieldRow($model->registros_update, 'tamano_coleccion_total', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA totalRow'));
				?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">Nivel de catalogación, sistematización e identificación</legend>
				<div style="padding-left: 160px">
					<label class="control-label required inlineLabel" style="width:80px !important"><?=$composicion_general->attributeLabels()['numero_ejemplares'];?></label>
					<label class="control-label required inlineLabel" style="width:63px !important">1.</label>
					<label class="control-label required inlineLabel" style="width:63px !important">2.</label>
					<label class="control-label required inlineLabel" style="width:63px !important">3.</label>
					<label class="control-label required inlineLabel" style="width:63px !important">4.</label>
					<label class="control-label required inlineLabel" style="width:63px !important">5.</label>
					<label class="control-label required inlineLabel" style="width:63px !important">6.</label>
				</div>
				<div style="clear: both;" id="nivelCat">
					<div>
					<?php if(!isset($model->registros_update->id)){?>
						<?php 
							echo $form->textField($model->registros_update->composicion_general, 'grupo_taxonomico', array('style' => 'width:150px !important; margin-right: 5px','name'=>'Composicion_General[0][grupo_taxonomico]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => $model->registros_update->composicion_general->attributeLabels()['grupo_taxonomico']));
							echo $form->textField($model->registros_update->composicion_general, 'numero_ejemplares', array('style' => 'width:80px !important','name'=>'Composicion_General[0][numero_ejemplares]','size'=>32,'maxlength'=>150, 'class'=>'textareaA valNum', 'placeholder' => 0));
						?>
						<div class="input-append">
							<?=$form->textField($model->registros_update->composicion_general, 'numero_catalogados', array('style' => 'width:30px !important','name'=>'Composicion_General[0][numero_catalogados]','size'=>32,'maxlength'=>150, 'class'=>'textareaA valNumP', 'placeholder' => 0));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($model->registros_update->composicion_general, 'numero_sistematizados', array('style' => 'width:30px !important','name'=>'Composicion_General[0][numero_sistematizados]','size'=>32,'maxlength'=>150, 'class'=>'textareaA valNumP', 'placeholder' => 0));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($model->registros_update->composicion_general, 'numero_nivel_orden', array('style' => 'width:30px !important','name'=>'Composicion_General[0][numero_nivel_orden]','size'=>32,'maxlength'=>150, 'class'=>'textareaA valNumP', 'placeholder' => 0));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($model->registros_update->composicion_general, 'numero_nivel_familia', array('style' => 'width:30px !important','name'=>'Composicion_General[0][numero_nivel_familia]','size'=>32,'maxlength'=>150, 'class'=>'textareaA valNumP', 'placeholder' => 0));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($model->registros_update->composicion_general, 'numero_nivel_genero', array('style' => 'width:30px !important','name'=>'Composicion_General[0][numero_nivel_genero]','size'=>32,'maxlength'=>150, 'class'=>'textareaA valNumP', 'placeholder' => 0));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($model->registros_update->composicion_general, 'numero_nivel_especie', array('style' => 'width:30px !important','name'=>'Composicion_General[0][numero_nivel_especie]','size'=>32,'maxlength'=>150, 'class'=>'textareaA compGeneral valNumP', 'placeholder' => 0));?>
							<span class="add-on">%</span>
						</div>
						<?php 
						$this->widget('bootstrap.widgets.TbButton', array(
								'label'=>'+',
								'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
								'size'=>'small', // null, 'large', 'small' or 'mini'
								'htmlOptions'=>array('class'=>'','onclick' => 'agregarNivelCat()')
						));
						?>
						
					<?php }else{
							
							$dataTipo	= $model->registros_update->composicion_general;
							$cont = 0;
							foreach ($dataTipo as $value){
								
					?>
						<?php 
							echo $form->hiddenField($value, 'id',array('value' => $value->id,'name'=>'Composicion_General['.$cont.'][id]'));
							echo $form->textField($value, 'grupo_taxonomico', array('value' => $value->grupo_taxonomico,'style' => 'width:150px !important; margin-right: 5px','name'=>'Composicion_General['.$cont.'][grupo_taxonomico]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => $composicion_general->attributeLabels()['grupo_taxonomico']));
							echo $form->textField($value, 'numero_ejemplares', array('value' => $value->numero_ejemplares,'style' => 'width:80px !important','name'=>'Composicion_General['.$cont.'][numero_ejemplares]','size'=>32,'maxlength'=>150, 'class'=>'textareaA valNum', 'placeholder' => 0));
						?>
						<div class="input-append">
							<?=$form->textField($value, 'numero_catalogados', array('value' => $value->numero_catalogados,'style' => 'width:30px !important','name'=>'Composicion_General['.$cont.'][numero_catalogados]','size'=>32,'maxlength'=>150, 'class'=>'textareaA valNumP', 'placeholder' => 0));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($value, 'numero_sistematizados', array('value' => $value->numero_sistematizados,'style' => 'width:30px !important','name'=>'Composicion_General['.$cont.'][numero_sistematizados]','size'=>32,'maxlength'=>150, 'class'=>'textareaA valNumP', 'placeholder' => 0));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($value, 'numero_nivel_orden', array('value' => $value->numero_nivel_orden,'style' => 'width:30px !important','name'=>'Composicion_General['.$cont.'][numero_nivel_orden]','size'=>32,'maxlength'=>150, 'class'=>'textareaA valNumP', 'placeholder' => 0));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($value, 'numero_nivel_familia', array('value' => $value->numero_nivel_familia,'style' => 'width:30px !important','name'=>'Composicion_General['.$cont.'][numero_nivel_familia]','size'=>32,'maxlength'=>150, 'class'=>'textareaA valNumP', 'placeholder' => 0));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($value, 'numero_nivel_genero', array('value' => $value->numero_nivel_genero,'style' => 'width:30px !important','name'=>'Composicion_General['.$cont.'][numero_nivel_genero]','size'=>32,'maxlength'=>150, 'class'=>'textareaA valNumP', 'placeholder' => 0));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($value, 'numero_nivel_especie', array('value' => $value->numero_nivel_especie,'style' => 'width:30px !important','name'=>'Composicion_General['.$cont.'][numero_nivel_especie]','size'=>32,'maxlength'=>150, 'class'=>'textareaA compGeneral valNumP', 'placeholder' => 0));?>
							<span class="add-on">%</span>
						</div>
						<?php 
						$this->widget('bootstrap.widgets.TbButton', array(
								'label'=>($cont == 0) ? "+" : "-",
								'type'=> ($cont == 0) ? "success" : "danger", // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
								'size'=>'small', // null, 'large', 'small' or 'mini'
								'htmlOptions'=>array('class'=>'','onclick' => ($cont == 0) ? "agregarNivelCat()" : "eliminarTipoPres('nc_".$cont."','compGeneral','')")
						));
						?>
					<?php
								$cont++;
							} 
							
							$cont = $cont - 1;
							echo '<script type="text/javascript">
									contNivelCat 	= '.$cont.';
								</script>';
						}
						?>
				</div>
				</div>
				
				<div style="padding-top: 10px">
					<label class="control-label required inlineLabel2" ><b>1.</b> <?=$composicion_general->attributeLabels()['numero_catalogados'];?></label>
					<label class="control-label required inlineLabel2" ><b>2.</b> <?=$composicion_general->attributeLabels()['numero_sistematizados'];?></label>
					<label class="control-label required inlineLabel2" ><b>3.</b> <?=$composicion_general->attributeLabels()['numero_nivel_orden'];?></label>
					<label class="control-label required inlineLabel2" ><b>4.</b> <?=$composicion_general->attributeLabels()['numero_nivel_familia'];?></label>
					<label class="control-label required inlineLabel2" ><b>5.</b> <?=$composicion_general->attributeLabels()['numero_nivel_genero'];?></label>
					<label class="control-label required inlineLabel2" ><b>6.</b> <?=$composicion_general->attributeLabels()['numero_nivel_especie'];?></label>
				</div>
				<?php 
					echo $form->textFieldRow($model->registros_update, 'deorreferenciados', array('class'=>'span4', 'rows'=>4)); 
					echo $form->textAreaRow($model->registros_update, 'sistematizacion', array('class'=>'span4', 'rows'=>4)); 
				?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">Tipos en la colección</legend>
				<div class="InlineFormDiv" id="tipoCole">
				<?php 
					if(!isset($model->registros_update->id)){
						echo "<div>";
						echo $form->textField($model->registros_update->tipos_en_coleccion, 'grupo', array('name'=>'Tipos_En_Coleccion[0][grupo]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $model->registros_update->tipos_en_coleccion->attributeLabels()['grupo']));
						echo $form->textField($model->registros_update->tipos_en_coleccion, 'informacion_ejemplar', array('name'=>'Tipos_En_Coleccion[0][informacion_ejemplar]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $model->registros_update->tipos_en_coleccion->attributeLabels()['informacion_ejemplar']));
						echo $form->textField($model->registros_update->tipos_en_coleccion, 'nombre_cientifico', array('name'=>'Tipos_En_Coleccion[0][nombre_cientifico]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $model->registros_update->tipos_en_coleccion->attributeLabels()['nombre_cientifico']));
						//echo $form->textField($model->registros_update->tipos_en_coleccion, 'cantidad', array('onchange' => 'sumarTipo("cantSumTipo","Registros_Update_tipo_coleccion_total")','name'=>'Tipos_En_Coleccion[0][cantidad]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline cantSumTipo', 'placeholder' => $model->registros_update->tipos_en_coleccion->attributeLabels()['cantidad']));
						
						$this->widget('bootstrap.widgets.TbButton', array(
								'label'=>'+',
								'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
								'size'=>'small', // null, 'large', 'small' or 'mini'
								'htmlOptions'=>array('class'=>'addType','onclick' => 'agregarTipoCol()')
						));

						echo "</div>";
					}else {
						
						$dataTipo	= $model->registros_update->tipos_en_coleccion;
						$cont = 0;
						
						foreach ($dataTipo as $value){
							echo '<div id="tc_'.$cont.'">';
							echo $form->textField($value, 'grupo', array('value' => $value->grupo,'name'=>'Tipos_En_Coleccion['.$cont.'][grupo]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $tipos_en_coleccion->attributeLabels()['grupo']));
							echo $form->textField($value, 'informacion_ejemplar', array('value' => $value->informacion_ejemplar,'name'=>'Tipos_En_Coleccion['.$cont.'][informacion_ejemplar]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $tipos_en_coleccion->attributeLabels()['informacion_ejemplar']));
							echo $form->textField($value, 'nombre_cientifico', array('value' => $value->nombre_cientifico,'name'=>'Tipos_En_Coleccion['.$cont.'][nombre_cientifico]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $tipos_en_coleccion->attributeLabels()['nombre_cientifico']));
							//echo $form->textField($value, 'cantidad', array('value' => $value->cantidad, 'onchange' => 'sumarTipo("cantSumTipo","Registros_Update_tipo_coleccion_total")','name'=>'Tipos_En_Coleccion['.$cont.'][cantidad]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline cantSumTipo', 'placeholder' => $tipos_en_coleccion->attributeLabels()['cantidad']));
							echo $form->hiddenField($value, 'id',array('value' => $value->id,'name'=>'Tipos_En_Coleccion['.$cont.'][id]'));
							
							$this->widget('bootstrap.widgets.TbButton', array(
									'label'=>($cont == 0) ? "+" : "-",
									'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
									'size'=>'small', // null, 'large', 'small' or 'mini'
									'htmlOptions'=>array('class'=>($cont == 0) ? "addType" : "addType btn-danger",'onclick' => ($cont == 0) ? "agregarTipoCol()" : "eliminarTipoPres('tc_".$cont."','cantSumTipo','Registros_Update_tipo_coleccion_total')")
							));
							$cont++;
							echo "</div>";
						}
						
						$cont = $cont - 1;
						echo '<script type="text/javascript">
								contTipoCol 	= '.$cont.';
							</script>';
					}
				?>
				</div>
				
				<?php 
					//echo $form->textFieldRow($model->registros_update, 'tipo_coleccion_total', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA totalRow2'));
				?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">DOCUMENTOS ADJUNTOS</legend>
				<?php 
					echo $form->textAreaRow($model->registros_update, 'listado_anexos', array('class'=>'span4', 'rows'=>4));
					echo $form->fileFieldRow($model->registros_update, 'archivoAnexo');
					echo $form->hiddenField($model->registros_update, 'archivosAnexos');
				?>
				<div id = "adjFile">
				<?php 
					if(isset($model->registros_update->id) && $model->registros_update->estado != 2){
						$criteria = new CDbCriteria;
						$criteria->compare('clase',1);
						$criteria->compare('Registros_update_id',$model->registros_update->id);
						$dataTipo	= Archivos::model()->findAll($criteria);
						$cont = 0;
						
						foreach ($dataTipo as $value){
							echo '<div id="fl_'.$cont.'" class="uploadify-queue-item" style="margin-left:220px">';
							if($model->registros_update->estado == 0){
								echo '<div class="cancel">';
								echo '<a onclick = "deleteFileAjax(\'fl_'.$cont.'\','.$value->id.')">X</a></div>';
							}
							$url = Yii::app()->createUrl('..'.DIRECTORY_SEPARATOR.$value->ruta.DIRECTORY_SEPARATOR.$value->nombre);
							echo '<span class="fileName">'.$value->nombre.'</span><span class="data"><a class="viewFileReg" target="_blank" href="'.$url.'">Ver</a></span>';
							echo '</div>';
				?>
                <?php }}?>
                </div>
				<?php 
				/*
					$this->widget('bootstrap.widgets.TbButton', array(
							'label'=>"Subir",
							'type'=> "info", // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
							'size'=>'small', // null, 'large', 'small' or 'mini'
							'htmlOptions'=>array('style' => 'margin:5px 0 20px 220px','class'=>'','onclick' => "$('#Registros_Update_archivoAnexo').uploadify('upload')")
					));*/
				?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">INFORMACIÓN COMPLEMENTARIA</legend>
				<?php 
					echo $form->textAreaRow($model->registros_update, 'info_adicional', array('class'=>'span4', 'rows'=>4));
					echo $form->textFieldRow($model->registros_update, 'pagina_web', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','prepend'=>'http://'));
					echo $form->fileFieldRow($model->registros_update, 'archivoColeccion');
				?>
				<div id = "archColFile">
				<?php 
					if(isset($model->registros_update->id) && $model->registros_update->estado != 2){
						$criteria = new CDbCriteria;
						$criteria->compare('clase',2);
						$criteria->compare('Registros_update_id',$model->registros_update->id);
						$dataTipo	= Archivos::model()->findAll($criteria);
						$cont = 0;
						
						foreach ($dataTipo as $value){
							echo '<div id="flc_'.$cont.'" class="uploadify-queue-item" style="margin-left:220px">';
							if($model->registros_update->estado == 0){
								echo '<div class="cancel">';
								echo '<a onclick = "deleteFileAjax(\'flc_'.$cont.'\','.$value->id.')">X</a></div>';
							}
							$url = Yii::app()->createUrl('..'.DIRECTORY_SEPARATOR.$value->ruta.DIRECTORY_SEPARATOR.$value->nombre);
							echo '<span class="fileName">'.$value->nombre.'</span><span class="data"><a class="viewFileReg" target="_blank" href="'.$url.'">Ver</a></span>';
							echo '</div>';
							$cont++;
							}
					}
				?>
				</div>
                <?php /*
					$this->widget('bootstrap.widgets.TbButton', array(
							'label'=>"Subir",
							'type'=> "info", // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
							'size'=>'small', // null, 'large', 'small' or 'mini'
							'htmlOptions'=>array('style' => 'margin:5px 0 20px 220px','class'=>'','onclick' => "$('#Registros_Update_archivoColeccion').uploadify('upload')")
					));*/

					echo $form->hiddenField($model->registros_update, 'archivosColecciones');
				?>

			</fieldset>
		</div>
	
		<div class="tab-pane fade" id="tab3">
			<fieldset>
				<legend class="form_legend">DATOS DE CONTACTO</legend>
				<?php 
					echo $form->textFieldRow($model->registros_update->contactos, 'nombre', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo $form->textFieldRow($model->registros_update->contactos, 'cargo', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo $form->textFieldRow($model->registros_update->contactos, 'dependencia', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo $form->textFieldRow($model->registros_update->contactos, 'direccion', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo $form->dropDownListRow($model->registros_update->contactos, 'ciudad_id', $model->registros_update->ListarCiudades(),array('prompt' => 'Seleccionar...'));
					echo $form->textFieldRow($model->registros_update->contactos, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo $form->textFieldRow($model->registros_update->contactos, 'email', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
				?>
			</fieldset>
		</div>
		
		<div class="tab-pane fade" id="tab4">
			<fieldset>
				<legend class="form_legend">ELABORACIÓN DEL REGISTRO</legend>
				<?php 
					echo $form->textFieldRow($model->registros_update->dilegenciadores, 'nombre', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo $form->textFieldRow($model->registros_update->dilegenciadores, 'dependencia', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo $form->textFieldRow($model->registros_update->dilegenciadores, 'cargo', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo $form->textFieldRow($model->registros_update->dilegenciadores, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo $form->textFieldRow($model->registros_update->dilegenciadores, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA'));
				?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">TÉRMINOS Y CONDICIONES</legend>
				<p class="noteTerm">El titular de la colección biológica (persona jurídica o su representante legal) manifiesta que la información consignada en este registro es fidedigna y se sujetará a las Leyes, Decretos y Actos Administrativos que reglamentan el uso, manejo y aprovechamiento de la diversidad biológica.</p>
				<?php echo $form->checkBoxRow($model->registros_update, 'terminos');?>
			</fieldset>
		</div>
	</div>			
	<div id="catalogouser-botones-internos" class="form-actions pull-right">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'success', 'label'=>'Guardar', 'htmlOptions' => array('onclick' => 'enviarForm()'))); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'catalogo-user-form-interno-enviar', 'type'=>'success', 'label'=>$model->isNewRecord ? 'Enviar' : 'Actualizar','htmlOptions' => array('onclick'=>'{enviarData()}'))); ?>
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'id'=>'catalogo-user-form-interno-reset', 'label'=>'Limpiar campos')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->