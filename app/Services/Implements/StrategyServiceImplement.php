<?php

namespace App\Services\Implements;

use App\Models\Budget\BudgetGovernment;
use App\Models\Reference\RefKegiatan;
use App\Models\Reference\RefProgram;
use App\Models\Reference\RefSubKegiatan;
use App\Services\StrategyService;
use Illuminate\Support\Facades\DB;

class StrategyServiceImplement implements StrategyService
{

    public function __construct(
        private BudgetGovernment $budgetGovernment,
        private RefProgram       $refProgram,
        private RefKegiatan      $refKegiatan,
        private RefSubKegiatan   $refSubKegiatan,
    )
    {
    }


    public final function getStrategy(string $cityCode = null)
    {
        $build = $this->budgetGovernment
            ->select('budget_government.government_id', 'category_strategy_id', 'budget_government.position', DB::raw('sum(budget_government_ceiling) as total'))
            ->join('government_local', 'government_local.government_id', '=', 'budget_government.government_id');
        $build = $cityCode
            ? $build->where('city_code', $cityCode)
            : $build->whereNull('city_code');
        $strategies = $build->groupBy('category_strategy_id')->get();

        $programs = $this->refProgram
            ->select('category_strategy_id', 'ref_program.program_code', 'program_name', DB::raw('sum(budget_government_ceiling) as total'))
            ->join('budget_government', function ($join) {
                $join->on('budget_government.program_code', '=', 'ref_program.program_code');
                $join->on('budget_government.position', '=', 'ref_program.position');
            })->groupBy('category_strategy_id', 'ref_program.program_code')->get();

        $kegiatans = $this->refKegiatan
            ->select('category_strategy_id', 'ref_kegiatan.program_code', 'ref_kegiatan.kegiatan_code', 'kegiatan_name', DB::raw('sum(budget_government_ceiling) as total'))
            ->join('budget_government', function ($join) {
                $join->on('budget_government.kegiatan_code', '=', 'ref_kegiatan.kegiatan_code');
                $join->on('budget_government.position', '=', 'ref_kegiatan.position');
            })->groupBy('category_strategy_id', 'ref_kegiatan.kegiatan_code')->get();

        $subkegiatans = $this->refSubKegiatan
            ->select('category_strategy_id', 'ref_subkegiatan.program_code', 'ref_subkegiatan.kegiatan_code', 'ref_subkegiatan.subkegiatan_code', 'subkegiatan_name', DB::raw('sum(budget_government_ceiling) as total'))
            ->join('budget_government', function ($join) {
                $join->on('budget_government.subkegiatan_code', '=', 'ref_subkegiatan.subkegiatan_code');
                $join->on('budget_government.position', '=', 'ref_subkegiatan.position');
            })->groupBy('category_strategy_id', 'ref_subkegiatan.subkegiatan_code')->get();

        foreach ($strategies as $i => $strategy) {
            $dataProgram = [];
            foreach ($programs as $program) {
                if ($program->category_strategy_id == $strategy->category_strategy_id) {
                    $dp['category_strategy_id'] = $program->category_strategy_id;
                    $dp['program_code'] = $program->program_code;
                    $dp['program_name'] = $program->program_name;
                    $dp['total'] = $program->total;
                    $dataProgram[] = $dp;
                }
            }
            $dataKegiatan = [];
            foreach ($kegiatans as $kegiatan) {
                if ($kegiatan->category_strategy_id == $strategy->category_strategy_id) {
                    $dk['category_strategy_id'] = $kegiatan->category_strategy_id;
                    $dk['program_code'] = $kegiatan->program_code;
                    $dk['kegiatan_code'] = $kegiatan->kegiatan_code;
                    $dk['kegiatan_name'] = $kegiatan->kegiatan_name;
                    $dk['total'] = $kegiatan->total;
                    $dataKegiatan[] = $dk;
                }
            }
            $dataSubKegiatan = [];
            foreach ($subkegiatans as $subkegiatan) {
                if ($subkegiatan->category_strategy_id == $strategy->category_strategy_id) {
                    $dsk['category_strategy_id'] = $subkegiatan->category_strategy_id;
                    $dsk['program_code'] = $subkegiatan->program_code;
                    $dsk['kegiatan_code'] = $subkegiatan->kegiatan_code;
                    $dsk['subkegiatan_code'] = $subkegiatan->subkegiatan_code;
                    $dsk['subkegiatan_name'] = $subkegiatan->subkegiatan_name;
                    $dsk['total'] = $subkegiatan->total;
                    $dataSubKegiatan[] = $dsk;
                }
            }
            $strategies[$i]['program'] = $dataProgram;
            $strategies[$i]['kegiatan'] = $dataKegiatan;
            $strategies[$i]['subkegiatan'] = $dataSubKegiatan;
        }
        return $strategies;
    }

}
