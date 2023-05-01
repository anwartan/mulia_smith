@extends('adminlte::page')

@section('title', 'Product')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Category</h1>
            </div>
        </div>
    </div>
@stop

@section('content')
    @php
        function getStatus($status): string
        {
            switch ($status) {
                case '1':
                    return 'badge-success';
                default:
                    return 'badge-danger';
            }
        }
        $heads = ['Category Code', 'Category Name', 'Status', 'Created At', 'Updated At', ['label' => 'Actions', 'no-export' => true, 'width' => 5]];
        $data = [];
        
        foreach ($categories as $value) {
            $btnEdit =
                '<a href="' .
                url("/category/{$value->uuid}/edit") .
                '" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
<i class="fa fa-lg fa-fw fa-pen"></i>
</a>';
            $btnDelete =
                '<form action="' .
                route('category.destroy', $value->uuid) .
                '" method="POST" class="d-inline-flex">
                                       ' .
                method_field('delete') .
                csrf_field() .
                '
                                        <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow"
                                            title="Delete">
                                            <i class="fa fa-lg fa-fw fa-trash"></i>
                                        </button>
                                    </form>';
            $btnDetails = '';
            $status = '<span class="badge ' . getStatus($value->status->value) . '">' . $value->status->name . '</span>';
            $data[] = [$value->category_code, $value->category_name, $status, $value->created_at, $value->updated_at, '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>'];
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
                    <h3 class="card-title">List Categories</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-4">
                        <a class="btn btn-primary" href="{{ route('category.create') }}">
                            <i class="fa fa-plus"></i>
                            Add Category
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
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
