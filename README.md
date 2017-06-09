# Phalcon Single Module

This is a starting application for the [Phalcon Framework](http://jafari.pw/135/%da%86%d8%b1%d8%a7-%d9%81%d8%a7%d9%84%da%a9%d9%88%d9%86-%db%8c%da%a9%db%8c-%d8%a7%d8%b2-%d9%85%d8%ad%d8%a8%d9%88%d8%a8-%d8%aa%d8%b1%db%8c%d9%86-%d9%81%d8%b1%db%8c%d9%85-%d9%88%d8%b1%da%a9-%d9%87%d8%a7/).
I tried to implement the basic features to showcase the framework and its potential.

Please email me if you have any feedback.

Thanks.

## NOTE

The master branch will always contain the latest stable version.

## Get Started

### Requirements

To run this application on your machine, you need at least:

* >= PHP 5.5
* >= Phalcon 3.0
* Apache Web Server with `mod_rewrite enabled`, and `AllowOverride Options` (or `All`) in your `httpd.conf` or Nginx Web Server
* Latest [Phalcon Framework](https://phalconphp.com/en/) extension installed/enabled
* MySQL >= 5.1.5

Then you'll need to create the database and initialize schema ():

```bash
echo 'CREATE DATABASE application' | mysql -u [mysql_username] -p [mysql_password]
cat schemas/db.sql | mysql -u [mysql_username] -p [mysql_password] application
```

### Installing Dependencies via Composer

Dependencies must be installed using Composer. Install composer in a common location or in your project:

```bash
curl -s http://getcomposer.org/installer | php
```

Run the composer installer:

```bash
cd phalcon-single
php composer.phar install
```

## Improving this Sample

Phalcon is an open source project and a volunteer effort.
If you want something to be improved or you want a new feature please submit a Pull Request.

## License

phalcon-single is open-sourced software licensed under the New BSD License.
