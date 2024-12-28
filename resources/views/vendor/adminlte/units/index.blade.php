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
@section('plugins.JqueryUi', true)
@section('plugins.JqueryValidation', false)
@section('plugins.Jqvmap', false)
@section('plugins.Jsgrid', false)
@section('plugins.PaceProgress', false)
@section('plugins.Select2', false)
@section('plugins.Sparklines', false)
@section('plugins.Sweetalert2', false)
@section('plugins.Toastr', true)
{{-- @section('plugins.Summernote', false) --}}
{{-- @section('plugins.TempusdominusBootstrap4', false) --}}

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
                    <button type="button" class="btn btn-sm btn-primary btn-generate-code" >
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Generate Kode
                    </button>
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.unit.create') }}" data-toggle="modal"
                        data-target="#modalLgId" data-modal-title="Tambah Data">
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
			
			@include('vendor.adminlte.partials.widgets.accordion',['data' => \App\Models\UnitModel::where(function($query){
				$query->whereNull('parent_code');
				$query->orWhere('parent_code','0');
			})->orderBy('sort_order','asc')->get(), 'title' => 'nama', 'parent_id' => 'parent_code', 'child_id' => 'code', 'node' => 0, 'node_level' => 0])

			<div class="row">
				<div class="col-12" id="accordion-sort">

				</div>
			</div>
        </div>
    </div>

    @include('vendor.adminlte.partials.modal.modal-default', [
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
        .indented {
            padding-left: 20px;
        }
		.card-sortable {
			min-height: 20px;
			list-style-type: none;
			padding: 5px;
		}
		.card-sortable .card-sortable {
			padding: 5px;
		}
		.ui-state-highlight{
			background: rgba(255, 208, 0, 0.697);
			min-height: 20px;
		}
		.icon-expand{
			display: none;
		}
		.icon-collapse{
			display: inline-block;
		}
		.collapsed .icon-expand{
			display: inline-block;
		}
		.collapsed .icon-collapse{
			display: none;
		}
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery-treetable/jquery.treetable.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.ajax/2.1.0/leaflet.ajax.min.js"></script>
    <script>
        $(function() {
            $('[data-tooltip]').tooltip({})
        });
    </script>
	<script>

		function getHierarchy($list) {
			$list = (typeof $list == 'undefined')?$(".card-sortable").eq(0):$list;
			var result = [];
			$list.children('[data-id]').each(function() {
				var $item = $(this);
				var id = $item.data('id');
				var children = $item.children('.collapse').children('.card-body').children('.card-sortable').length > 0 ? getHierarchy($item.children('.collapse').children('.card-body').children('.card-sortable')) : [];
				result.push({ id: id, children: children });
			});
			return result;
		}

		// Function to get the order with custom attributes
		function getCustomOrder(parent_container) {
			parent_container = (typeof parent_container == 'undefined')?".card-sortable":parent_container;
			return $(parent_container).find("[data-id]").map(function(i,v) {
				var new_parent_code = $(this).parents("[data-parent_code]").data("code") ?? 0;
				var new_sort_order = $("[data-id='"+$(this).data("id")+"']").index($("[data-id]").parent().find("[data-id]"));
				$(this).data("parent_code",new_parent_code);

				return {
					id: $(this).data("id"),
					parent_code: new_parent_code,
					sort_order: i, //(new_sort_order >= 0)?new_sort_order:false,
					code: $(this).data("code")
				};
			}).get();
		}

		function updateOrder(){
			var data_units = getCustomOrder();
			console.log(data_units);
			var url = "{{ route('admin.unit.updateSort')}}";

			$.ajax({
				url: url,
				type: 'post',
				data: {data: data_units},
				headers: {
					'X-CSRF-TOKEN': "{{ csrf_token() }}",
				},
				dataType: 'json',
				success:function(response){
					toastr.success(response.message, "Sukses", {
						timeOut: 3000,
						positionClass: "toast-top-right",
						progressBar: true
					});
				},
				error:function(xhr, status, error){
					toastr.error(xhr.responseJSON.message, "Error", {
                            timeOut: 3000,
                            positionClass: "toast-top-right",
                            progressBar: true
                        });
				}
			})
		}

		function generateCode(){
			var data_units = getHierarchy();
			var url = "{{ route('admin.unit.generateCode')}}";

			$.ajax({
				url: url,
				type: 'post',
				data: {data: data_units},
				headers: {
					'X-CSRF-TOKEN': "{{ csrf_token() }}",
				},
				dataType: 'json',
				success:function(response){
					toastr.success(response.message, "Sukses", {
						timeOut: 3000,
						positionClass: "toast-top-right",
						progressBar: true
					});
				},
				error:function(xhr, status, error){
					toastr.error(xhr.responseJSON.message, "Error", {
                            timeOut: 3000,
                            positionClass: "toast-top-right",
                            progressBar: true
                        });
				}
			})
		}

		$(document).ready(function(){
			$( ".card-sortable" ).sortable({
				connectWith: ".card-sortable",
      			placeholder: "ui-state-highlight",
				update: function(event, ui) {
					updateOrder();
				}
			}).disableSelection();

			$(".card-sortable > .card > .collapse > .card-body > .card-sortable").sortable({
				connectWith: ".card-sortable",
				handle: ".card-header",
				placeholder: "ui-state-highlight",
				update: function(event, ui) {
					updateOrder();
				}
			}).disableSelection();

			$("body").on("click",".btn-generate-code",function(){
				generateCode();
			});
		});
	</script>
@endpush
