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

<form action="{{ route('admin.absensi_device.store') }}" class="form-create-absensi_user" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row mb-3">

        <div class="col-xs-12 col-sm-12 col-lg-12 mb-3">
			<div class="card card-primary">
				<div class="card-header">
					<h2 class="card-title">Data Device</h2>
				</div>
				<div class="card-body">
					
					<div class="row">
						<div class="col-sm-6 p-0 px-1">
							<div class="form-group p-2 mb-1">
								<label>Device No</label>
								<input required="required" type="text" name="device_no" value=""
								class="form-control border py-0 text-italic-0"
								placeholder="Device No" />
							</div>
						</div>
						
						<div class="col-sm-6 p-0 px-1">
							<div class="form-group p-2 mb-1">
								<label>Device Name</label>
								<input required="required" type="text" name="device_name" value=""
								class="form-control border py-0 text-italic-0"
								placeholder="Device Name" />
							</div>
						</div>
						
						<div class="col-sm-6 p-0 px-1">
							<div class="form-group p-2 mb-1">
								<label>Sn</label>
								<input required="required" type="text" name="sn" value=""
								class="form-control border py-0 text-italic-0"
								placeholder="Sn" />
							</div>
						</div>
						
						<div class="col-sm-6 p-0 px-1">
							<div class="form-group p-2 mb-1">
								<label>Ip Public</label>
								<input required="required" type="text" name="ip_public" value=""
								class="form-control border py-0 text-italic-0"
								placeholder="Ip Public" />
							</div>
						</div>
						
						<div class="col-sm-6 p-0 px-1">
							<div class="form-group p-2 mb-1">
								<label>Ip Local</label>
								<input required="required" type="text" name="ip_local" value=""
								class="form-control border py-0 text-italic-0"
								placeholder="Ip Local" />
							</div>
						</div>
						
						<div class="col-sm-6 p-0 px-1">
							<div class="form-group p-2 mb-1">
								<label>Port Public</label>
								<input required="required" type="number" name="port_public" value=""
								class="form-control border py-0 text-italic-0"
								placeholder="Port Public" />
							</div>
						</div>
						
						<div class="col-sm-6 p-0 px-1">
							<div class="form-group p-2 mb-1">
								<label>Port Local</label>
								<input required="required" type="number" name="port_local" value=""
								class="form-control border py-0 text-italic-0"
								placeholder="Port Local" />
							</div>
						</div>

						<div class="col-sm-6 p-0 px-1">
							<div class="form-group p-2 mb-1">
								<label>Status</label>
								<select required="required" type="text" name="status" value=""
								class="form-control border py-0 text-italic-0"
								placeholder="Status">
									<option value="">Pilih ...</option>
									<option value="Aktif">Aktif</option>
									<option value="Tidak Aktif">Tidak Aktif</option>
								</select>
							</div>
						</div>
						
						<div class="col-sm-12 p-0 px-1">
							<div class="form-group p-2 mb-1">
								<label>Location</label>
								<textarea required="required" type="text" name="location" value=""
								class="form-control border py-0 text-italic-0" rows="4"
								placeholder="Location"></textarea>
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
		
		$(".form-create-absensi_user").on("submit",function(e){
			e.preventDefault();
			$(".btn-save-absensi_user").prop("disabled",true);
			var id = $(this).data("id");
			var url = "{{ route('admin.absensi_device.store')}}";
			//var data = new FormData($(".form-create-absensi_user")[0]);
			var data = $(".form-create-absensi_user").serializeArray();

			$.ajax({
				url: url,
				type: 'post',
				data: data,
				//method: 'post',
				dataType: 'json',
                //contentType: false,
                //processData: false,
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
								
						toastr.success('Halaman akan diarahkan ke Data Device', 'Data berhasil dikirim', {
							timeOut: 5000,
							//positionClass: "toast-top-right",
							progressBar: true,
							onShown: function() {
								setTimeout(() => {
									window.location.href = "{{ route('admin.absensi_device.index')}}";							
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

		$('.custom-datepicker').daterangepicker({
			singleDatePicker: true,  // Enable single date selection
			showDropdowns: true,     // Optional: show year and month dropdowns
			locale: {
				format: 'YYYY-MM-DD' // Set the date format
			}
		});
	})
</script>