@extends('adminlte::page')

@section('title', 'Edit Promotion')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Promotion</h1>
            </div>
        </div>
    </div>
@stop

@section('content')
    <form enctype="multipart/form-data" action="{{ url('promotion/' . $promotion->uuid) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Promotion</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <x-adminlte-input name="promotion_title" type="text" placeholder="Enter promotion title"
                                label="Category Name" enable-old-support value="{{ $promotion->promotion_title }}" />
                        </div>
                        <div class="form-group">
                            <x-adminlte-input name="promotion_description" type="text"
                                placeholder="Enter promotion description" label="Category Name" enable-old-support
                                value="{{ $promotion->promotion_description }}" />
                        </div>
                        <div class="form-group">
                            <x-adminlte-input name="promotion_url" id="promotion_url" label="Promotion Url"
                                placeholder="Enter promotion url" igroup-size="sm" enable-old-support
                                value="{{ $promotion->promotion_url }}">

                                <x-slot name="appendSlot">
                                    <x-adminlte-button theme="info" label="Open Link" class="openLink"
                                        data-input-id="promotion_url" />
                                </x-slot>
                            </x-adminlte-input>

                        </div>
                        <div class="form-group">
                            <x-adminlte-input-file enable-old-support label="Promotion Image"
                                accept="image/png, image/gif, image/jpeg" name="promotion_image_url"
                                placeholder="Choose promotion image">
                            </x-adminlte-input-file>
                        </div>

                        <div class="form-group">
                            <x-adminlte-select name="status" label="Status" enable-old-support>
                                @php
                                    $options = array_column($status, 'name', 'value');
                                @endphp
                                <x-adminlte-options :options="$options" empty-option="Select an option..."
                                    selected="{{ $promotion->status->value }}" />

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
