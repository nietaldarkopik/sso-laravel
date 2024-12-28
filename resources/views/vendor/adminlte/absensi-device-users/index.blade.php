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
@section('plugins.Sweetalert2', true)
{{-- @section('plugins.TempusdominusBootstrap4', true)
@section('plugins.Toastr', true) --}}

@section('title', 'Data Karyawan di Device')

@section('content_header')
    <h1 class="m-0 text-dark">Data Karyawan di Device</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title fw-bold fs-4">Data Karyawan di Device</h2>
            <div class="card-tools">
                @can('admin.absensi_device_user.create')
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.absensi_device_user.create') }}" data-toggle="modal" data-target="#modalLgId" data-modal-title="Tambah Data">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah
                    </a>
                @endcan
            </div>
        </div>
        {{-- <div class="card-header py-1">
            {{-- <div class="form-row mb-0 d-flex justify-content-stretch">
                <div class="form-group mb-0">
                    <strong class="h5 font-weight-bold mb-0">Filter Data :</strong>
				</div>
			</div> --/}}
			{{-- <div class="form-row mb-0 d-flex justify-content-stretch">
                <div class="form-group mb-0 col-sm-2">
                    <label for="" class="form-label">Jenis Karyawan</label>
                    <select class="form-select form-control form-custom border py-0 text-italic-0 form-control-sm w-100 custom-select2" name="filter[kabkota_id]" id="filter-kabkota_id">
                        <option value="">Jenis Karyawan ...</option>
						@foreach(\App\Models\SopModel::get() as $i => $sop)
                        	<option value="{{ $sop->id }}">{{ $sop->kode}} - {{ $sop->sop}}</option>
						@endforeach
                    </select>
                </div>
                <div class="form-group mb-0 col-sm-2">
                    <label for="" class="form-label">Dari Unit</label>
                    <select class="form-select form-control form-custom border py-0 text-italic-0 form-control-sm w-100 custom-select2" name="filter[kabkota_id]" id="filter-kabkota_id">
                        <option value="" selected>Semua Unit ...</option>
						@foreach(\App\Models\UnitModel::orderBy('code')->get() as $i => $unit)
                        	<option value="{{ $unit->id }}">{{ $unit->code}} - {{ $unit->nama}}</option>
						@endforeach
                    </select>
                </div>
                <div class="form-group mb-0 col-sm-2">
                    <label for="" class="form-label">Kepada Unit</label>
                    <select class="form-select form-control form-custom border py-0 text-italic-0 form-control-sm w-100 custom-select2" name="filter[kabkota_id]" id="filter-kabkota_id">
                        <option value="" selected>Semua Unit ...</option>
						@foreach(\App\Models\UnitModel::orderBy('code')->get() as $i => $unit)
                        	<option value="{{ $unit->id }}">{{ $unit->code}} - {{ $unit->nama}}</option>
						@endforeach
                    </select>
                </div>
                <div class="form-group mb-0 col-sm-2">
                    <label for="" class="form-label">Status</label>
                    <select class="form-select form-control form-custom border py-0 text-italic-0 form-control-sm w-100 custom-select2" name="filter[kabkota_id]" id="filter-kabkota_id">
                        <option value="" selected>Status ...</option>
						@foreach(App\Models\StatusAbsensiUserModel::all() as $i => $s)
						<option value="{{$s->kode}}" style="border-color: {{$s->warna_bg}} !important; background-color: {{$s->warna_bg}} !important; color: {{$s->warna_text}} !important;">{{$s->judul}}</option>
						@endforeach
                    </select>
                </div>
                <div class="form-group mb-0 col-sm-2">
                    <label for="" class="form-label">Tanggal</label>
					<input type="text" class="form-control form-control-sm input-filter" name="filter[daterange]" placeholder="Tanggal">
                </div>
                <div class="col-auto">
                    <label for="" class="form-label">Aksi</label>
                    <button type="button" class="btn btn-sm form-control form-control-sm btn-sm btn-primary" id="search">
                        <i class="fa fa-search" aria-hidden="true"></i> Cari
                    </button>
                </div>
            </div> --/}}
        </div> --}}
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

