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

    <div class="row mb-3">

        <div class="col-xs-12 col-sm-6 mx-auto mb-3">
			<div class="card card-primary">
				<div class="card-header">
					<h2 class="card-title">Tangkap User Dari Device</h2>
				</div>
				<div class="card-body">
					<div class="alert alert-info">
						<p>Untuk menambahkan user langsung dari device, silahkan pilih device lalu buat user baru di Device Finger/Face Scanner.
						Pastikan Device sudah terhubung dengan ADMS Server (Sistem Presensi Ini) dengan benar. </p>
						<p>Nama Pada Device cukup nama depan yang penting unik dan mudah untuk dibedakan, untuk data detailnya akan di simpan di sistem ini</p>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group p-2 mb-1">
								<label>Pilih Device Untuk Scan User Baru</label>
								<select required="required" name="id_device" id="scan-id_device"
									class="form-select form-custom border py-0 text-italic-0 form-control-sm w-100 custom-select2">
									<option value="">Pilih Device ...</option>
									@foreach (\App\Models\AbsensiDeviceModel::get() as $i => $s)
										<option value="{{ $s->id }}">{{ $s->device_name }} / {{ $s->location }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-lg-12 mb-1 text-center">
							<button type="button" class="btn btn-primary btn-scan-user-device" data-toggle="modal" data-target="#modalUserDevice">
								<i class="fa fa-search" aria-hidden="true"></i> Mulai Scan User Baru
							</button>
						</div>
					</div>
				</div>
			</div>
			
        </div>
		
    </div>

	<form action="{{ route('admin.absensi_user.store') }}" class="form-create-absensi_user" method="POST" enctype="multipart/form-data">
		@csrf
		@method('patch')
	
  <!-- Modal -->
  <div class="modal fade" id="modalUserDevice" tabindex="-1" role="dialog" aria-labelledby="modalUserDeviceLabel" aria-hidden="true"  aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalUserDeviceLabel">Tambah User dari Device</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
			<div class="row">
				<div class="col-md-12 loading"></div>
			</div>
			
			<div class="row mb-3 card-form-user-device">
				<div class="col-xs-12 col-sm-12 col-lg-12 mb-3">
						
					<div class="card card-primary">
						<div class="card-header">
							<h2 class="card-title">Data di Device</h2>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group p-2 mb-1">
										<label>Device</label>
										<select required="required" name="id_device" id="input-id_device"
											class="form-select form-custom border py-0 text-italic-0 form-control-sm w-100 custom-select2-modal">
											<option value="">Pilih ...</option>
											@foreach (\App\Models\AbsensiDeviceModel::get() as $i => $s)
												<option value="{{ $s->id }}">{{ $s->device_no }} | {{ $s->device_name }} | {{ $s->location }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12 p-0 px-1">
									<div class="form-group p-2 mb-1">
										<label>User ID Device</label>
										<input required="required" type="text" name="user_no" value=""
										class="form-control border py-0 text-italic-0 form-control-sm"
										placeholder="User ID Device" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12 p-0 px-1">
									<div class="form-group p-2 mb-1">
										<label>Nama di Device</label>
										<input required="required" type="text" name="device_user_name" value=""
										class="form-control border py-0 text-italic-0 form-control-sm"
										placeholder="Nama di Device" />
									</div>
								</div>
							</div>
							{{-- <div class="row d-none">
								<div class="col-lg-12 text-center">
									<h4>Apakah Sudah ada data karyawan?</h4>
									<input type="checkbox" id="switch-pilih-baru" data-toggle="switch" data-on-text="Buat Baru" data-off-text="Pilih Karyawan" data-on-color="success" data-off-color="danger">
									<div class="alert alert-warning my-2">Ada kemungkinan Seorang Karyawan ada dibeberapa device sekaligus, jika sudah ada silahkan pilih
										data karyawan yang tepat, jika belum ada silahkan input data karyawan baru</div>
								</div>
							</div>
							<div class="row card-form-pilih-karyawan">
								<div class="col-lg-12">
									<div class="form-group p-2 mb-1">
										<label>Karyawan</label>
										<select required="required" name="id_user" id="input-id_user"
											class="form-select form-custom border py-0 text-italic-0 form-control-sm w-100 custom-select2">
											<option value="">Pilih ...</option>
											@foreach (\App\Models\AbsensiUserModel::get() as $i => $s)
												<option value="{{ $s->id }}">{{ $s->nama }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div> --}}
						</div>
					</div>
				</div>
			</div>
			
			<div class="row mb-3 card-form-karyawan-baru">
				<div class="col-xs-12 col-sm-12 col-lg-12 mb-3">
					<div class="card card-primary">
						<div class="card-header">
							<h2 class="card-title">Detail Karyawan</h2>
						</div>
						<div class="card-body">
							<input type="hidden" name="id_user" id="input-id_user" value=""/>
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group p-2 mb-1">
										<label>Unit Kerja</label>
										@php
											$current_user = Auth()->user()->units->pluck('id');
										@endphp
										<select required="required" name="id_unit" id="input-id_unit"
											class="form-select form-custom border py-0 text-italic-0 form-control-sm w-100 custom-select2-modal">
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
				</div>
			</div>
        </div>

        <div class="modal-footer text-center">
          <button type="submit" class="btn btn-primary btn-save-user-device">Simpan Perubahan</button>
        </div>
      </div>
    </div>
  </div>
</form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>

<script>
	var storage_url = "{{ asset(Storage::url('xxx'))}}";

	$(document).ready(function() {
    	$('#switch-pilih-baru').bootstrapSwitch();

		$('.custom-select2').select2({
			tags: true,
			dropdownParent: $('body')
		});

		$('#modalUserDevice .custom-select2-modal').select2({
			tags: true,
			dropdownParent: ($('#modalUserDevice').length > 0)?$('#modalUserDevice .modal-body'):$('body')
		});
		
		/* $(".btn-save-user-device").on("click",function(e){
			e.preventDefault();
			var id_user = $("input[name='id_user']").val();
			var url = "{{ route('admin.absensi_user.update', ['absensi_user' => 'xxx']) }}";
			url = url.replace('xxx',id_user);
			$(".form-create-absensi_user").attr("action",url);
			$(".form-create-absensi_user").submit();
		}); */
		
		$("body").on("submit",".form-create-absensi_user",function(e){
			e.preventDefault();
			$(".btn-save-user-device").prop("disabled",true);
			var id_user = $("input[name='id_user']").val();
			var url = "{{ route('admin.absensi_user.update', ['absensi_user' => 'xxx']) }}";
			url = url.replace('xxx',id_user);
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
								
						toastr.success('Data berhasil disimpan', 'Sukses', {
							timeOut: 5000,
							//positionClass: "toast-top-right",
							progressBar: true,
							onShown: function() {
							}
						});
						$("#modalUserDevice").modal("hide");
						$("[data-dismiss='modal']").trigger("click");
					}

					$(".btn-save-user-device").prop("disabled",false);
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
					$(".btn-save-user-device").prop("disabled",false);
				}
			});
			return false;
		});

		$("#switch-pilih-baru").on("switchChange.bootstrapSwitch",function(event, state){
			if(state){
				$(".card-form-karyawan-baru").find(":input").prop("disabled",false);
				$(".card-form-karyawan-baru").show();
				
				//$(".card-form-pilih-karyawan").find(":input").prop("disabled",true);
				//$(".card-form-pilih-karyawan").hide();
			}else{

				//$(".card-form-pilih-karyawan").find(":input").prop("disabled",false);
				//$(".card-form-pilih-karyawan").show();

				$(".card-form-karyawan-baru").find(":input").prop("disabled",true);
				$(".card-form-karyawan-baru").hide();
			}
		});

		$("body").on("show.bs.modal","#modalUserDevice",function(){
			var _this = $(this);
			var device_id = $("#scan-id_device").val();
			
				
			$(".card-form-karyawan-baru").hide();
			$(".card-form-pilih-karyawan").hide();
			$(".card-form-user-device").hide();
			$(".btn-save-user-device").hide();
			$(".card-form-karyawan-baru").find(":input").prop("disabled",true);
			$(".card-form-pilih-karyawan").find(":input").prop("disabled",true);
			$(".card-form-user-device").find(":input").prop("disabled",true);
			$(".btn-save-user-device").find(":input").prop("disabled",true);

			if(device_id == "")
			{
				$(_this).find(".modal-body .loading").html('<div class="row"><div class="col-md-12 text-center"><div class="alert alert-warning"><h3>Silahkan Pilih Device terlebih dahulu</div></div></div>');
			}else{
				var device = $("#scan-id_device option[value='"+device_id+"']").html();
				$(_this).find(".modal-body .loading").html('<div class="row"><div class="col-md-12 text-center"><i class="fas fa-spinner fa-pulse fa-4x"></i><br/><h3>Menunggu User Baru ...</h3><h5>Silahkan tambah user pada Device '+ device + '</h5></div></div>');
			}
		});

		$('.custom-datepicker').daterangepicker({
			singleDatePicker: true,  // Enable single date selection
			showDropdowns: true,     // Optional: show year and month dropdowns
			locale: {
				format: 'YYYY-MM-DD' // Set the date format
			}
		});

		function getUserDevice(){
			//console.log('ok');

			var id_device = $("#scan-id_device").val();
			var url = "{{ route('admin.absensi_user.checkFromDevice',['id_device' => 'xxx'])}}";
			url = url.replace('xxx',id_device);

			$.ajax({
				url: url,
				type: "post",
				method: "get",
				dataType: "json",
				success: function(msg){
					var status = (!msg.status)?false:msg.status;
					var data = (!msg.data)?[]:msg.data;
					
					if(status == 'success')
					{
						var user = (!data.user)?[]:data.user;

						$("#modalUserDevice").find(".modal-body .loading").html('');
						$(".card-form-karyawan-baru").show();
						$(".card-form-pilih-karyawan").show();
						$(".card-form-user-device").show();
						$(".btn-save-user-device").show();
						
						$(".card-form-karyawan-baru").find(":input").prop("disabled",false);
						$(".card-form-pilih-karyawan").find(":input").prop("disabled",false);
						$(".card-form-user-device").find(":input").prop("disabled",false);
						$(".btn-save-user-device").find(":input").prop("disabled",false);

						if($('#switch-pilih-baru').bootstrapSwitch('state'))
						{
							$(".card-form-pilih-karyawan").hide();
							$(".card-form-pilih-karyawan").find(":input").prop("disabled",true);
							$(".card-form-karyawan-baru").show();
							$(".card-form-karyawan-baru").find(":input").prop("disabled",false);
						}else{
							//$(".card-form-pilih-karyawan").show();
							//$(".card-form-pilih-karyawan").find(":input").prop("disabled",false);
							$(".card-form-karyawan-baru").hide();
							$(".card-form-karyawan-baru").find(":input").prop("disabled",true);
						}
						$("#modalUserDevice").find(".modal-body [name='device_user_name']").val(data.device_user_name);
						$("#modalUserDevice").find(".modal-body [name='id_device']").val(data.id_device).trigger("change");
						$("#modalUserDevice").find(".modal-body [name='device_no']").val(data.device_no);
						$("#modalUserDevice").find(".modal-body [name='user_no']").val(data.user_no);

						$("#modalUserDevice").find(".modal-body [name='id_user']").val(user.id ?? 0);
						$("#modalUserDevice").find(".modal-body [name='id_unit']").val(user.id_unit ?? 0).trigger("change");
						$("#modalUserDevice").find(".modal-body [name='nama']").val(user.nama ?? '-');
						$("#modalUserDevice").find(".modal-body [name='jabatan']").val(user.jabatan ?? '-');
						$("#modalUserDevice").find(".modal-body [name='jenis_kelamin']").val(user.jenis_kelamin ?? '-');
						//$("#modalUserDevice").find(".modal-body [name='photo']").val(user.photo ?? '');

					}else{
						$(".card-form-karyawan-baru").hide();
						$(".card-form-pilih-karyawan").hide();
						$(".card-form-user-device").hide();
						$(".btn-save-user-device").hide();
					}
				}
			})
		}

		setInterval(function(){
			if($("#modalUserDevice").hasClass("show") && $("#scan-id_device").val() != "" && $("#modalUserDevice").find(".modal-body .loading").html() != '')
			{
				getUserDevice();
			}else{

			}
		},5000);
	})
	
	/* 
	$(".btn-save-user-device").on("click",function(){
		var id_user = $("input[name='id_user']").val();
		var url = {{ route('admin.absensi_user.update', ['absensi_user' => 'xxx']) }};
		url = url.replace('xxx',id_user);
		var data = new FormData()
		$.ajax({
			url: url,
			type: "post",
			method: "post",
			dataType: "json",
			success: function(msg){
				{{ route('admin.absensi_user.update', ['absensi_user']) }}
			}
		})
	}) 
	*/
</script>