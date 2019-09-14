<?php


namespace System;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;

class Database
{
    private static $entityManager = null;
    private const DB_URL = 'mysql://root:root@127.0.0.1:8889/db_blog';

    public static function getEntityManager(): ?EntityManager
    {
        if (self::$entityManager === null) {

            $path = [__DIR__ . "/" . "../Entity"];
            $isDevMode = true;

            $db_url = self::DB_URL;

            $db_params = ['driver' => 'pdo_mysql', 'url' => $db_url];

            $config = Setup::createAnnotationMetadataConfiguration($path, $isDevMode);

            try {
                self::$entityManager = EntityManager::create($db_params, $config);
            } catch (ORMException $exception) {
                return null;
            }
        }
        return self::$entityManager;
    }
}