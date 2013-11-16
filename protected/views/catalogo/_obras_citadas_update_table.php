<script type="text/javascript">
<!--
	function submitFormCitacionUpdate(id, modal, grid) {
		<?php echo CHtml::ajax(array(
			'url'=>"js:$('#citacion-form').attr('action')",
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
					if($('#Catalogoespecies_citacion_id').val() == data.idCita) {
						$('#Catalogoespecies_tituloCita').val(data.tituloCita);
						$('#Catalogoespecies_autorCita').val(data.autorCita);
					}
					$.fn.yiiGridView.update(grid, {data: $(this).serialize()});
                	setTimeout(\"$('#citacion-form-close').click() \",3000);
            	}				
        	}",
   		))?>;	
	}

	function callAjaxUpdateCitation(url) {
		$.ajax({
			url: <?php echo "'".Yii::app()->createUrl("citacion/update")."/'";?>+url,
			type: 'post',
		    dataType: 'json',
		    beforeSend: 
			    function(){
					$("#adicionarEditarCitaModal div.modal-header h4").text("Modificar citación");
					$("#citacion-form-submit").hide(500);
					$("#citacion-form-reset").hide(500);
					$("#citacion-form-submit").attr("onClick","{submitFormCitacionUpdate(\'citacion-form\', \'adicionarEditarCitaModal\', \'citaciones-grid\');}");
					$("#adicionarEditarCitaModal").addClass("loading");
				},
			complete: 
				function(){
					$("#adicionarEditarCitaModal").removeClass("loading");
					$("#citacion-form-submit").show(500);
					$("#citacion-form-reset").show(500);
				},
			success: 
				function(data) {
					if (data.status == 'failure') {
						$('#adicionarEditarCitaModal div.modal-body').html(data.respuesta);
						$('#adicionarEditarCitaModal').modal();
						$("#citacion-botones-internos").hide(500);
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
    'id'=>'citaciones-grid',
    'dataProvider'=>$citaciones->search(),
    'filter'=>$citaciones,
	'ajaxUrl'=>array('catalogo/updateajaxmodifytables'),
    'columns'=>array(
    	array(
    		'class'=>'bootstrap.widgets.TbButtonColumn',
    		'template'=>'{seleccionar}',
    		'buttons'=>array (
    			'seleccionar' => array (
    				'label'=>'Seleccionar',
    				'click'=>'js:function(){$("#Catalogoespecies_citacion_id").val($(this).parent().parent().children(":nth-child(2)").text());$("#Catalogoespecies_tituloCita").val($(this).parent().parent().children(":nth-child(4)").text());$("#Catalogoespecies_autorCita").val($(this).parent().parent().children(":nth-child(5)").text());}'
    			),
    		),
    	),
    	array( 'name'=>'citacion_id', 'htmlOptions'=>array('width'=>'80')),
		'fecha',
		'documento_titulo',
		'autor',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'buttons'=>array (
				'update' => array (
					'label'=>'Modificar',
					'url'=>'Yii::app()->createUrl("citacion/update", array("id"=>$data["citacion_id"]))',
					'options'=>array(
						'onClick'=>'callAjaxUpdateCitation($(this).parent().parent().children(":nth-child(2)").text());',
						'data-toggle' => 'modal',
						'data-target' => '#adicionarEditarCitaModal',
					),
				),
			),
		),
	),
)); ?>