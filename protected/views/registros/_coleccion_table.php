<?php
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
		'type'=>'striped bordered condensed',
		'id'=>'registros_lista-grid',
		//'fixedHeader' => true,
		'dataProvider'=>$listRegistros,
		//'responsiveTable' => true,
		//'filter'=>$model,
		//'ajaxUrl'=>array('registros/busqueda'),
		'columns'=>array(
				array('name'=>'numero', 'header'=>'Número de registro'),
				array('name'=>'titular', 'header'=>'Titular de la colección'),
				array('name'=>'nombre', 'header'=>'Nombre colección'),
				array('name'=>'acronimo', 'header'=>'Acrónimo'),
				array('name'=>'fundacion', 'header'=>'Año Fundación'),
				array('name'=>'departamento', 'header'=>'Departamento'),
				array('name'=>'ciudad', 'header'=>'Municipio'),
				array('name'=>'fecha', 'header'=>'Fecha de última actualización'),
				array('name'=>'tipo', 'header'=>'Tipo de colección'),
				array('name'=>'contacto', 'header'=>'Nombre de contacto'),
				array('name'=>'cargo', 'header'=>'Cargo'),
				array('name'=>'email', 'header'=>'Correo electrónico'),
				array('name'=>'telefono', 'header'=>'Teléfono'),
		),
));
?>