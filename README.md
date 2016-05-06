card-validation
===============

[![Build Status](https://scrutinizer-ci.com/g/gusdecool/card-validation/badges/build.png?b=master)](https://scrutinizer-ci.com/g/gusdecool/card-validation/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gusdecool/card-validation/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gusdecool/card-validation/?branch=master)

Installation
------------

**Using vagrant [RECOMMENDED]**

1. Clone the project
2. Add domain to your host, usually located on `/etc/hosts` and add line `192.168.56.101 card-validation.dev`
3. Download and install [Vagrant](https://www.vagrantup.com/downloads.html)
4. Download and install [VirtualBox](https://www.virtualbox.org/wiki/Downloads)
5. Go to project directory and run `vagrant up` to run virtual machine. This process will take a while depend on your internet speed.

**Using local environment**

1. Clone the project
2. Use php version `>=5.6.21`
3. Install required library
    1. [Bower](http://bower.io/)
    2. [php-mycrypt](http://php.net/manual/en/book.mcrypt.php)
    3. [php-dom](http://php.net/manual/en/book.dom.php)
    4. [php-curl](http://php.net/manual/en/book.curl.php)
    5. [mysql](http://dev.mysql.com/downloads/mysql/)


First time setup
----------------

Run `vagrant ssh` to ssh into virtual machine and then do `cd /var/www` to change directory into project root directory.
You will need to do command below inside the virtual machine

1. Run `bower install` to install frontend library
2. Run `composer install` to install backend library, if prompt for configuration, just follow the default parameter (only need press enter).
3. Run `bin/console doctrine:schema:create` to create database

URL
---

1. `GET http://card-validation.dev` will show us credit card form in html.
2. `POST http://card-validation.dev` to create credit card in json format
3. `GET http://card-validation.dev/{id}` to get credit card by id
