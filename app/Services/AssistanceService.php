<?php

namespace App\Services;


use App\Models\Assistance\AssistancePriority;
use Illuminate\Http\Request;

interface AssistanceService
{

    function getPriority(array $where = []);

    function getPriorityWhereIn(string $field, array $where);

    function insertPriority(Request $request);

    function updatePriority(Request $request, int $id);

    function getInnovation(array $where = []): \Illuminate\Database\Eloquent\Builder;

    function insertInnovation(Request $request);
}
