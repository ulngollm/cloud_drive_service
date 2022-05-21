build:
	docker-compose -p module --env-file $(CURDIR)/../app/.env build
up:
	docker-compose -p module --env-file $(CURDIR)/../app/.env up
down:
	docker-compose -p module --env-file $(CURDIR)/../app/.env start
start:
	docker-compose -p module --env-file $(CURDIR)/../app/.env start
stop:
	docker-compose -p module --env-file $(CURDIR)/../app/.env stop


