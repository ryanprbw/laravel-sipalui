<?php

namespace App\Services\Implements;

use App\Models\Assistance\AssistanceInnovation;
use App\Models\Assistance\AssistancePriority;
use App\Models\DatabaseP3KE\DataFamily;
use App\Models\Reference\RefCity;
use App\Models\Reference\RefDistrict;
use App\Models\Utility\UtiDesil;
use App\Models\Utility\UtiSourceFund;
use App\Services\AnalyticService;
use App\Services\AssistanceService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticServiceImplement implements AnalyticService
{

    public function __construct()
    {
    }

    function getDistrictAssistanceDesil(int $cityCode, int $year, array $assistanceIDs, array $desilID): \Illuminate\Database\Eloquent\Collection|array
    {
        return RefDistrict::with(['families' => function ($query) use ($cityCode, $year, $assistanceIDs, $desilID) {
            $query->select('city_code', 'district_code', 'desil_id', 'assistance_priority_id', DB::raw('count(*) as total'))
                ->join('receiver_priority', 'receiver_priority.family_id', '=', 'data_families.family_id')
                ->whereIn('assistance_priority_id', $assistanceIDs)
                ->whereIn('desil_id', $desilID)
                ->where(['city_code' => $cityCode, 'family_year' => $year])
                ->groupBy('city_code', 'district_code', 'desil_id', 'assistance_priority_id')
                ->orderBy('assistance_priority_id', 'asc')
                ->orderBy('desil_id', 'asc');
        }])->where('city_code', $cityCode)->get();
    }

    function getCityAssistanceDesil(int $year): \Illuminate\Database\Eloquent\Collection|array
    {
        return RefCity::with(['families' => function ($query) use ($year) {
            $query->select('city_code', 'district_code', 'desil_id', 'assistance_priority_id', DB::raw('count(*) as total'))
                ->join('receiver_priority', 'receiver_priority.family_id', '=', 'data_families.family_id')
                ->where(['family_year' => $year])
                ->groupBy('city_code', 'desil_id', 'assistance_priority_id')
                ->orderBy('assistance_priority_id', 'asc')
                ->orderBy('desil_id', 'asc');
        }])->get();
    }

    public final function getFacilityPopulation(Request $request): \Illuminate\Database\Eloquent\Collection|array
    {
        $build = DataFamily::join('data_populations', function ($join) {
            $join->on('data_populations.population_nik', '=', 'data_families.population_nik');
            $join->on('data_populations.family_id', '=', 'data_families.family_id');
        })->join('uti_family_relations', 'uti_family_relations.family_relation_id', '=', 'data_populations.family_relation_id')
            ->select('data_families.family_id', 'data_families.prov_code', 'data_families.city_code', 'data_families.district_code', 'data_families.village_code',
                'data_families.desil_id', 'data_families.population_nik', 'family_house', 'family_facility_defecation',
                'family_type_roof', 'family_type_wall', 'family_type_floor', 'family_type_lighting', 'family_type_cooking',
                'family_type_drinking', 'data_families.padan_dukcapil', 'population_name', 'population_date_birth', 'population_education',
                'population_job', 'popolation_gender', 'status_marry', 'family_relation_name')
            ->where(['family_year' => $request->get('year'), 'data_families.city_code' => $request->get('city')])
            ->whereIn('data_families.desil_id', $request->get('desil'));
        //kondisi
        if ($houseIDs = $request->get('house')) $build->whereIn('family_house', $houseIDs);
        if ($defecationIDs = $request->get('defecation')) $build->whereIn('family_facility_defecation', $defecationIDs);
        if ($roofIDs = $request->get('roof')) $build->whereIn('family_type_roof', $roofIDs);
        if ($wallIDs = $request->get('wall')) $build->whereIn('family_type_wall', $wallIDs);
        if ($floorIDs = $request->get('floor')) $build->whereIn('family_type_floor', $floorIDs);
        if ($lightingIDs = $request->get('lighting')) $build->whereIn('family_type_lighting', $lightingIDs);
        if ($cookingIDs = $request->get('cooking')) $build->whereIn('family_type_cooking', $cookingIDs);
        if ($drinkingIDs = $request->get('drinking')) $build->whereIn('family_type_drinking', $drinkingIDs);
        if ($educationIDs = $request->get('education')) $build->whereIn('population_education', $educationIDs);
        return $build->get();
    }

    function getStrategyPopulation(Request $request): \Illuminate\Database\Eloquent\Collection|array
    {
        $build = DataFamily::join('data_populations', function ($join) {
            $join->on('data_populations.population_nik', '=', 'data_families.population_nik');
            $join->on('data_populations.family_id', '=', 'data_families.family_id');
        })->join('uti_family_relations', 'uti_family_relations.family_relation_id', '=', 'data_populations.family_relation_id')
            ->select('data_families.family_id', 'data_families.prov_code', 'data_families.city_code', 'data_families.district_code', 'data_families.village_code',
                'data_families.desil_id', 'data_families.population_nik', 'family_house', 'family_facility_defecation',
                'family_type_roof', 'family_type_wall', 'family_type_floor', 'family_type_lighting', 'family_type_cooking',
                'family_type_drinking', 'data_families.padan_dukcapil', 'population_name', 'population_date_birth', 'population_education',
                'population_job', 'popolation_gender', 'status_marry', 'family_relation_name')
            ->where([
                'family_year' => $request->get('year'),
                'data_populations.city_code' => $request->get('city'),
                'data_populations.desil_id' => 1
            ]);
        if ($request->get('strategy_id') == 1) {
            $build = $build->where('data_populations.stunting_risk_id', 1);
            if ($lightingIDs = $request->get('lighting')) $build->whereIn('family_type_lighting', $lightingIDs);
        }
        //kondisi
        if ($houseIDs = $request->get('house')) $build->whereIn('family_house', $houseIDs);
        if ($defecationIDs = $request->get('defecation')) $build->whereIn('family_facility_defecation', $defecationIDs);
        if ($roofIDs = $request->get('roof')) $build->whereIn('family_type_roof', $roofIDs);
        if ($wallIDs = $request->get('wall')) $build->whereIn('family_type_wall', $wallIDs);
        if ($floorIDs = $request->get('floor')) $build->whereIn('family_type_floor', $floorIDs);
        if ($cookingIDs = $request->get('cooking')) $build->whereIn('family_type_cooking', $cookingIDs);
        if ($drinkingIDs = $request->get('drinking')) $build->whereIn('family_type_drinking', $drinkingIDs);
        if ($educationIDs = $request->get('education')) $build->whereIn('population_education', $educationIDs);
        if ($marryIDs = $request->get('marry')) $build->whereIn('status_marry', $marryIDs);
        if ($jobIDs = $request->get('job')) $build->whereIn('population_job', $jobIDs);
        if ($jk_kk = $request->get('jk_kk')) $build->where('popolation_gender', $jk_kk);
        return $build->get();
    }
}
