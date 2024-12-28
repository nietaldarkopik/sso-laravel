@extends('adminlte::page')

@section('plugins.Bootstrap4DualListbox', true)
@section('plugins.BootstrapColorpicker', true)
@section('plugins.BootstrapSlider', true)
@section('plugins.BootstrapSwitch', true)
@section('plugins.BsCustomFileInput', true)
@section('plugins.ChartJs', true)
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugins', false)
@section('plugins.DatatablesButton', true)
@section('plugins.Daterangepicker', true)
@section('plugins.lightbox', true)
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
@section('plugins.Sweetalert2', true)
@section('plugins.AnimateCss', true)
{{-- @section('plugins.Summernote', true) --}}
{{-- @section('plugins.TempusdominusBootstrap4', true)
@section('plugins.Toastr', true) --}}

@section('title', 'Laporan Presensi')

@section('content_header')
    <h1 class="m-0 text-dark">Laporan Presensi</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="card-title fw-bold fs-4">Laporan Presensi</h2>
            <div class="card-tools">
                {{-- @can('admin.laporan.create')
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.laporan.create') }}" data-toggle="modal" data-target="#modalLgId" data-modal-title="Tambah Data">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah
                    </a>
                @endcan --}}
            </div>
        </div>
        <div class="card-header py-1">
			<form method="post" action="{{ route('admin.laporan.index') }}">
				@csrf
				@method('get')
				<div class="form-row mb-0 d-flex justify-content-stretch">
					{{-- <div class="form-group mb-0 col-sm-2">
						<label for="" class="form-label">Jenis Laporan</label>
						<select class="form-select form-custom border py-0 text-italic-0 form-control-sm w-100 custom-select2" name="filter[kabkota_id]" id="filter-kabkota_id">
							<option value="">Jenis Laporan ...</option>
							<option value="harian">Harian</option>
							<option value="bulanan">Bulanan</option>
							<option value="tahunan">Tahunan</option>
							<option value="range tanggal">Range Tanggal</option>
						</select>
					</div> --}}
					<div class="form-group mb-0 col-sm-2">
						<label for="" class="form-label">Tanggal</label>
						<input type="text" class="form-control daterangepicker-custom" name="filter_tanggal" id="filter-tanggal">
					</div>
					<div class="form-group mb-0 col-sm-2">
						<label for="" class="form-label">Device/Lokasi</label>
						<select class="form-select form-custom border py-0 text-italic-0 form-control-sm w-100 custom-select2" name="filter_id_device" id="filter-id_device">
							<option value="">Semua ...</option>
							@foreach(App\Models\AbsensiDeviceModel::get() as $i => $d)
							<option value="{{ $d->id }}">{{ $d->device_name }} / {{ $d->location }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group mb-0 col-sm-2">
						<label for="" class="form-label">Karyawan</label>
						<select class="form-select form-custom border py-0 text-italic-0 form-control-sm w-100 custom-select2" name="filter_id_user" id="filter-id_user">
							<option value="" selected>Semua ...</option>
							@foreach(App\Models\AbsensiUserModel::get() as $i => $d)
							<option value="{{ $d->id }}">{{ $d->nama }} / {{ $d->jabatan }}</option>
							@endforeach
						</select>
					</div>
					{{-- <div class="form-group mb-0 col-sm-2">
						<label for="" class="form-label">Jenis</label>
						<select class="form-select form-custom border py-2 text-italic-0 form-control w-100" name="filter_jenis" id="filter-jenis">
							<option value="hadir" selected>Hadir</option>
							<option value="tidak hadir" selected>Tidak Hadir</option>
						</select>
					</div> --}}
					<div class="col-auto">
						<label for="" class="form-label">Aksi</label>
						<div class="row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-md btn-primary" id="search-post">
									<i class="fa fa-search" aria-hidden="true"></i> Cari
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 py-3">
						{{-- <button type="submit" class="btn btn-sm btn-sm btn-primary" id="download-pdf" name="do_download_pdf" value="do_pdf">
							<i class="fa fa-file-pdf" aria-hidden="true"></i> Download PDF
						</button> --}}
						<button type="button" class="btn btn-sm btn-sm btn-primary" id="download-xls">
							<i class="fa fa-file-excel" aria-hidden="true"></i> Download XLS
						</button>
					</div>
				</div>
			</form>
        </div>
        <div class="card-body">
			@php

				$start_date = (isset($filter_tanggal[0]) and !empty($filter_tanggal[0]))?$filter_tanggal[0]:date("Y-m-d")." 00:00:00";
				$end_date = (isset($filter_tanggal[1]) and !empty($filter_tanggal[1]))?$filter_tanggal[1]:date("Y-m-d")." 23:59:59";
				
				// Menghasilkan semua tanggal dalam rentang tersebut
				$period = \Carbon\CarbonPeriod::create($start_date, $end_date);

				// Mengonversi periode ke array tanggal
				$years = [];
				$months = [];
				$dates = [];
				$tr1 = [];
				$tr2 = [];
				$tr3 = [];
				foreach ($period as $date) {
					if(!isset($years[$date->format('Y')]))
					{
						$years[$date->format('Y')] = [];
					}
					if(!isset($months[$date->format('Y-m')]))
					{
						$months[$date->format('Y-m')] = [];
					}
					$years[$date->format('Y')][] = $date->format('Y-m-d');
					$months[$date->format('Y-m')][] = $date->format('Y-m-d');
					$dates[$date->format('Y-m-d')] = $date->format('Y-m-d');
				}

			@endphp
			<div class="table-responsive" id="table-presensi">
				<table class="table table-striped table-bordered table-secondary" id="table-presensi-content">
					<thead>
						<tr>
							<th rowspan="4" class="bg-light">No</th>
							<th rowspan="4" class="bg-light text-nowrap">Nama Karyawan</th>
							<th rowspan="3" class="bg-light text-center" colspan="2">Total</th>
							<th rowspan="4" class="bg-light text-center">Jenis</th>
							@foreach($years as $i => $y)
							<th colspan="{{ count($y)*2 }}">{{ $i }}</th>
							@endforeach
						</tr>
						<tr>
							@foreach($months as $i => $m)
								<th colspan="{{ count($m)*2 }}">{{ \Carbon\Carbon::parse($i)->translatedFormat("M") }}</th>
							@endforeach
						</tr>
						<tr>
							@foreach($dates as $i => $d)
							<th colspan="2">{{ \Carbon\Carbon::parse($d)->translatedFormat('d') }}</th>
							@endforeach
						</tr>
						<tr>
							<th class="text-center bg-light">Hari</th>
							<th class="text-center bg-light">Jam</th>
							@foreach($dates as $i => $d)
							<th>Waktu</th>
							<th>Lokasi</th>
							@endforeach
						</tr>
					</thead>
					<tbody>
						@if(!empty(implode("",$filter_tanggal)))
						@php
						$attendances = \App\Models\AbsensiAttendenceModel::whereBetween('datang',$filter_tanggal)->get();

						// Meremapkan data sesuai kebutuhan
						$remappedData = [];
						$userJam = [];
						foreach ($attendances as $attendance) {
							$userId = $attendance->id_user;
							$date = \Carbon\Carbon::parse($attendance->tanggal)->format("Y-m-d");
							if (!isset($remappedData[$userId])) {
								$remappedData[$userId] = [];
							}
							if (!isset($remappedData[$userId][$date])) {
								$remappedData[$userId][$date] = [
									'id_user' => $userId,
									'tanggal' => $date,
									'datang' => $attendance->datang, //$attendance->waktu,
									'pulang' => $attendance->pulang, //$attendance->waktu,
									'id_device_datang' => $attendance->id_device_datang, //$attendance->id_device,
									'id_device_pulang' => $attendance->id_device_pulang, //$attendance->id_device,
									'device_datang' => App\Models\AbsensiDeviceModel::find($attendance->id_device)?->location ?? '',
									'device_pulang' => App\Models\AbsensiDeviceModel::find($attendance->id_device)?->location ?? '',
									'jam' => 1,
								];
							}/*  else {
								if ($attendance->waktu < $remappedData[$userId][$date]['datang']) {
									$remappedData[$userId][$date]['datang'] = $attendance->waktu;
									$remappedData[$userId][$date]['id_device_datang'] = $attendance->id_device;
									$remappedData[$userId][$date]['device_datang'] = App\Models\AbsensiDeviceModel::find($attendance->id_device)?->location ?? '';//$attendance->device->location;
								}
								if ($attendance->waktu > $remappedData[$userId][$date]['pulang']) {
									$remappedData[$userId][$date]['pulang'] = $attendance->waktu;
									$remappedData[$userId][$date]['id_device_pulang'] = $attendance->id_device;
									$remappedData[$userId][$date]['device_pulang'] = App\Models\AbsensiDeviceModel::find($attendance->id_device)?->location ?? ''; //$attendance->device->location;
								}
							} */

							$datang = (isset($remappedData[$userId][$date]['datang']))?$remappedData[$userId][$date]['datang']:0;
							$pulang = (isset($remappedData[$userId][$date]['pulang']))?$remappedData[$userId][$date]['pulang']:0;
							
							$userJam[$userId] = (!isset($userJam[$userId]))?[]:$userJam[$userId];
							$userJam[$userId]['jam'] = (!isset($userJam[$userId]['jam']))?1:$userJam[$userId]['jam'];

							if(!empty($datang) && !empty($pulang)){
								$cdatang = \Carbon\Carbon::parse($datang);
								$cpulang = \Carbon\Carbon::parse($pulang);
								
								$hoursDifference = $cdatang->diffInHours($cpulang);
								$userJam[$userId][$date] = $hoursDifference;
								$remappedData[$userId][$date]['jam'] = (isset($remappedData[$userId][$date]['jam']))?$hoursDifference:1;
							}
						}

						@endphp
						@foreach(\App\Models\AbsensiUserModel::orderBy('nama','asc')->get() as $i => $u)
						@php
						//$presensi = \App\Models\AbsensiAttendenceModel::whereBetween('tanggal',$filter_tanggal)->get();

						$presensi = (isset($remappedData[$u->id]))?$remappedData[$u->id]:[];
						$jam = (isset($userJam[$u->id]))?array_sum($userJam[$u->id]):0;
						$count_hari = (is_array($presensi))?count($presensi):0;
						@endphp
						<tr>
							<td rowspan="2" class="bg-light">{{ $i+1 }}</td>
							<td rowspan="2" class="bg-light text-nowrap">{{ $u->nama }}</td>
							<th rowspan="2" class="bg-light text-center">{{ $count_hari }}</th>
							<th rowspan="2" class="bg-light text-center">{{ $jam }}</th>
							<th class="bg-light">Datang</th>
							@foreach($dates as $i => $d)
							@php
								$currTD = (isset($presensi[$d]))?$presensi[$d]:[];
								$tanggal = (isset($currTD['tanggal']))?$currTD['tanggal']:'';
								$datang = (isset($currTD['datang']))?$currTD['datang']:'';
								$device_datang = (isset($currTD['device_datang']))?$currTD['device_datang']:'';
								$jam = (isset($currTD['jam']))?$currTD['jam']:0;
							@endphp
							{{-- <th>@if {{ $d }} @else ok @endif {{ "$presensi['datang'] == $d" }}</th> --}}
							<th>@if($tanggal == $d ) {{ \Carbon\Carbon::parse($datang)->format("H:i:s") }} @endif</th>
							<th>@if($tanggal == $d ) {{ $device_datang }}  @endif</th>
							@endforeach
						</tr>
						<tr>
							<th class="bg-light">Pulang</th>
							@foreach($dates as $i => $d)
							@php
								$currTD = (isset($presensi[$d]))?$presensi[$d]:[];
								$tanggal = (isset($currTD['tanggal']))?$currTD['tanggal']:'';
								$pulang = (isset($currTD['pulang']))?$currTD['pulang']:'';
								$device_pulang = (isset($currTD['device_pulang']))?$currTD['device_pulang']:'';
							@endphp
							{{-- <th>@if {{ $d }} @else ok @endif {{ "$presensi['pulang'] == $d" }}</th> --}}
							<th>@if($tanggal == $d ) {{ \Carbon\Carbon::parse($pulang)->format("H:i:s") }} @endif</th>
							<th>@if($tanggal == $d ) {{ $device_pulang }} @endif</th>
							@endforeach
						</tr>
						@endforeach
						@endif
					</tbody>
				</table>
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
<script>

// Register custom button type for reset
$.fn.dataTable.ext.buttons.reset = {
	text: 'Reset',
	action: function (e, dt, node, config) {
		dt.search('').columns().search('').draw();
	}
};

// Register custom button type for reload
$.fn.dataTable.ext.buttons.reload = {
	text: 'Reload',
	action: function (e, dt, node, config) {
		dt.ajax.reload();
	}
};
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>

<script src="{{ asset('vendor/datatables-searchpanes/js/dataTables.searchPanes.min.js')}}"></script>
<script src="{{ asset('vendor/datatables-searchpanes/js/searchPanes.bootstrap4.min.js')}}"></script>
<script src="{{ asset('vendor/datatables-select/js/dataTables.select.min.js')}}"></script>
<script src="{{ asset('vendor/datatables-select/js/select.bootstrap4.min.js')}}"></script>

{{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.ajax/2.1.0/leaflet.ajax.min.js"></script>
<script>
    $(function() {
        $('[data-tooltip]').tooltip({});
		
		$('.custom-select2').select2({
			tags: true
		});

		$('.daterangepicker-custom').daterangepicker({
			timePicker: false,
			timePicker24Hour: true,
			locale: {
				format: 'YYYY-MM-DD HH:mm',
            	cancelLabel: 'Kosongkan'
			},
			ranges: {
                    'Hari ini': [moment().startOf('day'), moment().endOf('day')],
                    'Kemarin': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
                    '7 hari Terakhir': [moment().subtract(6, 'days').startOf('day'), moment().endOf('day')],
                    '30 hari terakhir': [moment().subtract(29, 'days').startOf('day'), moment().endOf('day')],
                    'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
                    'Bulan Kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    '3 Bulan Terakhir': [moment().subtract(3, 'months').startOf('month'), moment().endOf('month')],
                    '6 Bulan Terakhir': [moment().subtract(6, 'months').startOf('month'), moment().endOf('month')],
                    'Tahun Ini': [moment().startOf('year'), moment().endOf('year')],
                    'Tahun Kemarin': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                }
		});
    });

    $('.daterangepicker-custom').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    //The search button event listener
    $('#search').on('click', function(e) {
        e.preventDefault();
        var params = {};
		var tanggal = $("#filter-tanggal").val();
		var id_device = $("#filter-id_device").val();
		var id_user = $("#filter-id_user").val();
		var jenis = $("#filter-jenis").val();
		var tanggal_arr = tanggal.split(' - ');
		var start_date = tanggal_arr[0];
		var end_date = tanggal_arr[1];

        window.LaravelDataTables["absensi-users-table"].table()
														.ajax
														.url('{{ route('admin.laporan.index') }}?jenis='+jenis+'&id_device='+id_device+'&id_user='+id_user+'&start_date='+start_date+'&start_date=' + start_date + '&end_date=' + end_date)
														.load();
		/* window.LaravelDataTables["absensi-users-table"].table().ajax.params ={
			start_date: start_date,
			end_date: end_date
		};
		console.log(window.LaravelDataTables["absensi-users-table"].table().ajax.params);
        window.LaravelDataTables["absensi-users-table"].table().ajax.data({
			start_date: start_date,
			end_date: end_date
		}).load();
		
		 //window.LaravelDataTables["absensi-users-table"].column(8).search(tahun_siteplan ? tahun_siteplan : '', false, false);
		 window.LaravelDataTables["absensi-users-table"].table().ajax.reload(); //draw(); */
    });
	
</script>


<script>
	let pdf = null;

	function processImageCanvas(canvas) {
		// Inisialisasi jsPDF jika belum
		if (!pdf) {
			pdf = new jsPDF('p', 'pt', [canvas.width, canvas.height]);
		} else {
			// Tambahkan halaman baru jika diperlukan
			pdf.addPage([canvas.width, canvas.height]);
		}

		// Menambahkan gambar dari canvas ke PDF
		pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, canvas.width, canvas.height);
	}

	function createPDF() {
		// Jika ada objek pdf yang telah dibuat
		if (pdf) {
			// Simpan PDF dengan nama file
			pdf.save('split_images_to_pdf.pdf');
		}
	}

	function splitImage(imgData, imgWidth, imgHeight) {
		const sliceHeight = 1000; // Tinggi setiap bagian gambar

		let startY = 0;
		let sliceIndex = 0;

		while (startY < imgHeight) {
			const canvas = document.createElement('canvas');
			const ctx = canvas.getContext('2d');
			canvas.width = imgWidth;
			canvas.height = Math.min(sliceHeight, imgHeight - startY);

			// Menggambar bagian dari gambar utuh ke canvas baru
			ctx.drawImage(
				imgData,
				0, startY, imgWidth, Math.min(sliceHeight, imgHeight - startY),
				0, 0, imgWidth, Math.min(sliceHeight, imgHeight - startY)
			);

			// Menyimpan atau menggunakan canvas untuk setiap bagian gambar
			// Misalnya, Anda bisa menambahkannya ke array atau mengolahnya lebih lanjut
			processImageCanvas(canvas); // Fungsi untuk memproses canvas

			// Menyiapkan untuk memproses bagian berikutnya
			startY += sliceHeight;
			sliceIndex++;
		}

		// Setelah membagi gambar, Anda dapat mulai membuat PDF
		createPDF();
	}

/* 
	document.getElementById('download-pdf').addEventListener('click', () => {
		const { jsPDF } = window.jspdf;
		const content = document.getElementById('table-presensi-content');
		const pdf = new jsPDF('l', 'pt', 'a4');
		const pageWidth = pdf.internal.pageSize.getWidth();
		const pageHeight = pdf.internal.pageSize.getHeight();

		html2canvas(content, { scale: .5}).then(canvas => { // Mengurangi skala menjadi 1
			const imgData = canvas.toDataURL('image/png');
			const imgWidth = canvas.width;
			const imgHeight = canvas.height;
			const ratio = imgHeight / pageHeight;
			const scaledWidth = imgWidth; // / ratio;
			const scaledHeight = pageHeight;

			pdf.addImage(imgData, 'PNG', 0, 0,  imgWidth, imgHeight);
			/* 
			let position = 0;
			let leftWidth = scaledWidth;
			console.log(leftWidth,scaledWidth);
			while (leftWidth > 0) {
				console.log(scaledWidth);
				pdf.addImage(imgData, 'PNG', 0, 0,  imgWidth, imgHeight);
				leftWidth -= pageWidth;
				if (leftWidth > 0) {
					console.log("page added");
					pdf.addPage();
					position = -leftWidth;
				}
			} *\/

			pdf.save('wide_and_long_table.pdf');
		}).catch(error => {
			console.error('Error generating PDF:', error);
		});
	});
 */
	document.getElementById('download-xls').addEventListener('click', () => {
            //const table = document.getElementById('table-presensi-content');
            const table = $("#table-presensi")[0];
            const wb = XLSX.utils.table_to_book(table, {sheet:"Sheet1"});
            const ws = wb.Sheets["Sheet1"];

            // Define styles
            const headerCellStyle = {
                font: { bold: true, color: { rgb: "FF0000FF" } },
                fill: { fgColor: { rgb: "FFFF0000" } },
                border: {
                    top: { style: "thin", color: { rgb: "FF000000" } },
                    bottom: { style: "thin", color: { rgb: "FF000000" } },
                    left: { style: "thin", color: { rgb: "FF000000" } },
                    right: { style: "thin", color: { rgb: "FF000000" } }
                }
            };
            const dataCellStyle = {
                border: {
                    top: { style: "thin", color: { rgb: "FF000000" } },
                    bottom: { style: "thin", color: { rgb: "FF000000" } },
                    left: { style: "thin", color: { rgb: "FF000000" } },
                    right: { style: "thin", color: { rgb: "FF000000" } }
                }
            };

            // Apply styles
            const range = XLSX.utils.decode_range(ws['!ref']);
            for(let R = range.s.r; R <= range.e.r; ++R) {
                for(let C = range.s.c; C <= range.e.c; ++C) {
                    const cell_address = {c:C, r:R};
                    const cell_ref = XLSX.utils.encode_cell(cell_address);
                    if(!ws[cell_ref]) continue;

                    if(R === 0) { // header row
                        ws[cell_ref].s = headerCellStyle;
                    } else { // data rows
                        ws[cell_ref].s = dataCellStyle;
                    }
                }
            }

            XLSX.writeFile(wb, 'styled_document.xlsx');
        });
</script>
@endpush

@section('content_top_nav_left') @endsection