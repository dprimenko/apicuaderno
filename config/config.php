<?php

require '../models/alumno.php';
require '../models/manager.php';
require '../models/email.php';

define("TABLE_ALUMNOS", "alumnos");
define("TABLE_MANAGER", "manager");
define("TABLE_TIPOS_FALTAS", "tiposFaltas");
define("TABLE_TIPOS_TRABAJO", "tiposTrabajo");

define('OK', 200);
define('NOT_COMPLETED', 202);
define('CONFLICT', 409);

define('FROM', "davidruso47@gmail.com");
define('PASSWORD', "david4769");

class AlumnosResult {

	var $code;
	var $status;
	var $message = "No message";
	var $alumnos;
	var $inserted = 0;
	var $updated = 0;
	var $deleted = 0;

	function getCode() {
		return $this->code;
	}

	function getStatus() {
		return $this->status;
	}

	function getMessage() {
		return $this->message;
	}

	function getInserted() {
		return $this->inserted;
	}

	function getUpdated() {
		return $this->updated;
	}

	function getDeleted() {
		return $this->deleted;
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

	function setInserted($i) {
		$this->inserted = $i;
	}

	function setUpdated($u) {
		$this->updated = $u;
	}

	function setDeleted($d) {
		$this->deleted = $d;
	}

}

class EmailResult {
	var $message;
	var $address;
	var $password;

	function getMessage() {
		return $this->message;
	}

	function setMessage($m) {
		$this->message = $m;
	}	

	function getAddress() {
		return $this->address;
	}

	function setAddress($a) {
		$this->address = $a;
	}

	function getPassword() {
		return $this->password;
	}

	function setPassword($p) {
		$this->password = $p;
	}
}

class ManagerResult {

	var $code;
	var $status;
	var $message = "No message";
	var $manager;
	var $inserted = 0;
	var $updated = 0;
	var $deleted = 0;
	var $idStudent;
	var $sql;

	function getCode() {
		return $this->code;
	}

	function getStatus() {
		return $this->status;
	}

	function getMessage() {
		return $this->message;
	}

	function getInserted() {
		return $this->inserted;
	}

	function getUpdated() {
		return $this->updated;
	}

	function getDeleted() {
		return $this->deleted;
	}

	function getManager() {
		return $this->manager;
	}

	function getRequestedStudent() {
		return $this->idStudent;
	}

	function geSql() {
		return $this->sql;
	}

	function setSql($s) {
		$this->sql = $s;
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

	function setManager($m) {
		$this->manager = $m;
	}

	function setInserted($i) {
		$this->inserted = $i;
	}

	function setUpdated($u) {
		$this->updated = $u;
	}

	function setDeleted($d) {
		$this->deleted = $d;
	}

	function setRequestedStudent($i) {
		$this->idStudent = $i;
	}

}
?>