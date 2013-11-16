<?php
/* @var $this CatalogoespeciesController */
/* @var $model Catalogoespecies */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerCoreScript('jquery.ui');
?>

<script type="text/javascript">
	var $tabs = $('.tabbable li');

	$('#prevtab').on('click', function() {
    	$tabs.filter('.active').prev('li').find('a[data-toggle="tab"]').tab('show');
	});

</script>

<script type="text/javascript">
	function resetForm(id) {
		$('#'+id).each(function(){
		        this.reset();
		});
	}

	function submitFormCitacionCreate(id, modal, grid) {
		<?php echo CHtml::ajax(array(
        	'url'=>array('citacion/create'),
			'data'=> "js:$('#'+id).serialize()",
        	'type'=>'post',
        	'dataType'=>'json',
			'beforeSend' => 'function(){
				$("#"+id+"-submit").hide(500);
				$("#"+id+"-reset").hide(500);
				$("#"+modal).addClass("loading");
			}',
			'complete' => 'function(){
				$("#"+modal).removeClass("loading");
			}',
			'success'=>"function(data)
            {
            	if (data.status == 'failure')
            	{
					$('#'+id+'-submit').show(500);
					$('#'+id+'-reset').show(500);
               		$('#'+modal+' div.modal-body').html(data.respuesta);
                    $('#'+modal+' div.modal-body form').submit(submitFormCitacionCreate);
                }
                else
                {
                    $('#'+modal+' div.modal-body').html(data.respuesta);
					$('#Catalogoespecies_citacion_id').val(data.idCita);
					$('#Catalogoespecies_tituloCita').val(data.tituloCita);
					$('#Catalogoespecies_autorCita').val(data.autorCita);
					$.fn.yiiGridView.update(grid, {data: $(this).serialize()});
                    setTimeout(\"$('#citacion-form-close').click() \",3000);
                }				
            } ",
       	))?>;	
	}

	function submitFormContactoCreate(id, modal, grid) {
		<?php echo CHtml::ajax(array(
        	'url'=>array('contactos/create'),
			'data'=> "js:$('#'+id).serialize()",
        	'type'=>'post',
        	'dataType'=>'json',
			'beforeSend' => 'function(){
				$("#"+id+"-submit").hide(500);
				$("#"+id+"-reset").hide(500);
				$("#"+modal).addClass("loading");
			}',
			'complete' => 'function(){
				$("#"+modal).removeClass("loading");
			}',
			'success'=>"function(data)
            {
            	if (data.status == 'failure')
            	{
					$('#'+id+'-submit').show(500);
					$('#'+id+'-reset').show(500);
               		$('#'+modal+' div.modal-body').html(data.respuesta);
                    $('#'+modal+' div.modal-body form').submit(submitFormContactoCreate);
                }
                else
                {
                    $('#'+modal+' div.modal-body').html(data.respuesta);
					$('#Catalogoespecies_contacto_id').val(data.idContacto);
					$('#Catalogoespecies_personaContacto').val(data.nombreContacto);
					$('#Catalogoespecies_organizacionContacto').val(data.organizacion);
					$.fn.yiiGridView.update(grid, {data: $(this).serialize()});
                    setTimeout(\"$('#contactos-form-close').click() \",3000);
                }				
            } ",
       	))?>;	
	}

</script>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'adicionarEditarCitaModal')); ?>
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h4>Agregar nueva citación</h4>
    </div>
 
	<div class="modal-body">
	</div>
 
	<div class="modal-footer">    
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'type'=>'primary',
			'label'=>'Guardar',
			'url'=>array('citacion/create'),
			'buttonType'=>'submit',
			'htmlOptions'=>array('onclick'=>"{submitFormCitacionCreate('citacion-form', 'adicionarEditarCitaModal', 'citaciones-grid');}", 'id'=>'citacion-form-submit'),
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'Limpiar campos',
			'url'=>'#',
			'buttonType'=>'reset',
			'htmlOptions'=>array('onclick'=>'{resetForm(\'citacion-form\');}', 'id'=>'citacion-form-reset'),
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'Cerrar',
			'url'=>'#',
			'htmlOptions'=>array('data-dismiss'=>'modal', 'id'=>'citacion-form-close'),
		)); ?>
	</div>
