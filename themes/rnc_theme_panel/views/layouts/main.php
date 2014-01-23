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

	<header class="sib">
		<div class="ribbon-wrapper-green"><div class="ribbon-green">BETA</div></div>
		<a class="logo" href= "http://localhost/rnc_app" title="Portal de datos SiB Colombia"><img  src="<?=Yii::app()->theme->baseUrl?>/images/logoHumboldt.png"></a>
	</header> <!-- Fin header -->
	
	<div id="cocoon" >
		<div id="container">
			<div id="content">
				<div id="panes">
				<div>
					<h1><?php echo CHtml::encode(Yii::app()->name); ?></h1>
					
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
										array('label' => 'Usuarios'),
										array('label' => 'Crear', 'icon' => 'icon-plus', 'url' => array('usuario/create')),
										array('label' => 'Administrar', 'icon' => 'icon-th-list', 'url' => array('usuario/index')),
										array('label' => 'Entidades'),
										array('label' => 'Crear', 'icon' => 'icon-plus', 'url' => array('entidad/create')),
										array('label' => 'Administrar', 'icon' => 'icon-th-list', 'url' => array('entidad/index')),
										array('label' => 'Colecciones'),
										array('label' => 'Consultar', 'icon' => 'icon-th-list', 'url' => array('registros/index')),
										array('label' => 'Validar', 'icon' => 'icon-ok', 'url' => array('registros/listarValidar')),
										array('label' => 'Históricos', 'icon' => 'icon-folder-close', 'url' => array('registros/listarHistoricosFolder')),
										/*array('label' => 'Contenido'),
										array('label' => 'Crear', 'icon' => 'icon-plus', 'url' => array('contenido/create')),
										array('label' => 'Listar', 'icon' => 'icon-th-list', 'url' => array('contenido/index')),*/
										array('label' => 'Visitas'),
										array('label' => 'Registrar', 'icon' => 'icon-plus', 'url' => array('visitas/create')),
										array('label' => 'Consultar', 'icon' => 'icon-th-list', 'url' => array('visitas/index')),
										array('label' => 'CONTACTOS'),
										array('label' => 'Registrar', 'icon' => 'icon-plus', 'url' => array('pqrs/create')),
										array('label' => 'Consultar', 'icon' => 'icon-th-list', 'url' => array('pqrs/index')),
										array('label' => 'Reportes'),
										array('label' => 'Bitácora', 'icon' => 'icon-plus', 'url' => array('reporte/create')),
										//array('label' => 'Bitácora Colección', 'icon' => 'icon-file', 'url' => array('reporte/index')),
										array('label' => 'Cerrar Sesión', 'icon' => 'icon-off', 'url' => array('site/logout')),
									)
								));
							}else {
								$this->widget('bootstrap.widgets.TbMenu', array(
									'type' => 'list',
									'items' => array(
											array('label'=>'Inicio', 'icon'=>'home', 'url' => array('admin/panel')),
											array('label' => 'Editar Entidad', 'icon' => 'icon-plus', 'url' => array('entidad/update/'.Yii::app()->user->idEntidad)),
											//array('label' => 'Usuario'),
											//array('label' => 'Editar', 'icon' => 'icon-plus', 'url' => array('usuario/update/'.Yii::app()->user->id)),
											array('label' => 'Colecciones'),
											array('label' => 'Crear', 'icon' => 'icon-plus', 'url' => array('registros/create')),
											array('label' => 'Actualizar', 'icon' => 'icon-th-list', 'url' => array('registros/indexActualizar')),
											array('label' => 'Consultas'),
											array('label' => 'Coleccion', 'icon' => 'icon-th-list', 'url' => array('registros/index')),
											array('label' => 'Bitácora Colección', 'icon' => 'icon-plus', 'url' => array('visita/create')),
											array('label' => 'Contáctenos'),
											array('label' => 'Registrar', 'icon' => 'icon-plus', 'url' => array('pqrs/create')),
											array('label' => 'Consultar', 'icon' => 'icon-th-list', 'url' => array('pqrs/index')),
											array('label' => 'Cerrar Sesión', 'icon' => 'icon-off', 'url' => array('site/logout')),
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
					
					<?php 
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
					<?php }?>
				</div>
				</div>
			</div>
		</div>
		
		<footer>
			<section>
			<div>
				<p>
					Sede Principal: Calle28A#15-09 Bogotá, D.C., Colombia | PBX: (57)(1) 3202767 | NIT 820000142-2 | Horario de atención 8:30 a.m. - 5:30 p.m.<br>
					Prohibida su reproducción total o parcial, asi como su traducción a otro idioma - Todos los derechos reservados 2013.
				</p>
			</div>
			</section>
		</footer>
	</div>
</body>
</html>