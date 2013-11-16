<?php
/**
 * This is the model class for table "_taxon_tree".
 *
 * The followings are the available columns in table '_taxon_tree':
 * @property integer $taxon_id
 * @property string $name
 * @property string $rank
 * @property integer $parent_id
 * @property string $lsid
 * @property integer $number_of_children
 * @property integer $total_species_estimation
 * @property integer $total_species
 * @property string estimate_source
 * @property string string
 * The followings are the available model relations:
 * @property Taxon_Detail[] $taxon_detail
 * 
 */

class Taxontree extends CActiveRecord{
	
	private $genus;
	private $genus_id;
	private $family;
	private $family_id;
	private $order;
	private $order_id;
	private $class;
	private $class_id;
	private $phylum;
	private $phylum_id;
	private $kingdom;
	private $kingdom_id;
	private $nombresTaxones;
	private $archivoTaxones;
	private $datosExportar;
	private $datosMap;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Catalogoespecies the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '_taxon_tree';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('name, rank, lsid', 'required'),
				array('taxon_id, parent_id, number_of_children, total_species_estimation, total_species', 'numerical', 'integerOnly'=>true),
				array('name, rank, lsid', 'length', 'max'=>255),
				array('archivoTaxones','file','maxSize' => 20000,'types' => 'txt'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('taxon_id, name, rank, parent_id, lsid, string', 'safe', 'on'=>'search')
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
			'taxon_detail' => array(self::HAS_MANY, 'Taxon_Detail', 'taxon_id')
			//'author_string' => array(self::HAS_ONE, 'Author_String', 'string')
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'taxon_id' => 'ID del Taxón',
				'name'	=> 'Specie',
				'lsid'	=> 'Specie ID',
				'genus'	=> 'Genus',
				'genus_id'	=> 'Genus ID',
				'family'	=> 'Family',
				'family_id'	=> 'Family ID',
				'order'	=> 'Order',
				'order_id'	=> 'Order ID',
				'class'	=> 'Class',
				'class_id'	=> 'Class ID',
				'phylum'	=> 'Phylum',
				'phylum_id'	=> 'Phylum ID',
				'kingdom'	=> 'Kingdom',
				'Kingdom_id'	=> 'Kingdom ID',
				'nombresTaxones' => 'Nombres Científicos',
				'archivoTaxones' => 'Archivo de Nombres'
		);
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		if ($this->nombresTaxones != '') {
			$nombresTaxones=str_replace("\r","<br>",$this->nombresTaxones);
			$lsid_ar = explode("<br>", $nombresTaxones);
			$this->datosMap = array();
			for ($i = 0; $i < count($lsid_ar); $i++) {
				$this->datosMap[trim($lsid_ar[$i])] = trim($lsid_ar[$i]);
			}
			
			if(count($lsid_ar) > 0){
				$criteria = new CDbCriteria;
				
				for ($i = 0; $i < count($lsid_ar); $i++) {
					if($i == 0){
						$condicion = "t.name LIKE '".trim($lsid_ar[$i])."'";
					}else{
						$condicion .= " OR t.name LIKE '".trim($lsid_ar[$i])."'";
					}
				}
				$cond = "SELECT t.name FROM _taxon_tree t WHERE ".$condicion;
				
				$criteria->with = array('taxon_detail', 'taxon_detail.author_string');
				$criteria->addCondition('`t`.`name` IN ('.$cond.')');
				$criteria->order = "name ASC";
				
				$lsids_result = $this->findAll($criteria);
				
				if(isset($lsids_result)){
					$datos_ar = Array();
					for ($i = 0; $i < count($lsids_result); $i++) {
						$datos = $this->init_datos();
						$author = (isset($lsids_result[$i]['taxon_detail'][0]['author_string']['string'])) ? $lsids_result[$i]['taxon_detail'][0]['author_string']['string']: ""; 
						$datos_ar[] = $this->getLSIDS($datos, $lsids_result[$i]->name, $lsids_result[$i]->lsid, $lsids_result[$i]->rank, $lsids_result[$i]->parent_id, $author);
					}
					
					$datos_ar = $this->ordenarTaxon($datos_ar);
					$dataProvider = array();
					$this->datosExportar = $datos_ar;
					$keysData = array_keys($datos_ar);
					
					for ($i = 0; $i < count($datos_ar); $i++) {
						$key = $keysData[$i];
						$dataProvider[$i]['id'] 		= $i + 1;
						$dataProvider[$i]['name']		= (isset($datos_ar[$key][9]['name'])) ? $datos_ar[$key][9]['name'] : $datos_ar[$key];
						$dataProvider[$i]['kingdom']	= (isset($datos_ar[$key][8]['name'])) ? $datos_ar[$key][8]['name'] : "-";
						$dataProvider[$i]['phylum']		= (isset($datos_ar[$key][7]['name'])) ? $datos_ar[$key][7]['name'] : "-";
						$dataProvider[$i]['class']		= (isset($datos_ar[$key][6]['name'])) ? $datos_ar[$key][6]['name'] : "-";
						$dataProvider[$i]['order']		= (isset($datos_ar[$key][5]['name'])) ? $datos_ar[$key][5]['name'] : "-";
						$dataProvider[$i]['family']		= (isset($datos_ar[$key][4]['name'])) ? $datos_ar[$key][4]['name'] : "-";
						$dataProvider[$i]['genus']		= (isset($datos_ar[$key][3]['name'])) ? $datos_ar[$key][3]['name'] : "-";
						$dataProvider[$i]['epitetoes']	= (isset($datos_ar[$key][2]['name'])) ? $datos_ar[$key][2]['name'] : "-";
						$dataProvider[$i]['epitetoin']	= (isset($datos_ar[$key][2]['lsid'])) ? $datos_ar[$key][2]['lsid'] : "-";
						$dataProvider[$i]['rank']		= (isset($datos_ar[$key][1]['name'])) ? $datos_ar[$key][1]['name'] : "-";
						$dataProvider[$i]['author']		= (isset($datos_ar[$key][1]['lsid'])) ? $datos_ar[$key][1]['lsid'] : "-";
						$dataProvider[$i]['specie']		= (isset($datos_ar[$key][0]['name'])) ? $datos_ar[$key][0]['name'] : "-";
						
						if(isset($datos_ar[$key][0]['lsid']) && $datos_ar[$key][0]['lsid'] != '-'){
							$dataProvider[$i]['specieid'] = $datos_ar[$key][0]['lsid'];
						}else if(isset($datos_ar[$key][0]['lsid'])){
							$k = 0;
							while($datos_ar[$key][$k]['lsid'] == '-'){
								$k++;
								$dataProvider[$i]['specieid'] = $datos_ar[$key][$k]['lsid'];
								
							}
						}else{
							$dataProvider[$i]['specieid'] = "-";
						}
					}
					//print_r($dataProvider);
					$gridDataProvider = new CArrayDataProvider($dataProvider);
					
					return $gridDataProvider;
					//echo $lsids_result->name;
				}
				
			}
		}
	}
	
	function searchData(){
		
		$criteria = new CDbCriteria;
		$criteria->addCondition("`t`.`taxon_id` = ".$this->taxon_id);
		$lsids_result = $this->findAll($criteria);
		return $lsids_result;
	}
	
	function  init_datos($datos = Array()){
		for ($i = 0; $i < 10; $i++) {
			$datos[$i]	= Array("name" => "-","lsid" => "-");
		}
	
		return $datos;
	
	}
	
	function getLSIDS($datos = Array(), $name = "", $lsid = "", $rank = "", $parent_id = 0, $author = ""){
	
		$parent_name = "";
		$parent_lsid = "";
		$parent_id_p = 0;
		$parent_rank = "";
	
		if ($parent_id != 0) {
			$criteria = new CDbCriteria;
			$criteria->addCondition("taxon_id = ".$parent_id);
			$result = $this->find($criteria);
				
			if($result){
				$parent_name = $result->name;
				$parent_lsid = $result->lsid;
				$parent_id_p = $result->parent_id;
				$parent_rank = $result->rank;
			}
		}
		switch ($rank) {
			case "species":
				if($datos[0]["name"] == '' || $datos[0]["name"] == "-"){
					$epitetos			= explode(" ", $name);
					$datos[9]["name"] 	= $name;
					$datos[0]["name"] 	= $name." ".$author;
					$datos[0]["lsid"]	= $lsid;
					$datos[1]["name"]	= $rank;
					$datos[1]["lsid"]	= $author;
					$datos[2]["name"]	= (isset($epitetos[1])) ? $epitetos[1] : $epitetos[0];
					$datos[2]["lsid"]	= (isset($epitetos[2])) ? (isset($epitetos[3]))? $epitetos[3]: $epitetos[2] : "-";
				}
				return  $this->getLSIDS($datos, $parent_name, $parent_lsid, $parent_rank, $parent_id_p);
				break;
	
			case "genus":
				if($datos[0]["name"] == '' || $datos[0]["name"] == "-"){
					$epitetos			= explode(" ", $name);
					$datos[9]["name"] 	= $name;
					$datos[0]["name"] 	= $name." ".$author;
					$datos[0]["lsid"]	= $lsid;
					$datos[1]["name"]	= $rank;
					$datos[1]["lsid"]	= $author;
				}
				$datos[3]["name"] 	= $name;
				$datos[3]["lsid"]	= $lsid;
				return $this->getLSIDS($datos, $parent_name, $parent_lsid, $parent_rank, $parent_id_p);
				break;
	
			case "family":
				if($datos[0]["name"] == '' || $datos[0]["name"] == "-"){
					$epitetos			= explode(" ", $name);
					$datos[9]["name"] 	= $name;
					$datos[0]["name"] 	= $name." ".$author;
					$datos[0]["lsid"]	= $lsid;
					$datos[1]["name"]	= $rank;
					$datos[1]["lsid"]	= $author;
				}
				$datos[4]["name"] 	= $name;
				$datos[4]["lsid"]	= $lsid;
				return $this->getLSIDS($datos, $parent_name, $parent_lsid, $parent_rank, $parent_id_p);
				break;
	
			case "order":
				if($datos[0]["name"] == '' || $datos[0]["name"] == "-"){
					$epitetos			= explode(" ", $name);
					$datos[9]["name"] 	= $name;
					$datos[0]["name"] 	= $name." ".$author;
					$datos[0]["lsid"]	= $lsid;
					$datos[1]["name"]	= $rank;
					$datos[1]["lsid"]	= $author;
				}
				$datos[5]["name"] 	= $name;
				$datos[5]["lsid"]	= $lsid;
				return $this->getLSIDS($datos, $parent_name, $parent_lsid, $parent_rank, $parent_id_p);
				break;
	
			case "class":
				if($datos[0]["name"] == '' || $datos[0]["name"] == "-"){
					$epitetos			= explode(" ", $name);
					$datos[9]["name"] 	= $name;
					$datos[0]["name"] 	= $name." ".$author;
					$datos[0]["lsid"]	= $lsid;
					$datos[1]["name"]	= $rank;
					$datos[1]["lsid"]	= $author;
				}
				$datos[6]["name"] 	= $name;
				$datos[6]["lsid"]	= $lsid;
				return $this->getLSIDS($datos, $parent_name, $parent_lsid, $parent_rank, $parent_id_p);
				break;
	
			case "phylum":
				if($datos[0]["name"] == '' || $datos[0]["name"] == "-"){
					$epitetos			= explode(" ", $name);
					$datos[9]["name"] 	= $name;
					$datos[0]["name"] 	= $name." ".$author;
					$datos[0]["lsid"]	= $lsid;
					$datos[1]["name"]	= $rank;
					$datos[1]["lsid"]	= $author;
				}
				$datos[7]["name"] 	= $name;
				$datos[7]["lsid"]	= $lsid;
				return $this->getLSIDS($datos, $parent_name, $parent_lsid, $parent_rank, $parent_id_p);
				break;
	
			case "kingdom":
				if($datos[0]["name"] == '' || $datos[0]["name"] == "-"){
					$epitetos			= explode(" ", $name);
					$datos[9]["name"] 	= $name;
					$datos[0]["name"] 	= $name." ".$author;
					$datos[0]["lsid"]	= $lsid;
					$datos[1]["name"]	= $rank;
					$datos[1]["lsid"]	= $author;
				}
				$datos[8]["name"] 	= $name;
				$datos[8]["lsid"]	= $lsid;
				return $datos;
				break;
	
			default:
				if($parent_id != 0){
					if($datos[0]["name"] == '' || $datos[0]["name"] == "-"){
						$epitetos			= explode(" ", $name);
						$datos[9]["name"] 	= $name;
						$datos[0]["name"] 	= $name." ".$author;
						$datos[0]["lsid"]	= $lsid;
						$datos[1]["name"]	= $rank;
						$datos[1]["lsid"]	= $author;
						$datos[2]["name"]	= (isset($epitetos[1])) ? $epitetos[1] : $epitetos[0];
						$datos[2]["lsid"]	= (isset($epitetos[2])) ? (isset($epitetos[3]))? $epitetos[3]: $epitetos[2] : "-";
					}
					return $this->getLSIDS($datos, $parent_name, $parent_lsid, $parent_rank, $parent_id_p);
				}
				break;
		}
	
	}
	
	public function ordenarTaxon($datos = array()){
		for ($i = 0; $i < count($datos); $i++) {
			$this->datosMap[$datos[$i][9]['name']] = $datos[$i];
		}
		return $this->datosMap;
	}
	
	public function getNombresTaxones() {
		return $this->nombresTaxones;
	}
	
	public function setNombresTaxones($value)
	{
		$this->nombresTaxones = $value;
	}
	
	public function getArchivoTaxones() {
		return $this->archivoTaxones;
	}
	
	public function setArchivoTaxones($value)
	{
		$this->archivoTaxones = $value;
	}
	
	public function getDatosExportar(){
		return $this->datosExportar;
	}
	
	public function setDatosExportar($value){
		$this->datosExportar = $value;
	}
	
	public function getDatosMap(){
		return $this->datosMap;
	}
	
	public function setDatosMap($value){
		$this->datosMap = $value;
	}
}