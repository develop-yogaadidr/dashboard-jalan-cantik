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

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="{{ asset('public/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('public/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

    <script src="{{ asset('public/vendor/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

</head>

<style>
    body {
        font-size: 14px;
    }

    .list-container {
        border-bottom: 1px solid #E8E8E8;
        background: #FFF;
        padding: 16px 24px;
    }

    .title {
        font-style: normal;
        font-weight: bold;
        line-height: normal;
    }

    .title-big {
        font-size: 16px;
    }

    .title-primary {
        color: #FFB444;
    }

    .text-label {
        color: #6F6F6F;
        line-height: normal;
    }

    .chip {
        height: 24px;
        flex-shrink: 0;
        border-radius: 8px;
        background: #DEDEDE;
        font-size: 14px;
        padding: 2px 12px;
    }

    .small-chip {
        font-size: 12px;
    }
</style>
