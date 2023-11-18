@extends('layouts.app')

@php

    $contact = config('app.contacts');
    $items = [$contact['location'], $contact['email'], $contact['phone'], $contact['instagram'], $contact['facebook'], $contact['twitter']];

@endphp

@section('content')
    <div class="container pt-5 pb-5">
        <div class="title text-center">
            <h2>Kontak Kami</h2>
        </div>

        <x-card>
            <div class="row">
                <div class="col-6">
                    <ul class="list-unstyled">
                        @foreach ($items as $element)
                            <li style="font-size:18px" class="mb-4">
                                @if ($element['link'] != '')
                                    @if ($element['icon'] != '')
                                        <i class="{{ $element['icon'] }} mr-2"></i>
                                    @endif
                                    <a class="link-dark" href="{{ $element['link'] }}">
                                        {{ $element['title'] }}
                                    </a>
                                @else
                                    @if ($element['icon'] != '')
                                        <i class="{{ $element['icon'] }} mr-2"></i>
                                    @endif{{ $element['title'] }}
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-6"></div>
            </div>
        </x-card>
    </div>
@endsection
