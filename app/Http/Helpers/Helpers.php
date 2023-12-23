<?php
function getMonth($month)
{
    $months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

    return $months[$month - 1];
}

function formatTime($date)
{
    return date_format(date_create($date), 'H:i');
}

function formatDate($date)
{
    $day = date_format(date_create($date), 'd');
    $month = getMonth(date_format(date_create($date), 'm'));
    $year = date_format(date_create($date), 'Y');

    return $day . ' ' . $month . ' ' . $year;
}

function formatDateTime($date)
{
    return formatDate($date) . ' | ' . formatTime($date);
}

