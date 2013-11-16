<?php

/**
 * This is the model class for table "catalogoespecies".
 *
 * The followings are the available columns in table 'catalogoespecies':
 * @property integer $catalogoespecies_id
 * @property integer $citacion_id
 * @property integer $contacto_id
 * @property string $fechaactualizacion
 * @property string $fechaelaboracion
 * @property string $titulometadato
 * @property string $jerarquianombrescomunes
 *
 * The followings are the available model relations:
 * @property PcaatCe $pcaatCe
 * @property PcregionnaturalCe[] $pcregionnaturalCes
 * @property PctesaurosCe[] $pctesaurosCes
 * @property PcdepartamentosCe[] $pcdepartamentosCes
 * @property PcorganizacionesCe[] $pcorganizacionesCes
 * @property PccorporacionesCe[] $pccorporacionesCes
 * @property Verificacionce $verificacionce
 * @property Contactos $contacto
 * @property CePlantilla[] $cePlantillas
 * @property CeAtributovalor[] $ceAtributovalors
 */
class Catalogoespecies extends CActiveRecord
{
	public $taxonnombre_search;
	public $taxonnombrecompleto_search;
	public $nombresComunes_search;
	private $_idEstadoVerificacion;
	private $_comentarioVerificacion;
	private $_jerarquiaTaxonomica;
	private $_taxonNombre;
	private $_autor;
	private $_paginaWeb;
	private $_tituloCita;
	private $_autorCita;
	private $_personaContacto;
	private $_organizacionContacto;
	private $_listaNombresComunes;
	public 	$ids_filter; 
	
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
		return 'catalogoespecies';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('citacion_id, contacto_id, fechaactualizacion, fechaelaboracion', 'required'),
			array('catalogoespecies_id, citacion_id, contacto_id', 'numerical', 'integerOnly'=>true),
			array('titulometadato', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('catalogoespecies_id, citacion_id, contacto_id, fechaactualizacion, fechaelaboracion, titulometadato, jerarquianombrescomunes, taxonnombre_search, nombresComunes_search, taxonnombrecompleto_search', 'safe', 'on'=>'search'),
			array('idEstadoVerificacion, comentarioVerificacion, jerarquiaTaxonomica, taxonNombre, taxonnombrecompleto_search, nombresComunes_search, autor, paginaWeb, jerarquianombrescomunes, tituloCita, autorCita, personaContacto, organizacionContacto, listaNombresComunes', 'safe'),
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
			'pcaatCe' => array(self::HAS_ONE, 'PcaatCe', 'catalogoespecies_id'),
			'pcregionnaturalCes' => array(self::HAS_MANY, 'PcregionnaturalCe', 'catalogoespecies_id'),
			'pctesaurosCes' => array(self::HAS_MANY, 'PctesaurosCe', 'catalogoespecies_id'),
			'pcdepartamentosCes' => array(self::HAS_MANY, 'PcdepartamentosCe', 'catalogoespecies_id'),
			'pcorganizacionesCes' => array(self::HAS_MANY, 'PcorganizacionesCe', 'catalogoespecies_id'),
			'pccorporacionesCes' => array(self::HAS_MANY, 'PccorporacionesCe', 'catalogoespecies_id'),
			'verificacionce' => array(self::HAS_ONE, 'Verificacionce', 'catalogoespecies_id'),
			'contacto' => array(self::BELONGS_TO, 'Contactos', 'contacto_id'),
			'citacion' => array(self::BELONGS_TO, 'Citacion', 'citacion_id'),
			'cePlantillas' => array(self::HAS_MANY, 'CePlantilla', 'catalogoespecies_id'),
			'ceAtributovalors' => array(self::HAS_MANY, 'CeAtributovalor', 'catalogoespecies_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'catalogoespecies_id' => 'ID de Ficha',
			'citacion_id' => 'ID Citacion',
			'contacto_id' => 'ID Contacto',
			'fechaactualizacion' => 'Fecha de actualización',
			'fechaelaboracion' => 'Fecha de elaboración',
			'titulometadato' => 'Título del metadato (hipervínculo)',
			'jerarquianombrescomunes' => 'Ficha nomenclatural en el archivo de autoridad taxonómica (hipervínculo)',
			'taxonnombre_search'=>'Nombre científico',
			'nombresComunes_search'=>'Nombres comunes',
			'taxonnombrecompleto_search'=>'Jerarquia Taxonómica',
			'idEstadoVerificacion'=>'Estado de verificación',
			'comentarioVerificacion'=>'Comentario',
			'jerarquiaTaxonomica'=>'Jerarquía taxonómica',
			'taxonNombre'=>'Nombre científico',
			'autor'=>'Autor',
			'paginaWeb'=>'Página web',
			'tituloCita'=>'Título de la cita',
			'autorCita'=>'Autor de la cita',
			'personaContacto'=>'Nombre del contacto',
			'organizacionContacto'=>'Organización'
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
		
		//$criteria->together = true;
		//$criteria->with = array('pctesaurosCes', 'pcaatCe');
		$criteria->join = 'INNER JOIN "pcaat_ce" "pcaatCe" ON ("pcaatCe"."catalogoespecies_id"="t"."catalogoespecies_id")';
		//$criteria->join .= 'LEFT OUTER JOIN "pctesauros_ce" "pctesaurosCes" ON ("pctesaurosCes"."catalogoespecies_id"="t"."catalogoespecies_id")';
		
		$criteria->compare('t.catalogoespecies_id',$this->catalogoespecies_id);
		$criteria->compare('citacion_id',$this->citacion_id);
		$criteria->compare('contacto_id',$this->contacto_id);
		//$criteria->compare('fechaactualizacion',$this->fechaactualizacion,true);
		//$criteria->compare('fechaelaboracion',$this->fechaelaboracion,true);
		$criteria->addCondition('fechaactualizacion::text LIKE \'%'.$this->fechaactualizacion.'%\'');
		$criteria->addCondition('fechaelaboracion::text LIKE \'%'.$this->fechaelaboracion.'%\'');
		$criteria->compare('LOWER(titulometadato)',strtolower($this->titulometadato),true);
		$criteria->compare('LOWER(jerarquianombrescomunes)',strtolower($this->jerarquianombrescomunes),true);
		$criteria->compare('LOWER("pcaatCe".taxonnombre)', strtolower($this->taxonnombre_search), true );
		$criteria->compare('LOWER("pcaatCe".taxoncompleto)', strtolower($this->taxonnombrecompleto_search), true );
		//$criteria->compare('LOWER("pctesaurosCes".tesauronombre)', strtolower($this->nombresComunes_search), true );
		
		//$criteria->group='"pctesaurosCes".tesauronombre';
		//$criteria->distinct = true;
		
		$sql='';
		if($this->nombresComunes_search != '') {
			$sql = "SELECT DISTINCT catalogoespecies.catalogoespecies_id "
				  ."FROM catalogoespecies "
				  ."INNER JOIN pctesauros_ce ON catalogoespecies.catalogoespecies_id = pctesauros_ce.catalogoespecies_id "
				  ."WHERE LOWER(pctesauros_ce.tesauronombre) LIKE '%".strtolower($this->nombresComunes_search)."%'";
			
			$criteria->addCondition('t.catalogoespecies_id IN ('.$sql.')');
		}
		
		if($this->ids_filter != ''){
			$criteria->addCondition('t.catalogoespecies_id IN ('.$this->ids_filter.')');
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array('pageSize' => 20),
			'sort'=>array(
				'attributes'=>array(
					'taxonnombre_search'=>array(
						'asc'=>'"pcaatCe".taxonnombre',
						'desc'=>'"pcaatCe".taxonnombre DESC',
					),
					'taxonnombrecompleto_search'=>array(
						'asc'=>'"pcaatCe".taxoncompleto',
						'desc'=>'"pcaatCe".taxoncompleto DESC',
					),
					'*',
				),
				'defaultOrder' => '"pcaatCe".taxonnombre',
			),
		));
	}
	
