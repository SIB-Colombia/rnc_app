<?php
/* @var $this CatalogoespeciesController */
/* @var $model Catalogoespecies */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerCoreScript('jquery.ui');
?>

<script type="text/javascript">
	function resetForm(id) {
		$('#'+id).each(function(){
		        this.reset();
		});
	}

	function submitFormAtributoUpdate(id, modal, grid) {
		<?php echo CHtml::ajax(array(
			'url'=>"js:$('#atributo-form').attr('action')",
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
			'success'=>"function(data) {
        		if (data.status == 'failure') {
					$('#'+id+'-submit').show(500);
					$('#'+id+'-reset').show(500);
           			$('#'+modal+' div.modal-body').html(data.respuesta);
            	} else {
					$('#editar-atributo-form-submit').hide();
					$('#editar-atributo-form-reset').hide();
                	$('#'+modal+' div.modal-body').html(data.respuesta);
					$.fn.yiiGridView.update(grid, {data: $(this).serialize()});
                	setTimeout(\"$('#atributo-form-close').click() \",3000);
            	}				
        	}",
   		))?>;	
	}

	function callAjaxUpdateAttribute(url, grid) {
		$.ajax({
			url: <?php echo "'".Yii::app()->createUrl("atributovalor/update")."/'";?>+url,
			type: 'post',
		    dataType: 'json',
		    beforeSend: 
			    function(){
					$("#editar-atributo-form-submit").hide(500);
					$("#editar-atributo-form-reset").hide(500);
					$("#editar-atributo-form-submit").attr("onClick","{submitFormAtributoUpdate(\'atributo-form\', \'editarAtributoModal\', \'"+grid+"\');}");
					$("#editar-atributo-form-reset").attr("onClick","{resetForm(\'atributo-form\');}");
					$("#editarAtributoModal").addClass("loading");
				},
			complete: 
				function(){
					$("#editarAtributoModal").removeClass("loading");
					$("#editar-atributo-form-submit").show(500);
					$("#editar-atributo-form-reset").show(500);
				},
			success: 
				function(data) {
					if (data.status == 'failure') {
						$('#editarAtributoModal div.modal-body').html(data.respuesta);
						$('#editarAtributoModal').modal();
						$("#atributo-botones-internos").hide(500);
					}
					else
					{
    					$('#editarAtributoModal div.modal-body').html(data.respuesta);
						$('#editarAtributoModal').modal(); 
					}
				},
		});
	}

	function submitForm(uri, id, modal, grid) {
		<?php echo CHtml::ajax(array(
        	'url'=>array('pctesaurosCe/create'),
			'data'=> "js:$('#'+id).serialize()",
        	'type'=>'post',
        	'dataType'=>'json',
			'beforeSend' => 'function(){
				$("#"+modal+" div.modal-body").addClass("loading");
				$("#"+id+"-submit").hide(500);
				$("#"+id+"-reset").hide(500);
			}',
			'complete' => 'function(){
				$("#"+modal+" div.modal-body").removeClass("loading");
			}',
			'success'=>"function(data)
            {
            	if (data.status == 'failure')
            	{
               		$('#'+modal+' div.modal-body').html(data.respuesta);
					$('#'+id+'-submit').show(500);
					$('#'+id+'-reset').show(500);
					// Here is the trick: on submit-> once again this function!
                    $('#'+modal+' div.modal-body form').submit(formularioNuevoNombreComun);
                }
                else
                {
                    $('#'+modal+' div.modal-body').html(data.respuesta);
					$.fn.yiiGridView.update(grid, {data: $(this).serialize()});
                    setTimeout(\"$('#pctesauros-ce-form-close').click() \",3000);
                }				
            } ",
       	))?>;
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

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'nombreComunMyModal')); ?>
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h4>Agregar nuevo nombre común</h4>
    </div>
 
	<div class="modal-body">
	</div>
 
	<div class="modal-footer">    
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'type'=>'primary',
			'label'=>'Guardar',
			'url'=>array('pctesaurosCe/create'),
			'buttonType'=>'submit',
			'htmlOptions'=>array('onclick'=>"{submitForm('pctesaurosCe/create', 'pctesauros-ce-form', 'nombreComunMyModal', 'nombrescomunesasignados-grid');}", 'id'=>'pctesauros-ce-form-submit'),
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'Limpiar campos',
			'url'=>'#',
			'buttonType'=>'reset',
			'htmlOptions'=>array('onclick'=>'{resetForm(\'pctesauros-ce-form\');}', 'id'=>'pctesauros-ce-form-reset'),
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'Cerrar',
			'url'=>'#',
			'htmlOptions'=>array('data-dismiss'=>'modal', 'id'=>'pctesauros-ce-form-close'),
		)); ?>
	</div>
