<?php

namespace App\Services\Implements;

use App\Models\Assistance\AssistanceInnovation;
use App\Models\Assistance\AssistancePriority;
use App\Models\DatabaseP3KE\DataFamily;
use App\Models\DatabaseP3KE\DataPopulation;
use App\Models\Reference\RefCity;
use App\Models\Reference\RefDistrict;
use App\Models\Reference\RefVillage;
use App\Models\Utility\UtiDesil;
use App\Models\Utility\UtiSourceFund;
use App\Services\AssistanceService;
use App\Services\DistributionService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistributionServiceImplement implements DistributionService
{

    public function __construct()
    {
    }

    function getDistributionDistrict(int $cityCode)
    {
        return RefDistrict::with(['families' => function ($query) {
            $query->select('city_code', 'district_code', 'desil_id', DB::raw('count(*) as total'))
                ->groupBy('city_code', 'district_code', 'desil_id');
        }, 'populations' => function ($query) {
            $query->select('city_code', 'district_code', 'desil_id', DB::raw('count(*) as total'))
                ->groupBy('city_code', 'district_code', 'desil_id');
        }])->where(['city_code' => $cityCode])->get();
    }

    function getDistributionVillage(int $cityCode, int $districtCode)
    {
        return RefVillage::with(['families' => function ($query) {
            $query->select('city_code', 'district_code', 'village_code', 'desil_id', DB::raw('count(*) as total'))
                ->groupBy('city_code', 'district_code', 'village_code', 'desil_id');
        }, 'populations' => function ($query) {
            $query->select('city_code', 'district_code', 'village_code', 'desil_id', DB::raw('count(*) as total'))
                ->groupBy('city_code', 'district_code', 'village_code', 'desil_id');
        }])->where(['city_code' => $cityCode, 'district_code' => $districtCode])->get();
    }

    function getDistrictDesilPopulation(int $cityCode): array
    {
        $populations = DataPopulation::selectRaw('count(*) as total, desil_id')
            ->where(['city_code' => $cityCode])
            ->groupBy('city_code', 'desil_id')->get();
        $data = [];
        $total = $populations->sum('total');
        foreach ($populations as $i => $population) {
            $dd['name'] = 'Desil ' . $population['desil_id'];
            $dd['total'] = $population->total;
            $dd['y'] = round($population->total / $total * 100, 2);
            $data[] = $dd;
        }
        return $data;
    }

    function getDistrictDesilFamily(int $cityCode): array
    {
        $families = DataFamily::selectRaw('count(*) as total, desil_id')
            ->where(['city_code' => $cityCode])
            ->groupBy('city_code', 'desil_id')->get();
        $data = [];
        $total = $families->sum('total');
        foreach ($families as $i => $family) {
            $dd['name'] = 'Desil ' . $family['desil_id'];
            $dd['total'] = $family['total'];
            $dd['y'] = round($family['total'] / $total * 100, 2);
            $data[] = $dd;
        }
        return $data;
    }

    function getVillageDesilPopulation(int $cityCode, int $distinctCode): array
    {
        $populations = DataPopulation::selectRaw('count(*) as total, desil_id')
            ->where(['city_code' => $cityCode, 'district_code' => $distinctCode])
            ->groupBy('city_code', 'district_code', 'desil_id')->get();
        $data = [];
        $total = $populations->sum('total');
        foreach ($populations as $i => $population) {
            $dd['name'] = 'Desil ' . $population['desil_id'];
            $dd['total'] = $population->total;
            $dd['y'] = round($population->total / $total * 100, 2);
            $data[] = $dd;
        }
        return $data;
    }

    public final function getVillageDesilFamily(int $cityCode, int $distinctCode): array
    {
        $families = DataFamily::selectRaw('count(*) as total, desil_id')
            ->where(['city_code' => $cityCode, 'district_code' => $distinctCode])
            ->groupBy('city_code', 'district_code', 'desil_id')->get();
        $data = [];
        $total = $families->sum('total');
        foreach ($families as $i => $family) {
            $dd['name'] = 'Desil ' . $family['desil_id'];
            $dd['total'] = $family['total'];
            $dd['y'] = round($family['total'] / $total * 100, 2);
            $data[] = $dd;
        }
        return $data;
    }

    public final function getDistributionCities(): \Illuminate\Database\Eloquent\Collection|array
    {
        return RefCity::with(['families' => function ($query) {
            $query->select('city_code', 'desil_id', DB::raw('count(*) as total'))
                ->groupBy('city_code', 'desil_id');
        }, 'populations' => function ($query) {
            $query->select('city_code', 'desil_id', DB::raw('count(*) as total'))
                ->groupBy('city_code', 'desil_id');
        }])->get();
    }
}
