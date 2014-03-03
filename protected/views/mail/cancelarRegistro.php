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
					<p>El registro de la colección <i><?=$data->acronimo;?></i> fué cancelado por el administrador con la siguiente retroalimentación:</p>
					
					<?php 
						$this->widget('zii.widgets.CDetailView', array(
								'data'=>$data,
								'attributes'=>array(
										'acronimo',
										'nombre',
										'estado_registro.nombre',
										array(
											'name' => 'Comentarios',
											'type'	=> 'raw',
											'value' => CHtml::encode($comentario)
										)
								),
						));
					?>
				</td>
			</tr>
   		</table>
   </body>
</html>