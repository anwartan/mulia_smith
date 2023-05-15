@extends('adminlte::page')

@section('title', 'Price')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Price</h1>
            </div>
        </div>
    </div>
@stop

@section('content')
    @php
        
        $heads = ['Price IDR / Gram', 'Price USD / Troy Ounce', 'Created At'];
        $data = [];
        
        foreach ($prices as $value) {
            $data[] = [$value->goldPriceIDRGram, $value->goldPriceUSD, $value->created_at];
        }
        $config = [
            'data' => $data,
            'order' => [[2, 'asc']],
            'columns' => [['orderable' => false], ['orderable' => false], ['orderable' => true]],
        ];
    @endphp
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gold Prices</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <x-adminlte-info-box title="Current Price" text="{{ round($current_price->goldPriceIDRGram) }}"
                        icon="fas fa-lg fa-coins text-dark" theme="gradient-teal" />
                    <div class="tab-content p-0">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                            <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                        </div>
                        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                            <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                        </div>
                    </div>
                    {{-- <div class="row mb-4">
                        <a class="btn btn-primary" href="{{ route('promotion.create') }}">
                            <i class="fa fa-plus"></i>
                            Add Promotion
                        </a>
                    </div> --}}


                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

@stop
@section('plugins.Chartjs', true)

@section('css')
@stop

@section('js')

    <script>
        var data = {!! $prices !!};
        var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');
        //$('#revenue-chart').get(0).getContext('2d');

        var salesChartData = {
            labels: data.map((item) => {
                return new Date(item.created_at).getDate();
            }),
            datasets: [{
                    label: 'Gold',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: 5,
                    pointHoverRadius: 10,
                    data: data.map((item) => {
                        return item.goldPriceIDRGram
                    })
                },

            ]
        }


        var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: true
            },
            title: {
                display: true,
                text: 'Gold Price Chart'
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                    }
                }]
            }
        }

        // This will get the first returned node in the jQuery collection.
        var salesChart = new Chart(salesChartCanvas, {
            type: 'line',
            data: salesChartData,
            options: salesChartOptions
        })
    </script>
@stop
