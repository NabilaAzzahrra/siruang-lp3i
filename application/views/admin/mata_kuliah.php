            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <?php echo $this->session->flashdata('pesan'); ?>
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-primary btn-sm" onclick="return tambah()" href="#">
                                <i class="fas fa-plus"></i> Tambah
                            </a>
                            <!-- <h3 class="card-title">DataTable with default features</h3> -->
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;" class="text-center">No</th>
                                        <th class="text-center">Mata Kuliah</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($read as $r) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $r->mata_kuliah ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a class="btn btn-success btn-sm" onclick="return edit(`<?= $r->id_mata_kuliah ?>`,`<?= $r->mata_kuliah ?>`)" href="#">
                                                        <i class="fas fa-edit"></i> Ubah
                                                    </a>
                                                    <a class="btn btn-danger btn-sm" onclick="return hapus(`<?= $r->id_mata_kuliah ?>`,`<?= $r->mata_kuliah ?>`)" href="#">
                                                        <i class="fas fa-trash"></i> Hapus
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
                                <input type="hidden" name="id_mata_kuliah">
                                <span id="modal-body-update-or-create">
                                    <div class="form-group">
                                        <label>Mata Kuliah</label>
                                        <input type="text" name="mata_kuliah" class="form-control" placeholder="Mata Kuliah">
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
                function tambah() {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Tambah Mata Kuliah');
                    $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-body-update-or-create').removeClass('d-none');
                    $('#modal-body-delete').addClass('d-none');
                    $('[name="id_mata_kuliah"]').val();
                    $('[name="mata_kuliah"]').val();
                    document.form.action = '<?= base_url('Admin/actadd_mata_kuliah'); ?>';
                }


                function edit(id_mata_kuliah, mata_kuliah) {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Ubah Mata Kuliah');
                    $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-body-update-or-create').removeClass('d-none');
                    $('#modal-body-delete').addClass('d-none');
                    $('[name="id_mata_kuliah"]').val(id_mata_kuliah);
                    $('[name="mata_kuliah"]').val(mata_kuliah);
                    document.form.action = '<?= base_url('Admin/actedit_mata_kuliah'); ?>';
                }

                function hapus(id_mata_kuliah, mata_kuliah) {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Hapus Mata Kuliah');
                    $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-body-update-or-create').addClass('d-none');
                    $('#modal-body-delete').removeClass('d-none');
                    $('[name="id_mata_kuliah"]').val(id_mata_kuliah);
                    $('#name-delete').html(mata_kuliah);
                    document.form.action = '<?= base_url('Admin/acthapus_mata_kuliah'); ?>';
                }
            </script>