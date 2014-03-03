<?php
/**
 * This is the model class for table "subgrupo_taxonomico".
 *
 * The followings are the available columns in table 'tamaño_coleccion':
 * @property int 	$id
 * @property string $nombre
 *
 *@property	int	$grupo_taxonomico_id
 *
 * The followings are the available model relations:
 *
 *
 * @property Composicion_General $composicion_general
 * @property Grupo_Taxonomico	$grupo_taxonomico
 */
class Subgrupo_Taxonomico extends CActiveRecord{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'subgrupo_taxonomico';
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
				'grupo_taxonomico' => array(self::BELONGS_TO, 'Grupo_Taxonomico', 'grupo_taxonomico_id'),
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'nombre' 		=> 'Subgrupo biológico',
		);
	}
	
	public function listarSubgrupoTaxonomico($idGrupo = 0){
	
		$criteria=new CDbCriteria;
		if($idGrupo != 0){
			$criteria->condition = 't.grupo_taxonomico_id = '.$idGrupo.' OR t.id = 2';
		}else{
			$criteria->condition = 't.id = 1 OR t.id = 2';
		}
		$criteria->order = 'nombre ASC';
	
		return CHtml::listData($this->findAll($criteria), 'id','nombre');
	}
}
?>