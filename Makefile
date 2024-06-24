install:
	composer install

validate:
	composer validate

init:
	composer exec --verbose phpcs -- --standard=PSR12 src bin