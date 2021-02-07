<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Data Absen</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#maps"><i class="fa fa-print"></i> Rekap Data</a>
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
                <div class="col-md-6 mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text text-white" style="background-color: #6BAFCF;"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control" id="min" placeholder="Mulai Dari Tanggal">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text text-white" style="background-color: #6BAFCF;"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control" id="max" placeholder="Sampai Dengan Tanggal">
                    </div>
                </div>

                <section class="col-lg-12 connectedSortable">
                    <div class="card">
                        <div class="card-body">
                            <table id="tableAbsen" class="table table-bordered table-striped">
                                <thead class="text-white" style="background-color: #6BAFCF;">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Angkatan</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Lat</th>
                                        <th>Long</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($absen as $a) :
                                    ?>
                                        <tr>
                                            <td><?= $a['nama']; ?></td>
                                            <td align="center"><?= $a['angkatan']; ?></td>
                                            <td align="center"><?= date('d/m/Y', strtotime($a['tanggal'])) ?></td>
                                            <td align="center"><?= $a['jam']; ?></td>
                                            <td align="center"><?= $a['lat']; ?></td>
                                            <td align="center"><?= $a['long']; ?></td>
                                            <td align="center">
                                                <form action="/admin/absen/<?= $a['id'] ?>" class="d-inline" method="POST">
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
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Lat</th>
                                        <th>Long</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <div class="modal fade" id="maps" tabindex="-1" role="dialog" aria-lmapLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #6BAFCF;">
                            <h3 class="modal-title text-white" id="exampleModalLabel">Rekap Absen Siswa</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form" action="/admin/rekap_absen" method="POST">
                                <?= csrf_field(); ?>
                                <label>Opsi Rekap</label>
                                <select name="opsi" class="form-control" id="rekap">
                                    <option value="Periodik">Periodik</option>
                                    <option value="Semua">Semua</option>
                                </select>
                                <div class="row mt-2" id="periodik">

                                </div>
                                <button type="submit" class="btn btn-success mt-3"><i class="fa fa-print"></i> Cetak Rekapitulasi</button>
                            </form>
                        </div>
                        <div class="modal-footer" style="background-color: #6BAFCF;">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-2 mb-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header text-white" style="background-color: #6BAFCF;">
                                <h2>Peta Absen Siswa</h2>
                            </div>
                            <div class="card-body">
                                <div style="width: 100%;height: 600px;" id="mapid"></div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
            <script>
                var mymap = L.map('mapid').setView([-6.4611644, 106.8567575], 16);
                document.getElementsByClassName('leaflet-control-attribution')[0].style.display = 'none';

                <?php
                foreach ($absen as $am) {
                ?>
                    L.marker([<?= $am['lat'] ?>, <?= $am['long'] ?>]).bindPopup('<?= $am['nama'] ?>').addTo(mymap).openPopup()
                <?php } ?>

                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                    attribution: '',
                    id: 'mapbox/streets-v11',
                }).addTo(mymap);
            </script>
            <?= $this->endSection(); ?>