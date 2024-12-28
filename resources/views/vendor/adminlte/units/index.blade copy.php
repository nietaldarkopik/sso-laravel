@extends('adminlte::page')

@section('plugins.Bootstrap4DualListbox', false)
@section('plugins.BootstrapColorpicker', false)
@section('plugins.BootstrapSlider', false)
@section('plugins.BootstrapSwitch', false)
@section('plugins.BsCustomFileInput', false)
@section('plugins.ChartJs', false)
@section('plugins.Datatables', false)
@section('plugins.DatatablesPlugins', false)
@section('plugins.Daterangepicker', false)
@section('plugins.EkkoLightbox', false)
@section('plugins.Fastclick', false)
@section('plugins.Filterizr', false)
@section('plugins.FlagIconCss', false)
@section('plugins.Flot', false)
@section('plugins.Fullcalendar', false)
@section('plugins.IcheckBootstrap', false)
@section('plugins.Inputmask', false)
@section('plugins.IonRangslider', false)
@section('plugins.JqueryKnob', false)
@section('plugins.JqueryMapael', false)
@section('plugins.JqueryUi', false)
@section('plugins.JqueryValidation', false)
@section('plugins.Jqvmap', false)
@section('plugins.Jsgrid', false)
@section('plugins.PaceProgress', false)
@section('plugins.Select2', false)
@section('plugins.Sparklines', false)
{{-- @section('plugins.Summernote', false) --}}
@section('plugins.Sweetalert2', false)
{{-- @section('plugins.TempusdominusBootstrap4', false)
@section('plugins.Toastr', false) --}}

@section('title', 'Data Unit')

@section('content_header')
    <h1 class="m-0 text-dark">Data Unit</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title fw-bold fs-4">Data Unit</h2>
            <div class="card-tools">
                @can('admin.unit.create')
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.unit.create') }}" data-toggle="modal" data-target="#modalLgId" data-modal-title="Tambah Data">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah
                    </a>
                @endcan
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

            {{ $dataTable->table() }}
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-treetable/css/jquery.treetable.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-treetable/css/jquery.treetable.theme.default.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<style>
    .indented { padding-left: 20px; }
</style>
@endpush

@push('js')

{{ $dataTable->scripts(attributes: ['type' => 'module']) }}

<script src="https://cdn.jsdelivr.net/npm/jquery-treetable/jquery.treetable.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.ajax/2.1.0/leaflet.ajax.min.js"></script>
<script>
    $(function() {
        $('[data-tooltip]').tooltip({})
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
    
    // Fungsi untuk menambahkan file ke daftar
    function addFileToList(file,clickableElements,response) {
        response = JSON.parse(response);
        if(!response.id){
            return false;
        }
        var url = "{{-- {{ route('admin.psuperumahan.getPsuItem',['PsuUnit' => 'xx'])}} --}}";
        var fileListUl = $(clickableElements).closest('.card-psu-list').find('.file-list-psu');
        url = url.replace('xx',response.id);

        $.ajax({
            url: url,
            type: "get",
            dataType: "html",
            success:function(msg){
                $(fileListUl).prepend(msg);
            }
        })
    }

    function savePsuDetail(form,id,callback) {
        var url = "{{-- {{ route('admin.psuperumahan.updatePsuItem',['PsuUnit' => 'xx'])}} --}}";
        url = url.replace('xx',id);

        form.append('_method','patch');

        $.ajax({
            url: url,
            processData: false,
            contentType: false,
            type: 'POST',
            data: form,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: callback
        })
    }

    function addFileToListDokumen(path,clickableElements,response){
        // Load GeoJSON data
        //var geojsonLayer = new L.GeoJSON.AJAX(path); // Ganti path dengan path GeoJSON Anda
        //geojsonLayer.addTo(map);
        response = JSON.parse(response);
        var url = "{{ asset(Storage::url('xxx'))}}";
        url = url.replace('xxx',response.nama_file);
        $(".file-list-dokumen").prepend('<li class="list-group-item row d-flex">' +
                                        '    <div class="col-sm-5">' +
                                                response.judul_file +
                                        '    </div>' +
                                        '    <div class="col-sm-5">' +
                                                response.judul_file +
                                        '    </div>' +
                                        '    <div class="col-sm-2">' +
                                        '        <a href="' + url + '" target="_blank" class="btn btn-primary btn-sm">' +
                                        '            <i class="fa fa-eye" aria-hidden="true"></i>' +
                                        '        </a>' +
                                        '        <button type="button" class="btn btn-danger btn-sm">' +
                                        '            <i class="fa fa-trash" aria-hidden="true"></i>' +
                                        '        </button>' +
                                        '    </div>' +
                                        '</li>');
    }

    function addFileToMap(path,clickableElements,response){
        // Load GeoJSON data
        //var geojsonLayer = new L.GeoJSON.AJAX(path); // Ganti path dengan path GeoJSON Anda
        //geojsonLayer.addTo(map);
        $(".file-list-map").prepend('<li class="list-group-item">'+path.name+'</li>');
    }

    function addFileToListMap(path,clickableElements,response){
        // Load GeoJSON data
        //var geojsonLayer = new L.GeoJSON.AJAX(path); // Ganti path dengan path GeoJSON Anda
        //geojsonLayer.addTo(map);
        $(".file-list-map").prepend('<li class="list-group-item">'+path.name+'</li>');
    }

    $("body").on("change",".card-psu-item :input",function(){
        if($(this).closest(".card-psu-item").length > 0)
        {
            $(this).closest(".card-psu-item").find(".btn-save-psu-container").removeClass("d-none").addClass("d-flex");
        }
    });

    $("body").on("click",".btn-cancel-psu",function(){
        if($(this).closest(".card-psu-item").length > 0)
        {
            $(this).closest(".card-psu-item").find(".btn-save-psu-container").removeClass("d-flex").addClass("d-none");
        }
    })

    $("body").on("click",".btn-save-psu",function(){
        var form = $(this).closest('form')[0];
        var id = $(this).data('id');
        var card = $(this).closest(".card-psu-item");
        formData = new FormData();
        var input = $(this).closest(".card-psu-item").find(":input");
        $.each(input,function(i,v){
            formData.append($(v).attr("name"),$(v).val());
        });
        savePsuDetail(formData,id,function(){
            if($(card).length > 0)
            {
                $(card).find(".btn-save-psu-container").removeClass("d-flex").addClass("d-none");
            }
            alert("Data Berhasil disimpan");
        });
    });
    
    $("body").on("click","[name='id_psu']",function(){
        var id = $(this).data('id');
        var id_psu = $(this).val();
        var card = $(this).closest(".card-psu-item");
        var url = "{{-- {{ route('admin.psuperumahan.getPsuAttributeForm',['PsuUnit' => 'xx','PSU' => 'yy'])}} --}}";
        url = url.replace('xx',id);
        url = url.replace('yy',id_psu);

        $.ajax({
            url: url,
            type: 'get',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            dataType: 'html',
            success:function(msg){
                $(card).find(".attribute-psu-container").html(msg);
            }
        })
    })
</script>
@endpush
