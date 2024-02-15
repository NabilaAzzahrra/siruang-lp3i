            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->

                    <div class="card  col-md-6">
                        <?php
                        foreach ($read as $r) {
                        }
                        ?>
                        <!-- /.card-header -->
                        <div class="card-header">
                            <a class="btn btn-primary btn-sm" href="#" onclick="return edit(`<?= $r->id_user ?>`,`<?= $r->username ?>`,`<?= $r->password ?>`,`<?= $r->nama ?>`)">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                        <div class="card-body">
                        <?php echo $this->session->flashdata('pesan'); ?>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username" value="<?= $r->username ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" value="<?= $r->password ?>" id="myInput" readonly>
                                <input type="checkbox" onclick="myFunction()"> Show Password
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?= $r->nama ?>" readonly>
                            </div>
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
                                <input type="hidden" name="id_user">
                                <span id="modal-body-update-or-create">
                                    <div class="form-group" hidden>
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" id="myInputt" placeholder="Password">
                                        <input type="checkbox" onclick="myFunctionn()"> Show Password
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Nama">
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
                function myFunction() {
                    var x = document.getElementById("myInput");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                }

                function myFunctionn() {
                    var x = document.getElementById("myInputt");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                }

                function edit(id_user, username, password, nama) {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Ubah Dosen');
                    $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-body-update-or-create').removeClass('d-none');
                    $('#modal-body-delete').addClass('d-none');
                    $('[name="id_user"]').val(id_user);
                    $('[name="username"]').val(username);
                    $('[name="password"]').val(password);
                    $('[name="nama"]').val(nama);
                    document.form.action = '<?= base_url('Admin/actedit_profile'); ?>';
                }
            </script>