<?php

namespace App\Http\Controllers\Admin\Reference;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Reference\RefVillage;

class RefVillageController extends Controller
{

    public final function loadVillages(int $city_code, int $district_code): \Illuminate\Http\JsonResponse
    {
        try {
            $data = RefVillage::where(['city_code' => $city_code, 'district_code' => $district_code])->get();
            $response = ResponseHelper::success(data: $data->toArray());
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }
}
