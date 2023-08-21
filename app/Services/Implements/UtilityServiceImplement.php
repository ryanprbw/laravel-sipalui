<?php

namespace App\Services\Implements;

use App\Models\Assistance\AssistanceInnovation;
use App\Models\Assistance\AssistancePriority;
use App\Models\Utility\UtiCategoryStrategy;
use App\Models\Utility\UtiDesil;
use App\Models\Utility\UtiEducation;
use App\Models\Utility\UtiFacilityCooking;
use App\Models\Utility\UtiFacilityDefecation;
use App\Models\Utility\UtiFacilityDrinking;
use App\Models\Utility\UtiFacilityFloor;
use App\Models\Utility\UtiFacilityLighting;
use App\Models\Utility\UtiFacilityRoof;
use App\Models\Utility\UtiFacilityWall;
use App\Models\Utility\UtiFamilyHouse;
use App\Models\Utility\UtiJob;
use App\Models\Utility\UtiSourceFund;
use App\Models\Utility\UtiStatusMarry;
use App\Services\AssistanceService;
use App\Services\UtilityService;
use Illuminate\Http\Request;

class UtilityServiceImplement implements UtilityService
{

    public function __construct(
        private UtiSourceFund         $utiSourceFund,
        private UtiDesil              $utiDesil,
        private UtiFacilityCooking    $facilityCooking,
        private UtiFacilityDefecation $facilityDefecation,
        private UtiFacilityDrinking   $facilityDrinking,
        private UtiFacilityFloor      $facilityFloor,
        private UtiFacilityLighting   $facilityLighting,
        private UtiFacilityRoof       $facilityRoof,
        private UtiFacilityWall       $facilityWall,
        private UtiFamilyHouse        $familyHouse,
        private UtiEducation          $education,
        private UtiCategoryStrategy   $categoryStrategy,
        private UtiJob                $job,
        private UtiStatusMarry        $statusMarry,

    )
    {
    }

    function getUtiSourceFund(array $where = [])
    {
        $build = $this->utiSourceFund;
        return !$where ? $build : $build->where($where);
    }

    function getDesil(array $where = [])
    {
        $build = $this->utiDesil;
        return !$where ? $build : $build->where($where);
    }

    function getDesilWhereIn(string $field, array $where)
    {
        return $this->utiDesil->whereIn($field, $where);
    }

    function getFamilyHouse(array $where = [])
    {
        $build = $this->familyHouse;
        return !$where ? $build : $build->where($where);
    }

    function getFacilityCooking(array $where = [])
    {
        $build = $this->facilityCooking;
        return !$where ? $build : $build->where($where);
    }

    function getFacilityDefecation(array $where = [])
    {
        $build = $this->facilityDefecation;
        return !$where ? $build : $build->where($where);
    }

    function getFacilityDrinking(array $where = [])
    {
        $build = $this->facilityDrinking;
        return !$where ? $build : $build->where($where);
    }

    function getFacilityFloor(array $where = [])
    {
        $build = $this->facilityFloor;
        return !$where ? $build : $build->where($where);
    }

    function getFacilityLighting(array $where = [])
    {
        $build = $this->facilityLighting;
        return !$where ? $build : $build->where($where);
    }

    function getFacilityRoof(array $where = [])
    {
        $build = $this->facilityRoof;
        return !$where ? $build : $build->where($where);
    }

    function getFacilityWall(array $where = [])
    {
        $build = $this->facilityWall;
        return !$where ? $build : $build->where($where);
    }

    function getEducation(array $where = [])
    {
        $build = $this->education;
        return !$where ? $build : $build->where($where);
    }

    function getCategoryStrategy(array $where = [])
    {
        $build = $this->categoryStrategy;
        return !$where ? $build : $build->where($where);
    }

    function getJob(array $where = [])
    {
        $build = $this->job;
        return !$where ? $build : $build->where($where);
    }

    function getStatusMerry(array $where = [])
    {
        $build = $this->statusMarry;
        return !$where ? $build : $build->where($where);
    }
}
