<?php
/**
 * This is the model class for table "estado_registro".
 *
 * The followings are the available columns in table 'entidad':
 * @property int $id
 * @property string $nombre
 *
 * The followings are the available model relations:
 *
 * @property Registros_Update $registros_update
 */

class Estado_Registro extends CActiveRecord
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
		return 'estado_registro';
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'registros_update' => array(self::HAS_MANY, 'Registros_Update', 'estado')
		);
	}
	
	public function attributeLabels()
	{
		return array(
				'nombre' => 'Estado',
		);
	}
}
?>