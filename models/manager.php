<?php

class Manager {
	var $fecha;
	var $idAlumno;
	var $idFalta;
	var $idTrabajo;
	var $observacion;

	function getFecha() {
		return $this->fecha;	
	}

	function getIdAlumno() {
		return $this->idAlumno;	
	}

	function getIdFalta() {
		return $this->idFalta;	
	}

	function getIdTrabajo() {
		return $this->idTrabajo;	
	}
	function getObservacion() {
		return $this->observacion;	
	}

	function setFecha($f) {
		$this->fecha = $f;
	}

	function setIdAlumno($a) {
		$this->idAlumno = $a;
	}

	function setIdFalta($f) {
		$this->idFalta = $f;
	}

	function setIdTrabajo($t) {
		$this->idTrabajo = $t;
	}

	function setObservacion($o) {
		$this->observacion = $o;
	}
}

?>