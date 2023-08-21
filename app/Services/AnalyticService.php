<?php

namespace App\Services;


use App\Models\Assistance\AssistancePriority;
use Illuminate\Http\Request;

interface AnalyticService
{

    function getDistrictAssistanceDesil(int $cityCode, int $year, array $assistanceIDs, array $desilID): \Illuminate\Database\Eloquent\Collection|array;

    function getCityAssistanceDesil(int $year): \Illuminate\Database\Eloquent\Collection|array;

    function getFacilityPopulation(Request $request): \Illuminate\Database\Eloquent\Collection|array;

    function getStrategyPopulation(Request $request): \Illuminate\Database\Eloquent\Collection|array;

}
