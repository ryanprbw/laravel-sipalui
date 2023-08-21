<?php

namespace App\Services;


use Illuminate\Http\Request;

interface DistributionService
{

    function getDistributionDistrict(int $cityCode);

    function getDistributionVillage(int $cityCode, int $districtCode);

    function getDistrictDesilPopulation(int $cityCode);

    function getDistrictDesilFamily(int $cityCode);

    function getVillageDesilPopulation(int $cityCode, int $distinctCode);

    function getVillageDesilFamily(int $cityCode, int $distinctCode);

    function getDistributionCities(): \Illuminate\Database\Eloquent\Collection|array;

}
