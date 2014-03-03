<?php
/**
 * This is the model class for table "tipo_preservacion".
 *
 * The followings are the available columns in table 'entidad':
 * @property int $id
 * @property string $nombre
 *
 * The followings are the available model relations:
 *
 * @property Tamano_Coleccion $tamano_coleccion
 */

class Tipo_Preservacion extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tipo_preservacion';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('nombre', 'required'),
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
				'tamano_coleccion' => array(self::HAS_MANY, 'Tamano_Coleccion', 'tipo_preservacion_id')
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'nombre' => 'Tipo de preservacion',
		);
	}
	
	public function listarTipoPreservacion(){
		$criteria=new CDbCriteria;
	
		$criteria->order = 'nombre ASC';
	
		return CHtml::listData($this->findAll($criteria), 'id','nombre');
	}
}
?>