<?php

namespace App\Http\Controllers\Admin\Government;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Government\GovernmentAgencies;
use App\Services\GovernmentService;
use Illuminate\Http\Request;

class GovernmentAgencyController extends Controller
{

    public function __construct(
        private GovernmentService $governmentService
    )
    {
    }

    public final function index(Request $request)
    {
        $params = [
            'governmentID' => $request->get('government')
        ];
        $governments = $this->governmentService->getGovernmentLocal()->get();
        $agencies = $this->governmentService->getGovernmentAgencies(['government_agencies.government_id' => $params['governmentID']])->get();
        return view('admin.pages.government.agency-page', compact('governments', 'agencies', 'params'));
    }

    public final function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $request->validate([
                'government_id' => 'required',
                'agency_name' => 'required'
            ]);
            if ($id = $request->post('agency_id')) {
                $this->governmentService->updateGovernmentAgency($request, $id);
            } else {
                $this->governmentService->insertGovernmentAgency($request);
            }
            $response = ResponseHelper::success('Berhasil Input Data Pemerintah Daerah');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public final function delete(Request $request, GovernmentAgencies $agency)
    {
        try {
            $agency->delete();
            $response = ResponseHelper::success('Delete Data Pemerintah SKPD');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

    public final function loadAgencyGovernment(Request $request)
    {
        try {
            $where = ['government_id' => $request->get('government')];
            $data = $this->governmentService->getGovernmentAgenciesLevel($where)->get();
            foreach ($data as $i => $datum) {
                $data[$i]['encrypt_id'] = encrypt($datum->agency_id);
            }
            $response = ResponseHelper::success(data: $data->toArray());
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }
}
