<h2 class="card-title fw-bold fs-4">Laporan Presensi</h2>
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
<style>
{!! file_get_contents('https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css') !!}
		table {
            width: 100%;
            border-collapse: collapse;
			page-break-before:auto;
        }

        thead {
            display: table-header-group;
        }

        tbody {
            display: table-row-group;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        th, td {
            word-wrap: break-word;
            overflow-wrap: break-word;
            border: 1px solid black;
            padding: 8px;
        }
</style>
<div class="container">
{{-- <link rel="stylesheet" href="{{ asset('public/build/assets/app-gUA5Mw-f.css') }}"/> --}}
<div class="row">
<div class="col-md-12">
<table class="table table-striped table-bordered table-secondary" id="table-presensi-content" style="width: 800px;">
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
		$attendances = \App\Models\AbsensiAttendenceLogModel::whereBetween('waktu',$filter_tanggal)->get();

		// Meremapkan data sesuai kebutuhan
		$remappedData = [];
		$userJam = [];
		foreach ($attendances as $attendance) {
			$userId = $attendance->id_user;
			$date = \Carbon\Carbon::parse($attendance->waktu)->format("Y-m-d");
			if (!isset($remappedData[$userId])) {
				$remappedData[$userId] = [];
			}
			if (!isset($remappedData[$userId][$date])) {
				$remappedData[$userId][$date] = [
					'id_user' => $userId,
					'tanggal' => $date,
					'datang' => $attendance->waktu,
					'pulang' => $attendance->waktu,
					'id_device_datang' => $attendance->id_device,
					'id_device_pulang' => $attendance->id_device,
					'jam' => 1,
				];
			} else {
				if ($attendance->waktu < $remappedData[$userId][$date]['datang']) {
					$remappedData[$userId][$date]['datang'] = $attendance->waktu;
					$remappedData[$userId][$date]['id_device_datang'] = $attendance->id_device;
					$remappedData[$userId][$date]['device_datang'] = $attendance->device->location;
				}
				if ($attendance->waktu > $remappedData[$userId][$date]['pulang']) {
					$remappedData[$userId][$date]['pulang'] = $attendance->waktu;
					$remappedData[$userId][$date]['id_device_pulang'] = $attendance->id_device;
					$remappedData[$userId][$date]['device_pulang'] = $attendance->device->location;
				}
			}

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