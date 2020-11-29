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
        .wrap-login100 {
            width: 55%;
        }

        .daftar {
            margin-top: -100px;
            width: 100%;
            margin-left: 30px;
        }

        .login100-form-title {
            margin-bottom: -30px;
        }

        @media (max-width: 680px) {
            .daftar {
                margin-top: 0;
                margin-left: 0;
            }

            .wrap-login100 {
                width: 450px;
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
                <form action="/login/proses_verifikasi_lupa" class="login100-form validate-form daftar" method="POST">
                    <?= csrf_field(); ?>
                    <span class="login100-form-title">
                        Verifikasi Kode
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Kode Harus Diisi">
                        <input type="hidden" value="<?= $kode[0]['username'] ?>" name="username">
                        <input class="input100" type="text" name="kode" placeholder="Kode Verifikasi">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>



                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" name="submit" type="submit">
                            Verifikasi
                        </button>
                    </div>

                    <div class="text-center p-t-12">
                        <a class="txt2" href="<?= base_url('login/kirim_ulang/' . $kode[0]['id'] . '/' . $kode[0]['username'] . '/' . $kode[0]['email']); ?>">
                            Kirim Ulang Kode
                        </a><br>
                        <a class="txt2" href="<?= base_url('login/index'); ?>">
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
        if (flashdata == 'Email Berhasil ditemukan, silahkan cek email anda untuk melihat kode verifikasi') {
            Swal.fire(
                'Berhasil!',
                flashdata,
                'success'
            );
        }
        if (flashdata == 'Kode Yang Anda Masukan Salah') {
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