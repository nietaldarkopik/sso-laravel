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

@section('title', 'Form Diskusi / Pesan')

@section('content_header')
    <h1 class="m-0 text-dark">Form Diskusi / Pesan</h1>
@stop
@section('content')
    <div class="card col-md-12">
        <div class="card-header">
            <h2 class="card-title fw-bold fs-4">Form Diskusi / Pesan</h2>
            <div class="card-tools">
                {{-- @can('admin.pengajuan.index')
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.pengajuan.index') }}">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali
                    </a>
                @endcan --}}
            </div>
        </div>
        <div class="card-body ajax-container">

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

            @include('vendor.adminlte.pengajuans.form-message')
        </div>
    </div>

@endsection

@section('js')
<script>
	var storage_url = "{{ asset(Storage::url('xxx'))}}";

	$(document).ready(function(){
		$('.custom-select2').select2({
			tags: true
		});

		$('[name="id_sop"]').on("change",function(){
        	var url = "{{ route('admin.pengajuan.getStepSop',['sop_id' => 'xx'])}}";
			var id = $(this).val();
			url = url.replace('xx',id);

			$.ajax({
				url: url,
				data: {},
				type: "post",
				method: "get",
				dataType: "json",
				headers: {
					'X-CSRF-TOKEN': "{{ csrf_token() }}"
				},
				success: function(msg){
					var output = '';
					var data = (!msg.data)?false:msg.data;
					var step = (!data.step)?false:data.step;
					var dokumen = (!data.dokumen)?false:data.dokumen;

					if(!step) {
						$(".prosedur-container .alert-info").show();
					} else {
						var no = 1;
						$.each(step,function(i,v){
							output += `
							<li class="list-group-item list-group-item-action flex-row align-items-start row d-flex">
								<div class="col-12 d-block">
									<div class="row d-flex justify-content-center align-items-start flex-column">
										<div class="col-12">
											` + ((!v.unit?.nama) ? '' : `<h5 class="mb-0 font-weight-bold">`+(v.unit?.nama ?? '')+`</h5>`)+`
											` + ((!v.keterangan) ? '' : `<p class="mb-0 text-muted">`+v.keterangan+`</p>`)+`
										</div>
									</div>
								</div>
							</li>`;
							no++;
						});
						$(".prosedur-container .step-container").html(output);
						$(".prosedur-container .alert-info").fadeOut();
					}
					var output = '';
					if(!dokumen) {
						$(".template-container .alert-info").show();
					} else {
						var no = 1;
						$.each(dokumen,function(i,v){
							output += `
							<li class="list-group-item list-group-item-action flex-row align-items-start row d-flex">
								<div class="col-1"><h2><strong>`+no+`</strong></h2></div>
								<div class="col-11 d-block">
									<div class="row d-flex justify-content-center align-items-start flex-column">
										<div class="col-12">
											` + ((!v.judul) ? '' : `<h5 class="mb-0 font-weight-bold">`+(v.judul ?? '')+`</h5>`)+`
											` + ((!v.file) ? '' : `<a href="`+(storage_url.replace('xxx','uploads/sop/'+v.file))+`" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Download</a>`)+`
										</div>
									</div>
								</div>
							</li>`;
							no++;
						});
						$(".template-container .template-list-container").html(output);
						$(".template-container .alert-info").fadeOut();
					}
				},
				error:function(xhr, status, error){
					/* toastr.error(xhr.responseJSON.message, "Error", {
							timeOut: 30000,
							positionClass: "toast-top-right",
							progressBar: true
						}); */
				}
			})
		})
	})
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script> --}}
<script>
	$(document).ready(function(){
		var myDropzone = $('.dropzone-document');
		$('.dropzone-document').dropzone({
			url: '{{ route('admin.pengajuan.uploadDokumen',['pengajuan' => 'xxx']) }}',
			maxFilesize: 512, // MB
			dataType: "json",
			addRemoveLinks: true,
			autoProcessQueue: false,
			parallelUploads: 10, // Maksimal file yang diupload secara bersamaan
			//acceptedFiles: "image/*", // Batasan tipe file
			headers: {
				'X-CSRF-TOKEN': "{{ csrf_token() }}"
			},
			sending: function(file, xhr, formData) {
				//console.log(file, xhr, formData, $(this));
				var form = $(this)[0].clickableElements[0];
			},
			success: function(file, response) {
				var form = $(this)[0].clickableElements[0];
				this.removeFile(file);
				toastr.success('Halaman akan diarahkan ke Tracking Pengajuan', 'Data berhasil dikirim', {
					timeOut: 5000,
					//positionClass: "toast-top-right",
					progressBar: true,
                    onShown: function() {
						setTimeout(() => {
							window.location.href = "{{ route('admin.pengajuan.index')}}";							
						}, 3000);
                    }
				});

			},
			queuecomplete: function () {
				// Event ini dipanggil ketika semua file dalam antrian selesai diupload
				// Optional: Membersihkan semua preview (ini mencakup file yang gagal diupload)
				this.removeAllFiles(true);
			},
			error: function(file, response) {
				var form = $(this)[0].clickableElements[0];
				$(form).append('<input type="hidden" name="document[]" value="' + response.name + '">')
				//uploadedDocumentDokumen[file.name] = response.name
			},
			removedfile: function(file) {
				file.previewElement.remove()
				/* var name = ''
				if (typeof file.file_name !== 'undefined') {
					name = file.file_name
				} else {
					name = uploadedDocumentDokumen[file.name]
				}
				var form = $(this)[0].clickableElements[0];
				$(form).find('input[name="document[]"][value="' + name + '"]').remove() */
			},
			init: function(e) {
				var clickableElements = $(this)[0].clickableElements;
            	myDropzone = this;

				/* 
				// Callback yang akan dipanggil ketika semua file selesai diupload
				this.on("queuecomplete", function() {
					alert("All files have been uploaded.");
				});

				// Callback untuk menangani error upload
				this.on("error", function(file, response) {
					alert("Error uploading file: " + response);
				}); */
			}
		});
		

		$("body").on("submit",".form-create-pengajuan",function(e){
			e.preventDefault();
			
			if (myDropzone.getQueuedFiles().length === 0) {
				toastr.error("Silahkan masukan dokumen pengajuan", "Error", {
					timeOut: 30000,
					positionClass: "toast-top-right",
					progressBar: true
				});
				return false
			}
			
			var kode = $(this).val();
			var id = $(this).data("id");
			var url = "{{ route('admin.pengajuan.store')}}";
			var data = $(".form-create-pengajuan").serializeArray();

			$.ajax({
				url: url,
				type: 'post',
				data: data,
				method: 'post',
				dataType: 'json',
				headers: {
					'X-CSRF-TOKEN': "{{ csrf_token() }}"
				},
				success:function(msg){
					var form = myDropzone.clickableElements[0];
					var data = (!msg.data)?{}:msg.data;
					var id_pengajuan = (!data.id)?0:data.id;
					if(!id_pengajuan){
						toastr.error(msg.message ?? 'Proses penyimpanan gagal', "Error", {
							timeOut: 3000,
							positionClass: "toast-top-right",
							progressBar: true
						});
					} else{
						var url = '{{ route('admin.pengajuan.uploadDokumen',['pengajuan' => 'xxx']) }}';
						url = url.replace('xxx',id_pengajuan);

						myDropzone.options.url = url;
						myDropzone.on("sending", function(file, xhr, formData) {
							formData.append("id_pengajuan", id_pengajuan);
						});
						
						myDropzone.processQueue();
					}
				},
				error: function(xhr, status, error){
					if(!xhr.responseJSON.message)
					{
						var errors = xhr.responseJSON.errors;
						if(errors.length > 0)
						{
							$.each(errors,function(i,v){
								toastr.error(v.detail, v.title, {
									timeOut: 3000,
									//positionClass: "toast-top-right",
									progressBar: true
								});
							})
						}
					}else{
						toastr.error(xhr.responseJSON.message, "Error", {
							timeOut: 3000,
							positionClass: "toast-top-right",
							progressBar: true
						});
					}
				}
			});
			return false;
		});

		$("body").on("click",".btn-save-pengajuan",function(){
		});

		$('.custom-datepicker').daterangepicker({
			singleDatePicker: true,  // Enable single date selection
			showDropdowns: true,     // Optional: show year and month dropdowns
			locale: {
				format: 'YYYY-MM-DD' // Set the date format
			}
		});
	})
</script>
@endsection