<?php

/**
 * This is the model class for table "entidad".
*
* The followings are the available columns in table 'entidad':
* @property int $id
* @property int	   $tipo_titular
* @property string $titular
* @property int	   $tipo_nit
* @property string $nit
* @property string $representante_legal
* @property int	   $tipo_id_rep
* @property string $representante_id
* @property int    $ciudad_id
* @property int    $departamento_id
* @property string $telefono
* @property string $direccion
* @property string $email
* @property int	   $estado
* @property string $comentario
* @property int $usuario_id
* @property date $fecha_creacion
* @property int $dilegenciadores_id
* @property int $tipo_institucion_id
* 
* The followings are the available model relations:
* 
* @property Usuario $usuario
* @property Dilegenciadores $dilegenciadores
* @property Tipo_Institucion $tipo_institucion
*/

class Entidad extends CActiveRecord
{
	private $tipo_titular_s;
	private $titular_s;
	private $tipo_nit_s;
	private $nit_s;
	private $representante_legal_s;
	private $tipo_id_rep_s;
	private $representante_id_s;
	private $ciudad_id_s;
	private $estado_s;
	private $usuario_id_s;
	private $aprobado;
	public 	$colecciones;
	
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'entidad';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('tipo_titular,titular,tipo_nit,nit,representante_legal,tipo_id_rep,representante_id,direccion,telefono,email,departamento_id,ciudad_id,colecciones,tipo_institucion_id', 'required'),
				array('titular,telefono,direccion,representante_legal,email', 'length', 'max'=>150),
				array('nit,representante_id','length', 'max'=>64),
				array('email', 'email'),
				array('representante_id','numerical','integerOnly'=>true,'message' => 'El dato solo puede ser numérico'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				//array('titular,nit,representante_id,direccion,telefono,email,dependencia_d,cargo_d,telefono_d,', 'safe', 'on'=>'search'),
				array('titular', 'safe', 'on'=>'searchDetail'),
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
				'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_id'),
				'dilegenciadores' => array(self::BELONGS_TO, 'Dilegenciadores', 'dilegenciadores_id'),
				'county' => array(self::BELONGS_TO, 'County', 'ciudad_id'),
				'department' => array(self::BELONGS_TO, 'Department', 'departamento_id'),
				'tipo_institucion' => array(self::BELONGS_TO, 'Tipo_Institucion', 'tipo_institucion_id')
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'tipo_titular' => 'Tipo de titular',
				'titular' => 'Titular',
				'tipo_nit' => 'Tipo de identificación',
				'nit' => 'Número',
				'representante_legal' => 'Representante legal',
				'tipo_id_rep' => 'Tipo de identificación',
				'representante_id' => 'Número',
				'ciudad_id' => 'Municipio',
				'direccion' => 'Dirección',
				'telefono' => 'Teléfono',
				'email' => 'Correo electrónico',
				'usuario_id' => 'Usuario',
				'fecha_creacion' => 'Fecha de creación',
				'tipo_titular_s' => '',
				'titular_s' => 'Titular',
				'tipo_nit_s' => '',
				'nit_s'=> 'Número',
				'representante_legal_s' => 'Representante legal',
				'tipo_id_rep_s' => '',
				'representante_id_s' => 'Número',
				'ciudad_id_s' => 'Ciudad',
				'estado_s' => 'Estado',
				'usuario_id_s' => 'Usuario',
				'aprobado' => 'Aprobado',
				'comentario' => 'Comentario',
				'colecciones' => 'Colecciones a registrar',
				'tipo_institucion_id' => 'Tipo de institución',
				'departamento_id' => 'Departamento',
		);
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
		
		$criteria->compare('tipo_titular', $this->tipo_titular);
		$criteria->compare('titular',$this->titular,true);
		$criteria->compare('tipo_nit', $this->tipo_nit);
		$criteria->compare('nit',$this->nit,true);
		$criteria->compare('tipo_id_rep', $this->tipo_id_rep);
		$criteria->compare('representante_id',$this->representante_id);
		$criteria->compare('representante_legal',$this->representante_legal,true);
		$criteria->compare('ciudad_id',$this->ciudad_id);
		$criteria->compare('estado',$this->estado);
		$criteria->compare('usuario_id',$this->usuario_id);
		
		$criteria->with = array('usuario','dilegenciadores');
		$criteria->order = 'titular ASC';
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort' => false,
				'pagination'=>array(
						'pageSize'=>20,
				)
		));
	}
	
	public function entidadesRegistradas(){
		$criteria = new CDbCriteria;
	
		$criteria->compare('estado', 2);
	
		return Entidad::model()->count($criteria);
	}
		
	public function ListarSolicitudEntidad()
	{
		$criteria = new CDbCriteria;
		
		$criteria->compare('estado', 1);
		$criteria->order = 'fecha_creacion DESC';
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort' => false,
				'pagination'=>array(
						'pageSize'=>10,
				)
		));
		
	}
	
	public function listarEntidades(){
		$criteria=new CDbCriteria;
		
		$criteria->compare('estado',2);
		$criteria->order = 'titular ASC';
		return CHtml::listData($this->findAll($criteria), 'id','titular');
	}
	
	public function ListarEstado()
	{
		return CHtml::listData(array(array('id' => 1, 'nombre' => 'En Espera'),array('id' => 2, 'nombre' => 'Aprobado'),array('id' => 3, 'nombre' => ' No Aprobado')), 'id','nombre');
	}
	
	public function ListarCiudades($idDepartment = 0,$idCounty = 0)
	{
		return CHtml::listData(County::model()->findAll(County::model()->listCounty($idDepartment,$idCounty)), 'iso_county_code','county_name');
	}
	
	public function ListarDepartamentos()
	{
		return CHtml::listData(Department::model()->findAll(Department::model()->listDepartment()), 'iso_department_code','department_name');
	}
	
	public function ListarUsuarios($tipo = "")
	{
		$criteria=new CDbCriteria;
		
		if($tipo == "entidad"){
			
			$criteria->compare('role',$tipo);
		}
		return CHtml::listData(Usuario::model()->findAll($criteria), 'id','username');
	}
	
	public function ListarTipo()
	{
		return CHtml::listData(array(array('id' => 1, 'nombre' => 'Persona Natural'),array('id' => 2, 'nombre' => 'Persona Jurídica')), 'id','nombre');
	}
	
	public function ListarTipoIdTit()
	{
		return CHtml::listData(array(array('id' => 1, 'nombre' => 'Nit'),array('id' => 2, 'nombre' => 'Cédula de Ciudadanía')), 'id','nombre');
	}
	
	public function ListarTipoIdRep()
	{
		return CHtml::listData(array(array('id' => 1, 'nombre' => 'Cédula de Ciudadanía'),array('id' => 2, 'nombre' => 'Cédula de Extranjería')), 'id','nombre');
	}
	
	public function getAprobado() {
		return $this->aprobado;
	}
	
	public function setAprobado($value)
	{
		$this->aprobado = $value;
	}
	
	public function getUsuario_id_s() {
		return $this->usuario_id_s;
	}
	
	public function setUsuario_id_s($value)
	{
		$this->usuario_id_s = $value;
	}
	
	public function getEstado_s() {
		return $this->estado_s;
	}
	
	public function setEstado_s($value)
	{
		$this->estado_s = $value;
	}
	
	public function getCiudad_id_s() {
		return $this->ciudad_id_s;
	}
	
	public function setCiudad_id_s($value)
	{
		$this->ciudad_id_s = $value;
	}
	
	public function getRepresentante_id_s() {
		return $this->representante_id_s;
	}
	
	public function setRepresentante_id_s($value)
	{
		$this->representante_id_s = $value;
	}
	
	public function getTipo_id_rep_s() {
		return $this->tipo_id_rep_s;
	}
	
	public function setTipo_id_rep_s($value)
	{
		$this->tipo_id_rep_s = $value;
	}
	
	public function getRepresentante_legal_s() {
		return $this->representante_legal_s;
	}
	
	public function setRepresentante_legal_s($value)
	{
		$this->representante_legal_s = $value;
	}
	
	public function getNit_s() {
		return $this->nit_s;
	}
	
	public function setNit_s($value)
	{
		$this->nit_s = $value;
	}
	
	public function getTipo_nit_s() {
		return $this->tipo_nit_s;
	}
	
	public function setTipo_nit_s($value)
	{
		$this->tipo_nit_s = $value;
	}
	
	public function getTipo_titular_s() {
		return $this->tipo_titular_s;
	}
	
	public function setTipo_titular_s($value)
	{
		$this->titular_s = $value;
	}
	
	public function getTitular_s() {
		return $this->tipo_titular_s;
	}
	
	public function setTitular_s($value)
	{
		$this->titular_s = $value;
	}
	
}
?>