{{ $dataTable->scripts(attributes: ['type' => 'module']) }}

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.ajax/2.1.0/leaflet.ajax.min.js"></script>
<script>
    $(function() {
        $('[data-tooltip]').tooltip({});
		
		$('.custom-select2').select2({
			tags: true
		});
    });
    
    //The search button event listener
    $('#search').on('click', function(e) {
        e.preventDefault();
        var params = {};
        var kabkota_id = $("#filter-kabkota_id").val();
        var kecamatan_id = $("#filter-kecamatan_id").val();
        var status_bast = $("#filter-status_bast").val();
        var tahun_siteplan = $("#filter-tahun_siteplan").val();

        if(!kabkota_id){
            window.LaravelDataTables["perumahans-table"].column(2).search('', false, false);
        }else{
            window.LaravelDataTables["perumahans-table"].column(2).search(kabkota_id ? kabkota_id : '', false, false);
        }
        if(!kecamatan_id){
            window.LaravelDataTables["perumahans-table"].column(3).search('', false, false);
        }else{
            window.LaravelDataTables["perumahans-table"].column(3).search(kecamatan_id ? kecamatan_id : '', false, false);
        }
        if(!status_bast){
            window.LaravelDataTables["perumahans-table"].column(12).search('', false, false);
        }else{
            window.LaravelDataTables["perumahans-table"].column(12).search(status_bast ? status_bast : '', false, false);
        }
        if(!tahun_siteplan){
            window.LaravelDataTables["perumahans-table"].column(8).search('', false, false);
        }else{
            window.LaravelDataTables["perumahans-table"].column(8).search(tahun_siteplan ? tahun_siteplan : '', false, false);
        }
        
        window.LaravelDataTables["perumahans-table"].table().draw();
    });

    function getKabupatenKotaOptions(callback){
        var url = "{{-- {{ route('admin.services.getKabupatenKota') }} --}}";

        return $.ajax({
            url: url,
            type: "get",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {},
            success: callback
        })
    }

    $("body").on("change","#filter-kabkota_id",function(){
        $("#filter-kecamatan_id").html("<option value=''>Memuat Data ...</option>");
        var val = $(this).val();
        var data = getKecamatanOptions(val,function(d){

            $("#filter-kecamatan_id").html("<option value=''>Kecamatan ...</option>");
            if(d.length > 0)
            {
                d.forEach(e => {
                    $("#filter-kecamatan_id").append("<option value='"+e.id+"'>"+e.name+"</option>");
                });
            }
        });
    });

    
    $("body").on("change","#input-kabkota_id",function(){
        $("#input-kecamatan_id").html("<option value=''>Memuat Data ...</option>");
        var val = $(this).val();
        var data = getKecamatanOptions(val,function(d){

            $("#input-kecamatan_id").html("<option value=''>Pilih Kecamatan ...</option>");
            if(d.length > 0)
            {
                d.forEach(e => {
                    $("#input-kecamatan_id").append("<option value='"+e.id+"'>"+e.name+"</option>");
                });
            }
        });
    });
    
    $("body").on("change","#input-kecamatan_id",function(){
        $("#input-kelurahan_id").html("<option value=''>Memuat Data ...</option>");
        var kecamatan_id = $(this).val();
        var kabupatenkota_id = 0;
        var data = getKelurahanOptions(kabupatenkota_id,kecamatan_id,function(d){

            $("#input-kelurahan_id").html("<option value=''>Pilih Kelurahan ...</option>");
            if(d.length > 0)
            {
                d.forEach(e => {
                    $("#input-kelurahan_id").append("<option value='"+e.id+"'>"+e.name+"</option>");
                });
            }
        });
    });
    
</script>
@endpush

@section('content_top_nav_left') @endsection