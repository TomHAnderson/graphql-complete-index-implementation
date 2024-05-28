<?php

declare(strict_types=1);

namespace App\GraphQL\Query;

use ApiSkeletons\Doctrine\ORM\GraphQL\Driver;
use App\GraphQL\Field;
use App\GraphQL\Type\GraphQLCompleteIndexResult;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;

class GraphQLCompleteIndex implements Field
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
            'type' => Type::listOf($driver->type(GraphQLCompleteIndexResult::class)),
            'resolve' => static function ($source, array $args, $context, ResolveInfo $info) use ($driver) {
                return [
                    [
                        'query' => '
query ArtistsPerformancesSources ($cursor:String!) {
  artists (pagination: {first:10, after:$cursor}) {
    edges {
      node {
        name
        performances {
          totalCount
          edges {
            node {
              date
              venue
              recordings {
                edges {
                  node {
                    source
                    id
                    users {
                      edges {
                        node {
                          name
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    pageInfo {
      endCursor
    }
  }
}',
                        'description' => 'Artists performances and recordings',
                        'hasCursor' => true,
                        'cursorDataType' => null,
                        'initialValue' => 'MA==',
                        'increment' => null,
                        'nextCursorField' => 'endCursor' ,
                    ],
                ];
            },
            'description' => <<<'EOF'
Fetch GraphQLCompleteIndex results.
EOF,
        ];
    }
}
