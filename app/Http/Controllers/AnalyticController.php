<?php

namespace App\Http\Controllers;

use App\Exports\AnalyticAssistanceDesilExport;
use App\Exports\AnalyticFacilityPopulationExport;
use App\Models\Assistance\AssistancePriority;
use App\Models\DatabaseP3KE\DataFamily;
use App\Models\Reference\RefDistrict;
use App\Models\Utility\UtiDesil;
use App\Services\AnalyticService;
use App\Services\AssistanceService;
use App\Services\NominationService;
use App\Services\ReferenceService;
use App\Services\StrategyService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use function PHPUnit\Framework\isEmpty;

class AnalyticController extends Controller
{
    public function __construct(
        private ReferenceService  $referenceService,
        private AssistanceService $assistanceService,
        private UtilityService    $utilityService,
        private AnalyticService   $analyticService,
        private NominationService $nominationService,
    )
    {
    }

    public final function index(Request $request)
    {
        $params = [
            'cityCode' => $request->get('city'),
            'year' => $this->yearDefault() ?? $request->get('year')
        ];
        $data['cities'] = $this->referenceService->getCity()->get();
        if ($cityCode = $params['cityCode']) {
            $data['city'] = $this->referenceService->getCity(['city_code' => $cityCode])->first();
            $data['strategies'] = $this->utilityService->getCategoryStrategy()->get();
        }
        return view('landing.pages.analytic-page', array_merge($data, compact('params')));
    }

    public final function loadDataAnalyticAssistance(Request $request)
    {
        try {
            $params = [
                'cityCode' => $request->get('city'),
                'year' => $request->get('year')
            ];
            $data['priorities'] = $this->assistanceService->getPriority()->get();
            $data['desils'] = $this->utilityService->getDesil()->get();
            return view('landing.pages.load-data.analytic.analytic-assistance', array_merge($data, compact('params')));
        } catch (\Exception $exception) {
            return abort(404);
        }
    }


    public final function loadAnalyticAssistanceDesil(Request $request)
    {
        $params = [
            'cityCode' => $request->get('city'),
            'year' => $request->get('year'),
            'desilIDs' => $request->get('desil'),
            'assistanceIDs' => $request->get('assistance')
        ];
        $data['priorities'] = $this->assistanceService->getPriorityWhereIn('assistance_priority_id', $params['assistanceIDs'])->get();
        $data['desils'] = $this->utilityService->getDesilWhereIn('desil_id', $params['desilIDs'])->get();

        $data['analytics'] = $this->analyticService->getDistrictAssistanceDesil($params['cityCode'], $params['year'], $params['assistanceIDs'], $params['desilIDs']);
        return view('landing.pages.load-data.analytic.analytic-assistance-desil', array_merge($data, compact('params')));
    }

    public final function exportAnalyticAssistanceDesil(Request $request)
    {
        return Excel::download(new AnalyticAssistanceDesilExport($this->assistanceService, $this->utilityService, $this->analyticService, $request), 'analytic-assistance-desil.xlsx');
    }

    public final function loadDataAnalyticFacility(Request $request)
    {
        try {
            $params = [
                'cityCode' => $request->get('city'),
                'year' => $request->get('year')
            ];
            $data['desils'] = $this->utilityService->getDesil()->get();
            $data['houses'] = $this->utilityService->getFamilyHouse()->get();
            $data['defecations'] = $this->utilityService->getFacilityDefecation()->get();
            $data['cookings'] = $this->utilityService->getFacilityCooking()->get();
            $data['defecations'] = $this->utilityService->getFacilityDefecation()->get();
            $data['drinkings'] = $this->utilityService->getFacilityDrinking()->get();
            $data['floors'] = $this->utilityService->getFacilityFloor()->get();
            $data['lightings'] = $this->utilityService->getFacilityLighting()->get();
            $data['roofs'] = $this->utilityService->getFacilityRoof()->get();
            $data['walls'] = $this->utilityService->getFacilityWall()->get();
            $data['educations'] = $this->utilityService->getEducation()->get();
            return view('landing.pages.load-data.analytic.analytic-facility', array_merge($data, compact('params')));
        } catch (\Exception $exception) {
            return abort(404);
        }
    }

    public final function loadDataAnalyticFacilityPopulation(Request $request)
    {
        $data['request'] = $request->all();
        $data['priorities'] = $this->assistanceService->getPriority()->get();
        $data['populations'] = $this->analyticService->getFacilityPopulation($request);
        return view('landing.pages.load-data.analytic.analytic-facility-population', $data);
    }

    public final function loadDataAnalyticStrategyPopulation(Request $request)
    {
        $data['request'] = $request->all();
        $data['nominations'] = $this->nominationService->getNominations(['category_strategy_id' => $request->get('strategy_id')])->get();
        $data['priorities'] = $this->assistanceService->getPriority()->get();
        $data['populations'] = $this->analyticService->getStrategyPopulation($request);
        return view('landing.pages.load-data.analytic.analytic-strategy-population', $data);
    }

    public final function loadDataAnalyticStrategy(Request $request)
    {
        try {
            $params = [
                'cityCode' => $request->get('city'),
                'year' => $request->get('year'),
                'strategyID' => $request->get('strategy_id')
            ];
            $data['strategy'] = $this->utilityService->getCategoryStrategy(['category_strategy_id' => $params['strategyID']])->first();
            $data['houses'] = $this->utilityService->getFamilyHouse()->get();
            $data['defecations'] = $this->utilityService->getFacilityDefecation()->get();
            $data['cookings'] = $this->utilityService->getFacilityCooking()->get();
            $data['defecations'] = $this->utilityService->getFacilityDefecation()->get();
            $data['drinkings'] = $this->utilityService->getFacilityDrinking()->get();
            $data['floors'] = $this->utilityService->getFacilityFloor()->get();
            $data['lightings'] = $this->utilityService->getFacilityLighting()->get();
            $data['roofs'] = $this->utilityService->getFacilityRoof()->get();
            $data['walls'] = $this->utilityService->getFacilityWall()->get();
            $data['educations'] = $this->utilityService->getEducation()->get();
            $data['jobs'] = $this->utilityService->getJob()->get();
            $data['marries'] = $this->utilityService->getStatusMerry()->get();
            return view('landing.pages.load-data.analytic.analytic-strategy', array_merge($data, compact('params')));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public final function exportAnalyticFacilityPopulation(Request $request)
    {
        return Excel::download(new AnalyticFacilityPopulationExport($this->assistanceService, $this->analyticService, $request), 'facility-population.xlsx');
    }

}
