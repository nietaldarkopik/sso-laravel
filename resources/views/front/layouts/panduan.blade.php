@extends('front.master-front')

@section('content')
    <div id="section4" class="container-fluid section p-0 m-0" style="background-image: url('assets/img/hero-bg.png');">
        <div class="content rounded-0" style="backdrop-filter: blur(5px); width: 100%; height: 150px;"></div>
    </div>

    <div id="section5">
        <div class="container my-4 text-center">
            <div class="card text-start rounded-0">
                <div class="card-body rounded-0">
                    <h1>KRITERIA PENTINGNYA PENYEDIAAN PSU</h1>
                    <p>(Berdasar Peraturan Menteri Negara Perumahan Rakyat Republik Indonesia Nomor 20 Tahun 2011 tentang
                        Pedoman
                        Bantuan PSU Perumahan dan Kawasan Permukiman)</p>
                    <div class="accordion" id="accordionExample">

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                    PSU Rumah Tapak
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Komponen bantuan PSU untuk rumah tapak meliputi sebagian dari salah satu atau lebih
                                        komponen:</p>
                                    <ul>
                                        <li>jalan;</li>
                                        <li>drainase;</li>
                                        <li>air limbah;</li>
                                        <li>persampahan;</li>
                                        <li>air minum; dan</li>
                                        <li>penerangan jalan umum.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    PSU Rusun Sewa
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Komponen bantuan PSU untuk rusun sewa meliputi sebagian dari salah satu atau lebih
                                        komponen:</p>
                                    <ul>
                                        <li>jalan;</li>
                                        <li>drainase;</li>
                                        <li>air limbah;</li>
                                        <li>persampahan;</li>
                                        <li>air minum;</li>
                                        <li>penerangan jalan umum; dan</li>
                                        <li>tempat parkir.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    PSU Jalan
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Komponen PSU harus memenuhi persyaratan teknis untuk jalan meliputi:</p>
                                    <ul>
                                        <li>pembangunan jalan baru untuk jalan lokal primer/sekunder kawasan;</li>
                                        <li>peningkatan jalan lokal primer/sekunder kawasan yang sudah terbangun;</li>
                                        <li>pembangunan baru jalan lingkungan atau penyediaan bangunan pelengkap prasarana
                                            jalan lingkungan
                                            untuk
                                            rumah tapak atau rusun sewa; dan</li>
                                        <li>kriteria teknis:</li>
                                        <li>lahan untuk daerah milik jalan telah tersedia;</li>
                                        <li>jenis konstruksi jalan yang dapat dibantu berupa jalan dengan laburan aspal atau
                                            jalan dengan
                                            lapis
                                            penetrasi makadam, beton atau paving blok; dan</li>
                                        <li>ketentuan mengenai kriteria teknis jalan sesuai pedoman teknis yang berlaku.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    PSU Drainase
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Komponen PSU harus memenuhi persyaratan teknis untuk drainase meliputi:</p>
                                    <ul>
                                        <li>penyediaan prasarana drainase dan bangunan pelengkap pada perumahan dan kawasan
                                            permukiman;</li>
                                        <li>penyediaan saluran drainase lingkungan; dan</li>
                                        <li>kriteria teknis:</li>
                                        <li>saluran drainase merupakan saluran terbuka dilengkapi dengan bangunan pelengkap;
                                        </li>
                                        <li>sistem drainase harus dihubungkan dengan badan air penerima, sehingga drainase
                                            dapat berfungsi
                                            dengan
                                            baik, dan stabilitas komponen penerima tidak terganggu;</li>
                                        <li>badan air penerima dapat merupakan sungai, laut, kolam, danau dan drainase
                                            kawasan/perkotaan; dan
                                        </li>
                                        <li>ketentuan mengenai kriteria teknis jalan sesuai pedoman teknis yang berlaku,
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    PSU Air Limbah
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Komponen PSU harus memenuhi persyaratan teknis untuk air limbah meliputi:</p>
                                    <ul>
                                        <li>penyediaan prasarana dan sarana air limbah pada perumahan dan kawasan
                                            permukiman;</li>
                                        <li>pembangunan prasarana air limbah komunal;</li>
                                        <li>kriteria teknis:</li>
                                        <li>lahan untuk prasarana pembuangan air limbah komunal telah tersedia;</li>
                                        <li>penempatan Instalasi Pengolahan Air Limbah (IPAL) dapat ditempatkan pada lokasi
                                            yang telah
                                            direncanakan atau pada lokasi Ruang Terbuka Hijau (RTH), atau pada badan jalan,
                                            dengan memperhatikan
                                            kekuatan dan keamanan konstruksi;</li>
                                        <li>penyediaan sarana air limbah sistem terpusat, meliputi jaringan air limbah dan
                                            IPAL;</li>
                                        <li>prasarana dan sarana pembuangan air limbah harus berorientasi pada kebutuhan
                                            masyarakat,
                                            kelestarian
                                            lingkungan dan kemudahan dalam pengoperasian; dan</li>
                                        <li>perencanaan, pembangunan, operasional dan pemeliharaan sistem pembuangan air
                                            limbah sesuai pedoman
                                            teknis yang berlaku.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                    PSU Persampahan
                                </button>
                            </h2>
                            <div id="collapse6" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Komponen PSU harus memenuhi persyaratan teknis untuk persampahan meliputi:</p>
                                    <ul>
                                        <li>penyediaan prasarana dan sarana persampahan yang melayani skala lingkungan dan
                                            kawasan;</li>
                                        <li>pembuatan tempat pengolahan sampah;</li>
                                        <li>untuk rusun sewa tempat sampah/Tempat Pembuangan Sementara (TPS) berupa tempat
                                            pembuangan sampah
                                            komunal; dan</li>
                                        <li>kriteria teknis untuk persampahan sesuai pedoman teknis yang berlaku.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                    PSU Air Minum
                                </button>
                            </h2>
                            <div id="collapse7" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Komponen PSU harus memenuhi persyaratan teknis untuk air minum meliputi:</p>
                                    <ul>
                                        <li>tersedia jaringan air minum yang dapat melayani/tersambung dengan lokasi
                                            perumahan (tapping dari
                                            pipa
                                            PDAM);</li>
                                        <li>dalam hal tidak tersedia jaringan PDAM, maka dapat diberikan pada sumber air
                                            minum seperti
                                            pembuatan
                                            sumur bor;</li>
                                        <li>penyediaan sarana air minum komunal, meliputi jaringan distribusi, tangki
                                            penampungan, rumah
                                            pompa;
                                            dan</li>
                                        <li>kriteria teknis untuk air minum sesuai pedoman teknis yang berlaku.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                    PSU Penerangan Jalan Umum (PJU)
                                </button>
                            </h2>
                            <div id="collapse8" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Komponen PSU harus memenuhi persyaratan teknis untuk Penerangan Jalan Umum (PJU)
                                        meliputi:</p>
                                    <ul>
                                        <li>tersedia sumber listrik yang bersumber dari PT. PLN atau sumber listrik lainnya;
                                        </li>
                                        <li>konstruksi jaringan distribusi PJU di perumahan baru atau pengembangan perumahan
                                            yang telah ada,
                                            meliputi: trafo, tiang, lampu, dan kabel distribusi listrik dari PLN maupun
                                            sumber listrik lainnya;
                                        </li>
                                        <li>penempatan PJU di dalam perumahan pada jalan lingkungan, jalan setapak dan
                                            taman;</li>
                                        <li>apabila di dalam perumahan sudah tersedia jaringan distribusi listrik, namun
                                            belum terdapat PJU,
                                            maka
                                            jaringan distribusi listrik tersebut dapat dimanfaatkan sebagai sarana
                                            penempatan PJU;</li>
                                        <li>jarak penempatan antara PJU dapat memberikan penerangan yang cukup dengan daya
                                            listrik yang
                                            efisien;
                                            dan</li>
                                        <li>kriteria teknis untuk penerangan jalan umum sesuai pedoman teknis yang berlaku.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>


                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                    PSU Tempat Parkir Pada Rusun Sewa
                                </button>
                            </h2>
                            <div id="collapse9" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Komponen PSU harus memenuhi persyaratan teknis untuk tempat parkir pada rusun sewa
                                        meliputi:</p>
                                    <ul>
                                        <li>lahan untuk tempat parkir telah dimatangkan;</li>
                                        <li>tempat parkir ditujukan untuk parkir kendaraan roda dua;</li>
                                        <li>tempat parkir kendaraan roda empat ditujukan hanya untuk parkir sementara;</li>
                                        <li>pembangunan tempat parkir bisa menggunakan konstruksi beton atau paving blok;
                                            dan</li>
                                        <li>kriteria teknis untuk tempat parkir sesuai pedoman teknis yang berlaku</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="section4" class="container-fluid section  p-0 m-0"
        style="background-image: url('assets/img/hero-bg.png');">
        <div class="content rounded-0" style="backdrop-filter: blur(5px); width: 100%; height: 150px;"></div>
    </div>
    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <h2>F.A.Q</h2>
                <p>Pertanyaan Umum</p>
            </header>

            <div class="row">
                <div class="col-lg-6">
                    <!-- F.A.Q List 1-->
                    <div class="accordion accordion-flush" id="faqlist1">
                        <div class="accordion-item">

                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#headingOne3">
                                    Jenis PSU apa saja yang wajib diserahkan oleh pengembang ke Pemerintah Daerah ?</b>
                                </button>
                            </h2>
                            <div id="headingOne3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                <div class="card-body">
                                    <ul>
                                        <li>Jaringan Jalan</li>
                                        <li>Jaringan saluran pembuangan air hujan (drainase)</li>
                                        <li>Sarana pemakaman/tempat pemakaman</li>
                                        <li>Sarana pertamanan dan ruang terbuka hijau</li>
                                        <li>Sarana non-RTH (Fasos)</li>
                                        <li>Sarana penerangan jalan umum</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">

                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#headingTwo3">
                                    Bagaimana Alur Penyerahan PSU untuk Siteplan Baru ?
                                </button>
                            </h2>
                            <div id="headingTwo3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                <div class="card-body">
                                    <img src="https://sipsu.dprkpp.web.id//images/faq1.png" width="100%">
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">

                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#headingThree3">
                                    Apa saja syarat syarat BAST Admin dalam penyerahan PSU ?
                                </button>
                            </h2>
                            <div id="headingThree3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                <div class="accordion-body">
                                    <ol>
                                        <li>Fotocopy Kartu Tanda Penduduk (KTP) pemohon yang masih berlaku</li>
                                        <li>Fotocopy Akta Pendirian badan usaha/badan hukum penyelenggara
                                            perumahan/permukiman dan/atau
                                            perubahannya yang telah mendapat pengesahan dari pejabat yang berwenang</li>
                                        <li>Fotocopy bukti alas hak atas tanah pada lokasi yang akan dibangun perumahan</li>
                                        <li>rincian, spesifikasi, jenis, jumlah dan ukuran obyek yang akan diserahkan sesuai
                                            dengan standar
                                            teknis yang telah ditetapkan</li>
                                        <li>Daftar dan gambar rencana tapak (site plan, zoning dan lainlain) yang
                                            menjelaskan lokasi, jenis
                                            dan ukuran prasarana, sarana dan utilitas yang akan diserahkan kepada Pemerintah
                                            Daerah</li>
                                        <li>Jadwal/waktu penyelesaian pembangunan, masa pemeliharaan dan serah terima fisik
                                            prasarana,
                                            sarana dan utilitas</li>
                                        <li>Bukti setor/bukti pembayaran kompensasi berupa uang sebagai pengganti penyediaan
                                            tempat
                                            pemakaman umum apabila penyediaan tempat pemakaman umum dilakukan dengan cara
                                            menyerahkan
                                            kompensasi berupa uang kepada Pemerintah Daerah</li>
                                    </ol>
                                </div>
                            </div><!-- collapse -->
                        </div>


                        <div class="accordion-item">

                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#headingFour3">
                                    Apa saja syarat syarat BAST Fisik dalam penyerahan PSU ?
                                </button>
                            </h2>
                            <div id="headingFour3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                <div class="accordion-body">
                                    <ol>
                                        <li>Fotocopy Kartu Tanda Penduduk (KTP) pemohon yang masih berlaku</li>
                                        <li>Fotocopy Akta Pendirian badan usaha/badan hukum penyelenggara
                                            perumahan/permukiman dan/atau
                                            perubahannya yang telah mendapat kompensasi berupa uang kepada Pemerintah Daerah
                                        </li>
                                        <li>Fotocopy Surat Pemberitahuan Pajak Terutang Pajak Bumi dan Bangunan (SPPT PBB)
                                            dan Tanda Lunas
                                            Pajak Bumi dan Bangunan (PBB) tahun terakhir sesuai ketentuan yang berlaku</li>
                                        <li>Fotocopy sertipikat tanah atas nama pengembang yang peruntukkannya sebagai
                                            prasarana, sarana dan
                                            utilitas yang akan diserahkan kepada Pemerintah Daerah</li>
                                        <li>Daftar dan gambar rencana tapak (site plan, zoning dan lainlain) yang
                                            menjelaskan lokasi, jenis
                                            dan ukuran prasarana, sarana dan utilitas yang akan diserahkan kepada Pemerintah
                                            Daerah</li>
                                        <li>Fotocopy Berita Acara Serah Terima Administrasi</li>
                                        <li>Fotocopy akta notaris pernyataan pelepasan hak atas tanah dan/atau bangunan
                                            prasarana, sarana
                                            dan utilitas oleh Pemohon/Pengembang kepada Pemerintah Daerah</li>
                                    </ol>
                                </div>
                            </div><!-- collapse -->
                        </div>


                        <div class="accordion-item">

                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#headingFourB3">
                                    Apakah Warga dapat menyerahkan PSU ke Pemerintah Daerah ?
                                </button>
                            </h2>
                            <div id="headingFourB3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                <div class="accordion-body">
                                    Warga dapat menyerahkan PSU ke Pemerintah Daerah dalam hal pengembang tidak ada atau
                                    tidak diketahui
                                    keberadaanya.
                                </div>
                            </div><!-- collapse -->
                        </div>


                        <div class="accordion-item">

                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#headingFive3">
                                    Bagaimana untuk tata cara penyerahan PSU jika pengembang tidak ada/ tidak diketahui ?
                                </button>
                            </h2>
                            <div id="headingFive3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                <div class="accordion-body">
                                    <img src="https://sipsu.dprkpp.web.id//images/faq2.png" width="100%">
                                </div>
                            </div><!-- collapse -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">

                    <!-- F.A.Q List 2-->
                    <div class="accordion accordion-flush" id="faqlist2">


                        <div class="accordion-item">

                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#headingSix3">
                                    Apakah Pengembang Perorangan wajib menyerahkan PSU ?
                                </button>
                            </h2>
                            <div id="headingSix3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                                <div class="accordion-body">
                                    Untuk Pengembang Perorangan dapat menyerahkan PSU kepada Pemkot Surabaya melalui proses
                                    Hibah
                                </div>
                            </div><!-- collapse -->
                        </div>

                        <div class="accordion-item">

                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#headingSeven3">
                                    Berapa Luas Minimal Perumahan yang Wajib menyediakan dan menyerahkan PSU ?
                                </button>
                            </h2>
                            <div id="headingSeven3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                                <div class="accordion-body">
                                    Sesuai dengan Perwali No. 14 Tahun 2016, yang wajib menyerahkan PSU adalah Pengembang
                                    yang berbadan
                                    hukum
                                    yang melakukan pembangunan perumahan dengan luas lebih besat atau sama dengan 1000
                                    m2 (seribu meter persegi) atau sampai dengan 10 (sepuluh) kavling atau badan usaha/badan
                                    hukum
                                    penyelenggara pembangunan
                                    perumahan, pemukiman, perdagangan dan/atau industri
                                </div>
                            </div><!-- collapse -->
                        </div>


                        <div class="accordion-item">

                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#headingEight3">
                                    Bagaimana jika Pengembang tidak menyerahkan PSU ?
                                </button>
                            </h2>
                            <div id="headingEight3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                                <div class="accordion-body">
                                    Sesuai dengan Perwali No. 14 Tahun 2016, Pengembang yang tidak menyediakan PSU, tidak
                                    menyerahkan PSU,
                                    dan
                                    tidak sanggup memperbaiki dan memelihara prasarana dan sarana yang tidak sesuai dengan
                                    syarat teknis
                                    yang
                                    ditetapkan, dapat diberikan sanksi administratif berupa :<br>
                                    <ul>
                                        <li>
                                            Dimasukkan ke dalam daftar hitam (black list)
                                        </li>
                                        <li>
                                            Pengumuman kepada media massa
                                        </li>
                                        <li>
                                            Denda administrasi sebesar Rp. 50.000.000 (lima puluh juta rupiah)
                                        </li>
                                        <li>
                                            Penundaan pemberian persetujuan dokumen dan/atau perizinan
                                        </li>
                                        <li>
                                            Peringatan tertulis
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- collapse -->
                        </div>


                        <div class="accordion-item">

                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#headingNine3">
                                    Bagaimana warga dapat memanfaatkan lahan PSU yang sudah diserahkan ?
                                </button>
                            </h2>
                            <div id="headingNine3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                                <div class="accordion-body">
                                    Warga bisa bersurat kepada Walikota terkait pemanfaatan lahan fasum pada perumahan yang
                                    dimaksud.
                                </div>
                            </div><!-- collapse -->
                        </div>

                        <div class="accordion-item">

                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#headingTen3">
                                    Pertanyaan Anda Tidak ada dalam daftar ini ?
                                </button>
                            </h2>
                            <div id="headingTen3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                                <div class="accordion-body">
                                    Silakan chat dengan petugas kami, dengan klik pada tombol lingkaran di kanan bawah
                                    layar.
                                </div>
                            </div><!-- collapse -->
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section><!-- End F.A.Q Section -->


    <div id="section4" class="container-fluid section" style="background-image: url('assets/img/hero-bg.png');">
        <div class="content" style="backdrop-filter: blur(5px); width: 100%; height: 150px;"></div>
    </div>
@endsection
