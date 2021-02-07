<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Donasi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <a href="/admin/tambah_donasi" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Data</a>
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
                        <div class="card-header text-right text-white" style="background-color: #6BAFCF;">
                            <h3><i class="fa fa-money"></i> Total Donasi : Rp. <?= number_format($jumlah[0]['jumlah']) ?></h3>
                        </div>
                        <div class="card-body">
                            <table id="tableAnggota" class="table table-bordered table-striped">
                                <thead class="text-white" style="background-color: #6BAFCF;">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Angkatan</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Nominal</th>
                                        <td>Status</td>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($donasi as $c) :
                                    ?>
                                        <tr>
                                            <td><?= $c['nama']; ?></td>
                                            <td align="center"><?= $c['angkatan']; ?></td>
                                            <td align="center"><?= $c['jenis_pembayaran']; ?></td>
                                            <td align="center">Rp.<?= number_format($c['nominal']); ?></td>
                                            <td align="center">
                                                <?php
                                                if ($c['status'] == 'pending') {
                                                    echo '<p class="btn btn-warning">Pending</p>';
                                                } elseif ($c['status'] == 'settlement') {
                                                    echo '<p class="btn btn-success">Suksess</p>';
                                                } elseif ($c['status'] == 'failure') {
                                                    echo '<p class="btn btn-danger">Gagal</p>';
                                                }
                                                ?>
                                            </td>
                                            <td align="center"><a href="<?= base_url('/admin/edit_donasi/' . $c['id'] . '') ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                <form action="<?= base_url('/admin/donasi/' . $c['id'] . '')  ?>" class="d-inline" method="POST">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <tfoot class="text-white" style="background-color: #6BAFCF;">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Angkatan</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
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

            <?= $this->endSection(); ?>