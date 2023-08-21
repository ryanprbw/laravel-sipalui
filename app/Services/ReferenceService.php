<?php

namespace App\Services;


use App\Models\Assistance\AssistancePriority;
use App\Models\Reference\RefCity;
use Illuminate\Http\Request;

interface ReferenceService
{

    function getProvince(array $where = []);

    function getCity(array $where = []);

    function getDistrict(array $where = []);

    function getVillage(array $where = []);

    function getUrusan(array $where = []);

    function getBidangUrusan(array $where = []);

    function getProgram(array $where = []);

    function getKegiatan(array $where = []);

    function getSubKegiatan(array $where = []);

    function getRegion(array $where = []);

    function getNomenclature(Request $request);
}
