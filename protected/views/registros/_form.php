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
	htmlCode += '<input name="Tamano_Coleccion[tipo_preservacion]['+contTipo+']" size="32" maxlength="150" class="textareaA textInline" placeholder="<?=$model->registros_update->tamano_coleccion->attributeLabels()['tipo_preservacion'];?>" id="Tamano_Coleccion_tipo_preservacion_'+contTipo+'" type="text">';
	htmlCode += '<input name="Tamano_Coleccion[unidad_medida]['+contTipo+']" size="32" maxlength="150" class="textareaA textInline" placeholder="<?=$model->registros_update->tamano_coleccion->attributeLabels()['unidad_medida'];?>" id="Tamano_Coleccion_unidad_medida_'+contTipo+'" type="text">';
	htmlCode += '<input onchange="sumarTipo(\'cantSum\',\'Registros_Update_tamano_coleccion_total\')" name="Tamano_Coleccion[cantidad]['+contTipo+']" size="32" maxlength="150" class="textareaA textInline cantSum" placeholder="<?=$model->registros_update->tamano_coleccion->attributeLabels()['cantidad'];?>" id="Tamano_Coleccion_cantidad_'+contTipo+'" type="text">';
	htmlCode += '<a class="addType btn btn-danger btn-small" onclick="eliminarTipoPres(\'tp_'+contTipo+'\',\'cantSum\',\'Registros_Update_tamano_coleccion_total\')" id="yw'+contTipo+'">-</a>';
	htmlCode += '</div>';

	
	$("#tamCole").append(htmlCode);
}

function agregarTipoCol(){
	contTipoCol++;
	htmlCode  = '<div id="tc_'+contTipoCol+'">';
	htmlCode += '<input style="width:220px !important" name="Tipos_En_Coleccion[informacion_ejemplar]['+contTipoCol+']" size="32" maxlength="150" class="textareaA textInline" placeholder="<?=$model->registros_update->tipos_en_coleccion->attributeLabels()['informacion_ejemplar'];?>" id="Tipos_En_Coleccion_informacion_ejemplar_'+contTipoCol+'" type="text">';
	htmlCode += '<input onchange="sumarTipo(\'cantSumTipo\',\'Registros_Update_tipo_coleccion_total\')" name="Tipos_En_Coleccion[cantidad]['+contTipoCol+']" size="32" maxlength="150" class="textareaA textInline cantSumTipo" placeholder="<?=$model->registros_update->tipos_en_coleccion->attributeLabels()['cantidad'];?>" id="Tipos_En_Coleccion_cantidad_'+contTipoCol+'" type="text">';
	htmlCode += '<a class="addType btn btn-danger btn-small" onclick="eliminarTipoPres(\'tc_'+contTipoCol+'\',\'cantSumTipo\',\'Registros_Update_tipo_coleccion_total\')" id="yw'+contTipoCol+'">-</a>';
	htmlCode += '</div>';

	
	$("#tipoCole").append(htmlCode);
}

function agregarNivelCat(){
	contNivelCat++;
	htmlCode	 = '<div style="margin-top: 10px;" id="nc_'+contNivelCat+'">';
	htmlCode	+= '<input style="width:150px !important; margin-right: 5px" name="Composicion_General[grupo_taxonomico]['+contNivelCat+']" size="32" maxlength="150" class="textareaA " placeholder="<?=$model->registros_update->composicion_general->attributeLabels()['grupo_taxonomico'];?>" id="Composicion_General_grupo_taxonomico_'+contNivelCat+'" type="text">';
	htmlCode	+= '<input style="width:80px !important" name="Composicion_General[numero_ejemplares]['+contNivelCat+']" size="32" maxlength="150" class="textareaA " placeholder="0" id="Composicion_General_numero_ejemplares_'+contNivelCat+'" type="text" value="0">';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General[numero_catalogados]['+contNivelCat+']" size="32" maxlength="150" class="textareaA " placeholder="0" id="Composicion_General_numero_catalogados_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General[numero_sistematizados]['+contNivelCat+']" size="32" maxlength="150" class="textareaA " placeholder="0" id="Composicion_General_numero_sistematizados_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General[numero_nivel_familia]['+contNivelCat+']" size="32" maxlength="150" class="textareaA " placeholder="0" id="Composicion_General_numero_nivel_familia_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General[numero_nivel_genero]['+contNivelCat+']" size="32" maxlength="150" class="textareaA " placeholder="0" id="Composicion_General_numero_nivel_genero_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode	+= '<div class="input-append" style="margin-left:4px"><input style="width:30px !important" name="Composicion_General[numero_nivel_especie]['+contNivelCat+']" size="32" maxlength="150" class="textareaA " placeholder="0" id="Composicion_General_numero_nivel_especie_'+contNivelCat+'" type="text" value="0"><span class="add-on">%</span></div>';
	htmlCode 	+= '<a style="margin-left:4px" class="btn btn-danger btn-small" onclick="eliminarTipoPres(\'nc_'+contNivelCat+'\',\'\',\'\')" id="yw'+contNivelCat+'">-</a>';
	htmlCode	+= '</div>';

	$("#nivelCat").append(htmlCode);
}

