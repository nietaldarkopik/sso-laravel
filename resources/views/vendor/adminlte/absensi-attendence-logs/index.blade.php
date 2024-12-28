@extends('adminlte::page')

@section('plugins.Bootstrap4DualListbox', true)
@section('plugins.BootstrapColorpicker', true)
@section('plugins.BootstrapSlider', true)
@section('plugins.BootstrapSwitch', true)
@section('plugins.BsCustomFileInput', true)
@section('plugins.ChartJs', true)
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugins', true)
@section('plugins.DatatablesButton', true)
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
@section('plugins.Sweetalert2', true)
{{-- @section('plugins.TempusdominusBootstrap4', true)
@section('plugins.Toastr', true) --}}

@section('title', 'Data Log Presensi')

@section('content_header')
    <h1 class="m-0 text-dark">Data Log Presensi</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title fw-bold fs-4">Data Log Presensi</h2>
            <div class="card-tools">
                @can('admin.absensi_attendence_log.print')
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.absensi_attendence_log.print') }}" target="_blank">
                        <i class="fa fa-print" aria-hidden="true"></i> Print
                    </a>
                @endcan
                @can('admin.absensi_attendence_log.pdf')
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.absensi_attendence_log.pdf') }}" target="_blank">
                        <i class="fa fa-pdf" aria-hidden="true"></i> Print
                    </a>
                @endcan
            </div>
        </div>
        <div class="card-header py-1">
			<div class="form-row mb-0 d-flex justify-content-stretch">
                {{-- <div class="form-group mb-0 col-sm-2">
                    <label for="" class="form-label">Jenis Laporan</label>
                    <select class="form-select form-custom border py-0 text-italic-0 form-control-sm w-100 custom-select2" name="filter[kabkota_id]" id="filter-kabkota_id">
                        <option value="">Jenis Laporan ...</option>
                        <option value="harian">Harian</option>
                        <option value="bulanan">Bulanan</option>
                        <option value="tahunan">Tahunan</option>
                        <option value="range tanggal">Range Tanggal</option>
                    </select>
                </div> --}}
                <div class="form-group mb-0 col-sm-3">
                    <label for="" class="form-label">Tanggal</label>
                    <input type="text" class="form-control daterangepicker-custom" name="filter_tanggal" id="filter-tanggal">
                </div>
                <div class="form-group mb-0 col-sm-3">
                    <label for="" class="form-label">Device/Lokasi</label>
                    <select class="form-select form-custom border py-0 text-italic-0 form-control-sm w-100 custom-select2" name="filter_id_device" id="filter-id_device">
                        <option value="">Semua ...</option>
						@foreach(App\Models\AbsensiDeviceModel::get() as $i => $d)
                        <option value="{{ $d->id }}">{{ $d->device_name }} / {{ $d->location }}</option>
						@endforeach
                    </select>
                </div>
                <div class="form-group mb-0 col-sm-3">
                    <label for="" class="form-label">Karyawan</label>
                    <select class="form-select form-custom border py-0 text-italic-0 form-control-sm w-100 custom-select2" name="filter_id_user" id="filter-id_user">
                        <option value="" selected>Semua ...</option>
						@foreach(App\Models\AbsensiUserModel::get() as $i => $d)
                        <option value="{{ $d->id }}">{{ $d->nama }}</option>
						@endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <label for="" class="form-label">Aksi</label>
                    <button type="button" class="btn btn-sm form-control btn-sm btn-primary" id="search">
                        <i class="fa fa-search" aria-hidden="true"></i> Cari
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">

            @if ($message = Session::get('success'))
                <div class="alert alert-success my-2">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

			<div class="table-responsive">
				{{ $dataTable->table() }}
			</div>
        </div>
    </div>

    @include('vendor.adminlte.partials.modal.modal-default',[
        'modalId' => 'modalLgId',
        'modalSize' => 'modal-lg',
        'modalTitle' => '',
        'modalContent' => '',
        'modalFooter' => '',
    ])
@endsection

