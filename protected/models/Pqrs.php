<?php
/**
 * This is the model class for table "pqrs".
 *
 * The followings are the available columns in table 'entidad':
 * @property int 	$id
 * @property string $nombre
 * @property string $email
 * @property int	$tipo_solicitud
 * @property string $descripcion
 * @property string $ruta_anexo
 * @property string $respuesta
 * @property int	$estado
 * @property date	$fecha
 * @property int 	$registros_id
 * @property int 	$entidad_id
 *
 * The followings are the available model relations:
 *
 * @property Registros 	$registros
 * @property Entidad	$entidad
 */

class Pqrs extends CActiveRecord
{
	public $numero_registro;
	public $entidad;
	public $archivo;
	public $aprobado;
	public $nombreArchivo;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pqrs';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('nombre,email,tipo_solicitud,descripcion', 'required'),
				array('nombre', 'length', 'max'=>150),
				array('email', 'email'),
				array('numero_registro','numerical','integerOnly'=>true,'message' => 'El dato solo puede ser numérico'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				//array('titular,nit,representante_id,direccion,telefono,email,dependencia_d,cargo_d,telefono_d,', 'safe', 'on'=>'search'),
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
				'registros' => array(self::BELONGS_TO, 'Registros', 'registros_id'),
				'entidad'	=> array(self::BELONGS_TO, 'Entidad', 'entidad_id'),
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'nombre' 			=> 'Nombre Solicitante',
				'email' 			=> 'Correo Electrónico',
				'fecha'				=> 'Fecha de Solicitud',
				'tipo_solicitud' 	=> 'Tipo de Solicitud',
				'descripcion' 		=> 'Descripción',
				'archivo' 			=> 'Archivo Anexo',
				'respuesta'			=> 'Respuesta',
				'estado' 			=> 'Estado',
				'aprobado' 			=> 'Cerrado',
				'numero_registro' 	=> 'Colección No.',
				'entidad'			=> 'Entidad'
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
	
		$criteria->compare('nombre', $this->nombre);
		$criteria->compare('email',$this->email);
		$criteria->compare('fecha', $this->fecha,true);
		$criteria->compare('tipo_solicitud',$this->tipo_solicitud);
		
		if(isset($this->entidad)){
			$criteria->compare('t.entidad_id',$this->entidad->id);
		}
		
		$criteria->with = array('registros');
		$criteria->order = 'fecha DESC';
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort' => false,
				'pagination'=>array(
						'pageSize'=>20,
				)
		));
	}
	
	public function listarTipoSolicitud()
	{
		return CHtml::listData([['id' => 1, 'nombre' => 'Petición'],['id' => 2, 'nombre' => 'Queja'],['id' => 3, 'nombre' => 'Felicitación']], 'id','nombre');
	}
	
	public function dataArchivosList($id){
		$criteria = new CDbCriteria;
		
		$criteria->compare('t.pqrs_id', $id);
		
		$modelArchivo = Archivos_Pqrs::model();
		
		return new CActiveDataProvider($modelArchivo, array(
				'criteria'=>$criteria,
				'sort' => false,
				'pagination'=>array(
						'pageSize'=>5,
				)
		));
	}
	
	public function ListarSolicitudPqrs()
	{
		$criteria = new CDbCriteria;
	
		$criteria->compare('t.estado', 0);
		$criteria->order = 'fecha DESC';
		$criteria->with = array('registros','entidad');
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort' => false,
				'pagination'=>array(
						'pageSize'=>10,
				)
		));
	
	}
	
}

?>