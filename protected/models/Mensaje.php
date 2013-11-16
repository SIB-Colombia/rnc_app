<?php
class Mensaje
{
	private $titulo;
	private $mensaje;
	private $tipo;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getTitulo() {
		return $this->titulo;
	}
	
	public function setTitulo($value)
	{
		$this->titulo = $value;
	}
	
	public function getMensaje() {
		return $this->mensaje;
	}
	
	public function setMensaje($value)
	{
		$this->mensaje = $value;
	}
	
	public function getTipo() {
		return $this->tipo;
	}
	
	public function setTipo($value)
	{
		$this->tipo = $value;
	}
}
?>