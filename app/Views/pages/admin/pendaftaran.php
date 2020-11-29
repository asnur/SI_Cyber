<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Calon Anggota</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <a href="/admin/tambah_calon_anggota" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Data</a>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php
    if (session()->getFlashdata('pesan')) :
    ?>
        <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>
    <?php endif ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tableAnggota" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Angkatan</th>
                                        <th>No Hp</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($calon as $c) :
                                    ?>
                                        <tr>
                                            <td align="center">
                                                <?php
                                                if (empty($c['foto'])) {
                                                    echo '<img src="/dist/img/user-icon.png" style="width: 80px; height: 100px; object-fit:cover; object-position:center;" class="image"/>';
                                                } else {
                                                    echo '<img src="/dist/img/' . $a['foto'] . '" style="width: 80px; height: 100px; object-fit:cover; object-position:center;" class="image"/>';
                                                } ?>
                                            </td>
                                            <td><?= $c['nama']; ?></td>
                                            <td align="center"><?= $c['jenis_kelamin']; ?></td>
                                            <td align="center"><?= $c['angkatan']; ?></td>
                                            <td align="center"><?= $c['no_tlp']; ?></td>
                                            <td align="center"><a href="<?= base_url('/admin/edit_calon_anggota/' . $c['username'] . '') ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                <form action="<?= base_url('/admin/pendaftaran/' . $c['id'] . '')  ?>" class="d-inline" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                                <a href="<?= base_url('/admin/kartu_calon_anggota/' . $c['username'] . '')  ?>" class="btn btn-warning"><i class="fa fa-print"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </section>
                <!-- /.content -->
            </div>

            <?= $this->endSection(); ?>