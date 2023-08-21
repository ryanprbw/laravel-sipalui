<?php

namespace App\Exports;

use App\Services\AnalyticService;
use App\Services\AssistanceService;
use App\Services\ReferenceService;
use App\Services\UtilityService;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CityAssistanceDesilExport implements FromView
{

    public function __construct(
        private AssistanceService $assistanceService,
        private ReferenceService  $referenceService,
        private UtilityService    $utilityService,
        private AnalyticService   $analyticService
    )
    {
    }


    public final function view(): View
    {
        $data['desil'] = $this->utilityService->getDesil()->get();
        $data['cities'] = $this->referenceService->getCity()->get();
        $data['priorities'] = $this->assistanceService->getPriority()->get();
        $data['analyticCities'] = $this->analyticService->getCityAssistanceDesil(startYear());
        return view('landing.pages.export.assistance.city-assistance-desil', $data);
    }

}
