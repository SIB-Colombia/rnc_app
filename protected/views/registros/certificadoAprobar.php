<style>
p{
	font-size: 12px
}
</style>
<table style="padding-top: 20px;">
  <tr><td></td> </tr>
  <tr>
    <td><h3 style="font-size: 14px">Número de certificado: <?=$idCert;?></h3></td>
  </tr>
  <tr>
	<td><h2 style="text-align: center;font-size: 16px">Registro Nacional de Colecciones (RNC)<br> Certificado de registro</h2></td>
  </tr>
  <tr>
  	<td>
  		<h3 style="text-align: center;font-size: 10px">El Instituto de Investigación de Recursos Biológicos <br> Alexander von Humboldt certifica que:</h3>
  	</td>
  </tr>
  <tr>
  	<td >
  		<p style="text-align: justify;">
		La colección biológica denominada <b><?=$model->nombre;?></b>, identificada con el acrónimo <b><?=$model->acronimo;?></b>, 
		cuyo titular es <b><?=$model->registros->entidad->titular;?></b> identificado con el NIT/CC <b><?=$model->registros->entidad->nit;?></b>, 
		fue registrada bajo el número <b><?=$col;?></b>, en el Registro Único Nacional de Colección Biológicas (RNC), 
		el día <?=$fechaAct['mday']?> del mes <?=$fechaAct['mon']?> del año <?=$fechaAct['year']?>.
		</p>
		<p style="text-align: justify;">
		El registro se realiza de acuerdo con la autodeclaración realizada por el titular de la colección a través de la aplicación 
		en línea del Registro Único Nacional de Colecciones Biológicas (RNC), según lo establecido en el Decreto 1375 de 2013
		 “Por el cual se reglamentan las colecciones biológicas”.
		</p>
		
		<p >Se expide en Bogotá D.C, a los <?=$fecha['mday']?> días del mes <?=$fecha['mon']?> del año <?=$fecha['year']?>.</p>
		
  	</td>
  </tr>
  <tr>
  	<td>
  		<p style="text-align: center;">____________________________________________________<br>Firma<br>Director(a) General</p>
  	</td>
  </tr>
  <tr>
  	<td>
  		<p >La veracidad de esta notificación se puede corroborar en la siguiente dirección web:</p>
  		<p style="text-align: center;"><a href="<?=$ruta;?>" style="color: #000;font-size: 10px"><?=$ruta?></a></p>
  	</td>
  </tr>
  
</table>
