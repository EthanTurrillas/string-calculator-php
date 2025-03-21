.PHONY : main build-image build-container start test shell stop clean
main: build-image build-container

build-image:
	docker build -t string-calculator .

build-container:
	docker run -dt --name string-calculator -v .:/540/Calculator string-calculator
	docker exec string-calculator composer install

start:
	docker start string-calculator

test: start
	docker exec string-calculator ./vendor/bin/phpunit tests/$(target)

shell: start
	docker exec -it string-calculator /bin/bash

stop:
	docker stop string-calculator

clean: stop
	docker rm string-calculator
	rm -rf vendor
