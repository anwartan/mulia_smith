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
    <form enctype="multipart/form-data" action="{{ url('product/' . $product->sku) }}" method="POST">
        @csrf
        @method('PUT')
        @if (session('business_exception'))
            {{ session('business_exception') }}
        @endif
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
                                label="Product Name" enable-old-support value="{{ $product->product_name }}" />
                        </div>

                        <x-adminlte-select2 name="category_id" label="Category Product">
                            <option value="0">Select an option...</option>
                            @foreach ($categories as $item)
                                <option @if ($item->id == $product->category_id) selected @endif value="{{ $item->id }}">
                                    {{ $item->category_name }}</option>
                            @endforeach
                        </x-adminlte-select2>

                        <div class="form-group">
                            <x-adminlte-select name="status" label="Status" enable-old-support>
                                @php
                                    $options = array_column($status, 'name', 'value');
                                @endphp
                                <x-adminlte-options :options="$options" empty-option="Select an option..."
                                    selected="{{ $product->status->value }}" />

                            </x-adminlte-select>


                        </div>
                        <div class="form-group">
                            <x-adminlte-input name="link_url_shopee" id="link_url_shopee" label="Link Shopee Url"
                                placeholder="Enter link shopee url" igroup-size="sm" enable-old-support
                                value="{{ $product->link_url_shopee }}">

                                <x-slot name="appendSlot">
                                    <x-adminlte-button theme="info" label="Open Link" class="openLink"
                                        data-input-id="link_url_shopee" />
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="form-group">
                            <x-adminlte-input name="link_url_tokopedia" id="link_url_tokopedia" label="Link Tokopedia Url"
                                placeholder="Enter link tokopedia url" igroup-size="sm" enable-old-support
                                value="{{ $product->link_url_tokopedia }}">

                                <x-slot name="appendSlot">
                                    <x-adminlte-button theme="info" label="Open Link" class="openLink"
                                        data-input-id="link_url_tokopedia" />
                                </x-slot>
                            </x-adminlte-input>
                        </div>
                        <div class="form-group">
                            <x-adminlte-input-file enable-old-support label="Image"
                                accept="image/png, image/gif, image/jpeg" name="image_path" id="image_path"
                                placeholder="Choose Image">
                            </x-adminlte-input-file>
                            @php
                                $data = [$product->image_path];
                            @endphp
                            <x-file-viewer name="old_image_path" file="{{ $product->image_path }}"
                                path="{{ $product->full_image_path }}"></x-file-viewer>
                        </div>


                        <div class="form-group">
                            <x-adminlte-textarea name="product_summary" placeholder="Insert Summary..."
                                label="Product Summary">{{ $product->product_summary }}</x-adminlte-textarea>
                        </div>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Product Additional Info</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="width: 1%"><button type="button" class="btn btn-primary btn-sm"
                                            id="add-row-btn">
                                            <i class="fas fa-plus"></i></button>
                                    </th>
                                    <th>Label</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="product_additional_info_sample" class="product_additional_info d-none">
                                    <td style="width: 1%">
                                        <button class="btn btn-danger btn-sm" type="button">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <x-adminlte-input name="label" type="text" placeholder="Enter label"
                                            enable-old-support />
                                    </td>
                                    <td>
                                        <x-adminlte-input name="value" type="text" placeholder="Enter value"
                                            enable-old-support />
                                    </td>
                                    <input type="hidden" name="mode">
                                    <input type="hidden" name="id" value="">
                                </tr>
                                @foreach ($product->productAdditionalInfos as $index => $item)
                                    <tr class="product_additional_info">
                                        <td style="width: 1%">
                                            <button class="btn btn-danger btn-sm" type="button">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <x-adminlte-input name="product_additional_info[{{ $index }}][label]"
                                                type="text" placeholder="Enter label" enable-old-support
                                                value="{{ $item->label }}" />
                                        </td>
                                        <td>
                                            <x-adminlte-input name="product_additional_info[{{ $index }}][value]"
                                                type="text" placeholder="Enter value" enable-old-support
                                                value="{{ $item->value }}" />
                                        </td>
                                        <input type="hidden" name="product_additional_info[{{ $index }}][id]"
                                            value="{{ $item->id }}" />
                                        <input type="hidden" name="product_additional_info[{{ $index }}][mode]"
                                            value="VIEW" />
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Product Sales</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <x-adminlte-input id="product_weight" name="product_sale[weight]" type="number"
                                placeholder="Enter product weight" label="Product Weight (gram)" enable-old-support
                                min="0" step="0.01" value="0.00"
                                value="{{ $product->productSale->weight }}" />
                        </div>
                        <div class="form-group">
                            <x-adminlte-input id="product_cost" name="product_sale[cost]" type="number"
                                placeholder="Enter product cost" value="0" label="Product Cost (cost/gram)"
                                enable-old-support value="{{ $product->productSale->cost }}" />
                        </div>
                    </div>
                </div>
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
                            <x-adminlte-text-editor name="product_description" :config="$config"
                                label="Product Description" enable-old-support>
                                {{ $product->product_description }}
                            </x-adminlte-text-editor>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pb-4">
            <div class="col-12">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Edit Product" class="btn btn-success float-right">
            </div>
        </div>
    </form>
@stop
@section('plugins.Summernote', true)
@section('plugins.BsCustomFileInput', true)
@section('plugins.Select2', true)
@section('css')

@stop

@section('js')
    @php
        
        $count = count($product->productAdditionalInfos);
    @endphp
    <script>
        $(function() {
            $(".openLink").click(function(elem) {

                var id = $(this).attr('data-input-id')
                var link = $(`#${id}`).val()

                window.open(link, "_blank")
            })
            var rowCount = {!! json_encode($count) !!};
            $("#add-row-btn").click(function() {
                console.log("hello")

                const newRow = $("#product_additional_info_sample").clone();
                newRow.removeClass("d-none")
                $(newRow).find("input[name=mode]").val("CREATE")
                $(newRow).find('input').each(function() {
                    if ($(this).is("input")) {
                        var nameTmp =
                            `product_additional_info[${rowCount}][${$(this).attr("name")}]`
                        $(this).attr("name", nameTmp)
                    }
                })
                $(newRow).find(".btn-danger").click(deleteAction)
                $("table tbody").append(newRow);
                rowCount++;
            })

            $('.product_additional_info').on('change', 'input[name^="product_additional_info"]', function() {
                console.log($(this))
                let tr = $(this).closest('tr');
                tr.find('input[name$="[mode]"]').val('EDIT');
            });


            $('.product_additional_info').on('click', '.btn-danger', deleteAction);

            function deleteAction() {
                const row = $(this).closest('tr');
                row.remove();
            }

            $('#product_weight').change(setTwoNumberDecimal);

            function setTwoNumberDecimal(event) {
                this.value = parseFloat(this.value).toFixed(2);
            }
        })
    </script>
@stop
