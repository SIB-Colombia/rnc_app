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
			<p>La solicitud fué enviada con éxito, en los próximos días el administrador verificará y hará la respectiva aprobación para el envío de su usuario y contraseña.</p>
			<p>La infomación enviada fue la siguiente:</p>
			<?php 
				$this->widget('zii.widgets.CDetailView', array(
						'data'=>$data,
						'attributes'=>array(
								array(
										'name' => 'tipo_titular',
										'type'	=> 'raw',
										'value' => CHtml::encode(($data->tipo_titular == 1) ? "Persona Natural" : (($data->tipo_titular == 2) ? "Persona Jurídica" : "No Asignado"))
								),
								'titular',
								'nit',
								array(
										'name' => 'representante_legal',
										'type'	=> 'raw',
										'value' => CHtml::encode(($data->representante_legal == "-") ? "No Asignado" : $data->representante_legal)
								),
								array(
										'name' => 'tipo_id_rep',
										'type'	=> 'raw',
										'value' => CHtml::encode(($data->tipo_id_rep == 1) ? "Cédula de Ciudadanía" : (($data->tipo_id_rep == 2) ? "Cédula de Extranjería" : "No Asignado"))
								),
								array(
										'name' => 'representante_id',
										'type'	=> 'raw',
										'value' => CHtml::encode(($data->representante_id == 0) ? "No Asignado" : $data->representante_id)
								),
								array(
										'name' => 'ciudad_id',
										'type'	=> 'raw',
										'value' => CHtml::encode(isset($data->county->county_name) ? $data->county->county_name : "No Asignado")
								),
								'telefono',
								'direccion',
								'email',
								'colecciones'
						),
				));
			?>
			
			<fieldset>
				<legend class="form_legend">Datos del Solicitante</legend>
				<?php 
					$this->widget('zii.widgets.CDetailView', array(
						'data'=>$data->dilegenciadores,
						'attributes'=>array(
							array(
								'name' => 'nombre',
								'type'	=> 'raw',
								'value' => $data->dilegenciadores->nombre
							),
							array(
								'name' => 'dependencia',
								'type'	=> 'raw',
								'value' => $data->dilegenciadores->dependencia
							),
							array(
								'name' => 'cargo',
								'type'	=> 'raw',
								'value' => $data->dilegenciadores->cargo
							),
							array(
								'name' => 'tel&eacute;fono',
								'type'	=> 'raw',
								'value' => $data->dilegenciadores->telefono
							),
							array(
								'name' => 'email',
								'type'	=> 'raw',
								'value' => $data->dilegenciadores->email
							),
						),
					)); 
				?>
			</fieldset>
			
			</td>
		</tr>
	</table>
   </body>
</html>