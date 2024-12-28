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

<form action="{{ route('admin.absensi_user.store') }}" class="form-create-absensi_user" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row mb-3">

        <div class="col-xs-12 col-sm-12 col-lg-12 mb-3">
			<div class="card card-primary">
				<div class="card-header">
					<h2 class="card-title">Data Karyawan</h2>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group p-2 mb-1">
								<label>Unit Kerja</label>
								@php
									$current_user = Auth()->user()->units->pluck('id');
								@endphp
								<select required="required" name="id_unit" id="input-id_unit"
									class="form-select form-custom border py-0 text-italic-0 form-control-sm w-100 custom-select2">
									<option value="">Pilih Unit ...</option>
									@foreach (\App\Models\UnitModel::orderBy('code', 'asc')->get() as $i => $s)
										<option value="{{ $s->id }}">{{ $s->nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 p-0 px-1">
							<div class="form-group p-2 mb-1">
								<label>Nama Karyawan</label>
								<input required="required" type="text" name="nama" value=""
								class="form-control border py-0 text-italic-0 form-control-sm"
								placeholder="Nama Karyawan" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 p-0 px-1">
							<div class="form-group p-2 mb-1">
								<label>Jabatan</label>
								<input required="required" type="text" name="jabatan" value=""
								class="form-control border py-0 text-italic-0 form-control-sm"
								placeholder="Jabatan" />
							</div>
						</div>
					</div>
		
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group p-2 mb-1">
								<label>Jenis Kelamin</label>
								<select required="required" name="jenis_kelamin"
									class="form-select-form-select-custom border py-0 w-100 text-italic-0 form-control-sm">
									<option value="">Pilih Jenis Kelamin ...</option>
									<option value="Laki-Laki">Laki-Laki</option>
									<option value="Perempuan">Perempuan</option>
								</select>
							</div>
						</div>
					</div>
		
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group p-2 mb-1">
								<label>Photo</label>
								<input type="file" class="form-control-file" name="photo">
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-lg-12 mb-1 text-center">
				<button class="btn btn-primary btn-save-absensi_user">
					<i class="fa fa-save" aria-hidden="true"></i> Simpan
				</button>
			</div>
        </div>
		
    </div>

</form>


<script>
	var storage_url = "{{ asset(Storage::url('xxx'))}}";

	$(document).ready(function(){
		$('.custom-select2').select2({
			tags: true,
			dropdownParent: $('#modalLgId')
		});
		
		$("body").on("submit",".form-create-absensi_user",function(e){
			e.preventDefault();
			$(".btn-save-absensi_user").prop("disabled",true);
			var id = $(this).data("id");
			var url = "{{ route('admin.absensi_user.store')}}";
			var data = new FormData($(".form-create-absensi_user")[0]);

			$.ajax({
				url: url,
				type: 'post',
				data: data,
				method: 'post',
				dataType: 'json',
                contentType: false,
                processData: false,
				headers: {
					'X-CSRF-TOKEN': "{{ csrf_token() }}"
				},
				success:function(msg){
					var data = (!msg.data)?{}:msg.data;
					var id_absensi_user = (!data.id)?0:data.id;
					
					if(!id_absensi_user){
						
						toastr.error(msg.message ?? 'Proses penyimpanan gagal', "Error", {
							timeOut: 3000,
							positionClass: "toast-top-right",
							progressBar: true
						});

					} else{
								
						toastr.success('Halaman akan diarahkan ke Data Karyawan', 'Data berhasil dikirim', {
							timeOut: 5000,
							//positionClass: "toast-top-right",
							progressBar: true,
							onShown: function() {
								setTimeout(() => {
									window.location.href = "{{ route('admin.absensi_user.index')}}";							
								}, 3000);
							}
						});
					}

					$(".btn-save-absensi_user").prop("disabled",false);
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
					$(".btn-save-absensi_user").prop("disabled",false);
				}
			});
			return false;
		});

		$("body").on("click",".btn-save-absensi_user",function(){
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