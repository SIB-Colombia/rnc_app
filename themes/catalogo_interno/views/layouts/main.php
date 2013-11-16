<!DOCTYPE html>
<html>
<head>
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo Yii::app()->charset ?>" />
	<meta name="language" content="es" />
	<meta name="keywords" content="Sistema de Información sobre Biodiversidad de Colombia - Catálogo de la Biodiversidad, plataforma administrativa"/>
	<meta name="description" content="Plataforma administrativa del catálogo de la biodiversidad colombiana."/>
	<meta name="author" content="Sistema de Información sobre Biodiversidad de Colombia" />
	<meta name="copyright" content="Copyright 2012-2022 por el Sistema de Información sobre Biodiversidad de Colombia" />
	<meta name="company" content="Sistema de Información sobre Biodiversidad de Colombia" />
	<link rel="shortcut icon" href="http://www.sibcolombia.net/catalogo/admin/favicon.png" />
	<link rel="apple-touch-icon" href="http://www.sibcolombia.net/catalogo/admin/apple.png" />

	<!--[if lt IE 8]>
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<?php /*Yii::app()->bootstrap->register();*/ ?>
	
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery.jscrollpane.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-timepicker.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap_catalogo.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/fancybox/jquery.fancybox.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-wysihtml5-0.0.2.css" />
	
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
	<style type="text/css" id="page-css">
			/* Styles specific to this particular page */
			.barralateral_secundaria
			{
				width: 200px;
				height: 100px;
				overflow: auto;
				position: relative;
			}
		</style>
	<script type="text/javascript" id="sourcecode">
		$(function()
		{
			$('.barralateral_secundaria').jScrollPane();
		});
	</script>
</head>

