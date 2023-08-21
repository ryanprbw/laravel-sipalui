<?php

namespace App\Http\Controllers\Admin\Reference;

use App\Http\Controllers\Controller;
use App\Models\DatabaseP3KE\DataFamily;
use App\Services\ReferenceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RegionController extends Controller
{
    public function __construct(
        private ReferenceService $referenceService
    )
    {
    }

    public final function index()
    {
        return view('admin.pages.reference.region-page');
    }


    public final function dataTable(Request $request)
    {
        $query = $this->referenceService->getRegion();
        $datatables = DataTables::of($query);
        return $datatables->toJson();
    }
}
