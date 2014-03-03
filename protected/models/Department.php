<?php
/**
 * This is the model class for table "entidad".
 *
 * The followings are the available columns in table 'entidad':
 * @property int $id
 * @property string $department_name
 * 
 *
 * The followings are the available model relations:
 *
 * 
 * 
 */
class Department extends CActiveRecord
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
		return 'department';
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'county' => array(self::HAS_MANY, 'County', 'department_id'),
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'ID',
				'department_name' => 'Departamento',
		);
	}
	
	public function listDepartment(){
	
		$criteria=new CDbCriteria;
	
		$criteria->order = 'department_name ASC';
	
		return $criteria;
	}
}
?>