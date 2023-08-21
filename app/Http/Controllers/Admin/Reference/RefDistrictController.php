<?php

namespace App\Http\Controllers\Admin\Reference;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Reference\RefDistrict;

class RefDistrictController extends Controller
{

    public final function loadDistricts(int $city_code): \Illuminate\Http\JsonResponse
    {
        try {
            $data = RefDistrict::where('city_code', $city_code)->get();
            $response = ResponseHelper::success(data: $data->toArray());
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }
}
