<?php

namespace App\Services;


use Illuminate\Http\Request;

interface BudgetService
{

    public function getBudgetGovernmentID(int $governmentID, array $where = []);

    public function insertUpdateBudgetGovernment(Request $request);

}