<?php $this->endWidget(); ?>

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

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'editarAtributoModal')); ?>
	<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h4>Modificar atributo</h4>
    </div>
 
	<div class="modal-body">
	</div>
 
	<div class="modal-footer">    
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'type'=>'primary',
			'label'=>'Guardar',
			'url'=>array('atributovalor/update'),
			'buttonType'=>'submit',
			'htmlOptions'=>array('id'=>'editar-atributo-form-submit'),
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'Limpiar campos',
			'url'=>'#',
			'buttonType'=>'reset',
				'htmlOptions'=>array('id'=>'editar-atributo-form-reset'),
		)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'Cerrar',
			'url'=>'#',
			'htmlOptions'=>array('data-dismiss'=>'modal', 'id'=>'atributo-form-close'),
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
    <li><a href="#tab5" data-toggle="tab">Nombres comunes</a></li>
    <li><a href="#tab6" data-toggle="tab">Distribución geográfica</a></li>
    <li><a href="#tab7" data-toggle="tab">Atributos</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade in active" id="tab1">
    
    <fieldset>
    	<legend>Verificación de la ficha</legend>
    	<?php echo $form->dropDownListRow($model, 'idEstadoVerificacion', $model->ListarEstadosVerificacion()); ?>
    	<?php echo $form->textAreaRow($model, 'comentarioVerificacion', array('class'=>'span8', 'rows'=>5)); ?>
    	<?php echo $form->textFieldRow($model->verificacionce, 'fecha', array('readonly'=>true)); ?>
    	
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
    <div class="tab-pane fade" id="tab5">
    	<script type="text/javascript">
			function formularioNuevoNombreComun() {
				<?php echo CHtml::ajax(array(
            		'url'=>array('pctesaurosCe/create'),
					//'data'=> $model,
            		'data'=> array('catalogoId' => $model->catalogoespecies_id),
            		'type'=>'post',
            		'dataType'=>'json',
					'beforeSend' => 'function(){
						$("#pctesauros-ce-form-submit").show(500);
						$("#pctesauros-ce-form-reset").show(500);
					}',
            		'success'=>"function(data)
            		{
                		if (data.status == 'failure')
                		{
                    		$('#nombreComunMyModal div.modal-body').html(data.respuesta);
		                    // Here is the trick: on submit-> once again this function!
                    		$('#nombreComunMyModal div.modal-body form').submit(formularioNuevoNombreComun);
                		}
                		else
                		{
                    		$('#nombreComunMyModal div.modal-body').html(data.respuesta);
                    		// setTimeout(\"$('#nombreComunMyModal').dialog('close') \",3000);
                		}
 
            		} ",
            	))?>;		
			};
		</script>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Nombres comunes asignados a la ficha',
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
							'label' => 'Agregar nombre común nuevo (no disponible en lista)',
							//'url'=>'#',
							'icon'=>'icon-plus',
							'htmlOptions' => array(
								'onclick'=>'{formularioNuevoNombreComun()}',
								'data-toggle' => 'modal',
								'data-target' => '#nombreComunMyModal',
								//'data'=> "js:$(this).serialize()",
								//'dataType'=>'json',
								/*'ajax' => array(
									'type' => 'POST',
									'url' => $this->createUrl('pctesaurosCe/create', array('val' => 'profile')),
									'success'=>"function(data) {
                									if (data.status == 'failure') {
                    									$('#dialogClassroom div.divForForm').html(data.div);
                          								// Here is the trick: on submit-> once again this function!
                    									$('#dialogClassroom div.divForForm form').submit(addClassroom);
                									} else {
														$('#dialogClassroom div.divForForm').html(data.div);
														setTimeout(\"$('#dialogClassroom').dialog('close') \",3000);
													}
									} ",
								),*/
							),
    					),
					),
    			),
    		)
    	));?>
    	<?php echo $this->renderPartial('_nombres_comunes_asignados_ficha_update_table', array('model'=>$model)); ?>
    	<?php $this->endWidget();?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Nombres comunes disponibles',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('_nombres_comunes_ficha_update_table', array('nombresComunes'=>$nombresComunes,'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    </div>
    <div class="tab-pane fade" id="tab6">
    	<div class="accordion" id="accordion2">
    		<div class="accordion-group">
    			<div class="accordion-heading">
    				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
    					Departamentos
    				</a>
    			</div>
    			<div id="collapseOne" class="accordion-body collapse in">
    				<div class="accordion-inner">
    					<div class="row">
    						<div class="span6 padding-left">
    							<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
									'title' => 'Departamentos asignados a la ficha',
    								'headerIcon' => 'icon-th-list',
    								//'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    							));?>
    							<?php echo $this->renderPartial('_departamentos_asignados_ficha_update_table', array('model'=>$model)); ?>
    							<?php $this->endWidget();?>
    						</div>
    						<div class="span6">
    							<?php echo $this->renderPartial('_departamentos_ficha_update_table', array('departamentos'=>$departamentos, 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    		<div class="accordion-group">
    			<div class="accordion-heading">
    				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
    					Regiones naturales
    				</a>
    			</div>
    			<div id="collapseTwo" class="accordion-body collapse">
    				<div class="accordion-inner">
    					<div class="row">
    						<div class="span6 padding-left">
    							<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
									'title' => 'Regiones naturales asignadas a la ficha',
    								'headerIcon' => 'icon-th-list',
    								//'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    							));?>
    							<?php echo $this->renderPartial('_regiones_naturales_asignadas_ficha_update_table', array('model'=>$model)); ?>
    							<?php $this->endWidget();?>
    						</div>
    						<div class="span6">
    							<?php echo $this->renderPartial('_regiones_naturales_ficha_update_table', array('regionesNaturales'=>$regionesNaturales, 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    		<div class="accordion-group">
    			<div class="accordion-heading">
    				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
    					Corporaciones Autónomas Regionales
    				</a>
    			</div>
    			<div id="collapseThree" class="accordion-body collapse">
    				<div class="accordion-inner">
    					<div class="row">
    						<div class="span6 padding-left">
    							<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
									'title' => 'CAR asignadas a la ficha',
    								'headerIcon' => 'icon-th-list',
    								//'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    							));?>
    							<?php echo $this->renderPartial('_corporaciones_asignadas_ficha_update_table', array('model'=>$model)); ?>
    							<?php $this->endWidget();?>
    						</div>
    						<div class="span6">
    							<?php echo $this->renderPartial('_corporaciones_ficha_update_table', array('corporaciones'=>$corporaciones, 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    		<div class="accordion-group">
    			<div class="accordion-heading">
    				<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
    					Organizaciones
    				</a>
    			</div>
    			<div id="collapseFour" class="accordion-body collapse">
    				<div class="accordion-inner">
    					<div class="row">
    						<div class="span6 padding-left">
    							<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
									'title' => 'Organizaciones asignadas a la ficha',
    								'headerIcon' => 'icon-th-list',
    								//'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    							));?>
    							<?php echo $this->renderPartial('_organizaciones_asignadas_ficha_update_table', array('model'=>$model)); ?>
    							<?php $this->endWidget();?>
    						</div>
    						<div class="span6">
    							<?php echo $this->renderPartial('_organizaciones_ficha_update_table', array('organizaciones'=>$organizaciones, 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div> <!-- Fin tab6, distribucion geográfica -->
    <div class="tab-pane fade" id="tab7">
    	<div id="zona-adicionar-boton" class="pull-right">
    		<?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
    			'size' => 'small',
    			'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    			'buttons' => array(
					array(
						'label' => 'Agregar atributo',
						'url' => '',
						'icon'=>'icon-plus',
						'htmlOptions' => array(
							'id' => 'btnAdicionarAtributo',
							'onclick'=>'{$("#zona-adicionar-atributos").show();$("#btnAdicionarAtributo").addClass("disabled");}',
						),
					),
				)
    		)); ?>
    	</div>
    	<div id="zona-adicionar-atributos" style="display: none;">
    		<?php echo $this->renderPartial('_adicionar_atributos', array('idCatalogo'=>$model->catalogoespecies_id)); ?>
    	</div>
    	<div id="zona-lista-atributos">
    		<?php echo $this->renderPartial('_atributos_listado', array('atributos'=>$atributos, 'model'=>$model)); ?>
    	</div>
    </div> <!-- Fin tab7 -->
  </div>
</div>
<div class="form-actions pull-right">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>$model->isNewRecord ? 'Guardar' : 'Actualizar')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Limpiar campos')); ?>
    <?php //$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Cancelar', 'submit'=>array('catalogo/index'))); ?>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
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
			  // Tabla nombres comunes
			  if(target.id == "PctesaurosCe_id_tesauros") {
				  event.preventDefault();
				  $("#PctesaurosCe_id_tesauros").trigger("change");
				  return false;
			  }
			  if(target.id == "PctesaurosCe_tesauronombre") {
				  event.preventDefault();
				  $("#PctesaurosCe_tesauronombre").trigger("change");
				  return false;
			  }
			  if(target.id == "PctesaurosCe_grupohumano") {
				  event.preventDefault();
				  $("#PctesaurosCe_grupohumano").trigger("change");
				  return false;
			  }
			  if(target.id == "PctesaurosCe_idioma") {
				  event.preventDefault();
				  $("#PctesaurosCe_idioma").trigger("change");
				  return false;
			  }
			  if(target.id == "PctesaurosCe_regionesgeograficas") {
				  event.preventDefault();
				  $("#PctesaurosCe_regionesgeograficas").trigger("change");
				  return false;
			  }
			  if(target.id == "PctesaurosCe_tesaurocompleto") {
				  event.preventDefault();
				  $("#PctesaurosCe_tesaurocompleto").trigger("change");
				  return false;
			  }
			  //Tabla departamentos
			  if(target.id == "Departamentos_id_departamento") {
				  event.preventDefault();
				  $("#Departamentos_id_departamento").trigger("change");
				  return false;
			  }
			  if(target.id == "Departamentos_departamento") {
				  event.preventDefault();
				  $("#Departamentos_departamento").trigger("change");
				  return false;
			  }
			  // Tabla corporaciones
			  if(target.id == "Corporaciones_id_corporacion") {
				  event.preventDefault();
				  $("#Corporaciones_id_corporacion").trigger("change");
				  return false;
			  }
			  if(target.id == "Corporaciones_corporacion") {
				  event.preventDefault();
				  $("#Corporaciones_corporacion").trigger("change");
				  return false;
			  }
			  // Tabla regiones naturales
			  if(target.id == "Regionesnaturales_id_region_natural") {
				  event.preventDefault();
				  $("#Regionesnaturales_id_region_natural").trigger("change");
				  return false;
			  }
			  if(target.id == "Regionesnaturales_region_natural") {
				  event.preventDefault();
				  $("#Regionesnaturales_region_natural").trigger("change");
				  return false;
			  }
			  // Organizaciones
			  if(target.id == "Organizaciones_id_organizacion") {
				  event.preventDefault();
				  $("#Organizaciones_id_organizacion").trigger("change");
				  return false;
			  }
			  if(target.id == "Organizaciones_organizacion") {
				  event.preventDefault();
				  $("#Organizaciones_organizacion").trigger("change");
				  return false;
			  }
		  } 
	  });
	});

</script>

<?php
	// Include jquery-fineuploader for file upload support
	Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery-fineuploader/jquery.fineuploader-3.6.3.min.js', CClientScript::POS_HEAD);
?>