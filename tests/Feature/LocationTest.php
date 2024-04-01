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
            $json->hasAll(['0.id', '0.name', '0.X', '0.Y', '0.opensAt', '0.closesAt']);
        });
    }
    public function test_get_all_locations_but_database_is_empty() {

        $response = $this->getJson('api/locations' );

        $response->assertStatus(204);

    }

    public function test_get_location_by_id() {
        $location = Location::factory(1)->create();

        $response = $this->getJson('/api/locations/' . $location->first()->id );

        $response->assertStatus(200);

        $response->assertJson( function ( AssertableJson $json) use ($location){
            $json->hasAll(['id','name','X','Y','opensAt','closesAt','created_at','updated_at']);

            $json->where('id', $location->first()->id );
        });

    }
}
