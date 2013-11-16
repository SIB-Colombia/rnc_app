<!DOCTYPE html>
<html>
<head>
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo Yii::app()->charset ?>" />
	<meta name="language" content="es" />
	<meta name="keywords" content="Sistema de busqueda taxonomica"/>
	<meta name="description" content="Plataforma para la busqueda de familia taxonomica y lsids."/>
	<meta name="author" content="Sistema de Información sobre Biodiversidad de Colombia" />
	<meta name="copyright" content="Copyright 2012-2022 por el Sistema de Información sobre Biodiversidad de Colombia" />
	<meta name="company" content="Sistema de Información sobre Biodiversidad de Colombia" />
	<link rel="shortcut icon" href="<?= Yii::app()->theme->baseUrl; ?>/css/images/favicon.ico" />
	<link rel="apple-touch-icon" href="http://www.sibcolombia.net/catalogo/admin/apple.png" />
	
	<!--[if lt IE 8]>
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
	
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery.jscrollpane.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-timepicker.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/fancybox/jquery.fancybox.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-wysihtml5-0.0.2.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/speciesGlobal.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/panes.css" />
	
	<!-- Stylesheet for jquery-fineuploader library -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery-fineuploader/fineuploader-3.6.3.css" />

	<script type="text/javascript" async="" src="http://widget.uservoice.com/lBPZH9vrbtDdBpMQsEctag.js"></script>
	<?php
		Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/core.js', CClientScript::POS_HEAD);
		// the mousewheel plugin
		Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.mousewheel.js', CClientScript::POS_HEAD);
		// the jScrollPane script
		Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.jscrollpane.min.js', CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/bootstrap-timepicker.min.js', CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/fancybox/jquery.fancybox.pack.js', CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/wysihtml5-0.3.0_rc2.min.js', CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/bootstrap-wysihtml5-0.0.2.min.js', CClientScript::POS_HEAD);
	?>
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
</head>

