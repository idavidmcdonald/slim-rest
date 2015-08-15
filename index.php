<?php
require_once 'config.php';
require_once 'vendor/autoload.php';

// Configure ORM connection
ORM::configure(array(
    'connection_string' => 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
    'username' => DB_USER,
    'password' => DB_PASSWORD
));

// Create app and run
$app = new \Slim\Slim();

require 'app/app.php';

$app->run();
