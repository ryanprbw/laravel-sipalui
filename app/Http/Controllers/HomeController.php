<?php

namespace App\Http\Controllers;

use App\Enums\CacheEnum;
use App\Services\DistributionService;
use App\Services\P3keService;
use App\Services\UtilityService;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class HomeController extends Controller
{

    private array|\Illuminate\Database\Eloquent\Collection $cities;
    private $desil;

    public function __construct(
        private UtilityService      $utilityService,
        private DistributionService $distributionService,
        private P3keService         $p3keService,
    )
    {
        $this->cities = Cache::remember(CacheEnum::CityHome->value, 60 * 60, function () {
            return $this->distributionService->getDistributionCities();
        });
//        $this->cities = $this->distributionService->getDistributionCities();
        $this->desil = $this->utilityService->getDesil()->get();
    }

    public final function index(): View
    {
        $cities = $this->cities;
        $nameCities = $cities->map(fn($val) => $val['city_name']);
        $columnChartFamily = $this->columnChartDistribution();
        $columnChartPopulations = $this->columnChartDistribution('populations');
        return view('landing.pages.home-page', compact('nameCities', 'columnChartFamily', 'columnChartPopulations'));
    }

    public final function loadDistributionCity()
    {
        $data['desilPopulation'] = $this->p3keService->columnDesilPopulation();
        $data['desilFamily'] = $this->p3keService->columnDesilFamily();
        $data['cities'] = $this->cities;
        $data['desil'] = $this->desil;
        $data['columnFamilies'] = array_map(fn($val) => ['name' => $val['name'], 'y' => $val['percentage']], $data['desilFamily']);
        $data['columnPopulations'] = array_map(fn($val) => ['name' => $val['name'], 'y' => $val['percentage']], $data['desilPopulation']);
        return view('landing.pages.load-data.home.distribution-city', $data);
    }

    public final function loadDistributionPersenCity()
    {
        $bubbles = $this->dataChartBubble();
        $cities = $this->cities;
        $desil = $this->desil;
        return view('landing.pages.load-data.home.distribution-persen-city', compact('desil', 'cities', 'bubbles'));
    }


    function dataChartBubble()
    {
        $cities = $this->cities;
        $cc = [];
        foreach ($cities as $city) {
            $data = [];
            $total = $city->populations->sum('total');
            foreach ($city->populations as $population) {
                $dt['name'] = 'Desil ' . $population->desil_id;
                $dt['value'] = round($population->total / $total * 100, 2);
                $data[] = $dt;
            }
            $dd['name'] = $city->city_name;
            $dd['data'] = $data;
            $cc[] = $dd;
        }
        return $cc;
    }

    function columnChartDistribution(string $params = 'families')
    {
        $dataColumn = [];
        foreach ($this->desil as $ds) {
            $dds = [];
            foreach ($this->cities as $city) {
                $desilData = '';
                foreach ($city[$params] as $family) {
                    if ($family['desil_id'] == $ds['desil_id']) {
                        $desilData = $family['total'];
                        break;
                    }
                };
                $dds[] = $desilData;
            }
            $dd['name'] = 'Desil ' . $ds['desil_id'];
            $dd['data'] = $dds;
            $dataColumn[] = $dd;
        }
        return $dataColumn;
    }


}
