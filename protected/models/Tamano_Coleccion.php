<?php
/**
 * This is the model class for table "tamaño_coleccion".
 *
 * The followings are the available columns in table 'tamaño_coleccion':
 * @property int 	$id
 * @property string	$unidad_medida
 * @property string	$otro
 *
 *@property int	$Registros_update_id
 *@property int $tipo_preservacion_id
 *
 * The followings are the available model relations:
 *
 * 
 * @property Registros_Update $registros_update
 * @property Tipo_Preservacion $tipo_preservacion
 */

class Tamano_Coleccion extends CActiveRecord
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
		return 'tamano_coleccion';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('tipo_preservacion_id,unidad_medida','required'),
				//array('tipo_preservacion','length','max'=>150),
				//array('cantidad','numerical','integerOnly'=>true),
				array('unidad_medida','length','max'=>4000),
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
				'tipo_preservacion' => array(self::BELONGS_TO, 'Tipo_Preservacion', 'tipo_preservacion_id')
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				//'tipo_preservacion' => 'Tipo de preservación',
				'unidad_medida'		=> 'Descripción',
				'otro'				=> 'Otro tipo',
				'tipo_preservacion_id' => 'Tipo de preservación',
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
	
			
		$criteria->with = array('registros_update','tipo_preservacion');
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
	
}
?>
