<?php

namespace App\Services\Implements;

use App\Models\Government\GovernmentAgencies;
use App\Models\Government\GovernmentLocal;
use App\Services\GovernmentService;
use Illuminate\Http\Request;

class GovernmentServiceImplement implements GovernmentService
{

    public function __construct(
        private GovernmentLocal    $governmentLocal,
        private GovernmentAgencies $governmentAgencies,
    )
    {
    }

    public final function getGovernmentLocal(array $where = [])
    {
        $build = $this->governmentLocal->with(['city'])
            ->orderBy('government_local.city_code');
        if ($where) $build->where($where);
        return $build;
    }

    public final function insertGovernmentLocal(Request $request)
    {
        $data['city_code'] = $request->post('city_code');
        $data['government_name'] = $request->post('government_name');
        $data['government_alias'] = $request->post('government_alias');
        $data['position'] = $request->post('city_code') ? 2 : 1;
        return $this->governmentLocal->create($data);
    }

    function updateGovernmentLocal(Request $request, int $id)
    {
        $data['government_name'] = $request->post('government_name');
        $data['government_alias'] = $request->post('government_alias');
        return $this->governmentLocal->find($id)->update($data);
    }

    public final function getGovernmentAgencies(array $where = [])
    {
        $build = $this->governmentAgencies
            ->with('government');
        if ($where) $build->where($where);
        return $build;
    }

    function insertGovernmentAgency(Request $request)
    {
        $data['government_id'] = $request->post('government_id');
        $data['agency_name'] = $request->post('agency_name');
        return $this->governmentAgencies->create($data);
    }

    public final function updateGovernmentAgency(Request $request, int $id)
    {
        $data['agency_name'] = $request->post('agency_name');
        return $this->governmentAgencies->find($id)->update($data);
    }

    public final function getGovernmentLevel(): \Illuminate\Database\Eloquent\Builder
    {
        $auth = auth()->user();
        if ($auth['level_id'] == 2) {
            return $this->governmentLocal->where('government_id', $auth['government_id']);
        } else {
            return $this->getGovernmentLocal();
        }
    }

    function getGovernmentAgenciesLevel(array $where = [])
    {
        $auth = auth()->user();
        $build = $this->governmentAgencies->with('government');
        if ($auth['level_id'] == 3) {
            $build = $build->where('agency_id', $auth['agency_id']);
        } elseif ($auth['level_id'] == 2) {
            $build = $build->where('government_id', $auth['government_id']);
        }
        if ($where) $build->where($where);
        return $build;
    }
}
