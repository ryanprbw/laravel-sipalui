<?php

namespace App\Services;


use Illuminate\Http\Request;

interface StrategyService
{

    public function getStrategy(string $cityCode = '');


}
