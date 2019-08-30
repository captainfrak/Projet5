<?php


namespace System;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class Database
{
    public function __construct()
    {
        $conn = array(
            'driver' => 'pdo_mysql',
            'user' => 'root',
            'password' => 'root',
            'dbname' => 'db_blog',
            "host" => '127.0.0.1',
            'port' => '8889'
        );
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "./Entity"), $isDevMode);
        $entityManager = EntityManager::create($conn, $config);

    }
}