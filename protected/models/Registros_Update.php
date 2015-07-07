<?php
/**
 * This is the model class for table "registros_update".
 *
 * The followings are the available columns in table 'registros_update':
 * @property int 	$id
 * @property date 	$fecha_act
 * @property date 	$fecha_rev
 * @property date	$fecha_env
 * @property string $nombre
 * @property string $acronimo
 * @property int 	$fecha_fund
 * @property string	$descripcion
 * @property string	$direccion
 * @property string	$ciudad_id
 * @property string	$departamento_id
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
 * @property int	$terminos
 * @property float  $deorreferenciados
 * @property string $sistematizacion
 * @property int 	$ejemplar_tipo
 * @property int	$ej_tipo_cantidad
 * 
 * @property int $contactos_id
 * @property int $dilegenciadores_id
 * @property int $registros_id
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

class Registros_update extends CActiveRecord
{
	private $archivoAnexo;
	private $archivoColeccion;
	private $archivoDivulgativo;
	
	private $archivosAnexos;
	private $archivosColecciones;
	private $archivosDivulgativos;
	public  $archivoCertificado;
	public  $archivoCertificados;

	
	public $comentarioCancelar;
	
	public $aprobadop;
	public $elaborado;
	
	public $notificar;
	
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
				array('nombre,acronimo,fecha_fund,descripcion,direccion,departamento_id,ciudad_id,telefono,email,cobertura_tax,cobertura_geog,cobertura_temp,listado_anexos,terminos,sistematizacion,deorreferenciados','required'),
				array('nombre,telefono,pagina_web','length','max'=>150),
				array('acronimo,email','length','max'=>45),
				array('ej_tipo_cantidad','numerical','integerOnly'=>true,'message' => 'El dato solo puede ser numérico'),
				array('deorreferenciados','numerical','min' => 0,'max' => 100,'message' => 'El dato solo puede ser numérico'),
				array('cobertura_tax,cobertura_geog,cobertura_temp,redes_social,info_adicional','length','max'=>4000),
				array('sistematizacion,direccion,comentario','length','max'=>4000),
				array('email', 'email'),
				array('acronimo', 'safe', 'on'=>'search'),
				
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
				'registros' 			=> array(self::BELONGS_TO, 'Registros', 'registros_id'),
				'composicion_general' 	=> array(self::HAS_MANY, 'Composicion_General', 'Registros_update_id'),
				'tamano_coleccion'		=> array(self::HAS_MANY, 'Tamano_Coleccion', 'Registros_update_id'),
				'tipos_en_coleccion'	=> array(self::HAS_MANY, 'Tipos_En_Coleccion', 'Registros_update_id'),
				'contactos'				=> array(self::BELONGS_TO, 'Contactos', 'contactos_id'),
				'dilegenciadores'		=> array(self::BELONGS_TO, 'Dilegenciadores', 'dilegenciadores_id'),
				'county' 				=> array(self::BELONGS_TO, 'County', 'ciudad_id'),
				'department'			=> array(self::BELONGS_TO, 'Department', 'departamento_id'),
				'archivos'				=> array(self::HAS_MANY,'Archivos', 'Registros_update_id'),
				'estado_registro'		=> array(self::BELONGS_TO,'Estado_Registro','estado')
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'fecha_act'					=> 'Fecha de la última actualización',
				'fecha_rev'					=> 'Última fecha de revisión',
				'fecha_env'					=> 'Fecha de envío de la solicitud',
				'nombre'					=> 'Nombre de la colección',
				'acronimo'					=> 'Acrónimo',
				'fecha_fund'				=> 'Año de fundación',
				'descripcion'				=> 'Descripción',
				'direccion'					=> 'Dirección de la colección',
				'ciudad_id'					=> 'Municipio',
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
				'archivoColeccion'			=> 'Material divulgativo',
				'archivoDivulgativo'		=> 'Material divulgativo',
				'terminos'					=> 'Acepto los términos y condiciones.',
				'sistematizacion'			=> 'Sistematización y publicación',
				'deorreferenciados'			=> 'Porcentaje de especímenes georreferenciados',
				'departamento_id'			=> 'Departamento',
				'ejemplar_tipo'				=> '¿La colección cuenta con ejemplares tipo?',
				'ej_tipo_cantidad'			=> '¿Cuántos ejemplares tipo existen?',
				'comentarioCancelar'		=> 'Motivo de la cancelación',
				'aprobado'					=> 'Aprobado',
				'aprobadop'					=> 'Aprobado por',
				'elaborado'					=> 'Elaborado por',
				'notificar'					=> 'Notificar al usuario'
		);
	}
	
	public function search(){
		
		$criteria=new CDbCriteria;
		if(isset($this->registros->numero_registro)){
			$criteria->compare('registros.numero_registro', $this->registros->numero_registro);
		}
		if(isset($this->registros->fecha_dil)){
			$criteria->compare('registros.fecha_dil', $this->registros->fecha_dil);
		}
		if(isset($this->registros->estado)){
			$criteria->compare('registros.estado', $this->registros->estado);
		}
		$criteria->compare('t.estado', 2);
		$criteria->compare('acronimo',$this->acronimo);
		
		if(isset($this->registros->entidad)){
			$criteria->compare('registros.entidad.id',$this->registros->entidad->id);
		}
		
		$criteria->with = array('registros','county');
		
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort' => false,
				'pagination'=>array(
						'pageSize'=>20,
						)
					));
	}
	
	public function dataTamanoList($id){
		$criteria = new CDbCriteria;
		
		$criteria->compare('t.Registros_update_id', $id);
		$criteria->with = array('tipo_preservacion');
		$criteria->order = 't.id ASC';
		
		$modelTamano = Tamano_Coleccion::model()->find();
		
		return new CActiveDataProvider($modelTamano, array(
				'criteria'=>$criteria,
				'sort' => false,
				'pagination'=>array(
						'pageSize'=>5,
				)
		));
	}
	
	public function dataTipoList($id){
		$criteria = new CDbCriteria;
	
		$criteria->compare('t.Registros_update_id', $id);
		$criteria->order = 'id ASC';
	
		$modelTipo = Tipos_En_Coleccion::model();
	
		return new CActiveDataProvider($modelTipo, array(
				'criteria'=>$criteria,
				'sort' => false,
				'pagination'=>array(
						'pageSize'=>5,
				)
		));
	}
	
	public function dataComposicionList($id){
		$criteria = new CDbCriteria;
	
		$criteria->compare('t.Registros_update_id', $id);
		$criteria->with = array('grupo_taxonomico','subgrupo_taxonomico');
		$criteria->order = 't.id ASC';
		
		$modelComposicion = Composicion_General::model();
	
		return new CActiveDataProvider($modelComposicion, array(
				'criteria'=>$criteria,
				'sort' => false,
				'pagination'=>array(
						'pageSize'=>5,
				)
		));
	}
	
	public function dataArchivosList($id){
		$criteria = new CDbCriteria;
	
		$criteria->compare('t.Registros_update_id', $id);
		$criteria->order = 'clase ASC';
	
		$modelArchivo = Archivos::model();
	
		return new CActiveDataProvider($modelArchivo, array(
				'criteria'=>$criteria,
				'sort' => false,
				'pagination'=>array(
						'pageSize'=>100,
				)
		));
	}
		
	public function listarRegistrosDetalles($id){
		$criteria = new CDbCriteria;
		
		$criteria->compare('t.registros_id', $id);
		
		if(Yii::app()->user->getState("roles") == "admin"){
			$criteria->addCondition('t.estado != 0');
		}
		
		$criteria->order = 'fecha_act DESC';
		
		$criteria->with = array('county');
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort' => false,
				'pagination'=>array(
						'pageSize'=>20,
				)
		));
	}
	
	public function listYearFund()
	{
		$listyear = array();
		$year		= 1800;
		for ($i = 0; $i < 221; $i++) {
			$listyear[$i] = array('id' => $year + $i, 'nombre' => $year + $i);
		}
		
		return CHtml::listData($listyear, 'id','nombre');
	}
	
	public function crearEstilo(){
		if($this->estado != 0){
			return '<a class="view" rel="tooltip" href="/rnc_app/index.php/registros/viewDetail/5" data-original-title="Mostrar">
<i class="icon-eye-open"></i></a>';
		}else return "";
	}
	public function ListarCiudades()
	{
		return CHtml::listData(County::model()->findAll(County::model()->listCounty()), 'iso_county_code','county_name');
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
	
	public function getArchivosAnexos() {
		return $this->archivosAnexos;
	}
	
	public function setArchivosAnexos($value)
	{
		$this->archivosAnexos = $value;
	}
	
	public function getArchivosColecciones() {
		return $this->archivosColecciones;
	}
	
	public function setArchivosColecciones($value)
	{
		$this->archivosColecciones = $value;
	}
	
	public function getArchivosDivulgativos() {
		return $this->archivosDivulgativos;
	}
	
	public function setArchivosDivulgativos($value)
	{
		$this->archivosDivulgativos = $value;
	}
	
	public function listarColecciones()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
		
		$criteria->compare('t.estado', 2);
				
		$criteria->with = array('registros','county','contactos');
	
			
		return $criteria;
	}
	
}
?>