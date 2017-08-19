Simple Chat API
===============

A Symfony project created on August 17, 2017, 9:26 pm.

Prerequisites
-------------

###### Ensure you have the following prerequisites :

- Docker CE for Windows, Docker CE for Linux or Docker CE for MAC (require docker-sync) installed
- curl installed on the host machine or POSTMAN
- Docker compose installed

###### Set up environment

1. From the root folder of the application :


    cd docker

2. Install and start the Docker stack.

The docker stack is composed by 3 containers : php7 (latest), mariadb (latest) and nginx. All the configuration is done. You will just need to specify the database host in Symfony parameters.yml

Using Docker CE on Linux (Ubuntu, Debian, Fedora...) or Docker CE on Windows (it will use docker-compose.yml file) :

    docker-compose build
then

    docker-compose up -d
Sometimes, it is possible that the database container (mariadb) does not start.
Just run this command :

    docker-compose start

If you are on Mac OSX and that you use Docker CE for MAC. You should use [docker-sync](http://docker-sync.io/) to speed up the synchronization. I won't explain how to install it here.
If docker-sync is already installed on your Mac, just run this command in another terminal windows :

    docker-sync-stack start
You only need this command. It will start the containers (php7, mariadb, nginx). Keep this terminal windows open.

3. Configure database host in Symfony, inside parameters.yml file :

First run this command in a terminal windows :

    docker inspect --format '' $(docker ps -f name=db -q)

If there is no output, that means the mariadb container is not runing. Just run :

    docker-compose start
    docker inspect --format '' $(docker ps -f name=db -q)

On the output look for the "NetworkSettings" key, then "Networks", then "docker_default" and look for "IPAddress".
Copy and past the value in database_host parameter in parameters.yml

4. install the vendors :

set www-data user and group as owner of the files inside the project. Connect to the php container with the root user using this command

    docker exec -it chat_api_php bash
When you are in the bash run

    chown -R www-data:www-data .
Exit from the bash

    exit
Connect to the php container with the www-data user

    docker exec -itu www-data chat_api_php bash
Then install the vendors with composer (already installed in the php container)

    composer install

5. Set up the database :

Create the database and the schema

    bin/console d:d:c
    bin/console d:s:c
