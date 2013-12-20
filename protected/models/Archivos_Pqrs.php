<?php
/**
 * This is the model class for table "archivos_pqrs".
 *
 * The followings are the available columns in table 'archivos':
 * @property int 	$id
 * @property string $nombre
 * @property string $ruta
 *
 * @property int 	$pqrs_id
 *
 * The followings are the available model relations:
 *
 *
 * @property Pqrs $pqrs
 */

class Archivos_Pqrs extends CActiveRecord
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
		return 'archivos_pqrs';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'nombre' => 'Nombre',
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
				'pqrs' => array(self::BELONGS_TO, 'Pqrs', 'pqrs_id')
		);
	}
}
?>