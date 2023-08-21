<?php

namespace App\Services;


use Illuminate\Http\Request;

interface NominationService
{

    function getNominations(array $where = []);

    function getNominationPopulations(int $year, int $cityCode, int $strategyID);

    function getNominationYearNikStrategy(int $year, string $nik, int $strategyID);

    function insertNominations(Request $request);

}
