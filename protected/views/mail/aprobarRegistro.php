<html>
	<head>
   	
   </head>
   <body>
   		<table width = "650" border = "0" cellspacing="0" cellpadding="0">
   			<tr style = "background-color: rgba(17, 131, 85, 0.75)">
				<td style="color: #ffffff;padding: 10px;height: 20px">
					Mensaje Plataforma RNC
				</td>
			</tr>
			<tr>
				<td style="padding: 30px;border-style: solid;border-color: #eeeeee">
					<p>Cordial Saludo:</p>
					<p>El registro de la colección <i><?=$data->numero_registro;?></i> fué revisado por el administrador con la siguiente retroalimentación:</p>
					
					<?php 
						$this->widget('zii.widgets.CDetailView', array(
								'data'=>$data,
								'attributes'=>array(
										'numero_registro',
										array(
												'name' => 'Colecci&oacute;n',
												'type'	=> 'raw',
												'value' => CHtml::encode($data->registros_update->nombre)
										),
										'fecha_dil',
										'fecha_prox',
										'registros_update.fecha_rev',
										array(
												'name' => 'estado',
												'type'	=> 'raw',
												'value' => CHtml::encode(($data->registros_update->estado == 0) ? "Sin Enviar" : (($data->registros_update->estado == 1) ? "En Revisión" : (($data->registros_update->estado == 2) ? "Aprobado" : (($data->registros_update->estado == 3) ? "No Aprobado" : "Aprobado"))))
										),
										array(
												'name' => 'Comentarios',
												'type'	=> 'raw',
												'value' => CHtml::encode($data->registros_update->comentario)
										)
								),
						));
					?>
				</td>
			</tr>
   		</table>
   </body>
</html>