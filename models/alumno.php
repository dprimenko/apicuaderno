<?php

class Alumno {

	var $id;
	var $nombre;
	var $apellidos;
	var $direccion;
	var $ciudad;
	var $cp;
	var $telefono;
	var $email;

	function getId() {
		return $this->id;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getApellidos() {
		return $this->apellidos;
	}

	function getDireccion() {
		return $this->direccion;
	}

	function getCiudad() {
		return $this->ciudad;
	}

	function getCp() {
		return $this->cp;
	}

	function getTelefono() {
		return $this->telefono;
	}

	function getEmail() {
		return $this->email;
	}

	function setId($i) {
		$this->id = $i;
	}

	function setNombre($n) {
		$this->nombre = $n;
	}

	function setApellidos($a) {
		$this->apellidos = $a;
	}

	function setDireccion($d) {
		$this->direccion = $d;
	}

	function setCiudad($c) {
		$this->ciudad = $c;
	}

	function setCp($c) {
		$this->cp = $c;
	}

	function setTelefono($t) {
		$this->telefono = $t;
	}

	function setEmail($e) {
		$this->email = $e;
	}
}

?>