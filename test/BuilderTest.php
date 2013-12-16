<?php

require_once dirname(dirname(__FILE__)).'/vendor/autoload.php';

use Core\Validator\Builder;

class BuilderTest extends PHPUnit_Framework_TestCase {

	public function testIsOnlyNum() {
		$builder = new Builder(1);
		$this->assertEquals($builder->isOnlyNum()->get(), 1);
	}

	/**
	 * @expectedException Core\Validator\NumericException
	 */
	public function testIsOnlyNumError() {
		$builder = new Builder('asdf');
		$builder->isOnlyNum();
	}

	public function testIsOnlyAlpha() {
		$builder = new Builder('asdf');
		$this->assertEquals($builder->isOnlyAlpha()->get(), 'asdf');
	}

	/**
	 * @expectedException Core\Validator\AlphaException
	 */
	public function testIsOnlyAlphaError() {
		$builder = new Builder(1);
		$builder->isOnlyAlpha();
	}

	public function testIsOnlyAlphaNum() {
		$builder = new Builder('a1');
		$this->assertEquals($builder->isOnlyAlphaNumber()->get(), 'a1');
	}

	/**
	 * @expectedException Core\Validator\AlphaNumericException
	 */
	public function testIsOnlyAlphaNumError() {
		$builder = new Builder('a1#');
		$builder->isOnlyAlphaNumber();
	}

	public function testLengthGt() {
		$builder = new Builder('1234');
		$this->assertEquals($builder->hasLengthGt(3)->get(), '1234');
	}

	/**
	 * @expectedException Core\Validator\InvalidLengthException
	 */
	public function testLengthGtError() {
		$builder = new Builder('123');
		$builder->hasLengthGt(3);
	}

	/**
	 * @expectedException Core\Validator\InvalidLengthException
	 */
	public function testLengthGtError2() {
		$builder = new Builder('12');
		$builder->hasLengthGt(3);
	}

	public function testIsValidEmail() {
		$builder = new Builder('test@test.com');
		$this->assertEquals($builder->isValidEmail()->get(), 'test@test.com');
	}

	/**
	 * @expectedException Core\Validator\InvalidEmailException
	 */
	public function testIsValidEmailError() {
		$builder = new Builder('test@test');
		$builder->isValidEmail();
	}

	public function testValidJson() {
		$builder = new Builder('["Hello World"]');
		$this->assertEquals($builder->jsonConvert()->get(), array("Hello World"));
	}

	/**
	 * @expectedException Core\Validator\InvalidJsonException
	 */
	public function testJsonError() {
		$builder = new Builder('["Hello World"');
		$builder->jsonConvert();
	}

	public function testToUpper() {
		$builder = new Builder('philip');
		$this->assertEquals($builder->toUpper()->get(), 'PHILIP');
	}
	
	public function testToLower() {
		$builder = new Builder('PHILIP');
		$this->assertEquals($builder->toLower()->get(), 'philip');
	}
	
	public function testUcWords() {
		$builder = new Builder('philip test');
		$this->assertEquals($builder->ucwords()->get(), 'Philip Test');
	}
	
	public function testltrim() {
		$builder = new Builder(' philip');
		$this->assertEquals($builder->ltrim()->get(), 'philip');
	}
	
	public function testrtrim() {
		$builder = new Builder('philip ');
		$this->assertEquals($builder->rtrim()->get(), 'philip');
	}
	
	public function testtrim() {
		$builder = new Builder(' philip ');
		$this->assertEquals($builder->trim()->get(), 'philip');
	}
	
	public function testNotEmpty() {
		$builder = new Builder('philip');
		$this->assertEquals($builder->notEmpty()->get(), 'philip');
	}

	/**
	 * @expectedException Core\Validator\EmptyValueException
	 */
	public function testNotEmptyError() {
		$builder = new Builder('');
		$builder->notEmpty();
	}

	/**
	 * @expectedException Core\Validator\EmptyValueException
	 */
	public function testNotEmptyError2() {
		$builder = new Builder('   ');
		$builder->notEmpty();
	}

	/**
	 * @expectedException Core\Validator\EmptyValueException
	 */
	public function testNotEmptyError3() {
		$builder = new Builder('   ');
		$builder->trim()->notEmpty();
	}

	public function testToString() {
		$builder = new Builder('philip');
		$this->assertEquals((string)$builder, 'philip');
	}

}

