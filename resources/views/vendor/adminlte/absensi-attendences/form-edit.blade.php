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

<form action="{{ route('admin.absensi_attendence.update', $absensi_attendence) }}" class="form-edit-absensi_attendence" method="POST" enctype="multipart/form-data" data-id="{{ $absensi_attendence->id }}">
    @csrf
	@method('patch')

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
								<label>Device</label>
								<select required="required" name="id_device" id="input-id_device"
									class="form-select form-custom border py-0 text-italic-0 form-control-sm w-100 custom-select2">
									<option value="">Pilih ...</option>
									@foreach (\App\Models\AbsensiDeviceModel::get() as $i => $s)
										<option value="{{ $s->id }}" @selected($s->id == $absensi_attendence->id_device)>{{ $s->device_no }} | {{ $s->device_name }} | {{ $s->location }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group p-2 mb-1">
								<label>Karyawan</label>
								<select required="required" name="id_user" id="input-id_user"
									class="form-select form-custom border py-0 text-italic-0 form-control-sm w-100 custom-select2">
									<option value="">Pilih ...</option>
									@foreach (\App\Models\AbsensiUserModel::get() as $i => $s)
										<option value="{{ $s->id }}" @selected($s->id == $absensi_attendence->id_user)>{{ $s->nama }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 p-0 px-1">
							<div class="form-group p-2 mb-1">
								<label>User ID Device</label>
								<input required="required" type="text" name="user_no" value="{{ $absensi_attendence->user_no }}"
								class="form-control border py-0 text-italic-0 form-control-sm"
								placeholder="User ID Device" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 p-0 px-1">
							<div class="form-group p-2 mb-1">
								<label>Nama di Device</label>
								<input required="required" type="text" name="device_user_name" value="{{ $absensi_attendence->device_user_name }}"
								class="form-control border py-0 text-italic-0 form-control-sm"
								placeholder="Nama di Device" />
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-lg-12 mb-1 text-center">
				<button class="btn btn-primary btn-save-absensi_attendence">
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
		
		$("body").on("submit",".form-edit-absensi_attendence",function(e){
			e.preventDefault();
			$(".btn-save-absensi_attendence").prop("disabled",true);
			var id = $(this).data("id");
			var url = "{{ route('admin.absensi_attendence.update',['absensi_attendence' => 'xxx'])}}";
			//var data = new FormData($(".form-edit-absensi_attendence")[0]);
			var data = $(".form-edit-absensi_attendence").serializeArray();
			url = url.replace('xxx',id);

			$.ajax({
				url: url,
				type: 'post',
				data: data,
				method: 'patch',
				dataType: 'json',
                //contentType: false,
                //processData: false,
				headers: {
					'X-CSRF-TOKEN': "{{ csrf_token() }}"
				},
				success:function(msg){
					var data = (!msg.data)?{}:msg.data;
					var id_absensi_attendence = (!data.id)?0:data.id;
					
					if(!id_absensi_attendence){
						
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
									window.location.href = "{{ route('admin.absensi_attendence.index')}}";							
								}, 3000);
							}
						});
					}

					$(".btn-save-absensi_attendence").prop("disabled",false);
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
					$(".btn-save-absensi_attendence").prop("disabled",false);
				}
			});
			return false;
		});

		$("body").on("click",".btn-save-absensi_attendence",function(){
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