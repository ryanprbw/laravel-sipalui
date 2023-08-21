<?php

namespace App\Exports;

use App\Services\AnalyticService;
use App\Services\AssistanceService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AnalyticFacilityPopulationExport implements FromView
{

    public function __construct(
        private AssistanceService $assistanceService,
        private AnalyticService   $analyticService,
        private Request           $request
    )
    {
    }

    public final function view(): View
    {
        $data['priorities'] = $this->assistanceService->getPriority()->get();
        $data['populations'] = $this->analyticService->getFacilityPopulation($this->request);
        return view('landing.pages.export.analytic.analytic-facility-population', $data);
    }
}
