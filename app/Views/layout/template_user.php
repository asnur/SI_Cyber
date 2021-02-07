<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#3498db">
    <link rel="stylesheet" href="/plugins/css/bootstrap.css">
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/font-awesome.css">
    <link rel="stylesheet" href="/plugins/css/style.css">
    <link rel="stylesheet" href="/plugins/aos/aos.css">
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/fullcalendar/fullcalendar.css" />
    <link rel="manifest" href="/manifest.json">
    <title>Cyber Creative</title>
</head>

<body>
    <?php
    if (session()->getFlashdata('pesan')) :
    ?>
        <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>
    <?php endif ?>
    <div class="preloader">
        <div class="loading">
            <img src="/dist/img/preloader.gif" width="80">
            <p>Harap Tunggu</p>
        </div>
    </div>
    <nav class="navbar navbar-expand-md fixed-top navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="<?= ('/dist/img/logo.png') ?>" class="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Beranda <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/anggota">Anggota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/pendaftaran">Pendaftaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/donasi">Donasi</a>
                    </li>
                    <?php if (!isset($_SESSION['user'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link text-light btn-login" href="/login"><i class="fa fa-sign-in"></i> Masuk</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link text-light btn-login dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> &nbsp;<?= $_SESSION['user'][0]['nama']; ?></a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="width: 100%;">
                                <a class="dropdown-item" href="/user/profil"><i class="fa fa-gear"></i> Ubah Profil</a>
                                <a class="dropdown-item" href="/user/absen"><i class="fa fa-camera"></i> Absen</a>
                                <a class="dropdown-item" href="/login/logout"><i class="fa fa-sign-out"></i> Keluar</a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <?= $this->renderSection('content'); ?>

    <div class="footer mt-5">
        <div class="container p-4">
            <div class="row">
                <div class="col-md-4">
                    <h2>Hubungi Kami</h2>
                    <ul class="mt-4">
                        <li style="list-style-image: url(/dist/img/gmail.png);">cybercreative9208@gmail.com</li>
                        <li style="list-style-image: url(/dist/img/instagram.png);">cybercreative08</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h2>Alamat Kami</h2>
                    <p>Jl. Raya Bogor No.7, Pabuaran, Cibinong, Bogor, Jawa Barat 16916</p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.4722399188654!2d106.85155581449557!3d-6.46169796497861!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ea787a7a09ab%3A0x89557e04b1f1d756!2sSMK+Insan+Kreatif!5e0!3m2!1sid!2sid!4v1544228545243" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <div class="col-md-4 text-center">
                    <img src="/dist/img/icon.png">
                    <h3>Cyber Creative</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- <div id="my_camera" style="display:none;"></div> -->
</body>
<script src="/plugins/jquery/jquery.min.js"></script>
<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="/plugins/js/bootstrap.min.js"></script>
<script src="/plugins/aos/aos.js"></script>
<script src="/plugins/js/popper.min.js"></script>
<script src="/plugins/moment/moment.min.js"></script>
<script src="/plugins/fullcalendar/fullcalendar.min.js"></script>
<script src="/plugins/chart.js/Chart.min.js"></script>
<script src="/plugins/slicker/slick.js"></script>
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/plugins/bootstrap-show-password-master/src/bootstrap-show-password.js"></script>
<script src="/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="/plugins/jquery-mask/jquery-mask.js"></script>
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-NsNt6ipz4eLWEUD_"></script>
<script src="http://d3js.org/d3.v3.min.js"></script>
<script src="http://d3js.org/topojson.v1.min.js"></script>
<script>
    var width = 990,
        height = 420,
        centered;

    var projection = d3.geo.equirectangular()
        .scale(1400)
        .rotate([-115, 2]);
    // .translate([width / 2, height / 2])

    var path = d3.geo.path()
        .projection(projection);

    var svg = d3.select("#map")
    // .attr("width", width)
    // .attr("height", height);

    svg.append("rect")
        .attr("class", "background")
        // .attr("width", width)
        // .attr("height", height)
        .on("click", clicked);

    var g = svg.append("g");

    d3.json("/indonesia.json", function(error, us) {
        if (error) throw error;

        g.append("g")
            .attr("id", "subunits")
            .selectAll("path")
            .data(topojson.feature(us, us.objects.states_provinces).features)
            .enter().append("path")
            .attr("d", path)
            .on("click", clicked);

        g.append("path")
            .datum(topojson.mesh(us, us.objects.states_provinces, function(a, b) {
                return a !== b;
            }))
            .attr("id", "state-borders")
            .attr("d", path);
    });

    function regionInfo(region) {
        return region.properties.region_cod;
    }

    //*/



    function clicked(d) {
        var x, y, k;

        if (d) {
            console.log(d.properties);
            let id = regionInfo(d);

            $.ajax({
                url: `/user/api_corona_prov`,
                headers: {
                    'Access-Control-Allow-Origin': '*'
                },
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    console.log(result);
                    let data = result;
                    $('#info').html('');
                    var data_covid = $.grep(data, (element, index) => {
                        return element.attributes.Kode_Provi == id;
                    });
                    console.log(data_covid);
                    $('#info').append(`
                    <div class="col-md-12 text-center">${data_covid[0].attributes.Provinsi}</div>
                        <div class="col-md-4">
                    <div class="card bg-success">
                        <h2 class="text-white mt-2">${data_covid[0].attributes.Kasus_Semb}</h2>
                        <h2 class="text-white">Sembuh</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning">
                        <h2 class="text-white mt-2">${data_covid[0].attributes.Kasus_Posi}</h2>
                        <h2 class="text-white">Positif</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-danger">
                        <h2 class="text-white mt-2">${data_covid[0].attributes.Kasus_Meni}</h2>
                        <h2 class="text-white">Meninggal</h2>
                    </div>
                </div>
        `)


                }
            })

        } else {
            $.ajax({
                url: `/user/api_corona_indo`,
                type: 'get',
                dataType: 'json',
                success: function(corona) {
                    $('#info').append(`
            <div class="col-md-4">
                    <div class="card bg-success">
                        <h2 class="text-white mt-2">${corona.sembuh}</h2>
                        <h2 class="text-white">Sembuh</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning">
                        <h2 class="text-white mt-2">${corona.positif}</h2>
                        <h2 class="text-white">Positif</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-danger">
                        <h2 class="text-white mt-2">${corona.meninggal}</h2>
                        <h2 class="text-white">Meninggal</h2>
                    </div>
                </div>`)
                }
            })

        }

        if (d && centered !== d) {
            var centroid = path.centroid(d);
            x = centroid[0];
            y = centroid[1];
            k = 4;
            centered = d;
        } else {
            x = width / 2;
            y = height / 2;
            k = 1;
            centered = null;
        }

        g.selectAll("path")
            .classed("active", centered && function(d) {
                return d === centered;
            });

        g.transition()
            .duration(750)
            .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")scale(" + k + ")translate(" + -x + "," + -y +
                ")")
            .style("stroke-width", 1.5 / k + "px");
    }
</script>
<script type="text/javascript">
    $('#pay-button').click(function(event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");
        var uang = $('.uang').val();
        var catatan = $('.catatan').val();
        $.ajax({
            type: 'POST',
            url: '<?= site_url() ?>/user/token',
            data: {
                uang: uang,
                catatan: catatan
            },
            cache: false,

            success: function(data) {
                //location = data;

                console.log('token = ' + data);

                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type, data) {
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                    // resultType.innerHTML = type;
                    // resultData.innerHTML = JSON.stringify(data);
                }

                snap.pay(data, {

                    onSuccess: function(result) {
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result) {
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result) {
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                });
            }
        });
    });
</script>
<script>
    $(".preloader").fadeOut();
</script>
<script>
    if ("serviceWorker" in navigator) {
        window.addEventListener("load", function() {
            navigator.serviceWorker
                .register("/service-worker.js")
                .then(function() {
                    console.log("Pendaftaran ServiceWorker berhasil");
                })
                .catch(function() {
                    console.log("Pendaftaran ServiceWorker gagal");
                });
        });
    } else {
        console.log("ServiceWorker belum didukung browser ini.");
    }
</script>
<script>
    const flashdata = $('.flash-data').data('flashdata');
    if (flashdata == 'Pendaftaran Gagal') {
        Swal.fire(
            'Gagal!',
            flashdata,
            'error'
        );
    }
    if (flashdata == 'Mengirim Komentar Gagal Anda Harus Login Terlebih dahulu') {
        Swal.fire(
            'Gagal!',
            flashdata,
            'error'
        );
    }
    if (flashdata == 'Anda Sudah Absen') {
        Swal.fire(
            'Gagal!',
            flashdata,
            'error'
        );
    }
    if (flashdata == 'Anda Berhasil Login') {
        Swal.fire(
            'Berhasil!',
            flashdata,
            'success'
        );
    }
    if (flashdata == 'Data Berhasil diUbah') {
        Swal.fire(
            'Berhasil!',
            flashdata,
            'success'
        );
    }
    if (flashdata == 'Komentar Berhasil diTambahkan') {
        Swal.fire(
            'Berhasil!',
            flashdata,
            'success'
        );
    }
    if (flashdata == 'Absensi Berhasil') {
        Swal.fire(
            'Berhasil!',
            flashdata,
            'success'
        );
    }
    if (flashdata == 'Donasi Berhasil diKirim Silahkan Selesaikan Pembayaran') {
        Swal.fire(
            'Berhasil!',
            flashdata,
            'success'
        );
    }
</script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
    });
</script>
<script>
    $(document).ready(function() {
        var scroll_pos = 0;
        $(document).scroll(function() {
            scroll_pos = $(this).scrollTop();
            if (scroll_pos > 100) {
                $("nav").css('background-color', 'white');
            } else {
                $("nav").css('background-color', 'rgba(0,0,0,0)');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.customer-logos').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            arrows: false,
            dots: false,
            pauseOnHover: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 3
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: 1
                }
            }]
        });
    });
</script>
<script>
    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
            header: {
                left: 'prev,next ',
                center: 'title',
                right: 'month,agendaDay'
            },
            'themeSystem': 'bootstrap',
            events: '/admin/load_agenda',
            selectable: true,
            selectHelper: true,
        });
    });
</script>
<script>
    $('.jumlah').each(function() {
        var $this = $(this);
        jQuery({
            Counter: 0
        }).animate({
            Counter: $this.text()
        }, {
            duration: 3000,
            easing: 'swing',
            step: function() {
                $this.text(Math.ceil(this.Counter));
            }
        });
    });
</script>
<script>
    $('#tableAnggota').DataTable({
        'responsive': true,
        'autoWidth': false
    });
</script>
<script>
    AOS.init();
</script>

</html>