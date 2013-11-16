<?php
/**
 * This is the model class for table "_taxon_tree".
 *
 * The followings are the available columns in table '_taxon_tree':
 * @property integer $taxon_id
 * @property string $author_string_id
 * @property integer $scientific_name_status_id
 * @property integer $scrutiny_id
 * @property string  $additional_data
 * @property string  $taxon_guid
 * @property string $name_guid
 *
 * The followings are the available model relations:
 * @property Author_String $author_string
 * @property Taxontree $taxontree
 */

class Taxon_Detail extends CActiveRecord{
	
		
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Catalogoespecies the static model class
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
		return 'taxon_detail';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('taxon_id, author_string_id', 'required'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('taxon_id, author_string_id', 'safe', 'on'=>'search')
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
			'taxontree' => array(self::BELONGS_TO, 'Taxontree', 'taxon_id'),
			'author_string' => array(self::BELONGS_TO, 'Author_String', 'author_string_id')
		);
	}
	
}