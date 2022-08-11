install:
	composer install

validate:
	composer validate

du:
	composer dump-autoload

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 src bin

gendiff:
	./bin/gendiff

test:
	composer exec --verbose phpunit tests

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-text