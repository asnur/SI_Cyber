<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Data Anggota</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-lightblue">
                            Data <?= $detail['nama']; ?>
                        </div>
                        <div class="card-body">
                            <form class="form" action="/admin/save_edit_calon_anggota/<?= $detail['id'] ?>" method="POST" enctype="multipart/form-data">
                                <label>Nama Lengkap</label>
                                <input type="text" value="<?= $detail['nama']; ?>" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama'); ?>
                                </div>
                                <label class="mt-2">Username</label>
                                <input type="text" name="username" value="<?= $detail['username'] ?>" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('username'); ?>
                                </div>
                                <label class="mt-2">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="Laki-laki" <?php if ($detail['jenis_kelamin'] == "Laki-laki") echo 'selected=selected'; ?>>LAKI-LAKI</option>
                                    <option value="Perempuan" <?php if ($detail['jenis_kelamin'] == "Perempuan") echo 'selected=selected'; ?>>PEREMPUAN</option>
                                </select>
                                <label class="mt-2">Alamat</label>
                                <input type="text" name="alamat" value="<?= $detail['alamat'] ?>" placeholder="Masukan Alamat" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('alamat'); ?>
                                </div>
                                <label class="mt-2">No Hp</label>
                                <input type="number" name="no_tlp" value="<?= $detail['no_tlp'] ?>" placeholder="Masukan No Hp" class="form-control <?= ($validation->hasError('no_tlp')) ? 'is-invalid' : ''; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('no_tlp'); ?>
                                </div>
                                <label class="mt-2">Angkatan</label>
                                <select name="angkatan" class="form-control">
                                    <?php
                                    for ($i = 1; $i <= 9; $i++) {
                                    ?>
                                        <option value="Cyber 0<?= $i; ?>" <?php if ($detail['angkatan'] == "Cyber 0$i") echo 'selected=selected'; ?>>Cyber 0<?= $i; ?></option>
                                    <?php } ?>
                                    <?php
                                    for ($i = 10; $i <= 13; $i++) {
                                    ?>
                                        <option value="Cyber <?= $i; ?>" <?php if ($detail['angkatan'] == "Cyber $i") echo 'selected=selected'; ?>>Cyber <?= $i; ?></option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" value="Calon" name="status">
                                <br>
                                <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Ubah Data</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-purple">
                                Foto <?= $detail['nama']; ?>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <center>
                                        <?php
                                        if (empty($detail['foto'])) {
                                        ?>
                                            <img id="blah" src="<?= base_url('dist/img/user-icon.png'); ?>" alt="your image" class="img-user mb-2 img-circle" />
                                        <?php
                                        } else {
                                            echo '<img src="data:image/jpeg;base64,' . base64_encode($detail['foto']) . '" class="img-user img-circle"/>';
                                        }
                                        ?>
                                    </center>
                                    <label for="exampleInputFile">Foto</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input  <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" name="foto" id="imgInp">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('foto'); ?>
                                        </div>
                                        <label class="custom-file-label" for="exampleInputFile">Pilih Foto</label>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-teal">
                                QR Code <?= $detail['nama']; ?>
                            </div>
                            <div class="card-body">
                                <center>
                                    <?php
                                    include 'plugins/phpqrcode/qrlib.php';
                                    $nama = $detail['username'] . '-' . $detail['nama'] . '-' . $detail['jabatan'] . '-' . $detail['angkatan'];
                                    $tempdir = 'plugins/phpqrcode/temp/';
                                    $logopath = 'dist/img/icon.png';
                                    $codeContents = $detail['username'] . '-' . $detail['password'] . '-' . $detail['nama'] . '-' . $detail['jabatan'] . '-' . $detail['angkatan'];
                                    QRcode::png($codeContents, $tempdir . $nama . ".png", QR_ECLEVEL_H);
                                    $filepath = $tempdir . $nama . '.png';
                                    $QR = imagecreatefrompng($filepath);

                                    $logo = imagecreatefromstring(file_get_contents($logopath));
                                    $QR_width = imagesx($QR);
                                    $QR_height = imagesy($QR);

                                    $logo_width = imagesx($logo);
                                    $logo_height = imagesy($logo);


                                    $logo_qr_width = $QR_width / 3.2;
                                    $scale = $logo_width / $logo_qr_width;
                                    $logo_qr_height = $logo_height / $scale;


                                    imagecopyresampled($QR, $logo, $QR_width / 3, $QR_height / 2.9, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

                                    imagepng($QR, $filepath);
                                    echo "<img src='/$tempdir$nama.png'/>";
                                    ?>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?= $this->endSection(); ?>