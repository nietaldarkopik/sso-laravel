@extends('front.master-front')

@section('content')
    <section class="container-fluid container-xl  vh-50">
        <div class="row">
            <div class="col-xl-12 px-0">
                <div class="container-fluid container-xl  h-100 px-0">
                    <div class="card rounded-4 card-primary pt-5 px-0">
                        <div class="card-body" style="min-height: 75vh;">
							<div class="row">
								<div class="col-md-12">
									<div class="card bg-warning rounded-0 my-2">
										<div class="card-header bg-warning">
											<h4 class="card-title fs-5 oswald-semibold">Waktu</h4>
										</div>
										<div class="card-body bg-light">
											<h4>
												<span class="oswald-regular" id="date"></span>
												<span class="oswald-regular" id="clock"></span>
											</h4>
										</div>
									</div>
									<div class="card bg-warning rounded-0 my-2">
										<div class="card-header bg-warning">
											<h4 class="card-title fs-5 oswald-semibold">Device</h4>
										</div>
										<div class="card-body bg-light">
											<div class="table-responsive">
												<table class="table table-striped table-striped-columns table-hover table-bordered table-primary align-middle" id="table-devices">
													<thead class="table-warning oswald-regular">
														<tr>
															<th>Device No</th>
															<th>Device Name</th>
															<th>Sn</th>
															<th>Location</th>
															<th>Status</th>
														</tr>
													</thead>
													<tbody class="table-group-divider">
													</tbody>
												</table>
											</div>
											
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="card bg-warning rounded-0 my-2">
										<div class="card-header bg-warning">
											<h4 class="card-title fs-5 oswald-semibold">Kehadiran Hari ini</h4>
										</div>
										<div class="card-body bg-light">
											<div class="table-responsive">
												<table class="table table-striped table-hover table-bordered table-secondary align-top oswald-regular" id="table-presensi">
													<thead class="table-warning">
														<tr>
															<th class="text-center">Karyawan</th>
															<th class="text-center">Device/Lokasi</th>
															<th class="text-center">Datang</th>
															<th class="text-center">Pulang</th>
															<th class="text-center">Created At</th>
															<th class="text-center">Updated At</th>
														</tr>
													</thead>
													<tbody class="table-group-divider">
													</tbody>
												</table>
											</div>
											
										</div>
									</div>
								</div>
							</div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
	<!-- Modal -->
	<div class="modal fade" id="modalIdLG" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalIdLGLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="modalIdLGLabel">Presensi Baru</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
			</div>
			</div>
		</div>
	</div>


    {{-- <textarea id="text" rows="5" cols="40" placeholder="Enter text to speak"></textarea> --}}
    {{-- <br>
    <button id="speakButton">Speak</button>
    <br> --}}
    <audio id="audio" controls class="d-none"></audio>

@endsection

@section('css')
    @parent
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" preload />
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" preload />
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}" />
	<style>
		#date,#clock {
		  font-family: 'Arial', sans-serif;
		  text-align: center;
		  margin-top: 20%;
		}
	</style>
