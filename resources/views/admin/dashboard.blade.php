@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    {{-- TOP STATS --}}
    <div class="row g-4 mb-4">

        @php
        $cards = [
        ['title' => 'Current In House', 'value' => $currentInHouse, 'color' => 'primary', 'pax' => $paxInHouse],
        ['title' => 'Expected Arrivals', 'value' => $expectedArrivals, 'color' => 'danger', 'pax' => $paxArrivals],
        ['title' => 'Expected Departures', 'value' => $expectedDepartures, 'color' => 'warning', 'pax' => $paxDepartures],
        ['title' => 'End Of Day', 'value' => $endOfDay, 'color' => 'secondary', 'pax' => $paxEndOfDay],
        ];
        @endphp

        @foreach($cards as $card)
        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h6 class="text-muted">{{ $card['title'] }}</h6>
                    <h1 class="text-{{ $card['color'] }}">{{ $card['value'] }}</h1>
                    <small>Rooms</small>
                    <hr>
                    <small>Total Pax: {{ $card['pax'] }}</small>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ROOM STATUS --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">
                    Room Status
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($roomStatus as $status => $total)
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-capitalize">{{ str_replace('_',' ', $status) }}</span>
                            <span class="fw-bold">{{ $total }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- SUMMARY --}}
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">
                    Summary
                </div>
                <div class="card-body">
                    <p>✔ Pax In House: <b>{{ $paxInHouse }}</b></p>
                    <p>✔ Pax Arrivals: <b>{{ $paxArrivals }}</b></p>
                    <p>✔ Pax Departures: <b>{{ $paxDepartures }}</b></p>
                    <hr>
                    <p class="fw-bold">End Of Day Pax: {{ $paxEndOfDay }}</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection