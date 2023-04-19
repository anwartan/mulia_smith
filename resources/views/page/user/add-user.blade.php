@extends('adminlte::page')

@section('title', 'Add User')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add User</h1>
            </div>
        </div>
    </div>
@stop

@section('content')
    <form enctype="multipart/form-data" action="{{ url('user') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">User</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <x-adminlte-input name="name" type="text" placeholder="Enter username" label="Username"
                                enable-old-support />
                        </div>
                        <div class="form-group">
                            <x-adminlte-input name="email" type="email" placeholder="Enter email" label="Email"
                                enable-old-support />
                        </div>
                        <div class="form-group">
                            <x-adminlte-select name="role" label="Role" enable-old-support>
                                @php
                                    $options = array_column($roles, 'name', 'value');
                                @endphp
                                <x-adminlte-options :options="$options" empty-option="Select an option..." />

                            </x-adminlte-select>
                        </div>
                        <div class="form-group">
                            <x-adminlte-input name="password" type="password" placeholder="Enter email" label="Password"
                                enable-old-support />
                        </div>
                        <div class="form-group">
                            <x-adminlte-input name="password_confirmation" type="password" placeholder="Retype password"
                                label="Password Confirmation" enable-old-support />
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="row pb-4">
            <div class="col-6">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Create New User" class="btn btn-success float-right">
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
