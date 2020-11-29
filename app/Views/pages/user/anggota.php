<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content'); ?>

<div class="container table-anggota">
    <div class="row">
        <section class="col-lg-12 connectedSortable">
            <div class="card">
                <div class="card-body">
                    <table id="tableAnggota" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Angkatan</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($anggota as $a) :
                            ?>
                                <tr>
                                    <td align="center">
                                        <?php
                                        if (empty($a['foto'])) {
                                            echo '<img src="/dist/img/user-icon.png" style="width: 80px; height: 100px; object-fit:cover; object-position:center;" class="image"/>';
                                        } else {
                                            echo '<img src="/dist/img/' . $a['foto'] . '" style="width: 80px; height: 100px; object-fit:cover; object-position:center;" class="image"/>';
                                        } ?>
                                    </td>
                                    <td><?= $a['nama']; ?></td>
                                    <td align="center"><?= $a['jenis_kelamin']; ?></td>
                                    <td align="center"><?= $a['angkatan']; ?></td>
                                    <td align="center"><?= $a['jabatan']; ?></td>
                                    <td align="center"><?= $a['status']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </section>
    </div>
</div>

<?= $this->endSection(); ?>