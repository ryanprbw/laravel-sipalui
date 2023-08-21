<?php

namespace App\Services\Implements;

use App\Models\Assistance\AssistanceInnovation;
use App\Models\Assistance\AssistancePriority;
use App\Models\Reference\RefBidangUrusan;
use App\Models\Reference\RefCity;
use App\Models\Reference\RefDistrict;
use App\Models\Reference\RefKegiatan;
use App\Models\Reference\RefProgram;
use App\Models\Reference\RefProvince;
use App\Models\Reference\RefSubKegiatan;
use App\Models\Reference\RefUrusan;
use App\Models\Reference\RefVillage;
use App\Services\AssistanceService;
use App\Services\ReferenceService;
use Illuminate\Http\Request;

class ReferenceServiceImplement implements ReferenceService
{

    public function __construct(
        private RefProvince     $province,
        private RefCity         $city,
        private RefDistrict     $district,
        private RefVillage      $village,
        private RefUrusan       $urusan,
        private RefBidangUrusan $bidangUrusan,
        private RefProgram      $program,
        private RefKegiatan     $kegiatan,
        private RefSubKegiatan  $subKegiatan,


    )
    {
    }

    function getProvince(array $where = []): RefProvince
    {
        $build = $this->province;
        if ($where) $build->where($where);
        return $build;
    }

    function getCity(array $where = [])
    {
        $build = $this->city;
        return !$where ? $build : $build->where($where);
    }

    function getDistrict(array $where = []): RefDistrict
    {
        $build = $this->district;
        if ($where) $build->where($where);
        return $build;
    }

    function getVillage(array $where = []): RefVillage
    {
        $build = $this->village;
        if ($where) $build->where($where);
        return $build;
    }

    function getUrusan(array $where = [])
    {
        $build = $this->urusan;
        if ($where) $build->where($where);
        return $build;
    }

    function getBidangUrusan(array $where = [])
    {
        $build = $this->bidangUrusan;
        if ($where) $build->where($where);
        return $build;
    }

    function getProgram(array $where = [])
    {
        $build = $this->program;
        if ($where) $build->where($where);
        return $build;
    }

    function getKegiatan(array $where = [])
    {
        $build = $this->kegiatan;
        if ($where) $build->where($where);
        return $build;
    }

    function getSubKegiatan(array $where = [])
    {
        $build = $this->subKegiatan;
        if ($where) $build->where($where);
        return $build;
    }


    function getNomenclature(Request $request)
    {
        $urusans = $this->getUrusan()->get();
        $bidangs = $this->getBidangUrusan()->get();
        $programs = RefProgram::where(['program_position' => $request->get('position')])->get();
        $kegiatans = RefKegiatan::where(['kegiatan_position' => $request->get('position')])->get();
        $subkegiatans = RefSubKegiatan::where(['subkegiatan_position' => $request->get('position')])->get();
        $data = [];
        foreach ($urusans as $urusan) {
            $dd['code'] = $urusan->urusan_code;
            $dd['name'] = $urusan->urusan_name;
            $dd['position'] = 'URUSAN';
            $data[] = $dd;
            foreach ($bidangs as $bidang) {
                if ($bidang->urusan_code == $urusan->urusan_code) {
                    $dd['code'] = $bidang->bidang_code;
                    $dd['name'] = $bidang->bidang_name;
                    $dd['position'] = 'BIDANG URUSAN';
                    $data[] = $dd;
                    foreach ($programs as $program) {
                        if ($program->bidang_code == $bidang->bidang_code) {
                            $dd['code'] = $program->program_code;
                            $dd['name'] = $program->program_name;
                            $dd['position'] = 'PROGRAM';
                            $data[] = $dd;
                            foreach ($kegiatans as $kegiatan) {
                                if ($kegiatan->program_code == $program->program_code) {
                                    $dd['code'] = $kegiatan->kegiatan_code;
                                    $dd['name'] = $kegiatan->kegiatan_name;
                                    $dd['position'] = 'KEGIATAN';
                                    $data[] = $dd;
                                    foreach ($subkegiatans as $subkegiatan) {
                                        if ($subkegiatan->kegiatan_code == $kegiatan->kegiatan_code) {
                                            $dd['code'] = $subkegiatan->subkegiatan_code;
                                            $dd['name'] = $subkegiatan->subkegiatan_name;
                                            $dd['position'] = 'SUBKEGIATAN';
                                            $data[] = $dd;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $data;
    }

    function getRegion(array $where = [])
    {
        $provinces = $this->getProvince($where)->get();
        $cities = $this->getCity($where)->get();
        $districts = $this->getDistrict($where)->get();
        $villages = $this->getVillage($where)->get();
        $data = [];
        foreach ($provinces as $province) {
            $provCode = sprintfNumber($province->prov_code, 2);
            $dd['code'] = $provCode;
            $dd['name'] = $province->prov_name;
            $dd['position'] = 'Provinsi';
            $data[] = $dd;
            foreach ($cities as $city) {
                if ($city->prov_code == $province->prov_code) {
                    $cityCode = sprintfNumber($city->city_code, 2);
                    $dd['code'] = $provCode . '.' . $cityCode;
                    $dd['name'] = $city->city_name;
                    $dd['position'] = 'Kabupaten / Kota';
                    $data[] = $dd;
                    foreach ($districts as $district) {
                        if ($district->prov_code == $province->prov_code
                            and $district->city_code == $city->city_code) {
                            $districtCode = sprintfNumber($district->district_code, 2);
                            $dd['code'] = $provCode . '.' . $cityCode . '.' . $districtCode;
                            $dd['name'] = $district->district_name;
                            $dd['position'] = 'Kecamatan';
                            $data[] = $dd;
                            foreach ($villages as $village) {
                                if ($village->prov_code == $province->prov_code
                                    and $village->city_code == $city->city_code
                                    and $village->district_code == $district->district_code
                                ) {
                                    $dd['code'] = $provCode . '.' . $cityCode . '.' . $districtCode . '.' . $village->village_code;
                                    $dd['name'] = $village->village_name;
                                    $dd['position'] = 'Kelurahan / Desa';
                                    $data[] = $dd;
                                }
                            }
                        }
                    }
                }
            }

        }
        return $data;
    }


}
