@extends('adminlte::blank')

@section('title', 'Data Perumahan')

@section('content_header')
    <h1 class="m-0 text-dark">Data Perumahan</h1>
@stop

@section('css')
    <style>
        body{
            background-color: unset !important;
        }
    </style>
@endsection
@section('content')
    @include('vendor.adminlte.perumahans.form-pdf')
@endsection
