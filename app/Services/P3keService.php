<?php

namespace App\Services;


use Illuminate\Http\Request;

interface P3keService
{

    function getFamily(Request $request);

    function getFamilyRegion(Request $request);

    function getPopulation(Request $request);

    function columnDesilPopulation();

    function columnDesilFamily();

}
