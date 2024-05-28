<?php

declare(strict_types=1);

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class GraphQLCompleteIndexResult extends ObjectType
{
    /** @inheritDoc */
    public function __construct()
    {
        parent::__construct([
            'name' => 'GraphQLCompleteIndexResult',
            'description' => 'Graphql Complete Index Result',
            'fields' => static function () {
                return [
                    'query' => Type::string(),
                    'description' => Type::string(),
                    'hasCursor' => Type::boolean(),
                    'cursorDataType' => Type::string(),
                    'initialValue' => Type::string(),
                    'increment' => Type::int(),
                    'nextCursorField' => Type::string(),
                ];
            },
        ]);
    }
}
