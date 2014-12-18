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
						 }
				    }
				 );

	$("#registros_table thead input").on( 'keyup change', function () {
        table
        	.column( $(this).parent().index()+':visible' )
        	.search( this.value )
        	.draw();
    } );
} );

</script>

<style>
<!--

-->

@media 
only screen and (max-width: 1120px),
(min-device-width: 768px) and (max-device-width: 1024px)  {
	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50% !important; 
	}
	
	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
	}
	
	td:nth-of-type(1):before { content: "Número de registro"; }
	td:nth-of-type(2):before { content: "Titular de la colección"; }
	td:nth-of-type(3):before { content: "Nombre colección"; }
	td:nth-of-type(4):before { content: "Acrónimo"; }
	td:nth-of-type(5):before { content: "Año Fundación"; }
	td:nth-of-type(6):before { content: "Departamento"; }
	td:nth-of-type(7):before { content: "Municipio"; }
	td:nth-of-type(8):before { content: "Fecha de última actualización"; }
	td:nth-of-type(9):before { content: "Tipo de colección"; }
	td:nth-of-type(10):before { content: "Nombre de contacto"; }
	td:nth-of-type(11):before { content: "Cargo"; }
	td:nth-of-type(12):before { content: "Correo electrónico"; }
	td:nth-of-type(13):before { content: "Teléfono"; }
}
</style>

<fieldset>
	<h1 style="margin:0 0 -25px 0;">Listado de colecciones registradas</h1>
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
            <th>Tipo de colección</th>
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
            <th>Tipo de colección</th>
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