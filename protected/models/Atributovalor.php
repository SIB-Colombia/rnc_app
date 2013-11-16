<?php

/**
 * This is the model class for table "atributovalor".
 *
 * The followings are the available columns in table 'atributovalor':
 * @property integer $id
 * @property string $valor
 * @property integer $atributotipo_id
 *
 * The followings are the available model relations:
 * @property CePlantilla[] $cePlantillas
 * @property CePlantilla[] $cePlantillas1
 * @property CeAtributovalor[] $ceAtributovalors
 * @property CeAtributovalor[] $ceAtributovalors1
 */
class Atributovalor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Atributovalor the static model class
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
		return 'atributovalor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('valor, atributotipo_id', 'required'),
			array('id, atributotipo_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, valor, atributotipo_id', 'safe', 'on'=>'search'),
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
			'cePlantillas' => array(self::HAS_MANY, 'CePlantilla', 'valor'),
			'cePlantillas1' => array(self::HAS_MANY, 'CePlantilla', 'etiqueta'),
			'ceAtributovalors' => array(self::HAS_MANY, 'CeAtributovalor', 'valor'),
			'ceAtributovalors1' => array(self::HAS_MANY, 'CeAtributovalor', 'etiqueta'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'valor' => 'Valor',
			'atributotipo_id' => 'Atributotipo',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('atributotipo_id',$this->atributotipo_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}