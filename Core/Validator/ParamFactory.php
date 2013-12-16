<?php

namespace Core\Validator;

require_once dirname(__FILE__).'/inc/exceptions.php';

class ParamFactory {

	private $vars;

	/**
	 * @param array.<string, string> $vars 
	 */
	public function __construct(array $vars) {
		$this->vars = $vars;
	}

	/**
	 * @param array.<string, string> $vars 
	 * @return void
	 */
	public function addVars(array $vars) {
		$this->vars = array_merge($this->vars, $vars);
	}

	/**
	 * @param string $key 
	 * @throws VarNotFoundException
	 * @return Builder
	 */
	public function getVar($key) {
		if (!$this->hasVar($key)) {
			throw new VarNotFoundException("$key not found");
		}
		return new Builder($this->vars[$key], $key);
	}

	public function getRawVars() {
		return $this->vars;
	}

	public function hasVar($key) {
		return isset($this->vars[$key]);
	}
}