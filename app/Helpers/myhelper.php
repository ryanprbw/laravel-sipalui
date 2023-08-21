<?php

use JetBrains\PhpStorm\Pure;

function btnAction($action = '', $attrBtn = '', $labelBtn = '', $classBtn = '', $typeBtn = '', $icon = ''): string
{
    switch ($action) {
        case 'back':
            $type = 'danger-gradien';
            $iconBtn = 'backward';
            break;
        case 'update':
            $type = 'warning-gradien';
            $iconBtn = 'pencil';
            break;
        case 'delete':
            $type = 'danger-gradien';
            $iconBtn = 'trash';
            break;
        case 'save':
            $type = 'primary-gradien';
            $iconBtn = 'save';
            break;
        case 'search':
            $type = 'primary-gradien';
            $iconBtn = 'search';
            break;
        case 'posting':
            $type = 'danger-gradien';
            $iconBtn = 'send';
            break;
        case 'print':
            $type = 'warning-gradien';
            $iconBtn = 'print';
            break;
        case 'add' || 'plus':
            $type = 'primary-gradien';
            $iconBtn = 'plus-circle';
            break;
        default:
            $type = 'dark-gradien';
            $iconBtn = '';
            break;
    }
    $icon = $icon ?: $iconBtn;
    $typeBtn = $typeBtn ?: $type;
    return "<button $attrBtn class='btn btn-$typeBtn btn-sm $classBtn'><i class='bi bi-$icon me-0'></i> $labelBtn</button>";
}


function numberFormat(int $number, $decimals = 0): string
{
    return number_format($number, $decimals, ',', '.');
}

function formatDateIndo(string $date = null): string
{
    return $date ? \Carbon\Carbon::parse($date)->format('d-m-Y') : '';
}

function calculateAge(string $date = null): string
{
    return $date ? \Carbon\Carbon::parse($date)->age : '';
}

function formatDateMonthIndo($date): string
{
    if (!$date) return 'NULL';
    $day = day($date);
    $month = nameMonthIndo(month($date));
    $year = year($date);
    return $day . ' ' . $month . ' ' . $year;
}

function day($date): string
{
    return date("d", strtotime($date));
}

function month($date): string
{
    return date("m", strtotime($date));
}

function year($date): string
{
    return date("Y", strtotime($date));
}

function startYear(): int
{
    return date('Y');
}

function nameMonthIndo(int $month): string
{
    return match ($month) {
        1 => "Januari",
        2 => "Februari",
        3 => "Maret",
        4 => "April",
        5 => "Mei",
        6 => "Juni",
        7 => "Juli",
        8 => "Agustus",
        9 => "September",
        10 => "Oktober",
        11 => "November",
        12 => "Desember",
        default => 'NULL'
    };
}

function nameDayIndo($date): string
{
    $day = day($date);
    $month = month($date);
    $year = year($date);
    $nameDay = date("l", mktime(0, 0, 0, $month, $day, $year));
    return match ($nameDay) {
        "Sunday" => "Minggu",
        "Monday" => "Senin",
        "Tuesday" => "Selasa",
        "Wednesday" => "Rabu",
        "Thursday" => "Kamis",
        "Friday" => "Jum'at",
        "Saturday" => "Sabtu",
        default => 'NULL',
    };
}

function sprintfNumber(int $number, int $length = 3): string
{
    return sprintf("%'.0" . $length . "s", $number);
}

function sptNumber(int $number): string
{
    $number = sprintfNumber($number);
    return "090/{$number}/Disnakertrans/LK3";
}

function isoIecNumber(): string
{
    return "SNI ISO/IEC 17025:2008";
}

function spkNumber(int $number): string
{
    $number = sprintfNumber($number, 3);
    return "566/SPK.{$number}/Disnakertrans/LK3";
}

function lastOfMonth($year, $month)
{
    return date("Y-m-d", strtotime('-1 second', strtotime('+1 month', strtotime($month . '/01/' . $year . ' 00:00:00'))));
}

function convertNumber($value): string
{
    $value = abs($value);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($value < 12) {
        $temp = " " . $huruf[$value];
    } else if ($value < 20) {
        $temp = convertNumber($value - 10) . " belas";
    } else if ($value < 100) {
        $temp = convertNumber((int)($value / 10)) . " puluh" . convertNumber($value % 10);
    } else if ($value < 200) {
        $temp = " seratus" . convertNumber($value - 100);
    } else if ($value < 1000) {
        $temp = convertNumber((int)($value / 100)) . " ratus" . convertNumber($value % 100);
    } else if ($value < 2000) {
        $temp = " seribu" . convertNumber($value - 1000);
    } else if ($value < 1000000) {
        $temp = convertNumber((int)($value / 1000)) . " ribu" . convertNumber($value % 1000);
    } else if ($value < 1000000000) {
        $temp = convertNumber((int)($value / 1000000)) . " juta" . convertNumber($value % 1000000);
    } else if ($value < 1000000000000) {
        $temp = convertNumber((int)($value / 1000000000)) . " milyar" . convertNumber(fmod($value, 1000000000));
    } else if ($value < 1000000000000000) {
        $temp = convertNumber((int)($value / 1000000000000)) . " trilyun" . convertNumber(fmod($value, 1000000000000));
    }
    return ucwords($temp);
}

function hideNIK($nik, $offset = 8, $rand = false)
{
    $count = (strlen($nik) - $offset);
    return substr_replace($nik, str_repeat('*', $count), $rand ? mt_rand(0, $offset) : $offset, $count);
}
