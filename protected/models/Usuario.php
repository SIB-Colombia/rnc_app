<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property int 	$id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $role
 */

class Usuario extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public  $newpassword;
	public  $password2;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('username, password,role,email', 'required'),
				array('username, role', 'length', 'max'=>32),
				array('password, password2','length', 'max'=>64),
				array('password2', 'compare', 'compareAttribute'=>'password', 'on'=>'insert'),
				array('password2', 'compare', 'compareAttribute'=>'newpassword', 'on'=>'update'),
					
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('username, password, email, role', 'safe', 'on'=>'search'),
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
			'entidad' => array(self::HAS_MANY, 'Entidad', 'usuario_id'),
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'username' => 'Usuario',
				'password' => 'Password',
				'newpassword' => 'Nuevo Password',
				'password2' => 'Confirmar Password',
				'email' => 'Email',
				'role' => 'Rol',
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
	
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email);
		$criteria->compare('role',$this->role,true);
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
}
?>