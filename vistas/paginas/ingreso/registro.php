
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
                        <div class="col-xl-12">
                            <div class="card" >
                                <div class="card-header">
                                   
                                <div class="text-center mt-2">
                                    <h5 class="text-default">Bienvenido a</h5>
                                    <h3 class="text-primary">HV Investment Group!</h3>
                                </div>
                                </div><!-- end card header -->
                                <div class="card-body form-steps">
                                    <form action="#">
                                        <div class="text-center pt-3 pb-4 mb-1">
                                            <h5>Signup Your Account</h5>
                                        </div>
                                        <div id="custom-progress-bar" class="progress-nav mb-4">
                                            <div class="progress" style="height: 1px;">
                                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>

                                            <ul class="nav nav-pills progress-bar-tab custom-nav" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link rounded-pill active" data-progressbar="custom-progress-bar" id="pills-gen-info-tab" data-bs-toggle="pill" data-bs-target="#pills-gen-info" type="button" role="tab" aria-controls="pills-gen-info" aria-selected="true">1</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link rounded-pill" data-progressbar="custom-progress-bar" id="pills-info-desc-tab" data-bs-toggle="pill" data-bs-target="#pills-info-desc" type="button" role="tab" aria-controls="pills-info-desc" aria-selected="false">2</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link rounded-pill" data-progressbar="custom-progress-bar" id="pills-success-tab" data-bs-toggle="pill" data-bs-target="#pills-success" type="button" role="tab" aria-controls="pills-success" aria-selected="false">3</button>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="pills-gen-info" role="tabpanel" aria-labelledby="pills-gen-info-tab">
                                                <div>
                                                    <div class="mb-4">
                                                        <div>
                                                            <h5 class="mb-1">General Information</h5>
                                                            <p class="text-muted">Fill all Information as below</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="gen-info-email-input">Email</label>
                                                                <input type="text" class="form-control" id="gen-info-email-input" placeholder="Enter Email">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="gen-info-username-input">User Name</label>
                                                                <input type="text" class="form-control" id="gen-info-username-input" placeholder="Enter User Name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="gen-info-password-input">Password</label>
                                                        <input type="password" class="form-control" id="gen-info-password-input" placeholder="Enter Password">
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-start gap-3 mt-4">
                                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="pills-info-desc-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go to more info</button>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->

                                            <div class="tab-pane fade" id="pills-info-desc" role="tabpanel" aria-labelledby="pills-info-desc-tab">
                                                <div>
                                                    <div class="text-center">
                                                        <div class="profile-user position-relative d-inline-block mx-auto mb-2">
                                                            <img src="assets/images/users/user-dummy-img.jpg" class="rounded-circle avatar-lg img-thumbnail user-profile-image" alt="user-profile-image">
                                                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                                <input id="profile-img-file-input" type="file" class="profile-img-file-input" accept="image/png, image/jpeg">
                                                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                                        <i class="ri-camera-fill"></i>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <h5 class="fs-14">Add Image</h5>

                                                    </div>
                                                    <div>
                                                        <label class="form-label" for="gen-info-description-input">Description</label>
                                                        <textarea class="form-control" placeholder="Enter Description" id="gen-info-description-input" rows="2"></textarea>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-start gap-3 mt-4">
                                                    <button type="button" class="btn btn-link text-decoration-none btn-label previestab" data-previous="pills-gen-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to General</button>
                                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab" data-nexttab="pills-success-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->

                                            <div class="tab-pane fade" id="pills-success" role="tabpanel" aria-labelledby="pills-success-tab">
                                                <div>
                                                    <div class="text-center">

                                                        <div class="mb-4">
                                                            <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px"></lord-icon>
                                                        </div>
                                                        <h5>Well Done !</h5>
                                                        <p class="text-muted">You have Successfully Signed Up</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->
                                        </div>
                                        <!-- end tab content -->
                                    </form>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                    <div class="mt-4 text-center  fs-5" style="color: white;">
                            <p class="mb-0">Already have an account ? <a href="login" class="fw-semibold text-decoration-underline"  style="color: white;"> Signin </a> </p>
                        </div>
            </div>
                <!-- end row -->
         
        </div>
            <!-- end container -->
     

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
    
    <!-- form wizard init -->
    <script src="vistas/assets/js/pages/form-wizard.init.js"></script>
</body>

</html>