<?php

namespace Core\Validator;

class Exception extends \Exception {}
class VarNotFoundException extends Exception {}
class EmptyValueException extends Exception {}

class TypeException extends Exception {}
class NumericException extends TypeException {}
class AlphaException extends TypeException {}
class AlphaNumericException extends TypeException {}
class InvalidLengthException extends TypeException {}
class InvalidEmailException extends TypeException {}
class InvalidJsonException extends TypeException {}