@push('css')
{{-- <style>
    .file-drop-area {
        border: 2px dashed #007bff;
        border-radius: 5px;
        padding: 30px;
        text-align: center;
        cursor: pointer;
        color: #007bff;
        transition: background-color 0.3s;
    }
    .file-drop-area.drag-over {
        background-color: #e9ecef;
    }
</style> --}}

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endpush

@push('js')

<script>

    // Register custom button type for reset
    $.fn.dataTable.ext.buttons.reset = {
        text: 'Reset',
        action: function (e, dt, node, config) {
            dt.search('').columns().search('').draw();
        }
    };
    
    // Register custom button type for reload
    $.fn.dataTable.ext.buttons.reload = {
        text: 'Reload',
        action: function (e, dt, node, config) {
            dt.ajax.reload();
        }
    };
    </script>
    
    <script src="{{ asset('vendor/datatables-searchpanes/js/dataTables.searchPanes.min.js')}}"></script>
    <script src="{{ asset('vendor/datatables-searchpanes/js/searchPanes.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('vendor/datatables-select/js/dataTables.select.min.js')}}"></script>
    <script src="{{ asset('vendor/datatables-select/js/select.bootstrap4.min.js')}}"></script>
    
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.ajax/2.1.0/leaflet.ajax.min.js"></script>
    <script>
        $(function() {
            $('[data-tooltip]').tooltip({});
            
            $('.custom-select2').select2({
                tags: true
            });
    
            $('.daterangepicker-custom').daterangepicker({
                timePicker: false,
                timePicker24Hour: true,
                locale: {
                    format: 'YYYY-MM-DD HH:mm',
                    cancelLabel: 'Kosongkan'
                },
                ranges: {
                        'Hari ini': [moment().startOf('day'), moment().endOf('day')],
                        'Kemarin': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
                        '7 hari Terakhir': [moment().subtract(6, 'days').startOf('day'), moment().endOf('day')],
                        '30 hari terakhir': [moment().subtract(29, 'days').startOf('day'), moment().endOf('day')],
                        'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
                        'Bulan Kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                        '3 Bulan Terakhir': [moment().subtract(3, 'months').startOf('month'), moment().endOf('month')],
                        '6 Bulan Terakhir': [moment().subtract(6, 'months').startOf('month'), moment().endOf('month')],
                        'Tahun Ini': [moment().startOf('year'), moment().endOf('year')],
                        'Tahun Kemarin': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                    }
            });
        });
    
        $('.daterangepicker-custom').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    
        //The search button event listener
        $('#search').on('click', function(e) {
            e.preventDefault();
            var params = {};
            var tanggal = $("#filter-tanggal").val();
            var id_device = $("#filter-id_device").val();
            var id_user = $("#filter-id_user").val();
            var tanggal_arr = tanggal.split(' - ');
            var start_date = tanggal_arr[0];
            var end_date = tanggal_arr[1];
    
            console.log(tanggal);
    
            window.LaravelDataTables["absensi-attendence-logs-table"].table()
                                                            .ajax
                                                            .url('{{ route('admin.absensi_attendence_log.index') }}?id_device='+id_device+'&id_user='+id_user+'&start_date='+start_date+'&start_date=' + start_date + '&end_date=' + end_date)
                                                            .load();
            /* window.LaravelDataTables["absensi-attendence-logs-table"].table().ajax.params ={
                start_date: start_date,
                end_date: end_date
            };
            console.log(window.LaravelDataTables["absensi-attendence-logs-table"].table().ajax.params);
            window.LaravelDataTables["absensi-attendence-logs-table"].table().ajax.data({
                start_date: start_date,
                end_date: end_date
            }).load();
            
             //window.LaravelDataTables["absensi-attendence-logs-table"].column(8).search(tahun_siteplan ? tahun_siteplan : '', false, false);
             window.LaravelDataTables["absensi-attendence-logs-table"].table().ajax.reload(); //draw(); */
        });
        
    </script>
@endpush

@section('content_top_nav_left') @endsection