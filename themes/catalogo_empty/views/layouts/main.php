<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<html lang="en">
	
    <!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo Yii::app()->charset ?>" />
	<meta name="keywords" content="Sistema de Información sobre Biodiversidad de Colombia - Catálogo de la Biodiversidad, plataforma administrativa"/>
	<meta name="description" content="Plataforma administrativa del catálogo de la biodiversidad colombiana."/>
	<meta name="author" content="Sistema de Información sobre Biodiversidad de Colombia" />
	<meta name="copyright" content="Copyright 2012-2022 por el Sistema de Información sobre Biodiversidad de Colombia" />
	<meta name="company" content="Sistema de Información sobre Biodiversidad de Colombia" />
	<link rel="shortcut icon" href="http://www.sibcolombia.net/catalogo/admin/favicon.png" />
	<link rel="apple-touch-icon" href="http://www.sibcolombia.net/catalogo/admin/apple.png" />

	<!-- Fuentes google -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans|Open+Sans+Condensed:700|Prosto+One' rel='stylesheet' type='text/css'>
		
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
	
	<?php
		Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/core.js', CClientScript::POS_HEAD);
	?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div id="contenidoAlternativo">
</div> <!-- Fin contenidoAlternativo -->

<div id="contenedorPrincipal">
	<div id="aplicacion">
		<div id="principal">
			<div id="header" class="fondo_principal_encabezado">
				<div id="titulo-header">
					<span class="brand">CATÁLOGO DE LA BIODIVERSIDAD - PLATAFORMA ADMINISTRATIVA</span>
				</div>
				<div id="logo_sib">
					<a class="logo_sib" href="/">
						<span>Sistema de Información sobre Biodiversidad de Colombia</span>
					</a>
				</div> <!-- Fin logo_ill -->
			</div> <!-- Fin header -->
			<div id="contenido">
				<?php echo $content; ?>
			</div> <!-- Fin contenido -->
			<div id="footer">
				<div id="creditos" class="fondo_principal">
					Copyright &copy; 2012-2022 - Sistema de Información sobre Biodiversidad de Colombia - SIB
					<br/>Todos los derechos reservados<br/>
				</div> <!-- Fin de creditos -->
			</div> <!-- Fin de footer -->
		</div> <!-- Fin principal -->
	</div> <!-- Fin de aplicacion -->
</div> <!-- Fin contenedorPrincipal -->
 
</body>
</html>