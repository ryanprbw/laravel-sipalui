<?php

namespace App\Services\Implements;

use App\Models\Budget\BudgetGovernment;
use App\Models\Reference\RefProgram;
use App\Services\BudgetService;
use Illuminate\Support\Facades\DB;

class BudgetServiceImplement implements BudgetService
{

    public function __construct(
        private BudgetGovernment $budgetGovernment
    )
    {
    }

    public final function getBudgetGovernmentID(int $governmentID, array $where = [])
    {
        $build = $this->budgetGovernment->where('government_id', $governmentID);
        if ($where) $build->where($where);
        return $build->groupBy('subkegiatan_code');
    }

    public final function insertUpdateBudgetGovernment(\Illuminate\Http\Request $request)
    {
//        $data['government_id'] = $request->post('government_id');
//        $data['urusan_code'] = $request->post('urusan_code');
//        $data['bidang_code'] = $request->post('bidang_code');
//        $data['program_code'] = $request->post('program_code');
//        $data['kegiatan_code'] = $request->post('kegiatan_code');
//        $data['subkegiatan_code'] = $request->post('subkegiatan_code');
//        $data['position'] = $request->post('position');
//        $data['category_strategy_id'] = $request->post('category_strategy_id');
//        $data['budget_government_year'] = $request->post('budget_government_year');
//        $data['budget_government_ceiling'] = $request->post('budget_government_ceiling');
        $data = $request->all();
        return $this->budgetGovernment->updateOrCreate([
            'subkegiatan_code' => $request->post('subkegiatan_code'),
            'government_id' => $request->post('government_id')
        ], $data);
    }

}
