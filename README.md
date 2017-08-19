# Simple Chat API
-----------------

A Symfony project created on August 17, 2017, 9:26 pm.

## Table of contents
- [Prerequisites](https://github.com/FGamess/simple-chat-api#prerequisites)
  - [Tools required](https://github.com/FGamess/simple-chat-api#tools-required)
  - [Set up the docker stack](https://github.com/FGamess/simple-chat-api#set-up-the-docker-stack)
  - [Configure the database host in Symfony](https://github.com/FGamess/simple-chat-api#configure-the-database-host-in-symfony)
  - [Setting www-data as owner of the files](https://github.com/FGamess/simple-chat-api#setting-www-data-as-owner-of-the-files)
  - [Install the vendors](https://github.com/FGamess/simple-chat-api#install-the-vendors)
  - [Set up the database](https://github.com/FGamess/simple-chat-api#set-up-the-database)


Prerequisites
-------------

###### Tools required

- Docker CE for Windows, Docker CE for Linux or Docker CE for MAC (require docker-sync) installed
- curl installed on the host machine or POSTMAN
- Docker compose installed

###### Set up the docker stack

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

###### Configure the database host in Symfony

1. Find the ip address of the mariadb container

First run this command in a terminal windows

    docker inspect --format '' $(docker ps -f name=db -q)

If there is no output, that means the mariadb container is not runing. Just run

    docker-compose start
    docker inspect --format '' $(docker ps -f name=db -q)

On the output look for the "NetworkSettings" key, then "Networks", then "docker_default" and look for "IPAddress".

2. Copy and past the value in database_host parameter in parameters.yml

###### Setting www-data as owner of the files.

Set www-data user and group as owner of the files inside the project. Connect to the php container with the root user using this command

    docker exec -it chat_api_php bash
When you are in the bash run

    chown -R www-data:www-data .
Exit from the bash

    exit

###### Install the vendors

1. Connect to the php container with the www-data user.


    docker exec -itu www-data chat_api_php bash

2. Then install the vendors with composer (already installed in the php container)


    composer install

###### Set up the database

1. Create the database (it should already exist but do it to be sure) :


    bin/console d:d:c

2. Create the database schema


    bin/console d:s:c
