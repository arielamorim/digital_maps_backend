<?php

namespace Tests\Feature;

use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class LocationTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_locations() {

        Location::factory(3)->create();

        $response = $this->getJson('api/locations' );

        $response->assertStatus(200);
        $response->assertJsonCount(3);

        $response->assertJson( function ( AssertableJson $json){
            $json->hasAll(['0.id', '0.name']);
        });
    }

}
