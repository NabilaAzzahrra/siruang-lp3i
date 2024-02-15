            <!-- jQuery -->
            <script src="<?= base_url('assets/templates/') ?>plugins/jquery/jquery.min.js"></script>
            <!-- jQuery UI 1.11.4 -->
            <script src="<?= base_url('assets/templates/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
            <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
            <script>
                $.widget.bridge('uibutton', $.ui.button)
            </script>
            <!-- Bootstrap 4 -->
            <script src="<?= base_url('assets/templates/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- ChartJS -->
            <script src="<?= base_url('assets/templates/') ?>plugins/chart.js/Chart.min.js"></script>
            <!-- Sparkline -->
            <script src="<?= base_url('assets/templates/') ?>plugins/sparklines/sparkline.js"></script>
            <!-- JQVMap -->
            <script src="<?= base_url('assets/templates/') ?>plugins/jqvmap/jquery.vmap.min.js"></script>
            <script src="<?= base_url('assets/templates/') ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
            <!-- jQuery Knob Chart -->
            <script src="<?= base_url('assets/templates/') ?>plugins/jquery-knob/jquery.knob.min.js"></script>
            <!-- daterangepicker -->
            <script src="<?= base_url('assets/templates/') ?>plugins/moment/moment.min.js"></script>
            <script src="<?= base_url('assets/templates/') ?>plugins/daterangepicker/daterangepicker.js"></script>
            <!-- Tempusdominus Bootstrap 4 -->
            <script src="<?= base_url('assets/templates/') ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
            <!-- Summernote -->
            <script src="<?= base_url('assets/templates/') ?>plugins/summernote/summernote-bs4.min.js"></script>
            <!-- overlayScrollbars -->
            <script src="<?= base_url('assets/templates/') ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
            <!-- AdminLTE App -->
            <!-- <script src="<?= base_url('assets/templates/') ?>dist/js/adminlte.js"></script> -->
            <!-- AdminLTE for demo purposes -->
            <!-- <script src="<?= base_url('assets/templates/') ?>dist/js/demo.js"></script> -->
            <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
            <script src="<?= base_url('assets/templates/') ?>dist/js/pages/dashboard.js"></script>

            <!-- jQuery -->
            <script src="<?= base_url('assets/templates/') ?>plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap 4 -->
            <script src="<?= base_url('assets/templates/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- DataTables  & Plugins -->
            <script src="<?= base_url('assets/templates/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="<?= base_url('assets/templates/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
            <script src="<?= base_url('assets/templates/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
            <script src="<?= base_url('assets/templates/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
            <script src="<?= base_url('assets/templates/') ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
            <script src="<?= base_url('assets/templates/') ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
            <script src="<?= base_url('assets/templates/') ?>plugins/jszip/jszip.min.js"></script>
            <script src="<?= base_url('assets/templates/') ?>plugins/pdfmake/pdfmake.min.js"></script>
            <script src="<?= base_url('assets/templates/') ?>plugins/pdfmake/vfs_fonts.js"></script>
            <script src="<?= base_url('assets/templates/') ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
            <script src="<?= base_url('assets/templates/') ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
            <script src="<?= base_url('assets/templates/') ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
            <!-- AdminLTE App -->
            <script src="<?= base_url('assets/templates/') ?>dist/js/adminlte.min.js"></script>
            <!-- AdminLTE for demo purposes -->
            <!-- <script src="<?= base_url('assets/templates/') ?>dist/js/demo.js"></script> -->
            <!-- Page specific script -->
            <!-- Select2 -->
            <script src="<?= base_url('assets/templates/') ?>plugins/select2/js/select2.full.min.js"></script>
            <script src="<?= base_url('assets/templates'); ?>/plugins/select2/js/select2.full.min.js"></script>
            <script src="<?= base_url('assets/templates'); ?>/plugins/select2/js/i18n/id.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

            <script>
                $(function() {
                    //Initialize Select2 Elements
                    $('.select2').select2()
                    //Initialize Select2 Elements
                    $('.select2bs4').select2({
                        theme: 'bootstrap4'
                    })
                    $('.select2').select2({
                        dropdownParent: $('#Modal')
                    });
                    $("#example1").DataTable({
                        "responsive": true,
                        "lengthChange": false,
                        "autoWidth": false,
                        "lengthChange": true,
                        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                    $('#example2').DataTable({
                        "paging": true,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "responsive": true,
                    });
                    $('#example3').DataTable({
                        "paging": false,
                        "lengthChange": false,
                        "searching": false,
                        "ordering": false,
                        "info": false,
                        "autoWidth": false,
                        "responsive": true,
                    });
                    $('#example4').DataTable({
                        "paging": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "responsive": true,
                    });
                    $('#example5').DataTable({
                        "paging": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "responsive": true,
                    });
                    $("#example6").DataTable({
                        "responsive": true,
                        "lengthChange": false,
                        "autoWidth": false,
                        "lengthChange": true,
                    });
                });
            </script>
            <script>
                $(function() {
                    $('#logout').click(function() {
                        $('#ModalLogout').modal('show');
                        $('.modal-dialog').removeClass('modal-lg');
                    });
                });
            </script>
            </body>