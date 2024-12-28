@extends('front.master-front')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div id="section4" class="container-fluid section p-0 m-0" style="background-image: url('assets/img/hero-bg.png');">
  <div class="content rounded-0" style="backdrop-filter: blur(5px); width: 100%; height: 150px;"></div>
</div>


<div id="section3" class="container blog">
  <div class="row entry entry-single">
    <div class="col-12">

      <h2 class="text-center">Grafik Jumlah Perumahan</h2>
      <p class="text-center">Berikut adalah Grafik Jumlah Perumahan setiap kabupaten/kota</p>
    </div>
    <div class="col-sm-6 col-12">
      <div class="card my-2 text-center">
        <div class="card-body text-dark">
          <canvas id="pieJumlahPerumahanChart" width="400" height="400"></canvas>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-12">
      <div class="card my-2 text-center">
        <div class="card-body text-dark">
          <h2 class="fs-4">Total Perumahan</h2>
          <div id="pieJumlahPerumahanTable"></div>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="section4" class="container blog">

  <div class="row entry entry-single">
    <div class="col-12">
      <h2 class="text-center">Grafik Jumlah PSU</h2>
      <p class="text-center">Berikut adalah Grafik Jumlah PSU setiap kabupaten/kota</p>
    </div>
    <div class="col-sm-6 col-12">
      <div class="card my-2 text-center">
        <div class="card-body text-dark">
          <canvas id="barJumlahPsuCart" width="400" height="400"></canvas>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-12">
      <div class="card my-2 text-center">
        <div class="card-body text-dark">
          <h2 class="fs-4">Total PSU</h2>
          <div id="barJumlahPsuTable"></div>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="section4" class="container blog">

  <div class="row entry entry-single">
    <div class="col-12">
      <h2 class="text-center">Grafik BAST</h2>
      <p class="text-center">Berikut adalah Grafik status BAST setiap kabupaten/kota</p>
    </div>
    <div class="col-sm-6 col-12">
      <div class="card my-2 text-center">
        <div class="card-body text-dark">

          <canvas id="psuChart" width="800" height="400"></canvas>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-12">
      <div class="card my-2 text-center">
        <div class="card-body text-dark">
          <h2 class="fs-4">Total BAST PSU</h2>
          <div id="psuTable"></div>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="section4" class="container blog">
  <div class="row entry entry-single">
    <div class="col-12">
      <h2 class="text-center">Grafik Jumlah Jenis PSU</h2>
      <p class="text-center">Berikut adalah Grafik Jumlah Jenis PSU setiap kabupaten/kota</p>
    </div>
    <div class="col-sm-6 col-12">
      <div class="card my-2 text-center">
        <div class="card-body text-dark">
          <canvas id="infrastructureChart" width="800" height="400"></canvas>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-12">
      <div class="card my-2 text-center">
        <div class="card-body text-dark">
          <h2 class="fs-4">Total PSU</h2>
          <div id="infrastructureTable">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="section4" class="container-fluid section p-0 m-0" style="background-image: url('assets/img/hero-bg.png');">
  <div class="content rounded-0" style="backdrop-filter: blur(5px); width: 100%; height: 150px;"></div>
</div>

<script>
  // Data prasarana, sarana, dan utilitas di beberapa kota/kabupaten di Kalimantan Selatan
  var psu = [
    {
      title: 'Pra Sarana',
      childs: [
        { title: 'Jalan' },
        { title: 'Drainase' },
        { title: 'Air Minum' },
        { title: 'Sanitasi' },
        { title: 'Air Limbah' },
      ],
    },
    {
      title: 'Sarana',
      childs: [
        { title: 'Sarana Perniagaan/ Perbelanjaan' },
        { title: 'Sarana Pelayanan Umum Dan Pemerintahan' },
        { title: 'Sarana Pendidikan' },
        { title: 'Sarana Kesehatan' },
        { title: 'Sarana Peribadatan' },
        { title: 'Sarana Rekreasi Dan Olah Raga' },
        { title: 'Sarana Pemakaman' },
        { title: 'Sarana Pertamanan Dan Ruang Terbuka Hijau (RTH)' },
        { title: 'Sarana Parkir' },
      ],
    },
    {
      title: 'Utilitas',
      childs: [
        { title: 'jaringan listrik' },
        { title: 'jaringan air bersih' },
        { title: 'jaringan telepon' },
        { title: 'jaringan gas' },
        { title: 'jaringan transportasi' },
        { title: 'pemadam kebakaran' },
        { title: 'sarana penerangan jalan umum' },
      ],
    },
  ];

  var cities = ['KAB. TANAH LAUT', 'KAB. KOTABARU', 'KAB. BANJAR', 'KAB. BARITO KUALA', 'KAB. TAPIN', 'KAB. HULU SUNGAI SELATAN', 'KAB. HULU SUNGAI TENGAH', 'KAB. HULU SUNGAI UTARA', 'KAB. TABALONG', 'KAB. TANAH BUMBU', 'KAB. BALANGAN', 'KOTA BANJARMASIN', 'KOTA BANJARBARU'];
  var electricity = cities.map((v, i, a) => { return Math.floor(Math.random() * 100); }); // Persentase akses listrik
  var cleanWater = cities.map((v, i, a) => { return Math.floor(Math.random() * 100); }); // Persentase akses air bersih
  var roads = cities.map((v, i, a) => { return Math.floor(Math.random() * 100); }); // Persentase ketersediaan jalan

  // Membuat chart
  var ctx = document.getElementById('infrastructureChart').getContext('2d');
  var infrastructureChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: cities,
      datasets: [{
        label: 'Akses Listrik (%)',
        data: electricity,
        backgroundColor: 'rgba(255, 99, 132, 0.5)'
      }, {
        label: 'Akses Air Bersih (%)',
        data: cleanWater,
        backgroundColor: 'rgba(54, 162, 235, 0.5)'
      }, {
        label: 'Ketersediaan Jalan (%)',
        data: roads,
        backgroundColor: 'rgba(255, 206, 86, 0.5)'
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<script>
  // Data PSU dengan dan tanpa BAST per Kota/Kabupaten
  var withBast = cities.map((v, i, a) => { return Math.floor(Math.random() * 100); });; // Jumlah PSU dengan BAST per Kota/Kabupaten (contoh data)
  var withoutBast = cities.map((v, i, a) => { return Math.floor(Math.random() * 100); });; // Jumlah PSU tanpa BAST per Kota/Kabupaten (contoh data)

  // Membuat chart
  var ctx = document.getElementById('psuChart').getContext('2d');
  var psuChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: cities,
      datasets: [{
        label: 'Dengan BAST',
        data: withBast,
        backgroundColor: 'rgba(54, 162, 235, 0.5)'
      }, {
        label: 'Tanpa BAST',
        data: withoutBast,
        backgroundColor: 'rgba(255, 99, 132, 0.5)'
      }]
    },
    options: {
      scales: {
        x: {
          stacked: true // Mengelompokkan bar secara horizontal
        },
        y: {
          stacked: true // Mengelompokkan bar secara vertikal
        }
      }
    }
  });

  var psuCarttmp = cities.map((v, i, a) => {
    return '<tr><td>' + ((i + 1).toString()) + '</td><td class="text-start">' + v + '</td><td>' + withoutBast[i] + '</td><td>' + withBast[i] + '</td><td>' + ((withBast[i] + withoutBast[i]).toString()) + '</td></tr>';
  });
  $("#psuTable").html('<table class="table table-striped table-bordered"><thead><tr><th>No</th><th>Kab/Kota</th><th>Belum BAST</th><th>Sudah BAST</th><th>Total</th></tr></thead><tbody>' + psuCarttmp.join('') + '</tbody></table>')

