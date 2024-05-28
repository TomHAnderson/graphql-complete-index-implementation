<?php

declare(strict_types=1);

namespace Tests;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void
    {
        $this->createApplication();

        parent::setUp();

        // Create the database schema
        $entityManager = $this->app->get(EntityManager::class);

        (new SchemaTool($entityManager))
            ->createSchema($entityManager->getMetadataFactory()->getAllMetadata());
    }
}
