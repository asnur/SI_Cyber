<?= $this->extend('layout/template_user'); ?>


<?= $this->section('content'); ?>

<?php
function generateRandomString($length = 5)
{
    $characters = '123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
<?php
if (session()->getFlashdata('pesan')) :
?>
    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>
<?php endif ?>

<section class="content" style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-lightblue">
                        Data Calon Anggota Baru
                    </div>
                    <div class="card-body">
                        <form class="form" action="/user/save_pendaftaran" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <label>Nama Lengkap</label>
                            <input type="text" placeholder="Masukan Nama Lengkap" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama'); ?>
                            </div>
                            <label class="mt-2">Username</label>
                            <input type="text" name="username" value="CCUSER<?= generateRandomString(); ?>" placeholder="Masukan Username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                            <label class="mt-2">Email</label>
                            <input type="email" name="email" placeholder="Masukan Email Aktif" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('username'); ?>
                            </div>
                            <label class="mt-2">Password</label>
                            <input type="password" name="password" data-toggle="password" value="CCPW<?= generateRandomString(); ?>" placeholder="Masukan Password" class="form-control">
                            <label class="mt-2">Alamat</label>
                            <input type="text" name="alamat" placeholder="Masukan Alamat" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('alamat'); ?>
                            </div>
                            <label class="mt-2">No Hp</label>
                            <input type="number" name="no_tlp" placeholder="Masukan No Hp" class="form-control <?= ($validation->hasError('no_tlp')) ? 'is-invalid' : ''; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_tlp'); ?>
                            </div>
                            <label class="mt-2">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="Laki-laki">LAKI-LAKI</option>
                                <option value="Perempuan">PEREMPUAN</option>
                            </select>
                            <input type="hidden" value="Calon" name="status">
                            <br>
                            <button type="submit" name="tambah" class="btn btn-success"><i class="fa fa-paper-plane"></i> Daftar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-purple">
                            Foto Anggota Baru
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <center>
                                    <img id="blah" src="<?= base_url('dist/img/find_user.png'); ?>" alt="your image" class="img-user mb-2 img-circle" />
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
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>