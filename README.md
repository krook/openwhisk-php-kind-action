# OpenWhisk PHP kind actions

This is a collection of PHP actions to test @akrabat's new [PHP kind pull request](https://github.com/apache/incubator-openwhisk/pull/2415). It assumes you have built your own instance of OpenWhisk based on his fork.

## Simple action with params
```bash
vi hello.php
wsk -i action update hello hello.php --kind php:7.1
wsk -i action invoke hello -r -p name World
```

## Action connecting to MySQL
```bash
vi mysql.php
cp template.local.env
vi local.env
source local.env
wsk -i action update mysql mysql.php --kind php:7.1 \
--param "MYSQL_HOSTNAME" $MYSQL_HOSTNAME \
--param "MYSQL_USERNAME" $MYSQL_USERNAME \
--param "MYSQL_PASSWORD" $MYSQL_PASSWORD \
--param "MYSQL_DATABASE" $MYSQL_DATABASE
wsk -i action invoke mysql -r \
--param name Tarball \
--param color Black
```

## Web action
```bash
vi web.php
# TODO
```

## Triggered by an alarm
```bash
vi alarm.php
# TODO
```

## Sequence
```bash
vi sequence1.php
vi sequence2.php
# TODO
```
