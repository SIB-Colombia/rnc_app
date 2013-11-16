<?php
/* @var $this TaxonController */
/* @var $model Taxontree */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.uploadify.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/uploadify.css');
?>
<script type="text/javascript">
	var $tabs = $('.tabbable li');
	var dataSearch = "";
	var dataExport;
	var datos 		= "";
	var datosFile	= "";

	$('#prevtab').on('click', function() {
    	$tabs.filter('.active').prev('li').find('a[data-toggle="tab"]').tab('show');
	});

	$(function() {
	    $('#Taxontree_archivoTaxones').uploadify({
	    	'buttonText'	: 'Seleccionar Archivo',
	    	'width'         : 140,
	    	'fileTypeExts'  : '*.xlsx;*.xls;*.txt;*.csv',
	    	'multi'			: false,
	    	'swf'      		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.swf',
	        'uploader' 		: '<?=Yii::app()->theme->baseUrl;?>/scripts/uploadify.php',
			'onUploadComplete' : function(file){
				$.post("readFile", {archivo: file.name, tipo: file.type},function(data){
					
				
					$("#Taxontree_datosExportar").val(data);
					$.fn.yiiGridView.update('taxones-grid', {data: {Taxontree: {nombresTaxones : data}}});
				});
			}
	    });
	});

	function buscarTaxones(id,modal,grid){
		datos 		= $.trim($("#Taxontree_nombresTaxones").val());
		datosFile 	= $.trim($("#Taxontree_archivoTaxones").val());

		if(datosFile != ""){
			if(window.FormData){
				return false;
			}
		}else if(datos != ""){
			$("#Taxontree_datosExportar").val(datos);
			$.fn.yiiGridView.update(grid, {data: $('#'+id).serialize()});
		}else{
			return false;
		}
	}

	function exportarTabla(){
		$('#taxon-form-data').submit();
	}
</script>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'taxon-form-data',
    'action' => 'exportData',
	'htmlOptions'=>array('name' => 'datos'),
    'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->hiddenField($model, 'datosExportar'); ?>
<?php $this->endWidget();?>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'taxon-form',
    'type'=>'horizontal',
	'htmlOptions'=>array('enctype'=>'multipart/form-data','name' => 'prueba'),
    'enableClientValidation'=>true,
	'enableAjaxValidation'=>false,
)); ?>
<div class="tabbable"> <!-- Only required for left/right tabs -->
	<ul class="nav nav-tabs">
    	<li class="active"><a href="#tab1" data-toggle="tab">Ingresar Lista</a></li>
    	<li><a href="#tab2" data-toggle="tab">Subir Archivo</a></li>
  	</ul>
  	<div class="tab-content">
  		<div class="tab-pane fade in active" id="tab1">
	  		<fieldset>
	  			<legend>Ingrese los nombres científicos.</legend>
	  			<?php echo $form->textAreaRow($model, 'nombresTaxones', array('class'=>'span6', 'rows'=>5)); ?>
	  		</fieldset>
  		</div><!-- End tab1 -->
  		
  		<div class="tab-pane fade" id="tab2">
  			<fieldset>
	  			<legend>Ingrese el archivo con los nombres.</legend>
	  			<?php echo $form->fileFieldRow($model, 'archivoTaxones'); ?>
	  		</fieldset>
  		</div><!-- End tab2 -->
  		<div class="pull-right">
		    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'type'=>'primary', 'label'=>'Buscar Taxones', 'loadingText' => 'Cargando...', 'htmlOptions' => array('id' => 'enviarData','onclick'=>'{buscarTaxones(\'taxon-form\',\'enviarData\',\'taxones-grid\')}'))); ?>
		    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Limpiar')); ?>
		    <?php //$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Cancelar', 'submit'=>array('catalogo/index'))); ?>
		</div>
  	</div> <!-- End tab-content -->
</div><!-- End tabbable -->
<?php $this->endWidget();?>

<?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
			'title' => 'Lista Taxones',
    		'headerIcon' => 'icon-th-list',
    		// when displaying a table, if we include bootstra-widget-table class
    		// the table will be 0-padding to the box
    		'htmlOptions' => array('class'=>'bootstrap-widget-table'),
    		'headerButtons' => array(
				array(
					'class' => 'bootstrap.widgets.TbButtonGroup',
					'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
					'buttons' => array(
						array(
							'label' => 'Exportar Datos',
							'url' => '#',
							'icon'=>'icon-plus',
							'htmlOptions' => array(
								'onclick'=>'{exportarTabla()}',
								'data-toggle' => 'modal',
								'data-target' => '#exportarTaxonesModal',
							),
						),
					)
    			),
    		)
    	));?>


<?php 
echo $this->renderPartial('_taxones_lista', array('listTaxones' => $gridDataProvider)); 
?>
<?php $this->endWidget();?>