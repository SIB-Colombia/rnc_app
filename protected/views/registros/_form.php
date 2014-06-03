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
	
	if($this->route != 'registros/create'){
		echo 'urlAjax 			= "../deleteFileAjax";';
		echo 'urlAjaxValidar 	= "../validarColeccionAjax";';
		echo 'urlAjaxValidarAcr	= "../validarAcronimoAjax";';
		echo 'urlAjaxTraeTipoPre = "../traerTipoPreAjax";';
		echo 'urlAjaxActSelectSub = "../actSelectSubgrupoAjax";';
		echo 'urlAjaxCiudad	= "../../entidad/cargaCiudad";';
	}else{
		echo 'urlAjax 			= "deleteFileAjax";';
		echo 'urlAjaxValidar 	= "validarColeccionAjax";';
		echo 'urlAjaxValidarAcr	= "validarAcronimoAjax";';
		echo 'urlAjaxTraeTipoPre = "traerTipoPreAjax";';
		echo 'urlAjaxActSelectSub = "actSelectSubgrupoAjax";';
		echo 'urlAjaxCiudad	= "../entidad/cargaCiudad";';
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
	$("#Registros_update_estado").val("0");
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
	htmlCode  = '<div id="tp_'+contTipo+'" style="margin-top:10px">';
	htmlCode += '<select name="Tamano_Coleccion['+contTipo+'][tipo_preservacion_id]" class="textareaA textInline" onchange="otroSelect(this)" style="width:180px !important;" id="Tamano_Coleccion_tipo_preservacion_id_'+contTipo+'">';
	
	<?php
		$datos = Tipo_Preservacion::model()->listarTipoPreservacion();
		echo 'htmlCode += \'<option value>Seleccionar...</option>\';';
		foreach ($datos as $k => $dato){
			echo 'htmlCode += \'<option value="'.$k.'">'.$dato.'</option>\';';
		}
	?>
	
	htmlCode += '</select>';
	htmlCode += '<input name="Tamano_Coleccion['+contTipo+'][otro]" size="32" maxlength="150" class="textareaA textInline" placeholder="Otro? Cual..." style="display: none;" id="Tamano_Coleccion_otro_'+contTipo+'" type="text">';
	htmlCode += '<textarea style="line-height: 10px" class="span4" rows="4" name="Tamano_Coleccion['+contTipo+'][unidad_medida]" placeholder="<?=$tamano_coleccion->getAttributeLabel('unidad_medida');?>" id="Tamano_Coleccion_unidad_medida_'+contTipo+'"></textarea>';
	htmlCode += '<a class="addType btn btn-danger btn-small" onclick="eliminarTipoPres(\'tp_'+contTipo+'\',\'cantSum\',\'Registros_Update_tamano_coleccion_total\')" id="yw'+contTipo+'">-</a>';
	htmlCode += '</div>';

	
	$("#tamCole").append(htmlCode);
}

function agregarTipoCol(){
	contTipoCol++;
	htmlCode  = '<div id="tc_'+contTipoCol+'" style="float:left;clear:both;margin-left:210px">';
	htmlCode += '<input name="Tipos_En_Coleccion['+contTipoCol+'][grupo]" size="32" maxlength="150" class="textareaA textInline" placeholder="<?=$tipos_en_coleccion->getAttributeLabel('grupo');?>" id="Tipos_En_Coleccion_grupo_'+contTipoCol+'" type="text">';
	htmlCode += '<input name="Tipos_En_Coleccion['+contTipoCol+'][cantidad]" size="32" maxlength="150" class="textareaA textInline" placeholder="<?=$tipos_en_coleccion->getAttributeLabel('cantidad');?>" id="Tipos_En_Coleccion_cantidad_'+contTipoCol+'" type="text">';
	htmlCode += '<a class="addType btn btn-danger btn-small" onclick="eliminarTipoPres(\'tc_'+contTipoCol+'\',\'cantSumTipo\',\'Registros_Update_tipo_coleccion_total\')" id="yw'+contTipoCol+'">-</a>';
	htmlCode += '</div>';

	
	$("#tipoCole").append(htmlCode);
}

