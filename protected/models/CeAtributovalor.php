<?php

/**
 * This is the model class for table "ce_atributovalor".
 *
 * The followings are the available columns in table 'ce_atributovalor':
 * @property integer $ceatributovalor_id
 * @property integer $catalogoespecies_id
 * @property integer $etiqueta
 * @property integer $valor
 *
 * The followings are the available model relations:
 * @property Atributovalor $valor0
 * @property Atributovalor $etiqueta0
 * @property Catalogoespecies $catalogoespecies
 */
class CeAtributovalor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CeAtributovalor the static model class
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
		return 'ce_atributovalor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('catalogoespecies_id, etiqueta', 'required'),
			array('ceatributovalor_id, catalogoespecies_id, etiqueta, valor', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ceatributovalor_id, catalogoespecies_id, etiqueta, valor', 'safe', 'on'=>'search'),
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
			'valor0' => array(self::BELONGS_TO, 'Atributovalor', 'valor'),
			'etiqueta0' => array(self::BELONGS_TO, 'Atributovalor', 'etiqueta'),
			'catalogoespecies' => array(self::BELONGS_TO, 'Catalogoespecies', 'catalogoespecies_id'),
			'atributo' => array(self::BELONGS_TO, 'Atributos', 'id_atributo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ceatributovalor_id' => 'Ceatributovalor',
			'catalogoespecies_id' => 'Catalogoespecies',
			'etiqueta' => 'Etiqueta',
			'valor' => 'Valor',
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

		$criteria->compare('ceatributovalor_id',$this->ceatributovalor_id);
		$criteria->compare('catalogoespecies_id',$this->catalogoespecies_id);
		$criteria->compare('etiqueta',$this->etiqueta);
		$criteria->compare('valor',$this->valor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}