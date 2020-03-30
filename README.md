EgoiZend
=======================

Database
----------------

	CREATE TABLE `category` (
		`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
		`name` VARCHAR(255) NULL DEFAULT NULL,
		PRIMARY KEY (`id`)
	)
	ENGINE=InnoDB;

Web server setup
----------------

### PHP CLI server

The simplest way to get started if you are using PHP 5.4 or above is to start the internal PHP cli-server in the root
directory:

    php -S 0.0.0.0:8080 -t public/ public/index.php

This will start the cli-server on port 8080, and bind it to all network
interfaces.