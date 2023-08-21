<?php

namespace App\Http\Controllers\Admin\Receiver;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Receiver\ReceiverPriority;
use App\Models\Reference\RefCity;
use App\Services\AssistanceService;
use App\Services\GovernmentService;
use App\Services\ReceiverService;
use App\Services\ReferenceService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReceiverPriorityController extends Controller
{
    public function __construct(
        private ReferenceService  $referenceService,
        private AssistanceService $assistanceService,
        private GovernmentService $governmentService,
        private UtilityService    $utilityService,
        private ReceiverService   $receiverService
    )
    {
    }

    public final function index(Request $request)
    {
        $params = [
            'governmentID' => $this->governmentID($request),
            'agencyID' => $this->agencyID($request),
            'priorityID' => $request->get('priority'),
            'year' => $request->get('year') ?? $this->yearDefault()
        ];
        $data['governments'] = $this->governmentService->getGovernmentLevel()->get();
        $data['agencies'] = $this->governmentService->getGovernmentAgenciesLevel()->get();
        $data['priorities'] = $this->assistanceService->getPriority()->get();
        if ($params['governmentID'] and $params['agencyID']) {
            $government = $this->governmentService->getGovernmentLocal(['government_id' => $params['governmentID']])->first();
            $whereCityCode = $government['city_code'] ? ['city_code' => $government['city_code']] : [];
            $data['cities'] = $this->referenceService->getCity($whereCityCode)->get();
            $data['sourceFunds'] = $this->utilityService->getUtiSourceFund()->get();
        }
        return view('admin.pages.receiver.priority-page', array_merge($data, compact('params')));
    }

    public final function store(Request $request)
    {
        try {
            $request->validate([
                'assistance_priority_id' => 'required',
                'agency_id' => 'required',
                'government_id' => 'required',
                'family_id' => 'required',
                'source_fund_id' => 'required',
            ]);
            $request->merge(['year' => $this->yearDefault()]);
            $this->receiverService->insertReceiverPriority($request);
            $response = ResponseHelper::success('Berhasil Input data bantuan.');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public final function delete(Request $request, ReceiverPriority $receiverPriority)
    {
        try {
            $receiverPriority->delete();
            $response = ResponseHelper::success('Berhasil menghapus data');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

    public final function dataTable(Request $request)
    {

        $query = $this->receiverService->getReceiverPriorityDT($request);
        return DataTables::eloquent($query)
            ->addColumn('population_nik', fn($fam) => $fam->family->population_nik)
            ->addColumn('population_name', fn($fam) => $fam->family->population_name)
            ->addColumn('desil', fn($fam) => $fam->family->desil_id)
            ->addColumn('source_fund_name', fn($fam) => $fam->source_fund->source_fund_name)
            ->toJson();

    }
}
