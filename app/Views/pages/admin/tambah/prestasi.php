<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tambah Data Prestasi</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-lightblue">
                            Data Prestasi
                        </div>
                        <div class="card-body">
                            <form class="form" action="/admin/save_tambah_prestasi" method="POST">
                                <?= csrf_field(); ?>
                                <label>Nama</label>
                                <select class="select2 <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" multiple="multiple" data-dropdown-css-class="select2-blue" name="nama[]" data-placeholder="Pilih Nama Anggota" style="width: 100%;">
                                    <?php foreach ($anggota as $a) : ?>
                                        <option value="<?= $a['nama']; ?>"><?= $a['nama']; ?>-<?= $a['angkatan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama'); ?>
                                </div>
                                <label class="mt-2">Angkatan</label>
                                <select class="select2 <?= ($validation->hasError('angkatan')) ? 'is-invalid' : ''; ?>" multiple="multiple" data-dropdown-css-class="select2-blue" name="angkatan[]" data-placeholder="Pilih Angkatan" style="width: 100%;">
                                    <?php
                                    for ($i = 1; $i <= 9; $i++) {
                                    ?>
                                        <option value="Cyber 0<?= $i ?>">Cyber 0<?= $i ?></option>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    for ($i = 10; $i <= 14; $i++) {
                                    ?>
                                        <option value="Cyber <?= $i ?>">Cyber <?= $i ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('angkatan'); ?>
                                </div>
                                <label class="mt-2">Jenis Prestasi</label>
                                <input type="text" class="form-control <?= ($validation->hasError('jenis_prestasi')) ? 'is-invalid' : ''; ?>" name="jenis_prestasi" placeholder="Masukan Jenis Prestasi">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('jenis_prestasi'); ?>
                                </div>
                                <label class="mt-2">Tahun</label>
                                <input type="number" class="form-control <?= ($validation->hasError('tahun')) ? 'is-invalid' : ''; ?>" name="tahun" placeholder="Masukan Tahun">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('tahun'); ?>
                                </div>
                                <label class="mt-2">Tempat</label>
                                <input type="text" class="form-control <?= ($validation->hasError('tempat')) ? 'is-invalid' : ''; ?>" name="tempat" placeholder="Masukan Nama Tempat">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('tempat'); ?>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Data</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>
    </section>
    <?= $this->endSection(); ?>