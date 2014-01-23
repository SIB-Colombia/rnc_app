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
	public $acronimo_search;
	public $ciudad_search;
	public $titular_search;
	public $estado_search;
	
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
			array('acronimo_search,ciudad_search,titular_search,numero_registro,estado_search,fecha_dil', 'safe', 'on'=>'search'),
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
				'registros_update' => array(self::HAS_MANY, 'registros_update', 'registros_id')
		);
	}
	
	/**
	* @return array customized attribute labels (name=>label)
	*/
	public function attributeLabels()
	{
		return array(
			'numero_registro' 	=> 'Colección No.',
			'fecha_dil'			=> 'Última Actualización',
			'fecha_prox'		=> 'Próxima Actualización',
			'estado' 			=> 'Estado de la Colección',
			'acronimo_search'	=> 'Acrónimo',
			'ciudad_search'		=> 'Municipio',
			'titular_search'	=> 'Titular',
			'estado_search'		=> 'Estado de la Colección'
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
		$criteria->compare('fecha_dil', $this->fecha_dil,true);
		
		if($this->estado_search != ''){
			if(strtolower($this->estado_search) == "aprobado"){
				$this->estado = 1;
			}else{
				$this->estado = 0;
			}
			$criteria->compare('t.estado', $this->estado);
		}
		if(isset($this->entidad)){
			$criteria->compare('entidad.id',$this->entidad->id);
		}
		
		if($this->titular_search != ''){
			$criteria->compare('entidad.titular',$this->titular_search);
		}
		
		$criteria->with = array('entidad','registros_update');
		$criteria->order = 'numero_registro ASC, fecha_dil DESC';
		
		$sql='';
		if($this->acronimo_search != '' || $this->ciudad_search != '') {
			$sql = "SELECT registros_update.registros_id "
					."FROM registros_update ";
			if($this->acronimo_search != '' && $this->ciudad_search == ''){
				$where = "WHERE LOWER(registros_update.acronimo) LIKE '".strtolower($this->acronimo_search)."'";
			}else if($this->acronimo_search == '' && $this->ciudad_search != ''){
				$sql .= "INNER JOIN county ON registros_update.ciudad_id = county.iso_county_code ";
				$where = "WHERE LOWER(county.county_name) LIKE '".strtolower($this->ciudad_search)."'";
			}else if($this->acronimo_search != '' && $this->ciudad_search != ''){
				$sql .= "INNER JOIN county ON registros_update.ciudad_id = county.iso_county_code ";
				$where = "WHERE LOWER(registros_update.acronimo) LIKE '".strtolower($this->acronimo_search)."' AND LOWER(county.county_name) LIKE '".strtolower($this->ciudad_search)."'";
			}
			$sql .= " ".$where;
			$criteria->addCondition('t.id IN ('.$sql.')');
		}
	
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
	
	public function colRegistradas(){
		$criteria = new CDbCriteria;
		
		$criteria->compare('t.estado', 1);
		
		return Registros::model()->count($criteria);
	}
	
	public function colNuevas(){
		$criteria = new CDbCriteria;
	
		$criteria->compare('t.estado', 0);
	
		return Registros::model()->count($criteria);
	}
	
	public function listarFolderHistoricos($folder = ""){
		$datos = array();
		$dirPath	= "rnc_files".DIRECTORY_SEPARATOR."Registro_Colecciones_Biologicas";
		$dir = "";
		if($folder != ""){
			$dirPath = $dirPath.DIRECTORY_SEPARATOR.$folder;
			$dir = $folder.DIRECTORY_SEPARATOR;
			
		}
		$directorio = opendir($dirPath);
		$cont = 1;
		while ($archivo = readdir($directorio)){
			$isDir = 1;
			if($archivo != "." && $archivo != ".."){
				if(!is_dir($dirPath.DIRECTORY_SEPARATOR.$archivo)){
					$isDir = 0;
				}
				$datos[] = array('id'=> $cont,'nombre'=>utf8_encode($archivo),'dir'=>$dir.$archivo,'isDir' => $isDir);
				$cont++;
			}
		}
		
		$gridDataProvider = new CArrayDataProvider($datos);
		return $gridDataProvider;
	}
	
}
?>