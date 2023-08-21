<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Assistance\AssistancePriority;
use App\Models\DatabaseP3KE\DataFamily;
use App\Services\AssistanceService;
use App\Services\NominationService;
use App\Services\ReceiverService;
use App\Services\ReferenceService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class NominationController extends Controller
{
    public function __construct(
        private NominationService $nominationService,
        private ReferenceService  $referenceService,
        private UtilityService    $utilityService,
        private ReceiverService   $receiverService,
        private AssistanceService $assistanceService,
    )
    {
    }

    public final function index(Request $request)
    {
        $params = [
            'cityCode' => $request->get('city'),
            'strategyID' => $request->get('strategy'),
            'year' => $this->yearDefault() ?? $request->get('year')
        ];
        $data['cities'] = $this->referenceService->getCity()->get();
        $data['strategies'] = $this->utilityService->getCategoryStrategy()->get();
        if ($params['cityCode']) {
            $data['nominations'] = $this->nominationService->getNominationPopulations($params['year'], $params['cityCode'], $params['strategyID']);
        }
        return view('landing.pages.nomination-page', array_merge($data, compact('params')));
    }

    public final function store(Request $request)
    {
        try {
            $attributes = $request->validate([
                'year' => 'required',
                'population_nik' => 'required',
                'category_strategy_id' => 'required'
            ]);
            $nomination = $this->nominationService->getNominationYearNikStrategy($attributes['year'], $attributes['population_nik'], $attributes['category_strategy_id']);
            if ($nomination) throw new Exception('Data sudah ada dalam database.');
            $this->nominationService->insertNominations($request);
            $response = ResponseHelper::success();
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

    public final function loadFacility(Request $request)
    {
        $familyID = $request->get('family');
        $family = DataFamily::where('family_id', $familyID)->firstOrFail();
        return view('landing.pages.load-data.nomination.facility', compact('family'));
    }

    public final function loadReceiver(Request $request)
    {
        $familyID = $request->get('family');
        $year = $request->get('year');
        $receives = $this->receiverService->findAllWhere(['family_id' => $familyID, 'year' => $year]);
        $priorities = $this->assistanceService->getPriority()->get();
        return view('landing.pages.load-data.nomination.receiver', compact('receives', 'priorities'));
    }
}
