<?php
/**
 * This is the model class for table "county".
 *
 * The followings are the available columns in table 'entidad':
 * @property int 	$id
 * @property string $iso_county_code
 * @property int 	$department_id
 * @property string $county_name
 *
 *
 * The followings are the available model relations:
 *
 *@property Department $department
 *
 */
class County extends CActiveRecord
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
		return 'county';
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'department' => array(self::BELONGS_TO, 'Department', 'department_id'),
				'entidad' => array(self::HAS_MANY, 'Entidad', 'ciudad_id'),
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'department_id' => 'Departamento',
				'county_name' => 'Municipio'
		);
	}
	
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->with = array('department');
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	
	public function listCounty(){
		
		$criteria=new CDbCriteria;
		
		$criteria->with = array('department');
		$criteria->order = 'department_id ASC, county_name ASC';
		
		return $criteria;
	}
}
?>