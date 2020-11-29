<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
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

                <form action="/login/cek_login" class="login100-form validate-form" method="POST">
                    <span class="login100-form-title">
                        Member Login
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="pass" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">
                            Login
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        <span class="txt1">
                            Lupa
                        </span>
                        <a class="txt2" href="/login/lupa_password">
                            Username / Password?
                        </a>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="<?= base_url('login/daftar_member'); ?>">
                            Buat Akun Baru
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
        if (flashdata == 'Verifikasi Berhasil') {
            Swal.fire(
                'Berhasil!',
                flashdata,
                'success'
            );
        }
        if (flashdata == 'Password Berhasil di Ubah') {
            Swal.fire(
                'Berhasil!',
                flashdata,
                'success'
            );
        }
    </script>
    <!--===============================================================================================-->
    <script src="<?= base_url('plugins/login/js/main.js') ?>"></script>

</body>

</html>