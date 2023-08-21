<?php

namespace App\Services;


use App\Models\Assistance\AssistancePriority;
use App\Models\Government\GovernmentAgencies;
use App\Models\Government\GovernmentLocal;
use Illuminate\Http\Request;

interface GovernmentService
{

    function getGovernmentLocal(array $where = []);

    function getGovernmentLevel();

    function insertGovernmentLocal(Request $request);

    function updateGovernmentLocal(Request $request, int $id);

    function getGovernmentAgencies(array $where = []);

    function getGovernmentAgenciesLevel(array $where = []);

    function insertGovernmentAgency(Request $request);

    function updateGovernmentAgency(Request $request, int $id);

}
