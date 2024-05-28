<?php

declare(strict_types=1);

namespace App\GraphQL;

use ApiSkeletons\Doctrine\ORM\GraphQL\Driver;

interface Field
{
    /**
     * @param  mixed[] $variables
     *
     * @return mixed[]
     */
    public static function getDefinition(Driver $driver, array $variables = [], string|null $operationName = null): array;
}
