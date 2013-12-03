<?php
/**
 * This is the model class for table "registros".
 *
 * The followings are the available columns in table 'entidad':
 * @property int $id
 * @property int $entidad_id
 * @property date $fecha_dil
 * @property date $fecha_prox
 * @property int $numero_registro
 * @property int $estado
 * @property int $terminos
 *
 * The followings are the available model relations:
 *
 * @property Entidad $entidad
 * @property Registros_Update $registros_update
 */

class Registros extends CActiveRecord
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
		return 'registros';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('numero_registro,fecha_dil','required')	,
			array('numero_registro','numerical','integerOnly'=>true,'message' => 'El dato solo puede ser numérico'),
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
				'entidad' => array(self::BELONGS_TO, 'Entidad', 'Entidad_id'),
				'registros_update' => array(self::HAS_MANY, 'Registros_Update', 'registros_id')
		);
	}
	
	/**
	* @return array customized attribute labels (name=>label)
	*/
	public function attributeLabels()
	{
		return array(
			'numero_registro' 	=> 'Registro No.',
			'fecha_dil'			=> 'Última Actualización',
			'fecha_prox'		=> 'Próxima Actualización',
			'estado' 			=> 'Estado de la Colección',
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
		$criteria->compare('numero_registro', $this->numero_registro);
		$criteria->compare('fecha_dil', $this->fecha_dil);
		$criteria->compare('t.estado', $this->estado);
		if(isset($this->entidad)){
			$criteria->compare('entidad.id',$this->entidad->id);
		}
		
		$criteria->with = array('entidad');
		
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort' => false,
				'pagination'=>array(
						'pageSize'=>20,
				)
		));
	}
	
	public function listarPanelRegistro(){
		
		$criteria = new CDbCriteria;
		
		$criteria->compare('t.estado', 1);
		//$criteria->compare('registros_update.estado', 2);
		//$criteria->addCondition('Registros_Update.estado = 2');
		$criteria->order = 'fecha_dil DESC';
		if(isset($this->entidad)){
			$criteria->compare('entidad.id',$this->entidad->id);
		}
		
		$criteria->with = array('entidad');
		
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort' => false,
				'pagination'=>array(
						'pageSize'=>20,
				)
		));
	}
	
	public function listarSolicitudRegistro(){
		$criteria = new CDbCriteria;
		
		$criteria->compare('t.estado', 1);
		$criteria->order = 'fecha_act DESC';
				
		$criteria->with = array('registros.entidad','registros');
		
		$modelRegistroUpdate = Registros_Update::model();
		
		return new CActiveDataProvider($modelRegistroUpdate, array(
				'criteria'=>$criteria,
				'sort' => false,
				'pagination'=>array(
						'pageSize'=>10,
				)
		));
		
	}
	
	public function listarRegistrosDetalles(){
		$criteria = new CDbCriteria;
		
		$criteria->with = array('entidad','registros_update');
		$criteria->order = 'fecha_dil DESC';
		
	}
	
}
?>