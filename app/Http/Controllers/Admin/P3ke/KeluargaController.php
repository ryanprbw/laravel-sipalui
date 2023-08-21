<?php

namespace App\Http\Controllers\Admin\P3ke;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Imports\KeluargaImport;
use App\Models\DatabaseP3KE\P3keKeluarga;
use App\Services\ReferenceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class KeluargaController extends Controller
{
    public function __construct(
        private ReferenceService $referenceService
    )
    {
    }

    public function index(Request $request)
    {
        $params = [
            'city_code' => $request->get('city')
        ];
        $cities = $this->referenceService->getCity()->get();
        $keluarga = P3keKeluarga::where(DB::raw('SUBSTR(kode_kemdagri,4,1)'), $params['city_code'])
            ->latest('id_keluarga_P3KE')->paginate(25);
        return view('admin.pages.p3ke.import-keluarga-page', compact('cities', 'keluarga', 'params'));
    }

    public function store(Request $request)
    {
        ini_set('max_execution_time', 6000);
        ini_set('memory_limit', '4096M');
        try {
            $file = $request->file('file');
            $extension = $request->file('file')->getClientOriginalExtension();
            if ($extension != 'csv') throw new \Exception('Format File tidak sesuai.');
            Excel::import(new KeluargaImport, $file);
            $response = ResponseHelper::success();
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public final function loadDataAllCity(Request $request)
    {
        try {
            $city_code = $request->get('city_code');
            $keluarga = P3keKeluarga::where(DB::raw('SUBSTR(kode_kemdagri,4,1)'), $city_code)->get();
            $response = ResponseHelper::success(data: $keluarga->toArray());
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

}
