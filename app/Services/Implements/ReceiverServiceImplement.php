<?php

namespace App\Services\Implements;

use App\Models\Assistance\AssistanceInnovation;
use App\Models\Assistance\AssistancePriority;
use App\Models\DatabaseP3KE\DataFamily;
use App\Models\Receiver\ReceiverPriority;
use App\Models\Utility\UtiSourceFund;
use App\Services\AssistanceService;
use App\Services\ReceiverService;
use App\Services\UtilityService;
use Illuminate\Http\Request;

class ReceiverServiceImplement implements ReceiverService
{

    public function __construct(
        private ReceiverPriority $receiverPriority
    )
    {
    }

    function getReceiverPriority(array $where = [])
    {
        $build = $this->receiverPriority->with('family');
        return !$where ? $build : $build->where($where);
    }

    /**
     * @throws \Exception
     */
    function insertReceiverPriority(Request $request)
    {
        $params = [
            'assistance_priority_id' => decrypt($request->post('assistance_priority_id')),
            'agency_id' => decrypt($request->post('agency_id')),
            'government_id' => decrypt($request->post('government_id')),
            'family_id' => decrypt($request->post('family_id')),
            'source_fund_id' => $request->post('source_fund_id'),
            'year' => $request->post('year'),
        ];
        $where = [
            'assistance_priority_id' => $params['assistance_priority_id'],
            'family_id' => $params['family_id'],
            'year' => $params['year']
        ];
        $data = $this->getReceiverPriority($where)->first();
        if ($data) throw new \Exception('Data Keluarga yang dimasukan sudah mendapatkan bantuan program ini.');
        return $this->receiverPriority->create($params);
    }

    function getReceiverPriorityDT(Request $request)
    {
        return ReceiverPriority::query()->with(['source_fund', 'family' => function ($query) {
            $query->select(['data_populations.family_id', 'data_populations.population_nik', 'data_populations.population_name', 'data_populations.desil_id']);
        }])->where([
            'government_id' => $request->get('government'),
            'assistance_priority_id' => $request->get('priority'),
            'year' => $request->get('year'),
        ]);
    }

    function findAllWhere(array $where)
    {
        return $this->receiverPriority->where($where)->get();
    }
}
