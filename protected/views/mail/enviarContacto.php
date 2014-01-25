<html>
	<head>
   	
   </head>
   <body>
   		
   		<table width = "650" border = "0" cellspacing="0" cellpadding="0">
   			<style>
		   		th{
		   			text-align: justify;
		   		}
		   	</style>
   			<tr style = "background-color: rgba(17, 131, 85, 0.75)">
				<td style="color: #ffffff;padding: 10px;height: 20px">
					Mensaje Plataforma RNC
				</td>
			</tr>
			<tr>
				<td style="padding: 30px;border-style: solid;border-color: #eeeeee">
					<p>Cordial Saludo,</p>
					<p>Se hizo efectivo el envío de la siguiente solicitud:</p>
					
					<?php 
						$this->widget('zii.widgets.CDetailView', array(
								'data'=>$data,
								'attributes'=>array(
									'nombre',
									'email',
									'registros.numero_registro',
									array(
											'name' => 'titular',
											'type'	=> 'raw',
											'value' => CHtml::encode(isset($data->entidad->titular) ? $data->entidad->titular : "No Asignado")
									),
									array(
										'name' => 'tipo_solicitud',
										'type'	=> 'raw',
										'value' => CHtml::encode(($data->tipo_solicitud == 1) ? "Petición" : (($data->tipo_solicitud == 2) ? "Queja" : (($data->tipo_solicitud == 3) ? "Felicitación" : "No Asignado")))
									),
									array(
										'name' => 'estado',
										'type'	=> 'raw',
										'value' => CHtml::encode(($data->estado == 0) ? "Pendiente" : "Cerrado")
									),
									'descripcion'
								)
						));
					?>
				</td>
			</tr>
   		</table>
   </body>
</html>