function agregarNivelCat(){
	contNivelCat++;
	htmlCode	 = '<div style="margin-top: 10px;" id="nc_'+contNivelCat+'">';
	htmlCode	+= '<select onchange="actSelectSubgrupo(this,\'Composicion_General_subgrupo_taxonomico_id_'+contNivelCat+'\')" name="Composicion_General['+contNivelCat+'][grupo_taxonomico_id]" class="textareaA textInline" style="width:150px !important;margin-top:0" id="Composicion_General_grupo_taxonomico_id_'+contNivelCat+'">';

	<?php
		$datos = Grupo_Taxonomico::model()->listarGrupoTaxonomico();
		echo 'htmlCode += \'<option value>Grupo Taxonomico...</option>\';';
		foreach ($datos as $k => $dato){
			echo 'htmlCode += \'<option value="'.$k.'">'.$dato.'</option>\';';
		}
	?>
	
	htmlCode	+= '</select>';
	htmlCode	+= '<select name="Composicion_General['+contNivelCat+'][subgrupo_taxonomico_id]" onchange="subgrupoOtroSelect(this,\'Composicion_General_subgrupo_otro_'+contNivelCat+'\')" class="textareaA textInline" style="width:150px !important;margin-top:0" id="Composicion_General_subgrupo_taxonomico_id_'+contNivelCat+'">';

	<?php
		$datos = Subgrupo_Taxonomico::model()->listarSubgrupoTaxonomico();
		echo 'htmlCode += \'<option value>Subgrupo Taxonomico...</option>\';';
		foreach ($datos as $k => $dato){
			echo 'htmlCode += \'<option value="'.$k.'">'.$dato.'</option>\';';
		}
	?>
	
	htmlCode	+= '</select>';
	htmlCode	+= '<input style="width:80px !important" name="Composicion_General['+contNivelCat+'][numero_ejemplares]" size="32" maxlength="150" class="textareaA valNum" placeholder="0" id="Composicion_General_numero_ejemplares_'+contNivelCat+'" type="text" value="0">';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General['+contNivelCat+'][numero_catalogados]" size="32" maxlength="150" class="textareaA valNumP" placeholder="0" id="Composicion_General_numero_catalogados_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General['+contNivelCat+'][numero_sistematizados]" size="32" maxlength="150" class="textareaA valNumP" placeholder="0" id="Composicion_General_numero_sistematizados_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General['+contNivelCat+'][numero_nivel_orden]" size="32" maxlength="150" class="textareaA valNumP" placeholder="0" id="Composicion_General_numero_nivel_orden_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General['+contNivelCat+'][numero_nivel_familia]" size="32" maxlength="150" class="textareaA valNumP" placeholder="0" id="Composicion_General_numero_nivel_familia_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General['+contNivelCat+'][numero_nivel_genero]" size="32" maxlength="150" class="textareaA valNumP" placeholder="0" id="Composicion_General_numero_nivel_genero_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General['+contNivelCat+'][numero_nivel_especie]" size="32" maxlength="150" class="textareaA compGeneral valNumP" placeholder="0" id="Composicion_General_numero_nivel_especie_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode 	+= '<a style="margin-left:4px" class="btn btn-danger btn-small" onclick="eliminarTipoPres(\'nc_'+contNivelCat+'\',\'compGeneral\',\'\')" id="yw'+contNivelCat+'">-</a>';
	htmlCode	+= '<input style="width:140px !important;margin-top: 5px;margin-left:180px;display: none;" name="Composicion_General['+contNivelCat+'][subgrupo_otro]" size="32" maxlength="150" class="textareaA" placeholder="Otro? Cual..." id="Composicion_General_subgrupo_otro_'+contNivelCat+'" type="text">';
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

function otroSelect(data){
	if($(data).val() == 22){
		id = $(data).attr('id');
		$("#" +id+ " + input").show("slow");
	}else{
		id = $(data).attr('id');
		$("#" +id+ " + input").hide("slow");
	}
}

function subgrupoOtroSelect(data, id){
	if($(data).val() == 2){
		$("#" +id).show("slow");
	}else{
		$("#" +id).hide("slow");
	}
}

$(document).ready(function() {
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
	$("#Registros_update_estado").val("1");
	$("#registro-form").submit();
}

contUp = 0;
randWord = Math.floor((Math.random()*1000)+1);
$(function() {
    $('#Registros_update_archivoAnexo').uploadify({
    	'auto'     		: true,
    	'fileSizeLimit' : '20MB',
    	'buttonText'	: 'Seleccionar archivo',
    	'width'         : 140,
    	'fileTypeExts'  : '*.pdf;*.zip',
    	'multi'			: true,
    	'formData'		: {'randWord' : randWord},
    	'swf'      		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.swf',
        'uploader' 		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.php',
        'checkExisting' : '<?=Yii::app()->theme->baseUrl;?>/scripts/check-exists.php',
        
		'onUploadComplete' : function(file){
			
			dataFile = randWord+'_'+file.name+'/'+file.type+'/'+file.size;
			val_aux	 = $('#Registros_update_archivosAnexos').val();

			if(val_aux.trim() == ''){
				$('#Registros_update_archivosAnexos').val(dataFile);
			}else{
				val_aux	+= ','+dataFile;
				$('#Registros_update_archivosAnexos').val(val_aux);
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
 
    contUp2 = 0;
    
    $('#Registros_update_archivoColeccion').uploadify({
    	'auto'     		: true,
    	'fileSizeLimit' : '40MB',
    	'buttonText'	: 'Seleccionar archivo',
    	'width'         : 140,
    	'fileTypeExts'  : '*.jpg;*.gif;*.jpeg;*.avi;*.mp4;*.mp3;*.pdf;*.jpg;*.gif;*.jpeg',
    	'multi'			: true,
    	'formData'		: {'randWord' : randWord},
    	'swf'      		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.swf',
        'uploader' 		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.php',
        'checkExisting' : '<?=Yii::app()->theme->baseUrl;?>/scripts/check-exists.php',
		'onUploadComplete' : function(file){

			dataFile = randWord+'_'+file.name+'/'+file.type+'/'+file.size;
			val_aux	 = $('#Registros_update_archivosColecciones').val();

			if(val_aux.trim() == ''){
				$('#Registros_update_archivosColecciones').val(dataFile);
			}else{
				val_aux	+= ','+dataFile;
				$('#Registros_update_archivosColecciones').val(val_aux);
			}

			html = '<div id="flcolup_'+contUp2+'" class="uploadify-queue-item" style="margin-left:220px">';
			html += '<div class="cancel">';
			html += '<a onclick = "deleteFileUpAjax(\'flcolup_'+contUp2+'\',\''+randWord+'_'+file.name+'\')">X</a></div>';
			html += '<span class="fileName">'+file.name+'</span><span class="data"></span>';
			html += '</div>';
			$("#archColFile").append(html);
			contUp2++;
		}
    });

});

function actSelectSubgrupo(dato,id){
	$.post(urlAjaxActSelectSub,{idGrupo: $(dato).val()},function(data){
		var options = '';
		for(var i = 0; i < data.length; i++){
			options += '<option value="' + data[i].id + '">' + data[i].nombre + '</option>';
		}
		$("#"+id).html(options);
	},"json");
}

function actSelectCiudad(dato,id){
	$.post(urlAjaxCiudad,{idDpto: $(dato).val()},function(data){
		var options = '';
		for(var i = 0; i < data.length; i++){
			options += '<option value="' + data[i].id + '">' + data[i].nombre + '</option>';
		}
		$("#"+id).html(options);
	},"json");
}

</script>
<style>
<!--
.area-contenido{
	min-width: 920px
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
    	<li><a href="#tab2" data-toggle="tab">Información básica</a></li>
    	<li><a href="#tab3" data-toggle="tab">Contacto</a></li>
    	<li><a href="#tab4" data-toggle="tab">Elaborado por</a></li>
    	<?php if($this->route == 'registros/validar'){?>
    	<li><a href="#tab5" data-toggle="tab">Aprobar</a></li>
    	<?php }?>
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
					if($this->route == 'registros/validar'){
						echo $form->datepickerRow($model, 'fecha_dil',array('options' => array('format' => 'yyyy-mm-dd')));
						echo '<i class="icon-info-sign" rel="tooltip" title = "Fecha en que se creó la colección."></i>';
					}
					echo $form->hiddenField($model->registros_update, 'estado');
					if(isset($act)){
						echo $form->textFieldRow($model, 'numero_registro', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA', 'disabled'=>true));
						echo $form->dropDownListRow($model, 'tipo_coleccion_id', Tipo_Coleccion::model()->listarTipoColeccion(),array('prompt' => 'Seleccionar...','disabled' => true));
					}else{
						echo $form->textFieldRow($model, 'numero_registro', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA', 'onchange' => 'validarNumeroColeccion(this,this.value);'));
						echo '<i class="icon-info-sign" rel="tooltip" title = "Ingrese el número 0, el administrador asignará el número de registro correspondiente."></i>';
						echo $form->dropDownListRow($model, 'tipo_coleccion_id', Tipo_Coleccion::model()->listarTipoColeccion(),array('prompt' => 'Seleccionar...'));
					}
					
				?>
			</fieldset>
			<fieldset style="width: 800px">
				<legend class="form_legend">TITULAR DE LA COLECCIÓN</legend>
				<?php 
					echo $form->textFieldRow($model->entidad, 'titular', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->dropDownListRow($model->entidad, 'tipo_titular', $model->entidad->listarTipo(),array('prompt' => 'Seleccionar...','onchange' => 'activarTipo()','disabled'=>true));
					echo $form->textFieldRow($model->entidad, 'nit', array('size'=>32,'maxlength'=>64, 'class'=>'textareaA','disabled'=>true));
					if($model->entidad->tipo_titular == 2){
						echo $form->textFieldRow($model->entidad, 'representante_legal', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
						echo $form->dropDownListRow($model->entidad, 'tipo_id_rep', $model->entidad->listarTipoIdRep(),array('prompt' => 'Seleccionar...'));
						echo $form->textFieldRow($model->entidad, 'representante_id', array('size'=>32,'maxlength'=>64, 'class'=>'textareaA'));
					}
					echo $form->textFieldRow($model->entidad, 'direccion', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo '<div>';
					echo $form->dropDownListRow($model->entidad, 'departamento_id', $model->entidad->ListarDepartamentos(),array('prompt' => 'Seleccione...','onChange' => 'actSelectCiudad(this,"Entidad_ciudad_id")'));
					echo $form->dropDownListRow($model->entidad, 'ciudad_id', $model->entidad->ListarCiudades($model->entidad->departamento_id,$model->entidad->ciudad_id),array('prompt' => 'Seleccionar...'));
					echo '</div>';
					echo $form->textFieldRow($model->entidad, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo $form->textFieldRow($model->entidad, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA'));
				?>
			</fieldset>
		</div>
		
		<div class="tab-pane fade" id="tab2">
			<fieldset style="padding-top: 40px;width: 800px">
				<legend class="form_legend">INFORMACIÓN BÁSICA DE LA COLECCIÓN</legend>
				<?php 
					echo $form->textFieldRow($model->registros_update, 'nombre', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Nombre con el que se conoce la colección y que permite su identificación en el RNC."></i>';
					echo $form->textFieldRow($model->registros_update, 'acronimo', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA', 'onchange' => 'validarAcronimo(this,this.value);'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Sigla que identifica la colección ante el mundo, por lo tanto debe ser única. En caso de no contar con un acrónimo reconocido, el Instituto Humboldt sugerirá alternativas representativas."></i>';
					if($this->route == 'registros/validar'){
						echo $form->datepickerRow($model->registros_update, 'fecha_act',array('options' => array('format' => 'yyyy-mm-dd')));
						echo '<i class="icon-info-sign" rel="tooltip" title = "Fecha en que se realizó el registro."></i>';
					}
					echo $form->dropDownListRow($model->registros_update, 'fecha_fund', $model->registros_update->listYearFund(),array('prompt' => 'Seleccionar...'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Año de fundación de la colección, soportada en actos administrativos del titular de la colección."></i>';
					echo $form->textAreaRow($model->registros_update, 'descripcion', array('class'=>'span4', 'rows'=>4));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Texto que describe la colección y que incluye características sobresalientes de la misma, está orientado al público en general. Se sugiere incluir la misión y visión de la colección."></i>';
					echo $form->textFieldRow($model->registros_update, 'direccion', array('size'=>32,'maxlength'=>2000, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Dirección donde se localiza físicamente la colección."></i>';
					echo '<div>';
					echo $form->dropDownListRow($model->registros_update, 'departamento_id', $model->entidad->ListarDepartamentos(),array('prompt' => 'Seleccione...','onChange' => 'actSelectCiudad(this,"Registros_update_ciudad_id")'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Departamento donde se encuentra la colección."></i>';
					echo $form->dropDownListRow($model->registros_update, 'ciudad_id', $model->entidad->ListarCiudades($model->registros_update->departamento_id,$model->registros_update->ciudad_id),array('prompt' => 'Seleccionar...'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Municipio donde se encuentra la colección."></i>';
					echo '</div>';
					echo $form->textFieldRow($model->registros_update, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Números de teléfono o fax de la colección."></i>';
					echo $form->textFieldRow($model->registros_update, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Dirección electrónica (e-mail) de la colección."></i>';
				?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">Cobertura</legend>
				
				<?php 
					echo $form->textFieldRow($model->registros_update, 'cobertura_tax', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Descripción de los grandes grupos de organismos de la colección, así como grupos taxonómicos específicos representados en la colección."></i>';
					echo $form->textFieldRow($model->registros_update, 'cobertura_geog', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Áreas, regiones y localidades que están representadas en los ejemplares de la colección."></i>';
					echo $form->textFieldRow($model->registros_update, 'cobertura_temp', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Período de tiempo que abarca la colección."></i>';
				?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">Tipos de preservación</legend>
				<div class="InlineFormDiv" id="tamCole">
					
					<?php 
						if(!isset($model->registros_update->id) || !is_array($model->registros_update->tamano_coleccion)){
							echo "<div>";
							echo $form->dropDownList($model->registros_update->tamano_coleccion, 'tipo_preservacion_id', Tipo_Preservacion::model()->listarTipoPreservacion(),array('onchange' => 'otroSelect(this)','prompt' => 'Tipo de Preservación...','name'=>'Tamano_Coleccion[0][tipo_preservacion_id]','class'=>'textareaA textInline','style' => 'width:180px !important;'));
							echo $form->textField($model->registros_update->tamano_coleccion, 'otro', array('name'=>'Tamano_Coleccion[0][otro]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => 'Otro? Cual...','style' => 'display: none;'));
							echo $form->textArea($model->registros_update->tamano_coleccion, 'unidad_medida', array('style'=>'line-height: 10px','class'=>'span4', 'rows'=>4,'name'=>'Tamano_Coleccion[0][unidad_medida]', 'placeholder' => $model->registros_update->tamano_coleccion->getAttributeLabel('unidad_medida')));
							
							$this->widget('bootstrap.widgets.TbButton', array(
									'label'=>'+',
									'type'=>'success', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
									'size'=>'small', // null, 'large', 'small' or 'mini'
									'htmlOptions'=>array('class'=>'addType','onclick' => 'agregarTipoPres()')
							));
							echo '<i style="float:none;" class="icon-info-sign" rel="tooltip" title = "Seleccione cada tipo de preservación y describa cuáles grupos de ejemplares son preservados mediante esta técnica."></i>';
							echo "</div>";
							
						}else {
							$dataTamano = $model->registros_update->tamano_coleccion;
							$cont = 0;
							foreach ($dataTamano as $value){
								echo '<div id="tp_'.$cont.'" style="margin-top:10px">';
								echo $form->dropDownList($value, 'tipo_preservacion_id', Tipo_Preservacion::model()->listarTipoPreservacion(),array('onchange' => 'otroSelect(this)','prompt' => 'Tipo de Preservación...','name'=>'Tamano_Coleccion['.$cont.'][tipo_preservacion_id]','class'=>'textareaA textInline'));
								if($value->tipo_preservacion_id == 22 ){
									echo $form->textField($value, 'otro', array('value' => $value->otro, 'name'=>'Tamano_Coleccion['.$cont.'][otro]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => 'Otro? Cual...'));
								}else{
									echo $form->textField($value, 'otro', array('value' => '', 'name'=>'Tamano_Coleccion['.$cont.'][otro]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => 'Otro? Cual...','style' => 'display: none;'));
								}
								echo $form->textArea($value, 'unidad_medida', array('style'=>'line-height: 10px','value' => $value->unidad_medida,'class'=>'span4', 'rows'=>4,'name'=>'Tamano_Coleccion['.$cont.'][unidad_medida]', 'placeholder' => $tamano_coleccion->getAttributeLabel('unidad_medida')));
								echo $form->hiddenField($value, 'id',array('value' => $value->id,'name'=>'Tamano_Coleccion['.$cont.'][id]'));	
								
								$this->widget('bootstrap.widgets.TbButton', array(
										'label'=>($cont == 0) ? "+" : "-",
										'type'=>($cont == 0) ? 'success' : 'danger', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
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
				
				<div style="padding-top: 10px;float: left;">
					<label class="control-label required inlineLabel2" ><b>1.</b> <?=$composicion_general->getAttributeLabel('numero_catalogados');?></label>
					<label class="control-label required inlineLabel2" ><b>2.</b> <?=$composicion_general->getAttributeLabel('numero_sistematizados');?></label>
					<label class="control-label required inlineLabel2" ><b>3.</b> <?=$composicion_general->getAttributeLabel('numero_nivel_orden');?></label>
					<label class="control-label required inlineLabel2" ><b>4.</b> <?=$composicion_general->getAttributeLabel('numero_nivel_familia');?></label>
					<label class="control-label required inlineLabel2" ><b>5.</b> <?=$composicion_general->getAttributeLabel('numero_nivel_genero');?></label>
					<label class="control-label required inlineLabel2" ><b>6.</b> <?=$composicion_general->getAttributeLabel('numero_nivel_especie');?></label>
				</div>
				
				<?php echo '<i style="float:right;" class="icon-info-sign" rel="tooltip" title = "Incluya tantas filas como sean necesarias para relacionar cada uno de los grupos biológicos representados en la colección."></i>';?>
				<div style="padding-left: 340px">
					<label class="control-label required inlineLabel" style="width:80px !important"><?=$composicion_general->getAttributeLabel('numero_ejemplares');?></label>
					<label class="control-label required inlineLabel" style="width:63px !important">1.</label>
					<label class="control-label required inlineLabel" style="width:63px !important">2.</label>
					<label class="control-label required inlineLabel" style="width:63px !important">3.</label>
					<label class="control-label required inlineLabel" style="width:63px !important">4.</label>
					<label class="control-label required inlineLabel" style="width:63px !important">5.</label>
					<label class="control-label required inlineLabel" style="width:63px !important">6.</label>
				</div>
				<div style="clear: both;margin-bottom: 10px" id="nivelCat">
					<?php if(!isset($model->registros_update->id) || !is_array($model->registros_update->composicion_general)){?>
					<div>
						<?php 
							echo $form->dropDownList($model->registros_update->composicion_general, 'grupo_taxonomico_id', Grupo_Taxonomico::model()->listarGrupoTaxonomico(),array('onchange' => 'actSelectSubgrupo(this,"Composicion_General_0_subgrupo_taxonomico_id")','prompt' => 'Grupo biológico...','name'=>'Composicion_General[0][grupo_taxonomico_id]','class'=>'textareaA textInline','style' => 'width:150px !important;margin-top:0'));
							echo $form->dropDownList($model->registros_update->composicion_general, 'subgrupo_taxonomico_id', Subgrupo_Taxonomico::model()->listarSubgrupoTaxonomico(),array('onchange' => 'subgrupoOtroSelect(this,"Composicion_General_0_subgrupo_otro")','prompt' => 'Subgrupo biológico...','name'=>'Composicion_General[0][subgrupo_taxonomico_id]','class'=>'textareaA textInline','style' => 'width:150px !important;margin-top:0'));
							//echo $form->textField($model->registros_update->composicion_general, 'grupo_taxonomico', array('style' => 'width:150px !important; margin-right: 5px','name'=>'Composicion_General[0][grupo_taxonomico]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => $model->registros_update->composicion_general->attributeLabels()['grupo_taxonomico']));
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
						
						
						<?=$form->textField($model->registros_update->composicion_general, 'subgrupo_otro', array('style' => 'width:140px !important;margin-top: 5px;margin-left:180px;display: none;','name'=>'Composicion_General[0][subgrupo_otro]','size'=>32,'maxlength'=>150, 'class'=>'textareaA', 'placeholder' => "Otro? Cual..."));?>
					</div>
					<?php }else{
							
							$dataTipo	= $model->registros_update->composicion_general;
							$cont = 0;
							foreach ($dataTipo as $value){
								
					?>
					<div>
						<?php 
							echo $form->hiddenField($value, 'id',array('value' => $value->id,'name'=>'Composicion_General['.$cont.'][id]'));
							echo $form->dropDownList($value, 'grupo_taxonomico_id', Grupo_Taxonomico::model()->listarGrupoTaxonomico(),array('onchange' => 'actSelectSubgrupo(this,"Composicion_General_'.$cont.'_subgrupo_taxonomico_id")','prompt' => 'Grupo biológico...','name'=>'Composicion_General['.$cont.'][grupo_taxonomico_id]','class'=>'textareaA textInline','style' => 'width:150px !important;margin-top:0'));
							echo $form->dropDownList($value, 'subgrupo_taxonomico_id', Subgrupo_Taxonomico::model()->listarSubgrupoTaxonomico($value->grupo_taxonomico_id),array('onchange' => 'subgrupoOtroSelect(this,"Composicion_General_'.$cont.'_subgrupo_otro")','prompt' => 'Subgrupo biológico...','name'=>'Composicion_General['.$cont.'][subgrupo_taxonomico_id]','class'=>'textareaA textInline','style' => 'width:150px !important;margin-top:0'));
							//echo $form->textField($value, 'grupo_taxonomico', array('value' => $value->grupo_taxonomico,'style' => 'width:150px !important; margin-right: 5px','name'=>'Composicion_General['.$cont.'][grupo_taxonomico]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => $composicion_general->attributeLabels()['grupo_taxonomico']));
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
							if($value->subgrupo_taxonomico_id == 2){
								echo $form->textField($value, 'subgrupo_otro', array('value' => $value->subgrupo_otro,'style' => 'width:140px !important;margin-top: 5px;margin-left:180px','name'=>'Composicion_General['.$cont.'][subgrupo_otro]','size'=>32,'maxlength'=>150, 'class'=>'textareaA', 'placeholder' => "Otro? Cual..."));
							}else {
								echo $form->textField($value, 'subgrupo_otro', array('style' => 'width:140px !important;margin-top: 5px;margin-left:180px;display: none;','name'=>'Composicion_General['.$cont.'][subgrupo_otro]','size'=>32,'maxlength'=>150, 'class'=>'textareaA', 'placeholder' => "Otro? Cual..."));
							}
						?>
						</div>
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
				
				<?php 
					echo $form->textFieldRow($model->registros_update, 'deorreferenciados', array('append' => '%'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Proporción de especímenes que tienen disponibles coordenadas y se encuentran sistematizadas."></i>';
					echo $form->textAreaRow($model->registros_update, 'sistematizacion', array('class'=>'span4', 'rows'=>4)); 
					echo '<i class="icon-info-sign" rel="tooltip" title = "Descripción del estado de la sistematización de la colección, en términos de herramientas (programas, estándares, etc) e infraestructura utilizada, incluye información relacionada con los avances en la publicación de los datos sistematizados a través de plataformas tecnológicas en línea (página web)."></i>';
				?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">Tipos en la colección</legend>
				<div class="InlineFormDiv" id="tipoCole">
				<?php
					echo $form->radioButtonListInlineRow($model->registros_update, 'ejemplar_tipo', array('Si','No'));
					echo '<i style="float:none;" class="icon-info-sign" rel="tooltip" title = "los ejemplares tipo son aquellos en cuales se basa la descripción de una especie; su presencia y número en las colecciones biológicas son una medida del aporte al conocimiento científico de la biodiversidad de una región ya que representan especies nuevas cuyo primer reporte se refiere a la zona de estudio."></i>';
					echo $form->textFieldRow($model->registros_update, 'ej_tipo_cantidad');
				?>
				<div style="padding-top: 10px;float: left;clear: both;margin-left: 220px;">
				<?php echo '<i style="float:right;" class="icon-info-sign" rel="tooltip" title = "Indique si existen holotipos en la colección y relacione por cada uno grupo biológico y cantidad."></i>';?>
					<label class="control-label required inlineLabel2" style="width: 160px !important;text-align: center !important; font-weight: bold;"><?=$tipos_en_coleccion->getAttributeLabel('grupo');?></label>
					<label class="control-label required inlineLabel2" style="width: 160px !important;text-align: center !important;margin-left: 20px; font-weight: bold;"><?=$tipos_en_coleccion->getAttributeLabel('cantidad');?></label>
				</div>
				<?php
					
					echo '<div style="float:left;clear:both;margin-left:210px">';
					if(!isset($model->registros_update->id) || !is_array($model->registros_update->tipos_en_coleccion)){
						echo "<div>";
						echo $form->textField($model->registros_update->tipos_en_coleccion, 'grupo', array('name'=>'Tipos_En_Coleccion[0][grupo]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $tipos_en_coleccion->getAttributeLabel('grupo')));
						echo $form->textField($model->registros_update->tipos_en_coleccion, 'cantidad', array('name'=>'Tipos_En_Coleccion[0][cantidad]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $tipos_en_coleccion->getAttributeLabel('cantidad')));
						
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
							echo $form->textField($value, 'grupo', array('value' => $value->grupo,'name'=>'Tipos_En_Coleccion['.$cont.'][grupo]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $tipos_en_coleccion->getAttributeLabel('grupo')));
							echo $form->textField($value, 'cantidad', array('value' => $value->cantidad,'name'=>'Tipos_En_Coleccion['.$cont.'][cantidad]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $tipos_en_coleccion->getAttributeLabel('cantidad')));
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
					
					echo '</div>';
				?>
				</div>
				
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">DOCUMENTOS ADJUNTOS</legend>
				<?php 
					echo $form->textAreaRow($model->registros_update, 'listado_anexos', array('class'=>'span4', 'rows'=>4));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Anexe en formato pdf o jpj los documentos definidos en el instructivo de registro o actualización. Relacione cada uno de los archivos adjuntos en la sección Listado de anexos. Estos documentos son parte integral del registro o actualización."></i>';
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
                <label class="control-label inlineLabel2" style="clear: left;margin-left: 220px">Formatos válidos: PDF (*.pdf) y Zip (*.zip). Tamaño máximo 20MB.</label>
				
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">INFORMACIÓN COMPLEMENTARIA</legend>
				<?php 
					echo $form->textAreaRow($model->registros_update, 'info_adicional', array('class'=>'span4', 'rows'=>4));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Información complementaria sobre el contenido, contexto y estado de la colección biológica."></i>';
					echo $form->textFieldRow($model->registros_update, 'pagina_web', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','prepend'=>'http://'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "URL o vínculo de la colección virtual o del sitio en Internet donde se encuentra la información sobre la colección."></i>';
					echo $form->fileFieldRow($model->registros_update, 'archivoColeccion');
					echo '<i class="icon-info-sign" rel="tooltip" title = "Permite adjuntar fotos, videos, folletos y demás material divulgativo de la colección, que puede ser utilizado para las estrategias de visibilidad de las colecciones biológicas."></i>';
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
				<label class="control-label inlineLabel2" style="clear: left;margin-left: 220px">Formatos válidos: PDF (*.pdf), Imágenes (*.jpg,*jpeg,*.gif), Audio (*.mp3) y Video (*.avi,*.mp4). Tamaño máximo 40MB.</label>
                <?php 
					echo $form->hiddenField($model->registros_update, 'archivosColecciones');
				?>

			</fieldset>
		</div>
	
		<div class="tab-pane fade" id="tab3">
			<fieldset style="padding-top: 80px;width: 800px">
				<legend class="form_legend">DATOS DE CONTACTO</legend>
				<?php 
					echo $form->textFieldRow($model->registros_update->contactos, 'nombre', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Persona o personas de contacto que están asociadas a la colección. Sirven como punto de enlace con usuarios, especialistas e interesados en la colección biológica."></i>';
					echo $form->textFieldRow($model->registros_update->contactos, 'cargo', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Nombre del cargo, título o rol que desempeña la persona o personas de contacto."></i>';
					echo $form->textFieldRow($model->registros_update->contactos, 'dependencia', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo $form->textFieldRow($model->registros_update->contactos, 'direccion', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Dirección para el envío de correspondencia."></i>';
					echo '<div>';
					echo $form->dropDownListRow($model->registros_update->contactos, 'departamento_id', $model->entidad->ListarDepartamentos(),array('prompt' => 'Seleccione...','onChange' => 'actSelectCiudad(this,"Contactos_ciudad_id")'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Departamento donde se encuentra el titular de la colección."></i>';
					echo $form->dropDownListRow($model->registros_update->contactos, 'ciudad_id', $model->entidad->ListarCiudades($model->registros_update->contactos->departamento_id,$model->registros_update->contactos->ciudad_id),array('prompt' => 'Seleccionar...'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Municipio donde se encuentra el titular de la colección."></i>';
					echo '</div>';
					echo $form->textFieldRow($model->registros_update->contactos, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Números de teléfono o fax de contacto."></i>';
					echo $form->textFieldRow($model->registros_update->contactos, 'email', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Dirección electrónica (e-mail) de contacto."></i>';
				?>
			</fieldset>
		</div>
		
		<div class="tab-pane fade" id="tab4">
			<fieldset style="padding-top: 60px">
				<legend class="form_legend">ELABORACIÓN DEL REGISTRO</legend>
				<?php 
					echo $form->textFieldRow($model->registros_update->dilegenciadores, 'nombre', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Persona que elaboró el registro, ya sea que se trate de un nuevo registro o de la actualización de los datos de la colección en el Registro Nacional de Colecciones Biológicas."></i>';
					echo $form->textFieldRow($model->registros_update->dilegenciadores, 'dependencia', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Nombre del cargo, título o rol que desempeña la persona responsable de la elaboración del registro."></i>';
					echo $form->textFieldRow($model->registros_update->dilegenciadores, 'cargo', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo $form->textFieldRow($model->registros_update->dilegenciadores, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Números de teléfono o fax de contacto."></i>';
					echo $form->textFieldRow($model->registros_update->dilegenciadores, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA'));
					echo '<i class="icon-info-sign" rel="tooltip" title = "Dirección electrónica (e-mail) de contacto."></i>';
				?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">TÉRMINOS Y CONDICIONES</legend>
				<p class="noteTerm">El titular de la colección biológica (persona jurídica o su representante legal) manifiesta que la información consignada en este registro es fidedigna y se sujetará a las Leyes, Decretos y Actos Administrativos que reglamentan el uso, manejo y aprovechamiento de la diversidad biológica.</p>
				<?php echo $form->checkBoxRow($model->registros_update, 'terminos');?>
			</fieldset>
		</div>
		
		<?php if($this->route == 'registros/validar'){?>
		<div class="tab-pane fade" id="tab5">
			<fieldset>
				<legend class="form_legend">Aprobar Registro</legend>
				<?php 
					echo $form->radioButtonListInlineRow($model->registros_update, 'aprobado', array('Si','No'));
					echo $form->textAreaRow($model->registros_update, 'comentario', array('class'=>'span4', 'rows'=>5));
				?>
			</fieldset>
		</div><!-- tab5 -->
		<?php }?>
		
	</div>			
	<div id="catalogouser-botones-internos" class="form-actions pull-right">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'success', 'label'=>'Guardar', 'htmlOptions' => array('onclick' => 'enviarForm()'))); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'catalogo-user-form-interno-enviar', 'type'=>'success', 'label'=>$model->isNewRecord ? 'Enviar' : 'Enviar','htmlOptions' => array('onclick'=>'{enviarData()}'))); ?>
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'id'=>'catalogo-user-form-interno-reset', 'label'=>'Limpiar campos')); ?>
		<?php 
			$this->widget('bootstrap.widgets.TbButtonGroup', array(
				'buttons'=>array(
					array('label'=>'Cancel', 'url'=>array('admin/panel')),
				),
			));
		?>    
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->