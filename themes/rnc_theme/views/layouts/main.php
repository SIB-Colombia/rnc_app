<!DOCTYPE html>
<html>
<head>
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo Yii::app()->charset ?>" />
	<meta name="language" content="es" />
	<meta name="keywords" content="Sistema de registro nacional de colecciones biologicas"/>
	<meta name="description" content="Sistema de registro nacional de colecciones biologicas."/>
	<meta name="author" content="Instituto Alexander Von Humboldt" />
	<meta name="copyright" content="Copyright 2012-2022 por el Instituto Alexander Von Humboldt" />
	<meta name="company" content="Instituto Alexander Von Humboldt" />
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
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/speciesSpecial.css" />
	
	<!-- Stylesheet for jquery-fineuploader library -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery-fineuploader/fineuploader-3.6.3.css" />

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
	
	<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-1418857-10']);
		  _gaq.push(['_setDomainName', 'sibcolombia.net']);
		  _gaq.push(['_setAllowLinker', true]);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
	</script>
	
</head>

<body>
		 	
	<header class="sib">
		<div class="ribbon-wrapper-green"><div class="ribbon-green">BETA</div></div>
		<a class="logo" href= "<?=Yii::app()->createUrl("site/index");?>" title="Registro Único Nacional de Colecciones Biológicas"><img  src="<?=Yii::app()->theme->baseUrl?>/images/logo_rnc.png"></a>
		<!--h1><?php echo CHtml::encode(Yii::app()->name);  ?></h1-->

			<?php 
			$this->widget('bootstrap.widgets.TbMenu', array(
				'type' => 'pills',
				'stacked'=>false,
				'items' => array(
					array('label' => 'Colecciones biológicas', 'url' => array('registros/colecciones')),
					array('label' => 'Contáctenos', 'url' => array('pqrs/create')),
					array('label' => 'Guía e Instructivo', 'url' => array('site/instructivo')),
					array('label' => 'Solicitar usuario', 'url' => array('entidad/solicitud')),
					array('label' => 'Ingresar', 'url' => array('admin/index')),
				)
			));
			?>


	</header> <!-- Fin header -->
	
		<div id="container">
			<div id="content">
					
					<?=$content;?>
			</div>
		</div>

	<footer>
		<section>
			<div>
			<?php 
				$this->widget('bootstrap.widgets.TbMenu', array(
					'type' => 'pills',
					'stacked'=>false,
					'items' => array(
						array('label' => 'Solicitar usuario', 'url' => array('entidad/solicitud')),
						array('label' => 'Ingresar', 'url' => array('admin/index')),
						array('label' => 'Colecciones biológicas', 'url' => array('registros/colecciones')),
						array('label' => 'Contáctenos', 'url' => array('pqrs/create')),
						array('label' => 'Guía e Instructivo', 'url' => array('site/instructivo')),
					)
				));
			?>
			</div>

			<div class="doscol clearfix">
				
				<ul>
				<p> Coordinan:</p>
				<li> <a href="http://www.minambiente.gov.co/" target="_blank" title="Ministerio de Medio Ambiente"><img alt="Logo MinAmbiente" src="<?=Yii::app()->theme->baseUrl?>/images/MinAmbiente.png" ></a></li>
				<li> <a href="http://www.humboldt.org.co" target="_blank" title="Instituto Alexander von Humboldt"><img alt="Logo MinAmbiente" src="<?=Yii::app()->theme->baseUrl?>/images/IAvH.png" ></a></li>
				<li class="lineal"><li>
				</ul>	
				
				
				<ul>
				<p> Apoyan:</p>

				<li> <a href="http://grbio.org/" target="_blank" title="Instituto Alexander von Humboldt"><img alt="Logo MinAmbiente" src="<?=Yii::app()->theme->baseUrl?>/images/GRbio.png"></a></li>
				<li> <a href="http://www.sibcolombia.net" target="_blank" title="Instituto Alexander von Humboldt"><img alt="Logo MinAmbiente" src="<?=Yii::app()->theme->baseUrl?>/images/SIB.png" ></a></li>
				</ul>
			</div>	

			<p>2014 · Instituto de Investigación de Recursos Biológicos Alexander Von Humboldt · Ministerio de Medio Ambiente de Colombia · SiB Colombia</p>
		</section>
	</footer>
</body>
</html>