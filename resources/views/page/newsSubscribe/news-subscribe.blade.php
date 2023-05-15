@extends('adminlte::page')

@section('title', 'News Subscribe')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>News Subscribe</h1>
            </div>
        </div>
    </div>
@stop

@section('content')
    @php
        
        $heads = ['Name', 'Email', 'Created At', 'Updated At'];
        $data = [];
        
        foreach ($newsSubscribe as $value) {
            $data[] = [$value->name, $value->email, $value->created_at, $value->updated_at];
        }
        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
    @endphp
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List News Subscribe</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">


                    <x-adminlte-datatable id="table1" :heads="$heads" with-footer>
                        @foreach ($config['data'] as $row)
                            <tr>
                                @foreach ($row as $cell)
                                    <td>{!! $cell !!}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </x-adminlte-datatable>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

@stop

@section('css')
@stop

@section('js')
    <script>
    </script>
@stop
