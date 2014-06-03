<?php

class Reporte extends CFormModel
{
	public $entidadTitular;
	public $entidadTipoTitular;
	public $entidadNit;
	public $entidadRepresentante;
	public $entidadRepresentanteTipo;
	public $entidadRepresentanteId;
	public $entidadDireccion;
	public $entidadDepartamento;
	public $entidadCiudad;
	public $entidadTelefono;
	public $entidadEmail;
	public $coleccionNumero;
	public $coleccionFecha;
	public $reporteNombre;
	public $reporteAcronimo;
	public $reporteFundacion;
	public $reporteDescripcion;
	public $reporteDireccion;
	public $reporteDepartamento;
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
	public $tipoEjemplarTipo;
	public $tipoEjemplarTipoCant;
	//public $tipoEjemplar;
	//public $tipoNombreCientifico;
	public $tipoCantidad;
	public $nivelGrupo;
	public $nivelSubgrupo;
	public $nivelEjemplares;
	public $nivelCatalogados;
	public $nivelSistematizados;
	public $nivelOrden;
	public $nivelFamilia;
	public $nivelGenero;
	public $nivelEspecie;
	public $sistematizacion;
	public $contactoNombre;
	public $contactoCargo;
	public $contactoDependencia;
	public $contactoDireccion;
	public $contactoDepartamento;
	public $contactoCiudad;
	public $contactoTelefono;
	public $contactoEmail;
	public $dilegenciadorNombre;
	public $dilegenciadorDependencia;
	public $dilegenciadorCargo;
	public $dilegenciadorTelefono;
	public $dilegenciadorEmail;
	
	public $checkAll;
	
		
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
				'entidadTitular'			=> 'Titular',
				'entidadTipoTitular'		=> 'Tipo de titular',
				'entidadNit'				=> 'Identificación',
				'entidadRepresentante'		=> 'Representante legal',
				'entidadRepresentanteId'	=> 'Identificación representante',
				'entidadDireccion'			=> 'Dirección',
				'entidadDepartamento'		=> 'Departamento',
				'entidadCiudad'				=> 'Municipio',
				'entidadTelefono'			=> 'Teléfono',
				'entidadEmail'				=> 'Correo electrónico',
				'coleccionNumero' 			=> 'No. colección',
				'coleccionFecha' 			=> 'Última actualización',
				'reporteNombre' 			=> 'Nombre de la colección',
				'reporteAcronimo'			=> 'Acrónimo',
				'reporteFundacion'			=> 'Año de fundación',
				'reporteDescripcion'		=> 'Descripción',
				'reporteDireccion'			=> 'Dirección de la colección',
				'reporteDepartamento'		=> 'Departamento',
				'reporteCiudad'				=> 'Municipio',
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
				'tipoGrupo'					=> 'Grupo biológico',
				'tipoEjemplar'				=> 'Información sobre el ejemplar tipo',
				'tipoNombreCientifico'		=> 'Nombre científico',
				'tipoCantidad'				=> 'Cantidad de ejemplares',
				'nivelGrupo'				=> 'Grupo biológico',
				'nivelSubgrupo'				=> 'Subgrupo biológico',
				'nivelEjemplares'			=> 'No. ejemplares',
				'nivelCatalogados'			=> 'Ejemplares catalogados',
				'nivelSistematizados'		=> 'Ejemplares sistematizados',
				'nivelOrden'				=> 'Ejemplares identificados al nivel de orden',
				'nivelFamilia'				=> 'Ejemplares identificados al nivel de familia',
				'nivelGenero'				=> 'Ejemplares identificados al nivel de genero',
				'nivelEspecie'				=> 'Ejemplares identificados al nivel de especie',
				'sistematizacion'			=> 'Sistematización y publicación',
				'contactoNombre'			=> 'Persona de contacto',
				'contactoCargo'				=> 'Cargo',
				'contactoDependencia'		=> 'Dependencia',
				'contactoDireccion'			=> 'Dirección de correspondencia',
				'contactoDepartamento'		=> 'Departamento',
				'contactoCiudad'			=> 'Municipio',
				'contactoTelefono'			=> 'Teléfono(s)',
				'contactoEmail'				=> 'Correo electrónico',
				'dilegenciadorNombre'		=> 'Nombre dilegenciador',
				'dilegenciadorDependencia'	=> 'Dependencia',
				'dilegenciadorCargo'		=> 'Cargo',
				'dilegenciadorTelefono'		=> 'Teléfono',
				'dilegenciadorEmail'		=> 'Correo electrónico',
				'checkAll'					=> 'Seleccionar',
				'tipoEjemplarTipo'			=> 'Ejemplares tipo',
				'tipoEjemplarTipoCant'		=> 'Cantidad ejemplares tipo'
		);
	}
}

?>