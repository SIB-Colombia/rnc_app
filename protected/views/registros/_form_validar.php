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

contTipo 		= 0;
contTipoCol 	= 0;
contNivelCat 	= 0;

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
	htmlCode += '<input onchange="sumarTipo(\'cantSum\',\'Registros_Update_tamano_coleccion_total\')" name="Tamano_Coleccion['+contTipo+'][cantidad]" size="32" maxlength="150" class="textareaA textInline cantSum" placeholder="<?=$tamano_coleccion->attributeLabels()['cantidad'];?>" id="Tamano_Coleccion_cantidad_'+contTipo+'" type="text">';
	htmlCode += '<a class="addType btn btn-danger btn-small" onclick="eliminarTipoPres(\'tp_'+contTipo+'\',\'cantSum\',\'Registros_Update_tamano_coleccion_total\')" id="yw'+contTipo+'">-</a>';
	htmlCode += '</div>';

	
	$("#tamCole").append(htmlCode);
}

function agregarTipoCol(){
	contTipoCol++;
	htmlCode  = '<div id="tc_'+contTipoCol+'">';
	htmlCode += '<input style="width:220px !important" name="Tipos_En_Coleccion['+contTipoCol+'][informacion_ejemplar]" size="32" maxlength="150" class="textareaA textInline" placeholder="<?=$tipos_en_coleccion->attributeLabels()['informacion_ejemplar'];?>" id="Tipos_En_Coleccion_informacion_ejemplar_'+contTipoCol+'" type="text">';
	htmlCode += '<input onchange="sumarTipo(\'cantSumTipo\',\'Registros_Update_tipo_coleccion_total\')" name="Tipos_En_Coleccion['+contTipoCol+'][cantidad]" size="32" maxlength="150" class="textareaA textInline cantSumTipo" placeholder="<?=$tipos_en_coleccion->attributeLabels()['cantidad'];?>" id="Tipos_En_Coleccion_cantidad_'+contTipoCol+'" type="text">';
	htmlCode += '<a class="addType btn btn-danger btn-small" onclick="eliminarTipoPres(\'tc_'+contTipoCol+'\',\'cantSumTipo\',\'Registros_Update_tipo_coleccion_total\')" id="yw'+contTipoCol+'">-</a>';
	htmlCode += '</div>';

	
	$("#tipoCole").append(htmlCode);
}

function agregarNivelCat(){
	contNivelCat++;
	htmlCode	 = '<div style="margin-top: 10px;" id="nc_'+contNivelCat+'">';
	htmlCode	+= '<input style="width:150px !important; margin-right: 5px" name="Composicion_General['+contNivelCat+'][grupo_taxonomico]" size="32" maxlength="150" class="textareaA " placeholder="<?=$composicion_general->attributeLabels()['grupo_taxonomico'];?>" id="Composicion_General_grupo_taxonomico_'+contNivelCat+'" type="text">';
	htmlCode	+= '<input style="width:80px !important" name="Composicion_General['+contNivelCat+'][numero_ejemplares]" size="32" maxlength="150" class="textareaA " placeholder="0" id="Composicion_General_numero_ejemplares_'+contNivelCat+'" type="text" value="0">';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General['+contNivelCat+'][numero_catalogados]" size="32" maxlength="150" class="textareaA " placeholder="0" id="Composicion_General_numero_catalogados_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General['+contNivelCat+'][numero_sistematizados]" size="32" maxlength="150" class="textareaA " placeholder="0" id="Composicion_General_numero_sistematizados_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General['+contNivelCat+'][numero_nivel_familia]" size="32" maxlength="150" class="textareaA " placeholder="0" id="Composicion_General_numero_nivel_familia_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General['+contNivelCat+'][numero_nivel_genero]" size="32" maxlength="150" class="textareaA " placeholder="0" id="Composicion_General_numero_nivel_genero_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General['+contNivelCat+'][numero_nivel_especie]" size="32" maxlength="150" class="textareaA compGeneral" placeholder="0" id="Composicion_General_numero_nivel_especie_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
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
			if(eval($(this).val()) != null)
			{
				valor = eval($(this).val());
			}
			total = total + valor;
		}
	);

	$("#"+id).val(total);
}

function enviarData(){
	$("#Registros_estado").val("1");
}

