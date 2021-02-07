<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Donasi</h1>
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
                            Data Donasi
                        </div>
                        <div class="card-body">
                            <form class="form" action="/admin/save_edit_donasi/<?= $donasi['id']; ?>" method="POST">
                                <?= csrf_field(); ?>
                                <label>Nama</label>
                                <select class="select2 <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" multiple="multiple" data-dropdown-css-class="select2-blue" name="nama[]" data-placeholder="Pilih Nama Anggota" style="width: 100%;">
                                    <?php
                                    foreach ($anggota as $a) :
                                        $check_array = explode(", ", $donasi['nama']);

                                    ?>
                                        <option value="<?= $a['nama']; ?>" <?php if (in_array($a['nama'], $check_array)) {
                                                                                echo "selected=selected";
                                                                            } ?>><?= $a['nama']; ?>-<?= $a['angkatan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama'); ?>
                                </div>
                                <label class="mt-2">Angkatan</label>
                                <select class="select2 <?= ($validation->hasError('angkatan')) ? 'is-invalid' : ''; ?>" multiple="multiple" data-dropdown-css-class="select2-blue" name="angkatan[]" data-placeholder="Pilih Angkatan" style="width: 100%;">
                                    <?php
                                    $check_array_angkatan = explode(", ", $donasi['angkatan']);
                                    for ($i = 1; $i <= 9; $i++) {
                                    ?>
                                        <option value="Cyber 0<?= $i ?>" <?php if (in_array("Cyber 0$i", $check_array_angkatan)) {
                                                                                echo "selected=selected";
                                                                            } ?>>Cyber 0<?= $i ?></option>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    for ($i = 10; $i <= 14; $i++) {
                                    ?>
                                        <option value="Cyber <?= $i ?>" <?php if (in_array("Cyber $i", $check_array_angkatan)) {
                                                                            echo "selected=selected";
                                                                        } ?>>Cyber <?= $i ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('angkatan'); ?>
                                </div>
                                <label class="mt-2">Nominal</label>
                                <input type="number" class="form-control <?= ($validation->hasError('tahun')) ? 'is-invalid' : ''; ?>" name="nominal" placeholder="Masukan Nominal" value="<?= $donasi['nominal'] ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nominal'); ?>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Edit Data</button>
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