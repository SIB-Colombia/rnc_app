<?php
/**
 * This is the model class for table "certificados".
 *
 * The followings are the available columns in table 'tamaño_coleccion':
 * @property int 	$id
 * @property string	$nombre
 * @property date 	$fecha
 *
 *@property int	$registros_update_id
 *
 * The followings are the available model relations:
 *
 *
 * @property Registros_Update $registros_update
 */

class Certificados extends CActiveRecord 
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
		return 'certificados';
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'registros_update' => array(self::BELONGS_TO, 'Registros_Update', 'registros_update_id'),
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' 		=> 'Número del certificado',
				'nombre'	=> 'Certificado',
				'fecha'		=> 'Fecha certificado'
		);
	}
	
}
?>