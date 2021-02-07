<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content'); ?>

<div class="container" style="margin-top: 100px;">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Pemberitahuan!</strong> Absen Akan di tutup setelah jam 07.00 WIB.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="row">
        <div class="col-md-12 card bg-light">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 connectedSortable">
                        <center>
                            <div id="my_camera" style="width: 320px; height:240px; border: 1px #000 solid;"></div>

                            <button type="button" onClick="take_snapshot()" class="btn btn-success mt-3 mb-3" <?= (date('H') >= 24) ? 'disabled' : '' ?>><i class="fa fa-camera"></i> Ambil Foto</button>
                            <!-- <button onClick="saveSnap()" class="btn btn-success mt-3 mb-3"><i class="fa fa-camera"></i> Kirim Foto</button> -->
                            <!-- <input type=button value="Save Snapshot" onClick="saveSnap()"> -->
                            <div id="results"></div>
                        </center>
                    </div>
                    <div class="col-lg-6">
                        <div class="jam_analog">
                            <div class="xxx">
                                <div class="jarum jarum_detik"></div>
                                <div class="jarum jarum_menit"></div>
                                <div class="jarum jarum_jam"></div>
                                <div class="lingkaran_tengah"></div>
                            </div>
                        </div>
                        <div class="jam-digital col-5 mx-auto">
                            <center>
                                <div class="kotak">
                                    <p id="jam"></p>
                                </div>
                                <div class="kotak">
                                    <p>:</p>
                                </div>
                                <div class="kotak">
                                    <p id="menit"></p>
                                </div>
                                <div class="kotak">
                                    <p>:</p>
                                </div>
                                <div class="kotak">
                                    <p id="detik"></p>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="col-lg-12 connectedSortable mt-5">
            <h1 align="center">Riwayat Absensi</h1>
            <div class="card">
                <div class="card-body">
                    <table id="tableAnggota" class="table table-bordered table-striped">
                        <thead class="text-white" style="background-color: #6BAFCF;">
                            <tr>
                                <th>Foto</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>latitude</th>
                                <th>Longitude</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($absen as $a) :
                            ?>
                                <tr>
                                    <td align="center">
                                        <?php
                                        if (empty($a['foto'])) {
                                            echo '<img src="/dist/img/user-icon.png" style="width: 80px; height: 100px; object-fit:cover; object-position:center;" class="image"/>';
                                        } else {
                                            echo '<img src="/dist/img/absen/' . $a['foto'] . '" style="width: 80px; height: 100px; object-fit:cover; object-position:center;" class="image"/>';
                                        } ?>
                                    </td>
                                    <td><?= $a['tanggal']; ?></td>
                                    <td align="center"><?= $a['jam']; ?></td>
                                    <td align="center"><?= $a['lat']; ?></td>
                                    <td align="center"><?= $a['long']; ?></td>
                                    <td align="center">
                                        <a href="https://www.google.co.id/maps/@<?= $a['lat'] ?>,<?= $a['long'] ?>,25z" class="btn btn-success"><i class="fa fa-map"></i> Lokasi Anda</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <tfoot class="text-white" style="background-color: #6BAFCF;">
                            <tr>
                                <th>Foto</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>latitude</th>
                                <th>Longitude</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </section>

        <form id="myform" method="post" action="/user/upload_absen">
            <?= csrf_field() ?>
            <input id="mydata" type="hidden" name="mydata" value="" />
            <input id="id_user" type="hidden" name="id_user" value="<?= $_SESSION['user'][0]['id'] . '-' . date('Y-m-d'); ?>" />
            <input id="lat" type="hidden" name="lat" value="" />
            <input id="long" type="hidden" name="long" value="" />
        </form>
        <div id="results"></div>
    </div>
