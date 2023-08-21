<?php

namespace App\Http\Controllers\Admin\Reference;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Reference\RefSubKegiatan;
use App\Services\ReferenceService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NomenclatureController extends Controller
{
    public function __construct(
        private ReferenceService $referenceService
    )
    {
    }

    public final function index(Request $request)
    {
        $params = [
            'position' => $request->get('position')
        ];

        return view('admin.pages.reference.nomenclature-page', compact('params'));
    }

    public final function dataTable(Request $request)
    {
        $query = $this->referenceService->getNomenclature($request);
        return DataTables::of($query)->toJson();
    }

    public final function selectSubKegiatan(Request $request): \Illuminate\Http\JsonResponse
    {
        $position = $request->post('position');
        $search = $request->post('search');
        $getData = RefSubKegiatan::where('position', $position)
            ->where('subkegiatan_name', 'like', "%$search%")
            ->get();

        foreach ($getData as $i => $r) {
            $getData[$i]['id'] = $r['subkegiatan_id'];
            $getData[$i]['text'] = $r['subkegiatan_code'] . ' - ' . $r['subkegiatan_name'];
        }
        $select['total_count'] = count($getData);
        $select['items'] = $getData;
        return response()->json($select);
    }

    public final function loadSubKegiatanID(Request $request, int $subkegiatanID): \Illuminate\Http\JsonResponse
    {
        try {
            $data = RefSubKegiatan::find($subkegiatanID);
            $response = ResponseHelper::success(data: [$data]);
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

}
