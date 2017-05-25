<?php
use Illuminate\Database\Capsule\Manager as Capsule;

require 'vendor/autoload.php';
require 'router.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->required(['DBHOST', 'DBNAME', 'DBUSER', 'DB_PASS']);
$dotenv->load();

$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => getenv('DBHOST'),
    'database'  => getenv('DBNAME'),
    'username'  => getenv('DBUSER'),
    'password'  => getenv('DBPASS'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods...
$capsule->setAsGlobal();

// Setup the Eloquent ORM...
$capsule->bootEloquent();

