<?= $this->extend('layout/template_user'); ?>


<?= $this->section('content'); ?>

<header style="background-image: url(/dist/img/bg.png);">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-auto">
                            <h1>SELAMAT DATANG</h1>
                            <p>di Website Cyber Creative yaitu Website yang berisi infotmasi tentang informasi yang ada pada organisasi yang bernama Cyber Creative, dimana anda bisa mengetahui sejarah, profil organisasi, dll</p>
                            <a class="btn btn-continue" href=" #">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-auto">
                            <h1>SELAMAT DATANG</h1>
                            <p>di Website Cyber Creative yaitu Website yang berisi infotmasi tentang informasi yang ada pada organisasi yang bernama Cyber Creative, dimana anda bisa mengetahui sejarah, profil organisasi, dll</p>
                            <a class="btn btn-continue" href=" #">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mt-auto">
                            <h1>SELAMAT DATANG</h1>
                            <p>di Website Cyber Creative yaitu Website yang berisi infotmasi tentang informasi yang ada pada organisasi yang bernama Cyber Creative, dimana anda bisa mengetahui sejarah, profil organisasi, dll</p>
                            <a class="btn btn-continue" href=" #">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</header>

<div class="container mb-5" id="tentang">
    <h1 align="center" class="mb-5" data-aos="fade-up">Sejarah & Visi Misi</h1>
    <div class="row">
        <div class="col-md-6 text-center mb-5" data-aos="fade-left"><img class="img-visi" src="<?= base_url('dist/img/history.png'); ?>"></div>
        <div class="col-md-6 text-justify" data-aos="fade-right">
            <p>Sejarah organisasi Cyber Creative kami dimulai pada tahun 2008 di Sekolah SMK Insan Kreatif yang didirikan oleh 10 Anak dari Jurusan Teknik Elektronika Industri & mereka sempat mengajukan proposal untuk mendirikan organisasi ini namun ditolak 3 kali oleh kepala sekolah dan akhir nya dipercobaan ke 4 proposal diterima oleh kepala sekolah dan berdirilah organisasi ini hingga sekarang di generasi ke - 12</p>
        </div>
        <div class="col-md-6 text-justify" data-aos="fade-left">
            <p>Mencetak generasi yang memiliki keseimbangan IPTEK dan IMTAQ. Mendidik siswa/siswi yang memiliki kemampuan di bidang teknologi. Mendidik siswa/siswi untuk belajar berorganisasi yang dapat bermanfaat dalam kehidupan bermasyarakat. Sebagai motivator untuk para siswa/siswi lain untuk terus menuntut ilmu dan tidak tertinggal oleh perkembangan zaman. Mengharumkan nama Yayasan Perguruan Al-Nur Cibinong.</p>
        </div>
        <div class="col-md-6 text-center" data-aos="fade-right"><img class="img-visi" src="<?= base_url('dist/img/strategy.png'); ?>"></div>
    </div>
</div>

