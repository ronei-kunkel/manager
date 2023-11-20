#!/bin/bash

echo ""

### Copy .env.example to .env
if [ ! -e ".env" ]; then
  cp .env.example .env
fi

### Set .env vars into shell session
export $(cat .env)

### Show containers running
echo "Containers Already Running:"
if [ -z "$(docker ps -a --filter 'status=running' --format 'table {{.ID}} \t {{.Names }} \t {{.Status}}' | grep ish_)" ]; then
  echo "none"
  echo ""
else
  docker ps -a --filter 'status=running' --format 'table {{.ID}} \t {{.Names }} \t {{.Status}}' | grep ish_
  containers=$(docker ps -a --filter 'status=running' --format 'table {{.ID}} \t {{.Names }} \t {{.Status}}' | grep ish_)
  echo ""
fi

### Network
if [ -z "$(docker network ls -q -f name=ish_internal)" ]; then
  docker network create -d bridge ish_internal
  echo ""
fi

### MariaDB
if [ "$(docker ps -q -f name=ish_mariadb)" ]; then
  echo ""
else
  docker run --rm -d -v $(pwd)/.docker/database/:/var/lib/mysql/ -v $(pwd)/.docker/logs/mysql:/var/log/mysql/ -p 3306:3306 --name ish_mariadb --network ish_internal -e MYSQL_ROOT_PASSWORD=$DB_PASSWORD -e MARIADB_ROOT_PASSWORD=$DB_PASSWORD -e MARIADB_PASSWORD=$DB_PASSWORD -e MARIADB_USER=$DB_USERNAME mariadb:11.0.2
  echo ""
fi

### RabbitMq
if [ "$(docker ps -q -f name=ish_rabbitmq)" ]; then
  echo ""
else
  chmod 777 -R $(pwd)/.docker/queue
  chmod 777 -R $(pwd)/.docker/rabbitmq
  chmod 777 -R $(pwd)/.docker/logs/rabbitmq

  rm -rf $(pwd)/.docker/queue/mnesia/
  rm -rf $(pwd)/.docker/queue/.erlang.cookie
  rm -rf $(pwd)/.docker/logs/rabbitmq/rabbit.log

  docker run --rm -d -v $(pwd)/.docker/queue:/var/lib/rabbitmq -v $(pwd)/.docker/rabbitmq/10-defaults.conf:/etc/rabbitmq/conf.d/10-defaults.conf -v $(pwd)/.docker/logs/rabbitmq:/var/log/rabbitmq/ -p 5672:5672 -p 15672:15672 --name ish_rabbitmq --network ish_internal -e RABBITMQ_ERLANG_COOKIE=$Q_COOKIE -e RABBITMQ_DEFAULT_USER=$Q_USER -e RABBITMQ_DEFAULT_PASS=$Q_PASS rabbitmq:management
  echo ""
fi

### php-swoole server running Manager project with hyperf framework
if [ "$(docker ps -q -f name=ish_hyperf)" ]; then
  echo ""
else
  docker run --rm -d -v $(pwd):/backend/manager --name ish_hyperf -p 80:9501 --privileged -u root --network ish_internal -it --entrypoint "/backend/manager/entrypoint.sh" hyperf/hyperf:8.2-alpine-v3.18-swoole
  echo ""
fi

### Show containers running
containers_last_verify=$(docker ps -a --filter 'status=running' --format 'table {{.ID}} \t {{.Names }} \t {{.Status}}' | grep ish_)
if [ "$containers" = "$containers_last_verify" ]; then
  echo "All containers running."
  echo ""
else
  echo "Containers running:"
  docker ps -a --filter "status=running" --format 'table {{.ID}} \t {{.Names}} \t {{.Status}}' | grep ish_
  echo ""
fi


### Show addresses
if [ "$(docker ps -q -f name=ish_hyperf)" ]; then
  echo "Manager are available on: http://localhost"
  echo ""
fi

if [ "$(docker ps -q -f name=ish_rabbitmq)" ]; then
  echo "Queue web interface are running on: http://localhost:15672"
  echo "User and pass are availiable on .env file"
  echo ""
fi

if [ "$(docker ps -q -f name=ish_mariadb)" ]; then
  echo "Database user, pass and port are availiable on .env file"
  echo ""
fi

echo "Enjoy!"
echo ""
