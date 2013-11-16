<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
'id'=>'newAttributeConfirmation',
// additional javascript options for the dialog plugin
'options'=>array(
    //'title'=>'Mensaje',
    'autoOpen'=>false,
	'modal'=>true,
    'buttons' => array(
        array('text'=>'Cerrar','click'=> 'js:function(){$(this).dialog("close");}'),
    ),
),
));
 
echo '<div id="newAttributeConfirmation-content">dialog content here</div>';
 
$this->endWidget('zii.widgets.jui.CJuiDialog'); ?>


<script type="text/javascript">
<!--
	function saveAttribute(labelAttribute) {
		var dataObject = {};
		dataObject["labelAttribute"] = labelAttribute;
		dataObject["idCatalog"] = <?php echo $idCatalogo; ?>;
		dataObject["value"] = $('#attribute').val();
		dataObject["attributeName"] = $('#Atributos_tipoAtributo option:selected').text();
		$.ajax({
			url: <?php echo "'".Yii::app()->createUrl("atributovalor/create").'/'.$idCatalogo."'";?>,
			type: 'post',
			data: dataObject,
		    dataType: 'json',
		    beforeSend: 
			    function(){
		    		$("#zona-adicionar-atributos").addClass("loading");
				},
			complete: 
				function(){
					$("#zona-adicionar-atributos").removeClass("loading");
					$("#btnGuardarAtributo").hide();
					$("#btnCancelarGuardarAtributo").hide();
					$("#Atributos_tipoAtributo").prop("selectedIndex",0);
					$("#zona-adicionar-atributos").hide();
					$("#btnAdicionarAtributo").removeClass("disabled");
				},
			success: 
				function(data) {
					if (data.status == 'failure') {
						$("#newAttributeConfirmation-content").html(data.respuesta);
						$("#zona-adicionar-atributos").hide();
						$("#Atributos_tipoAtributo").val("");
						$("#newAttributeConfirmation").dialog("open");
					}
					else
					{
						$("#newAttributeConfirmation-content").html(data.respuesta);
						$("#zona-lista-atributos").html(data.newAttributeList);
						$("#form-attibute-selected").html("");
						$("#newAttributeConfirmation").dialog("open");
					}
				},
		});
	}
//-->
</script>

<div class="control-group ">
	<h5>Elija el atributo que desea agregar:</h5>
	<label class="control-label" for="Atributos_label_elegir_atributo">
		Atributo
	</label>
	<div class="controls">
		<select name="Atributos[tipoAtributo]" id="Atributos_tipoAtributo">
			<option value>Seleccione</option>
			<optgroup label="Etimología del nombre científico">
				<option value="30:text">Etimología del nombre científico</option>
			</optgroup>
			<optgroup label="Distribución">
				<option value="8:text">Distribución geográfica en Colombia</option>
				<option value="148:text">Distribución geográfica en el mundo</option>
				<option value="11:text">Región natural</option>
				<option value="10:text">Ecosistema</option>
				<option value="1:text">Distribución altitudinal</option>
				<option value="149:text">Registros biológicos</option>
			</optgroup>
			<optgroup label="Historia Natural">
				<option value="36:text">Descripción general</option>
				<option value="31:text">Hábitat</option>
				<option value="903:text">Hábito</option>
				<option value="904:text">Origen</option>
				<option value="22:text">Alimentación</option>
				<option value="26:text">Comportamiento</option>
				<option value="32:text">Vocalizaciones</option>
				<option value="35:text">Reproducción</option>
				<option value="17:text">Ecología</option>
			</optgroup>
			<optgroup label="Invasión">
				<option value="6784:dropdown">Invasora</option>
				<option value="3529:text">Descripción de la invasión</option>
				<option value="3530:text">Impactos</option>
				<option value="3531:text">Mecanismos de control</option>
			</optgroup>
			<optgroup label="Taxonomía">
				<option value="12:text">Descripción taxonómica</option>
				<option value="150:text">Información de tipos</option>
				<option value="27:text">Claves taxonómicas</option>
			</optgroup>
			<optgroup label="Estado de conservación">
				<option value="2:multi">Estado de amenaza según categorías UICN</option>
				<option value="5:dropdown">Estado CITES</option>
				<option value="7:text">Estado actual de la población</option>
				<option value="6:text">Factores de amenaza</option>
				<option value="16:text">Medidas de conservación</option>
			</optgroup>
			<optgroup label="Uso y tráfico">
				<option value="14:text">Información de usos</option>
				<option value="15:text">Información de alerta</option>
			</optgroup>
			<optgroup label="Más información">
				<option value="437:text">Metadatos</option>
				<option value="18:text">Otros recursos en Internet</option>
				<option value="28:dropdown">Referencias bibliográficas</option>
				<option value="21:text">Recursos multimedia</option>
				<option value="32210:text">Sinónimos</option>	
			</optgroup>
			<optgroup label="Créditos">
				<option value="19:dropdown">Autor(es)</option>
				<option value="20:dropdown">Editor(es)</option>
				<option value="25:dropdown">Revisor(es)</option>
				<option value="24:dropdown">Colaborador(es)</option>
				<option value="436:text">Créditos específicos</option>
			</optgroup>
			<optgroup label="Multimedia">
				<option value="39:upload">Imagen</option>
				<option value="40:upload">Mapa</option>
				<option value="41:upload">Video</option>
				<option value="42:upload">Sonido</option>
			</optgroup>			
		</select>
		<span class="help-inline error" id="Catalogoespecies_idEstadoVerificacion_em_" style="display: none"></span>
	</div>
</div>

<div id="form-attibute-selected"></div>
<div class="control-group">
	<div class="controls">
		<?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
    		'size' => 'small',
    		'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    		'buttons' => array(
				array(
					'label' => 'Cancelar',
					'url' => '',
					'icon'=>'icon-remove-circle',
					'htmlOptions' => array(
						'id' => 'btnCancelarGuardarAtributo',
						'style' => 'display: none;',
						'onclick'=>'{$("#form-attibute-selected").html("");$("#btnGuardarAtributo").hide();$("#btnCancelarGuardarAtributo").hide();$("#Atributos_tipoAtributo").prop("selectedIndex",0);$("#zona-adicionar-atributos").hide();$("#btnAdicionarAtributo").removeClass("disabled");}',
					),
				),
			)
    	)); ?>	
		<?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
    		'size' => 'small',
    		'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    		'buttons' => array(
				array(
					'label' => 'Guardar',
					'url' => '',
					'icon'=>'icon-ok-sign',
					'htmlOptions' => array(
						'id' => 'btnGuardarAtributo',
						'style' => 'display: none;',
						'onclick'=>'{saveAttribute($("#Atributos_tipoAtributo option:selected").val().split(":")[0]);}',
					),
				),
			)
    	)); ?>
    </div>
</div>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/attributeHandler.js', CClientScript::POS_END); ?>