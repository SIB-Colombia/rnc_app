<?php
/**
 * This is the model class for table "contactos".
 *
 * The followings are the available columns in table 'contactos':
 * @property int 	$id
 * @property string $nombre
 * @property string	$cargo
 * @property string $dependencia
 * @property string $direccion
 * @property int	$ciudad_id
 * @property string $telefono
 * @property string $email
 *
 * The followings are the available model relations:
 *
 *
 * @property Registros_Update $registros_update
 */

class Contactos extends CActiveRecord
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
		return 'contactos';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('nombre,cargo,dependencia,direccion,ciudad_id,telefono,email','required'),
				array('nombre,cargo,dependencia,direccion','length','max'=>150),
				array('telefono,email','length','max' => 45),
				array('telefono','numerical','integerOnly'=>true),
				array('email','email')
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
				'registros_update' => array(self::HAS_MANY, 'Registros_Update', 'Registros_update_id'),
				'county' => array(self::BELONGS_TO, 'County', 'ciudad_id')
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'nombre'		=> 'Persona de contacto',
				'cargo'			=> 'Cargo',
				'dependencia'	=> 'Dependencia',
				'direccion'		=> 'Dirección de correspondencia',
				'ciudad_id'		=> 'Ciudad',
				'telefono'		=> 'Teléfono(s)',
				'email'			=> 'Correo electrónico'
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
	
			
		$criteria->with = array('registros_update','county');
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
}
?>