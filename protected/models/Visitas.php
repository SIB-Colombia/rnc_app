<?php
/**
 * This is the model class for table "visitas".
 *
 * The followings are the available columns in table 'entidad':
 * @property int 	$id
 * @property string $entidad
 * @property int    $ciudad_id
 * @property string $concepto
 * @property int 	$registros_id
 * @property date 	$fecha_visita
 * @property int 	$dilegenciadores_id
 *
 * The followings are the available model relations:
 *
 * @property Registros $registros
 * @property Dilegenciadores $dilegenciadores
 * @property Archivos  $archivos
 */

class Visitas extends CActiveRecord
{
	public $archivo;
	public $nombreArchivo;
	public $numero_registro_search;
	public $titular_search;
	public $municipio_search;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'visitas';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('concepto,fecha_visita,ciudad_id,entidad', 'required'),
				array('concepto', 'length', 'max'=>500),
				array('fecha_visita','date','format' => 'yyyy-M-d H:m:s'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('concepto,fecha_visita,numero_registro_search,titular_search,municipio_search', 'safe', 'on'=>'search'),
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
				'dilegenciadores' => array(self::BELONGS_TO, 'Dilegenciadores', 'dilegenciadores_id'),
				'county' => array(self::BELONGS_TO, 'County', 'ciudad_id'),
				'archivos'		=> array(self::HAS_MANY,'Archivos_Pqrs', 'visitas_id')
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'fecha_visita' 		=> 'Fecha de la Visita',
				'concepto' 			=> 'Concepto',
				'numero_registro_search' => 'Colección No.',
				'titular_search'	=> 'Titular',
				'municipio_search'	=> 'Municipio',
				'ciudad_id'			=> 'Municipio',
				'entidad'			=> 'Entidad',
				'archivo' 			=> 'Archivo Anexo',
		);
	}
	
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
		$criteria->compare('concepto',$this->concepto,true);
		$criteria->compare('fecha_visita',$this->fecha_visita,true);
		
		if($this->numero_registro_search != ''){
			$criteria->compare('registros.numero_registro',$this->numero_registro_search);
		}
		
		if($this->municipio_search != ''){
			$criteria->compare('county.county_name',$this->municipio_search);
		}
		
		if($this->titular_search != '') {
			$sql = "SELECT entidad.id "
					."FROM entidad "
					."WHERE LOWER(entidad.titular) LIKE '%".strtolower($this->titular_search)."%'";
			
			$criteria->addCondition('registros.Entidad_id IN ('.$sql.')');
		}
		
		
		$criteria->with = array('registros','dilegenciadores','county');
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort' => false,
				'pagination'=>array(
						'pageSize'=>20,
				)
		));
	}
	
	public function ListarCiudades()
	{
		return CHtml::listData(County::model()->findAll(County::model()->listCounty()), 'iso_county_code','county_name');
	}
	
	public function dataArchivosList($id){
		$criteria = new CDbCriteria;
	
		$criteria->compare('t.visitas_id', $id);
	
		$modelArchivo = Archivos_Pqrs::model();
	
		return new CActiveDataProvider($modelArchivo, array(
				'criteria'=>$criteria,
				'sort' => false,
				'pagination'=>array(
						'pageSize'=>5,
				)
		));
	}
}
?>