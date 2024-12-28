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


@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb shadow-sm">
            <li class="breadcrumb-item"><a href="https://codeliro.com/demo/aplikasi-absen/">Home</a></li>
            <li class="breadcrumb-item"><a href="https://codeliro.com/demo/aplikasi-absen/dashboard">Dashboard</a></li>
        </ol>
    </nav>
    <!-- Additional Info -->
    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card card-success mb-3">
                <div class="card-header">Ontime</div>
                <div class="card-body">
                    <h5 class="card-title">150 Karyawan</h5>
                    <p class="card-text">80% dari total presensi.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-warning mb-3">
                <div class="card-header">Terlambat</div>
                <div class="card-body">
                    <h5 class="card-title">30 Karyawan</h5>
                    <p class="card-text">15% dari total presensi.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-primary mb-3">
                <div class="card-header">Overtime</div>
                <div class="card-body">
                    <h5 class="card-title">10 Karyawan</h5>
                    <p class="card-text">5% dari total presensi.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Additional Info -->
    <div class="row mt-5">
        @foreach(App\Models\AbsensiDeviceModel::all() as $i => $AbsensiDevice)
		@php
			$dosen = DB::table('absensi_users')->join('absensi_device_users','absensi_device_users.id_user','=','absensi_users.id')->where('absensi_device_users.id_device','=',$AbsensiDevice->id)->where('id_type','=',4)->count('absensi_users.id');
			$pimpinan = DB::table('absensi_users')->join('absensi_device_users','absensi_device_users.id_user','=','absensi_users.id')->where('absensi_device_users.id_device','=',$AbsensiDevice->id)->where('id_type','=',2)->count('absensi_users.id');
			$tendik = DB::table('absensi_users')->join('absensi_device_users','absensi_device_users.id_user','=','absensi_users.id')->where('absensi_device_users.id_device','=',$AbsensiDevice->id)->where('id_type','=',3)->count('absensi_users.id');
		@endphp
        <div class="col">
            <div class="card card-primary mb-3">
                <div class="card-header text-center">{{ $AbsensiDevice->location }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col text-center">
                            <h5 class="my-0 text-bold">{{$pimpinan}}</h5>
                            <h6 class="fw-bold my-0">Pimpinan</h6>
                        </div>
                        <div class="col text-center">
                            <h5 class="my-0 text-bold">{{$tendik}}</h5>
                            <h6 class="fw-bold my-0">Tendik</h6>
                        </div>
                        <div class="col text-center">
                            <h5 class="my-0 text-bold">{{$dosen}}</h5>
                            <h6 class="fw-bold my-0">Dosen</h6>
                        </div>
                        <div class="col text-center">
                            <h5 class="my-0 text-bold">{{$dosen+$tendik+$pimpinan}}</h5>
                            <h6 class="fw-bold my-0">Total</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row mt-5">
        {{-- <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h2 class="card-title fw-bold fs-4">Dashboard</h2>
                </div>
                <div class="card-body">
                    <p>
                        Selamat Datang <strong>{{ Auth::user()->name }}</strong>
                    </p>
                </div>
            </div>
        </div> --}}
        <div class="col-md-3">

            <div class="card h-100">
                <div class="card-header">
                    <h2 class="card-title fw-bold fs-4">Presensi Hari ini</h2>
                </div>
                <div class="card-body">
                    <canvas id="attendanceChartToday"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-3">

            <div class="card h-100">
                <div class="card-header">
                    <h2 class="card-title fw-bold fs-4">Bulan Ini</h2>
                </div>
                <div class="card-body">
                    <canvas id="attendanceChartMonth"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h2 class="card-title fw-bold fs-4">Tahun Ini</h2>
                </div>
                <div class="card-body">
                    <canvas id="detailedChartYear"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12 col-lg-12 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <div class="card-header-start">
                        <h5 class="card-title">Rekapitulasi Bulanan</h5>
                    </div>
                </div>
                <div class="card-body d-flex align-items-start justify-content-center py-0">
                    <div class="overflow-auto w-100">
                        <table class="table table-border table-striped" id="attendanceRecapTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Datang Awal</th>
                                    <th>Tepat Waktu</th>
                                    <th>Terlambat</th>
                                    <th>Jumlah Hadir (hari)</th>
                                    <th>Jumlah Hadir (Jam)</th>
                                    <th>Overtime (hari)</th>
                                    <th>Overtime (jam)</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
						{{-- 	<small><em>*) Tepat waktu adalah jumlah presensi masuk dan pulang tepat waktu perbulan</em></small><br/>
							<small><em>*) </em></small><br/> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 mb-4">
			
			<div class="card">
				<div class="card-header">
					<h2 class="card-title fw-bold fs-4">Data Presensi Karyawan Hari Ini</h2>
					<div class="card-tools">
						@can('admin.absensi_attendence.print')
							<a class="btn btn-sm btn-primary" href="{{ route('admin.absensi_attendence.print') }}" target="_blank">
								<i class="fa fa-print" aria-hidden="true"></i> Print
							</a>
						@endcan
						@can('admin.absensi_attendence.pdf')
							<a class="btn btn-sm btn-primary" href="{{ route('admin.absensi_attendence.pdf') }}" target="_blank">
								<i class="fa fa-pdf" aria-hidden="true"></i> Print
							</a>
						@endcan
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="attendanceTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Karyawan</th>
									<th>Tanggal</th>
									<th>Datang</th>
									<th>Pulang</th>
									<th>Device</th>
									{{-- <th>Device No</th>
									<th>User No</th> --}}
								</tr>
							</thead>
						</table>
					</div>
					<script>
						
						$(document).ready(function () {
							$('#attendanceTable').DataTable({
								processing: true,
								serverSide: true,
								ajax: "{{ route('admin.dashboard.getAttendances') }}",
								/* data:function(data) {
									delete data.row_number;
								}, */
								columns: [
									//{ data: 'row_number', name: 'row_number', orderable: false, searchable: false },
									//{ data: 'row_number', name: 'row_number', title: '#', orderable: false, searchable: false,"render":function(data,type,full,meta){return meta.row + meta.settings._iDisplayStart + 1;;} },

									{ 
										data: 'DT_RowIndex', 
										name: 'DT_RowIndex', 
										title: '#',
										orderable: false, // Nonaktifkan pengurutan
										searchable: false // Nonaktifkan pencarian
									},
									{ data: 'id_user', name: 'id_user', orderable: true },
									{ data: 'tanggal', name: 'tanggal', orderable: true },
									{ data: 'datang', name: 'datang', orderable: true},
									{ data: 'pulang', name: 'pulang', orderable: true },
									{ data: 'id_device', name: 'id_device', orderable: true },
									//{ data: 'device_no', name: 'device_no', orderable: true },
									//{ data: 'user_no', name: 'user_no', orderable: true },
								],
								order: [[3, 'desc']], // Default sort pada kolom date
							});
						});
						
						$(document).ready(function () {
							$('#attendanceRecapTable').DataTable({
								processing: true,
								serverSide: true,
								ajax: "{{ route('admin.dashboard.getAttendanceRecaps') }}",
								/* data:function(data) {
									delete data.row_number;
								}, */
								columns: [
									//{ data: 'row_number', name: 'row_number', orderable: false, searchable: false },
									//{ data: 'row_number', name: 'row_number', title: '#', orderable: false, searchable: false,"render":function(data,type,full,meta){return meta.row + meta.settings._iDisplayStart + 1;;} },

									{ 
										data: 'DT_RowIndex', 
										name: 'DT_RowIndex', 
										title: '#',
										orderable: false, // Nonaktifkan pengurutan
										searchable: false // Nonaktifkan pencarian
									},
									{data: 'nama', orderable: true, name: 'absensi_users.nama',searchable:true },
									{data: 'datang_awal', orderable: true, name: 'datang_awal',searchable:false },
									{data: 'tepat_waktu', orderable: true, name: 'tepat_waktu',searchable:false },
									{data: 'terlambat', orderable: true, name: 'terlambat',searchable:false },
									{data: 'jumlah_hari_masuk', orderable: true, name: 'jumlah_hari_masuk',searchable:false },
									{data: 'total_jam_masuk', orderable: true, name: 'total_jam_masuk',searchable:false },
									{data: 'overtime_days', orderable: true, name: 'overtime_days',searchable:false },
									{data: 'overtime_hours', orderable: true, name: 'overtime_hours',searchable:false },
									//{ data: 'device_no', name: 'device_no', orderable: true },
									//{ data: 'user_no', name: 'user_no', orderable: true },
								],
								order: [[1, 'asc']], // Default sort pada kolom date
							});
						});
					</script>
				</div>
			</div>
		</div>
		
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- JavaScript -->
    <script>
        // Data Presensi
        const attendanceData = {
            labels: ['Datang Awal', 'Tepat Waktu', 'Terlambat'],
            datasets: [{
                label: 'Presensi',
                data: [ {{ $pieToday->datang_awal ?? 0 }}, {{ $pieToday->tepat_waktu ?? 0 }}, {{ $pieToday->terlambat ?? 0 }} ],
                backgroundColor: ['#0d6efd', '#ffc107', '#dc3545'],
                hoverOffset: 4
            }]
        };
        const attendanceDataMonth = {
            labels: ['Datang Awal', 'Tepat Waktu', 'Terlambat'],
            datasets: [{
                label: 'Presensi',
                data: [ {{ $pieMonth->datang_awal ?? 0 }}, {{ $pieMonth->tepat_waktu ?? 0 }}, {{ $pieMonth->terlambat ?? 0 }} ],
                backgroundColor: ['#0d6efd', '#ffc107', '#dc3545'],
                hoverOffset: 4
            }]
        };

        // Pie Chart: Attendance Overview
        const attendanceChartTodayCtx = document.getElementById('attendanceChartToday').getContext('2d');
        new Chart(attendanceChartTodayCtx, {
            type: 'pie',
            data: attendanceData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                const total = attendanceData.datasets[0].data.reduce((acc, curr) => acc + curr,
                                    0);
                                const percentage = ((tooltipItem.raw / total) * 100).toFixed(2);
                                return `${tooltipItem.label}: ${tooltipItem.raw} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Pie Chart: Attendance Overview
        const attendanceChartMonthCtx = document.getElementById('attendanceChartMonth').getContext('2d');
        new Chart(attendanceChartMonthCtx, {
            type: 'pie',
            data: attendanceDataMonth,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                const total = attendanceDataMonth.datasets[0].data.reduce((acc, curr) => acc + curr,
                                    0);
                                const percentage = ((tooltipItem.raw / total) * 100).toFixed(2);
                                return `${tooltipItem.label}: ${tooltipItem.raw} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Detailed Data (Bar Chart)
        const detailedData = {
            labels: ['Hari 1', 'Hari 2', 'Hari 3', 'Hari 4', 'Hari 5'],
            datasets: [{
                    label: 'Ontime',
                    data: [30, 35, 28, 40, 17],
                    backgroundColor: '#0d6efd',
                },
                {
                    label: 'Terlambat',
                    data: [10, 5, 8, 3, 7],
                    backgroundColor: '#ffc107',
                },
                {
                    label: 'Overtime',
                    data: [2, 4, 1, 6, 3],
                    backgroundColor: '#dc3545',
                }
            ]
        };

        const detailedChartYearCtx = document.getElementById('detailedChartYear').getContext('2d');
        new Chart(detailedChartYearCtx, {
            type: 'bar',
            data: detailedData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true,
                    }
                }
            }
        });
    </script>
@endsection
