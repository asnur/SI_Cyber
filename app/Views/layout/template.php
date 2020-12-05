<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/font-awesome.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/plugins/css/style_admin.css">
    <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="/plugins/fullcalendar/fullcalendar.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <a href="/login/logout" class="btn btn-danger"><i class="fa fa-sign-out"></i> Logout</a>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-maroon elevation-4">
            <!-- Brand Logo -->
            <a href="/admin/index" class="brand-link">
                <img src="/dist/img/icon.png" alt="" class="brand-image img-circle">
                <span class="brand-text">Cyber Creative</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="/dist/img/<?= $_SESSION['admin'][0]['foto'] ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $_SESSION['admin'][0]['nama']; ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview">
                            <a href="/admin/" class="nav-link">
                                <i class="nav-icon fa fa-tachometer"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/anggota" class="nav-link">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    Anggota
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/pendaftaran" class="nav-link">
                                <i class="nav-icon fa fa-id-card"></i>
                                <p>
                                    Pendaftaran
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/prestasi" class="nav-link">
                                <i class="nav-icon fa fa-trophy"></i>
                                <p>
                                    Prestasi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/artikel" class="nav-link">
                                <i class="nav-icon fa fa-newspaper-o"></i>
                                <p>
                                    Artikel
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/agenda" class="nav-link">
                                <i class="nav-icon fa fa-calendar"></i>
                                <p>
                                    Agenda
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <?= $this->renderSection('content'); ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script src="/plugins/jquery/jquery.min.js"></script>
    <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/plugins/moment/moment.min.js"></script>
    <script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="/dist/js/adminlte.js"></script>
    <script src="/dist/js/demo.js"></script>
    <script src="/plugins/bootstrap-show-password-master/src/bootstrap-show-password.js"></script>
    <script src="/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="/plugins/select2/js/select2.full.min.js"></script>
    <script src="/plugins/moment/moment.min.js"></script>
    <script src="/plugins/fullcalendar/fullcalendar.min.js"></script>
    <script>
        $(function() {
            $('.textarea').summernote()
        })
    </script>
    <script>
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listMonth'
                },
                events: '/admin/load_agenda',
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    var title = prompt("Masukan Nama Agenda");
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                        let baseUrl = 'http://localhost:8080/admin/tambah_agenda';
                        $.ajax({
                            url: baseUrl,
                            type: 'POST',
                            data: {
                                title: title,
                                start: start,
                                end: end
                            },
                            success: function(data) {
                                console.log(data);
                                calendar.fullCalendar('refetchEvents');
                                alert('Agenda Ditambahkan');
                            }
                        })
                    }
                },
                editable: true,
                eventResize: function(event) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    var title = event.title;
                    var id = event.id;
                    let baseUrl = "http://localhost:8080/admin/ubah_agenda";
                    $.ajax({
                        url: baseUrl,
                        type: "POST",
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            id: id
                        },
                        success: function() {
                            calendar.fullCalendar('refetchEvents');
                            alert('Agenda diubah');
                        }
                    })
                },

                eventClick: function(event) {
                    if (confirm("Apakah Anda Ingin Menghapus Agenda?")) {
                        var id = event.id;
                        let baseUrl = "http://localhost:8080/admin/hapus_agenda";
                        $.ajax({
                            url: baseUrl,
                            type: "POST",
                            data: {
                                id: id
                            },
                            success: function() {
                                calendar.fullCalendar('refetchEvents');
                                alert("Agenda diHapus");
                            }
                        })
                    }
                }
            });
        });
    </script>
    <script>
        const flashdata = $('.flash-data').data('flashdata');
        if (flashdata == 'Data Berhasil Di Tambahkan') {
            Swal.fire(
                'Berhasil!',
                flashdata,
                'success'
            );
        }
        if (flashdata == 'Data Berhasil Di Hapus') {
            Swal.fire(
                'Berhasil!',
                flashdata,
                'success'
            );
        }
        if (flashdata == 'Data Berhasil Di Ubah') {
            Swal.fire(
                'Berhasil!',
                flashdata,
                'success'
            );
        }
        if (flashdata == 'Anda Berhasil Login') {
            Swal.fire(
                'Berhasil!',
                flashdata,
                'success'
            );
        }
    </script>
    <script>
        $(function() {
            $("#tableAnggota").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

            $('.select2').select2()


            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
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
</body>

</html>