<?php
Yii::app()->clientScript->registerCoreScript('jquery.ui');
$userRole  = Yii::app()->user->getState("roles");

?>

<script type="text/javascript">
function enviarForm(){
	$("#bitacora-form").submit();
}

function resetForm(id) {
	$(':checkbox').each(function(){
		$(this).attr('checked', false);
	});
}

function seleccionaTodo(){
	$(':checkbox').each(function(){
		$(this).attr('checked', 'checked');
});
}
aux = 0;
function seleccionaParcial(clase){
	if(aux == 0){
		$('.'+clase).each(function(){
			$(this).attr('checked', 'checked');
		});
		aux = 1;
	}else if(aux == 1){
		$('.'+clase).each(function(){
			$(this).attr('checked', false);
		});
		aux = 0;
	}

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
		<legend class="form_legend"> Información Básica Del Titular <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'', 'type'=>'success','size' => 'mini', 'label'=>'Seleccionar', 'htmlOptions' => array('onclick' => 'seleccionaParcial(\'titular\')'))); ?></legend>
		<?php 
			echo $form->checkBoxRow($model, 'entidadTitular',array('class' => 'titular'));
			echo $form->checkBoxRow($model, 'entidadTipoTitular',array('class' => 'titular'));
			echo $form->checkBoxRow($model, 'entidadNit',array('class' => 'titular'));
			echo $form->checkBoxRow($model, 'entidadRepresentante',array('class' => 'titular'));
			echo $form->checkBoxRow($model, 'entidadRepresentanteId',array('class' => 'titular'));
			echo $form->checkBoxRow($model, 'entidadDireccion',array('class' => 'titular'));
			echo $form->checkBoxRow($model, 'entidadCiudad',array('class' => 'titular'));
			echo $form->checkBoxRow($model, 'entidadTelefono',array('class' => 'titular'));
			echo $form->checkBoxRow($model, 'entidadEmail',array('class' => 'titular'));
		?>
	</fieldset>
	<fieldset>
		<legend class="form_legend"> Información Básica De La Colección <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'', 'type'=>'success','size' => 'mini', 'label'=>'Seleccionar', 'htmlOptions' => array('onclick' => 'seleccionaParcial(\'basica\')'))); ?></legend>
		<?php 
			echo $form->checkBoxRow($model, 'coleccionNumero',array('class' => 'basica'));
			echo $form->checkBoxRow($model, 'coleccionFecha',array('class' => 'basica'));
			echo $form->checkBoxRow($model, 'reporteNombre',array('class' => 'basica'));
			echo $form->checkBoxRow($model, 'reporteAcronimo',array('class' => 'basica'));
			echo $form->checkBoxRow($model, 'reporteFundacion',array('class' => 'basica'));
			echo $form->checkBoxRow($model, 'reporteDescripcion',array('class' => 'basica'));
			echo $form->checkBoxRow($model, 'reporteDireccion',array('class' => 'basica'));
			echo $form->checkBoxRow($model, 'reporteCiudad',array('class' => 'basica'));
			echo $form->checkBoxRow($model, 'reporteTelefono',array('class' => 'basica'));
			echo $form->checkBoxRow($model, 'reporteEmail',array('class' => 'basica'));
		?>
	</fieldset>
	
	<fieldset>
		<legend class="form_legend">Cobertura <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'', 'type'=>'success','size' => 'mini', 'label'=>'Seleccionar', 'htmlOptions' => array('onclick' => 'seleccionaParcial(\'cobertura\')'))); ?></legend>
		<?php 
			echo $form->checkBoxRow($model, 'coberturaTaxonomica',array('class' => 'cobertura'));
			echo $form->checkBoxRow($model, 'coberturaGeografica',array('class' => 'cobertura'));
			echo $form->checkBoxRow($model, 'coberturaTemporal',array('class' => 'cobertura'));
		?>
	</fieldset>
	
	<fieldset>
		<legend class="form_legend">Tipos De Preservación <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'', 'type'=>'success','size' => 'mini', 'label'=>'Seleccionar', 'htmlOptions' => array('onclick' => 'seleccionaParcial(\'tiposcol\')'))); ?></legend>
		<?php 
			echo $form->checkBoxRow($model, 'tamanoTipo',array('class' => 'tiposcol'));
			echo $form->checkBoxRow($model, 'tamanoUnidad',array('class' => 'tiposcol'));
			//echo $form->checkBoxRow($model, 'tamanoCantidad');
		?>
	</fieldset>
	
	<fieldset>
		<legend class="form_legend">Nivel De Catalogación, Sistematización e Identificación <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'', 'type'=>'success','size' => 'mini', 'label'=>'Seleccionar', 'htmlOptions' => array('onclick' => 'seleccionaParcial(\'nivel\')'))); ?></legend>
		<?php 
			echo $form->checkBoxRow($model, 'nivelGrupo',array('class' => 'nivel'));
			echo $form->checkBoxRow($model, 'nivelSubgrupo',array('class' => 'nivel'));
			echo $form->checkBoxRow($model, 'nivelEjemplares',array('class' => 'nivel'));
			echo $form->checkBoxRow($model, 'nivelCatalogados',array('class' => 'nivel'));
			echo $form->checkBoxRow($model, 'nivelSistematizados',array('class' => 'nivel'));
			echo $form->checkBoxRow($model, 'nivelOrden',array('class' => 'nivel'));
			echo $form->checkBoxRow($model, 'nivelFamilia',array('class' => 'nivel'));
			echo $form->checkBoxRow($model, 'nivelGenero',array('class' => 'nivel'));
			echo $form->checkBoxRow($model, 'nivelEspecie',array('class' => 'nivel'));
			echo $form->checkBoxRow($model, 'sistematizacion',array('class' => 'nivel'));
		?>
	</fieldset>
	
	<fieldset>
		<legend class="form_legend">Tipos En La Colección <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'', 'type'=>'success','size' => 'mini', 'label'=>'Seleccionar', 'htmlOptions' => array('onclick' => 'seleccionaParcial(\'tipos\')'))); ?></legend>
		<?php 
			echo $form->checkBoxRow($model, 'tipoEjemplarTipo',array('class' => 'tipos'));
			echo $form->checkBoxRow($model, 'tipoEjemplarTipoCant',array('class' => 'tipos'));
			echo $form->checkBoxRow($model, 'tipoGrupo',array('class' => 'tipos'));
			//echo $form->checkBoxRow($model, 'tipoEjemplar',array('class' => 'tipos'));
			//echo $form->checkBoxRow($model, 'tipoNombreCientifico',array('class' => 'tipos'));
			echo $form->checkBoxRow($model, 'tipoCantidad',array('class' => 'tipos'));
		?>
	</fieldset>
	
	<fieldset>
		<legend class="form_legend">Información Complementaria <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'', 'type'=>'success','size' => 'mini', 'label'=>'Seleccionar', 'htmlOptions' => array('onclick' => 'seleccionaParcial(\'infocompl\')'))); ?></legend>
		<?php 
			echo $form->checkBoxRow($model, 'documentoAnexos',array('class' => 'infocompl'));
			echo $form->checkBoxRow($model, 'informacionAdicional',array('class' => 'infocompl'));
			echo $form->checkBoxRow($model, 'informacionPagina',array('class' => 'infocompl'));
		?>
	</fieldset>
	
	<fieldset>
		<legend class="form_legend">Información De Contacto <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'', 'type'=>'success','size' => 'mini', 'label'=>'Seleccionar', 'htmlOptions' => array('onclick' => 'seleccionaParcial(\'infocont\')'))); ?></legend>
		<?php 
			echo $form->checkBoxRow($model, 'contactoNombre',array('class' => 'infocont'));
			echo $form->checkBoxRow($model, 'contactoCargo',array('class' => 'infocont'));
			echo $form->checkBoxRow($model, 'contactoDependencia',array('class' => 'infocont'));
			echo $form->checkBoxRow($model, 'contactoDireccion',array('class' => 'infocont'));
			echo $form->checkBoxRow($model, 'contactoCiudad',array('class' => 'infocont'));
			echo $form->checkBoxRow($model, 'contactoTelefono',array('class' => 'infocont'));
			echo $form->checkBoxRow($model, 'contactoEmail',array('class' => 'infocont'));
		?>
	</fieldset>
	
	<fieldset>
		<legend class="form_legend">Información Del Dilegenciador <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'', 'type'=>'success','size' => 'mini', 'label'=>'Seleccionar', 'htmlOptions' => array('onclick' => 'seleccionaParcial(\'infodil\')'))); ?></legend>
		<?php 
			echo $form->checkBoxRow($model, 'dilegenciadorNombre',array('class' => 'infodil'));
			echo $form->checkBoxRow($model, 'dilegenciadorDependencia',array('class' => 'infodil'));
			echo $form->checkBoxRow($model, 'dilegenciadorCargo',array('class' => 'infodil'));
			echo $form->checkBoxRow($model, 'dilegenciadorTelefono',array('class' => 'infodil'));
			echo $form->checkBoxRow($model, 'dilegenciadorEmail',array('class' => 'infodil'));
		?>
	</fieldset>
	
	<div id="catalogouser-botones-internos" class="form-actions pull-right">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'success', 'label'=>'Seleccionar Todo', 'htmlOptions' => array('onclick' => 'seleccionaTodo()'))); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'catalogo-user-form-interno-submit', 'type'=>'success', 'label'=>'Generar Bitácora', 'htmlOptions' => array('onclick' => 'enviarForm()'))); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'id'=>'catalogo-user-form-interno-reset', 'label'=>'Limpiar campos', 'htmlOptions' => array('onclick' => 'resetForm("bitacora-form")'))); ?>
    </div>
	
<?php $this->endWidget(); ?>
</div>