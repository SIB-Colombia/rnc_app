<?php
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
		'type'=>'striped bordered condensed',
		'id'=>'entidad-sol-grid',
		'dataProvider'=>$listRegistros,
		'ajaxUrl'=>'',
		'columns'=>array(
			'numero_registro',
			'fecha_dil',
			'fecha_prox',
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
				'template'=>'{val}',
				'buttons'=>array
				(
					'val' => array
					(
						'label'=>'Actualizar',
						'url'=>'Yii::app()->createUrl("registros/actualizar", array("id"=>$data->id))',
						'options'=>array(
								'class'=>'btn btn-success btn-small',
								),
					)
				),
				'htmlOptions'=>array('style'=>'width: 50px'),
			)
		),
)); ?>
