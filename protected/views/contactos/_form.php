<?php $basepath = Yii::app()->request->baseUrl;?>
<script type="text/javascript">
/*<![CDATA[*/
jQuery(function($) {
jQuery('body').on('change','#Contactos_idPais',function(){jQuery.ajax({'type':'POST','url':'<?=$basepath;?>/index.php/contactos/actualizarDepartamento','beforeSend':function(){
	            		$("#datos-pais-region-municipio").addClass("loading");},'complete':function(){
        	    		$("#datos-pais-region-municipio").removeClass("loading");},'cache':false,'data':jQuery(this).parents("form").serialize(),'success':function(html){jQuery("#Contactos_idDepartamentoEstadoProvincia").html(html)}});return false;});
jQuery('body').on('change','#Contactos_idDepartamentoEstadoProvincia',function(){jQuery.ajax({'type':'POST','url':'<?=$basepath;?>/index.php/contactos/actualizarMunicipio','beforeSend':function(){
	            		$("#datos-pais-region-municipio").addClass("loading");},'complete':function(){
        	    		$("#datos-pais-region-municipio").removeClass("loading");},'cache':false,'data':jQuery(this).parents("form").serialize(),'success':function(html){jQuery("#Contactos_idMunicipio").html(html)}});return false;});

});
/*]]>*/
</script>

<?php /** @var BootActiveForm $form */

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'contactos-form',
    'type'=>'horizontal',
    'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php echo $form->textFieldRow($model, 'persona', array('size'=>50,'maxlength'=>50, 'class'=>'textareaA')); ?>
	<?php echo $form->textFieldRow($model, 'organizacion', array('size'=>60,'maxlength'=>255, 'class'=>'textareaA')); ?>
	<?php echo $form->textFieldRow($model, 'acronimo', array('size'=>50,'maxlength'=>50, 'class'=>'textareaA')); ?>
	<?php echo $form->textFieldRow($model, 'cargo', array('size'=>60,'maxlength'=>255, 'class'=>'textareaA')); ?>
	<?php echo $form->textFieldRow($model, 'correo_electronico', array('size'=>60,'maxlength'=>255, 'class'=>'textareaA')); ?>
	<?php echo $form->textFieldRow($model, 'direccion', array('size'=>60,'maxlength'=>100, 'class'=>'textareaA')); ?>
	
	<div id="datos-pais-region-municipio">
		<?php echo $form->dropDownListRow($model, 'idPais', $model->ListarPaises(), 
			array(
        		'prompt'=>'Seleccione',
        		'ajax' => array(
            		'type'=>'POST', //request type
            		'url'=>array('contactos/actualizarDepartamento'), //url to call.
            		'update'=>'#Contactos_idDepartamentoEstadoProvincia', //selector to update
            		'beforeSend' => 'function(){
	            		$("#datos-pais-region-municipio").addClass("loading");}',
    	        	'complete' => 'function(){
        	    		$("#datos-pais-region-municipio").removeClass("loading");}',
				)
			)
		); ?>
		<?php echo $form->dropDownListRow($model, 'idDepartamentoEstadoProvincia', $model->ListarDepartamentosEstadosProvincias(), 
			array(
        		'prompt'=>'Seleccione',
        		'ajax' => array(
            		'type'=>'POST', //request type
            		'url'=>array('contactos/actualizarMunicipio'), //url to call.
            		'update'=>'#Contactos_idMunicipio', //selector to update
            		'beforeSend' => 'function(){
	            		$("#datos-pais-region-municipio").addClass("loading");}',
    	        	'complete' => 'function(){
        	    		$("#datos-pais-region-municipio").removeClass("loading");}',
				)
			)
		); ?>
		<?php echo $form->dropDownListRow($model, 'idMunicipio', $model->ListarMunicipios(), 
			array(
        		'prompt'=>'Seleccione',
			)
		); ?>
	</div>
	
	<?php echo $form->textFieldRow($model, 'telefono', array('size'=>60,'maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($model, 'fax', array('size'=>60,'maxlength'=>255)); ?>
	
	<div class="control-group">
		<label class="control-label" for="Contactos_hora_inicial">Disponibilidad - hora inicial</label>
		<div class="controls">
			<div class="input-append bootstrap-timepicker">
				<input name="Contactos[hora_inicial" id="Contactos_hora_inicial" type="text" class="input-small" value="<?php echo $model->hora_inicial;?>">
        		<span class="add-on"><i class="icon-time"></i></span>
        		<span class="help-inline error" id="Contactos_inicial_em_" style="display: none"></span>
    		</div>
    	</div>
    </div>
    
    <div class="control-group">
		<label class="control-label" for="Contactos_hora_final">Disponibilidad - hora final</label>
		<div class="controls">
			<div class="input-append bootstrap-timepicker">
				<input name="Contactos[hora_final" id="Contactos_hora_final" type="text" class="input-small" value="<?php echo $model->hora_final;?>">
        		<span class="add-on"><i class="icon-time"></i></span>
        		<span class="help-inline error" id="Contactos_hora_final_em_" style="display: none"></span>
    		</div>
    	</div>
    </div>
	<?php //echo $form->textFieldRow($model, 'hora_inicial', array('size'=>60,'maxlength'=>255)); ?>
	<?php //echo $form->textFieldRow($model, 'hora_final', array('size'=>60,'maxlength'=>255)); ?>
	<?php //echo $form->timepickerRow($model, 'hora_inicial', array('data-minute-step'=>'1', 'hint'=>'Elija la hora inicial usando el control.', 'append'=>'<i class="icon-time" style="cursor:pointer"></i>'));?>
	<?php //echo $form->timepickerRow($model, 'hora_final', array('data-minute-step'=>'1', 'hint'=>'Elija la hora final usando el control.', 'append'=>'<i class="icon-time" style="cursor:pointer"></i>'));?>
	<?php echo $form->textFieldRow($model, 'instrucciones', array('size'=>60,'maxlength'=>255, 'class'=>'textareaA')); ?>
	
	<div id="contactos-botones-internos" class="form-actions pull-right">
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'id'=>'contactos-form-interno-submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Guardar' : 'Actualizar')); ?>
    	<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'id'=>'contactos-form-interno-reset', 'label'=>'Limpiar campos')); ?>
    </div>
	
<?php $this->endWidget(); ?>

<script type="text/javascript">
	$('#Contactos_hora_inicial').timepicker({
		minuteStep: 1,
		showSeconds: false,
		showMeridian: false
	});
	$('#Contactos_hora_final').timepicker({
		minuteStep: 1,
		showSeconds: false,
		showMeridian: false
	});
</script>