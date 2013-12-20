<?php

class Reporte extends CFormModel
{
	public $entidadNombre;
	public $coleccionNumero;
	public $coleccionFecha;
	public $reporteNombre;
	public $reporteAcronimo;
	public $reporteFundacion;
	public $reporteDescripcion;
	public $reporteDireccion;
	public $reporteCiudad;
	public $reporteTelefono;
	public $reporteEmail;
	public $coberturaTaxonomica;
	public $coberturaGeografica;
	public $coberturaTemporal;
	public $documentoAnexos;
	public $informacionAdicional;
	public $informacionPagina;
	public $tamanoTipo;
	public $tamanoUnidad;
	//public $tamanoCantidad;
	public $tipoGrupo;
	public $tipoEjemplar;
	public $tipoNombreCientifico;
	//public $tipoCantidad;
	public $nivelGrupo;
	public $nivelEjemplares;
	public $nivelCatalogados;
	public $nivelSistematizados;
	public $nivelFamilia;
	public $nivelGenero;
	public $nivelEspecie;
	public $sistematizacion;
	public $contactoNombre;
	public $contactoCargo;
	public $contactoDependencia;
	public $contactoDireccion;
	public $contactoCiudad;
	public $contactoTelefono;
	public $contactoEmail;
	public $dilegenciadorNombre;
	public $dilegenciadorDependencia;
	public $dilegenciadorCargo;
	public $dilegenciadorTelefono;
	public $dilegenciadorEmail;
	
		
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('*', 'boolean'),
		);
	}
	
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
				'entidadNombre'				=> 'Entidad',
				'coleccionNumero' 			=> 'No. Colección',
				'coleccionFecha' 			=> 'Última Actualización',
				'reporteNombre' 			=> 'Nombre de la colección',
				'reporteAcronimo'			=> 'Acrónimo',
				'reporteFundacion'			=> 'Año de fundación',
				'reporteDescripcion'		=> 'Descripción',
				'reporteDireccion'			=> 'Dirección de la colección',
				'reporteCiudad'				=> 'Ciudad',
				'reporteTelefono'			=> 'Teléfono',
				'reporteEmail'				=> 'Correo electrónico',
				'coberturaTaxonomica'		=> 'Cobertura taxonómica',
				'coberturaGeografica'		=> 'Cobertura geográfica',
				'coberturaTemporal'			=> 'Cobertura temporal',
				'documentoAnexos'			=> 'Listado de anexos',
				'informacionAdicional'		=> 'Información adicional',
				'informacionPagina'			=> 'Página web de la colección',
				'tamanoTipo'				=> 'Tipo de preservación',
				'tamanoUnidad'				=> 'Unidad de medida',
				'tamanoCantidad'			=> 'Cantidad de ejemplares',
				'tipoGrupo'					=> 'Grupo',
				'tipoEjemplar'				=> 'Información sobre el ejemplar tipo',
				'tipoNombreCientifico'		=> 'Nombre Científico',
				'tipoCantidad'				=> 'Cantidad de ejemplares',
				'nivelGrupo'				=> 'Grupo taxonómico o biológico',
				'nivelEjemplares'			=> 'No. Ejemplares',
				'nivelCatalogados'			=> 'Ejemplares catalogados',
				'nivelSistematizados'		=> 'Ejemplares sistematizados',
				'nivelFamilia'				=> 'Ejemplares identificados al nivel de familia',
				'nivelGenero'				=> 'Ejemplares identificados al nivel de genero',
				'nivelEspecie'				=> 'Ejemplares identificados al nivel de especie',
				'sistematizacion'			=> 'Sistematización y Publicación',
				'contactoNombre'			=> 'Persona de contacto',
				'contactoCargo'				=> 'Cargo',
				'contactoDependencia'		=> 'Dependencia',
				'contactoDireccion'			=> 'Dirección de correspondencia',
				'contactoCiudad'			=> 'Ciudad',
				'contactoTelefono'			=> 'Teléfono(s)',
				'contactoEmail'				=> 'Correo electrónico',
				'dilegenciadorNombre'		=> 'Nombre',
				'dilegenciadorDependencia'	=> 'Dependencia',
				'dilegenciadorCargo'		=> 'Cargo',
				'dilegenciadorTelefono'		=> 'Telefono',
				'dilegenciadorEmail'		=> 'Correo Electrónico'
		);
	}
}

?>