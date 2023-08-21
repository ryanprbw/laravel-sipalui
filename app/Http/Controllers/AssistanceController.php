<?php

namespace App\Http\Controllers;

use App\Exports\AnalyticAssistanceDesilExport;
use App\Exports\CityAssistanceDesilExport;
use App\Models\DatabaseP3KE\DataFamily;
use App\Services\AnalyticService;
use App\Services\AssistanceService;
use App\Services\ReferenceService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class AssistanceController extends Controller
{
    public function __construct(
        private AssistanceService $assistanceService,
        private ReferenceService  $referenceService,
        private UtilityService    $utilityService,
        private AnalyticService   $analyticService
    )
    {
    }

    public final function index(Request $request): View
    {
        $year = $this->yearDefault();
        $data['desil'] = $this->utilityService->getDesil()->get();
        $data['cities'] = $this->referenceService->getCity()->get();
        $data['priorities'] = $this->assistanceService->getPriority()->get();
        return view('landing.pages.assistance-page', $data);
    }

    public final function loadCityAssistanceDesil(Request $request): View
    {
        $data['desil'] = $this->utilityService->getDesil()->get();
        $data['cities'] = $this->referenceService->getCity()->get();
        $data['priorities'] = $this->assistanceService->getPriority()->get();
        $data['analyticCities'] = $this->analyticService->getCityAssistanceDesil($this->yearDefault());
        return view('landing.pages.load-data.assistance.city-assistance-desil', $data);
    }

    public final function loadAssistanceFamily(Request $request): View
    {
        $params = [
            'cityCode' => $request->get('city_code'),
            'districtCode' => $request->get('district_code'),
            'villageCode' => $request->get('village_code'),
            'desilID' => $request->get('desil_id'),
        ];
        $data['priorities'] = $this->assistanceService->getPriority()->get();
        $build = DataFamily::with('receiver_priority', 'population')
            ->where(['family_year' => $this->yearDefault(),
                'city_code' => $params['cityCode'],
                'district_code' => $params['districtCode'],
                'village_code' => $params['villageCode']
            ]);
        if ($params['desilID']) {
            $build->where('desil_id', $params['desilID']);
        }
        $data['families'] = $build->get();
        return view('landing.pages.load-data.assistance.assistance-family', $data);
    }


    public final function exportCityAssistanceDesil(Request $request)
    {
        $cityExport = new CityAssistanceDesilExport($this->assistanceService, $this->referenceService, $this->utilityService, $this->analyticService);
        return Excel::download($cityExport, 'city-assistance-desil.xlsx');
    }

}