</div>
<script type="text/javascript" src="/plugins/webcam/webcamjs/webcam.min.js"></script>
<script src="/plugins/geojs/geo-min.js" type="text/javascript" charset="utf-8"></script>
<script language="JavaScript">
    // Configure a few settings and attach camera
    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach('#my_camera');
    // A button for taking snaps


    // preload shutter audio clip
    var shutter = new Audio();
    shutter.autoplay = false;
    shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : '/plugins/webcam/shutter.mp3';

    function take_snapshot() {
        // play sound effect
        shutter.play();

        // take snapshot and get image data
        Webcam.snap(function(data_uri) {
            // display results in page
            document.getElementById('results').innerHTML =
                `
                <div class="card">
                    <div class="card-header text-white" style="background-color: #6BAFCF;">
                        <h4>Data Absensi Anda</h4>
                    </div>
                    <div class="card-body">
                        <center>
                            <img class="mt-3 mb-3" id="imageprev" src="${data_uri}" style="width:320px; height:240px; object-fit:cover;object-possition:center;"/>
                            <h4 class="mb-3"><?= (!isset($_SESSION['user'])) ? '' : $_SESSION['user'][0]['nama'] ?></h4>
                        </center>
                        <table class="table table-striped">
                            <tr>
                                <td>Angkatan</td>
                                <td>:</td>
                                <td><?= (!isset($_SESSION['user'])) ? '' : $_SESSION['user'][0]['angkatan'] ?></td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td>:</td>
                                <td><?= (!isset($_SESSION['user'])) ? '' : $_SESSION['user'][0]['jabatan'] ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td><?= (!isset($_SESSION['user'])) ? '' : $_SESSION['user'][0]['status'] ?></td>
                            </tr>
                        </table>
                        <center>
                            <button onclick="saveSnap()" class="btn btn-success"><i class="fa fa-paper-plane"></i> Kirim</button>
                        </center>
                    </div>
                </div>
                `;
        });
    }
    if (geo_position_js.init()) {
        geo_position_js.getCurrentPosition(success_callback, error_callback, {
            enableHighAccuracy: true
        });
    } else {
        alert("Functionality not available");
    }

    function success_callback(p) {
        // alert('lat=' + p.coords.latitude + ';lon=' + p.coords.longitude);
        document.getElementById('lat').value = p.coords.latitude;
        document.getElementById('long').value = p.coords.longitude;

    }

    function error_callback(p) {
        // alert('error=' + p.message);
    }

    function saveSnap() {
        var base64image = document.getElementById("imageprev").src;
        var raw_image_data = base64image.replace(/^data\:image\/\w+\;base64\,/, '');

        document.getElementById('mydata').value = raw_image_data;
        document.getElementById('myform').submit();
    }
</script>
<script type="text/javascript">
    const secondHand = document.querySelector('.jarum_detik');
    const minuteHand = document.querySelector('.jarum_menit');
    const jarum_jam = document.querySelector('.jarum_jam');

    function setDate() {
        const now = new Date();
        const seconds = now.getSeconds();
        const secondsDegrees = ((seconds / 60) * 360) + 90;
        secondHand.style.transform = `rotate(${secondsDegrees}deg)`;
        if (secondsDegrees === 90) {
            secondHand.style.transition = 'none';
        } else if (secondsDegrees >= 91) {
            secondHand.style.transition = 'all 0.05s cubic-bezier(0.1, 2.7, 0.58, 1)'
        }

        const minutes = now.getMinutes();
        const minutesDegrees = ((minutes / 60) * 360) + 90;
        minuteHand.style.transform = `rotate(${minutesDegrees}deg)`;

        const hours = now.getHours();
        const hoursDegrees = ((hours / 12) * 360) + 90;
        jarum_jam.style.transform = `rotate(${hoursDegrees}deg)`;
    }

    setInterval(setDate, 1000)
</script>
<script>
    window.setTimeout("waktu()", 1000);

    function waktu() {
        var waktu = new Date();
        setTimeout("waktu()", 1000);
        document.getElementById("jam").innerHTML = waktu.getHours();
        document.getElementById("menit").innerHTML = waktu.getMinutes();
        document.getElementById("detik").innerHTML = waktu.getSeconds();
    }
</script>

<?= $this->endSection(); ?>