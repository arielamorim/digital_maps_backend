<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class LocationController extends Controller
{
    public function __construct( private Location $location ){}

    /**
     * Show all locations.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try{
            $locations = $this->location->all();

            $status = $locations->count() > 0 ? 200 : 204;

            return response()->json( $locations , $status);
        } catch ( Exception $e ) {
            return response()->json(['erro'=>'Erro interno ->' . $e], 500);
        }
    }

    /**
     * Store a new location.
     *
     * @bodyParam {
     *      'name': 'Bar do Zeca',
     *      'X': 25,
     *      'Y': 50,
     *      'opensAt': 17:00,
     *      'closesAt': 00:00
     *  }
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ( $validator->fails() ) {
            return response()->json( $validator->errors(), 422 );
        }

        $location = $this->location->create( $request->all() );

        return response()->json( $location, 201 );
    }

    /**
     * Show location by id.
     *
     * @queryParam id location's id
     * @response {
     *     'id': 1,
     *     'name': 'Bar do Zeca',
     *     'X': 25,
     *     'Y': 50,
     *     'opensAt': 17:00,
     *     'closesAt': 00:00
     * }
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try{
            $location = $this->location->find( $id );

            return response()->json( $location, 200);
        } catch ( Exception $e ) {
            return response()->json(['erro'=>'Erro interno ->' . $e], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
