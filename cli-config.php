<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once "Controllers/bootstrap.php";

return ConsoleRunner::createHelperSet($entityManager);