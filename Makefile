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

testdiff:
	./bin/gendiff tests/fixtures/file1.json tests/fixtures/file2.json

testdiffy:
	./bin/gendiff tests/fixtures/file1.yml tests/fixtures/file2.yml

test:
	composer exec --verbose phpunit tests