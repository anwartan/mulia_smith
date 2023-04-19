@extends('adminlte::page')

@section('title', 'Edit Category')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Category</h1>
            </div>
        </div>
    </div>
@stop

@section('content')
    <form enctype="multipart/form-data" action="{{ url('category/' . $category->uuid) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Category</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <x-adminlte-input name="category_name" type="text" placeholder="Enter category name"
                                label="Category Name" enable-old-support value="{{ $category->category_name }}" />
                        </div>

                        <div class="form-group">
                            <x-adminlte-select name="status" label="Status" enable-old-support>
                                @php
                                    $options = array_column($status, 'name', 'value');
                                @endphp
                                <x-adminlte-options :options="$options" empty-option="Select an option..."
                                    selected="{{ $category->status->value }}" />

                            </x-adminlte-select>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row pb-4">
            <div class="col-6">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Edit Category" class="btn btn-success float-right">
            </div>
        </div>
    </form>
@stop

@section('css')

@stop

@section('js')
    <script></script>
@stop
