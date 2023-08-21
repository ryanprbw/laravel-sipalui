<?php

namespace App\Services\Implements;

use App\Models\Assistance\AssistanceInnovation;
use App\Models\Assistance\AssistancePriority;
use App\Services\AssistanceService;
use Illuminate\Http\Request;

class AssistanceServiceImplement implements AssistanceService
{

    public function __construct(
        private AssistancePriority   $assistancePriority,
        private AssistanceInnovation $assistanceInnovation,
    )
    {
    }

    public final function getPriority(array $where = [])
    {
        $build = $this->assistancePriority;
        return !$where ? $build : $build->where($where);
    }

    public final function insertPriority(Request $request)
    {
        $data['assistance_priority_name'] = $request->post('assistance_priority_name');
        $data['assistance_priority_alias'] = $request->post('assistance_priority_alias');
        return $this->assistancePriority->create($data);
    }

    function updatePriority(Request $request, int $id)
    {
        $data['assistance_priority_name'] = $request->post('assistance_priority_name');
        $data['assistance_priority_alias'] = $request->post('assistance_priority_alias');
        return $this->assistancePriority->find($id)->update($data);
    }

    public final function getInnovation(array $where = []): \Illuminate\Database\Eloquent\Builder
    {
        $build = $this->assistanceInnovation->with(['priority']);
        if ($where) $build->where($where);
        return $build;
    }

    public final function insertInnovation(Request $request)
    {
        $data['assistance_priority_id'] = $request->post('assistance_priority_id');
        $data['assistance_innovation_name'] = $request->post('assistance_innovation_name');
        $data['assistance_innovation_alias'] = $request->post('assistance_innovation_alias');
        return $this->assistanceInnovation->create($data);
    }


    function getPriorityWhereIn(string $field, array $where = [])
    {
        return $this->assistancePriority->whereIn($field, $where);
    }
}
