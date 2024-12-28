@extends('front.master-front')

@section('content')
<div id="section4" class="container-fluid section p-0 m-0" style="background-image: url('assets/img/hero-bg.png');">
  <div class="content rounded-0" style="backdrop-filter: blur(5px); width: 100%; height: 150px;"></div>
</div>

<div id="section3" class="container py-5">
  <h2>Data Prasarana, Sarana dan Utilitas</h2>
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
            <tr>
              <th>Nama Utilitas/Fasilitas</th>
              <th>Kategori</th>
              <th>Keterangan</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <tr id="utility-facility-707">
              <td>
                Jalan Utama Perumahan
                <input type="hidden" name="perumahan_utilitas_fasilitas_id[]" value="707">
              </td>
              <td>Utilitas</td>
              <td>-</td>
              <td>
                <a href="javascript:void(0);"
                  class="button button-sm border d-inline tooltip btn-detail-utility-facility" title="Lihat detail "
                  data-id="707" data-jenis-id="1"><i class="sl sl-icon-eye"></i></a>

              </td>
            </tr>
            <tr id="utility-facility-708">
              <td>
                Jalan Lingkungan Perumahan
                <input type="hidden" name="perumahan_utilitas_fasilitas_id[]" value="708">
              </td>
              <td>Utilitas</td>
              <td>-</td>
              <td>
                <a href="javascript:void(0);"
                  class="button button-sm border d-inline tooltip btn-detail-utility-facility" title="Lihat detail "
                  data-id="708" data-jenis-id="2"><i class="sl sl-icon-eye"></i></a>

              </td>
            </tr>
            <tr id="utility-facility-709">
              <td>
                Saluran Drainase
                <input type="hidden" name="perumahan_utilitas_fasilitas_id[]" value="709">
              </td>
              <td>Utilitas</td>
              <td>-</td>
              <td>
                <a href="javascript:void(0);"
                  class="button button-sm border d-inline tooltip btn-detail-utility-facility" title="Lihat detail "
                  data-id="709" data-jenis-id="3"><i class="sl sl-icon-eye"></i></a>

              </td>
            </tr>
            <tr id="utility-facility-710">
              <td>
                Sistem Jaringan Air Bersih
                <input type="hidden" name="perumahan_utilitas_fasilitas_id[]" value="710">
              </td>
              <td>Utilitas</td>
              <td>-</td>
              <td>
                <a href="javascript:void(0);"
                  class="button button-sm border d-inline tooltip btn-detail-utility-facility" title="Lihat detail "
                  data-id="710" data-jenis-id="4"><i class="sl sl-icon-eye"></i></a>

              </td>
            </tr>
            <tr id="utility-facility-711">
              <td>
                Sistem Jaringan Limbah Air Kotor
                <input type="hidden" name="perumahan_utilitas_fasilitas_id[]" value="711">
              </td>
              <td>Utilitas</td>
              <td>-</td>
              <td>
                <a href="javascript:void(0);"
                  class="button button-sm border d-inline tooltip btn-detail-utility-facility" title="Lihat detail "
                  data-id="711" data-jenis-id="5"><i class="sl sl-icon-eye"></i></a>

              </td>
            </tr>
            <tr id="utility-facility-712">
              <td>
                Sistem Jaringan Listrik
                <input type="hidden" name="perumahan_utilitas_fasilitas_id[]" value="712">
              </td>
              <td>Utilitas</td>
              <td>-</td>
              <td>
                <a href="javascript:void(0);"
                  class="button button-sm border d-inline tooltip btn-detail-utility-facility" title="Lihat detail "
                  data-id="712" data-jenis-id="7"><i class="sl sl-icon-eye"></i></a>

              </td>
            </tr>
            <tr id="utility-facility-713">
              <td>
                Sistem Jaringan Telekomunikasi
                <input type="hidden" name="perumahan_utilitas_fasilitas_id[]" value="713">
              </td>
              <td>Utilitas</td>
              <td>-</td>
              <td>
                <a href="javascript:void(0);"
                  class="button button-sm border d-inline tooltip btn-detail-utility-facility" title="Lihat detail "
                  data-id="713" data-jenis-id="8"><i class="sl sl-icon-eye"></i></a>

              </td>
            </tr>
            <tr id="utility-facility-714">
              <td>
                Penerangan Jalan Lingkungan
                <input type="hidden" name="perumahan_utilitas_fasilitas_id[]" value="714">
              </td>
              <td>Utilitas</td>
              <td>-</td>
              <td>
                <a href="javascript:void(0);"
                  class="button button-sm border d-inline tooltip btn-detail-utility-facility" title="Lihat detail "
                  data-id="714" data-jenis-id="10"><i class="sl sl-icon-eye"></i></a>

              </td>
            </tr>
            <tr id="utility-facility-715">
              <td>
                Ruang Terbuka Hijau
                <input type="hidden" name="perumahan_utilitas_fasilitas_id[]" value="715">
              </td>
              <td>Fasilitas</td>
              <td>-</td>
              <td>
                <a href="javascript:void(0);"
                  class="button button-sm border d-inline tooltip btn-detail-utility-facility" title="Lihat detail "
                  data-id="715" data-jenis-id="12"><i class="sl sl-icon-eye"></i></a>

              </td>
            </tr>
            <tr id="utility-facility-716">
              <td>
                Sarana Sosial
                <input type="hidden" name="perumahan_utilitas_fasilitas_id[]" value="716">
              </td>
              <td>Fasilitas</td>
              <td>-</td>
              <td>
                <a href="javascript:void(0);"
                  class="button button-sm border d-inline tooltip btn-detail-utility-facility" title="Lihat detail "
                  data-id="716" data-jenis-id="15"><i class="sl sl-icon-eye"></i></a>

              </td>
            </tr>
            <tr id="utility-facility-717">
              <td>
                Sarana Pendidikan
                <input type="hidden" name="perumahan_utilitas_fasilitas_id[]" value="717">
              </td>
              <td>Fasilitas</td>
              <td>-</td>
              <td>
                <a href="javascript:void(0);"
                  class="button button-sm border d-inline tooltip btn-detail-utility-facility" title="Lihat detail "
                  data-id="717" data-jenis-id="16"><i class="sl sl-icon-eye"></i></a>

              </td>
            </tr>
            <tr id="utility-facility-718">
              <td>
                Sarana Ibadah
                <input type="hidden" name="perumahan_utilitas_fasilitas_id[]" value="718">
              </td>
              <td>Fasilitas</td>
              <td>-</td>
              <td>
                <a href="javascript:void(0);"
                  class="button button-sm border d-inline tooltip btn-detail-utility-facility" title="Lihat detail "
                  data-id="718" data-jenis-id="17"><i class="sl sl-icon-eye"></i></a>

              </td>
            </tr>
            <tr id="utility-facility-719">
              <td>
                Kebencanaan
                <input type="hidden" name="perumahan_utilitas_fasilitas_id[]" value="719">
              </td>
              <td>Fasilitas</td>
              <td>-</td>
              <td>
                <a href="javascript:void(0);"
                  class="button button-sm border d-inline tooltip btn-detail-utility-facility" title="Lihat detail "
                  data-id="719" data-jenis-id="21"><i class="sl sl-icon-eye"></i></a>

              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
@endsection