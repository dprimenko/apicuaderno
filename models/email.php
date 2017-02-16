<?php

class Email {
	var $from;
	var $password;
	var $to;
	var $subject;
	var $message;

	function getFrom() {
		return $this->from;
	}

	function getPassword() {
		return $this->password;
	}

	function getTo() {
		return $this->to;
	}

	function getSubject() {
		return $this->subject;
	}

	function getMessage() {
		return $this->message;	
	}

	function setFrom($f) {
		$this->from = $f;
	}

	function setPassword($p) {
		$this->password = $p;
	}

	function setTo($t) {
		$this->to = $t;
	}

	function setSubject($s) {
		$this->subject = $s;
	}

	function setMessage($m) {
		$this->message = $m;	
	}
}

?>