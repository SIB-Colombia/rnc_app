<?php 
/**
 * This is the model class for table "tipos_en_coleccion".
 *
 * The followings are the available columns in table 'tipos_en_coleccion':
 * @property int 	$id
 * @property string $grupo
 * @property string $informacion_ejemplar
 * @property string $nombre_cientifico
 * @property int	$cantidad
 *
 *@property int	$Registros_Update_id
 *
 * The followings are the available model relations:
 *
 *
 * @property Registros_Update $registros_update
 */

class Tipos_En_Coleccion extends CActiveRecord
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
		return 'tipos_en_coleccion';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				//array('informacion_ejemplar,grupo,nombre_cientifico','required'),
				array('informacion_ejemplar','length','max'=>150),
				array('cantidad','numerical','message' => 'El dato solo puede ser numérico'),
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
				'registros_update' => array(self::BELONGS_TO, 'Registros_Update', 'Registros_update_id')
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'informacion_ejemplar' 	=> 'Ejemplar tipo',
				'cantidad'				=> 'Cantidad de ejemplares',
				'grupo'					=> 'Grupo biológico',
				'nombre_cientifico'		=> 'Nombre Científico'
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
	
			
		$criteria->with = array('registros_update');
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
}
?>