<?php 

require_once '/var/www/html/pedagogie/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('DB_USER', $_ENV['DB_USER']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('WEBROOT', $_ENV['WEBROOT']);
define('DSN', $_ENV['DSN']);
// define('ROOT', $_ENV['ROOT']);