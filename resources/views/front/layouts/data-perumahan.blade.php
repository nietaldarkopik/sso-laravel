@extends('front.master-front')

@section('content')
<div id="section4" class="container-fluid section p-0 m-0" style="background-image: url('assets/img/hero-bg.png');">
  <div class="content rounded-0" style="backdrop-filter: blur(5px); width: 100%; height: 150px;"></div>
</div>

<div id="section3" class="container py-5">
  <h2>Data Perumahan</h2>
  <form id="filter-form" class="row">
    <div class="col-md-4">
      <div class="input-group mb-3">
        <span class="input-group-text">
          <i class="fa fa-search" aria-hidden="true"></i>
        </span>
        <div class="form-floating">
          <input type="text" class="form-control" id="floatingInputGroup1" placeholder="Cari">
          <label for="floatingInputGroup1">Cari</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-floating">
        <select id="filter-kabupaten" name="kabupaten" class="form-control">
          <option value="">Semua Kabupaten/Kota</option>
        </select>
        <label for="floatingSelect">Kabupaten/Kota</label>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-floating">
        <select id="filter-kecamatan" name="kecamatan" class="form-control">
          <option value="">Semua Kecamatan</option>
        </select>
        <label for="floatingSelect">Kecamatan</label>
      </div>
    </div>
    <!-- <div class="col-md-2">
      <div class="form-floating">
        <select id="filter-kelurahan" name="kelurahan" class="form-control">
          <option value="">Semua Kelurahan/Desa</option>
        </select>
        <label for="floatingSelect">Kelurahan/Desa</label>
      </div>
    </div> -->
    <div class="col-md-2">
      <button type="submit" class="btn btn-primary">Apply</button>
    </div>
    <!-- 
      <div class="col-md-12">
        <div class="checkboxes in-row margin-bottom-20">
          <input id="ba-serah-terima" type="checkbox" name="ba_serah_terima" value="1">
          <label for="ba-serah-terima">Dengan BAST</label>

          <input id="status-imb" type="checkbox" name="status_imb" value="1">
          <label for="status-imb">Dengan IMB/PBG</label>
        </div>
      </div> 
    -->
    <hr>
  </form>

  <!-- <div class="row">
    <div class="col-12">
      <button class="btn btn-primary mb-3 btn-filter-toggle">Filter</button>
    </div>
  </div> -->

  <div class="row">
    <div class="col-12">
      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-light align-middle">
          <thead class="table-light">
            <caption>
              Data Perumahan
            </caption>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Nama Perumahan</th>
              <th class="text-center">Nama Pengembang</th>
              <th class="text-center">Tahun</th>
              <th class="text-center">Kabupaten/Kota</th>
              <th class="text-center">Kecamatan</th>
              <th class="text-center">Luas (m<sup>2</sup>)</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <tr>
              <td class="text-center">1</td>
              <td><strong><a href="./perumahan-detail.php" class="text-primary">ASABRI GRAHA
                    CITRA MAS CIMALAKA</a></strong></td>
              <td>PT GRAHA CITRAMAS</td>
              <td class="text-center">1991</td>
              <td>Banjarmasin</td>
              <td>Kec. Cimalaka</td>
              <td class="text-right">45.083</td>
            </tr>
            <tr>
              <td class="text-center">2</td>
              <td><strong><a href="./perumahan-detail.php" class="text-primary">BUMI KARYA
                    INDAH</a></strong></td>
              <td>PT. Karyataruna Adhitama</td>
              <td class="text-center">2022</td>
              <td>Banjarmasin</td>
              <td>Kec. Cimalaka</td>
              <td class="text-right">-</td>
            </tr>
            <tr>
              <td class="text-center">3</td>
              <td><strong><a href="./perumahan-detail.php" class="text-primary">BUMI KENANGA
                    ASRI</a></strong></td>
              <td>PT. SANGKURIANG MEDAL PRATAMA</td>
              <td class="text-center">2020</td>
              <td>Banjarmasin</td>
              <td>Kec. Cimalaka</td>
              <td class="text-right">-</td>
            </tr>
            <tr>
              <td class="text-center">4</td>
              <td><strong><a href="./perumahan-detail.php" class="text-primary">Blizt
                    C'Malaka</a></strong></td>
              <td>PT. Isa Hira Jarisu</td>
              <td class="text-center">2020</td>
              <td>Banjarmasin</td>
              <td>Kec. Cimalaka</td>
              <td class="text-right">12.179</td>
            </tr>
            <tr>
              <td class="text-center">5</td>
              <td><strong><a href="./perumahan-detail.php" class="text-primary">Blizt C'Malaka
                    2</a></strong></td>
              <td>PT. Isa Hira Jarisu</td>
              <td class="text-center">2022</td>
              <td>Banjarmasin</td>
              <td>Kec. Cimalaka</td>
              <td class="text-right">15.686</td>
            </tr>
            <tr>
              <td class="text-center">6</td>
              <td><strong><a href="./perumahan-detail.php" class="text-primary">Bumi Surya
                    Cimalaka</a></strong></td>
              <td>PT. TOTAL CIPTA KARYA</td>
              <td class="text-center">2022</td>
              <td>Banjarmasin</td>
              <td>Kec. Cimalaka</td>
              <td class="text-right">7.462</td>
            </tr>
            <tr>
              <td class="text-center">7</td>
              <td><strong><a href="./perumahan-detail.php" class="text-primary">CIMALAKA
                    TOWNHOUSE</a></strong></td>
              <td>PT. MITRA PERKASA PROPERTINDO</td>
              <td class="text-center">2021</td>
              <td>Banjarmasin</td>
              <td>Kec. Cimalaka</td>
              <td class="text-right">13.023</td>
            </tr>
            <tr>
              <td class="text-center">8</td>
              <td><strong><a href="./perumahan-detail.php" class="text-primary">CITYMOON
                    VILLAGE</a></strong></td>
              <td>-</td>
              <td class="text-center">2019</td>
              <td>Banjarmasin</td>
              <td>Kec. Cimalaka</td>
              <td class="text-right">7.296</td>
            </tr>
            <tr>
              <td class="text-center">9</td>
              <td><strong><a href="./perumahan-detail.php" class="text-primary">Cluster D
                    Village</a></strong></td>
              <td>-</td>
              <td class="text-center">2021</td>
              <td>Banjarmasin</td>
              <td>Kec. Cimalaka</td>
              <td class="text-right">4.414</td>
            </tr>
            <tr>
              <td class="text-center">10</td>
              <td><strong><a href="./perumahan-detail.php" class="text-primary">GRAND PARK
                    CIMALAKA 1</a></strong></td>
              <td>PT. RAHAYU PUTRA EKS</td>
              <td class="text-center">2018</td>
              <td>Banjarmasin</td>
              <td>Kec. Cimalaka</td>
              <td class="text-right">9.035</td>
            </tr>
            <tr>
              <td class="text-center">11</td>
              <td><strong><a href="./perumahan-detail.php" class="text-primary">GRAND PARK
                    CIMALAKA 2</a></strong></td>
              <td>PT MITA PERKASA PROPERTINDO</td>
              <td class="text-center">2022</td>
              <td>Banjarmasin</td>
              <td>Kec. Cimalaka</td>
              <td class="text-right">71.241</td>
            </tr>
            <tr>
              <td class="text-center">12</td>
              <td><strong><a href="./perumahan-detail.php" class="text-primary">GRIA PANORAMA
                    SUMEDANG</a></strong></td>
              <td>PT INGRIA PRATAMA CAPITALINDO</td>
              <td class="text-center">2022</td>
              <td>Banjarmasin</td>
              <td>Kec. Cimalaka</td>
              <td class="text-right">18.225</td>
            </tr>
            <tr>
              <td class="text-center">13</td>
              <td><strong><a href="./perumahan-detail.php" class="text-primary">GRIYA CIMALAKA
                    ASRI</a></strong></td>
              <td>PT. Tri Karya Lingga</td>
              <td class="text-center">2020</td>
              <td>Banjarmasin</td>
              <td>Kec. Cimalaka</td>
              <td class="text-right">10.015</td>
            </tr>
            <tr>
              <td class="text-center">14</td>
              <td><strong><a href="./perumahan-detail.php" class="text-primary">GRIYA PERMATA
                    SUMEDANG</a></strong></td>
              <td>PT. PERMATA AGUNG SUMEDANG</td>
              <td class="text-center">2017</td>
              <td>Banjarmasin</td>
              <td>Kec. Cimalaka</td>
              <td class="text-right">40.000</td>
            </tr>
            <tr>
              <td class="text-center">15</td>
              <td><strong><a href="./perumahan-detail.php" class="text-primary">Jatihurip
                    Manunggal</a></strong></td>
              <td>PT. Mikdad Perkasa Abadi</td>
              <td class="text-center">2023</td>
              <td>Banjarmasin</td>
              <td>Kec. Cimalaka</td>
              <td class="text-right">14.781</td>
            </tr>
          </tbody>
          <tfoot>

          </tfoot>
        </table>
      </div>

    </div>
  </div>
</div>
@endsection