function eliminarTipoPres(idDiv,clase,id){

	$("#"+idDiv).remove();

	if(clase != "" && id != ""){
		sumarTipo(clase,id);
	}
}

function cambiaNombre(clase,name){
	
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

$(function() {
    $('#Registros_archivoAnexo').uploadify({
    	'buttonText'	: 'Seleccionar Archivo',
    	'width'         : 140,
    	'fileTypeExts'  : '*.pdf;*.zip',
    	'multi'			: false,
    	'swf'      		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.swf',
        'uploader' 		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.php',
		'onUploadComplete' : function(file){
			$.post("readFile", {archivo: file.name, tipo: file.type},function(data){
				
				$("#Taxontree_datosExportar").val(data);
				$.post("createData", {dataTaxon: data},function(data){
					$.fn.yiiGridView.update('taxones-grid', {data: {Taxontree: {archivoData : data}}});
				});
				//$.fn.yiiGridView.update('taxones-grid', {data: {Taxontree: {nombresTaxones : data}}});
			});
		}
    });

    $('#Registros_archivoColeccion').uploadify({
    	'buttonText'	: 'Seleccionar Archivo',
    	'width'         : 140,
    	'fileTypeExts'  : '*.jpg;*.gif;*.jpeg;*.avi;*.mp4;*.mp3',
    	'multi'			: false,
    	'swf'      		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.swf',
        'uploader' 		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.php',
		'onUploadComplete' : function(file){
			$.post("readFile", {archivo: file.name, tipo: file.type},function(data){
				
				$("#Taxontree_datosExportar").val(data);
				$.post("createData", {dataTaxon: data},function(data){
					$.fn.yiiGridView.update('taxones-grid', {data: {Taxontree: {archivoData : data}}});
				});
				//$.fn.yiiGridView.update('taxones-grid', {data: {Taxontree: {nombresTaxones : data}}});
			});
		}
    });

    $('#Registros_archivoDivulgativo').uploadify({
    	'buttonText'	: 'Seleccionar Archivo',
    	'width'         : 140,
    	'fileTypeExts'  : '*.pdf;*.jpg;*.gif;*.jpeg',
    	'multi'			: false,
    	'swf'      		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.swf',
        'uploader' 		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.php',
		'onUploadComplete' : function(file){
			$.post("readFile", {archivo: file.name, tipo: file.type},function(data){
				
				$("#Taxontree_datosExportar").val(data);
				$.post("createData", {dataTaxon: data},function(data){
					$.fn.yiiGridView.update('taxones-grid', {data: {Taxontree: {archivoData : data}}});
				});
				//$.fn.yiiGridView.update('taxones-grid', {data: {Taxontree: {nombresTaxones : data}}});
			});
		}
    });
});


</script>
<div class="form">

<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'entidad-form',
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
	<?php echo $form->errorSummary($model); ?>
	
	<div class="tab-content">
		<div class="tab-pane fade in active" id="tab1">
			<fieldset>
				<legend class="form_legend">REGISTRO</legend>
				<?php 
					echo $form->textFieldRow($model, 'fecha_dil', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','disabled'=>true));
					echo $form->hiddenField($model, 'estado');
					//echo $form->textFieldRow($model, 'numero_registro', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
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
					echo $form->textFieldRow($model->registros_update, 'acronimo', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA'));
					echo $form->dropDownListRow($model->registros_update, 'fecha_fund', $model->registros_update->listYearFund(),array('prompt' => 'Seleccionar...'));
					echo $form->textAreaRow($model->registros_update, 'descripcion', array('class'=>'span4', 'rows'=>4));
					echo $form->textFieldRow($model->registros_update, 'direccion', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo $form->dropDownListRow($model->registros_update, 'ciudad_id', $model->registros_update->ListarCiudades(),array('prompt' => 'Seleccionar...'));
					echo $form->textFieldRow($model->registros_update, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
					echo $form->textFieldRow($model->registros_update, 'email', array('size'=>32,'maxlength'=>45, 'class'=>'textareaA'));
				?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">Tamaño de la colección</legend>
				<div class="InlineFormDiv" id="tamCole">
					<div>
					<?php 
						echo $form->textField($model->registros_update->tamano_coleccion, 'tipo_preservacion', array('name'=>'Tamano_Coleccion[0][tipo_preservacion]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $model->registros_update->tamano_coleccion->attributeLabels()['tipo_preservacion']));
						echo $form->textField($model->registros_update->tamano_coleccion, 'unidad_medida', array('name'=>'Tamano_Coleccion[0][unidad_medida]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $model->registros_update->tamano_coleccion->attributeLabels()['unidad_medida']));
						echo $form->textField($model->registros_update->tamano_coleccion, 'cantidad', array('onchange' => 'sumarTipo("cantSum","Registros_Update_tamano_coleccion_total")','name'=>'Tamano_Coleccion[0][cantidad]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline cantSum', 'placeholder' => $model->registros_update->tamano_coleccion->attributeLabels()['cantidad']));
						
						$this->widget('bootstrap.widgets.TbButton', array(
								'label'=>'+',
								'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
								'size'=>'small', // null, 'large', 'small' or 'mini'
								'htmlOptions'=>array('class'=>'addType','onclick' => 'agregarTipoPres()')
							));
					?>
					</div>
					
				</div>
				
				<?php 
					echo $form->textFieldRow($model->registros_update, 'tamano_coleccion_total', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA totalRow'));
				?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">Tipos en la colección</legend>
				<div class="InlineFormDiv" id="tipoCole">
				<?php 
					echo $form->textField($model->registros_update->tipos_en_coleccion, 'informacion_ejemplar', array('style' => 'width:220px !important','name'=>'Tipos_En_Coleccion[0][informacion_ejemplar]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline', 'placeholder' => $model->registros_update->tipos_en_coleccion->attributeLabels()['informacion_ejemplar']));
					echo $form->textField($model->registros_update->tipos_en_coleccion, 'cantidad', array('onchange' => 'sumarTipo("cantSumTipo","Registros_Update_tipo_coleccion_total")','name'=>'Tipos_En_Coleccion[0][cantidad]','size'=>32,'maxlength'=>150, 'class'=>'textareaA textInline cantSumTipo', 'placeholder' => $model->registros_update->tipos_en_coleccion->attributeLabels()['cantidad']));
					
					$this->widget('bootstrap.widgets.TbButton', array(
							'label'=>'+',
							'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
							'size'=>'small', // null, 'large', 'small' or 'mini'
							'htmlOptions'=>array('class'=>'addType','onclick' => 'agregarTipoCol()')
					));
				?>
				</div>
				
				<?php 
					echo $form->textFieldRow($model->registros_update, 'tipo_coleccion_total', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA totalRow2'));
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
				<legend class="form_legend">Nivel de catalogación, sistematización e identificación</legend>
				<div style="padding-left: 160px">
					<label class="control-label required inlineLabel" style="width:80px !important"><?=$model->registros_update->composicion_general->attributeLabels()['numero_ejemplares'];?></label>
					<label class="control-label required inlineLabel" style="width:63px !important">1.</label>
					<label class="control-label required inlineLabel" style="width:63px !important">2.</label>
					<label class="control-label required inlineLabel" style="width:63px !important">3.</label>
					<label class="control-label required inlineLabel" style="width:63px !important">4.</label>
					<label class="control-label required inlineLabel" style="width:63px !important">5.</label>
				</div>
				<div style="clear: both;" id="nivelCat">
					<div>
						<?php 
							echo $form->textField($model->registros_update->composicion_general, 'grupo_taxonomico', array('style' => 'width:150px !important; margin-right: 5px','name'=>'Composicion_General[0][grupo_taxonomico]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => $model->registros_update->composicion_general->attributeLabels()['grupo_taxonomico']));
							echo $form->textField($model->registros_update->composicion_general, 'numero_ejemplares', array('style' => 'width:80px !important','name'=>'Composicion_General[0][numero_ejemplares]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => 0));
						?>
						<div class="input-append">
							<?=$form->textField($model->registros_update->composicion_general, 'numero_catalogados', array('style' => 'width:30px !important','name'=>'Composicion_General[0][numero_catalogados]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => 0));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($model->registros_update->composicion_general, 'numero_sistematizados', array('style' => 'width:30px !important','name'=>'Composicion_General[0][numero_sistematizados]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => 0));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($model->registros_update->composicion_general, 'numero_nivel_familia', array('style' => 'width:30px !important','name'=>'Composicion_General[0][numero_nivel_familia]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => 0));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($model->registros_update->composicion_general, 'numero_nivel_genero', array('style' => 'width:30px !important','name'=>'Composicion_General[0][numero_nivel_genero]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => 0));?>
							<span class="add-on">%</span>
						</div>
						<div class="input-append">
							<?= $form->textField($model->registros_update->composicion_general, 'numero_nivel_especie', array('style' => 'width:30px !important','name'=>'Composicion_General[0][numero_nivel_especie]','size'=>32,'maxlength'=>150, 'class'=>'textareaA ', 'placeholder' => 0));?>
							<span class="add-on">%</span>
						</div>
						<?php 
						$this->widget('bootstrap.widgets.TbButton', array(
								'label'=>'+',
								'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
								'size'=>'small', // null, 'large', 'small' or 'mini'
								'htmlOptions'=>array('class'=>'','onclick' => 'agregarNivelCat()')
						));
						?>
				</div>
				</div>
				
				<div style="padding-top: 10px">
					<label class="control-label required inlineLabel2" ><b>1.</b> <?=$model->registros_update->composicion_general->attributeLabels()['numero_catalogados'];?></label>
					<label class="control-label required inlineLabel2" ><b>2.</b> <?=$model->registros_update->composicion_general->attributeLabels()['numero_sistematizados'];?></label>
					<label class="control-label required inlineLabel2" ><b>3.</b> <?=$model->registros_update->composicion_general->attributeLabels()['numero_nivel_familia'];?></label>
					<label class="control-label required inlineLabel2" ><b>4.</b> <?=$model->registros_update->composicion_general->attributeLabels()['numero_nivel_genero'];?></label>
					<label class="control-label required inlineLabel2" ><b>5.</b> <?=$model->registros_update->composicion_general->attributeLabels()['numero_nivel_especie'];?></label>
				</div>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">DOCUMENTOS ADJUNTOS</legend>
				<?php 
					echo $form->textAreaRow($model->registros_update, 'listado_anexos', array('class'=>'span4', 'rows'=>4));
					echo $form->fileFieldRow($model, 'archivoAnexo');
				?>
			</fieldset>
			
			<fieldset>
				<legend class="form_legend">INFORMACIÓN COMPLEMENTARIA</legend>
				<?php 
					echo $form->textAreaRow($model->registros_update, 'info_adicional', array('class'=>'span4', 'rows'=>4));
					echo $form->textFieldRow($model->registros_update, 'pagina_web', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA','prepend'=>'http://'));
					echo $form->textAreaRow($model->registros_update, 'redes_social', array('class'=>'span4', 'rows'=>4));
					echo $form->fileFieldRow($model, 'archivoColeccion');
					echo $form->fileFieldRow($model, 'archivoDivulgativo');
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
		</div>
	</div>			
	<div id="catalogouser-botones-internos" class="form-actions pull-right">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Guardar' : 'Actualizar')); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'id'=>'catalogo-user-form-interno-enviar', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Enviar y Guardar' : 'Enviar y Actualizar','htmlOptions' => array('onclick'=>'{enviarData()}'))); ?>
	    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'id'=>'catalogo-user-form-interno-reset', 'label'=>'Limpiar campos')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->