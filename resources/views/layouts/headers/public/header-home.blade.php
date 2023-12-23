<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jalan Cantik
        @if (isset($title) && $title != '')
            - {{ $title }}
        @endif
    </title>

    <link rel="icon" type="image/x-icon" href="{{ asset('public/images/favicon.ico') }}">

    <!-- Fonts -->
    <link href="{{ asset('public/css/font-montserrat.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('public/css/jalan-cantik.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link href="{{ asset('public/css/leaflet/leaflet-panel-layers.css') }}" rel="stylesheet">

    <script src="{{ asset('public/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/vendor/jquery/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('public/vendor/jquery/jquery.countup.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script src="{{ asset('public/js/leaflet/leaflet-panel-layers.js') }}"></script>
    <script src="{{ asset('public/js/leaflet/leaflet.ajax.js') }}"></script>
</head>

<style>
    body {
        font-size: 14px;
        line-height: 1.75;
    }

    .card-counter {
        border-radius: 12px;
        padding: 24px 0;
        background: #fbd12d;
        color: #131313;
    }
</style>
