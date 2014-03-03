<?php
/**
 * This is the model class for table "grupo_taxonomico".
 *
 * The followings are the available columns in table 'tamaño_coleccion':
 * @property int 	$id
 * @property string $nombre
 *
 *
 * The followings are the available model relations:
 *
 *
 * @property Composicion_General $composicion_general
 */

class Grupo_Taxonomico extends CActiveRecord
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
		return 'grupo_taxonomico';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
	
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
				'composicion_general' => array(self::HAS_MANY, 'Composicion_General', 'grupo_taxonomico_id'),
				'subgrupo_taxonomico' => array(self::HAS_MANY, 'Subgrupo_Taxonomico', 'grupo_taxonomico_id'),
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'nombre' => 'Grupo biológico',
		);
	}
	
	public function listarGrupoTaxonomico(){
	
		$criteria=new CDbCriteria;
	
		$criteria->order = 'nombre ASC';
	
		return CHtml::listData($this->findAll($criteria), 'id','nombre');
	}
}
?>