<body>
	<div id="uvTab" style="background-image: url(http://widget.uservoice.com/images/clients/widget2/tab-right-dark.png);
		 border-top-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-style: solid none solid solid;
		 border-top-color: rgb(255, 255, 255); border-bottom-color: rgb(255, 255, 255); 
		 border-left-color: rgb(255, 255, 255); border-top-left-radius: 4px; border-top-right-radius: 0px; 
		 border-bottom-right-radius: 0px; border-bottom-left-radius: 4px; 
		 -webkit-box-shadow: rgba(255, 255, 255, 0.247059) 1px 1px 1px inset, rgba(0, 0, 0, 0.498039) 0px 1px 2px; 
		 box-shadow: rgba(255, 255, 255, 0.247059) 1px 1px 1px inset, rgba(0, 0, 0, 0.498039) 0px 1px 2px; 
		 font-style: normal; font-variant: normal; font-weight: bold; font-size: 14px; line-height: 1em; 
		 font-family: Arial, sans-serif; position: fixed; right: 0px; top: 50%; z-index: 9999; 
		 background-color: rgb(165, 179, 97); margin-top: -103px; background-position: 50% 0px; 
		 background-repeat: no-repeat no-repeat;" class="uv-tab uv-slide-right ">
		 <a id="uvTabLabel" style="background-color: transparent; display:block;padding:39px 5px 10px 5px;
		 	text-decoration:none;" href="javascript:return false;">
		 	<img src="http://widget.uservoice.com/dcache/widget/feedback-tab.png?t=DANOS%20TU%20OPINI%C3%93N&amp;c=ffffff&amp;r=90" alt="DANOS TU OPINIÓN" style="border:0; background-color: transparent; padding:0; margin:0;"></a>
	</div>
		 	
	<header class="sib">
		<a class="logo" href= "http://data.sibcolombia.net" title="Portal de datos SiB Colombia"><img  src="<?=Yii::app()->theme->baseUrl?>/css/images/logo_dataportal.png"></a>
		<nav>
			<div class="share_icons">
				<a href="http://www.sibcolombia.net" title="Ir a la página principal de SIB Colombia" target="_blank"><img src="<?=Yii::app()->theme->baseUrl?>/css/images/ico_portal.png" alt="Vínculo a la página web del SIB Colombia"></a>
				<span></span>
				<a href="https://twitter.com/sibcolombia" target="_blank"><img src="<?=Yii::app()->theme->baseUrl?>/css/images/ico_twitter.png"></a>
				<span></span>
				<a href="https://www.facebook.com/SibColombia" target="_blank"><img src="<?=Yii::app()->theme->baseUrl?>/css/images/ico_fb.png"></a>
				<span></span>
				<a href="http://www.youtube.com/user/sibcolombia" target="_blank"><img src="<?=Yii::app()->theme->baseUrl?>/css/images/ico_youtube.png"></a>
			</div>
		</nav>
	</header> <!-- Fin header -->
	
	<div id="cocoon" >
		<div id="container">
			<div id="content">
				<div id="panes">
				<div>
					<h2><?=Yii::app()->name; ?></h2>
					<?=$content;?>
				</div>
				</div>
			</div>
		</div>
		
		<footer>
			<section>
				<aside><img alt="SiB Colombia" src="<?=Yii::app()->theme->baseUrl?>/css/images/logos_cut/logo_sib_bn.png"></aside>
				<div>
				    <h5>Sistema de información sobre <br>Biodiversidad de Colombia</h5>
				    <strong>Dirección</strong> Calle 28A No. 15-09 Bogotá D.C., Colombia. <br>
				    <strong>Teléfono</strong> PBX 57(1) 320 2767<br>
				    <a href="mailto:sib@humboldt.org.co">sib@humboldt.org.co</a>
				</div>
				<div>
				    <div><h5>Portal de datos SiB Colombia</h5> 
				        <a target="_self" href="http://data.sibcolombia.net/especies/">Explorar especies de Colombia</a>
				        <a target="_self" href="http://data.sibcolombia.net/explorador/">Explorador geográfico de registros</a>
				        <a target="_self" href="http://data.sibcolombia.net/conjuntos/">Explorar conjuntos de datos</a> 
				        <a target="_self" href="http://data.sibcolombia.net/publicadores/">Explorar publicadores de datos</a> 
				        <a target="_self" href="http://data.sibcolombia.net/busqueda/">Búsqueda avanzada de registros</a>
				        <!--<a target="_blank" href="#">¿Cómo usar el portal de datos?</a>!--></div>
				
				     <div><h5>Nuestros servicios</h5> 
				        <a target="_self" href="http://data.sibcolombia.net">Portal de datos</a> 
				        <a target="_blank" href="http://www.sibcolombia.net">Portal SiB Colombia</a> 
				        <a target="_blank" href="http://www.siac.net.co/sib/catalogoespecies/welcome.do">Catálogo de especies</a> 
				        <a target="_blank" href="http://ipt.sibcolombia.net/">Herramienta de publicación de datos (IPT)</a></div> 
				
				    <div><h5>SiB Colombia</h5> 
				        <a target="_blank" href="http://www.sibcolombia.net/web/sib/acerca-del-sib">¿Qué es el SiB?</a> 
				        <a target="_blank" href="http://www.sibcolombia.net/web/sib/equipo-coordinador">Equipo coordinador</a>
				        <a target="_blank" href="http://www.sibcolombia.net/web/sib/comite-directivo">Comité directivo</a> 
				        <a target="_blank" href="http://www.sibcolombia.net/web/sib/nuestra-red">Nuestra red</a> 
				        <!--<a target="_blank" href="http://www.sibcolombia.net/web/sib/unete-al-sib">Únete al SiB</a>!--></div>
				
				    <div><h5>Actualidad</h5> 
				        <a target="_blank" href="http://www.sibcolombia.net/web/sib/linea-de-tiempo">Línea de eventos</a> 
				        <a target="_blank" href="http://www.sibcolombia.net/web/sib/eventos">Talleres y comités</a> 
				        <a target="_blank" href="http://www.sibcolombia.net/web/sib/reportesib">ReporteSiB</a>
				        <!--<a target="_blank" href="#">Convocatorias</a>!--></div>
				 </div>
				 <span class="redes">
				    <a title="SiB en Facebook" target="_blank" href="https://www.facebook.com/SibColombia"><img alt="SiB en Facebook" src="<?=Yii::app()->theme->baseUrl?>/css/images/logos_cut/fb_b.png"></a>
				    <a title="SiB en Twitter" target="_blank" href="https://twitter.com/sibcolombia"><img alt="SINCHI" src="<?=Yii::app()->theme->baseUrl?>/css/images/logos_cut/tw_b.png"></a>
				    <a title="SiB en Pinterest" target="_blank" href="http://pinterest.com/sibcolombia/pins/"><img alt="SiB en Pinterest" src="<?=Yii::app()->theme->baseUrl?>/css/images/logos_cut/pin_b.png"></a>
				    <a title="SiB en Youtube" target="_blank" href="http://www.youtube.com/sibcolombia"><img alt="SiB en Youtube" src="<?=Yii::app()->theme->baseUrl?>/css/images/logos_cut/yt_b.png"></a>
				 </span>
				 <nav>
				    <a href="http://data.sibcolombia.net/terms.htm">Términos de uso</a>  <a href="https://www.gobiernoenlinea.gov.co/" target="_blank">Gobierno en línea</a> <!--<<a href="#">Ayuda</a> <a href="#">Copyright</a> <a href="#">Mapa de sitio</a>  -->
				 </nav>
			</section>
			<section>
			  <span><a title="Humboldt" target="_blank" href="http://www.humboldt.org.co"><img alt="Humboldt" src="<?=Yii::app()->theme->baseUrl?>/css/images/logos_cut/humboldt_bn.png"></a>
			  <p>Entidad<br>coordinadora</p> 
			  </span>
			  <span>
			    <a title="Red Interamericana de Información sobre Biodiversidad" target="_blank" href="http://www.iabin.net"><img alt="Red Interamericana de Informaci&amp;oacute;n sobre Biodiversidad" src="<?=Yii::app()->theme->baseUrl?>/css/images/logos_cut/iabin_bn.png"></a>
			    <a title="Global Biodiversity Information Facility" target="_blank" href="http://www.gbif.org"><img alt="Global Biodiversity Information Facility" src="<?=Yii::app()->theme->baseUrl?>/css/images/logos_cut/gbif_bn.png"></a>
			  <p>Iniciativas relacionadas con el SiB</p> 
			  </span>
			  <span>
			    <a href="https://www.siac.gov.co/" target="_blank" title="El SiB Colombia es componente temático del SIAC"><img src="<?=Yii::app()->theme->baseUrl?>/css/images/logos_cut/siac_bn.png" alt="El SiB Colombia es componente temático del SIAC"></a>
			  <p>El SiB Colombia es<br>componente<br>temático del SIAC</p> 
			  </span>
			  <span>
			    <a title="SINCHI" target="_blank" href="http://www.sinchi.org.co"><img alt="SINCHI" src="<?=Yii::app()->theme->baseUrl?>/css/images/logos_cut/sinchi_bn.png"></a>
			    <a title="Humboldt" target="_blank" href="http://www.humboldt.org.co"><img alt="Humboldt" src="<?=Yii::app()->theme->baseUrl?>/css/images/logos_cut/humboldt_bn.png"></a>
			    <a title="IDEAM" target="_blank" href="http://www.ideam.gov.co"><img alt="IDEAM" src="<?=Yii::app()->theme->baseUrl?>/css/images/logos_cut/ideam_bn.png"></a>
			    <a title="INVEMAR" target="_blank" href="http://www.invemar.org.co"><img alt="INVEMAR" src="<?=Yii::app()->theme->baseUrl?>/css/images/logos_cut/invemar_bn.png"></a>
			    <a title="IIAP" target="_blank" href="http://www.iiap.org.co"><img alt="IIAP" src="<?=Yii::app()->theme->baseUrl?>/css/images/logos_cut/iiap_bn.png"></a>
			    <a title="ICN" target="_blank" href="http://www.icn.unal.edu.co"><img alt="ICN" src="<?=Yii::app()->theme->baseUrl?>/css/images/logos_cut/unal_bn.png"></a>
			    <a title="Ministerio de Ambiente y Desarrollo Sostenible" target="_blank" href="http://www.minambiente.gov.co"><img alt="Ministerio de Ambiente y Desarrollo Sostenible" src="<?=Yii::app()->theme->baseUrl?>/css/images/logos_cut/mads_bn.png"></a>
			    <p>Comité Directivo y Técnico</p> 
			  </span>
			
			
			</section>
		</footer>
	</div>
</body>
</html>