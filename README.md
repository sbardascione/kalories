kalories
========

#### A few configuration is needed to run this application:

##### if you want to use docker

* install **docker** and **docker-compose**
* add to you **/etc/hosts** this line `127.0.0.1       kalories.dev`
* go to the **docker/** directory and from a terminal run this command: `docker-compose up --build`
* to access to the main container run `docker exec -ti docker_php_1 bash`
* then go to the root of the application `cd kalories`
* run `composer update`
* run `bin/console doctrine:schema:update --force`
* from a browser go to `kalories.dev`
* hire me

##### if you don't

* configure everything by yourself
* hire me