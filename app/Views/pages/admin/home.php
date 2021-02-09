<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<?php
if (session()->getFlashdata('pesan')) :
?>
    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>
<?php endif ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-0 text-dark">Dashboard</h3>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <!-- small box -->
                <div class="col-lg-6 col-12 small-box text-white" style="background-color: #6BAFCF;">
                    <div class="inner">
                        <div class="text mt-5 mb-5">
                            <h1 style="font-size: 60px;">Rp. <?= number_format($jumlah_donasi[0]['jumlah']); ?></h1>
                            <h2>Jumlah Donasi</h2>
                        </div>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash" style="font-size: 200px;"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?= $jumlah_anggota; ?></h3>

                                    <p>Anggota</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-android-person"></i>
                                </div>
                                <a href="/admin/anggota" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-md-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?= $jumlah_prestasi; ?></h3>

                                    <p>Prestasi</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-trophy"></i>
                                </div>
                                <a href="/admin/prestasi" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-md-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?= $jumlah_pendaftar; ?></h3>

                                    <p>Peserta Seleksi</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="/admin/pendaftaran" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-md-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?= $jumlah_agenda; ?></h3>

                                    <p>Agenda</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-calendar"></i>
                                </div>
                                <a href="/admin/agenda" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                </div>

            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <!-- AREA CHART -->
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Perolehan Prestasi</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="data" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Perolehan Prestasi</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="data2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-12 card direct-chat direct-chat-primary" id="box_chat">
                    <div class="card-header">
                        <h3 class="card-title">Forum Diskusi</h3>

                        <div class="card-tools">
                            <!-- <span data-toggle="tooltip" title="3 New Messages" class="badge badge-primary">3</span> -->
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <!-- <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                                <i class="fa fa-comments"></i>
                            </button> -->
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages">
                            <!-- Message. Default to the left -->
                            <?php
                            foreach ($chat as $c) {

                            ?>
                                <div class="direct-chat-msg <?= ($_SESSION['admin'][0]['id'] == $c['id_user']) ? 'right' : '' ?>">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-left"><?= $c['nama'] ?></span>
                                        <span class="direct-chat-timestamp float-right"><?= $c['jam'] . ' ' . $c['tanggal'] ?></span>
                                    </div>
                                    <img class="direct-chat-img" src="/dist/img/<?= $c['foto'] ?>" alt="message user image">
                                    <div class="direct-chat-text">
                                        <?= $c['pesan'] ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <!--/.direct-chat-messages-->

                        <!-- Contacts are loaded here -->
                        <!-- /.direct-chat-pane -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <form method="post" id="form-chat">
                            <?= csrf_field(); ?>
                            <div class="input-group">
                                <input type="text" name="message" id="message" placeholder="Type Message ..." class="form-control" required>
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary" id="kirim_chat">Send</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script src="<?= base_url('plugins/chart.js/Chart.min.js'); ?>"></script>
<script>
    var pertahun = document.getElementById("data").getContext('2d');
    var myChart = new Chart(pertahun, {
        type: 'bar',
        data: {
            labels: ['2015', '2016', '2017', '2018', '2019'],
            datasets: [{
                label: 'Perolehan Pertahun',
                backgroundColor: ['#28A745', '#3498db', '#e74c3c', '#e67e22', '#8e44ad'],
                borderColor: ['#28A745', '#3498db', '#e74c3c', '#e67e22', '#8e44ad'],
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [<?= $prestasi->tahun_2015() ?>, <?= $prestasi->tahun_2016() ?>, <?= $prestasi->tahun_2017() ?>, <?= $prestasi->tahun_2018() ?>, <?= $prestasi->tahun_2019() ?>]
            }, ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<script>
    var angkatan = document.getElementById("data2").getContext('2d');
    var myChart = new Chart(angkatan, {
        type: 'line',
        data: {
            labels: ['Cyber 05', 'Cyber 06', 'Cyber 07', 'Cyber 08', 'Cyber 09', 'Cyber 10', 'Cyber 11', 'Cyber 12', 'Cyber 13'],
            datasets: [{
                label: 'Perolehan Perangkatan',
                backgroundColor: '#DC3545',
                borderColor: '#DC3545',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [<?= $prestasi->Cyber_05() ?>, <?= $prestasi->Cyber_06() ?>, <?= $prestasi->Cyber_07() ?>, <?= $prestasi->Cyber_08() ?>, <?= $prestasi->Cyber_09() ?>, <?= $prestasi->Cyber_10() ?>, <?= $prestasi->Cyber_11() ?>, <?= $prestasi->Cyber_12() ?>, <?= $prestasi->Cyber_13() ?>]
            }, ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<?= $this->endSection(); ?>