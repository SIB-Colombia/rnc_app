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
					<p>La solicitud realizada por <i><?=$data->titular;?></i>, fue revisada por el Administrador. La información es la siguiente:</p>
					
					<?php 
						$this->widget('zii.widgets.CDetailView', array(
								'data'=>$data,
								'attributes'=>array(
										'titular',
										'nit',
										array(
												'name' => 'estado',
												'type'	=> 'raw',
												'value' => CHtml::encode(($data->estado == 1) ? "En Espera" : (($data->estado == 2) ? "Aprobado" : "No Aprobado"))
										),
										array(
												'name' => 'Usuario',
												'type'	=> 'raw',
												'value' => CHtml::encode($user != "" ? $user : "No Asignado")
										),
										array(
												'name' => 'Contrase&ntilde;a',
												'type'	=> 'raw',
												'value' => CHtml::encode($pass != "" ? $pass : "No Asignado")
										),
										'comentario'
								)
						));
					?>
				</td>
			</tr>
   		</table>
   </body>
</html>