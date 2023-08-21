<?php

namespace App\Http\Controllers\Admin\P3ke;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\DatabaseP3KE\DataFamily;
use App\Models\Reference\RefCity;
use App\Models\Reference\RefDistrict;
use App\Models\Reference\RefVillage;
use App\Services\P3keService;
use App\Services\ReferenceService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FamilyController extends Controller
{

    public function __construct(
        private ReferenceService $referenceService,
        private P3keService      $p3keService
    )
    {
    }

    public function index(Request $request)
    {
        $params = [
            'city' => $request->get('city'),
            'district' => $request->get('district'),
            'village' => $request->get('village'),
        ];
        $cities = $this->referenceService->getCity()->get();
        $districts = $this->referenceService->getDistrict(['city_code' => $params['city']])->get();
        $villages = $this->referenceService->getVillage(['city_code' => $params['city'], 'district_code' => $params['district']])->get();
        return view('admin.pages.p3ke.family-page', compact('cities', 'districts', 'villages', 'params'));
    }

    public final function dataTable(Request $request)
    {
        $query = $this->p3keService->getFamily($request);
        return DataTables::eloquent($query)
            ->editColumn('city', fn($fam) => $fam->city->city_name)
            ->editColumn('district', fn($fam) => $fam->district->district_name)
            ->editColumn('village', fn($fam) => $fam->village->village_name)
            ->editColumn('population_name', fn($population) => $population->population->population_name)
            ->toJson();
    }

    public final function selectFamily(Request $request)
    {
        $governmentID = $request->post('search');
        $search = $request->post('search');
        $getData = DataFamily::select(['data_families.*', 'data_populations.population_name'])
            ->join('data_populations', 'data_families.population_nik', '=', 'data_populations.population_nik')
            ->where('data_families.population_nik', 'like', "%$search%")
            ->orWhere('data_populations.population_name', 'like', "%$search%")
            ->limit(100)
            ->get();

        foreach ($getData as $i => $r) {
            $getData[$i]['id'] = $r['family_id'];
            $getData[$i]['text'] = $r['population_nik'] . ' - ' . $r['population_name'];
        }
        $select['total_count'] = count($getData);
        $select['items'] = $getData;
        return response()->json($select);
    }

    public final function loadFamilyRegion(Request $request)
    {
        try {
            $families = $this->p3keService->getFamilyRegion($request);
            foreach ($families as $i => $family) {
                $families[$i]['encryptID'] = encrypt($family->family_id);
            }
            $response = ResponseHelper::success(data: $families->toArray());
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }

    public final function store(Request $request)
    {
        try {
            $array = $request->post('item');
//            $dateBrith = trim(str_replace('/', '-', str_replace('0:00:00', '', $klg->tanggal_lahir)));
//            $dd = explode('-', $dateBrith);
//            $dateBrith = $dd[2].'-'.$dd['1'].'-'.$dd[0];
            $data = [
                'family_id' => $array['id_keluarga_P3KE'],
                'prov_code' => substr($array['kode_kemdagri'], 0, 2),
                'city_code' => substr($array['kode_kemdagri'], 2, 2),
                'district_code' => substr($array['kode_kemdagri'], 4, 2),
                'village_code' => substr($array['kode_kemdagri'], 6),
                'desil_id' => $array['desil_kesejahteraan'],
                'family_address' => $array['alamat'],
                'population_nik' => $array['nik'],
                'padan_dukcapil' => $array['padan_dukcapil'],
                'family_house' => $array['kepemilikan_rumah'],
                'family_facilitiy_other' => $array['memiliki_simpananuang_perhiasan_ternak_lainnya'],
                'family_facility_defecation' => $array['memiliki_fasilitas_buang_air_besar'],
                'family_type_roof' => $array['jenis_atap'],
                'family_type_wall' => $array['jenis_dinding'],
                'family_type_floor' => $array['jenis_lantai'],
                'family_type_lighting' => $array['sumber_penerangan'],
                'family_type_cooking' => $array['bahan_bakar_memasak'],
                'family_type_drinking' => $array['sumber_air_minum'],
                'family_year' => $this->yearDefault(),
            ];
            $data = DataFamily::updateOrCreate([
                'family_id' => $array['id_keluarga_P3KE'],
                'family_year' => $this->yearDefault(),
            ], $data);
            $response = ResponseHelper::success(data: $data->toArray());
        } catch (\Exception $exception) {
            $response = ResponseHelper::error($exception->getMessage());
        }
        return response()->json($response);
    }
}

