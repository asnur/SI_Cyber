<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid" style="margin-top: 100px;">
    <div class="row">
        <div class="col-md-8">
            <h1><?= $artikel['judul'] ?></h1>
            <div class="content">
                <?= $artikel['isi'] ?>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim eaque voluptates magni! A, magnam placeat! Optio architecto odio iusto esse error nam laborum, ut accusamus nisi reprehenderit aperiam quae modi.
            </div>
        </div>
        <div class="col-md-4 artikel-lain">
            <h3 class="judul_rek">Artikel Lain</h3>
            <?php
            foreach ($artikel_rekomendasi as $a) :
            ?>
                <div class="col-md-12 mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="/dist/img/<?= ($a['foto'] == '') ? 'book.jpg' : $a['foto'] ?>" class="img-cover">
                        </div>
                        <div class="col-md-8">
                            <a href="/user/artikel/<?= $a['id'] ?>" class="link"><?= $a['judul'] ?></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-md-8 mt-5 mb-5">
        <h1 class="mb-3"><i class="fa fa-comment"></i> Komentar & Saran</h1>
        <form action="/user/komentar/<?= $artikel['id']; ?>" method="POST">
            <textarea name="komentar" rows="5" placeholder="Masukan Komentar Anda Untuk Artikel" class="form-control" <?= (isset($_SESSION['user'])) ? '' : 'disabled' ?> required></textarea>
            <button type="submit" class="btn btn-primary mt-3"><i class="fa fa-paper-plane"></i> Kirim</button>
        </form>
        <?php
        foreach ($komentar as $k) {
        ?>
            <div class="container mt-5">
                <div class="thumbnail mr-4" style="float: left;">
                    <img src="/dist/img/<?= ($k['foto'] == '') ? 'find_user.png' : $k['foto']; ?>" class="thumbnail-user">
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4><?= $k['nama']; ?></h4><br>
                        <p><?= $k['isi_komentar']; ?></p>
                        <div class="text-right"><i class="fa fa-calendar"></i> <?= $k['tanggal']; ?></div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?= $this->endSection(); ?>