</script>

<script>
  const randomRgba = function (alpha) {
    var r = Math.floor(Math.random() * 256); // Komponen merah
    var g = Math.floor(Math.random() * 256); // Komponen hijau
    var b = Math.floor(Math.random() * 256); // Komponen biru
    var a = alpha; //Math.random(); // Alpha (transparansi)

    // Format nilai RGBA sebagai string
    return 'rgba(' + r + ', ' + g + ', ' + b + ', ' + a + ')';
  }
  // Data Kabupaten
  var kabupaten = cities;
  // Jumlah penduduk masing-masing kabupaten (contoh angka)
  var jumlahPerumahan = cities.map((v, i, a) => { return 20 + Math.floor(Math.random() * 300); });
  // Warna untuk setiap bagian
  var colors = cities.map((v, i, a) => { return randomRgba(.9) });

  var ctx = document.getElementById('pieJumlahPerumahanChart').getContext('2d');
  var myPieJumlahPerumahanChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: kabupaten,
      datasets: [{
        data: jumlahPerumahan,
        backgroundColor: colors
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Penduduk Kabupaten/Kota di Kalimantan Selatan'
      }
    }
  });

  var pieJumlahPerumahanTabletmp = cities.map((v, i, a) => {
    return '<tr><td>' + ((i + 1).toString()) + '</td><td class="text-start"><span style="background-color: ' + colors[i] + ' !important; width: 10px; height: 10px; padding:2px; display:inline-block;"></span> ' + v + '</td><td>' + jumlahPerumahan[i] + '</td></tr>';
  });
  $("#pieJumlahPerumahanTable").html('<table class="table table-striped table-bordered"><thead><tr><th>No</th><th>Kab/Kota</th><th>Jumlah</th></tr></thead><tbody>' + pieJumlahPerumahanTabletmp.join('') + '</tbody></table>')

</script>

<script>
  // Data Kabupaten
  var kabupaten = cities;
  // Data ketersediaan sarana prasarana (contoh angka)
  var saranaPrasarana = kabupaten.map((v, i, a) => { return 20 + Math.floor(Math.random() * 300); });

  var ctx = document.getElementById('barJumlahPsuCart').getContext('2d');
  var mybarJumlahPsuCart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: kabupaten,
      datasets: [{
        label: 'Ketersediaan Sarana Prasarana (%)',
        data: saranaPrasarana,
        backgroundColor: 'rgba(54, 162, 235, 0.5)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        xAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      },
      title: {
        display: true,
        text: 'Ketersediaan Sarana Prasarana per Kabupaten/Kota di Kalimantan Selatan'
      }
    }
  });


  var barJumlahPsuCarttmp = kabupaten.map((v, i, a) => {
    return '<tr><td>' + ((i + 1).toString()) + '</td><td class="text-start"><span style="background-color: ' + colors[i] + ' !important; width: 10px; height: 10px; padding:2px; display:inline-block;"></span> ' + v + '</td><td>' + jumlahPerumahan[i] + '</td></tr>';
  });
  $("#barJumlahPsuTable").html('<table class="table table-striped table-bordered"><thead><tr><th>No</th><th>Kab/Kota</th><th>Jumlah</th></tr></thead><tbody>' + barJumlahPsuCarttmp.join('') + '</tbody></table>')

</script>
@endsection