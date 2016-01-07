<?php
$this->pageTitle=Yii::app()->name;
Yii::app()->theme = 'rnc_theme';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<div class="col-lg-12">
	<div class="area-contenido">
		<div id="content">
			<div id="header-front">Artículo 252 de la Ley 1753 de 2015</div>
			<div class="panel panel-default">
			  <div class="panel-heading"><h4>Documentos para descargar</h4></div>
			  <div class="panel-body">
			  	<ul>
			  		<li>Certificado de autodeclaración aplicación artículo 252 de la Ley 1753 de 2015  <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'type'=>'success','label'=>'Descargar','htmlOptions' => array('class'=>'btn btn-success btn-xs','onclick' => 'window.location="'.Yii::app()->createUrl("site/archivoCertificadoAuto").'"')));?></li>
			  		<li>Plantilla de información asociada a los especímenes a registrar <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'type'=>'success','label'=>'Descargar','htmlOptions' => array('class'=>'btn btn-success btn-xs','onclick' => 'window.location="'.Yii::app()->createUrl("site/archivoPlantilla").'"')));?></li>
			  	</ul>
			  </div>
			</div>
			<div class="panel panel-default">
			  <div class="panel-heading"><h4>Ley 1753 de 2015</h4></div>
			  <div class="panel-body">
			  	<h4>El Instituto de Investigación de Recursos Biológicos Alexander von Humboldt informa a la comunidad en general el procedimiento para la implementación del artículo 252 de la Ley 1753 de 2015 en lo relacionado con el registro de material de las colecciones biológicas:</h4>
			  	<p>La Ley 1753 de 2015, por la cual se expide el Plan Nacional de Desarrollo 2014-2018 “Todos por un nuevo país”, en el artículo 252 establece:</p>
			  	<div class="jumbotron">
			  		<p >“[...] Aquellas colecciones biológicas existentes a 25 de febrero de 2000, que no puedan acreditar el material obtenido en el marco de actividades de recolección, de proyectos de investigación científica y/o prácticas docentes universitarias finalizadas, podrán registrar por única vez dicho material ante el Instituto de Investigación Alexander von Humboldt, dentro del año siguiente a la publicación de la presente ley y de conformidad con los parámetros previstos en las normas que regulan la materia”.</p>
			  	</div>
			  	<p>El Instituto Humboldt realizará la implementación de esta directriz según el alcance descrito a continuación:</p>
			  	<ul class="number-list">
			  		<li>Podrán solicitar la aplicación de este artículo las colecciones biológicas registradas en el Registro Único Nacional de Colecciones Biológicas (RNC) que tengan fecha de creación antes del 25 de febrero de 2000.</li>
			  		<li>Podrá registrarse el material obtenido en el marco de actividades de recolección, de proyectos de investigación científica y/o prácticas docentes universitarias depositado en colecciones biológicas que cumplan con las condiciones del numeral anterior. La fecha de recolección de los especímenes deberá ser anterior al 9 de junio de 2015, fecha en la cual se realizó la expedición de la Ley 1753 de 2015.</li>
			  		<li>Los especímenes recolectados en áreas sujetas a la realización de consulta previa deberán anexar la documentación que evidencie el cumplimiento de esta obligación legal, según lo establecido en el Decreto 1320 de 1998 y demás normas vigentes.</li>
			  		<li>El procedimiento para la actualización del registro de las colecciones biológicas, incluyendo el material mencionado en el artículo 252, se realizará a través del sitio Web del RNC, disponible en <a href="http://rnc.humboldt.org.co">http://rnc.humboldt.org.co</a>, de acuerdo con lo establecido en la guía de registro o actualización de colecciones biológicas disponible en: <a href="http://rnc.humboldt.org.co/index.php/site/instructivo">http://rnc.humboldt.org.co/index.php/site/instructivo</a>.</li>
			  	</ul>
			  	<p>Los documentos que los titulares de las colecciones biológicas deberán anexar para aplicar al artículo 252, únicamente a través de la plataforma en línea del RNC, serán:</p>
			  	<ul class="number-list">
			  		<li>Certificado de existencia y representación legal del titular de la colección biológica con una fecha de expedición no mayor a 3 meses a la fecha de envío de la solicitud de actualización.</li>
			  		<li>Copia de la cédula de ciudadanía del representante legal del titular de la colección biológica, quién deberá ser el mismo del certificado de existencia y representación legal.</li>
			  		<li>Certificado de autodeclaración de la información reportada ante el RNC con fecha de expedición no mayor a 3 meses a la fecha de envío de la solicitud de registro o actualización. Documento disponible en <a href="http://rnc.humboldt.org.co/index.php/site/instructivo">http://rnc.humboldt.org.co/index.php/site/instructivo</a></li>
			  		<li>Acreditación de la obtención del espécimen: durante el periodo de implementación del artículo 252, el titular de la colección expedirá una certificación en la que declare que el material recolectado obedece exclusivamente a proyectos de investigación científica y/o prácticas docentes universitarias, indicando el número total de especímenes por grupo biológico con la respectiva cobertura temporal: <a href="http://bit.do/autodeclaracion">http://bit.do/autodeclaracion</a></li>
			  		<li>Deberá anexar una relación de todo el material a registrar, según los estándares para documentación de registros biológicos del Sistema de Información sobre Biodiversidad de Colombia (SiB Colombia): <a href="http://bit.do/plantilla-datos">http://bit.do/plantilla-datos</a></li>
			  	</ul>
			  	<p>Una vez enviada la solicitud de registro a través de la plataforma en línea, se dará respuesta dentro del plazo de 30 días hábiles. La solicitud de ajustes, o información que debe ser complementada, interrumpe el plazo de aprobación de la actualización.</p>
			  	<p>El Instituto Humboldt se reserva el derecho a registrar el material que no acredite los requisitos o que no cumpla con los criterios del alcance del Registro Único Nacional de Colecciones Biológicas (RNC), definidos en la Guía para el registro y actualización de colecciones biológicas.</p>
			  	<p>La solicitud de aplicación del artículo 252 de la Ley 1753 de 2015 estará disponible hasta el <b>9 de junio de 2016</b>.</p>
			  </div>
			</div>
		</div>
	</div>
</div>