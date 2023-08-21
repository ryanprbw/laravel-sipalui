<?php

namespace App\Http\Controllers;

use App\Models\Budget\BudgetGovernment;
use App\Models\Government\GovernmentLocal;
use App\Models\Reference\RefCity;
use App\Models\Reference\RefProgram;
use App\Models\Utility\UtiCategoryStrategy;
use App\Services\GovernmentService;
use App\Services\ReferenceService;
use App\Services\StrategyService;
use App\Services\UtilityService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Termwind\Components\Raw;

class StrategyController extends Controller
{
    public function __construct(
        private GovernmentService $governmentService,
        private UtilityService    $utilityService,
        private StrategyService   $strategyService,
    )
    {
    }

    public final function index(): View
    {
        $governments = $this->governmentService->getGovernmentLocal()->get();
        $categories = $this->utilityService->getCategoryStrategy()->get();
        $strategies = $this->strategyService->getStrategy();
        return view('landing.pages.strategy-page', compact('categories', 'governments', 'strategies'));
    }

    public final function loadStrategyCity(Request $request): View
    {
        $cityCode = $request->get('city');
        $categories = $this->utilityService->getCategoryStrategy()->get();
        $strategies = $this->strategyService->getStrategy($cityCode);
        return view('landing.pages.load-data.strategy.strategy-government', compact('strategies', 'categories'));
    }
}
