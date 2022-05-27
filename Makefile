install:
	composer install

validate:
	composer validate

du:
	composer dump-autoload

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin

gendiff:
	./bin/gendiff

testdiff:
	./bin/gendiff tests/fixtures/file1.json tests/fixtures/file2.json
