<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content'); ?>

<div class="container" style="margin-top: 100px;">
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card bio">
                <div class="text-center mt-3">
                    <?php
                    if (empty($profil['foto'])) {
                        echo "<img src=" . base_url('dist/img/find_user.png') . " class='mb-4'>";
                    } else {
                        echo "<img src=" . base_url('dist/img/' . $profil['foto'] . '') . " class='mb-4 img-user'>";
                    }
                    ?>

                    <table class="text-left table table-striped">
                        <tr>
                            <td>Nama</td>
                            <td>: <?= $profil['nama'] ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>: <?= $profil['jenis_kelamin'] ?></td>
                        </tr>
                        <tr>
                            <td>Angkatan</td>
                            <td>: <?= $profil['angkatan'] ?></td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>: <?= $profil['jabatan'] ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>: <?= $profil['status'] ?></td>
                        </tr>
                    </table>
                    <a href="/kartu_anggota/<?= $profil['username'] ?>" class="btn btn-primary mt-1 mb-3"><i class="fa fa-print"></i> Cetak Kartu Anggota</a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card bio">
                <div class="card-body">
                    <form action="/user/ubah_data/<?= $profil['id'] ?>" enctype="multipart/form-data" method="POST">
                        <?= csrf_field(); ?>
                        <label>Nama</label>
                        <input name="nama" class="form-control mb-3 <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" type="text" value="<?= $profil['nama'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                        <label>Username</label>
                        <input class="form-control mb-3 <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" name="username" type="text" value="<?= $profil['username'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('username'); ?>
                        </div>
                        <label>Email</label>
                        <input class="form-control mb-3 <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" type="email" value="<?= $profil['email'] ?>" name="email">
                        <div class="invalid-feedback">
                            <?= $validation->getError('email'); ?>
                        </div>
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control mb-3">
                            <option value="Laki-laki" <?php if ($profil['jenis_kelamin'] == "Laki-laki") echo 'selected=selected'; ?>>LAKI-LAKI</option>
                            <option value="Perempuan" <?php if ($profil['jenis_kelamin'] == "Perempuan") echo 'selected=selected'; ?>>PEREMPUAN</option>
                        </select>
                        <label>Alamat</label>
                        <input class="form-control mb-3 <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" name="alamat" type="text" value="<?= $profil['alamat'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                        <label>No Tlp</label>
                        <input class="form-control mb-3 <?= ($validation->hasError('no_tlp')) ? 'is-invalid' : ''; ?>" name="no_tlp" type="text" value="<?= $profil['no_tlp'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_tlp'); ?>
                        </div>
                        <label>Foto</label>
                        <input type="file" class="form-control mb-3 <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" name="foto">
                        <div class="invalid-feedback">
                            <?= $validation->getError('foto'); ?>
                        </div>
                        <label>Angkatan</label>
                        <select name="angkatan" class="form-control mb-3">
                            <?php
                            for ($i = 1; $i <= 9; $i++) {
                            ?>
                                <option value="Cyber 0<?= $i; ?>" <?php if ($profil['angkatan'] == "Cyber 0$i") echo 'selected=selected'; ?>>Cyber 0<?= $i; ?></option>
                            <?php } ?>
                            <?php
                            for ($i = 10; $i <= 13; $i++) {
                            ?>
                                <option value="Cyber <?= $i; ?>" <?php if ($profil['angkatan'] == "Cyber $i") echo 'selected=selected'; ?>>Cyber <?= $i; ?></option>
                            <?php } ?>
                        </select>

                        <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i> Ubah Profil</button>
                        <a href="/login/lupa_password" class="btn btn-secondary"><i class="fa fa-lock"></i> Ubah Password</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>