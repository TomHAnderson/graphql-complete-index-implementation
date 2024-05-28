<?php

declare(strict_types=1);

namespace App\GraphQL\Query\Artist;

use ApiSkeletons\Doctrine\ORM\GraphQL\Driver;
use App\Doctrine\ORM\Entity\Artist;
use App\GraphQL\Field;
use Doctrine\ORM\EntityManager;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class Entity implements Field
{
    /**
     * @param  mixed[] $variables
     *
     * @return mixed[]
     */
    public static function getDefinition(
        Driver $driver,
        array $variables = [],
        string|null $operationName = null,
    ): array {
        return [
            'type' => $driver->type(Artist::class),
            'args' => [
                'id' => Type::nonNull(Type::int()),
            ],
            'resolve' => static function ($source, array $args, $context, ResolveInfo $info) use ($driver) {
                return $driver->get(EntityManager::class)
                    ->getRepository(Artist::class)
                    ->find($args['id']);
            },
            'description' => <<<'EOF'
Fetch a single artist.
EOF,
        ];
    }
}