<div class="container mt-5">
    <h1 align="center" class="mb-5" data-aos="fade-up">Kegiatan Kami</h1>
    <div class="row mt-5">
        <div class="col-md-6" data-aos="fade-left"><img class="img-kegiatan" src="<?= base_url('dist/img/computer-and-man.png'); ?>"></div>
        <div class="col-md-6" data-aos="fade-right">
            <div class="card bg-blue">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" id="artikel">
    <div class="row">
        <?php
        foreach ($artikel as $a) {
        ?>
            <div class="col-md-3 mb-4" data-aos="fade-up">
                <div class="card">
                    <img class="card-img-top" src="/dist/img/cover/<?= ($a['foto'] == '') ? 'book.jpg' : $a['foto']  ?>" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title"><?= $a['judul']; ?></h4>
                        <p class="card-text text-justify"><?= substr($a['isi'], 0, 100); ?></p>
                        <a href="/user/artikel/<?= $a['id'] ?>" class="btn btn-primary">Selengkapnya >></a>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="container">
            <?= $pager->links('artikel', 'artikel_pagination'); ?>
        </div>
    </div>
</div>

<div class="info mt-5 mb-5 p-5">
    <div class="container p-5 isi-info">
        <div class="row">
            <div class="col-md-4 text-center">
                <h1 class="jumlah"><?= $prestasi->countAllResults(); ?></h1>
                <h1><i class="fa fa-trophy"></i> Prestasi</h1>
            </div>
            <div class="col-md-4 text-center">
                <h1 class="jumlah"><?= $anggota->countAllResults(); ?></h1>
                <h1><i class="fa fa-users"></i> Anggota</h1>
            </div>
            <div class="col-md-4 text-center">
                <h1 class="jumlah">14</h1>
                <h1><i class="fa fa-id-card"></i> Angkatan</h1>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5 prestasi-anggota">
    <h1 align="center" class="mb-3">Siswa Berprestasi</h1>
    <section class="customer-logos slider">
        <div class="slide">
            <div class="card text-center">
                <img src="<?= base_url('dist/img/asnur.jpg'); ?>" class="siswa-prestasi mb-3 mt-3 ml-auto mr-auto">
                <h4>M. Asnur Ramdani</h4>
                <a class="btn btn-primary list-prestasi" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">
                    Daftar Prestasi
                </a>
                <div class="collapse mt-3" id="collapseExample1">
                    <div class="card card-body">
                        <ul class="daftar-prestasi text-left">
                            <li>Juara 2 LKS Web Design Kab. Bogor 2018</li>
                            <li>Juara 3 Web App Competion PNJ 2019</li>
                            <li>Juara 3 LKS ITNSA Kab. Bogor 2019</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide">
            <div class="card text-center">
                <img src="<?= base_url('dist/img/kamil.jpg'); ?>" class="siswa-prestasi mb-3 mt-3 ml-auto mr-auto">
                <h4>Mustofa Kamil</h4>
                <a class="btn btn-primary list-prestasi" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                    Daftar Prestasi
                </a>
                <div class="collapse" id="collapseExample2">
                    <div class="card card-body">
                        <ul class="daftar-prestasi text-left">
                            <li>Finalis Atikan Jawa Barat 2018</li>
                            <li>Juara 2 LKS Design Garfis 2019</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide">
            <div class="card text-center">
                <img src="<?= base_url('dist/img/ainur.jpg'); ?>" class="siswa-prestasi mb-3 mt-3 ml-auto mr-auto">
                <h4>Ainur Rachman</h4>
                <a class="btn btn-primary list-prestasi" data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample3">
                    Daftar Prestasi
                </a>
                <div class="collapse" id="collapseExample3">
                    <div class="card card-body">
                        <ul class="daftar-prestasi text-left">
                            <li>Juara 2 LKS ITNSA 2018</li>
                            <li>Juara 3 NSC PNJ 2018</li>
                            <li>Juara 3 NSC PNJ 2019</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide">
            <div class="card text-center">
                <img src="<?= base_url('dist/img/deni.jpg'); ?>" class="siswa-prestasi mb-3 mt-3 ml-auto mr-auto">
                <h4>Deni Ramadhan</h4>
                <a class="btn btn-primary list-prestasi" data-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" aria-controls="collapseExample4">
                    Daftar Prestasi
                </a>
                <div class="collapse" id="collapseExample4">
                    <div class="card card-body">
                        <ul class="daftar-prestasi text-left">
                            <li>Juara 2 Merakit PC UNPAK 2018</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide">
            <div class="card text-center">
                <img src="<?= base_url('dist/img/chika.jpg'); ?>" class="siswa-prestasi mb-3 mt-3 ml-auto mr-auto">
                <h4>Arnada Chika C</h4>
                <a class="btn btn-primary list-prestasi" data-toggle="collapse" href="#collapseExample5" role="button" aria-expanded="false" aria-controls="collapseExample5">
                    Daftar Prestasi
                </a>
                <div class="collapse" id="collapseExample5">
                    <div class="card card-body">
                        <ul class="daftar-prestasi text-left">
                            <li>Juara 2 Design Garfis PNJ 2018</li>
                            <li>Juara 1 Animasi UNPAK 2018</li>
                            <li>Juara 1 LKS Design Garfis Kab. Bogor 2018</li>
                            <li>Juara 2 LKS Design Garfis Prov. Jawa Barat 2018</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide">
            <div class="card text-center">
                <img src="<?= base_url('dist/img/rio.jpg'); ?>" class="siswa-prestasi mb-3 mt-3 ml-auto mr-auto">
                <h4>Rio Adanan Firdaus</h4>
                <a class="btn btn-primary list-prestasi" data-toggle="collapse" href="#collapseExample6" role="button" aria-expanded="false" aria-controls="collapseExample6">
                    Daftar Prestasi
                </a>
                <div class="collapse" id="collapseExample6">
                    <div class="card card-body">
                        <ul class="daftar-prestasi text-left">
                            <li>Juara 3 LKS Web Design Kab. Bogor 2016</li>
                            <li>Juara 2 Design Garfis UNPAK 2018</li>
                            <li>Juara 3 Desain Grafis Kota Bogor 2015</li>
                            <li>Juara 2 Speech Contest Jabodetabek 2017</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide">
            <div class="card text-center">
                <img src="<?= base_url('dist/img/ali.jpg'); ?>" class="siswa-prestasi mb-3 mt-3 ml-auto mr-auto">
                <h4>Faturachman Ali</h4>
                <a class="btn btn-primary list-prestasi" data-toggle="collapse" href="#collapseExample7" role="button" aria-expanded="false" aria-controls="collapseExample7">
                    Daftar Prestasi
                </a>
                <div class="collapse" id="collapseExample7">
                    <div class="card card-body">
                        <ul class="daftar-prestasi text-left">
                            <li>Juara 1 Design Grafis PNJ 2018</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide">
            <div class="card text-center">
                <img src="<?= base_url('dist/img/madun.jpg'); ?>" class="siswa-prestasi mb-3 mt-3 ml-auto mr-auto">
                <h4>M. Rifky Ridwan</h4>
                <a class="btn btn-primary list-prestasi" data-toggle="collapse" href="#collapseExample8" role="button" aria-expanded="false" aria-controls="collapseExample8">
                    Daftar Prestasi
                </a>
                <div class="collapse" id="collapseExample8">
                    <div class="card card-body">
                        <ul class="daftar-prestasi text-left">
                            <li>Juara 1 Produk Inovasi Jabodetabek 2017</li>
                            <li>Juara 1 Gelar Inovasi Kab. Bogor 2018</li>
                            <li>Juara 2 Science Project Nasional 2017</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection(); ?>