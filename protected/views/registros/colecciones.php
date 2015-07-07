<?php
Yii::app()->theme = 'rnc_theme';
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/speciesSpecial.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/main.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/css/jquery.dataTables.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jquery.dataTables.js', CClientScript::POS_HEAD);

?>
<style>
#container{
	max-width: 1800px;
}

#content-front{
	margin-top: 60px;
}

.filter_reg{
	width: 70px !important;
}
</style>
<script type="text/javascript">
var dataset = <?php echo $datos;?>;

$(document).ready(function() {

	$('#filters th').each( function () {
        var title = $('#filters thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="'+title+'" class="filter_reg"/>' );
    } );
    
	var table = $('#registros_table').DataTable(
					{ 
				    "data": dataset,
				    "responsive": true,
				    "language": {
						   "info": "Página _PAGE_ de _PAGES_"
						 },
						 
				    }
				 );

	$("#registros_table thead input").on( 'keyup change', function () {
        table
        	.column( $(this).parent().index()+':visible' )
        	.search( this.value )
        	.draw();
    } );

	$("#content-front").width(($( window ).width())*0.92);

	$( window ).resize(function() {
		$("#content-front").width(($( window ).width())*0.92);
		});
} );



</script>

<style>


#content-front {overflow: auto !important}
</style>

<fieldset>
	<h1 style="margin:0 0 -25px 0;">Lista de colecciones registradas</h1>
	<?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'info','label'=>'Descargar lista detallada','url' => Yii::app()->createUrl("reporte/reporte"),'htmlOptions' => array('style' => 'float:left;margin-top:25px')));?>
<div id="content-front">

<table id="registros_table" class="display" cellspacing="0" >
    <thead>
        <tr>
            <th>Número de registro</th>
            <th>Titular de la colección</th>
            <th>Nombre colección</th>
            <th>Acrónimo</th>
            <th>Año Fundación</th>
            <th>Departamento</th>
            <th>Municipio</th>
            <th>Fecha de última actualización</th>
            <th>Nombre de contacto</th>
            <th>Cargo</th>
            <th>Correo electrónico</th>
            <th>Teléfono</th>
        </tr>
        <tr id="filters">
            <th>Número de registro</th>
            <th>Titular de la colección</th>
            <th>Nombre colección</th>
            <th>Acrónimo</th>
            <th>Año Fundación</th>
            <th>Departamento</th>
            <th>Municipio</th>
            <th>Fecha de última actualización</th>
            <th>Nombre de contacto</th>
            <th>Cargo</th>
            <th>Correo electrónico</th>
            <th>Teléfono</th>
        </tr>
    </thead>
 
    
</table>

<?php //echo $this->renderPartial('_coleccion_table', array('listRegistros'=>$model->listarColecciones($datos),'model' => $model)); ?>
</div>
</fieldset>