<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Helpers\ApiResponse;
use App\Http\Resources\DomainResource;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            $Domain = Domain::get();
            if (count($Domain) > 0) {
                return  ApiResponse::sendResponse(200,  DomainResource::collection($Domain), 'exists');
            }

        } catch (\Exception $e) {
            //throw $th;
            return  ApiResponse::sendResponse(204, [123], $e->getMessage());
        }
    }
}
