<?php

namespace App\Http\Controllers\Admin\Assistance;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Assistance\AssistancePriority;
use App\Services\AssistanceService;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    public function __construct(
        private AssistanceService $assistanceService,
    )
    {
    }

    public final function index()
    {
        $priorities = $this->assistanceService->getPriority()->get();
        return view('admin.pages.assistance.priority-page', compact('priorities'));
    }

    public final function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $request->validate([
                'assistance_priority_name' => 'required',
                'assistance_priority_alias' => 'required'
            ]);
            if ($id = $request->post('assistance_priority_id')) {
                $this->assistanceService->updatePriority($request, $id);
            } else {
                $this->assistanceService->insertPriority($request);
            }
            $response = ResponseHelper::success('Berhasil Input Data Prioritas');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public final function delete(AssistancePriority $priority)
    {
        try {
            $priority->delete();
            $response = ResponseHelper::success('Delete Input Data Priority');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

}
