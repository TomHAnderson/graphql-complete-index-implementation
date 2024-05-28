<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

use function count;

class ArtistTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testArtistsConnection(): void
    {
        // Create a new artist
        $response = $this->postJson('/', [
            'query' => 'mutation {
              artistCreate (values: {
                name: "Test Artist"
              }) {
                id
                name
              }
            }',
            'variables' => [],
            'operationName' => null,
        ], ['Content-Type' => 'application/json']);

        $response->assertStatus(200);

        $data = $response->json();

        $this->assertFalse(isset($data['errors']));
        $this->assertGreaterThanOrEqual(1, $data['data']['artistCreate']['id']);

        $response = $this->postJson('/', [
            'query' => '{
              artists {
                edges {
                  node {
                    id
                    name
                  }
                }
              }
            }',
            'variables' => [],
            'operationName' => null,
        ], ['Content-Type' => 'application/json']);

        $response->assertStatus(200);

        $data = $response->json();

        $this->assertFalse(isset($data['errors']));
        $this->assertGreaterThanOrEqual(1, count($data['data']['artists']['edges']));

        $response = $this->postJson('/', [
            'query' => '{
              artist (id: 1) {
                id
                name
              }
            }',
            'variables' => [],
            'operationName' => null,
        ], ['Content-Type' => 'application/json']);

        $response->assertStatus(200);

        $data = $response->json();

        $this->assertFalse(isset($data['errors']));
        $this->assertGreaterThanOrEqual(1, $data['data']['artist']['id']);
    }
}
