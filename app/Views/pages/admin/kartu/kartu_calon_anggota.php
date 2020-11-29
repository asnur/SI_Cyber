<?php


require  'plugins/html2pdf/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

include 'plugins/phpqrcode/qrlib.php';
$nama = $kartu['username'] . '-' . $kartu['nama'] . '-' . $kartu['angkatan'];
$tempdir = 'plugins/phpqrcode/temp/';
$logopath = 'dist/img/icon.png';
$codeContents = $kartu['username'] . '-' . $kartu['password'] . '-' . $kartu['nama'] . '-' . $kartu['angkatan'];
QRcode::png($codeContents, $tempdir . $nama . ".png", QR_ECLEVEL_H);
$filepath = $tempdir . $nama . '.png';
$QR = imagecreatefrompng($filepath);

$logo = imagecreatefromstring(file_get_contents($logopath));
$QR_width = imagesx($QR);
$QR_height = imagesy($QR);

$logo_width = imagesx($logo);
$logo_height = imagesy($logo);

//besar logo
$logo_qr_width = $QR_width / 3.2;
$scale = $logo_width / $logo_qr_width;
$logo_qr_height = $logo_height / $scale;

//posisi logo
imagecopyresampled($QR, $logo, $QR_width / 3, $QR_height / 2.9, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

imagepng($QR, $filepath);

if (empty($kartu['foto'])) {
    $content = '
<style>
    .kartu {
        height: 99.9%;
        background-image: url(dist/img/bg_card.png);
    }

    .logo {
        margin: 10px;
        width: 170px;
        height: 50px;
    }
</style>
<div class="kartu">
    <img src="dist/img/logo.png" class="logo"><br>
    <div style="position:relative; margin-top:30px;">
        <div style="position:fixed; margin:0% 30%; border:5px lightblue solid; width: 120px; height:120px; border-radius:50%;">
            <img src="dist/img/user-icon.png" style="width: 100%; height: 100%;">
        </div>
    </div><br>
    <h3 align="center" style="line-height:0px;">' . $kartu['nama'] . '</h3><br>
    <br>
    <div style="width:35%; padding:8px; margin:0% 32%; border-radius:20px; background:lightblue; box-shadow: 5px 5px #000;">
        <h3 align="center" style="font-size:20px; font-weight:bold; line-height:0; margin-top:0px;">Peserta</h3>
    </div>
</div>
<div class="kartu">
    <img src="dist/img/logo.png" class="logo"><br><br>
    <div style="text-align: center;">
        <h1>Perhatian !!!</h1>
        <p style="font-size: 14px;">
            Kartu ini tidak boleh disalah gunakan<br>
            Kartu ini hanya untuk anggota resmi Cyber Creative<br>
            dan untuk dibawa setiap acara Cyber Creative
        </p>
        <br>
        <br>
        <img src="' . $tempdir . $nama . '.png" style="border:1px #000 solid;" />
    </div>
</div>
';
} else {
    $content = '
<style>
    .kartu {
        height: 99.9%;
        background-image: url(dist/img/bg_card.png);
    }

    .logo {
        margin: 10px;
        width: 170px;
        height: 50px;
    }
</style>
<div class="kartu">
    <img src="dist/img/logo.png" class="logo"><br>
    <div style="position:relative; margin-top:30px;">
        <div style="position:fixed; margin:0% 30%; border:5px lightblue solid; width: 120px; height:120px; border-radius:50%;">
            <img src="data:image/jpeg;base64,' . base64_encode($kartu['foto']) . '" style="width: 100%; height: 100%;">
        </div>
    </div><br>
    <h3 align="center" style="line-height:0px;">' . $kartu['nama'] . '</h3><br>
    <br>
    <div style="width:35%; padding:8px; margin:0% 32%; border-radius:20px; background:lightblue; box-shadow: 5px 5px #000;">
        <h3 align="center" style="font-size:20px; font-weight:bold; line-height:0; margin-top:0px;">Peserta</h3>
    </div>

</div>
<div class="kartu">
    <img src="dist/img/logo.png" class="logo"><br><br>
    <div style="text-align: center;">
        <h1>Perhatian !!!</h1>
        <p style="font-size: 14px;">
            Kartu ini tidak boleh disalah gunakan<br>
            Kartu ini hanya untuk anggota resmi Cyber Creative<br>
            dan untuk dibawa setiap acara Cyber Creative
        </p>
        <br>
        <br>
        <img src="' . $tempdir . $nama . '.png" style="border:1px #000 solid;" />
    </div>
</div>
';
}


$html2pdf = new HTML2PDF('P', array('100', '140'), 'en', true, 'UTF-8', array(0, 0, 0, 0));
$html2pdf->WriteHTML($content);
$html2pdf->Output('Kartu_Peserta_' . $kartu['nama'] . '.pdf');
exit();
