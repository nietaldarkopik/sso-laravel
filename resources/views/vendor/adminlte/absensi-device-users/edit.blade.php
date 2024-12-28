@extends('adminlte::page')

@section('plugins.Bootstrap4DualListbox', true)
@section('plugins.BootstrapColorpicker', true)
@section('plugins.BootstrapSlider', true)
@section('plugins.BootstrapSwitch', true)
@section('plugins.BsCustomFileInput', true)
@section('plugins.ChartJs', true)
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugins', true)
@section('plugins.Daterangepicker', true)
@section('plugins.EkkoLightbox', true)
@section('plugins.Fastclick', true)
@section('plugins.Filterizr', true)
@section('plugins.FlagIconCss', true)
@section('plugins.Flot', true)
@section('plugins.Fullcalendar', true)
@section('plugins.IcheckBootstrap', true)
@section('plugins.Inputmask', true)
@section('plugins.IonRangslider', true)
@section('plugins.JqueryKnob', true)
@section('plugins.JqueryMapael', true)
@section('plugins.JqueryUi', true)
@section('plugins.JqueryValidation', true)
@section('plugins.Jqvmap', true)
@section('plugins.Jsgrid', true)
@section('plugins.PaceProgress', true)
@section('plugins.Select2', true)
@section('plugins.Sparklines', true)
{{-- @section('plugins.Summernote', true) --}}
{{-- @section('plugins.TempusdominusBootstrap4', true) --}}
@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)

@section('title', 'Data Karyawan')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Karyawan</h1>
@stop
@section('content')
    <div class="card col-md-12">
        <div class="card-header">
            <h2 class="card-title fw-bold fs-4">Edit Karyawan</h2>
            <div class="card-tools">
                @can('admin.absensi_device_user.index')
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.absensi_device_user.index') }}">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            @include('vendor.adminlte.absensi-device-users.form-edit',['absensi_users'])
        </div>
    </div>

@endsection


@section('js')
@endsection