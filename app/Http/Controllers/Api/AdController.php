<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use App\Http\Requests\AdRequest;
use App\Helpers\ApiResponse;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ads = Ad::latest()->paginate(1);
        if (count($ads) > 0) {

            if ($ads->total() > $ads->perPage()) {
                $data = [
                    'records' => AdResource::collection($ads),
                    'pagination links' => [
                        "total" => $ads->total(),
                        'current page' => $ads->currentPage(),
                        'per page' => $ads->perPage(),
                        'links' => [
                            'first page' => $ads->url(1),
                            'next page' => $ads->url($ads->currentPage() + 1),
                            'last page' => $ads->url($ads->lastPage())
                        ],
                    ],
                ];
                return ApiResponse::sendResponse(200, $data, 'this is all ads');
            } else {
                return ApiResponse::sendResponse(200, $ads, 'this is all ads');
            }
        }
        return response()->json([
            'status' => 204,
            'data' => [],
            'msg'   => 'this is no ads'
        ]);
    }


    public function getlatets()
    {
        $ads = Ad::latest()->take(2)->get();

        if (count($ads) > 0) {
            return ApiResponse::sendResponse(200, AdResource::collection($ads), 'this is all ads');
        }
        return response()->json([
            'status' => 204,
            'data' => [],
            'msg'   => 'this is no ads'
        ]);
    }



    public function domain($domain_id)
    {
        $ads = Ad::with('domain')->where('domain_id', $domain_id)->latest()->get();



        if (count($ads) > 0) {
            return ApiResponse::sendResponse(200, 'Ads in the domain retrieved successfully', AdResource::collection($ads));
        }
        return ApiResponse::sendResponse(200, 'empty', []);
    }

    public function store(AdRequest $request)
    {
        try {

            $data = $request->validated();
            $data['user_id'] = $request->user()->id;

            $dataCreated = Ad::create($data);

            return $dataCreated;
        } catch (\Exception $e) {
            //throw $th;
            return $e->getMessage();
        }
    }


    public function delete(Request $request)
    {
        $ads_id = Ad::findorfail($request->id);
        $ads_id->delete();

        return response()->json([
            'msg' => 'ads deleted successfully'
        ]);
    }

    public function myads(Request $request)
    {
        $ads = Ad::where('user_id', $request->user()->id)->latest()->get();
        if (count($ads) > 0) {
            return ApiResponse::sendResponse(200, 'My ads retrieved successfully', AdResource::collection($ads));
        }
        return ApiResponse::sendResponse(200, 'You don\'t have any ads', []);
    }
}
