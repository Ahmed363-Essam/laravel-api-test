<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Resources\CityResource;
use App\Helpers\ApiResponse;

class CityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
        $City = City::get();

        if ($City) {
            return  ApiResponse::sendResponse(200,  CityResource::collection($City), 'exists');
        }
        return  ApiResponse::sendResponse(204, [], 'there is no data');
    }
}
