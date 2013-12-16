<?php

require_once dirname(dirname(__FILE__)).'/vendor/autoload.php';

use Core\Validator\Builder;

class BuilderTest extends PHPUnit_Framework_TestCase {

	public function testIsOnlyNum() {
		$req = new Builder(1);
		$this->assertEquals($req->isOnlyNum()->get(), 1);
	}

	/**
	 * @expectedException Core\Validator\NumericException
	 */
	public function testIsOnlyNumError() {
		$req = new Builder('asdf');
		$req->isOnlyNum();
	}

	public function testIsOnlyAlpha() {
		$req = new Builder('asdf');
		$this->assertEquals($req->isOnlyAlpha()->get(), 'asdf');
	}

	/**
	 * @expectedException Core\Validator\AlphaException
	 */
	public function testIsOnlyAlphaError() {
		$req = new Builder(1);
		$req->isOnlyAlpha();
	}

	public function testIsOnlyAlphaNum() {
		$req = new Builder('a1');
		$this->assertEquals($req->isOnlyAlphaNumber()->get(), 'a1');
	}

	/**
	 * @expectedException Core\Validator\AlphaNumericException
	 */
	public function testIsOnlyAlphaNumError() {
		$req = new Builder('a1#');
		$req->isOnlyAlphaNumber();
	}

	public function testLengthGt() {
		$req = new Builder('1234');
		$this->assertEquals($req->hasLengthGt(3)->get(), '1234');
	}

	/**
	 * @expectedException Core\Validator\InvalidLengthException
	 */
	public function testLengthGtError() {
		$req = new Builder('123');
		$req->hasLengthGt(3);
	}

	/**
	 * @expectedException Core\Validator\InvalidLengthException
	 */
	public function testLengthGtError2() {
		$req = new Builder('12');
		$req->hasLengthGt(3);
	}

	public function testIsValidEmail() {
		$req = new Builder('test@test.com');
		$this->assertEquals($req->isValidEmail()->get(), 'test@test.com');
	}

	/**
	 * @expectedException Core\Validator\InvalidEmailException
	 */
	public function testIsValidEmailError() {
		$req = new Builder('test@test');
		$req->isValidEmail();
	}

	public function testValidJson() {
		$req = new Builder('["Hello World"]');
		$this->assertEquals($req->jsonConvert()->get(), array("Hello World"));
	}

	/**
	 * @expectedException Core\Validator\InvalidJsonException
	 */
	public function testJsonError() {
		$req = new Builder('["Hello World"');
		$req->jsonConvert();
	}

	public function testToUpper() {
		$req = new Builder('philip');
		$this->assertEquals($req->toUpper()->get(), 'PHILIP');
	}
	
	public function testToLower() {
		$req = new Builder('PHILIP');
		$this->assertEquals($req->toLower()->get(), 'philip');
	}
	
	public function testUcWords() {
		$req = new Builder('philip test');
		$this->assertEquals($req->ucwords()->get(), 'Philip Test');
	}
	
	public function testltrim() {
		$req = new Builder(' philip');
		$this->assertEquals($req->ltrim()->get(), 'philip');
	}
	
	public function testrtrim() {
		$req = new Builder('philip ');
		$this->assertEquals($req->rtrim()->get(), 'philip');
	}
	
	public function testtrim() {
		$req = new Builder(' philip ');
		$this->assertEquals($req->trim()->get(), 'philip');
	}
	
	public function testNotEmpty() {
		$req = new Builder('philip');
		$this->assertEquals($req->notEmpty()->get(), 'philip');
	}

	/**
	 * @expectedException Core\Validator\EmptyValueException
	 */
	public function testNotEmptyError() {
		$req = new Builder('');
		$req->notEmpty();
	}

	/**
	 * @expectedException Core\Validator\EmptyValueException
	 */
	public function testNotEmptyError2() {
		$req = new Builder('   ');
		$req->notEmpty();
	}

	/**
	 * @expectedException Core\Validator\EmptyValueException
	 */
	public function testNotEmptyError3() {
		$req = new Builder('   ');
		$req->trim()->notEmpty();
	}

	public function testToString() {
		$req = new Builder('philip');
		$this->assertEquals((string)$req, 'philip');
	}

}

