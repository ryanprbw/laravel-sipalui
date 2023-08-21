<?php

namespace App\Http\Controllers\Admin\Assistance;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Assistance\AssistanceInnovation;
use App\Services\AssistanceService;
use Illuminate\Http\Request;

class InnovationController extends Controller
{
    public function __construct(
        private AssistanceService $assistanceService,
    )
    {
    }

    public function index()
    {
        $priorities = $this->assistanceService->getPriority()->get();
        $innovations = $this->assistanceService->getInnovation()->get();
        return view('admin.pages.assistance.innovation-page', compact('innovations', 'priorities'));
    }

    public final function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $request->validate([
                'assistance_priority_id' => 'required',
                'assistance_innovation_name' => 'required',
                'assistance_innovation_alias' => 'required'
            ]);
            $this->assistanceService->insertInnovation($request);
            $response = ResponseHelper::success('Berhasil Input Data Inovasi');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public final function delete(AssistanceInnovation $innovation)
    {
        try {
            $innovation->delete();
            $response = ResponseHelper::success('Delete Input Data Inovasi');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

}
