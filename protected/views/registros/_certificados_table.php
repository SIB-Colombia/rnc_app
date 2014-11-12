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
				array('name'=>'nombre', 'header'=>'Certificados'),
				array(
					'class'=>'bootstrap.widgets.TbButtonColumn',
					'template'=>'{val}',
					'buttons'=>array
					(
						'val' => array
						(
							'label'=>'Ver',
							'url'=>'Yii::app()->createUrl("registros/listarCertificados", array("name"=>$data["dir"]))',
							'options'=>array(
									'class'=>'btn btn-success btn-small',
							),
						)
					),
					'htmlOptions'=>array('style'=>'width: 50px'),
				)
		),
));
?>