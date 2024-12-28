@extends('front.master-front')

@section('content')
    <div id="section4" class="container-fluid section p-0 m-0" style="background-image: url('assets/img/hero-bg.png');">
        <div class="content rounded-0" style="backdrop-filter: blur(5px); width: 100%; height: 150px;"></div>
    </div>

    <div id="section3" class="container blog pt-5">
        <div class="row entry entry-single portfolio-details">
            <div class="col-md-12">
                <div class="portfolio-details-slider swiper mb-2">
                    <div class="swiper-wrapper align-items-center">

                        <div class="swiper-slide">
                            <img src="assets/img/portfolio/portfolio-1.jpg" class="w-100" style="height: 500px;"
                                alt="">
                        </div>

                        <div class="swiper-slide">
                            <img src="assets/img/portfolio/portfolio-2.jpg" class="w-100" style="height: 500px;"
                                alt="">
                        </div>

                        <div class="swiper-slide">
                            <img src="assets/img/portfolio/portfolio-3.jpg" class="w-100" style="height: 500px;"
                                alt="">
                        </div>

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <div class="col-md-8">
                <h2 class="entry-title mb-1">
                    ASABRI GRAHA CITRA MAS CIMALAKA
                </h2>
                <div class="entry-meta">
                    <ul>
                        <li class="d-flex align-items-center"><i class="bi bi-geo-alt-fill"></i>
                            <a href="#">
                                Jl. Raya Cimalaka Cipadung, Citimun, Kec. Cimalaka, Kabupaten Sumedang, Jawa Barat 45353
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="entry-content">
                    <!-- <p>
              Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et
              laboriosam eius aut nostrum quidem aliquid dicta.
              Et eveniet enim. Qui velit est ea dolorem doloremque deleniti aperiam unde soluta. Est cum et quod quos aut ut
              et sit sunt. Voluptate porro consequatur assumenda perferendis dolore.
            </p> -->
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="perumahanTab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="rangkuman-tab" data-bs-toggle="tab"
                                data-bs-target="#tab-content-rangkuman" type="button" role="tab"
                                aria-controls="rangkuman" aria-selected="true">
                                Rangkuman
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="jumlah-unit-tab" data-bs-toggle="tab"
                                data-bs-target="#tab-content-jumlah-unit" type="button" role="tab"
                                aria-controls="jumlah-unit" aria-selected="true">
                                Jumlah Unit
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="fasilitas-tab" data-bs-toggle="tab"
                                data-bs-target="#tab-content-fasilitas" type="button" role="tab"
                                aria-controls="fasilitas" aria-selected="true">
                                Fasilitas
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="lokasi-tab" data-bs-toggle="tab"
                                data-bs-target="#tab-content-lokasi" type="button" role="tab" aria-controls="lokasi"
                                aria-selected="true">
                                Lokasi
                            </button>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-content-rangkuman" role="tabpanel"
                            aria-labelledby="rangkuman-tab">
                            <div class="row p-2">
                                <div class="col-md-12">
                                    <div id="listing-overview" class="listing-section">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="m-0"><strong>Nama</strong></h6>
                                                <p>ASABRI GRAHA CITRA MAS CIMALAKA</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="m-0"><strong>Tahun</strong></h6>
                                                <p>1991</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="m-0"><strong>Alamat</strong></h6>
                                                <p>Jl. Raya Cimalaka Cipadung, Citimun, Kec. Cimalaka, Kabupaten Sumedang,
                                                    Jawa Barat 45353</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="m-0"><strong>Status IMB/PBG</strong></h6>
                                                <p><i class="sl sl-icon-close text-danger"></i></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="m-0"><strong>Desa</strong></h6>
                                                <p>Desa Citimun</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="m-0"><strong>Kecamatan</strong></h6>
                                                <p>Kec. Cimalaka</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="m-0"><strong>Luas (m<sup>2</sup>)</strong></h6>
                                                <p>45083</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="m-0"><strong>Bentuk Bangunan </strong></h6>
                                                <p>tapak</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="m-0"><strong>Total MBR</strong></h6>
                                                <p>438</p>
                                            </div>

                                            <div class="col-md-6">
                                                <h6 class="m-0"><strong>Total Non-MBR</strong></h6>
                                                <p>34</p>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-content-jumlah-unit" role="tabpanel"
                            aria-labelledby="jumlah-unit-tab">
                            <div id="listing-units" class="listing-section">
                                <h3 class="listing-desc-headline">Jumlah Unit</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Tipe</th>
                                                <th width="150" class="text-center">Total</th>
                                                <th width="150" class="text-center">Realisasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>36/60</td>
                                                <td class="text-center">134</td>
                                                <td class="text-center">0</td>
                                            </tr>
                                            <tr>
                                                <td>36/70</td>
                                                <td class="text-center">70</td>
                                                <td class="text-center">0</td>
                                            </tr>
                                            <tr>
                                                <td>36/72</td>
                                                <td class="text-center">61</td>
                                                <td class="text-center">0</td>
                                            </tr>
                                            <tr>
                                                <td>36/90</td>
                                                <td class="text-center">96</td>
                                                <td class="text-center">0</td>
                                            </tr>
                                            <tr>
                                                <td>50/110</td>
                                                <td class="text-center">24</td>
                                                <td class="text-center">0</td>
                                            </tr>
                                            <tr>
                                                <td>30/60</td>
                                                <td class="text-center">31</td>
                                                <td class="text-center">0</td>
                                            </tr>
                                            <tr>
                                                <td>36/60 ruko</td>
                                                <td class="text-center">10</td>
                                                <td class="text-center">0</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-content-fasilitas" role="tabpanel"
                            aria-labelledby="fasilitas-tab">
                            <div id="listing-facilities" class="listing-section">
                                <h3 class="listing-desc-headline">Utilitas &amp; Fasilitas</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5><strong>Berita Acara Serah Terima</strong></h5>
                                        Nomor : 11 /BARPHSL /TV/ Perkim-DPKPP/XI/ 2021
                                        <br>
                                        <a href="http://simandra.sumedangkab.go.id/uploads/2023/05/17/ThmPO9YpseFSpRVomkDmc1UYrRxfWoaPwYz4m4EH.pdf"
                                            download="Nomor : 11 /BARPHSL /TV/ Perkim-DPKPP/XI/ 2021"
                                            class="btn btn-sm btn-primary d-print-none">
                                            <i class="im im-icon-Data-Download margin-right-5"></i>Download Dokumen
                                        </a>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <h5><strong>Daftar Utilitas &amp; Fasilitas</strong></h5>
                                        <div class="margin-bottom-10 d-none">
                                            <a href="#utility-facility-dialog"
                                                class="btn btn-add-facility popup-with-zoom-anim"><i
                                                    class="sl sl-icon-plus margin-right-5"></i>Tambah</a>
                                        </div>

                                        <table class="table table-hover table-bordered table-utility-facility">
                                            <thead>
                                                <tr>
                                                    <th>Nama Utilitas/Fasilitas</th>
                                                    <th>Kategori</th>
                                                    <th>Keterangan</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="empty-state">
                                                    <td colspan="4" class="text-center">Belum Terdapat
                                                        Utilitas/Fasilitas</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <!-- Upload file popup -->
                                        <div id="utility-facility-dialog" class="zoom-anim-dialog d-none">
                                            <div class="small-dialog-header">
                                                <h3 class="utility-facility-form-title">Tambah Utilitas/Fasilitas</h3>
                                            </div>
                                            <div class="message-reply margin-top-0">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5><strong>Utilitas / Fasilitas <span
                                                                    class="text-danger">*</span></strong></h5>
                                                        <label>
                                                            <select class="select2-select" id="utility-facility-id"
                                                                data-placeholder="Pilih Utilitas / Fasilitas">
                                                                <option value="">Pilih Utilitas / Fasilitas</option>
                                                                <optgroup label="Utilitas">
                                                                    <option value="2">Jalan Lingkungan Perumahan
                                                                    </option>
                                                                    <option value="1">Jalan Utama Perumahan </option>
                                                                    <option value="10">Penerangan Jalan Lingkungan
                                                                    </option>
                                                                    <option value="3">Saluran Drainase </option>
                                                                    <option value="4">Sistem Jaringan Air Bersih
                                                                    </option>
                                                                    <option value="5">Sistem Jaringan Limbah Air Kotor
                                                                    </option>
                                                                    <option value="6">Sistem Jaringan Limbah
                                                                        Persampahan</option>
                                                                    <option value="7">Sistem Jaringan Listrik
                                                                    </option>
                                                                    <option value="8">Sistem Jaringan Telekomunikasi
                                                                    </option>
                                                                    <option value="9">Sistem Proteksi Kebakaran
                                                                    </option>
                                                                    <option value="11">Tembok Penahan Tanah</option>
                                                                </optgroup>
                                                                <optgroup label="Fasilitas">
                                                                    <option value="21">Kebencanaan</option>
                                                                    <option value="14">Ruang Terbuka Biru </option>
                                                                    <option value="12">Ruang Terbuka Hijau </option>
                                                                    <option value="13">Ruang Terbuka Non Hijau
                                                                    </option>
                                                                    <option value="19">Sarana Ekonomi </option>
                                                                    <option value="17">Sarana Ibadah </option>
                                                                    <option value="18">Sarana Kesehatan </option>
                                                                    <option value="20">Sarana Olahraga </option>
                                                                    <option value="16">Sarana Pendidikan </option>
                                                                    <option value="15">Sarana Sosial </option>
                                                                </optgroup>
                                                            </select>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="row margin-bottom-20">
                                                    <div
                                                        class="col-md-12 utility-facility-input d-none utility-facility-image margin-bottom-10">
                                                        <h5><strong>Foto Utilitas / Fasilitas</strong></h5>
                                                        <div id="image-utility-facility-preview" class="image-preview">
                                                            <label id="image-utility-facility-label"
                                                                for="image-utility-facility-image">Pilih
                                                                Foto</label>
                                                            <input type="file" name="utility_facility_image"
                                                                id="image-utility-facility-image">
                                                        </div>
                                                        <div class="text-center">
                                                            <img src="" class="d-none"
                                                                id="image-utility-facility-preview-fix"
                                                                alt="image preview">
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-md-12 utility-facility-input d-none utility-facility-jumlah">
                                                        <h5><strong>Jumlah</strong></h5>
                                                        <label for="utility-facility-jumlah">
                                                            <input type="number" name="jumlah"
                                                                placeholder="Contoh: 5000" class="input-text"
                                                                id="utility-facility-jumlah" value="0"
                                                                min="0">
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="col-md-6 utility-facility-input d-none utility-facility-panjang">
                                                        <h5><strong>Panjang (m) <span class="text-danger">*</span></strong>
                                                        </h5>
                                                        <label for="utility-facility-panjang">
                                                            <input type="number" name="panjang"
                                                                placeholder="Contoh: 5000" class="input-text"
                                                                id="utility-facility-panjang" value="0"
                                                                min="0">
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="col-md-6 utility-facility-input d-none utility-facility-lebar">
                                                        <h5><strong>Lebar (m) <span class="text-danger">*</span></strong>
                                                        </h5>
                                                        <label for="utility-facility-lebar">
                                                            <input type="number" name="lebar"
                                                                placeholder="Contoh: 1000" class="input-text"
                                                                id="utility-facility-lebar" value="0"
                                                                min="0">
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="col-md-6 utility-facility-input status status d-none utility-facility-jumlah_kategori_1">
                                                        <h5><strong>Jumlah Kategori 1</strong></h5>
                                                        <label for="utility-facility-jumlah_kategori_1">
                                                            <i class="sl sl-icon-check text-success d-none"></i>
                                                            <i class="sl sl-icon-close text-danger d-none"></i>
                                                            <input type="number" name="jumlah_kategori_1"
                                                                placeholder="Contoh: 50" class="input-text"
                                                                id="utility-facility-jumlah_kategori_1" value="0"
                                                                min="0">
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="col-md-6 utility-facility-input status d-none utility-facility-jumlah_kategori_2">
                                                        <h5><strong>Jumlah Kategori 2</strong></h5>
                                                        <label for="utility-facility-jumlah_kategori_2">
                                                            <i class="sl sl-icon-check text-success d-none"></i>
                                                            <i class="sl sl-icon-close text-danger d-none"></i>
                                                            <input type="number" name="jumlah_kategori_2"
                                                                placeholder="Contoh: 50" class="input-text"
                                                                id="utility-facility-jumlah_kategori_2" value="0"
                                                                min="0">
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="col-md-6 utility-facility-input status d-none utility-facility-jumlah_kategori_3">
                                                        <h5><strong>Jumlah Kategori 3</strong></h5>
                                                        <label for="utility-facility-jumlah_kategori_3">
                                                            <i class="sl sl-icon-check text-success d-none"></i>
                                                            <i class="sl sl-icon-close text-danger d-none"></i>
                                                            <input type="number" name="jumlah_kategori_3"
                                                                placeholder="Contoh: 50" class="input-text"
                                                                id="utility-facility-jumlah_kategori_3" value="0"
                                                                min="0">
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="col-md-6 utility-facility-input status d-none utility-facility-jumlah_jenis_1">
                                                        <h5><strong>Jumlah Jenis 1</strong></h5>
                                                        <label for="utility-facility-jumlah_jenis_1">
                                                            <i class="sl sl-icon-check text-success d-none"></i>
                                                            <i class="sl sl-icon-close text-danger d-none"></i>
                                                            <input type="number" name="jumlah_jenis_1"
                                                                placeholder="Contoh: 50" class="input-text"
                                                                id="utility-facility-jumlah_jenis_1" value="0"
                                                                min="0">
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="col-md-6 utility-facility-input status d-none utility-facility-jumlah_jenis_2">
                                                        <h5><strong>Jumlah Jenis 2</strong></h5>
                                                        <label for="utility-facility-jumlah_jenis_2">
                                                            <i class="sl sl-icon-check text-success d-none"></i>
                                                            <i class="sl sl-icon-close text-danger d-none"></i>
                                                            <input type="number" name="jumlah_jenis_2"
                                                                placeholder="Contoh: 50" class="input-text"
                                                                id="utility-facility-jumlah_jenis_2" value="0"
                                                                min="0">
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="col-md-6 utility-facility-input status d-none utility-facility-jumlah_jenis_3">
                                                        <h5><strong>Jumlah Jenis 3</strong></h5>
                                                        <label for="utility-facility-jumlah_jenis_3">
                                                            <i class="sl sl-icon-check text-success d-none"></i>
                                                            <i class="sl sl-icon-close text-danger d-none"></i>
                                                            <input type="number" name="jumlah_jenis_3"
                                                                placeholder="Contoh: 50" class="input-text"
                                                                id="utility-facility-jumlah_jenis_3" value="0"
                                                                min="0">
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="col-md-6 utility-facility-input status d-none utility-facility-jumlah_jenis_4">
                                                        <h5><strong>Jumlah Jenis 4</strong></h5>
                                                        <label for="utility-facility-jumlah_jenis_4">
                                                            <i class="sl sl-icon-check text-success d-none"></i>
                                                            <i class="sl sl-icon-close text-danger d-none"></i>
                                                            <input type="number" name="jumlah_jenis_4"
                                                                placeholder="Contoh: 50" class="input-text"
                                                                id="utility-facility-jumlah_jenis_4" value="0"
                                                                min="0">
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="col-md-6 utility-facility-input status d-none utility-facility-kondisi_baik">
                                                        <h5><strong>Kondisi Baik</strong></h5>
                                                        <label for="utility-facility-kondisi_baik">
                                                            <i class="sl sl-icon-check text-success d-none"></i>
                                                            <i class="sl sl-icon-close text-danger d-none"></i>
                                                            <input type="number" name="kondisi_baik"
                                                                placeholder="Contoh: 1000" class="input-text"
                                                                id="utility-facility-kondisi_baik" value="0"
                                                                min="0">
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="col-md-6 utility-facility-input status d-none utility-facility-kondisi_rusak_berat">
                                                        <h5><strong>Kondisi Rusak Berat</strong></h5>
                                                        <label for="utility-facility-kondisi_rusak_berat">
                                                            <i class="sl sl-icon-check text-success d-none"></i>
                                                            <i class="sl sl-icon-close text-danger d-none"></i>
                                                            <input type="number" name="kondisi_rusak_berat"
                                                                placeholder="Contoh: 1000" class="input-text"
                                                                id="utility-facility-kondisi_rusak_berat" value="0"
                                                                min="0">
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="col-md-6 utility-facility-input status d-none utility-facility-kondisi_rusak_sedang">
                                                        <h5><strong>Kondisi Rusak Sedang</strong></h5>
                                                        <label for="utility-facility-kondisi_rusak_sedang">
                                                            <i class="sl sl-icon-check text-success d-none"></i>
                                                            <i class="sl sl-icon-close text-danger d-none"></i>
                                                            <input type="number" name="kondisi_rusak_sedang"
                                                                placeholder="Contoh: 1000" class="input-text"
                                                                id="utility-facility-kondisi_rusak_sedang" value="0"
                                                                min="0">
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="col-md-6 utility-facility-input status d-none utility-facility-kondisi_rusak_ringan">
                                                        <h5><strong>Kondisi Rusak Ringan</strong></h5>
                                                        <label for="utility-facility-kondisi_rusak_ringan">
                                                            <i class="sl sl-icon-check text-success d-none"></i>
                                                            <i class="sl sl-icon-close text-danger d-none"></i>
                                                            <input type="number" name="kondisi_rusak_ringan"
                                                                placeholder="Contoh: 1000" class="input-text"
                                                                id="utility-facility-kondisi_rusak_ringan" value="0"
                                                                min="0">
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="col-md-12 utility-facility-input d-none utility-facility-keterangan">
                                                        <h5><strong>Keterangan</strong></h5>
                                                        <label for="utility-facility-keterangan">
                                                            <textarea class="input-text" name="keterangan" id="utility-facility-keterangan"
                                                                placeholder="Contoh: Belum melakukan survey" cols="30" rows="5"></textarea>
                                                        </label>
                                                    </div>
                                                </div>
                                                <button type="button" class="button btn-save-utility-facility"
                                                    data-perumahan-id="166">Simpan</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-content-lokasi" role="tabpanel" aria-labelledby="lokasi-tab">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d19056.005897173953!2d-6.259336!3d53.343243!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68c34ca36f5e03%3A0x5b78627d9376cdb1!2sANIMASHIT%20STUDIO!5e0!3m2!1sid!2sid!4v1713965610265!5m2!1sid!2sid"
                                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="portfolio-info">
                    <h3>Informasi Pengembang</h3>
                    <ul>
                        <li><strong><i class="bi bi-building"></i></strong> PT. Initial Design</li>
                        <li><strong><i class="bi bi-geo-alt-fill"></i></strong> Jl. H. Sanusi RT. 04 RW. 08</li>
                        <li><strong><i class="bi bi-telephone-fill"></i></strong> 0896-55050551</li>
                        <li><strong><i class="bi bi-envelope-fill"></i></strong> sipsu@gmail.com</li>

                    </ul>
                </div>
            </div>
        </div>

    </div>
@endsection
