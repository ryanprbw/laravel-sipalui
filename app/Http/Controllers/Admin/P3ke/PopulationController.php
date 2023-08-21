<?php

namespace App\Http\Controllers\Admin\P3ke;

use App\Http\Controllers\Controller;
use App\Models\DatabaseP3KE\DataPopulation;
use App\Models\Reference\RefCity;
use App\Models\Reference\RefDistrict;
use App\Models\Reference\RefVillage;
use App\Services\P3keService;
use App\Services\ReferenceService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PopulationController extends Controller
{


    public function __construct(
        private ReferenceService $referenceService,
        private P3keService      $p3keService
    )
    {
    }

    public function index(Request $request)
    {
        $params = [
            'city' => $request->get('city'),
            'district' => $request->get('district'),
            'village' => $request->get('village'),
        ];

        $cities = $this->referenceService->getCity()->get();
        $districts = $this->referenceService->getDistrict(['city_code' => $params['city']])->get();
        $villages = $this->referenceService->getVillage(['city_code' => $params['city'], 'district_code' => $params['district']])->get();
        return view('admin.pages.p3ke.population-page', compact('cities', 'districts', 'villages', 'params'));
    }

    public final function dataTable(Request $request)
    {
        $query = $this->p3keService->getPopulation($request);
        return DataTables::eloquent($query)
            ->editColumn('city', fn($population) => $population->city->city_name)
            ->editColumn('district', fn($population) => $population->district->district_name)
            ->editColumn('village', fn($population) => $population->village->village_name)
            ->toJson();
    }

    public final function loadPopulationCity()
    {

    }

}