<?php $this->endWidget(); ?>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'adicionarEditarContactoModal')); ?>
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h4>Agregar nuevo contacto</h4>
    </div>
 
	<div class="modal-body">
	</div>
 
	<div class="modal-footer">    
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'type'=>'primary',
			'label'=>'Guardar',
			'url'=>array('contactos/create'),
			'buttonType'=>'submit',
			'htmlOptions'=>array('onclick'=>"{submitFormContactoCreate('contactos/create', 'contactos-form', 'adicionarEditarContactoModal', 'contactos-grid');}", 'id'=>'contactos-form-submit'),
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'Limpiar campos',
			'url'=>'#',
			'buttonType'=>'reset',
			'htmlOptions'=>array('onclick'=>'{resetForm(\'contactos-form\');}', 'id'=>'contactos-form-reset'),
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'Cerrar',
			'url'=>'#',
			'htmlOptions'=>array('data-dismiss'=>'modal', 'id'=>'contactos-form-close'),
		)); ?>
	</div>
<?php $this->endWidget(); ?>

<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'catalogoespecies-form',
    'type'=>'horizontal',
    'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
)); ?>

<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Datos básicos</a></li>
    <li><a href="#tab2" data-toggle="tab">Info. taxonómica</a></li>
    <li><a href="#tab3" data-toggle="tab">Citación</a></li>
    <li><a href="#tab4" data-toggle="tab">Contacto</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade in active" id="tab1">
    
    <fieldset>
    	<legend>Verificación de la ficha</legend>
    	<?php echo $form->dropDownListRow($model, 'idEstadoVerificacion', $model->ListarEstadosVerificacion()); ?>
    	<?php echo $form->textAreaRow($model, 'comentarioVerificacion', array('class'=>'span8', 'rows'=>5)); ?>
    	
    	<legend>Datos básicos de la ficha</legend>
    	<?php echo $form->textFieldRow($model, 'fechaelaboracion', array('hint'=>'Esta fecha es generada automáticamente a partir del reloj del sistema.', 'readonly'=>true)); ?>
    	<?php echo $form->textFieldRow($model, 'fechaactualizacion', array('hint'=>'Esta fecha es generada automáticamente a partir del reloj del sistema.', 'readonly'=>true)); ?>
    	<?php echo $form->textFieldRow($model, 'titulometadato', array('size'=>220,'maxlength'=>255, 'class'=>'textareaA')); ?>
    	
    </fieldset>
    
    </div>
    <div class="tab-pane fade" id="tab2">
    	<legend>Datos taxonómicos</legend>
    	<?php echo $form->textFieldRow($model, 'jerarquianombrescomunes', array('size'=>220,'maxlength'=>255, 'class'=>'textareaA')); ?>
    	<?php echo $form->textFieldRow($model, 'jerarquiaTaxonomica', array('size'=>220,'maxlength'=>255, 'class'=>'textareaA')); ?>
    	<?php echo $form->textFieldRow($model, 'taxonNombre', array('size'=>220,'maxlength'=>100, 'class'=>'textareaA')); ?>
    	<?php echo $form->textFieldRow($model, 'autor', array('size'=>220,'maxlength'=>150, 'class'=>'textareaA')); ?>
    	<?php echo $form->textFieldRow($model, 'paginaWeb', array('size'=>220,'maxlength'=>150, 'class'=>'textareaA')); ?>
    </div>
    <div class="tab-pane fade" id="tab3">
    	<legend>Cita actual</legend>
    	<?php echo $form->textFieldRow($model, 'citacion_id', array('readonly'=>true)); ?>
    	<?php echo $form->textFieldRow($model, 'tituloCita', array('size'=>220, 'class'=>'textareaA', 'readonly'=>true)); ?>
    	<?php echo $form->textFieldRow($model, 'autorCita', array('size'=>220, 'class'=>'textareaA', 'readonly'=>true)); ?>
    	<script type="text/javascript">
			function formularioNuevaCita() {
				<?php echo CHtml::ajax(array(
            		'url'=>array('citacion/create'),
            		'data'=> array('catalogoId' => $model->catalogoespecies_id),
            		'type'=>'post',
            		'dataType'=>'json',
					'beforeSend' => 'function(){
						$("#adicionarEditarCitaModal div.modal-header h4").text("Agregar nueva citación");
						$("#citacion-form-submit").hide(500);
						$("#citacion-form-reset").hide(500);
						$("#citacion-form-submit").attr("onClick","{submitFormCitacionCreate(\'citacion-form\', \'adicionarEditarCitaModal\', \'citaciones-grid\');}");
						$("#adicionarEditarCitaModal").addClass("loading");
					}',
					'complete' => 'function(){
						$("#adicionarEditarCitaModal").removeClass("loading");
						$("#citacion-form-submit").show(500);
						$("#citacion-form-reset").show(500);
					}',
            		'success'=>"function(data)
            		{
                		if (data.status == 'failure')
                		{
                    		$('#adicionarEditarCitaModal div.modal-body').html(data.respuesta);
                    		$('#adicionarEditarCitaModal div.modal-body form').submit(formularioNuevaCita);
							$('#citacion-botones-internos').hide();
                		}
                		else
                		{
                    		$('#adicionarEditarCitaModal div.modal-body').html(data.respuesta);
                		}
 
            		} ",
            	))?>;		
			};

			function formularioNuevoContacto() {
				<?php echo CHtml::ajax(array(
            		'url'=>array('contactos/create'),
            		'data'=> array('catalogoId' => $model->catalogoespecies_id),
            		'type'=>'post',
            		'dataType'=>'json',
					'beforeSend' => 'function(){
						$("#adicionarEditarContactoModal div.modal-header h4").text("Agregar nuevo contacto");
						$("#contactos-form-submit").hide(500);
						$("#contactos-form-reset").hide(500);
						$("#contactos-form-submit").attr("onClick","{submitFormContactoCreate(\'contactos-form\', \'adicionarEditarContactoModal\', \'contactos-grid\');}");
						$("#adicionarEditarContactoModal").addClass("loading");
					}',
					'complete' => 'function(){
						$("#adicionarEditarContactoModal").removeClass("loading");
						$("#contactos-form-submit").show(500);
						$("#contactos-form-reset").show(500);
					}',
            		'success'=>"function(data)
            		{
                		if (data.status == 'failure')
                		{
                    		$('#adicionarEditarContactoModal div.modal-body').html(data.respuesta);
                    		$('#adicionarEditarContactoModal div.modal-body form').submit(formularioNuevoContacto);
							$('#contactos-botones-internos').hide();
                		}
                		else
                		{
                    		$('#adicionarEditarContactoModal div.modal-body').html(data.respuesta);
                		}
 
            		} ",
            	))?>;		
			};
		</script>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Lista obras',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    		'headerButtons' => array(
				array(
					'class' => 'bootstrap.widgets.TbButtonGroup',
					'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
					'buttons' => array(
						array(
							'label' => 'Agregar cita', 
							'url' => '#',
							'icon'=>'icon-plus',
							'htmlOptions' => array(
								'onclick'=>'{formularioNuevaCita()}',
								'data-toggle' => 'modal',
								'data-target' => '#adicionarEditarCitaModal',
							),
						),
					)
    			),
    		)
    	));?>
    	<?php echo $this->renderPartial('_obras_citadas_update_table', array('citaciones'=>$citaciones)); ?>
    	<?php $this->endWidget();?>
    </div>
    <div class="tab-pane fade" id="tab4">
    	<legend>Contacto actual</legend>
    	<?php echo $form->textFieldRow($model, 'contacto_id', array('readonly'=>true)); ?>
    	<?php echo $form->textFieldRow($model, 'personaContacto', array('size'=>220, 'class'=>'textareaA', 'readonly'=>true)); ?>
    	<?php echo $form->textFieldRow($model, 'organizacionContacto', array('size'=>220, 'class'=>'textareaA', 'readonly'=>true)); ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Lista contactos',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    		'headerButtons' => array(
				array(
					'class' => 'bootstrap.widgets.TbButtonGroup',
					'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
					'buttons' => array(
						array(
							'label' => 'Agregar contacto',
							'url' => '#',
							'icon'=>'icon-plus',
							'htmlOptions' => array(
								'onclick'=>'{formularioNuevoContacto()}',
								'data-toggle' => 'modal',
								'data-target' => '#adicionarEditarContactoModal',
							),
						),
					)
    			),
    		)
    	));?>
    	<?php echo $this->renderPartial('_contacto_ficha_update_table', array('contactos'=>$contactos)); ?>
    	<?php $this->endWidget();?>
    </div>
  </div>
