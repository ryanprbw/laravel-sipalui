<?php

namespace App\Http\Controllers\Admin\Budget;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Reference\RefSubKegiatan;
use App\Services\BudgetService;
use App\Services\GovernmentService;
use App\Services\ReferenceService;
use App\Services\UtilityService;
use Illuminate\Http\Request;

class BudgetGovernmentController extends Controller
{
    public function __construct(
        private BudgetService     $budgetService,
        private GovernmentService $governmentService,
        private UtilityService    $utilityService,
        private ReferenceService  $referenceService
    )
    {
    }

    public final function index(Request $request)
    {
        $data['params'] = [
            'government' => $this->governmentID($request),
            'year' => $request->get('year') ?? $this->yearDefault()
        ];
        $data['governmentsLocal'] = $this->governmentService->getGovernmentLevel()->get();
        $data['strategies'] = $this->utilityService->getCategoryStrategy()->get();
        if ($governmentID = $data['params']['government']) {
            $data['local'] = $this->governmentService->getGovernmentLocal(['government_id' => $governmentID])->first();
            $data['budgets'] = $this->budgetService->getBudgetGovernmentID($governmentID, ['budget_government_year' => $data['params']['year']])
                ->with('subkegiatan')->get();
        }
        return view('admin.pages.budget.government-page', $data);
    }

    public final function store(Request $request)
    {
        try {
            $request->validate([
                'government_id' => 'required',
                'urusan_code' => 'required',
                'bidang_code' => 'required',
                'program_code' => 'required',
                'kegiatan_code' => 'required',
                'subkegiatan_code' => 'required',
                'position' => ['required', 'integer'],
                'category_strategy_id' => ['required', 'integer'],
                'budget_government_year' => ['required', 'integer'],
                'budget_government_ceiling' => ['required', 'integer'],
            ]);
            $this->budgetService->insertUpdateBudgetGovernment($request);
            $response = ResponseHelper::success('Berhasil Input Data Pemerintah Daerah');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public final function loadBudgetGovID(Request $request, int $governmentID)
    {
        try {
            $budgets = $this->budgetService->getBudgetGovernmentID($governmentID, ['budget_government_year' => $request->get('year')])->get();
            $response = ResponseHelper::success('Success', data: $budgets->toArray());
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

}
