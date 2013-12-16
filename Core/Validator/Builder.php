<?php

namespace Core\Validator;

require_once dirname(__FILE__).'/inc/exceptions.php';

class Builder {

	private $name;
	private $value;

	public function __construct($value, $name = 'value') {
		$this->value = $value;
		$this->name  = $name;
	}

	public function get() {
		return $this->value;
	}

	// Validators

	public function notEmpty() {
		$var = trim($this->value);
		if (strlen($var) == 0) {
			throw new EmptyValueException($this->name.' is empty.');
		}
		return $this;
	}
	public function jsonConvert() {
		$this->value = json_decode($this->value, true);
		if (is_null($this->value)) {
			throw new InvalidJsonException();
		}
		return $this;
	}
	public function isOnlyNum() {
		if (!preg_match('/^[0-9]{1,}$/', $this->value)) {
			throw new NumericException($this->name.' must be only numeric.');
		}
		return $this;
	}
	public function isOnlyAlpha() {
		if (!preg_match("/^[a-zA-Z]+$/", $this->value)) {
			throw new AlphaException($this->name.' must be only alpha.');
		}
		return $this;
	}
	public function isOnlyAlphaNumber() {
		if (!preg_match('/^[a-zA-Z0-9]+$/', $this->value)) {
			throw new AlphaNumericException($this->name.' must be alpha numeric.');
		}
		return $this;
	}
	public function hasLengthGt($length) {
		if (!(strlen($this->value) > $length)) {
			throw new InvalidLengthException("Var length was: ".strlen($this->value));
		}
		return $this;
	}
	public function isValidEmail() {
		if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
			throw new InvalidEmailException();
		}
		return $this;
	}

	// Commonly used string functions

	public function trim() {
		$this->value = trim($this->value);
		return $this;
	}
	public function rtrim() {
		$this->value = rtrim($this->value);
		return $this;
	}
	public function ltrim() {
		$this->value = ltrim($this->value);
		return $this;
	}
	public function ucwords() {
		$this->value = ucwords($this->value);
		return $this;
	}
	public function toLower() {
		$this->value = strtolower($this->value);
		return $this;
	}
	public function toUpper() {
		$this->value = strtoupper($this->value);
		return $this;
	}
	public function htmlConvert() {
		$this->value = htmlspecialchars($this->value);
		return $this;
	}

	public function __toString() {
		return $this->value;
	}
}
