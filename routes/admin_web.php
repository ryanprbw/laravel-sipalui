<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    include_once('admin/home.php');
    include_once('admin/assistance.php');
    include_once('admin/p3ke.php');
    include_once('admin/government.php');
    include_once('admin/user.php');
    include_once('admin/budget.php');
    include_once('admin/receiver.php');
});
include_once('admin/reference.php');
