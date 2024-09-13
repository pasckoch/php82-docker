
# PHP 8.2 Docker
The idea behind this project is to create a docker architecture that works with php 8.2. A web database is created with third-party applications in containers: mariadb, sqllite3, redis, tarantool for data manipulation (NO SQL), rabbitmq, opensearch. A list of project sources is built. Each source can itself be optionally mounted in a docker, project 2 is a magento open source 2.4.6 and gives rise to a container. The aim is obviously to have a range of php 8.2 projects, with the possibility of using the api you want by starting or not their container for the heavier ones that have one.

## hosts to declare in /etc/hosts
127.0.0.1   localhost php82.docker php82.project1.docker php82.project2.docker

## Commands 
### Build
docker-composer up -d --build
### Start
if already build: docker-composer up -d
### Stop
docker-composer down
### Erase volumes
docker-composer down -v

## Routes
Warning, using 8080 port
```
http://php82.docker:8080/  
http://php82.project1.docker:8080/  
RabbitMq http://php82.docker:15672  `guest:guest`  
```

## Architecture
```
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
  |    |--project2/ # Adobe Commerce Open source 2.4.6  
  |         |--composer.json
  |         |--composer.lock
  |         |--auth.json
  |         |--docker-compose.yml  
  |    
```

## Composer components
```
"tarantool/client": "^0.10.1",  
"php-amqplib/php-amqplib": "^3.2" //rabbitMq php client
```  

## Project 2 is Magento 2.4.6
```
Build and Start the base at root: docker compose up -d --build
Idem in src/project2:docker compose up -d --build
In the container, install M2 as described by Adobe
```

