<?php
/**
 * This is the model class for table "urls_registros".
 *
 * The followings are the available columns in table 'registros_update':
 * @property int $id
 * @property string $nombre
 * @property int tipo
 *
 * The followings are the available model relations:
 *
 * @property Registros_Update $registros_update
 * @property int $registros_update_id
 */

class Urls_Registros extends CActiveRecord
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
		return 'urls_registros';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				//array('nombre', 'required'),
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
				'registros_update' => array(self::BELONGS_TO, 'Registros_Update', 'registros_update_id')
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'nombre' => 'Nombre del recurso',
				'url'	=> 'Url del recurso',
				'tipo'	=> 'Tipo de enlace'
		);
	}
	
	public function listarUrls(){
		$criteria=new CDbCriteria;
	
		$criteria->order = 'nombre ASC';
	
		return CHtml::listData($this->findAll($criteria), 'id','nombre','url');
	}

	public function listTipo()
	{
		$listTipo = array();
		$listTipo[0] = array('id' => 0, 'nombre' => "SIB Colombia");
		$listTipo[1] = array('id' => 1, 'nombre' => "Externo");
				
		return CHtml::listData($listTipo, 'id','nombre');
	}
}

?>