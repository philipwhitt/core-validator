deps:
	composer up

test:
	php ./vendor/bin/phpunit ./test

.PHONY: test
