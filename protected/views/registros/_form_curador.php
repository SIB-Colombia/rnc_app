<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/jquery.dataTables.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.dataTables.js', CClientScript::POS_HEAD);
?>
<script type="text/javascript">
var table;
var curadores = [];
$(document).ready(function() {
	//<?=Yii::app()->createUrl('registros/curadores')?>
	
    table = $('#curadores_table').DataTable( {
        "ajax": "<?=Yii::app()->createUrl('registros/curadores?idRegistro='.$registro->id)?>",
        "columns": [
            { "data": "nombre" },
            { "data": "cargo" },
            { "data": "telefono" },
            { "data": "email" },
            { "data": "pagina_web" },
            { "data": "grupo_taxonomico" },
            { "data": "subgrupo_taxonomico" }
        ]
    } );
} );

function adicionarCurador(){
	var name  = $("#Curador_nombre").val();
	var cargo = $("#Curador_cargo").val();
	var phone = $("#Curador_telefono").val();
	var email = $("#Curador_email").val();
	var web   = $("#Curador_pagina_web").val();
	var grupo = $("#Grupo_Taxonomico_nombre").val();
	var grupoElement = document.getElementById("Grupo_Taxonomico_nombre");
	var subgrupoElement = document.getElementById("Curador_subgrupo_taxonomico_id");
	var subgrupo = $("#Curador_subgrupo_taxonomico_id").val();
	var save = true;
	var curador = {
		name: "",
		cargo: "",
		phone: "",
		email: "",
		web: "",
		grupo: "",
		subgrupo: ""
	};

	if (name != undefined && name.replace(/ /gi,"") !== "" ){
		curador.name = name;
		
	}else{
		alert("El campo \"Persona de contacto\" es incorrecto o nulo");
		$("#Curador_nombre").focus();
		save = false;
	}

	if (cargo != undefined && cargo.replace(/ /gi,"") !== "" ){
		curador.cargo = cargo;
	}else{
		alert("El campo \"cargo\" es incorrecto o nulo");
		$("#Curador_cargo").focus();
		save = false;
	}

	if (phone != undefined && phone.replace(/ /gi,"") !== "" ){
		curador.phone = phone;
	}else{
		alert("El campo \"Teléfono\" es incorrecto o nulo");
		$("#Curador_telefono").focus();
		save = false;
	}
	if (email != undefined && email.replace(/ /gi,"") !== "" ){
		curador.email = email;
	}else{
		alert("El campo \"Correo Electrónico\" es incorrecto o nulo");
		$("#Curador_email").focus();
		save = false;
	}
	
	curador.web = web;
	curador.grupo = grupo;
	
	if (subgrupo != undefined && subgrupo.replace(/ /gi,"") !== "" ){
		curador.subgrupo = subgrupo;
	}else{
		alert("El campo \"Subgrupo biológico\" es incorrecto o nulo");
		$("#Curador_subgrupo_taxonomico_id").focus();
		save = false;
	}

	if (save){

		curadores.push(curador);
		$("#Registros_update_curadores").val(JSON.stringify(curadores));
		table.row.add({
			"nombre" : name,
			"cargo" : cargo,
			"telefono" : phone,
			"email" : email,
			"pagina_web" : web,
			"grupo_taxonomico" : grupoElement.options[grupoElement.selectedIndex].text,
			"subgrupo_taxonomico" :  subgrupoElement.options[subgrupoElement.selectedIndex].text,
		}).draw();
		clearFormCurador();
	}
}
function clearFormCurador(){
	$("#Curador_nombre").val("");
	$("#Curador_cargo").val("");
	$("#Curador_telefono").val("");
	$("#Curador_email").val("");
	$("#Curador_pagina_web").val("");
	$("#Grupo_Taxonomico_nombre").val("");
	$("#Curador_subgrupo_taxonomico_id").val("");
} 
</script>
<?php 
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		'id'=>'registroCurador-form',
		'type'=>'horizontal',
		'enableClientValidation'=>true,
		'enableAjaxValidation'=>false,
));
?>
<p class="note">Ingrese los siguientes datos para adicionar un nuevo curador:</p>

<?php 
	echo $form->textFieldRow($model, 'nombre', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA', 'required' => true));
	echo '<i class="icon-info-sign" rel="tooltip" title = "Persona o personas de contacto que están asociadas a la colección. Sirven como punto de enlace con usuarios, especialistas e interesados en la colección biológica."></i>';
	echo $form->textFieldRow($model, 'cargo', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA', 'required' => true));
	echo '<i class="icon-info-sign" rel="tooltip" title = "Persona o personas de contacto que están asociadas a la colección. Sirven como punto de enlace con usuarios, especialistas e interesados en la colección biológica."></i>';
	echo $form->textFieldRow($model, 'telefono', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA', 'required' => true));
	echo '<i class="icon-info-sign" rel="tooltip" title = "Persona o personas de contacto que están asociadas a la colección. Sirven como punto de enlace con usuarios, especialistas e interesados en la colección biológica."></i>';
	echo $form->textFieldRow($model, 'email', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA', 'required' => true));
	echo '<i class="icon-info-sign" rel="tooltip" title = "Persona o personas de contacto que están asociadas a la colección. Sirven como punto de enlace con usuarios, especialistas e interesados en la colección biológica."></i>';
	echo $form->textFieldRow($model, 'pagina_web', array('size'=>32,'maxlength'=>2000, 'class'=>'textareaA','prepend'=>'http://'));
	echo '<i class="icon-info-sign" rel="tooltip" title = "URL o vínculo de la colección virtual o del sitio en Internet donde se encuentra la información sobre la colección."></i>';
	echo $form->dropDownListRow(Grupo_Taxonomico::model(), 'nombre', Grupo_Taxonomico::model()->listarGrupoTaxonomico(),array('onchange' => 'actSelectSubgrupo(this,"Curador_subgrupo_taxonomico_id")','prompt' => 'Seleccionar...'));
	echo $form->dropDownListRow($model, 'subgrupo_taxonomico_id', Subgrupo_Taxonomico::model()->listarSubgrupoTaxonomico(),array('prompt' => 'Seleccionar...', 'required' => true));
?>
<div id="catalogouser-botones-internos" class="form-actions pull-right">
<?php 
	$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'id'=>'registro-cancel-form-submit', 'type'=>'success', 'label'=>'Adicionar curador', 'htmlOptions' => array('onclick' => 'adicionarCurador()')));
?>
</div>
<?php $this->endWidget(); ?>