<?php
require 'vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
$dotenv->required(['DBHOST', 'DBNAME', 'DBUSER', 'DBPASS']);
$database = include 'config/database.php';
$database->setAsGlobal();
$database->bootEloquent();

include 'config/route.php';

