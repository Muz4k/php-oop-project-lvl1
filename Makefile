lint:
	composer exec --verbose phpcs -- --standard=PSR12 src tests
	composer exec --verbose phpstan -- --level=max analyse src tests
lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 src tests