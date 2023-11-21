@extends('layouts.app')

@section('header')
    <style>
        .header {
            height: 300px;
            width: 100vw;
            background: black;
            overflow: hidden;
            position: relative;
            background-image: url("{{ URL::to('/') . '/public/images/kantor.png' }}");
            background-position:0% 80%;
        }

        .header-image {
            width: 100vw;
            height: 100vh;
            object-fit: cover;
        }

        .header-tagline {
            position: absolute;
            width:100%;
            top:calc(50% - 21px);
            left:0;
            text-align:center;
            color: #fff;
            font-family: 'Roboto', sans-serif;
        }
    </style>
    <section class="header mb-5">
        <div class="header-tagline"><h3>{{$title}}</h3>
        </div>
    </section>
@endsection

@section('content')
    @yield('content')
@endsection
