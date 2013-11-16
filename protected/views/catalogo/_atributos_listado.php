		<?php if (!empty($atributos["Alimentación"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Alimentación',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_alimentacion_asignados_ficha_update_table', array('alimentacion'=>$atributos["Alimentación"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin alimentación -->
    	
    	<?php if (!empty($atributos["Autor(es)"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Autor(es)',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_autores_asignados_ficha_update_table', array('autores'=>$atributos["Autor(es)"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Autor(es) -->
    	
    	<?php if (!empty($atributos["Claves taxonómicas"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Claves taxonómicas',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_claves_taxonomicas_asignados_ficha_update_table', array('clavesTaxonomicas'=>$atributos["Claves taxonómicas"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Claves taxonómicas" -->
    	
    	<?php if (!empty($atributos["Colaborador(es)"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Colaborador(es)',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_colaboradores_asignados_ficha_update_table', array('colaboradores'=>$atributos["Colaborador(es)"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Colaborador(es)" -->
    	
    	<?php if (!empty($atributos["Comportamiento"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Comportamiento',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_comportamiento_asignados_ficha_update_table', array('comportamiento'=>$atributos["Comportamiento"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Comportamiento" -->
    	
    	<?php if (!empty($atributos["Créditos específicos"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Créditos específicos',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_creditos_especificos_asignados_ficha_update_table', array('creditosEspecificos'=>$atributos["Créditos específicos"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Créditos específicos -->
    	
    	<?php if (!empty($atributos["Descripción de la invasión"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Descripción de la invasión',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_descripcion_invasion_asignados_ficha_update_table', array('descripcionInvasion'=>$atributos["Descripción de la invasión"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Descripción de la invasión -->
    	
    	<?php if (!empty($atributos["Descripción general"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Descripción general',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_descripcion_general_asignados_ficha_update_table', array('descripcionGeneral'=>$atributos["Descripción general"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Descripción general -->
    	
    	<?php if (!empty($atributos["Descripción taxonómica"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Descripción taxonómica',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_descripcion_taxonomica_asignados_ficha_update_table', array('descripcionTaxonomica'=>$atributos["Descripción taxonómica"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Descripción taxonómica -->
    	
    	<?php if (!empty($atributos["Distribución altitudinal"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Distribución altitudinal',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_distribucion_altitudinal_asignados_ficha_update_table', array('distribucionAltitudinal'=>$atributos["Distribución altitudinal"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Distribución altitudinal -->
    	
    	<?php if (!empty($atributos["Distribución geográfica en Colombia"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Distribución geográfica en Colombia',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_distribucion_geografica_colombia_asignados_ficha_update_table', array('distribucionGeograficaColombia'=>$atributos["Distribución geográfica en Colombia"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Distribución geográfica en Colombia -->
    	
    	<?php if (!empty($atributos["Distribución geográfica en el mundo"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Distribución geográfica en el mundo',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_distribucion_geografica_mundo_asignados_ficha_update_table', array('distribucionGeograficaMundo'=>$atributos["Distribución geográfica en el mundo"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Distribución geográfica en el mundo -->
    	
    	<?php if (!empty($atributos["Ecología"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Ecología',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_ecologia_asignados_ficha_update_table', array('ecologia'=>$atributos["Ecología"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Ecología -->
    	
    	<?php if (!empty($atributos["Ecosistema"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Ecosistema',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_ecosistema_asignados_ficha_update_table', array('ecosistema'=>$atributos["Ecosistema"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Ecosistema -->
    	
    	<?php if (!empty($atributos["Editor(es)"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Editor(es)',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_editores_asignados_ficha_update_table', array('editores'=>$atributos["Editor(es)"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Editor(es) -->
    	
    	<?php if (!empty($atributos["Estado actual de la población"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Estado actual de la población',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_estado_actual_poblacion_asignados_ficha_update_table', array('estadoActualPoblacion'=>$atributos["Estado actual de la población"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Estado actual de la población -->
    	
    	<?php if (!empty($atributos["Estado CITES"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Estado CITES',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_estado_cites_asignados_ficha_update_table', array('estadoCites'=>$atributos["Estado CITES"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Estado CITES -->
    	
    	<?php if (!empty($atributos["Etimología del nombre científico"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Etimología del nombre científico',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_etimologia_nombre_cientifico_asignados_ficha_update_table', array('etimologiaNombreCientifico'=>$atributos["Etimología del nombre científico"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Etimología del nombre científico -->
    	
    	<?php if (!empty($atributos["Factores de amenaza"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Factores de amenaza',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_factores_amenaza_asignados_ficha_update_table', array('factoresAmenaza'=>$atributos["Factores de amenaza"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Factores de amenaza -->
    	
    	<?php if (!empty($atributos["Hábitat"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Hábitat',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_habitat_asignados_ficha_update_table', array('habitat'=>$atributos["Hábitat"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Hábitat -->
    	
    	<?php if (!empty($atributos["Hábito"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Hábito',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_habito_asignados_ficha_update_table', array('habito'=>$atributos["Hábito"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Hábito -->
    	
    	<?php if (!empty($atributos["Imagen"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Imagen',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_imagen_asignados_ficha_update_table', array('imagen'=>$atributos["Imagen"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Imagen -->
    	
    	<?php if (!empty($atributos["Impactos"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Impactos',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_impactos_asignados_ficha_update_table', array('impactos'=>$atributos["Impactos"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Impactos -->
    	
    	<?php if (!empty($atributos["Información de alerta"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Información de alerta',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_informacion_alerta_asignados_ficha_update_table', array('informacionAlerta'=>$atributos["Información de alerta"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Información de alerta -->
    	
    	<?php if (!empty($atributos["Información de tipos"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Información de tipos',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_informacion_tipos_asignados_ficha_update_table', array('informacionTipos'=>$atributos["Información de tipos"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Información de tipos -->
    	
    	<?php if (!empty($atributos["Información de usos"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Información de usos',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_informacion_usos_asignados_ficha_update_table', array('informacionUsos'=>$atributos["Información de usos"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Información de usos -->
    	
    	<?php if (!empty($atributos["Invasora"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Invasora',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_invasora_asignados_ficha_update_table', array('invasora'=>$atributos["Invasora"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Invasora -->
    	
    	<?php if (!empty($atributos["Mapa"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Mapa',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_mapa_asignados_ficha_update_table', array('mapa'=>$atributos["Mapa"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Mapa -->
    	
    	<?php if (!empty($atributos["Mecanismos de control"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Mecanismos de control',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_mecanismos_control_asignados_ficha_update_table', array('mecanismosControl'=>$atributos["Mecanismos de control"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Mecanismos de control -->
    	
    	<?php if (!empty($atributos["Medidas de conservación"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Medidas de conservación',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_medidas_conservacion_asignados_ficha_update_table', array('medidasConservacion'=>$atributos["Medidas de conservación"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Medidas de conservación -->
    	
    	<?php if (!empty($atributos["Metadatos"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Metadatos',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_metadatos_asignados_ficha_update_table', array('metadatos'=>$atributos["Metadatos"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Metadatos -->
    	
    	<?php if (!empty($atributos["Origen"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Origen',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_origen_asignados_ficha_update_table', array('origen'=>$atributos["Origen"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Origen -->
    	
    	<?php if (!empty($atributos["Otros recursos en Internet"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Otros recursos en Internet',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_otros_recursos_internet_asignados_ficha_update_table', array('otrosRecursosInternet'=>$atributos["Otros recursos en Internet"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Otros recursos en Internet -->
    	
    	<?php if (!empty($atributos["Recursos multimedia"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Recursos multimedia',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_recursos_multimedia_asignados_ficha_update_table', array('recursosMultimedia'=>$atributos["Recursos multimedia"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Recursos multimedia -->
    	
    	<?php if (!empty($atributos["Referencias bibliográficas"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Referencias bibliográficas',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_referencias_bibliograficas_asignados_ficha_update_table', array('referenciasBibliograficas'=>$atributos["Referencias bibliográficas"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Referencias bibliográficas -->
    	
    	<?php if (!empty($atributos["Región natural"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Región natural',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_region_natural_asignados_ficha_update_table', array('regionNatural'=>$atributos["Región natural"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Región natural -->
    	
    	<?php if (!empty($atributos["Registros biológicos"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Registros biológicos',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_registros_biologicos_asignados_ficha_update_table', array('registrosBiologicos'=>$atributos["Registros biológicos"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Registros biológicos -->
    	
    	<?php if (!empty($atributos["Reproducción"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Reproducción',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_reproduccion_asignados_ficha_update_table', array('reproduccion'=>$atributos["Reproducción"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Reproducción -->
    	
    	<?php if (!empty($atributos["Revisor(es)"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Revisor(es)',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_revisores_asignados_ficha_update_table', array('revisores'=>$atributos["Revisor(es)"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Revisor(es) -->
    	
    	<?php if (!empty($atributos["Sinónimos"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Sinónimos',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_sinonimos_asignados_ficha_update_table', array('sinonimos'=>$atributos["Sinónimos"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Sinónimos -->
    	
    	<?php if (!empty($atributos["Sonido"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Sonido',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_sonido_asignados_ficha_update_table', array('sonido'=>$atributos["Sonido"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Sonido -->
    	
    	<?php if (!empty($atributos["Video"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Video',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_video_asignados_ficha_update_table', array('video'=>$atributos["Video"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin video -->
    	
    	<?php if (!empty($atributos["Vocalizaciones"])) { ?>
    	<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Vocalizaciones',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    	));?>
    	<?php echo $this->renderPartial('//catalogo/_atributos_vocalizaciones_asignados_ficha_update_table', array('vocalizaciones'=>$atributos["Vocalizaciones"], 'idCatalogo'=>$model->catalogoespecies_id)); ?>
    	<?php $this->endWidget();?>
    	<?php } ?> <!-- Fin Vocalizaciones -->