<?php

namespace App\Services;


use Illuminate\Http\Request;

interface ReceiverService
{

    function getReceiverPriority(array $where = []);

    function findAllWhere(array $where);

    function getReceiverPriorityDT(Request $request);

    function insertReceiverPriority(Request $request);

}
