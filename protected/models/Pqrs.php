<?php
/**
 * This is the model class for table "pqrs".
 *
 * The followings are the available columns in table 'entidad':
 * @property int 	$id
 * @property string $nombre
 * @property string $email
 * @property int	$tipo_solicitud
 * @property string $entidad_otra
 * @property string $descripcion
 * @property string $ruta_anexo
 * @property string $respuesta
 * @property int	$estado
 * @property date	$fecha
 * @property date 	$fecha_respuesta
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
	public $entidad_search;
	public $numero_registro_search;
	public $estado_search;
	public $tipoSol_search;
	
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
				array('nombre,email,descripcion', 'required'),
				array('nombre', 'length', 'max'=>150),
				array('email', 'email'),
				array('numero_registro','numerical','integerOnly'=>true,'message' => 'El dato solo puede ser numérico'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('numero_registro_search,estado_search,tipoSol_search,fecha,entidad_search', 'safe', 'on'=>'search'),
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
				'nombre' 			=> 'Nombre del solicitante',
				'email' 			=> 'Correo electrónico',
				'fecha'				=> 'Fecha de solicitud',
				'tipo_solicitud' 	=> 'Tipo de solicitud',
				'descripcion' 		=> 'Descripción',
				'archivo' 			=> 'Archivo anexo',
				'respuesta'			=> 'Respuesta',
				'estado' 			=> 'Estado',
				'aprobado' 			=> 'Cerrado',
				'numero_registro' 	=> 'Colección No.',
				'entidad'			=> 'Entidad',
				'numero_registro_search' => 'Colección No.',
				'estado_search' 	=> 'Estado',
				'tipoSol_search'	=> 'Tipo de solicitud',
				'entidad_search'	=> 'Titular',
				'fecha_respuesta'	=> 'Fecha de respuesta',
				'entidad_otra'		=> 'Otra Entidad'
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
	
		$criteria->compare('nombre', $this->nombre,true);
		$criteria->compare('email',$this->email);
		$criteria->compare('fecha', $this->fecha,true);
		
		if(isset($this->entidad)){
			$criteria->compare('t.entidad_id',$this->entidad->id);
		}
		
		if($this->numero_registro_search != ''){
			$criteria->compare('registros.numero_registro',$this->numero_registro_search);
		}
		
		if($this->entidad_search != ''){
			$criteria->compare('entidad.titular',$this->entidad_search,true);
		}
		
		if($this->tipoSol_search != ''){
			if(strtolower($this->tipoSol_search) == "peticion" || strtolower($this->tipoSol_search) == "petición"){
				$this->tipo_solicitud = 1;
			}else if(strtolower($this->tipoSol_search) == "queja"){
				$this->tipo_solicitud = 2;
			}else if(strtolower($this->tipoSol_search) == "felicitacion" || strtolower($this->tipoSol_search) == "felicitación"){
				$this->tipo_solicitud = 3;
			}
			else{
				$this->tipo_solicitud = 0;
			}
			$criteria->compare('t.tipo_solicitud', $this->tipo_solicitud);
		}
		
		if($this->estado_search != ''){
			if(strtolower($this->estado_search) == "cerrado"){
				$this->estado = 1;
			}else{
				$this->estado = 0;
			}
			$criteria->compare('t.estado', $this->estado);
		}
		
		$criteria->with = array('entidad','registros');
		$criteria->order = 'fecha DESC';
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort' => false,
				'pagination'=>array(
						'pageSize'=>20,
				)
		));
	}
	
	public function listarColeccion()
	{
		$usuario = Usuario::model()->findByPk(Yii::app()->user->getId());
		
		$criteriaEntidad = new CDbCriteria;
		$criteriaEntidad->compare('usuario_id',$usuario->id);
		
		$entidad = Entidad::model()->find($criteriaEntidad);
		
		$criteriaRegistro = new CDbCriteria;
		$criteriaRegistro->compare('Entidad_id', $entidad->id);
		$criteriaRegistro->compare('estado', 1);
		
		$registros = Registros::model()->findAll($criteriaRegistro);
		
		return CHtml::listData($registros, 'numero_registro','numero_registro');
	}
	
	public function listarTipoSolicitud()
	{
		return CHtml::listData(array(array('id' => 1, 'nombre' => 'Petición'),array('id' => 2, 'nombre' => 'Queja'),array('id' => 3, 'nombre' => 'Felicitación')), 'id','nombre');
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