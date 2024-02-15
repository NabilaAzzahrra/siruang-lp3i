<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title> Login | SIRUANG</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="https://plb.ac.id/new/wp-content/uploads/2022/01/logo-Politeknik-LP3I.png" rel="icon">
    <link href="https://plb.ac.id/new/wp-content/uploads/2022/01/logo-Politeknik-LP3I.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>assets/templates/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/templates/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/templates/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/templates/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/templates/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/templates/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/templates/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url() ?>assets/templates/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body style="background-color:#fff;">

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">

                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3" style="border: 1px solid grey;">

                                <div class="card-body">

                                    <div class="pt-4 pb-2 text-center">
                                        <img src="<?= base_url('assets/templates') ?>/dist/img/logo-lp3i-warna.png" width="70%" style="margin-bottom: 15px;">
                                        <div class="text-center mt-4 name">
                                            <h3> <b>SIRUANG</b> </h3>
                                        </div>
                                    </div>
                                    <form class="row g-3 needs-validation" novalidate action="<?= base_url('Auth/login'); ?>" method="post">

                                        <?php echo $this->session->flashdata('pesan'); ?>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">

                                                <input type="text" name="username" class="form-control" id="yourUsername" required autocomplete="off">
                                                <div class="invalid-feedback">Masukkan username anda!</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="passwordInput" required>
                                            <div class="invalid-feedback">Masukkan password anda!</div>
                                        </div>
                                        <div class="col-12">
                                            <input type="checkbox" id="showPasswordCheckbox" onchange="togglePasswordVisibility()">
                                            <label for="showPasswordCheckbox">Show Password</label>
                                        </div>
                                        <div>
                                            <div class="col-12">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <button class="btn btn-primary w-100" type="submit">Masuk</button>
                                        </div>

                                    </form>

                                </div>
                            </div>

                            <div class="credits" >
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                SIRUANG | <a href="http://politekniklp3i-tasikmalaya.ac.id/">Politeknik LP3I Kampus Tasikmalaya</a>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url() ?>assets/templates/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url() ?>assets/templates/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/templates/vendor/chart.js/chart.min.js"></script>
    <script src="<?= base_url() ?>assets/templates/vendor/echarts/echarts.min.js"></script>
    <script src="<?= base_url() ?>assets/templates/vendor/quill/quill.min.js"></script>
    <script src="<?= base_url() ?>assets/templates/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url() ?>assets/templates/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url() ?>assets/templates/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url() ?>assets/templates/backend/js/main.js"></script>
    <script>
        function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))

                return false;
            return true;
        }

        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("passwordInput");
            var showPasswordCheckbox = document.getElementById("showPasswordCheckbox");

            if (showPasswordCheckbox.checked) {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>

</body>

</html>