	public function getIdEstadoVerificacion() {
		return $this->_idEstadoVerificacion;
	}
	
	public function setIdEstadoVerificacion($value)
	{
		$this->_idEstadoVerificacion = $value;
	}
	
	public function getComentarioVerificacion() {
		return $this->_comentarioVerificacion;
	}
	
	public function setComentarioVerificacion($value)
	{
		$this->_comentarioVerificacion = $value;
	}

	
	public function getJerarquiaTaxonomica() {
		return $this->_jerarquiaTaxonomica;
	}
	
	public function setJerarquiaTaxonomica($value)
	{
		$this->_jerarquiaTaxonomica = $value;
	}
	
	public function getTaxonNombre() {
		return $this->_taxonNombre;
	}
	
	public function setTaxonNombre($value)
	{
		$this->_taxonNombre = $value;
	}
	
	public function getAutor() {
		return $this->_autor;
	}
	
	public function setAutor($value)
	{
		$this->_autor = $value;
	}
	
	public function getPaginaWeb() {
		return $this->_paginaWeb;
	}
	
	public function setPaginaWeb($value)
	{
		$this->_paginaWeb = $value;
	}
	
	public function getTituloCita() {
		return $this->_tituloCita;
	}
	
	public function setTituloCita($value)
	{
		$this->tituloCita = $value;
	}
	
	public function getAutorCita() {
		return $this->_autorCita;
	}
	
	public function setAutorCita($value)
	{
		$this->_autorCita = $value;
	}
	
	public function getPersonaContacto() {
		return $this->_personaContacto;
	}
	
	public function setPersonaContacto($value)
	{
		$this->_personaContacto = $value;
	}
	
	public function getOrganizacionContacto() {
		return $this->_organizacionContacto;
	}
	
	public function setOrganizacionContacto($value)
	{
		$this->_organizacionContacto = $value;
	}
	
	public function ListarEstadosVerificacion()
	{
		return CHtml::listData(Estadoverificacion::model()->findAll(), 'estado_id','nombre');
	}
	
	public function getListaNombresComunes() {
		$response = '<ul>';
		foreach ($this->pctesaurosCes as $nombreComun) {
			$response .= '<li>'.$nombreComun->tesauronombre.'</li>';
		}
		$response .= '</ul>';
		return $response;
	}
}