</div>
<div class="form-actions pull-right">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Guardar' : 'Actualizar')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Limpiar campos')); ?>
    <?php //$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Cancelar', 'submit'=>array('catalogo/index'))); ?>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
  $(document).ready(function() {
	  $('#catalogoespecies-form').keydown(function(event){
		  if(event.keyCode == 13) {
			  //alert(event.target.id);
			  /*var target = event.originalEvent;
			  if(target.srcElement.id == "Citacion_citacion_id") {
			    	event.preventDefault();
			    	$("#Citacion_citacion_id").trigger("change");
			    	return false;
			  }*/
			  var target = event.target;
			  if(target.id == "Citacion_citacion_id") {
			    	event.preventDefault();
			    	$("#Citacion_citacion_id").trigger("change");
			    	return false;
			  }
			  if(target.id == "Citacion_fecha") {
				  event.preventDefault();
				  $("#Citacion_fecha").trigger("change");
				  return false;
			  }
			  if(target.id == "Citacion_documento_titulo") {
				  event.preventDefault();
				  $("#Citacion_documento_titulo").trigger("change");
				  return false;
			  }
			  if(target.id == "Citacion_autor") {
				  event.preventDefault();
				  $("#Citacion_autor").trigger("change");
				  return false;
			  }

			  // Inicia target tab de contacto
			  if(target.id == "Contactos_contacto_id") {
				  event.preventDefault();
				  $("#Contactos_contacto_id").trigger("change");
				  return false;
			  }
			  if(target.id == "Contactos_persona") {
				  event.preventDefault();
				  $("#Contactos_persona").trigger("change");
				  return false;
			  }
			  if(target.id == "Contactos_organizacion") {
				  event.preventDefault();
				  $("#Contactos_organizacion").trigger("change");
				  return false;
			  }
			  if(target.id == "Contactos_cargo") {
				  event.preventDefault();
				  $("#Contactos_cargo").trigger("change");
				  return false;
			  }
			  if(target.id == "Contactos_direccion") {
				  event.preventDefault();
				  $("#Contactos_direccion").trigger("change");
				  return false;
			  }
			  if(target.id == "Contactos_telefono") {
				  event.preventDefault();
				  $("#Contactos_telefono").trigger("change");
				  return false;
			  }
			  if(target.id == "Contactos_correo_electronico") {
				  event.preventDefault();
				  $("#Contactos_correo_electronico").trigger("change");
				  return false;
			  }
		  }  
	  });
	});

	function cambiarCita($idCita) {
		console.log('Hola');
		console.log($idCita);
		return false;
	}
</script>
</div><!-- form -->