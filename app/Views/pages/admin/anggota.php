<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Anggota</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <a href="/admin/tambah_anggota" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Data</a>
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
                        <div class="card-body">
                            <table id="tableAnggota" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Angkatan</th>
                                        <th>Jabatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($anggota as $a) :
                                    ?>
                                        <tr>
                                            <td align="center">
                                                <?php
                                                if (empty($a['foto'])) {
                                                    echo '<img src="/dist/img/user-icon.png" style="width: 80px; height: 100px; object-fit:cover; object-position:center;" class="image"/>';
                                                } else {
                                                    echo '<img src="/dist/img/' . $a['foto'] . '" style="width: 80px; height: 100px; object-fit:cover; object-position:center;" class="image"/>';
                                                } ?>
                                            </td>
                                            <td><?= $a['nama']; ?></td>
                                            <td align="center"><?= $a['jenis_kelamin']; ?></td>
                                            <td align="center"><?= $a['angkatan']; ?></td>
                                            <td align="center"><?= $a['jabatan']; ?></td>
                                            <td align="center"><a href="<?= '/admin/edit_anggota/' . $a['username'] . '' ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                <form action="/admin/<?= $a['id'] ?>" class="d-inline" method="POST">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                                <a href="<?= '/admin/kartu_anggota/' . $a['username'] . ''  ?>" class="btn btn-warning"><i class="fa fa-print"></i></a>
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