<?php $this->widget('bootstrap.widgets.TbExtendedGridView', array(
	'type'=>'striped bordered condensed',
	'id'=>'catalogo_user-grid',
	//'fixedHeader' => true,
	'dataProvider'=>$model->search(),
	//'responsiveTable' => true,
	'filter'=>$model,
	'ajaxUrl'=>'index',
	'columns'=>array(
		'username',
		'email',
		'role',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'htmlOptions'=>array('style'=>'width: 50px'),
		),
	),
)); ?>