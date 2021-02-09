<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php
    if (session()->getFlashdata('pesan')) :
    ?>
        <div class="flash-data" data-flashdata="<?= session()->getFlashdata('pesan'); ?>"></div>
    <?php endif ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-12 card direct-chat direct-chat-primary" id="box_chat">
                    <div class="card-header">
                        <h3 class="card-title">Forum Diskusi</h3>

                        <div class="card-tools">
                            <!-- <span data-toggle="tooltip" title="3 New Messages" class="badge badge-primary">3</span> -->
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <!-- <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                                <i class="fa fa-comments"></i>
                            </button> -->
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages" style="height: 70vh;">
                            <!-- Message. Default to the left -->
                            <?php
                            foreach ($chat as $c) {

                            ?>
                                <div class="direct-chat-msg <?= ($_SESSION['admin'][0]['id'] == $c['id_user']) ? 'right' : '' ?>">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-left"><?= $c['nama'] ?></span>
                                        <span class="direct-chat-timestamp float-right"><?= $c['jam'] . ' ' . $c['tanggal'] ?></span>
                                    </div>
                                    <img class="direct-chat-img" src="/dist/img/<?= $c['foto'] ?>" alt="message user image">
                                    <div class="direct-chat-text">
                                        <?= $c['pesan'] ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <!--/.direct-chat-messages-->

                        <!-- Contacts are loaded here -->
                        <!-- /.direct-chat-pane -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <form method="post" id="form-chat">
                            <?= csrf_field(); ?>
                            <div class="input-group">
                                <input type="text" name="message" id="message" placeholder="Type Message ..." class="form-control" required>
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary" id="kirim_chat">Send</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.content -->
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Kartu Anggota</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Selesai</button>
                        </div>
                    </div>
                </div>
            </div>

            <?= $this->endSection(); ?>