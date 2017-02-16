<?php

require '../models/alumno.php';
require '../models/email.php';

define("TABLE_ALUMNOS", "alumnos");
define("TABLE_ACTITUD", "actitud");
define("TABLE_FALTAS", "faltas");
define("TABLE_TIPOS_FALTAS", "tiposFaltas");
define("TABLE_TRABAJO", "trabajo");
define("TABLE_TIPOS_TRABAJO", "tiposTrabajo");

define('OK', 200);
define('NOT_COMPLETED', 202);
define('CONFLICT', 409);

class AlumnosResult {

	var $code;
	var $status;
	var $message;
	var $alumnos;

	function getCode() {
		return $this->code;
	}

	function getStatus() {
		return $this->status;
	}

	function getMessage() {
		return $this->message;
	}

	function getAlumnos() {
		return $this->alumnos;
	}

	function setCode($c) {
		$this->code = $c;
	}

	function setStatus($s) {
		$this->status = $s;
	}

	function setMessage($m) {
		$this->message = $m;
	}

	function setAlumnos($a) {
		$this->alumnos = $a;
	}
}
?>