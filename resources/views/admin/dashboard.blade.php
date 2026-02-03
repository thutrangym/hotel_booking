@extends('layouts.app')

@section('content')
<div class="container-fluid my-4">

    <h3 class="fw-bold mb-4">Hotel Management Dashboard</h3>

    {{-- ================= KPI TILES ================= --}}
    <div class="row g-4 mb-4">

        @php
        $tiles = [
        ['title'=>'Current In Rooms','value'=>$currentRoomsCount,'sub'=>$currentPax.' Pax','color'=>'primary'],
        ['title'=>'Expected Arrivals','value'=>$arrivalRooms,'sub'=>$arrivalPax.' Pax','color'=>'warning'],
        ['title'=>'Expected Departures','value'=>$departureRooms,'sub'=>$departurePax.' Pax','color'=>'danger'],
        ['title'=>'End Of Day Forecast','value'=>$endDayRooms,'sub'=>$endDayPax.' Pax','color'=>'success'],
        ];
        @endphp

        @foreach($tiles as $tile)
        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-center">
                <div class="card-body">
                    <h6 class="text-muted">{{ $tile['title'] }}</h6>
                    <h2 class="fw-bold text-{{ $tile['color'] }}">{{ $tile['value'] }}</h2>
                    <p class="mb-0">{{ $tile['sub'] }}</p>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    {{-- ================= CURRENT STATUS TABLE ================= --}}
    <div class="card shadow border-0 mb-4">
        <div class="card-header fw-bold">Current Status</div>
        <div class="card-body">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Stage</th>
                        <th>Rooms</th>
                        <th>Pax</th>
                        <th>Occupancy (%)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Start Of Day</td>
                        <td>{{ $currentRoomsCount }}</td>
                        <td>{{ $currentPax }}</td>
                        <td>{{ round($currentRoomsCount / max($totalRooms,1) * 100) }}%</td>
                    </tr>
                    <tr>
                        <td>Guests Checked-in</td>
                        <td>{{ $arrivalRooms }}</td>
                        <td>{{ $arrivalPax }}</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Guests Checked-out</td>
                        <td>{{ $departureRooms }}</td>
                        <td>{{ $departurePax }}</td>
                        <td>-</td>
                    </tr>
                    <tr class="fw-bold">
                        <td>End Of Day (Forecast)</td>
                        <td>{{ $endDayRooms }}</td>
                        <td>{{ $endDayPax }}</td>
                        <td>{{ round($endDayRooms / max($totalRooms,1) * 100) }}%</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= CHARTS ================= --}}

    <div class="d-flex justify-content-end mb-2">
        <div class="btn-group" role="group" aria-label="Range filter">
            <button type="button" class="btn btn-outline-secondary btn-sm range-btn" data-range="day">Day</button>
            <button type="button" class="btn btn-outline-secondary btn-sm range-btn active" data-range="week">Week</button>
            <button type="button" class="btn btn-outline-secondary btn-sm range-btn" data-range="month">Month</button>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-header fw-bold">Room Status</div>
                <div class="card-body">
                    <canvas id="roomStatusChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header fw-bold">Revenue</div>
                <div class="card-body">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- ================= CHART JS ================= --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roomCtx = document.getElementById('roomStatusChart').getContext('2d');
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');

        let roomChart = new Chart(roomCtx, {
            type: 'pie',
            data: {
                labels: ['Ready', 'Expected', 'Checked In'],
                datasets: [{
                    data: [0, 0, 0],
                    backgroundColor: ['#4CAF50', '#FFC107', '#2196F3']
                }]
            },
            options: {
                responsive: true
            }
        });

        let revenueChart = new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Revenue',
                    data: [],
                    backgroundColor: '#0d6efd'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Fetch and update charts
        async function loadStats(range = 'week') {
            try {
                const res = await fetch(`{{ url('/admin/dashboard/stats') }}?range=${range}`);
                const json = await res.json();

                // Update room chart
                const rs = json.roomStatus;
                roomChart.data.datasets[0].data = [rs.ready, rs.expected, rs.checkedIn];
                roomChart.update();

                // Update revenue chart
                const labels = json.revenue.labels.map(l => {
                    // Format label for readability
                    if (json.range === 'day') return l; // hours like '00:00'
                    return new Date(l + 'T00:00:00').toLocaleDateString();
                });

                revenueChart.data.labels = labels;
                revenueChart.data.datasets[0].data = json.revenue.data;
                revenueChart.update();
            } catch (err) {
                console.error('Failed to load stats', err);
            }
        }

        // Wire up range buttons
        document.querySelectorAll('.range-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.range-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                loadStats(this.dataset.range);
            });
        });

        // Initial load
        loadStats('week');
    });
</script>

@endsection