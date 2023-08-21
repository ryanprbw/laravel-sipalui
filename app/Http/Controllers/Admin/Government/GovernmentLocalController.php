<?php

namespace App\Http\Controllers\Admin\Government;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Government\GovernmentLocal;
use App\Services\GovernmentService;
use App\Services\ReferenceService;
use Illuminate\Http\Request;

class GovernmentLocalController extends Controller
{

    public function __construct(
        private ReferenceService  $referenceService,
        private GovernmentService $governmentService
    )
    {
    }

    public final function index()
    {
        $cities = $this->referenceService->getCity()->get();
        $governments = $this->governmentService->getGovernmentLocal()->get();
        return view('admin.pages.government.local-page', compact('cities', 'governments'));
    }

    public final function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $request->validate([
                'government_name' => 'required'
            ]);
            if ($id = $request->post('government_id')) {
                $this->governmentService->updateGovernmentLocal($request, $id);
            } else {
                $this->governmentService->insertGovernmentLocal($request);
            }
            $response = ResponseHelper::success('Berhasil Input Data Pemerintah Daerah');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public final function delete(Request $request, GovernmentLocal $local)
    {
        try {
            $local->delete();
            $response = ResponseHelper::success('Delete Data Pemerintah Daerah');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }
}
