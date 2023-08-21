<?php

namespace App\Services;

use App\Models\UserLevel;
use Illuminate\Http\Request;

interface UserService
{

    function getLevelUser(array $where = []): UserLevel;

    function getUser(array $where = []);

    function getUserLevelID(int $levelID);

    function insertUser(Request $request);

    function validationLogin(string $username, string $password): bool;
}
