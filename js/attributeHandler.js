$("#Atributos_tipoAtributo").change(function(){
	var originalString = this.value; 
   	var stringExploded = originalString.split(":");
   	if(stringExploded[1] == 'text') {
   		if(stringExploded[0] == 30) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Etimología del nombre científico</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[30]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 8) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Distribución geográfica en Colombia</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[8]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 148) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Distribución geográfica en el mundo</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[148]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 11) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Región natural</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[11]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 10) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Ecosistema</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[10]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 1) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Distribución altitudinal</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[1]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 149) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Registros biológicos</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[149]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 36) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Descripción general</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[36]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 31) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Hábitat</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[31]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 903) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Hábito</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[903]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 904) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Origen</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[904]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 22) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Alimentación</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[22]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 26) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Comportamiento</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[26]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 32) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Vocalizaciones</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[32]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 35) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Reproducción</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[35]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 17) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Ecología</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[17]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 3529) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Descripción de la invasión</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[3529]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 3530) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Impactos</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[3530]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 3531) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Mecanismos de control</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[3531]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 12) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Descripción taxonómica</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[12]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 150) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Información de tipos</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[150]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 27) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Claves taxonómicas</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[27]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 7) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Estado actual de la población</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[7]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 6) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Factores de amenaza</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[6]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 16) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Medidas de conservación</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[16]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 14) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Información de usos</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[14]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 15) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Información de alerta</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[15]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 437) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Metadatos</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[437]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 18) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Otros recursos en Internet</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[18]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 21) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Recursos multimedia</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[21]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 32210) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Sinónimos</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[32210]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		} else if(stringExploded[0] == 436) {
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Créditos específicos</label><div class="controls"><textarea class="span8" rows="10" name="Atributos[436]" id="attribute"></textarea></div></div>');
   			$('#attribute').wysihtml5();
   		}
   		$("#btnGuardarAtributo").show();
		$("#btnCancelarGuardarAtributo").show();
   	} else if(stringExploded[1] == 'upload') {
   		if(stringExploded[0] == 39) {
   			// We are working with image attribute
   			$("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Archivo</label><div class="controls"><div id="fineUploaderElementImage"></div></div></div>');
   			$('#fineUploaderElementImage').fineUploader({
   			    request: {
   			        endpoint: '/upload/endpoint'
   			    },
   			    text: {
		        	uploadButton: '<div><i class="icon-upload icon-white"></i> Arrastre el archivo u oprima este botón</div>'
		        },
		        template: '<div class="qq-uploader span12">' +
		        		  '<pre class="qq-upload-drop-area span12"><span>{dragZoneText}</span></pre>' +
		        		  '<div class="qq-upload-button btn btn-success" style="width: auto;">{uploadButtonText}</div>' +
		        		  '<span class="qq-drop-processing"><span>{dropProcessingText}</span><span class="qq-drop-processing-spinner"></span></span>' +
		        		  '<ul class="qq-upload-list" style="margin-top: 10px; text-align: center;"></ul>' +
		        		  '</div>',
		        classes: {
		        	success: 'alert alert-success',
		        	fail: 'alert alert-error'
		        },
   			});
   			$("#btnGuardarAtributo").show();
   			$("#btnCancelarGuardarAtributo").show();
   		} else if(stringExploded[0] == 40) {
   			// We are working with map attribute
   		} else if(stringExploded[0] == 41) {
			// We are working with video attribute
		} else if(stringExploded[0] == 42) {
			// We are working with sound attribute
		}
   	}
});