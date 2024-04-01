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

    public function test_get_location_by_id_empty(){

    }
    public function test_create_location_endpoint() {

        $location = Location::factory(1)->makeOne()->toArray();
        $response = $this->postJson('/api/locations', $location);

        $response->assertStatus(201);

        $response->assertJson( function ( AssertableJson $json) use ($location){
            $json->hasAll(['id','name','X','Y','opensAt','closesAt','created_at','updated_at']);

            $json->where('name', $location['name'] );
            $json->where('X', $location['X'] );
            $json->where('Y', $location['Y'] );
            $json->where('closesAt', $location['closesAt'] );
            $json->where('opensAt', $location['opensAt'] );
        });
    }
}
