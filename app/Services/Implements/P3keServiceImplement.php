<?php

namespace App\Services\Implements;

use App\Models\DatabaseP3KE\DataFamily;
use App\Models\DatabaseP3KE\DataPopulation;
use App\Services\P3keService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class P3keServiceImplement implements P3keService
{

    public function __construct(
        private array $dataPopulations = [],
        private array $dataFamilies = []
    )
    {
    }


    public final function getPopulation(Request $request)
    {
        $city_code = $request->get('city_code');
        $query = DataPopulation::query()->with(['city', 'district', 'village'])
            ->join('uti_family_relations', 'uti_family_relations.family_relation_id', '=', 'data_populations.family_relation_id')
            ->where('city_code', $city_code);
        if ($district_code = $request->get('district_code')) $query->where('district_code', $district_code);
        if ($village_code = $request->get('village_code')) $query->where('village_code', $village_code);
        return $query;
    }

    public final function getFamily(Request $request)
    {
        $city_code = $request->get('city_code');
        DB::statement(DB::raw('set @rownum=0'));
        $query = DataFamily::query()->with(['city', 'district', 'village', 'population'])
            ->select('data_families.*', DB::raw('@rownum := @rownum  + 1 AS rownum'),)
            ->where('data_families.city_code', $city_code);
        if ($district_code = $request->get('district_code')) $query->where('data_families.district_code', $district_code);
        if ($village_code = $request->get('village_code')) $query->where('data_families.village_code', $village_code);
        return $query;
    }

    public final function getFamilyRegion(Request $request)
    {
        $params = [
            'city_code' => $request->get('city_code'),
            'district_code' => $request->get('district_code'),
            'village_code' => $request->get('village_code'),
        ];
        return DataFamily::with(['population' => function ($query) {
            $query->select(['population_nik', 'population_name']);
        }])->select(['family_id', 'population_nik', 'desil_id'])->where($params)->get();
    }

    function columnDesilPopulation(): array
    {
        $populations = DataPopulation::selectRaw('count(*) as total, desil_id')->groupBy('desil_id')->get();
        $total = $populations->sum('total');
        foreach ($populations as $i => $population) {
            $dd['name'] = 'Desil ' . $population['desil_id'];
            $dd['total'] = $population->total;
            $dd['percentage'] = round($population->total / $total * 100, 2);
            $this->dataPopulations[] = $dd;
        }
        return $this->dataPopulations;
    }

    function columnDesilFamily(): array
    {
        $families = DataFamily::selectRaw('count(*) as total, desil_id')->groupBy('desil_id')->get();
        $total = $families->sum('total');
        foreach ($families as $i => $family) {
            $dd['name'] = 'Desil ' . $family['desil_id'];
            $dd['total'] = $family['total'];
            $dd['percentage'] = round($family['total'] / $total * 100, 2);
            $this->dataFamilies[] = $dd;
        }
        return $this->dataFamilies;
    }
}
