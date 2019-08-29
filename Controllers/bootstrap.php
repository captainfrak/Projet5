<?php


// bootstrap.php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

require_once "../vendor/autoload.php";

$isDevMode = true;
// Create a simple "default" Doctrine ORM configuration for Annotations
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "./Entity"), $isDevMode);
// database configuration parameters
$conn = array(
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => 'root',
    'dbname' => 'db_blog',
    'host' => '127.0.0.1',
    'port' => '8889'
);
// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);

