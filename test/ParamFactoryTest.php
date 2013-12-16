<?php

require_once dirname(dirname(__FILE__)).'/vendor/autoload.php';

use Core\Validator\ParamFactory;

class ParamFactoryTest extends PHPUnit_Framework_TestCase {

	private $params;
	private $factory;

	public function setup() {
		$this->params  = array('var1' => 'Hello World');
		$this->factory = new ParamFactory($this->params);
	}

	public function testGetVar() {
		$this->assertEquals($this->factory->getVar('var1')->get(), 'Hello World');
	}

	/**
	 * @expectedException Core\Validator\VarNotFoundException
	 */
	public function testGetVarError() {
		$this->factory->getVar('var2');
	}

	public function testRawParams() {
		$this->assertEquals($this->factory->getRawVars(), $this->params);
	}

	public function testHasVar() {
		$this->assertTrue($this->factory->hasVar('var1'));
		$this->assertFalse($this->factory->hasVar('var2'));
	}

	public function testAddVars() {
		$this->factory->addVars(array('var2' => 'Hello Universe'));

		$this->assertEquals($this->factory->getVar('var2')->get(), 'Hello Universe');
	}

}

