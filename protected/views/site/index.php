<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
Yii::app()->theme = 'rnc_theme';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
?>
<div class="home_panel"><h1 style="display:block; margin:0 auto 30px auto; text-align:center ">Registro Único Nacional de Colecciones Biológicas</h1>
<img src="<?=Yii::app()->theme->baseUrl?>/images/rncHome.png" />

<div id="textHomeIntro" class="caja_amarilla">
<img style="float:left; margin-right:20px; width:200px; height: auto" src="<?=Yii::app()->theme->baseUrl?>/images/logo_RNC_full.png" />
<h1>Bienvenido</h1>

<p>La aplicación en línea del RNC le permitirá realizar las siguientes actividades, según lo establecido en el Decreto <a href="https://s3.amazonaws.com/IPT/RNC/DECRETO+1375+DEL+27+DE+JUNIO+DE+2013.pdf" target="_blank">1375</a> de 2013:</p>
<ul>
<li>Registro de las colecciones biológicas.</li>
<li>Actualización periódica de la información sobre la colección biológica.</li>
<li>Consulta de las colecciones biológicas registradas y su actualización.</li>
</ul>
</div></div>
