<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Assistance\AssistancePriority;
use App\Models\Receiver\ReceiverPriority;
use Illuminate\Http\Request;

class ReceiverFamilyController extends Controller
{
    public function __construct()
    {
    }

    public final function index(Request $request)
    {
        try {
            $familyID = $request->get('family');
            $priorities = AssistancePriority::get();
            $receivers = ReceiverPriority::where('family_id', $familyID)->get();
            foreach ($priorities as $i => $priority) {
                $status = 'Tidak';
                foreach ($receivers as $receiver) {
                    if ($receiver->assistance_priority_id == $priority->assistance_priority_id) {
                        $status = 'Ya';
                        break;
                    }
                }
                $priorities[$i]['status'] = $status;
            }
            $response = ResponseHelper::success(data: $priorities->toArray());
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }

        return response()->json($response, $response['statusCode']);
    }
}
