<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ubah Data Artikel</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-lightblue">
                            Data Artikel
                        </div>
                        <div class="card-body">
                            <form action="/admin/save_edit_artikel/<?= $artikel['id']; ?>" method="POST" enctype="multipart/form-data">
                                <label>Judul Artikel</label>
                                <input type="text" name="judul" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" placeholder="Masukan Judul Artikel" value="<?= $artikel['judul'] ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('judul'); ?>
                                </div>
                                <label class="mt-2">Cover</label>
                                <div class="custom-file">
                                    <input type="hidden" name="fotoLama" value="<?= $artikel['foto'] ?>">
                                    <input type="file" name="foto" class="custom-file-input <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="imgInp">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('foto'); ?>
                                    </div>
                                    <label class="custom-file-label" for="exampleInputFile">Pilih Foto</label>
                                </div>
                                <label class="mt-2">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" placeholder="tanggal" value="<?= $artikel['tanggal']; ?>">
                                <br><br>
                                <div class="card card-outline card-info">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <b>Isi Artikel</b>
                                        </h3>
                                        <!-- tools box -->
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                <i class="fa fa-minus"></i></button>
                                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                                <i class="fa fa-times"></i></button>
                                        </div>
                                        <!-- /. tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body pad">
                                        <div class="mb-3">
                                            <textarea name="isi" class="textarea <?= ($validation->hasError('isi')) ? 'is-invalid' : ''; ?>" placeholder="Place some text here" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $artikel['isi']; ?></textarea>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('isi'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    </input>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i> Ubah Data</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <?= $this->endSection(); ?>