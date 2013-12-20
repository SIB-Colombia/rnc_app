<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
$userRole  = Yii::app()->user->getState("roles");

?>

<script type="text/javascript">
function enviarForm(){
	$("#bitacora-form").submit();
}

function resetForm(id) {
	$('#'+id).each(function(){
	        this.reset();
	});
}

function seleccionaTodo(){
	$(':checkbox').each(function(){
		$(this).attr('checked', 'checked');
});
}
</script>

<style>
.checkbox{
	float: left;
	margin-right : 20px;
	width: 200px
}
</style>

<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'bitacora-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Seleccione los campos deseados para generar el reporte.</p>
	
	<fieldset>
		<legend class="form_legend">INFORMACIÓN BÁSICA DE LA COLECCIÓN</legend>
		<?php 
			echo $form->checkBoxRow($model, 'entidadNombre');
			echo $form->checkBoxRow($model, 'coleccionNumero');
			echo $form->checkBoxRow($model, 'coleccionFecha');
			echo $form->checkBoxRow($model, 'reporteNombre');
			echo $form->checkBoxRow($model, 'reporteAcronimo');
			echo $form->checkBoxRow($model, 'reporteFundacion');
			echo $form->checkBoxRow($model, 'reporteDescripcion');
			echo $form->checkBoxRow($model, 'reporteDireccion');
			echo $form->checkBoxRow($model, 'reporteCiudad');
			echo $form->checkBoxRow($model, 'reporteTelefono');
			echo $form->checkBoxRow($model, 'reporteEmail');
		?>
	</fieldset>
	
	<fieldset>
		<legend class="form_legend">COBERTURA</legend>
		<?php 
			echo $form->checkBoxRow($model, 'coberturaTaxonomica');
			echo $form->checkBoxRow($model, 'coberturaGeografica');
			echo $form->checkBoxRow($model, 'coberturaTemporal');
		?>
	</fieldset>
	
	<fieldset>
		<legend class="form_legend">Tipos de preservación</legend>
		<?php 
			echo $form->checkBoxRow($model, 'tipoGrupo');
			echo $form->checkBoxRow($model, 'tipoEjemplar');
			echo $form->checkBoxRow($model, 'tipoNombreCientifico');
			//echo $form->checkBoxRow($model, 'tipoCantidad');
		?>
	</fieldset>
	
	<fieldset>
		<legend class="form_legend">Nivel de catalogación, sistematización e identificación</legend>
		<?php 
			echo $form->checkBoxRow($model, 'nivelGrupo');
			echo $form->checkBoxRow($model, 'nivelEjemplares');
			echo $form->checkBoxRow($model, 'nivelCatalogados');
			echo $form->checkBoxRow($model, 'nivelSistematizados');
			echo $form->checkBoxRow($model, 'nivelFamilia');
			echo $form->checkBoxRow($model, 'nivelGenero');
			echo $form->checkBoxRow($model, 'nivelEspecie');
			echo $form->checkBoxRow($model, 'sistematizacion');
		?>
	</fieldset>
	
	<fieldset>
		<legend class="form_legend">Tipos en la colección</legend>
		<?php 
			echo $form->checkBoxRow($model, 'tamanoTipo');
			echo $form->checkBoxRow($model, 'tamanoUnidad');
			//echo $form->checkBoxRow($model, 'tamanoCantidad');
		?>
	</fieldset>
	
	<fieldset>
		<legend class="form_legend">INFORMACIÓN COMPLEMENTARIA</legend>
		<?php 
			echo $form->checkBoxRow($model, 'documentoAnexos');
			echo $form->checkBoxRow($model, 'informacionAdicional');
			echo $form->checkBoxRow($model, 'informacionPagina');
		?>
	</fieldset>
	
	<fieldset>
		<legend class="form_legend">INFORMACIÓN DE CONTACTO</legend>
		<?php 
			echo $form->checkBoxRow($model, 'contactoNombre');
			echo $form->checkBoxRow($model, 'contactoCargo');
			echo $form->checkBoxRow($model, 'contactoDependencia');
			echo $form->checkBoxRow($model, 'contactoDireccion');
			echo $form->checkBoxRow($model, 'contactoCiudad');
			echo $form->checkBoxRow($model, 'contactoTelefono');
			echo $form->checkBoxRow($model, 'contactoEmail');
		?>
	</fieldset>
	
	<div id="catalogouser-botones-internos" class="form-actions pull-right">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'primary', 'label'=>'Seleccionar Todo', 'htmlOptions' => array('onclick' => 'seleccionaTodo()'))); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'primary', 'label'=>'Generar Bitácora', 'htmlOptions' => array('onclick' => 'enviarForm()'))); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'id'=>'catalogo-user-form-interno-reset', 'label'=>'Limpiar campos')); ?>
    </div>
	
<?php $this->endWidget(); ?>
</div>