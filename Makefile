SHELL=/bin/sh

.PHONY: install
install:
	docker-compose run composer install

.PHONY: build
build:
	docker-compose run composer install
	docker-compose up -d
	docker-compose run php bin/console doctrine:migrations:migrate

.PHONY: up
up:
	docker-compose up -d

