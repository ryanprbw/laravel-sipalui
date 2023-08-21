<?php

namespace App\Exports;

use App\Services\DistributionService;
use App\Services\UtilityService;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DistributionVillageExport implements FromView
{
    public function __construct(
        private UtilityService      $utilityService,
        private DistributionService $distributionService,
        private int                 $cityCode,
        private int                 $districtCode,
    )
    {
    }

    public function view(): View
    {
        $data['desil'] = $this->utilityService->getDesil()->get();
        $data['villages'] = $this->distributionService->getDistributionVillage($this->cityCode, $this->districtCode);
        $data['desilPopulations'] = $this->distributionService->getVillageDesilPopulation($this->cityCode, $this->districtCode);
        $data['desilFamilies'] = $this->distributionService->getVillageDesilFamily($this->cityCode, $this->districtCode);
        return view('landing.pages.export.distribution.distribution-village', $data);
    }
}
