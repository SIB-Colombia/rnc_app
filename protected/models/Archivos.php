<?php
/**
 * This is the model class for table "archivos".
 *
 * The followings are the available columns in table 'archivos':
 * @property int 	$id
 * @property string $nombre
 * @property string	$tipo
 * @property string $ruta
 * @property string $size
 * @property int	$clase
 *
 * @property int 	$Registros_update_id
 *
 * The followings are the available model relations:
 *
 *
 * @property Registros_Update $registros_update
 */

class Archivos extends CActiveRecord
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
		return 'archivos';
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
				'clase'	=> 'Tipo'
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
				'registros_update' => array(self::BELONGS_TO, 'Registros_Update', 'Registros_update_id')
		);
	}
}
?>