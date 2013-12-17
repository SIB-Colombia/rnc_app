<?php
/**
 * This is the model class for table "entidad".
 *
 * The followings are the available columns in table 'entidad':
 * @property int 	$id
 * @property int    $ciudad_id
 * @property string $concepto
 * @property int 	$registros_id
 * @property date 	$fecha_visita
 * @property int 	$dilegenciadores_id
 *
 * The followings are the available model relations:
 *
 * @property Registros $registros
 * @property Dilegenciadores $dilegenciadores
 */

class Visitas extends CActiveRecord
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
		return 'visitas';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('concepto,fecha_visita,ciudad_id,registros_id', 'required'),
				array('concepto', 'length', 'max'=>500),
				array('fecha_visita','date','format' => 'yyyy-M-d H:m:s')
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				//array('titular,nit,representante_id,direccion,telefono,email,dependencia_d,cargo_d,telefono_d,', 'safe', 'on'=>'search'),
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
				'registros' => array(self::BELONGS_TO, 'Registros', 'registros_id'),
				'dilegenciadores' => array(self::BELONGS_TO, 'Dilegenciadores', 'dilegenciadores_id'),
				'county' => array(self::BELONGS_TO, 'County', 'ciudad_id')
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'fecha_visita' => 'Fecha de la Visita',
				'concepto' => 'Concepto',
		);
	}
	
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
			
		$criteria->with = array('registros','dilegenciadores','county');
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort' => false,
				'pagination'=>array(
						'pageSize'=>20,
				)
		));
	}
	
	public function ListarCiudades()
	{
		return CHtml::listData(County::model()->findAll(County::model()->listCounty()), 'id','county_name');
	}
}
?>