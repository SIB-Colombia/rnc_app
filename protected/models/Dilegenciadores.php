<?php
/**
 * This is the model class for table "dilegenciadores".
 *
 * The followings are the available columns in table 'dilegenciadores':
 * @property int 	$id
 * @property string	$nombre
 * @property string $dependencia
 * @property string $cargo
 * @property string $telefono
 * @property string $email
 *
 * The followings are the available model relations:
 *
 * @property Entidad $entidad
 */

class Dilegenciadores extends CActiveRecord
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
		return 'dilegenciadores';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('nombre,dependencia,cargo,telefono,email', 'required'),
				array('nombre,dependencia,cargo,telefono', 'length', 'max'=>150),
				array('email','length', 'max'=>64),
				array('email', 'email'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('nombre,dependencia,cargo,telefono,email', 'safe', 'on'=>'search'),
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
				'dilegenciadores' => array(self::HAS_ONE, 'Entidad', 'dilegenciadores_id')
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'nombre' => 'Nombre',
				'dependencia' => 'Dependencia',
				'cargo' => 'Cargo',
				'telefono' => 'Telefono',
				'email' => 'Correo Electrónico'
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
	
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('dependencia',$this->dependencia,true);
		$criteria->compare('cargo',$this->cargo);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('email',$this->email,true);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
}
?>