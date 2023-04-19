@extends('adminlte::page')

@section('title', 'Add Product')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Project Add</h1>
            </div>
        </div>
    </div>
@stop

@section('content')
    <form enctype="multipart/form-data" action="{{ url('product') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Product</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <x-adminlte-input name="product_name" type="text" placeholder="Enter product name"
                                label="Product Name" enable-old-support />
                        </div>

                        <div class="form-group">
                            <x-adminlte-select name="status" label="Status" enable-old-support>
                                @php
                                    $options = array_column($status, 'name', 'value');
                                @endphp
                                <x-adminlte-options :options="$options" empty-option="Select an option..." />

                            </x-adminlte-select>


                        </div>
                        <div class="form-group">
                            <x-adminlte-input name="link_url_shopee" id="link_url_shopee" label="Link Shopee Url"
                                placeholder="Enter link shopee url" igroup-size="sm" enable-old-support>

                                <x-slot name="appendSlot">
                                    <x-adminlte-button theme="info" label="Open Link" class="openLink"
                                        data-input-id="link_url_shopee" />
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="form-group">
                            <x-adminlte-input name="link_url_tokopedia" id="link_url_tokopedia" label="Link Tokopedia Url"
                                placeholder="Enter link tokopedia url" igroup-size="sm" enable-old-support>

                                <x-slot name="appendSlot">
                                    <x-adminlte-button theme="info" label="Open Link" class="openLink"
                                        data-input-id="link_url_tokopedia" />
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="form-group">
                            <x-adminlte-input-file enable-old-support label="image"
                                accept="image/png, image/gif, image/jpeg" name="image_path" id="image_path"
                                placeholder="Choose Image">
                            </x-adminlte-input-file>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Product Description</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            @php
                                $config = [
                                    'height' => '200',
                                ];
                            @endphp
                            <x-adminlte-text-editor name="product_description" :config="$config" label="Product Description"
                                enable-old-support />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-12">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Create New Product" class="btn btn-success float-right">
            </div>
        </div>
    </form>
@stop
@section('plugins.Summernote', true)
@section('plugins.BsCustomFileInput', true)

@section('css')

@stop

@section('js')
    <script>
        $(function() {
            $(".openLink").click(function(elem) {

                var id = $(this).attr('data-input-id')
                var link = $(`#${id}`).val()

                window.open(link, "_blank")
            })
        })
    </script>
@stop
