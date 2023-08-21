<?php

namespace App\Services;


interface UtilityService
{
    function getUtiSourceFund(array $where = []);

    function getDesil(array $where = []);

    function getDesilWhereIn(string $field, array $where);

    function getFamilyHouse(array $where = []);

    function getFacilityCooking(array $where = []);

    function getFacilityDefecation(array $where = []);

    function getFacilityDrinking(array $where = []);

    function getFacilityFloor(array $where = []);

    function getFacilityLighting(array $where = []);

    function getFacilityRoof(array $where = []);

    function getFacilityWall(array $where = []);

    function getEducation(array $where = []);

    function getCategoryStrategy(array $where = []);

    function getJob(array $where = []);

    function getStatusMerry(array $where = []);

}
