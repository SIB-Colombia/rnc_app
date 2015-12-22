<style>
p{
	font-size: 10px
}
</style>
<table style="padding-top: 50px;">
  <tr>
    <td><h3 style="font-size: 13px">Número de certificado: <?=$idCert;?></h3></td>
  </tr>
  <tr>
	<td><h2 style="text-align: center;font-size: 15px">Registro Único Nacional de Colecciones (RNC)<br> Notificación de actualización</h2></td>
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
		La actualización corresponde a la autodeclaración realizada por el titular de la colección a través de la aplicación en línea del Registro Único Nacional de Colecciones Biológicas (RNC), según lo establecido en el Decreto 1076 de 2015 "Por medio del cual se expide el Decreto Único Reglamentario del Sector Ambiente y Desarrollo Sostenible".
		</p>
		<p >Se expide en Bogotá D.C, a los <?=$fecha['mday']?> días del mes <?=$fecha['mon']?> del año <?=$fecha['year']?>.</p>
		<p >La veracidad de esta notificación se puede corroborar en la siguiente dirección web:</p>
		<p style="text-align: center;"><a href="<?=$ruta;?>" style="color: #000;font-size: 10px"><?=$ruta?></a></p>
		<p style="color: #000;font-size: 9px">
			<b>Notas aclaratorias:</b>
		</p>
		<p style="color: #000;font-size: 6px"><b>Decreto 1076 de 2015 Artículo 2.2.2.9.1.9.:</b> La movilización de especímenes en el territorio nacional provenientes de colecciones que cuenten con el Registro Único Nacional de Colecciones Biológicas no requiere salvoconducto para su movilización, ya que actuará como tal la constancia de dicho registro expedida por el Instituto de Investigación de Recursos Biológicos “Alexander von Humboldt”, junto con la certificación suscrita por el titular de la colección, en la que consten los especímenes movilizados. </p>

		<p style="color: #000;font-size: 6px"><b>Decreto 1076 de 2015 artículo 2.2.2.9.1.2 Ámbito de aplicación. Parágrafo 1:</b> Los zoológicos, acuarios y jardines botánicos atenderán lo dispuesto por la normatividad vigente sobre la materia. <b>Parágrafo 2:</b> Las disposiciones contenidas en el presente decreto se aplican sin perjuicio de las normas vigentes sobre bioseguridad, salud pública, sanidad animal y vegetal. (Decreto 1375 de 2013, art. 2)</p>

		<p style="color: #000;font-size: 6px">De acuerdo con lo anterior, la movilización de especímenes vivos, elaboración de planes de manejo, permisos de recolección, entre otros, que realicen los zoológicos, acuarios, jardines botánicos y similares serán objeto de definición y seguimiento por la autoridad ambiental competente.</p>
  	</td>
  </tr>

</table>
