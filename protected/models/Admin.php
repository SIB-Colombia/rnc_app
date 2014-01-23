<?php
class Admin
{
	function widgetUp(){
		echo '<div id="header-front">Estado RNC</div>';
		
		$total = Registros::model()->colRegistradas();
		$totalEntidad = Entidad::model()->entidadesRegistradas();
		echo '<div style = "padding-left: 5px">';
		echo '<p style="color: #666666"><b>Colecciones Registradas:</b> '.$total.'</p>';
		echo '<p style="color: #666666"><b>Número de Entidades:</b> '.$totalEntidad.'</p>';
		echo '<p style="color: #666666"><b>Número de Ejemplares:</b> '.'</p>';
		echo '</div>';
	}
	
	function widgetDown(){
		echo '<div id="header-front">RNC Año</div>';
		
		$totalNuevas = Registros::model()->colNuevas();
		echo '<div style = "padding-left: 5px">';
		echo '<p style="color: #666666"><b>Nuevas Colecciones:</b> '.$totalNuevas.'</p>';
		echo '<p style="color: #666666"><b>Número de<br> Actualizaciones:</b> '.'</p>';
		echo '</div>';
		
	}
	
	function widgetEntity(){
		echo '<div id="header-front">Notificaciones</div>';
		
		echo '<div style = "padding-left: 5px">';
		echo '<p style="color: #666666"><b>Formularios para revisar:</b> '.'</p>';
		echo '<p style="color: #666666"><b>Número de<br> Respuesta de consultas:</b> '.'</p>';
		echo '</div>';
	}
}