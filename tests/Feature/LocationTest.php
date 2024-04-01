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

    public function test_get_location_by_id_but_is_empty(){

        $response = $this->getJson('/api/locations/' . 5 );

        $response->assertStatus(204);

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

    public function test_update_location_endpoint() {
        Location::factory(1)->createOne();

        $location = [
            'name'=>'Restaurante',
            'opensAt'=>'12:00'
        ];

        $response = $this->putJson('/api/locations/1', $location);

        $response->assertStatus(200);
        $response->assertJson( function ( AssertableJson $json) use ($location){
            $json->hasAll(['id','name','X','Y','opensAt','closesAt','created_at','updated_at']);

            $json->where('name', $location['name'] );
            $json->where('opensAt', $location['opensAt'] );
        });
    }

    public function test_update_but_cant_find_location()
    {
        $location = [
            'name'=>'Restaurante',
            'opensAt'=>'12:00'
        ];

        $response = $this->putJson('/api/locations/1', $location);

        $response->assertStatus(204);
    }

    public function test_delete_location()
    {
        Location::factory(1)->createOne();

        $response = $this->deleteJson('/api/locations/1');

        $response->assertStatus(200);
    }

    public function test_delete_but_cant_find_location()
    {
        $response = $this->deleteJson('/api/locations/1');

        $response->assertStatus(204);
    }

    public function test_get_locations_by_proximity()
    {
        Location::factory(4)->create();

        $response = $this->getJson('/api/proximity/locations?X=5&Y=10&hour=12:00');

        $response->assertStatus(200);
        $response->assertJsonCount(4);

    }

    public function test_get_locations_by_proximity_missing_params()
    {
        Location::factory(4)->create();

        $response = $this->getJson('/api/proximity/locations?X=5');

        $response->assertStatus(400);

    }
}
