<?php

namespace App\Http\Controllers\Admin\User;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\GovernmentService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private UserService       $userService,
        private GovernmentService $governmentService

    )
    {
    }

    public final function administrator(Request $request)
    {
        $data['users'] = $this->userService->getUserLevelID(1);
        return view('admin.pages.user.administrator-page', $data);
    }

    public final function government(Request $request)
    {
        $data['governments'] = $this->governmentService->getGovernmentLocal()->get();
        $data['users'] = $this->userService->getUserLevelID(2);
        return view('admin.pages.user.government-page', $data);
    }

    public final function agency(Request $request)
    {
        $data['agencies'] = $this->governmentService->getGovernmentAgenciesLevel()->get();
        $data['users'] = $this->userService->getUserLevelID(3);
        return view('admin.pages.user.agency-page', $data);
    }

    public final function store(Request $request)
    {
        try {
            $request->validate([
                'level_id' => 'required',
                'username' => 'required',
                'password' => 'required',
                'name' => 'required',
            ]);
            $this->userService->insertUser($request);
            $response = ResponseHelper::success('Berhasil input User');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        $this->setFlash($response['message'], $response['status']);
        return back();
    }

    public final function delete(User $user)
    {
        try {
            $user->delete();
            $response = ResponseHelper::success('Berhasil menghapus data');
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

    public final function updateStatus(Request $request, User $user)
    {
        try {

        } catch (\Exception $exception) {

        }
    }
}
