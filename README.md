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
Tarantool php client : https://github.com/tarantool-php/client
