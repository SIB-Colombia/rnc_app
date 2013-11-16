<script type="text/javascript">
<!--
	function submitFormContactoUpdate(id, modal, grid) {
		<?php echo CHtml::ajax(array(
			'url'=>"js:$('#contactos-form').attr('action')",
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
                	$('#'+modal+' div.modal-body').html(data.respuesta);
					if($('#Catalogoespecies_contacto_id').val() == data.idContacto) {
						$('#Catalogoespecies_personaContacto').val(data.nombreContacto);
						$('#Catalogoespecies_organizacionContacto').val(data.organizacion);
					}
					$.fn.yiiGridView.update(grid, {data: $(this).serialize()});
                	setTimeout(\"$('#contactos-form-close').click() \",3000);
            	}				
        	}",
   		))?>;	
	}

	function callAjaxUpdateContacto(url) {
		$.ajax({
			url: <?php echo "'".Yii::app()->createUrl("contactos/update")."/'";?>+url,
			type: 'post',
		    dataType: 'json',
		    beforeSend: 
			    function(){
					$("#adicionarEditarContactoModal div.modal-header h4").text("Modificar contacto");
					$("#contactos-form-submit").hide(500);
					$("#contactos-form-reset").hide(500);
					$("#contactos-form-submit").attr("onClick","{submitFormContactoUpdate(\'contactos-form\', \'adicionarEditarContactoModal\', \'contactos-grid\');}");
					$("#adicionarEditarContactoModal").addClass("loading");
				},
			complete: 
				function(){
					$("#adicionarEditarContactoModal").removeClass("loading");
					$("#contactos-form-submit").show(500);
					$("#contactos-form-reset").show(500);
				},
			success: 
				function(data) {
					if (data.status == 'failure') {
						$('#adicionarEditarContactoModal div.modal-body').html(data.respuesta);
						$('#adicionarEditarContactoModal').modal();
						$("#contactos-botones-internos").hide(500);
					}
					else
					{
    					$('#adicionarEditarCitaModal div.modal-body').html(data.respuesta);
						$('#adicionarEditarCitaModal').modal(); 
					}
				},
		});
	}
//-->
</script>

<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'type'=>'striped bordered condensed',
    'id'=>'contactos-grid',
    'dataProvider'=>$contactos->search(),
    'filter'=>$contactos,
	'ajaxUrl'=>array('catalogo/updateajaxmodifytables'),
    'columns'=>array(
    	array(
    		'class'=>'bootstrap.widgets.TbButtonColumn',
    		'template'=>'{seleccionar}',
    		'buttons'=>array (
    			'seleccionar' => array (
    				'label'=>'Seleccionar',
    				'click'=>'js:function(){$("#Catalogoespecies_contacto_id").val($(this).parent().parent().children(":nth-child(2)").text());$("#Catalogoespecies_personaContacto").val($(this).parent().parent().children(":nth-child(3)").text());$("#Catalogoespecies_organizacionContacto").val($(this).parent().parent().children(":nth-child(4)").text());}'
    			),
    		),
    	),
    	array( 'name'=>'contacto_id', 'htmlOptions'=>array('width'=>'80')),
		'persona',
    	'organizacion',
    	'cargo',
		'direccion',
		'telefono',
    	'correo_electronico',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'buttons'=>array (
				'update' => array (
					'label'=>'Modificar',
					'url'=>'Yii::app()->createUrl("contactos/update", array("id"=>$data["contacto_id"]))',
					'options'=>array(
						'onClick'=>'callAjaxUpdateContacto($(this).parent().parent().children(":nth-child(2)").text());',
						'data-toggle' => 'modal',
						'data-target' => '#adicionarEditarContactoModal',
					),
				),
			),
		),
	),
)); ?>