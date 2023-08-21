<?php

namespace App\Exports;

use App\Services\DistributionService;
use App\Services\ReferenceService;
use App\Services\UtilityService;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DistributionDistrictExport implements FromView
{

    public function __construct(
        private UtilityService      $utilityService,
        private DistributionService $distributionService,
        private int                 $cityCode,
    )
    {
    }

    public function view(): View
    {
        $data['desil'] = $this->utilityService->getDesil()->get();
        $data['districts'] = $this->distributionService->getDistributionDistrict($this->cityCode);
        $data['desilPopulations'] = $this->distributionService->getDistrictDesilPopulation($this->cityCode);
        $data['desilFamilies'] = $this->distributionService->getDistrictDesilFamily($this->cityCode);
        return view('landing.pages.export.distribution.distribution-district', $data);
    }
}
