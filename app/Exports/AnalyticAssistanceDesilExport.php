<?php

namespace App\Exports;

use App\Services\AnalyticService;
use App\Services\AssistanceService;
use App\Services\UtilityService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;

class AnalyticAssistanceDesilExport implements FromView
{

    public function __construct(
        private AssistanceService $assistanceService,
        private UtilityService    $utilityService,
        private AnalyticService   $analyticService,
        private Request           $request,
    )
    {
    }


    public function view(): View
    {
        $params = [
            'cityCode' => $this->request->get('city'),
            'year' => $this->request->get('year'),
            'desilIDs' => $this->request->get('desil'),
            'assistanceIDs' => $this->request->get('assistance')
        ];
        $data['priorities'] = $this->assistanceService->getPriorityWhereIn('assistance_priority_id', $params['assistanceIDs'])->get();
        $data['desils'] = $this->utilityService->getDesilWhereIn('desil_id', $params['desilIDs'])->get();
        $data['analytics'] = $this->analyticService->getDistrictAssistanceDesil($params['cityCode'], $params['year'], $params['assistanceIDs'], $params['desilIDs']);
        return view('landing.pages.export.analytic.analytic-assistance-desil', array_merge($data, compact('params')));
    }
}
