<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
Yii::app()->theme = 'rnc_theme';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<div class="col-lg-10">
	<div class="area-contenido">
		<div id="content">
			<div id="header-front">Guía e instrutivo</div>
			<div class="panel panel-default">
			  <div class="panel-heading">Documentos para descargar</div>
			  <div class="panel-body">
			  	<ul>
			  		<li>Guía de registro y actualización de colecciones biológicas Versión 2.0  <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'type'=>'success','label'=>'Descargar','htmlOptions' => array('class'=>'btn btn-success btn-xs','onclick' => 'window.location="'.Yii::app()->createUrl("site/archivoAuto").'"')));?></li>
			  		<li>Formato de autodeclaración Versión 2.0 <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'type'=>'success','label'=>'Descargar','htmlOptions' => array('class'=>'btn btn-success btn-xs','onclick' => 'window.location="'.Yii::app()->createUrl("site/archivoInstructivo").'"')));?></li>
			  	</ul>
			  </div>
			</div>
			<div class="panel panel-default">
			  <div class="panel-heading">Procedimiento de registro</div>
			  <div class="panel-body">
			  	<ul class="numeral">
			  		<li>Consultar instructivo</li>
			  		<li>Obtener credenciales</li>
			  		<li>Ingresar</li>
			  		<li>Diligenciar formulario</li>
			  		<li>Anexar soportes:</li>
			  		<ul>
			  			<li>Certificado de existencia y representación legal</li>
			  			<li>Copia de la cédula del titular</li>
			  			<li>Formato de autodeclaración</li>
			  			<li>Documentos que acrediten la obtención legal de los espcímenes</li>
			  			<li>Documento de creación de la colección</li>
			  			<li>Protocolo de manejo</li>
			  		</ul>
			  		<li>Enviar</li>
			  	</ul>
			  </div>
			</div>
			<div class="panel panel-default">
			  <div class="panel-heading">Procedimiento de actualización de registro</div>
			  <div class="panel-body">
			  	<ul class="numeral">
			  		<li>Consultar instructivo</li>
			  		<li>Ingresar con las credenciales asignadas</li>
			  		<li>Diligenciar formulario</li>
			  		<li>Anexar soportes:</li>
			  		<ul>
			  			<li>Certificado de existencia y representación legal</li>
			  			<li>Copia de la cédula del titular</li>
			  			<li>Formato de autodeclaración</li>
			  			<li>Documentos que acrediten la obtención legal de los espcímenes</li>
			  		</ul>
			  		<li>Enviar</li>
			  	</ul>
			  </div>
			</div>
		</div>
	</div>
</div>