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
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/opa-icons.css" />
	
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
		<a class="logo" href= "<?=Yii::app()->createUrl("site/index");?>" title="Registro Único Nacional de Colecciones Biológicas"><img  src="<?=Yii::app()->theme->baseUrl?>/images/logo_rnc.png"></a>
		<!--h1><?php echo CHtml::encode(Yii::app()->name);  ?></h1-->

			<?php 
			$this->widget('bootstrap.widgets.TbMenu', array(
				'type' => 'pills',
				'stacked'=>false,
				'items' => array(
					array('label' => 'Preguntas frecuentes', 'url' => array('site/preguntas')),
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

				<div>
					<!--h1><?php echo CHtml::encode(Yii::app()->name); ?></h1>
					<a href=""><span class="icon32 icon-color icon-info"> </span></a>-->
					<div class="span2">
						<div class="menu-izquierda">
							<?php 
							$userRole = Yii::app()->user->getState("roles");
							
							if($userRole === 'admin')
							{
								$this->widget('bootstrap.widgets.TbMenu', array(
									'type' => 'list',
									'items' => array(
										array('label'=>'Inicio', 'icon'=>'home', 'url' => array('admin/panel')),
										array('label' => 'Usuarios', 'items' => array(
											array('label' => 'Crear', 'icon' => 'icon-plus', 'url' => array('usuario/create')),
											array('label' => 'Administrar', 'icon' => 'icon-th-list', 'url' => array('usuario/index')),
										)),
										array('label' => 'Entidades', 'items' => array(
											array('label' => 'Crear', 'icon' => 'icon-plus', 'url' => array('entidad/create')),
											array('label' => 'Administrar', 'icon' => 'icon-th-list', 'url' => array('entidad/index')),
										)),
										array('label' => 'Colecciones', 'items' => array(
											array('label' => 'Consultar', 'icon' => 'icon-th-list', 'url' => array('registros/index')),
											array('label' => 'Validar', 'icon' => 'icon-ok', 'url' => array('registros/listarValidar')),
											array('label' => 'Históricos', 'icon' => 'icon-folder-close', 'url' => array('registros/listarHistoricosFolder')),
											array('label' => 'Certificados', 'icon' => 'icon-file', 'url' => array('registros/listarCertificados')),
										)),
										
										/*array('label' => 'Contenido'),
										array('label' => 'Crear', 'icon' => 'icon-plus', 'url' => array('contenido/create')),
										array('label' => 'Listar', 'icon' => 'icon-th-list', 'url' => array('contenido/index')),*/
										array('label' => 'Visitas', 'items' => array(
											array('label' => 'Registrar', 'icon' => 'icon-plus', 'url' => array('visitas/create')),
											array('label' => 'Consultar', 'icon' => 'icon-th-list', 'url' => array('visitas/index')),
										)),
										array('label' => 'Contacto', 'items' => array(
											array('label' => 'Crear', 'icon' => 'icon-plus', 'url' => array('pqrs/create')),
											array('label' => 'Consultar', 'icon' => 'icon-th-list', 'url' => array('pqrs/index')),
										)),
										array('label' => 'Reportes', 'items' => array(
											array('label' => 'Bitácora', 'icon' => 'icon-plus', 'url' => array('reporte/create')),
											//array('label' => 'Bitácora Colección', 'icon' => 'icon-file', 'url' => array('reporte/index')),
										)),
										array('label' => 'Cerrar Sesión', 'icon' => 'icon-off', 'url' => array('site/logout')),
										array('label' => 'Ayuda', 'icon' => 'icon icon-color icon-info', 'url' => array('site/archivoInstructivo')),
									)
								));
							}else {
								$this->widget('bootstrap.widgets.TbMenu', array(
									'type' => 'list',
									'items' => array(
											array('label'=>'Inicio', 'icon'=>'home', 'url' => array('admin/panel')),
											//array('label' => 'Editar Entidad', 'icon' => 'icon-pencil', 'url' => array('entidad/update/'.Yii::app()->user->idEntidad)),
											//array('label' => 'Usuario'),
											//array('label' => 'Editar', 'icon' => 'icon-plus', 'url' => array('usuario/update/'.Yii::app()->user->id)),
											//array('label' => 'Colecciones'),
											array('label' => 'Crear colección', 'icon' => 'icon-plus', 'url' => array('registros/create')),
											array('label' => 'Actualizar colección', 'icon' => 'icon-th-list', 'url' => array('registros/indexActualizar')),
											array('label' => 'Consultas', 'items' => array(
												array('label' => 'Coleccion', 'icon' => 'icon-th-list', 'url' => array('registros/index')),
												array('label' => 'Históricos', 'icon' => 'icon-folder-close', 'url' => array('registros/listarHistoricosFolder')),
												array('label' => 'Certificados', 'icon' => 'icon-file', 'url' => array('registros/listarCertificados')),
												//array('label' => 'Bitácora Colección', 'icon' => 'icon-plus', 'url' => array('visita/create')),
											)),
											array('label' => 'Contáctenos', 'items' => array(
												array('label' => 'Crear', 'icon' => 'icon-plus', 'url' => array('pqrs/create')),
												array('label' => 'Consultar', 'icon' => 'icon-th-list', 'url' => array('pqrs/index')),
											)),
											array('label' => 'Cerrar Sesión', 'icon' => 'icon-off', 'url' => array('site/logout')),
											array('label' => 'Ayuda', 'icon' => 'icon icon-color icon-info', 'url' => array('site/archivoInstructivo')),
									)
							));
							}
							?>
						</div> <!-- Fin menu-izquierda -->
					</div> <!-- Fin span2 -->
							
					<div class="span8">
						<div class="area-contenido">
							<?php echo $content; ?>
						</div> <!-- Fin area-contenido -->
					</div> <!-- Fin span8 -->
					
					<!-- 
					<?php /*
					if($userRole === 'admin')
					{
					?>
					<div class="span2">
						<div class="area-widget">
						<?php 
							$modelAdmin = new Admin();
							$modelAdmin->widgetUp();
						?>
						</div>
					</div>
					<div class="span2">
						<div class="area-widget">
						<?php 
							$modelAdmin = new Admin();
							$modelAdmin->widgetDown();
						?>
						</div>
					</div>
					<?php }else {?>
					<div class="span2">
						<div class="area-widget">
						<?php 
							$modelAdmin = new Admin();
							$modelAdmin->widgetEntity();
						?>
						</div>
					</div>
					<?php }*/?>
					 -->
				</div>

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
						array('label' => 'Preguntas frecuentes', 'url' => array('site/preguntas'))
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

				<li> <a href="http://www.sibcolombia.net" target="_blank" title="Instituto Alexander von Humboldt"><img alt="Logo MinAmbiente" src="<?=Yii::app()->theme->baseUrl?>/images/SIB.png" ></a></li>
				</ul>
			</div>	

			<p>2014 · Instituto de Investigación de Recursos Biológicos Alexander Von Humboldt · Ministerio de Medio Ambiente de Colombia · SiB Colombia</p>
		</section>
	</footer>
	
</body>
</html>