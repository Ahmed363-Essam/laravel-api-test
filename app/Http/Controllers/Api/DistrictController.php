<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\District;
use App\Http\Resources\DistrictResource;
use App\Helpers\ApiResponse;

class DistrictController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {

        $CityDistrict = District::with(['city'])->where('city_id', $id)->get();



        if ($CityDistrict) {
            return  ApiResponse::sendResponse(200, DistrictResource::collection($CityDistrict), 'exists');
        }
        return  ApiResponse::sendResponse(204, [], 'there is no data');
    }
}
