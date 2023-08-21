<?php

namespace App\Services\Implements;

use App\Models\User;
use App\Models\UserLevel;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserServiceImplement implements UserService
{

    public function __construct(
        private User      $user,
        private UserLevel $userLevel
    )
    {
    }

    /**
     * @throws \Exception
     */
    final function validationLogin(string $username, string $password): bool
    {
        $user = $this->user->where('username', $username)->first();
        if (!$user) throw new \Exception('login failed !!!');
        if ($user->is_active != 1) throw new \Exception('Your user is not active.');
        if (!password_verify($password, $user['password'])) throw new \Exception('failed to login, please check your username and password.!!!');
        return Auth::attempt(['username' => $username, 'password' => $password]);
    }

    public final function getLevelUser(array $where = []): UserLevel
    {
        $build = $this->userLevel;
        if ($where) $build->where($where);
        return $build;
    }

    function insertUser(Request $request)
    {
        $data['level_id'] = $request->post('level_id');
        $data['username'] = $request->post('username');
        $data['password'] = $request->post('password');
        $data['name'] = $request->post('name');
        $data['government_id'] = $request->post('government_id');
        $data['agency_id'] = $request->post('agency_id');
        return $this->user->create($data);
    }

    function getUser(array $where = [])
    {
        $build = $this->user;
        if ($where) $build->where($where);
        return $build;
    }

    public final function getUserLevelID(int $levelID): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->user->with('level')
            ->where('level_id', $levelID)->get();
    }
}
