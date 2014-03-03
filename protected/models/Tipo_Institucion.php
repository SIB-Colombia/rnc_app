<?php
/**
 * This is the model class for table "tipo_institucion".
 *
 * The followings are the available columns in table 'entidad':
 * @property int $id
 * @property string $nombre
 *
 * The followings are the available model relations:
 *
 * @property Entidad $entidad
 */

class Tipo_Institucion extends CActiveRecord
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
		return 'tipo_institucion';
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
				'entidad' => array(self::HAS_MANY, 'Entidad', 'tipo_institucion_id')
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'nombre' => 'Tipo de Institución',
		);
	}
	
	public function listarTipoInstitucion(){
		$criteria=new CDbCriteria;
	
		$criteria->order = 'nombre ASC';
	
		return CHtml::listData($this->findAll($criteria), 'id','nombre');
	}
}
?>