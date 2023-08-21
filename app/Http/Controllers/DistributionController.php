<?php

namespace App\Http\Controllers;

use App\Exports\CityAssistanceDesilExport;
use App\Exports\DistributionDistrictExport;
use App\Exports\DistributionVillageExport;
use App\Models\DatabaseP3KE\DataFamily;
use App\Models\DatabaseP3KE\DataPopulation;
use App\Services\AssistanceService;
use App\Services\DistributionService;
use App\Services\ReferenceService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DistributionController extends Controller
{
    public function __construct(
        private ReferenceService    $referenceService,
        private DistributionService $distributionService,
        private UtilityService      $utilityService
    )
    {
    }

    public final function index(Request $request)
    {
        $data['cities'] = $this->referenceService->getCity()->get();
        return view('landing.pages.distribution-page', $data);
    }

    public function loadDistribution(Request $request)
    {
        try {
            $cityCode = $request->get('city_code');
            $districtCode = $request->get('district_code');
            $data['desil'] = $this->utilityService->getDesil()->get();
            $data['city'] = $this->referenceService->getCity(['city_code' => $cityCode])->first();
            if ($districtCode) {
                $data['district'] = $this->referenceService->getDistrict(['city_code' => $cityCode, 'district_code' => $districtCode])->first();
                $data['villages'] = $this->distributionService->getDistributionVillage($cityCode, $districtCode);
                $data['desilPopulations'] = $this->distributionService->getVillageDesilPopulation($cityCode, $districtCode);
                $data['desilFamilies'] = $this->distributionService->getVillageDesilFamily($cityCode, $districtCode);
                return view('landing.pages.load-data.distribution.distribution-village', $data);
            } else {
                $data['districts'] = $this->distributionService->getDistributionDistrict($cityCode);
                $data['desilPopulations'] = $this->distributionService->getDistrictDesilPopulation($cityCode);
                $data['desilFamilies'] = $this->distributionService->getDistrictDesilFamily($cityCode);
                return view('landing.pages.load-data.distribution.distribution-district', $data);
            }
        } catch (\Exception $exception) {
            return abort('404');
        }
    }

    function exportDistributionDistrict(Request $request)
    {
        $export = new DistributionDistrictExport(
            $this->utilityService,
            $this->distributionService,
            cityCode: $request->get('city'),
        );
        return Excel::download($export, 'distribution-district.xlsx');
    }

    function exportDistributionVillage(Request $request)
    {
        $export = new DistributionVillageExport(
            $this->utilityService,
            $this->distributionService,
            cityCode: $request->get('city'),
            districtCode: $request->get('district'),
        );
        return Excel::download($export, 'distribution-village.xlsx');
    }

}
