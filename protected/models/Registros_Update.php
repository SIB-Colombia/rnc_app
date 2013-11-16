<?php
/**
 * This is the model class for table "registros_update".
 *
 * The followings are the available columns in table 'registros_update':
 * @property int 	$id
 * @property date 	$fecha_act
 * @property date 	$fecha_rev
 * @property string $nombre
 * @property string $acronimo
 * @property int 	$fecha_fund
 * @property string	$descripcion
 * @property string	$direccion
 * @property int	$ciudad_id
 * @property string	$telefono
 * @property string	$email
 * @property string	$cobertura_tax
 * @property string	$cobertura_geog
 * @property string	$cobertura_temp
 * @property string	$listado_anexos
 * @property string	$info_adicional
 * @property string	$pagina_web
 * @property string	$redes_social
 * @property string $comentario_obv
 * @property int	$estado
 * @property string $comentario
 * @property int	$tamano_coleccion_total
 * @property int	$tipo_coleccion_total
 * 
 * @property int $contactos_id
 * @property int $dilegenciadores_id
 * @property int $registro_id
 *
 * The followings are the available model relations:
 *
 * @property Registros 				$registros
 * @property Composicion_General 	$composicion_general
 * @property Tamano_Coleccion		$tamano_coleccion
 * @property Tipos_En_Coleccion		$tipos_en_coleccion
 * @property Contactos				$contactos
 * @property Dilegenciadores		$dilegenciadores
 * @property Archivos				$archivos
 */

class Registros_Update extends CActiveRecord
{
	private $archivoAnexo;
	private $archivoColeccion;
	private $archivoDivulgativo;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'registros_update';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('nombre,acronimo,fecha_fund,descripcion,direccion,ciudad_id,telefono,email,cobertura_tax,cobertura_geog,cobertura_temp,listado_anexos','required'),
				array('nombre,direccion,telefono,pagina_web','length','max'=>150),
				array('acronimo,email','length','max'=>45),
				array('cobertura_tax,cobertura_geog,cobertura_temp,redes_social','length','max'=>200),
				array('email', 'email'),
				/*array('archivoAnexo','file','maxSize' => 20000,'types' => 'pdf,zip'),
				array('archivoColeccion','file','maxSize' => 20000,'types' => 'jpg,gif,jpeg,avi,mp4,mp3'),
				array('archivoDivulgativo','file','maxSize' => 20000,'types' => 'pdf,jpg,gif,jpeg'),*/
		);
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'registros' 			=> array(self::HAS_MANY, 'Registros', 'registros_update_id'),
				'composicion_general' 	=> array(self::HAS_MANY, 'Composicion_General', 'composicion_general_id'),
				'tamano_coleccion'		=> array(self::HAS_MANY, 'Tamano_Coleccion', 'tamano_coleccion_id'),
				'tipos_en_coleccion'	=> array(self::HAS_MANY, 'Tipos_En_Coleccion', 'tipos_en_coleccion_id'),
				'contactos'				=> array(self::BELONGS_TO, 'Contactos', 'contactos_id'),
				'dilegenciadores'		=> array(self::BELONGS_TO, 'Dilegenciadores', 'dilegenciadores_id'),
				'county' 				=> array(self::BELONGS_TO, 'County', 'ciudad_id'),
				'archivos'				=> array(self::HAS_MANY,'Archivos', 'Registros_update_id')
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'fecha_act'					=> 'Última fecha de revisión',
				'nombre'					=> 'Nombre de la colección',
				'acronimo'					=> 'Acrónimo',
				'fecha_fund'				=> 'Año de fundación',
				'descripcion'				=> 'Descripción',
				'direccion'					=> 'Dirección de la colección',
				'ciudad_id'					=> 'Ciudad',
				'telefono'					=> 'Teléfono',
				'email'						=> 'Correo electrónico',
				'cobertura_tax'				=> 'Cobertura taxonómica',
				'cobertura_geog'			=> 'Cobertura geográfica',
				'cobertura_temp'			=> 'Cobertura temporal',
				'listado_anexos'			=> 'Listado de anexos',
				'info_adicional'			=> 'Información adicional',
				'pagina_web'				=> 'Página web de la colección',
				'redes_social'				=> 'Redes sociales de la colección',
				'comentario_obv'			=> 'OBSERVACIONES, COMENTARIOS O SOLICITUDES',
				'estado'					=> 'Estado',
				'comentario'				=> 'Comentarios',
				'tamano_coleccion_total' 	=> 'Total',
				'tipo_coleccion_total' 		=> 'Total',
				'archivoAnexo'				=> 'Anexos',
				'archivoColeccion'			=> 'Fotos y videos de la colección',
				'archivoDivulgativo'		=> 'Material divulgativo'
		);
	}
	
	public function listYearFund()
	{
		$listyear = array();
		$year		= 1800;
		for ($i = 0; $i < 221; $i++) {
			$listyear[$i] = ['id' => $year + $i, 'nombre' => $year + $i];
		}
		
		return CHtml::listData($listyear, 'id','nombre');
	}
	
	public function ListarCiudades()
	{
		return CHtml::listData(County::model()->findAll(County::model()->listCounty()), 'id','county_name');
	}
	
	public function getArchivoAnexo() {
		return $this->archivoAnexo;
	}
	
	public function setArchivoAnexo($value)
	{
		$this->archivoAnexo = $value;
	}
	
	public function getArchivoColeccion() {
		return $this->archivoColeccion;
	}
	
	public function setArchivoColeccion($value)
	{
		$this->archivoColeccion = $value;
	}
	
	public function getArchivoDivulgativo() {
		return $this->archivoDivulgativo;
	}
	
	public function setArchivoDivulgativo($value)
	{
		$this->archivoDivulgativo = $value;
	}
}
?>