$(function() {
    $('#Registros_Update_archivoAnexo').uploadify({
    	'auto'     		: false,
    	'buttonText'	: 'Seleccionar Archivo',
    	'width'         : 140,
    	'fileTypeExts'  : '*.pdf;*.zip',
    	'multi'			: true,
    	'swf'      		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.swf',
        'uploader' 		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.php',
        'checkExisting' : '<?=Yii::app()->theme->baseUrl;?>/scripts/check-exists.php',
		'onUploadComplete' : function(file){
			
			dataFile = file.name+'/'+file.type+'/'+file.size;
			val_aux	 = $('#Registros_Update_archivosAnexos').val();

			if(val_aux.trim() == ''){
				$('#Registros_Update_archivosAnexos').val(dataFile);
			}else{
				val_aux	+= ','+dataFile;
				$('#Registros_Update_archivosAnexos').val(val_aux);
			}
			
		}
    });

    $('#Registros_Update_archivoColeccion').uploadify({
    	'auto'     		: false,
    	'buttonText'	: 'Seleccionar Archivo',
    	'width'         : 140,
    	'fileTypeExts'  : '*.jpg;*.gif;*.jpeg;*.avi;*.mp4;*.mp3',
    	'multi'			: true,
    	'swf'      		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.swf',
        'uploader' 		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.php',
        'checkExisting' : '<?=Yii::app()->theme->baseUrl;?>/scripts/check-exists.php',
		'onUploadComplete' : function(file){

			dataFile = file.name+'/'+file.type+'/'+file.size;
			val_aux	 = $('#Registros_Update_archivosColecciones').val();

			if(val_aux.trim() == ''){
				$('#Registros_Update_archivosColecciones').val(dataFile);
			}else{
				val_aux	+= ','+dataFile;
				$('#Registros_Update_archivosColecciones').val(val_aux);
			}
		}
    });

    $('#Registros_Update_archivoDivulgativo').uploadify({
    	'auto'     		: false,
    	'buttonText'	: 'Seleccionar Archivo',
    	'width'         : 140,
    	'fileTypeExts'  : '*.pdf;*.jpg;*.gif;*.jpeg',
    	'multi'			: true,
    	'swf'      		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.swf',
        'uploader' 		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.php',
        'checkExisting' : '<?=Yii::app()->theme->baseUrl;?>/scripts/check-exists.php',
		'onUploadComplete' : function(file){

			dataFile = file.name+'/'+file.type+'/'+file.size;
			val_aux	 = $('#Registros_Update_archivosDivulgativos').val();

			if(val_aux.trim() == ''){
				$('#Registros_Update_archivosDivulgativos').val(dataFile);
			}else{
				val_aux	+= ','+dataFile;
				$('#Registros_Update_archivosDivulgativos').val(val_aux);
			}
		}
    });
});


