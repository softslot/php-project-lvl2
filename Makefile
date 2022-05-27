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
