<?php

/**
 * This is the model class for table "atributotipo".
 *
 * The followings are the available columns in table 'atributotipo':
 * @property integer $atributotipo_id
 * @property string $atributotipo_nombre
 * @property string $descripcion
 */
class Atributotipo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Atributotipo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'atributotipo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('atributotipo_id, atributotipo_nombre, descripcion', 'required'),
			array('atributotipo_id', 'numerical', 'integerOnly'=>true),
			array('atributotipo_nombre', 'length', 'max'=>50),
			array('descripcion', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('atributotipo_id, atributotipo_nombre, descripcion', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'atributotipo_id' => 'Atributotipo',
			'atributotipo_nombre' => 'Atributotipo Nombre',
			'descripcion' => 'Descripcion',
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

		$criteria->compare('atributotipo_id',$this->atributotipo_id);
		$criteria->compare('atributotipo_nombre',$this->atributotipo_nombre,true);
		$criteria->compare('descripcion',$this->descripcion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}