<?php

namespace App\Services\Implements;

use App\Models\Nomination\NominationPopulation;
use App\Models\Receiver\ReceiverPriority;
use App\Services\NominationService;
use Illuminate\Http\Request;

class NominationServiceImplement implements NominationService
{

    public function __construct(
        private NominationPopulation $nominationPopulation
    )
    {
    }

    function getNominations(array $where = [])
    {
        $build = $this->nominationPopulation;
        return !$where ? $build : $build->where($where);
    }

    function insertNominations(Request $request)
    {
        $data['year'] = $request->post('year');
        $data['population_nik'] = $request->post('population_nik');
        $data['category_strategy_id'] = $request->post('category_strategy_id');
        return $this->nominationPopulation->create($data);
    }

    function getNominationYearNikStrategy(int $year, string $nik, int $strategyID)
    {
        return $this->nominationPopulation->where([
            'category_strategy_id' => $strategyID,
            'population_nik' => $nik,
            'year' => $year,
        ])->first();
    }

    function getNominationPopulations(int $year, int $cityCode, int $strategyID)
    {
        $nominations = NominationPopulation::join('data_populations', 'data_populations.population_nik', '=', 'nomination_populations.population_nik')
            ->join('uti_stunting_risk', 'uti_stunting_risk.stunting_risk_id', '=', 'data_populations.stunting_risk_id')
            ->where([
                'year' => $year,
                'data_populations.city_code' => $cityCode,
                'category_strategy_id' => $strategyID,
            ]);
        return $nominations->get();
    }
}
