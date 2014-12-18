<?php
/**
 * This is the model class for table "composicion_general".
 *
 * The followings are the available columns in table 'entidad':
 * @property int 	$id
 * @property string $subgrupo_otro
 * @property int 	$numero_ejemplares
 * @property float 	$numero_catalogados
 * @property float 	$numero_sistematizados
 * @property float  $numero_nivel_filum
 * @property float	$numero_nivel_orden
 * @property float 	$numero_nivel_familia
 * @property float 	$numero_nivel_genero
 * @property float 	$numero_nivel_especie
 *
 * @property int $Registros_update_id
 * @property int $grupo_taxonomico_id
 * @property int $subgrupo_taxonomico_id
 *
 * The followings are the available model relations:
 *
 * @property Registros_Update $registros_update
 * @property Grupo_Taxonomico $grupo_taxonomico
 * @property Subgrupo_Taxonomico $subgrupo_taxonomico
 */

class Composicion_General extends CActiveRecord
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
		return 'composicion_general';
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
				'registros_update' => array(self::BELONGS_TO, 'Registros_Update', 'Registros_update_id'),
				'grupo_taxonomico' => array(self::BELONGS_TO, 'Grupo_Taxonomico', 'grupo_taxonomico_id'),
				'subgrupo_taxonomico' => array(self::BELONGS_TO, 'Subgrupo_Taxonomico', 'subgrupo_taxonomico_id'),
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'subgrupo_otro' 		=> 'Otro Subgrupo',
				'numero_ejemplares' 	=> 'No. Ejemplares',
				'numero_catalogados' 	=> 'Ejemplares catalogados',
				'numero_sistematizados'	=> 'Ejemplares sistematizados',
				'numero_nivel_filum'	=> 'Ejemplares identificados solamente al nivel de filum',
				'numero_nivel_orden'	=> 'Ejemplares identificados solamente al nivel de orden',
				'numero_nivel_familia'	=> 'Ejemplares identificados solamente al nivel de familia',
				'numero_nivel_genero'	=> 'Ejemplares identificados solamente al nivel de género',
				'numero_nivel_especie'	=> 'Ejemplares identificados solamente al nivel de especie',
				'grupo_taxonomico_id'	=> 'Grupo biológico',
				'subgrupo_taxonomico_id' => 'Subgrupo biológico'
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
	
			
		$criteria->with = array('entidad','registros_update');
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
}
?>