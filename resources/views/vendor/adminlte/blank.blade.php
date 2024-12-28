@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')
@inject('preloaderHelper', 'JeroenNoten\LaravelAdminLte\Helpers\PreloaderHelper')

@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('classes_body', '')

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    @stack('content')
    @yield('content')
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
