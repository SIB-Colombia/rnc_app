<?php
/* @var $this EntidadController */
/* @var $dataProvider CActiveDataProvider */

Yii::app()->theme = 'rnc_theme_panel';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');

?>

<script type="text/javascript">

	function activarRepLegal(){
		tipoTitular = $("#Entidad_tipo_titular_s").val();
		if(tipoTitular == 2){
			$("#rep_leg_inp").fadeIn("slow");
		}else if(tipoTitular == 1){
			$("#rep_leg_inp").fadeOut("slow");
		}
	}
	
	function buscarEntidades(grid){
		$.fn.yiiGridView.update(grid, {data: $('#busquedaEntidad').serialize()});
	}
</script>

<div id="header-front">Entidades</div>

<div id="content-front">
	<?php 
	$this->widget('bootstrap.widgets.TbButtonGroup', array(
			'buttons'=>array(
					array('label'=>'Nueva entidad', 'icon'=>'icon-plus', 'url'=>array('create')),
					array('label'=>'Inicio', 'icon'=>'icon-home', 'url'=>array('admin/panel')),
			),
	));
	?>
	<i class="icon-print printR" onclick="print();"></i>
	<div class="tabbable"> <!-- Only required for left/right tabs -->
	  
	  	<?php 
			$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			    'id'=>'busquedaEntidad',
			    'type'=>'inline',
			    'htmlOptions'=>array('class'=>'well'),
			)); 
		?>
		<fieldset>
		<legend class="form_legend">Titular</legend>
			<div>
			<?php 
				echo $form->dropDownListRow($model, 'tipo_titular_s', $model->listarTipo(),array('prompt' => 'Seleccionar...','onchange' => 'activarRepLegal()'));
				echo $form->textFieldRow($model, 'titular_s', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			?>
			</div>
			<div>
			<?php 
				echo $form->dropDownListRow($model, 'tipo_nit_s', $model->listarTipoIdTit(),array('prompt' => 'Seleccionar...'));
				echo $form->textFieldRow($model, 'nit_s', array('size'=>32,'maxlength'=>64, 'class'=>'textareaA'));
			?>
			</div>
		</fieldset>
		
		<fieldset id="rep_leg_inp">
		<legend class="form_legend">Representante Legal</legend>
			<div>
			<?php
				echo $form->dropDownListRow($model, 'tipo_id_rep_s', $model->listarTipoIdRep(),array('prompt' => 'Seleccionar...'));
				echo $form->textFieldRow($model, 'representante_id_s', array('size'=>32,'maxlength'=>64, 'class'=>'textareaA'));
			?>
			</div>
			<div>
			<?php 
				echo $form->textFieldRow($model, 'representante_legal_s', array('size'=>32,'maxlength'=>150, 'class'=>'textareaA'));
			?>
			</div>
		</fieldset>
		
		<fieldset>
		<legend class="form_legend">Otros</legend>
			<div class="busq_lab">
			<?php
				echo $form->dropDownListRow($model, 'ciudad_id_s', $model->ListarCiudades(),array('prompt' => 'Seleccionar...'));
				echo $form->dropDownListRow($model, 'estado_s', $model->ListarEstado(),array('prompt' => 'Seleccionar...'));
				
			?>
			</div>
			<div class="busq_lab">
			<?php 
				echo $form->dropDownListRow($model, 'usuario_id_s', $model->ListarUsuarios(),array('prompt' => 'Seleccionar...'));
			?>
			</div>
		</fieldset>
		<div>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'type'=>'success', 'label'=>'Buscar', 'loadingText' => 'Cargando...', 'htmlOptions' => array('id' => 'enviarData','onclick'=>'{buscarEntidades(\'entidades_lista-grid\')}'))); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'Limpiar')); ?>
		</div>
		<?php $this->endWidget(); ?>
		
	  <div class="tab-content">
	       <?php echo $this->renderPartial('_entidades_table', array('listEntidades'=>$model->search())); ?>
	  </div>
	</div>

</div>