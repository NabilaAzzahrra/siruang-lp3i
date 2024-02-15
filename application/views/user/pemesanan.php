<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <?php echo $this->session->flashdata('pesan'); ?>
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 20px;" class="text-center">No</th>
                            <th>Ruang</th>
                            <th>Kelas</th>
                            <th>Mata Kuliah</th>
                            <th>Dosen</th>
                            <th>Tanggal Pakai</th>
                            <th>Hari</th>
                            <th>Mulai Pakai</th>
                            <th>Selesai Pakai</th>
                            <th>Sesi</th>
                            <th>Status</th>
                            <th>Verifikasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($read as $r) {
                            if ($r->s_verifikasi == "sudah verifikasi") {
                                $verifikasi = "Sudah";
                            } else if ($r->s_verifikasi == "belum verifikasi") {
                                $verifikasi = "Belum";
                            } else {
                                $verifikasi = "Ditolak";
                            }

                            $day = "";
                            if ($r->hari == "Sunday") {
                                $day = "Minggu";
                            } else if ($r->hari == "Monday") {
                                $day = "Senin";
                            } else if ($r->hari == "Tuesday") {
                                $day = "Selasa";
                            } else if ($r->hari == "Wednesday") {
                                $day = "Rabu";
                            } else if ($r->hari == "Thursday") {
                                $day = "Kamis";
                            } else if ($r->hari == "Friday") {
                                $day = "Jumat";
                            } else if ($r->hari == "Saturday") {
                                $day = "Sabtu";
                            }
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $r->ruang ?></td>
                                <td><?= $r->kelas ?></td>
                                <td><?= $r->mata_kuliah ?></td>
                                <td><?= $r->nama_dosen ?></td>
                                <td><?= $r->tgl_pakai ?></td>
                                <td><?= $day ?></td>
                                <td><?= date('H:i', strtotime($r->dari_pukul)) ?></td>
                                <td><?= date('H:i', strtotime($r->sampai_pukul)) ?></td>
                                <td><?= $r->sesi ?></td>
                                <td><?= $r->status ?></td>
                                <td><?= $verifikasi ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a class="btn btn-primary btn-sm" href="#" onclick="return edit(`<?= $r->id_b_ruang ?>`, `<?= $r->id_kelas ?>`, `<?= $r->id_mata_kuliah ?>`, `<?= $r->id_dosen ?>`)" title="ubah">
                                            <i class="fas fa-edit"></i> Ubah
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="#" onclick="return hapus(`<?= $r->id_b_ruang ?>`, `<?= $r->mata_kuliah ?>`)" title="batalkan">
                                            <i class="fas fa-times"></i> Hapus
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Ubah dan Tambah -->
<form name="form" action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
    <div id="Modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modal-header" class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-d-none="true">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_b_ruang">
                    <span id="modal-body-update-or-create">
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="id_kelas" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Kelas">
                                <option value="">--PILIH--</option>
                                <?php foreach ($kelas as $p) { ?>
                                    <option value="<?= $p->id_kelas ?>"><?= $p->kelas ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Kuliah</label>
                            <select name="id_mata_kuliah" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Mata Kuliah">
                                <option value="">--PILIH--</option>
                                <?php foreach ($matkul as $p) { ?>
                                    <option value="<?= $p->id_mata_kuliah ?>"><?= $p->mata_kuliah ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dosen</label>
                            <select name="id_dosen" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Dosen">
                                <option value="">--PILIH--</option>
                                <?php foreach ($dosen as $p) { ?>
                                    <option value="<?= $p->id_dosen ?>"><?= $p->nama_dosen ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </span>
                    <span id="modal-body-s_verifikasi">
                        Yakin untuk verifikasi <b id="name-delete"></b> dari tabel ini?
                    </span>
                    <span id="modal-body-delete">
                        Yakin untuk menolak <b id="name-tolak"></b> dari tabel ini?
                    </span>
                    <span id="modal-body-hapus">
                        Yakin untuk membatalkan pemesanan ruangan untuk mata kuliah <b id="name-hapus"></b> ?
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-block" id="modal-button" style="color: #fff;">Simpan</button>
                    <button type="button" class="btn btn-block" data-dismiss="modal" id="batal" aria-d-none="true" style="color: #fff;">Batal</button>
                </div>
            </div>
        </div>
    </div>
</form>

</html>

<script>
    function s_verifikasi(id_b_ruang, mata_kuliah) {
        $('#Modal').modal('show');
        $('#modal-header').html('Verifikasi Pemesanan');
        $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
        $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
        $('#modal-body-update-or-create').addClass('d-none');
        $('#modal-body-s_verifikasi').removeClass('d-none');
        $('#modal-body-delete').addClass('d-none');
        $('#modal-body-hapus').addClass('d-none');
        $('[name="id_b_ruang"]').val(id_b_ruang);
        $('#name-delete').html(mata_kuliah);
        document.form.action = '<?= base_url('User/s_verifikasi'); ?>';
    }

    function tolak(id_b_ruang, mata_kuliah) {
        $('#Modal').modal('show');
        $('#modal-header').html('Tolak Pemesanan');
        $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
        $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
        $('#modal-body-update-or-create').addClass('d-none');
        $('#modal-body-s_verifikasi').addClass('d-none');
        $('#modal-body-delete').removeClass('d-none');
        $('#modal-body-hapus').addClass('d-none');
        $('[name="id_b_ruang"]').val(id_b_ruang);
        $('#name-tolak').html(mata_kuliah);
        document.form.action = '<?= base_url('User/tolak'); ?>';
    }

    function edit(id_b_ruang, id_kelas, id_mata_kuliah, id_dosen) {
        $('#Modal').modal('show');
        $('#modal-header').html('Ubah Pemesanan');
        $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
        $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
        $('#modal-body-update-or-create').removeClass('d-none');
        $('#modal-body-s_verifikasi').addClass('d-none');
        $('#modal-body-delete').addClass('d-none');
        $('#modal-body-hapus').addClass('d-none');
        $('[name="id_b_ruang"]').val(id_b_ruang);
        $('[name="id_kelas"]').val(id_kelas).trigger('change');
        $('[name="id_mata_kuliah"]').val(id_mata_kuliah).trigger('change');
        $('[name="id_dosen"]').val(id_dosen).trigger('change');
        document.form.action = '<?= base_url('User/actedit_pemesanan'); ?>';
    }

    function hapus(id_b_ruang, mata_kuliah) {
        $('#Modal').modal('show');
        $('#modal-header').html('Batalkan Pemesanan');
        $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
        $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
        $('#modal-body-update-or-create').addClass('d-none');
        $('#modal-body-s_verifikasi').addClass('d-none');
        $('#modal-body-delete').addClass('d-none');
        $('#modal-body-hapus').removeClass('d-none');
        $('[name="id_b_ruang"]').val(id_b_ruang);
        $('#name-hapus').html(mata_kuliah);
        document.form.action = '<?= base_url('User/acthapus_pemesanan'); ?>';
    }
</script>
<script type="text/javascript">
    function bln() {
        var tes = document.getElementById("sts").value;
        document.getElementById("isi_bulan").value = tes;
    }

    function ver() {
        var tes = document.getElementById("verifikasi").value;
        document.getElementById("isi_bulan").value = tes;
    }

    function dr() {
        var tes = document.getElementById("dari").value;
        document.getElementById("isi_bulan").value = tes;
    }

    function sm() {
        var tes = document.getElementById("sampai").value;
        document.getElementById("isi_bulan").value = tes;
    }
</script>