<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content'); ?>

<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-md-6 text-center">
            <img src="/dist/img/bills.png" style="width:100%; height:100%;">
        </div>
        <div class="col-md-6">
            <h3 class="mt-5">Apakah anda sudah membantu Juniormu dalam Melaksanakan program kerjanya?..</h3>
            <br>
            <h5>Anda bisa memberikan bantuan melalui form dibawah ini dengan mengisikan nominal yang anda inginkan</h5>
            <br>
            <form id="payment-form" method="POST" action="/user/finish">
                <?= csrf_field(); ?>
                <input type="hidden" name="result_type" id="result-type" value="">
                <input type="hidden" name="result_data" id="result-data" value="">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp.</span>
                    </div>
                    <input type="number" name="nominal" placeholder="Masukan Nominal" class="uang form-control">
                </div>
                <textarea class="form-control" name="catatan" rows="4" placeholder="Masukan Catatan"></textarea>
                <br>
            </form>
            <button id="pay-button" class="btn btn-primary"><i class="fa fa-money"></i> Bayar</button>
        </div>
    </div>
</div>

<div class="info mt-5 mb-5 p-5">
    <div class="container p-5 isi-info">
        <div class="row">
            <div class="col-md-6 text-center">
                <h1 style="font-size: 65px; font-weight:500;">Rp. <?= number_format($jumlah_donasi[0]['jumlah']) ?></h1>
                <h1><i class="fa fa-money"></i> Terkumpul</h1>
            </div>
            <div class="col-md-6 text-center">
                <h1 class="jumlah"><?= number_format($jumlah_pendonasi) ?></h1>
                <h1><i class="fa fa-users"></i> Orang</h1>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 100px;">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h2>Riwayat Donasi Anda</h2>
        </div>
        <div class="card-body">
            <table id="tableAnggota" class="table table-bordered table-striped">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>ID Pembayaran</th>
                        <th>Nominal</th>
                        <th>Tipe Pembayaran</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data_donasi as $d) :
                    ?>
                        <tr>
                            <td align="center"><?= $d['id_pembayaran']; ?></td>
                            <td align="right">Rp. <?= number_format($d['nominal']); ?></td>
                            <td align="center"><?= $d['jenis_pembayaran']; ?></td>
                            <td align="center"><?= $d['waktu']; ?></td>
                            <td align="center">
                                <?php
                                if ($d['status'] == 'pending') {
                                    echo '<p class="btn btn-warning">Pending</p>';
                                } elseif ($d['status'] == 'settlement') {
                                    echo '<p class="btn btn-success">Suksess</p>';
                                } elseif ($d['status'] == 'failure') {
                                    echo '<p class="btn btn-danger">Gagal</p>';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="bg-primary text-white">
                    <tr>
                        <th>ID Pembayaran</th>
                        <th>Nominal</th>
                        <th>Tipe Pembayaran</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

</div>

<?= $this->endSection(); ?>