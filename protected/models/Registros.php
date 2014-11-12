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
 * @property int $tipo_coleccion_id
 *
 * The followings are the available model relations:
 *
 * @property Entidad $entidad
 * @property Registros_update $registros_update
 * @property Tipo_Coleccion $tipo_coleccion
 */

class Registros extends CActiveRecord
{
	public $acronimo_search;
	public $departamento_search;
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
			array('numero_registro,tipo_coleccion_id','required')	,
			array('numero_registro','numerical','integerOnly'=>true,'message' => 'El dato solo puede ser numérico'),
			array('acronimo_search,departamento_search,ciudad_search,titular_search,numero_registro,estado_search,fecha_dil', 'safe', 'on'=>'search'),
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
				'registros_update' => array(self::HAS_MANY, 'Registros_update', 'registros_id'),
				'tipo_coleccion' => array(self::BELONGS_TO, 'Tipo_Coleccion', 'tipo_coleccion_id'),
		);
	}
	
	/**
	* @return array customized attribute labels (name=>label)
	*/
	public function attributeLabels()
	{
		return array(
			'numero_registro' 		=> 'Colección No.',
			'fecha_dil'				=> 'Fecha de registro de la colección',
			'fecha_prox'			=> 'Próxima actualización',
			'estado' 				=> 'Estado de la colección',
			'acronimo_search'		=> 'Acrónimo',
			'departamento_search'	=> 'Departamento',
			'ciudad_search'			=> 'Municipio',
			'titular_search'		=> 'Titular',
			'estado_search'			=> 'Estado de la colección',
			'tipo_coleccion_id'		=> 'Tipo de colección'
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
			$criteria->compare('entidad.titular',$this->titular_search,true);
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
				$where = "WHERE LOWER(county.county_name) LIKE '%".strtolower($this->ciudad_search)."%'";
			}else if($this->acronimo_search != '' && $this->ciudad_search != ''){
				$sql .= "INNER JOIN county ON registros_update.ciudad_id = county.iso_county_code ";
				$where = "WHERE LOWER(registros_update.acronimo) LIKE '".strtolower($this->acronimo_search)."' AND LOWER(county.county_name) LIKE '%".strtolower($this->ciudad_search)."%'";
			}
			$sql .= " ".$where;
			$criteria->addCondition('t.id IN ('.$sql.')');
		}
		
		$sql='';
		
		if($this->departamento_search != ''){
			$sql = "SELECT registros_update.registros_id FROM department ";
			$sql .= "INNER JOIN county ON  department.id = county.department_id ";
			$sql .= "INNER JOIN registros_update ON  county.iso_county_code = registros_update.ciudad_id ";
			$where = "WHERE LOWER(department.department_name) LIKE '%".strtolower($this->departamento_search)."%'";
			
			$sql .= " ".$where;
			$criteria->addCondition('t.id IN ('.$sql.')');
		}
	
		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
				'sort' => false,
				'pagination'=>array(
						'pageSize'=>10,
				)
		));
	}
	
	public function listarPanelRegistro(){
		
		$criteria = new CDbCriteria;
		
		$criteria->compare('t.estado', 1);
		//$criteria->compare('registros_update.estado', 2);
		//$criteria->addCondition('Registros_Update.estado = 2');
		$criteria->order = 'numero_registro ASC, fecha_dil DESC';
		if(isset($this->entidad)){
			$criteria->compare('entidad.id',$this->entidad->id);
		}
		
		$criteria->with = array('entidad','registros_update');
		
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
		$criteria->order = 'fecha_env DESC, t.id DESC';
				
		$criteria->with = array('registros.entidad','registros');
		
		$modelRegistroUpdate = Registros_update::model();
		
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
		//$dirPath	= "rnc_files".DIRECTORY_SEPARATOR."Registro_Colecciones_Biologicas_Historicos";

		$dirPath        = "..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."media".DIRECTORY_SEPARATOR."disk2".DIRECTORY_SEPARATOR."rnc_files".DIRECTORY_SEPARATOR."Registro_Colecciones_Biologicas_Historicos".DIRECTORY_SEPARATOR;
		$dir = "";
		$cols = array();
		if($folder != ""){
			$dirPath = $dirPath.DIRECTORY_SEPARATOR.$folder;
			$dir = $folder.DIRECTORY_SEPARATOR;
			
		}else{
			if(Yii::app()->user->getState("roles") == "entidad"){
				$criteriaEntidad = new CDbCriteria;
				$criteriaEntidad->compare('usuario_id',Yii::app()->user->getId());
				$entidad = Entidad::model()->find($criteriaEntidad);
			
				$criteriaRegistro = new CDbCriteria;
				$criteriaRegistro->compare('entidad_id', $entidad->id);
				$criteriaRegistro->with = array('registros_update'); 
				$modelRegistros = Registros::model()->findAll($criteriaRegistro);
				
				foreach ($modelRegistros as $registro){
					foreach ($registro->registros_update as $reg_update){
						$cols[] = $reg_update->acronimo;
					}
				}
			}
		}
		$directorio = opendir($dirPath);
		$cont = 1;
		while ($archivo = readdir($directorio)){
			$isDir = 1;
			$arch_aux = explode("_", $archivo);
			
			if(Yii::app()->user->getState("roles") == "entidad"){
				if(($archivo != "." && $archivo != "..") && (in_array($arch_aux[1], $cols) || $folder != "")){
					if(!is_dir($dirPath.DIRECTORY_SEPARATOR.$archivo)){
						$isDir = 0;
					}
					$datos[] = array('id'=> $cont,'nombre'=>utf8_encode($archivo),'dir'=>$dir.$archivo,'isDir' => $isDir);
					$cont++;
				}
			}else {
				if($archivo != "." && $archivo != ".."){
					if(!is_dir($dirPath.DIRECTORY_SEPARATOR.$archivo)){
						$isDir = 0;
					}
					$datos[] = array('id'=> $cont,'nombre'=>utf8_encode($archivo),'dir'=>$dir.$archivo,'isDir' => $isDir);
					$cont++;
				}
			}
		}
		
		function cmp($a, $b){
			return strcmp($a['nombre'], $b['nombre']);
		}
		usort($datos, "cmp");
		$gridDataProvider = new CArrayDataProvider($datos);
		return $gridDataProvider;
	}
	
		
	public function listarClecciones1($arrg){
		
		$datos = array();
		
		for ($i = 1; $i <= count($arrg); $i++) {
			//$datos[] = array('id' => $i,'numero' => $arrg[$i]['A'],'titular' => $arrg[$i]['B'],'nombre' => $arrg[$i]['C'],'acronimo' => $arrg[$i]['D'],'fundacion' => $arrg[$i]['E'],'departamento' => $arrg[$i]['F'],'ciudad' => $arrg[$i]['G'],'fecha' => $arrg[$i]['H'],'tipo' => $arrg[$i]['I'],'contacto' => $arrg[$i]['J'],'cargo' => $arrg[$i]['K'],'email' => $arrg[$i]['L'],'telefono' => $arrg[$i]['M']);
			$datos[] = array($i,$arrg[$i]['A'],$arrg[$i]['B'],$arrg[$i]['C'],$arrg[$i]['D'],$arrg[$i]['E'],$arrg[$i]['F'],$arrg[$i]['G'],$arrg[$i]['H'],$arrg[$i]['I'],$arrg[$i]['J'],$arrg[$i]['K'],$arrg[$i]['L'],$arrg[$i]['M']);
		}
		
		/*$gridDataProvider = new CArrayDataProvider($datos);
		return $gridDataProvider;*/
		json_encode($datos);
	}
	
	
	public function listarFolderCertificados($folder = ""){
		$datos = array();
		$dirPath	= "rnc_files".DIRECTORY_SEPARATOR."Certificados";
	
		$dir = "";
		$cols = array();
		if($folder != ""){
			$dirPath = $dirPath.DIRECTORY_SEPARATOR.$folder;
			$dir = $folder.DIRECTORY_SEPARATOR;
				
		}else{
			if(Yii::app()->user->getState("roles") == "entidad"){
				$criteriaEntidad = new CDbCriteria;
				$criteriaEntidad->compare('usuario_id',Yii::app()->user->getId());
				$entidad = Entidad::model()->find($criteriaEntidad);
					
				$criteriaRegistro = new CDbCriteria;
				$criteriaRegistro->compare('entidad_id', $entidad->id);
				$criteriaRegistro->with = array('registros_update');
				$modelRegistros = Registros::model()->findAll($criteriaRegistro);
	
				foreach ($modelRegistros as $registro){
					foreach ($registro->registros_update as $reg_update){
						$cols[] = $reg_update->acronimo;
					}
				}
			}
		}
		$directorio = opendir($dirPath);
		$cont = 1;
		while ($archivo = readdir($directorio)){
			$isDir = 1;
			$arch_aux = explode("_", $archivo);
				
			if(Yii::app()->user->getState("roles") == "entidad"){
				if(($archivo != "." && $archivo != "..") && (in_array($arch_aux[1], $cols) || $folder != "")){
					if(!is_dir($dirPath.DIRECTORY_SEPARATOR.$archivo)){
						$isDir = 0;
					}
					$datos[] = array('id'=> $cont,'nombre'=>utf8_encode($archivo),'dir'=>$dir.$archivo,'isDir' => $isDir);
					$cont++;
				}
			}else {
				if($archivo != "." && $archivo != ".."){
					if(!is_dir($dirPath.DIRECTORY_SEPARATOR.$archivo)){
						$isDir = 0;
					}
					$datos[] = array('id'=> $cont,'nombre'=>utf8_encode($archivo),'dir'=>$dir.$archivo,'isDir' => $isDir);
					$cont++;
				}
			}
		}
	
		function cmp($a, $b){
			return strcmp($a['nombre'], $b['nombre']);
		}
		usort($datos, "cmp");
		$gridDataProvider = new CArrayDataProvider($datos);
		return $gridDataProvider;
	}
}
?>