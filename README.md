/etc/hosts
127.0.0.1   localhost php82.docker php82.project1.docker

Commands:
Build:
docker-composer up -d --build
Start:
if already build: docker-composer up -d
Stop
docker-composer down
Erase volumes
docker-composer down -v

Routes :
http://php82.docker:8080/
http://php82.project1.docker:8080/
RabbitMq http://php82.docker:15672 guest:guest

php82
  |--docker-compose.yml
  |--.config/
  |    |--docker/
  |         |--nginx/
  |              |--phpfpm82.conf #default conf used in /src
  |              |--project.conf  #project1 conf used in /src/project1
  |         |--php82/
  |              |--Dockerfile #image from php:8.2-fpm used to get 8.2-fpm (build instead image in docker-compose.yml) add php extensions, main cause of the file      
  |--src/
  |    |--index.php
  |    |--composer.json
  |    |--composer.lock
  |    |--vendor/
  |    |--project1/
  |         |--index.php


Components:
        "tarantool/client": "^0.10.1",
        "php-amqplib/php-amqplib": "^3.2" //rabbitMq php client

