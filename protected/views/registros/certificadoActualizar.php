<style>
p{
	font-size: 12px
}
</style>
<table style="padding-top: 70px;">
  <tr>
    <td><h3 style="font-size: 14px">Número de certificado: <?=$idCert;?></h3></td>
  </tr>
  <tr>
	<td><h2 style="text-align: center;font-size: 16px">Registro Nacional de Colecciones (RNC)<br> Notificación de actualización</h2></td>
  </tr>
  <tr>
  	<td >
  		<p style="text-align: justify;">
		La colección biológica denominada <b><?=$model->nombre;?></b>, identificada con el acrónimo <b><?=$model->acronimo;?></b>, 
		cuyo titular es <b><?=$model->registros->entidad->titular;?></b> identificado con el NIT/CC <b><?=$model->registros->entidad->nit;?></b>, 
		registrada bajo el número <b><?=$model->registros->numero_registro;?></b>, actualizó su información en el Registro Único Nacional de Colección Biológicas (RNC), 
		el día <?=$fechaAct['mday']?> del mes <?=$fechaAct['mon']?> del año <?=$fechaAct['year']?>.
		</p>
		<p style="text-align: justify;">
		La actualización corresponde a la autodeclaración realizada por el titular de la colección a través de la aplicación 
		en línea del Registro Único Nacional de Colecciones Biológicas (RNC), según lo establecido en el Decreto 1375 de 2013
		 “Por el cual se reglamentan las colecciones biológicas”.
		</p>
		<p >Se expide en Bogotá D.C, a los <?=$fecha['mday']?> días del mes <?=$fecha['mon']?> del año <?=$fecha['year']?>.</p>
		<p >La veracidad de esta notificación se puede corroborar en la siguiente dirección web:</p>
		<p style="text-align: center;"><a href="<?=$ruta;?>" style="color: #000;font-size: 10px"><?=$ruta?></a></p>
  	</td>
  </tr>
  
</table>
