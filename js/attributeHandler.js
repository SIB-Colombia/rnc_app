$("#Atributos_tipoAtributo").change(function() {
   $("#form_referencias_bibliograficas_attribute").addClass("hide-element");
   $("#form_creditos_attribute").addClass("hide-element");
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
      } else if(stringExploded[1] == 'multi') {
         if(stringExploded[0] == 2) {
            $("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Estado de amenaza según categorías UICN</label><div class="controls"><input id="estado-amenaza-categorias-uicn-colombia" name="Atributos[2]-Colombia" id="attribute" type="checkbox"> En Colombia</div></div><div class="control-group "><div class="controls"><select id="estado-amenaza-categorias-uicn-colombia-selection" multiple="multiple"><option value="49">A1a</option><option value="50">A1b</option><option value="51">A1c</option><option value="52">A1d</option><option value="53">A1e</option><option value="54">A2a</option><option value="55">A2b</option><option value="56">A2c</option><option value="57">A2d</option><option value="58">A2e</option><option value="59">A3a</option><option value="60">A3b</option><option value="61">A3c</option><option value="62">A3d</option><option value="63">A3e</option><option value="64">A4a</option><option value="65">A4b</option><option value="66">A4c</option><option value="67">A4d</option><option value="68">A4e</option><option value="69">B1a</option><option value="70">B1b(i)</option><option value="71">B1b(ii)</option><option value="72">B1b(iii)</option><option value="73">B1b(iv)</option><option value="74">B1b(v)</option><option value="75">B1c(i)</option><option value="76">B1c(ii)</option><option value="77">B1c(iii)</option><option value="78">B1c(iv)</option><option value="79">B2a</option><option value="80">B2b(i)</option><option value="81">B2b(ii)</option><option value="82">B2b(iii)</option><option value="83">B2b(iv)</option><option value="84">B2b(v)</option><option value="84">B2b(v)</option><option value="84">B2b(v)</option><option value="84">B2b(v)</option><option value="84">B2b(v)</option><option value="85">B2c(i)</option><option value="86">B2c(ii)</option><option value="87">B2c(iii)</option><option value="88">B2c(iv)</option><option value="89">C1</option><option value="90">C2a(i)</option><option value="91">C2a(ii)</option><option value="92">C2b</option><option value="98">CR (en peligro crítico)</option><option value="93">D1</option><option value="94">D2</option><option value="100">DD</option><option value="43">EN (en peligro)</option><option value="151">EW (Extinto en estado silvestre)</option><option value="96">EX (extinto)</option><option value="99">LC (preocupación menor)</option><option value="101">NE</option><option value="45">NT (casi amenzada)</option><option value="44">VU (vulnerable)</option></select></div></div><div class="control-group"><div class="controls"><input id="estado-amenaza-categorias-uicn-mundo" name="Atributos[2]-Colombia" id="attribute" type="checkbox"> En el mundo</div></div><div class="control-group"><div class="controls"><select id="estado-amenaza-categorias-uicn-mundo-selection" name="mundo" multiple="multiple"><option value="49">A1a</option><option value="50">A1b</option><option value="51">A1c</option><option value="52">A1d</option><option value="53">A1e</option><option value="54">A2a</option><option value="55">A2b</option><option value="56">A2c</option><option value="57">A2d</option><option value="58">A2e</option><option value="59">A3a</option><option value="60">A3b</option><option value="61">A3c</option><option value="62">A3d</option><option value="63">A3e</option><option value="64">A4a</option><option value="65">A4b</option><option value="66">A4c</option><option value="67">A4d</option><option value="68">A4e</option><option value="69">B1a</option><option value="70">B1b(i)</option><option value="71">B1b(ii)</option><option value="72">B1b(iii)</option><option value="73">B1b(iv)</option><option value="74">B1b(v)</option><option value="75">B1c(i)</option><option value="76">B1c(ii)</option><option value="77">B1c(iii)</option><option value="78">B1c(iv)</option><option value="79">B2a</option><option value="80">B2b(i)</option><option value="81">B2b(ii)</option><option value="82">B2b(iii)</option><option value="83">B2b(iv)</option><option value="84">B2b(v)</option><option value="84">B2b(v)</option><option value="84">B2b(v)</option><option value="84">B2b(v)</option><option value="84">B2b(v)</option><option value="85">B2c(i)</option><option value="86">B2c(ii)</option><option value="87">B2c(iii)</option><option value="88">B2c(iv)</option><option value="89">C1</option><option value="90">C2a(i)</option><option value="91">C2a(ii)</option><option value="92">C2b</option><option value="98">CR (en peligro crítico)</option><option value="93">D1</option><option value="94">D2</option><option value="100">DD</option><option value="43">EN (en peligro)</option><option value="151">EW (Extinto en estado silvestre)</option><option value="96">EX (extinto)</option><option value="99">LC (preocupación menor)</option><option value="101">NE</option><option value="45">NT (casi amenzada)</option><option value="44">VU (vulnerable)</option></select></div></div>');
         }
         $("#btnGuardarAtributo").show();
         $("#btnCancelarGuardarAtributo").show();
      } else if(stringExploded[1] == 'dropdown') {
         if(stringExploded[0] == 5) {
            $("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">Estado CITES</label><div class="controls"><select id="attribute" name="Atributos[5]"><option value="46">Apéndice I</option><option value="47">Apéndice II</option><option value="48">Apéndice III</option></select></div></div>');
         }
         if(stringExploded[0] == 6784) {
            $("#form-attibute-selected").html('<div class="control-group "><label class="control-label" for="attribute">¿Es invasora?</label><div class="controls"><select id="attribute" name="Atributos[6784]"><option value="6789">Si</option><option value="NO">No</option></select></div></div>');
         }
         if(stringExploded[0] == 28) {
            $("#form-attibute-selected").html('');
            $("#form_referencias_bibliograficas_attribute").removeClass("hide-element");
         }
         if(stringExploded[0] == 19) {
            $("#form-attibute-selected").html('');
            $("#form_creditos_attribute").removeClass("hide-element");
         }
         if(stringExploded[0] == 20) {
            $("#form-attibute-selected").html('');
            $("#form_creditos_attribute").removeClass("hide-element");
         }
         if(stringExploded[0] == 24) {
            $("#form-attibute-selected").html('');
            $("#form_creditos_attribute").removeClass("hide-element");
         }
         if(stringExploded[0] == 25) {
            $("#form-attibute-selected").html('');
            $("#form_creditos_attribute").removeClass("hide-element");
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