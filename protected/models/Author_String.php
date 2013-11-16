<?php
/**
 * This is the model class for table "_taxon_tree".
 *
 * The followings are the available columns in table '_taxon_tree':
 * @property integer $id
 * @property string $string
 *
 *The followings are the available model relations:
 *@property Taxon_Detail[] $taxon_detail
 *
 */

class Author_String extends CActiveRecord{
	
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
		return 'author_string';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('string', 'required'),
				array('string', 'length', 'max'=>255),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, string', 'safe', 'on'=>'search')
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
			'taxon_detail' => array(self::HAS_MANY, 'Taxon_Detail', 'author_string_id')
		);
	}
}