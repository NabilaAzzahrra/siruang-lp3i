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
                                        <th class="text-center">Tahun Akademik Sekarang</th>
                                        <th class="text-center">Semester</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($read as $k) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $k->tahun_akademik ?></td>
                                            <td class="text-center"><?= $k->semester ?></td>
                                            <td class="text-center">
                                                <a onclick="return ubah(`<?= $k->id_konfigurasi ?>`,`<?= $k->id_tahun_akademik ?>`,`<?= $k->semester ?>`)" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm " href="#"><i class="fas fa-edit"></i> Ubah</a>
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
                                <input type="hidden" name="id_konfigurasi">
                                <span id="modal-body-update-or-create">
                                    <div class="form-group">
                                        <label for="id_tahun_akademik">Tahun Akademik</label>
                                        <select class="form-control" id="id_tahun_akademik" name="id_tahun_akademik">
                                            <option value="" selected disabled>--Pilih Tahun Akademik--</option>
                                            <?php foreach ($tahun_akademik as $k) { ?>
                                                <option value="<?= $k->id_tahun_akademik ?>"><?= $k->tahun_akademik ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="smt">Semester</label>
                                        <select class="form-control" id="smt" name="smt">
                                            <option value="" selected disabled>--Pilih Semester--</option>
                                            <option value="Ganjil">Ganjil</option>
                                            <option value="Genap">Genap</option>
                                        </select>
                                    </div>
                                </span>
                                <span id="modal-body-delete">
                                    Yakin untuk menghapus <b id="name-delete"></b> dari tabel ini?
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
                function ubah(id_konfigurasi, tahun_akademik, smt) {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Ubah Konfigurasi');
                    $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-body-update-or-create').removeClass('d-none');
                    $('#modal-body-delete').addClass('d-none');
                    $('[name="id_konfigurasi"]').val(id_konfigurasi);
                    $('[name="id_tahun_akademik"]').val(tahun_akademik).trigger('change');
                    $('[name="smt"]').val(smt).trigger('change');
                    document.form.action = '<?= base_url('Admin/actedit_konfigurasi'); ?>';
                }
            </script>