<?php
/* @var $this CatalogoespeciesController */
/* @var $model Catalogoespecies */
Yii::app()->theme = 'catalogo_interno';

$this->breadcrumbs=array(
	'Catalogoespecies'=>array('index'),
	'Manage',
);

$this->widget('bootstrap.widgets.TbButtonGroup', array(
		'buttons'=>array(
				array('label'=>'Nueva ficha', 'icon'=>'icon-plus', 'url'=>array('create')),
				array('label'=>'Listar fichas', 'icon'=>'icon-list', 'url'=>'#'),
		),
));

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#catalogoespecies-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Fichas en catálogo</h1>

<?php /*echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); */?>
</div><!-- search-form -->


<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Existentes</a></li>
    <li><a href="#tab2" data-toggle="tab">Revisadas</a></li>
    <li><a href="#tab3" data-toggle="tab">No revisadas</a></li>
    <li><a href="#tab4" data-toggle="tab">Verificadas</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade in active" id="tab1">
    	<?php echo $this->renderPartial('_fichas_existentes_admin_table', array('model'=>$model)); ?>
    </div>
    <div class="tab-pane fade" id="tab2">
    	<?php echo $this->renderPartial('_fichas_revisadas_admin_table', array('revisadas'=>$revisadas)); ?>
    </div>
    <div class="tab-pane fade" id="tab3">
    	<?php echo $this->renderPartial('_fichas_norevisadas_admin_table', array('norevisadas'=>$norevisadas)); ?>
    </div>
    <div class="tab-pane fade" id="tab4">
    	<?php echo $this->renderPartial('_fichas_verificadas_admin_table', array('verificadas'=>$verificadas)); ?>
    </div>
  </div>
</div>
