<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daftar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--===============================================================================================-->
    <link rel="stylesheet" href="<?= base_url('plugins/login/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="<?= base_url('plugins/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="<?= base_url('plugins/login/vendor/animate/animate.css') ?>">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="<?= base_url('plugins/login/vendor/css-hamburgers/hamburgers.min.css') ?>">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="<?= base_url('plugins/login/vendor/select2/select2.min.css') ?>">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="<?= base_url('plugins/login/css/util.css') ?>">
    <link rel="stylesheet" href="<?= base_url('plugins/login/css/main.css') ?>">
    <!--===============================================================================================-->
    <style>
        .daftar {
            margin-top: -100px;
        }

        .login100-form-title {
            margin-bottom: -30px;
        }

        @media (max-width: 680px) {
            .daftar {
                margin-top: 0;
            }
        }
    </style>
</head>

<body>
    <?php
    if (session()->getFlashdata('pesan')) :
    ?>
        <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>
    <?php endif ?>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="<?= base_url('dist/img/coding.png'); ?>" alt="IMG">
                </div>

                <form action="/login/save_daftar_member" class="login100-form validate-form daftar" method="POST">
                    <span class="login100-form-title">
                        Daftar Member
                    </span>

                    <div class="wrap-input100 <?= ($validation->hasError('username')) ? 'validate-input' : ''; ?>" data-validate="<?= $validation->getError('username'); ?>">
                        <input class="input100" type="text" name="username" placeholder="Username">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Username Harus Diisi">
                        <input class="input100" type="text" name="nama" placeholder="Nama Lengkap">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-id-card" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Jenis Kelamin Harus Dipilih">
                        <select class="input100" name="jenis_kelamin" style="border: none;">
                            <option value="">Jenis Kelamin</option>
                            <option value="Laki-laki"> Laki-laki</option>
                            <option value="Perempuan"> Perempuan</option>
                        </select>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Email Tidak Valid">
                        <input class="input100" type="text" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password Harus Diisi">
                        <input class="input100" type="password" name="pass" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Angkata Harus Dipilih">
                        <select class="input100" name="angkatan" style="border: none;">
                            <option value="">Angkatan</option>
                            <?php
                            for ($i = 1; $i <= 9; $i++) {
                            ?>
                                <option value="Cyber 0<?= $i; ?>"> Cyber 0<?= $i; ?></option>
                            <?php  }  ?>
                            <?php
                            for ($i = 10; $i <= 14; $i++) {
                            ?>
                                <option value="Cyber <?= $i; ?>"> Cyber <?= $i; ?></option>
                            <?php  }  ?>
                        </select>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-history" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" name="submit" type="submit">
                            Daftar
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">
                            Lupa
                        </span>
                        <a class="txt2" href="#">
                            Username / Password?
                        </a><br>
                        <a class="txt2" href="/<?= base_url('login/index'); ?>">
                            Sudah Punya Akun Login
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!--===============================================================================================-->
    <script src="<?= base_url('plugins/login/vendor/jquery/jquery-3.2.1.min.js') ?>"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('plugins/login/vendor/bootstrap/js/popper.js') ?>"></script>
    <script src="<?= base_url('plugins/login/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('plugins/login/vendor/select2/select2.min.js') ?>"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('plugins/login/vendor/tilt/tilt.jquery.min.js') ?>"></script>
    <script src="<?= base_url('plugins/sweetalert2/dist/sweetalert2.all.min.js'); ?>"></script>
    <script>
        $('.js-tilt ').tilt({
            scale: 1.1
        })
    </script>
    <script>
        const flashdata = $('.flash-data').data('flashdata');
        if (flashdata == 'Anda Gagal Login') {
            Swal.fire(
                'Gagal!',
                flashdata,
                'error'
            );
        }
        if (flashdata == 'Pendaftaran Gagal') {
            Swal.fire(
                'Gagal!',
                flashdata,
                'error'
            );
        }
        if (flashdata == 'Pendaftaran Gagal Mungkin Username atau Email Sudah dipakai') {
            Swal.fire(
                'Gagal!',
                flashdata,
                'error'
            );
        }
    </script>
    <!--===============================================================================================-->
    <script src="<?= base_url('plugins/login/js/main.js') ?>"></script>

</body>

</html>