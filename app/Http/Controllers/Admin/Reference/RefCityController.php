<?php

namespace App\Http\Controllers\Admin\Reference;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Reference\RefCity;

class RefCityController extends Controller
{

    public final function loadCities(): \Illuminate\Http\JsonResponse
    {
        try {
            $cities = RefCity::all();
            $response = ResponseHelper::success(data: $cities->toArray());
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

}
