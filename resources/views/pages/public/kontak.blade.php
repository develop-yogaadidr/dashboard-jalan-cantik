@extends('layouts.app')

@php
    $contact = config('app.contacts');
    $items = [$contact['location'], $contact['email'], $contact['phone'], $contact['instagram'], $contact['facebook'], $contact['twitter']];
@endphp

@section('content')
    <div class="container pt-5 pb-5">
        <div class="title text-center mb-5">
            <h2>Kontak Kami</h2>
        </div>
        <x-card class="p-3">
            <div class="row">
                <div class="col-6">
                    <table style="font-size:18px;" rowspacing="10" class="mb-4">
                        @foreach ($items as $element)
                            <tr>
                                <td class="py-2 pr-3">
                                    @if ($element['icon'] != '')
                                        <i class="{{ $element['icon'] }} fa-lg mr-2"></i>
                                    @endif
                                </td>
                                <td class="py-2">
                                    @if ($element['link'] != '')
                                        <a class="link-dark" target="_blank" href="{{ $element['link'] }}">
                                            {{ $element['title'] }}
                                        </a>
                                    @else
                                        {{ $element['title'] }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <a href="{{ $contact['whatsapp']['link'] }}" target="_blank" class="btn btn-success"><i
                            class="{{ $contact['whatsapp']['icon'] }} mr-2"></i>
                        {{ $contact['whatsapp']['title'] }}</a>
                </div>
                <div class="col-6">
                    <iframe width="100%" height="400" style="border:0" loading="lazy" allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyClpmIku9wq1BhREuGbxog7qjnT9Wfm02Y&q={{ $contact['location']['data']['latitude'] }},{{ $contact['location']['data']['longitude'] }}">
                    </iframe>
                </div>
            </div>
        </x-card>
    </div>
@endsection
