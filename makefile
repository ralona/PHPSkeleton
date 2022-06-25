container=php
input=exec $(container) $(command)
command=

help:
	@awk -F ':|##' \
		'/^[^\t].+?:.*?##/ {\
		printf "\033[36m%-30s\033[0m %s\n", $$1, $$NF \
		}' $(MAKEFILE_LIST)

up: input=up -d --force-recreate ## docker start

down: input=down ## docker down

run: command= sh ## run command

cc: container=php
cc: env=dev
cc: command=php bin/console cache:clear --env $(env) ## clean cache

composer: input=run --rm composer composer $(command)

autoload: input=run --rm composer composer dump-autoload ## composer dump-autoload

install: input=run --rm composer composer $(command) $(package)
install: package=
install: command=install ## install dependencies

log: container=
log: input=logs -f $(container) ## logs

test: command=/app/vendor/phpunit/phpunit/phpunit # run unit tests

console: input=exec php bin/console $(command)

doco up down log install composer cc run test autoload console:
	docker-compose $(input)