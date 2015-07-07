<style>

input[type="search"]{
	width: 250px
}
</style>
<script type="text/javascript">

var dataset = <?php echo json_encode($listRegistros);?>;

$(document).ready(function() {
    $('#certificados_table').dataTable( {
        "data": dataset,
        
    } );
} );

</script>
<table id="certificados_table" class="display" cellspacing="0" >
    <thead>
        <tr>
        	<th>Número de Registro</th>
        	<th>Colección</th>
        	<th>Entidad</th>
            <th>Nombre Archivo</th>
            <th>Opción</th>
        </tr>
    </thead>
 
    
</table>