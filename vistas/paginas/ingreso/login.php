<?php
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>
    <!-- Layout config Js -->
    <script src="vistas/assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="vistas/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="vistas/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="vistas/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="vistas/assets/css/custom.min.css" rel="stylesheet" type="text/css" />


    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
  

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center text-white-50">
                        <div class="text-center">
                                <a href="ingreso" class="d-inline-block auth-logo text-center">
                                    <img src="vistas/images/sistema/logo.png" alt="" height="100">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4"  >

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-default">Bienvenido a</h5>
                                    <h3 class="text-primary hv-investment">HV Investment Group!</h3>
                                </div>
                                <div class="p-2 mt-4">
                                    <form action="" method="post" class="needs-validation" novalidate>
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">E-Mail</label>
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email">
                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end">
                                                <a href="auth-pass-reset-basic.html" class="text-muted">Forgot password?</a>
                                            </div>
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" name="password" class="form-control pe-5" placeholder="Enter password" id="password-input">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit" name="btnLogin">Sign In</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center fs-5" style="color: white;">
                            <p class="mb-0">Don't have an account ? <a href="registro" class="fw-semibold  text-decoration-underline" style="color: white!important;"> Signup </a> </p>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>document.write(new Date().getFullYear())</script> HV Inversiones. 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="vistas/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vistas/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="vistas/assets/libs/node-waves/waves.min.js"></script>
    <script src="vistas/assets/libs/feather-icons/feather.min.js"></script>
    <script src="vistas/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="vistas/assets/js/plugins.js"></script>

    <!-- particles js -->
    <script src="vistas/assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="vistas/assets/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="vistas/assets/js/pages/password-addon.init.js"></script>
</body>

</html>


<?php 

$Login = new ControladorUsuarios();
$Login -> ctrLoginUsuario();

?>