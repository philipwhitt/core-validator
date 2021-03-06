[![Build Status](https://drone.io/github.com/philipwhitt/core-validator/status.png)](https://drone.io/github.com/philipwhitt/core-validator/latest)

core-validator
==============

Install
-------
Install via composer
```javascript
{
	"require": {
		"core/validator"  : "dev-master"
	}
}
```


Simple Way to Validate Data
---------------------------
Using the builder class, you can chain together clear business logic to validate values:
```php
<?php

use Core\Validator as val;

try {
	$val = new val\Builder('Philip Whitt');
	$val->notEmpty()->isOnlyAlpha()->hasLengthGt(2)->get();

} catch (val\EmptyValueException $e) {
	// Handle empty value error
} catch (val\AlphaException $e) {
	// Handle non alpha error
} catch (val\InvalidLengthException $e) {
	// Handle length error
}

```

See test/BuilderTest.php for more working examples

Validate User Input
--------------------------------------------
Using the ParamFactory, its very easy to validate user input from get, post or releated data. Example of a $_POST of name=philip&id=1:
```php
<?php

use Core\Validator as val;

$validator = new val\ParamFactory($_REQUEST);

// Validate "id"
try {
	$id = $validator->getVar('id')->notEmpty()->isOnlyNum()->get();
} catch (val\Exception $e) {
	// Handle id error
}

// Validate "name"
try {
	$name = $validator->getVar('name')->notEmpty()->isOnlyAlpha()->hasLengthGt(2)->get();
} catch (val\Exception $e) {
	// Handle name error
}
```

See test/ParamFactoryTest.php for more working examples

Unit Tests
----------
Run tests using:

	$ phpunit test
