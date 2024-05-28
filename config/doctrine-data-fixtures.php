<?php

declare(strict_types=1);

use Database\DataFixtures\Faker\Faker;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;

/**
 * In the default values listed below, ORM fixtures are configured.  You may
 * configure other Doctrine fixture group types:
 *
 * ORMExecutor | PHPCRExecutor | MongoDBExecutor
 * ORMPurger   | PHPCRPurger   | MongoDBPurger
 */

// The order of fixtures in the fixtures array is not the order in which
// they will be executed.  See
// https://github.com/doctrine/data-fixtures#fixture-ordering
return [
    'default' => [  // Group name
        'objectManager' => EntityManager::class,
        'executor' => ORMExecutor::class,
        'purger' => ORMPurger::class,
        'fixtures' => [],
    ],
    'faker' => [  // Group name
        'objectManager' => EntityManager::class,
        'executor' => ORMExecutor::class,
        'purger' => ORMPurger::class,
        'fixtures' => [Faker::class],
    ],
];