@endsection
@section('js')
    @parent
	
	<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/slider.js') }}"></script>
    <script>
        function updateClock() {
            // Dapatkan waktu saat ini
            const now = new Date();

            // Mendapatkan komponen waktu
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');

            // Mendapatkan hari dan tanggal
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const formattedDate = now.toLocaleDateString('id-ID', options);

            // Memformat waktu
            const formattedTime = `${hours}:${minutes}:${seconds}`;

            // Menampilkan waktu dan tanggal ke dalam elemen HTML
            document.getElementById('date').textContent = formattedDate;
            document.getElementById('clock').textContent = formattedTime;
        }

        // Memperbarui waktu setiap detik
        setInterval(updateClock, 1000);

        // Panggil fungsi sekali untuk memulai jam sebelum interval berikutnya
        updateClock();
    </script>

		
	<script>
		$(document).ready(function() {
			// Initialize DataTable 1
			var table_devices = $('#table-devices').DataTable({
				processing: true,
				serverSide: true,
				ajax: '{{ route('front.device.data') }}',
				columns: [
					//{ data: 'id', name: 'id' },
					{ data: 'device_no', name: 'device_no' },
					{ data: 'device_name', name: 'device_name' },
					{ data: 'sn', name: 'sn' },
					//{ data: 'ip_public', name: 'ip_public' },
					//{ data: 'ip_local', name: 'ip_local' },
					//{ data: 'port_public', name: 'port_public' },
					//{ data: 'port_local', name: 'port_local' },
					{ data: 'location', name: 'location' },
					{ data: 'status', name: 'status', className: 'text-center',
						"render": function(data, type, row, meta) {
							return (row.status == 'Aktif')?'<span class="badge badge-success bg-success">Aktif</span>':'<span class="badge badge-secondary bg-secondary">Tidak Aktif</span>';
						}
					},
				]
			});

			// Initialize DataTable 2
			var table_presensi = $('#table-presensi').DataTable({
				processing: true,
				serverSide: true,
				ajax: '{{ route('front.presensi.data') }}',
				/* columnDefs: [
					{
						targets: [0], // Indeks kolom yang akan disembunyikan
						visible: false,
						searchable: true, orderable: false
					}
				], */
				columns: [
					//{ data: 'id', name: 'id' },
					//{ data: 'id_device', name: 'id_device' },
					//{ data: 'id_user', name: 'id_user' },
					{ data: 'absensi_users.nama', name: 'absensi_users.nama',
						'render': function(data, type, row, meta){
							return (row.nama) + "<br/><strong>" + (row.jabatan) + "</strong>";
						}
					},
					{ data: 'absensi_device_users.device_no', name: 'device_no',
						'render': function(data, type, row, meta){
							return (row.device_no) + ' - ' + (row.device_name) + '<br/>' + (row.location);
						}
					},
					{ data: 'datang', name: 'datang' },
					{ data: 'pulang', name: 'pulang' },
					{ data: 'created_at', name: 'created_at' },
					{ data: 'updated_at', name: 'updated_at' },
					//{ data: 'tanggal', name: 'tanggal' },
					// Tambahkan kolom sesuai dengan data Anda
				]
			});


			function ping_device(){
				$.ajax({
					url: "{{ route('front.presensi.ping_device') }}",
					type: "get",
					success: function(msg){
					}
				})	
			}

			function last_present(){
				if($("#modalIdLG").hasClass("show")){}
				else{
					$.ajax({
						url: "{{ route('front.presensi.last_present') }}",
						type: "get",
						dataType: "html",
						success: function(msg,status){
							if(!msg){}else{
								$("#modalIdLG").find(".modal-body").html(msg);
								$("#modalIdLG").modal('show');
							}
						},
						errror: function(){
							$("#modalIdLG").modal('hide');
						}
					})	
				}
			}

			var last_present_int = setInterval(function(){
				last_present();
			},6000); // 2 menit

			var ping_device_int = setInterval(function(){
				ping_device();
			},6000); // 2 menit
			
			ping_device();

            setInterval(function() {
                table_devices.ajax.reload(null, false);
                table_presensi.ajax.reload(null, false);
            }, 30000); // 30000 milliseconds = 30 seconds

			$("#modalIdLG").on('shown.bs.modal',function(){
				setTimeout(function(){
					$("#modalIdLG").modal('hide');
				},10000);
			});
		});
	</script>

		
	<script>
		function playSound(id){
			id = (!id)?0:id;
			var audio = document.getElementById('audio');
			var text = "";
			fetch(`service/tts?text=${encodeURIComponent(text)}&lang=id&id_attendence_log=`+id)
				.then(response => {
					if (!response.ok) {
						throw new Error('Network response was not ok.');
					}
					return response.blob();
				})
				.then(blob => {
					var url = URL.createObjectURL(blob);
					audio.src = url;
					audio.play();
				})
				.catch(error => {
					console.error('Error fetching TTS audio:', error);
				});
		}

	</script>
@endsection
