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
                                <thead class="text-white" style="background-color: #6BAFCF;">
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
                                            <td align="center"><a href="/admin/edit_anggota/<?= $a['username']; ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                <form action="/admin/<?= $a['id'] ?>" class="d-inline" method="POST">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                                <button class="btn btn-warning" data-toggle="modal" data-username="<?= $a['username'] ?>" data-target="#exampleModal"><i class="fa fa-print"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <tfoot class="text-white" style="background-color: #6BAFCF;">
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Angkatan</th>
                                        <th>Jabatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Kartu Anggota</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Selesai</button>
                        </div>
                    </div>
                </div>
            </div>

            <?= $this->endSection(); ?>