<body>
	<div id="contenidoAlternativo">
	</div> <!-- Fin contenidoAlternativo -->

	<div id="header">
		<?php $this->widget('bootstrap.widgets.TbNavbar', array(
			'fixed'=>false,
			'type'=>'inverse', // null or 'inverse'
			'brand'=>'CATÁLOGO DE LA BIODIVERSIDAD',
			'brandUrl'=>'#',
			'collapse'=>true, // requires bootstrap-responsive.css
			'items'=>array(
				array(
					'class'=>'bootstrap.widgets.TbMenu',
					'items'=>array(
						array('label'=>'Principal', 'url'=>array('/'), 'active'=>true),
						//array('label'=>'Link', 'url'=>'#'),
						/*array('label'=>'Dropdown', 'url'=>'#', 'items'=>array(
							array('label'=>'Action', 'url'=>'#'),
							array('label'=>'Another action', 'url'=>'#'),
							array('label'=>'Something else here', 'url'=>'#'),
							'---',
							array('label'=>'NAV HEADER'),
							array('label'=>'Separated link', 'url'=>'#'),
							array('label'=>'One more separated link', 'url'=>'#'),
						)),*/
					),
				),
				'<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Buscar"></form>',
				'<img class="pull-right" src="'.Yii::app()->theme->baseUrl.'/images/logo_sib.png">',
				array(
					'class'=>'bootstrap.widgets.TbMenu',
					'htmlOptions'=>array('class'=>'pull-right'),
					'items'=>array(
						array('label'=>'Cerrar sesión ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
						/*array('label'=>'Dropdown', 'url'=>'#', 'items'=>array(
                    		array('label'=>'Action', 'url'=>'#'),
                    		array('label'=>'Another action', 'url'=>'#'),
                    		array('label'=>'Something else here', 'url'=>'#'),
                    		'---',
                    		array('label'=>'Separated link', 'url'=>'#'),
                		)),*/
            		),
        		),
    		),
		));?>		
	</div> <!-- Fin header -->
	
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span2">
				<div class="menu-izquierda">
					<?php
								
					$userRole = Yii::app()->user->getState("roles");
					$arr_title = array();
					$arr_menu_user = array();
					$arr_menu_user_new = array();
					$arr_title_contact = array();
					$arr_menu_contact = array();
					$arr_title_export = array();
					$arr_menu_export = array();
					
					if ($userRole === "admin") {
						$arr_title = array('label' => 'USUARIOS');
						$arr_menu_user = array('label' => 'Listado', 'icon' => 'icon-th-list', 'url' => array('catalogoUser/index'));
						$arr_menu_user_new = array('label' => 'Nuevo Usuario', 'icon' => 'icon-plus', 'url' => array('catalogoUser/create'));
						$arr_title_contact = array('label'=>'Contactos');
						$arr_menu_contact	= array('label'=>'Nuevo contacto', 'icon'=>'icon-plus', 'url'=>array('contactos/create'));
						$arr_title_export	= array('label'=>'Exportar');
						$arr_menu_export	= array('label'=>'Plinian Core (Excel)', 'icon'=>'icon-download-alt', 'url'=>array('plinianCore/excelfullexport'));
					}
					else{
						$arr_title = array('label' => 'USUARIOS');
						$arr_menu_user_new = array('label' => 'Editar Usuario', 'icon' => 'icon-plus', 'url' => array('catalogoUser/update?id='.Yii::app()->user->name));
					}
					$this->widget('bootstrap.widgets.TbMenu', array(
						'type'=>'list',
						'items'=>array(
							array('label'=>'FICHAS'),
							array('label'=>'Listado', 'icon'=>'icon-th-list', 'url'=>array('catalogo/index')),
							array('label'=>'Nueva ficha', 'icon'=>'icon-plus', 'url'=>array('catalogo/create')),
							$arr_title_contact,
							$arr_menu_contact,
							array('label'=>'Citaciones'),
							array('label'=>'Nueva citación', 'icon'=>'icon-plus', 'url'=>array('citacion/create')),
							$arr_title_export,
							$arr_menu_export,
							$arr_title,
							$arr_menu_user,
							$arr_menu_user_new,
							//array('label'=>'Plinian Core (PDF)', 'icon'=>'icon-download-alt', 'url'=>array('plinianCore/pdffullexport')),
							//array('label'=>'Application', 'icon'=>'pencil', 'url'=>'#'),
							//array('label'=>'EXPORTAR'),
							//array('label'=>'Plinian Core', 'icon'=>'icon-download-alt', 'url'=>'#'),
							//array('label'=>'Plinian Core .txt', 'icon'=>'icon-download-alt', 'url'=>'#'),
							//array('label'=>'Help', 'icon'=>'flag', 'url'=>'#'),
							//array('label'=>'INFORMACIÓN FICHA'),
							//array('label'=>'Por Catalogador', 'icon'=>'user', 'url'=>'#'),
							//array('label'=>'Estado revisión', 'icon'=>'icon-bookmark', 'url'=>'#'),
							//array('label'=>'Cifras', 'icon'=>'icon-signal', 'url'=>'#'),
						),
					)); ?>
				</div> <!-- Fin menu-izquierda -->
			</div> <!-- Fin span3 -->
			<div class="span10">
				<div class="area-contenido">
					<?php echo $content; ?>
				</div> <!-- Fin area-contenido -->
			</div> <!-- Fin span9 -->
		</div> <!-- Fin row-fluid -->
	</div> <!-- Fin container-fluid -->
	
	<div id="footer">
		<div id="creditos" class="fondo_principal">
			Copyright &copy; 2012-2022 - Sistema de Información sobre Biodiversidad de Colombia - SIB
			<br/>Todos los derechos reservados<br/>
		</div> <!-- Fin de creditos -->
	</div> <!-- Fin de footer -->
	
<script type="text/javascript">
	$(document).ready(function() {
		$("#single_catalog_image").fancybox({
			openEffect	: 'elastic',
	    	closeEffect	: 'elastic',
			helpers: {
				title : {
					type : 'float',
				},
			},
		});
	});
</script>
</body>
</html>