</script>

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
    	<li><a href="#tab5" data-toggle="tab">Aprobar</a></li>
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
					echo $form->hiddenField($model, 'estado');
					echo $form->textFieldRow($model, 'numero_registro', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
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
		</div><!-- tab1 -->
		
		<div class="tab-pane fade" id="tab2">
			<fieldset>
				<legend class="form_legend">INFORMACIÓN BÁSICA DE LA COLECCIÓN</legend>
				<?php 
					echo $form->textFieldRow($model->registros_update, 'nombre', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->textFieldRow($model->registros_update, 'acronimo', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA','disabled'=>true));
					echo $form->dropDownListRow($model->registros_update, 'fecha_fund', $model->registros_update->listYearFund(),array('prompt' => 'Seleccionar...','disabled'=>true));
					echo $form->textAreaRow($model->registros_update, 'descripcion', array('class'=>'span4', 'rows'=>4,'disabled'=>true));
					echo $form->textFieldRow($model->registros_update, 'direccion', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->dropDownListRow($model->registros_update, 'ciudad_id', $model->registros_update->ListarCiudades(),array('prompt' => 'Seleccionar...','disabled'=>true));
					echo $form->textFieldRow($model->registros_update, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->textFieldRow($model->registros_update, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA','disabled'=>true));
				?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">Cobertura</legend>
				
				<?php 
					echo $form->textFieldRow($model->registros_update, 'cobertura_tax', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->textFieldRow($model->registros_update, 'cobertura_geog', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->textFieldRow($model->registros_update, 'cobertura_temp', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
				?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">Tipos de preservación</legend>
				<div class="InlineFormDiv" id="tamCole">
					
					<?php 
						if(!isset($model->registros_update->id)){
							echo "<div>";
							echo $form->textField($model->registros_update->tamano_coleccion, 'tipo_preservacion', array('name'=>'Tamano_Coleccion[0][tipo_preservacion]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $model->registros_update->tamano_coleccion->attributeLabels()['tipo_preservacion'],'disabled'=>true));
							echo $form->textField($model->registros_update->tamano_coleccion, 'unidad_medida', array('name'=>'Tamano_Coleccion[0][unidad_medida]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $model->registros_update->tamano_coleccion->attributeLabels()['unidad_medida'],'disabled'=>true));
							//echo $form->textField($model->registros_update->tamano_coleccion, 'cantidad', array('onchange' => 'sumarTipo("cantSum","Registros_Update_tamano_coleccion_total")','name'=>'Tamano_Coleccion[0][cantidad]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline cantSum', 'placeholder' => $model->registros_update->tamano_coleccion->attributeLabels()['cantidad'],'disabled'=>true));
							
							echo "</div>";
						}else {
							$dataTamano = $model->registros_update->tamano_coleccion;
							$cont = 0;
							foreach ($dataTamano as $value){
								echo '<div id="tp_'.$cont.'">';
								echo $form->textField($value, 'tipo_preservacion', array('value' => $value->tipo_preservacion, 'name'=>'Tamano_Coleccion['.$cont.'][tipo_preservacion]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $tamano_coleccion->attributeLabels()['tipo_preservacion'],'disabled'=>true));
								echo $form->textField($value, 'unidad_medida', array('value' => $value->unidad_medida, 'name'=>'Tamano_Coleccion['.$cont.'][unidad_medida]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $tamano_coleccion->attributeLabels()['unidad_medida'],'disabled'=>true));
								//echo $form->textField($value, 'cantidad', array('value' => $value->cantidad, 'onchange' => 'sumarTipo("cantSum","Registros_Update_tamano_coleccion_total")','name'=>'Tamano_Coleccion['.$cont.'][cantidad]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline cantSum', 'placeholder' => $tamano_coleccion->attributeLabels()['cantidad'],'disabled'=>true));
								echo $form->hiddenField($value, 'id',array('value' => $value->id,'name'=>'Tamano_Coleccion['.$cont.'][id]'));	
								
								
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
					//echo $form->textFieldRow($model->registros_update, 'tamano_coleccion_total', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA totalRow','disabled'=>true));
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
				</div>
				<div style="clear: both;" id="nivelCat">
					<div>
					<?php if(!isset($model->registros_update->id)){?>
						<?php 
							echo $form->textField($model->registros_update->composicion_general, 'grupo_taxonomico', array('style' => 'width:150px !important; margin-right: 5px','name'=>'Composicion_General[0][grupo_taxonomico]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => $model->registros_update->composicion_general->attributeLabels()['grupo_taxonomico'],'disabled'=>true));
							echo $form->textField($model->registros_update->composicion_general, 'numero_ejemplares', array('style' => 'width:80px !important','name'=>'Composicion_General[0][numero_ejemplares]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => 0,'disabled'=>true));
						?>
						<div class="input-append">
							<?=$form->textField($model->registros_update->composicion_general, 'numero_catalogados', array('style' => 'width:30px !important','name'=>'Composicion_General[0][numero_catalogados]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => 0,'disabled'=>true));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($model->registros_update->composicion_general, 'numero_sistematizados', array('style' => 'width:30px !important','name'=>'Composicion_General[0][numero_sistematizados]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => 0,'disabled'=>true));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($model->registros_update->composicion_general, 'numero_nivel_orden', array('style' => 'width:30px !important','name'=>'Composicion_General[0][orden]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => 0,'disabled'=>true));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($model->registros_update->composicion_general, 'numero_nivel_familia', array('style' => 'width:30px !important','name'=>'Composicion_General[0][numero_nivel_familia]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => 0,'disabled'=>true));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($model->registros_update->composicion_general, 'numero_nivel_genero', array('style' => 'width:30px !important','name'=>'Composicion_General[0][numero_nivel_genero]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => 0,'disabled'=>true));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($model->registros_update->composicion_general, 'numero_nivel_especie', array('style' => 'width:30px !important','name'=>'Composicion_General[0][numero_nivel_especie]','size'=>32,'maxlength'=>150, 'class'=>'textareaA compGeneral', 'placeholder' => 0,'disabled'=>true));?>
							<span class="add-on">%</span>
						</div>
						
						
					<?php }else{
							$dataTipo	= $model->registros_update->composicion_general;
							$cont = 0;
							foreach ($dataTipo as $value){
								
					?>
						<?php 
							echo $form->hiddenField($value, 'id',array('value' => $value->id,'name'=>'Composicion_General['.$cont.'][id]','disabled'=>true));
							echo $form->textField($value, 'grupo_taxonomico', array('value' => $value->grupo_taxonomico,'style' => 'width:150px !important; margin-right: 5px','name'=>'Composicion_General['.$cont.'][grupo_taxonomico]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => $composicion_general->attributeLabels()['grupo_taxonomico'],'disabled'=>true));
							echo $form->textField($value, 'numero_ejemplares', array('value' => $value->numero_ejemplares,'style' => 'width:80px !important','name'=>'Composicion_General['.$cont.'][numero_ejemplares]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => 0,'disabled'=>true));
						?>
						<div class="input-append">
							<?=$form->textField($value, 'numero_catalogados', array('value' => $value->numero_catalogados,'style' => 'width:30px !important','name'=>'Composicion_General['.$cont.'][numero_catalogados]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => 0,'disabled'=>true));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($value, 'numero_sistematizados', array('value' => $value->numero_sistematizados,'style' => 'width:30px !important','name'=>'Composicion_General['.$cont.'][numero_sistematizados]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => 0,'disabled'=>true));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($value, 'numero_nivel_orden', array('value' => $value->numero_nivel_orden,'style' => 'width:30px !important','name'=>'Composicion_General['.$cont.'][numero_nivel_orden]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => 0,'disabled'=>true));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($value, 'numero_nivel_familia', array('value' => $value->numero_nivel_familia,'style' => 'width:30px !important','name'=>'Composicion_General['.$cont.'][numero_nivel_familia]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => 0,'disabled'=>true));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($value, 'numero_nivel_genero', array('value' => $value->numero_nivel_genero,'style' => 'width:30px !important','name'=>'Composicion_General['.$cont.'][numero_nivel_genero]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => 0,'disabled'=>true));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($value, 'numero_nivel_especie', array('value' => $value->numero_nivel_especie,'style' => 'width:30px !important','name'=>'Composicion_General['.$cont.'][numero_nivel_especie]','size'=>32,'maxlength'=>150, 'class'=>'textareaA compGeneral', 'placeholder' => 0,'disabled'=>true));?>
							<span class="add-on">%</span>
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
				</div>
				
				<div style="padding-top: 10px">
					<label class="control-label required inlineLabel2" ><b>1.</b> <?=$composicion_general->attributeLabels()['numero_catalogados'];?></label>
					<label class="control-label required inlineLabel2" ><b>2.</b> <?=$composicion_general->attributeLabels()['numero_sistematizados'];?></label>
					<label class="control-label required inlineLabel2" ><b>3.</b> <?=$composicion_general->attributeLabels()['numero_nivel_orden'];?></label>
					<label class="control-label required inlineLabel2" ><b>4.</b> <?=$composicion_general->attributeLabels()['numero_nivel_familia'];?></label>
					<label class="control-label required inlineLabel2" ><b>5.</b> <?=$composicion_general->attributeLabels()['numero_nivel_genero'];?></label>
					<label class="control-label required inlineLabel2" ><b>6.</b> <?=$composicion_general->attributeLabels()['numero_nivel_especie'];?></label>
				</div>
				<?php echo $form->textAreaRow($model->registros_update, 'sistematizacion', array('class'=>'span4', 'rows'=>4,'disabled'=>true)); ?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">Tipos en la colección</legend>
				<div class="InlineFormDiv" id="tipoCole">
				<?php 
					if(!isset($model->registros_update->id)){
						echo "<div>";
						echo $form->textField($model->registros_update->tipos_en_coleccion, 'grupo', array('name'=>'Tipos_En_Coleccion[0][grupo]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $model->registros_update->tipos_en_coleccion->attributeLabels()['grupo'],'disabled'=>true));
						echo $form->textField($model->registros_update->tipos_en_coleccion, 'informacion_ejemplar', array('name'=>'Tipos_En_Coleccion[0][informacion_ejemplar]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $model->registros_update->tipos_en_coleccion->attributeLabels()['informacion_ejemplar'],'disabled'=>true));
						echo $form->textField($model->registros_update->tipos_en_coleccion, 'nombre_cientifico', array('name'=>'Tipos_En_Coleccion[0][nombre_cientifico]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $model->registros_update->tipos_en_coleccion->attributeLabels()['nombre_cientifico'],'disabled'=>true));
						//echo $form->textField($model->registros_update->tipos_en_coleccion, 'cantidad', array('onchange' => 'sumarTipo("cantSumTipo","Registros_Update_tipo_coleccion_total")','name'=>'Tipos_En_Coleccion[0][cantidad]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline cantSumTipo', 'placeholder' => $model->registros_update->tipos_en_coleccion->attributeLabels()['cantidad'],'disabled'=>true));
					
						echo "</div>";
					}else {
						$dataTipo	= $model->registros_update->tipos_en_coleccion;
						$cont = 0;
						
						foreach ($dataTipo as $value){
							echo '<div id="tc_'.$cont.'">';
							echo $form->textField($value, 'informacion_ejemplar', array('value' => $value->grupo,'name'=>'Tipos_En_Coleccion['.$cont.'][grupo]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $tipos_en_coleccion->attributeLabels()['grupo'],'disabled'=>true));
							echo $form->textField($value, 'informacion_ejemplar', array('value' => $value->informacion_ejemplar, 'style' => 'width:220px !important','name'=>'Tipos_En_Coleccion['.$cont.'][informacion_ejemplar]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $tipos_en_coleccion->attributeLabels()['informacion_ejemplar'],'disabled'=>true));
							echo $form->textField($value, 'informacion_ejemplar', array('value' => $value->nombre_cientifico, 'name'=>'Tipos_En_Coleccion['.$cont.'][nombre_cientifico]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $tipos_en_coleccion->attributeLabels()['nombre_cientifico'],'disabled'=>true));
							//echo $form->textField($value, 'cantidad', array('value' => $value->cantidad, 'onchange' => 'sumarTipo("cantSumTipo","Registros_Update_tipo_coleccion_total")','name'=>'Tipos_En_Coleccion['.$cont.'][cantidad]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline cantSumTipo', 'placeholder' => $tipos_en_coleccion->attributeLabels()['cantidad'],'disabled'=>true));
							echo $form->hiddenField($value, 'id',array('value' => $value->id,'name'=>'Tipos_En_Coleccion['.$cont.'][id]'));
						
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
					//echo $form->textFieldRow($model->registros_update, 'tipo_coleccion_total', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA totalRow2','disabled'=>true));
				?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">DOCUMENTOS ADJUNTOS</legend>
				<?php 
					echo $form->textAreaRow($model->registros_update, 'listado_anexos', array('class'=>'span4', 'rows'=>4,'disabled'=>true));
					//echo $form->fileFieldRow($model->registros_update, 'archivoAnexo',array('disabled'=>true));
					echo $form->hiddenField($model->registros_update, 'archivosAnexos');
				?>
				<?php 
					if(isset($model->registros_update->id)){
						$criteria = new CDbCriteria;
						$criteria->compare('clase',1);
						$criteria->compare('Registros_update_id',$model->registros_update->id);
						$dataTipo	= Archivos::model()->findAll($criteria);
						$cont = 0;
						
						foreach ($dataTipo as $value){
							echo '<div id="fl_'.$cont.'" class="uploadify-queue-item" style="margin-left:220px">';
							echo '<div class="cancel">';
							echo '</div>';
							echo '<span class="fileName">'.$value->nombre.'</span><span class="data"></span>';
							echo '</div>';
				?>
                <?php }}?>
				
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">INFORMACIÓN COMPLEMENTARIA</legend>
				<?php 
					echo $form->textAreaRow($model->registros_update, 'info_adicional', array('class'=>'span4', 'rows'=>4,'disabled'=>true));
					echo $form->textFieldRow($model->registros_update, 'pagina_web', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','prepend'=>'http://','disabled'=>true));
					//echo $form->textAreaRow($model->registros_update, 'redes_social', array('class'=>'span4', 'rows'=>4,'disabled'=>true));
					//echo $form->fileFieldRow($model->registros_update, 'archivoColeccion');
				?>
				<?php 
					if(isset($model->registros_update->id)){
						$criteria = new CDbCriteria;
						$criteria->compare('clase',2);
						$criteria->compare('Registros_update_id',$model->registros_update->id);
						$dataTipo	= Archivos::model()->findAll($criteria);
						$cont = 0;
						
						foreach ($dataTipo as $value){
							echo '<div id="flc_'.$cont.'" class="uploadify-queue-item" style="margin-left:220px">';
							echo '<div class="cancel">';
							echo '</div>';
							echo '<span class="fileName">'.$value->nombre.'</span><span class="data"></span>';
							echo '</div>';
							$cont++;
							}
					}
				?>
                <?php 
					
					//echo $form->fileFieldRow($model->registros_update, 'archivoDivulgativo');
				?>
				<?php 
					if(isset($model->registros_update->id)){
						$criteria = new CDbCriteria;
						$criteria->compare('clase',3);
						$criteria->compare('Registros_update_id',$model->registros_update->id);
						$dataTipo	= Archivos::model()->findAll($criteria);
						$cont = 0;
						
						foreach ($dataTipo as $value){
							echo '<div id="fld_'.$cont.'" class="uploadify-queue-item" style="margin-left:220px">';
							echo '<div class="cancel">';
							echo '</div>';
							echo '<span class="fileName">'.$value->nombre.'</span><span class="data"></span>';
							echo '</div>';
							$cont++;
							}
					}
				?>
				<?php 
					
					echo $form->hiddenField($model->registros_update, 'archivosColecciones');
					echo $form->hiddenField($model->registros_update, 'archivosDivulgativos');
					
				?>
			</fieldset>
			
		</div><!-- tab2 -->
		
		<div class="tab-pane fade" id="tab3">
			<fieldset>
				<legend class="form_legend">DATOS DE CONTACTO</legend>
				<?php 
					echo $form->textFieldRow($model->registros_update->contactos, 'nombre', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->textFieldRow($model->registros_update->contactos, 'cargo', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->textFieldRow($model->registros_update->contactos, 'dependencia', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->textFieldRow($model->registros_update->contactos, 'direccion', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->dropDownListRow($model->registros_update->contactos, 'ciudad_id', $model->registros_update->ListarCiudades(),array('prompt' => 'Seleccionar...','disabled'=>true));
					echo $form->textFieldRow($model->registros_update->contactos, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->textFieldRow($model->registros_update->contactos, 'email', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
				?>
			</fieldset>
		</div><!-- tab3 -->
		
		<div class="tab-pane fade" id="tab4">
			<fieldset>
				<legend class="form_legend">ELABORACIÓN DEL REGISTRO</legend>
				<?php 
					echo $form->textFieldRow($model->registros_update->dilegenciadores, 'nombre', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->textFieldRow($model->registros_update->dilegenciadores, 'dependencia', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->textFieldRow($model->registros_update->dilegenciadores, 'cargo', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->textFieldRow($model->registros_update->dilegenciadores, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->textFieldRow($model->registros_update->dilegenciadores, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA','disabled'=>true));
				?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">TÉRMINOS Y CONDICIONES</legend>
				<p class="noteTerm">El titular de la colección biológica (persona jurídica o su representante legal) manifiesta que la información consignada en este registro es fidedigna y se sujetará a las Leyes, Decretos y Actos Administrativos que reglamentan el uso, manejo y aprovechamiento de la diversidad biológica.</p>
				<?php echo $form->checkBoxRow($model->registros_update, 'terminos',array('disabled'=>true));?>
			</fieldset>
		</div><!-- tab4 -->
		
		<div class="tab-pane fade" id="tab5">
			<fieldset>
				<legend class="form_legend">Aprobar Registro</legend>
				<?php 
					echo $form->radioButtonListInlineRow($model->registros_update, 'aprobado', array('Si','No'));
					echo $form->textAreaRow($model->registros_update, 'comentario', array('class'=>'span4', 'rows'=>5));
				?>
			</fieldset>
		</div><!-- tab5 -->
		
	</div>
	
	<div id="catalogouser-botones-internos" class="form-actions pull-right">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'primary', 'label'=>'Enviar')); ?>
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'id'=>'catalogo-user-form-interno-reset', 'label'=>'Limpiar campos')); ?>
    </div>
  	
<?php $this->endWidget(); ?>
</div><!-- form -->