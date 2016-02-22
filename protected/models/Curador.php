<?php
/**
 * This is the model class for table "curador".
 *
 * The followings are the available columns in table 'curador':
 * @property int 	$id
 * @property string $nombre
 * @property string	$cargo
 * @property string $telefono
 * @property string $email
 * @property string $pagina_web
 *
 * The followings are the available model relations:
 *
 *
 * @property Registros_Update $registros_update
 * @property Subgrupo_Taxonomico $subgrupo_taxonomico
 */
class Curador extends CActiveRecord
{
	public $grupo_taxonomico_id;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'curador';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('nombre,apellido,cargo,telefono,email,grupo_taxonomico_id,subgrupo_taxonomico_id','required'),
				array('nombre,cargo,email','length','max'=>150),
				array('telefono','length','max' => 45),
				//array('telefono','numerical','integerOnly'=>true),
				array('email','email')
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
				'subgrupo_taxonomico' => array(self::BELONGS_TO, 'Subgrupo_Taxonomico', 'subgrupo_taxonomico_id')
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'nombre'					=> 'Nombres',
				'apellido'					=> 'Apellidos',
				'cargo'						=> 'Especialidad',
				'telefono'					=> 'Teléfono(s)',
				'email'						=> 'Correo electrónico',
				'pagina_web'				=> 'Perfil en línea',
				'grupo_taxonomico_id'		=> 'Grupo biológico',
				'subgrupo_taxonomico_id'	=> 'Subgrupo biológico'
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
	
			
		$criteria->with = array('registros_update','subgrupo_taxonomico');
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}
}
