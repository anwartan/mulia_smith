@extends('adminlte::page')

@section('title', 'User')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>User</h1>
            </div>
        </div>
    </div>
@stop

@section('content')
    @php
        $heads = ['Username', 'Email', 'Role', 'Created At', 'Updated At', ['label' => 'Actions', 'no-export' => true, 'width' => 5]];
        $data = [];
        
        foreach ($users as $value) {
            $btnEdit = '';
            $btnDelete = '';
            $btnDetails = '';
            $data[] = [$value->name, $value->email, $value->role->value, $value->created_at, $value->updated_at, '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'];
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
                    <h3 class="card-title">List Users</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-4">
                        <a class="btn btn-primary" href="{{ route('user.create') }}">
                            <i class="fa fa-plus"></i>
                            Add User
                        </a>
                    </div>

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
    <script></script>
@stop
