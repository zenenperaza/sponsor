<style>
    body { 
        background: linear-gradient(-45deg, #405189 50%, #0ab39c)
    }
</style>
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
                
                <div class="row justify-content-center mt-4">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="text-center mt-2">
                                    <h5 class="text-default">Bienvenido a</h5>
                                    <h3 class="text-primary">HV Investment Group!</h3>
                                </div>
                            </div>
                            
                            <div class="card-body form-steps">
                                <form  method="POST" enctype="multipart/form-data" id="formRegistro" class="needs-validation" novalidate>
                                    <div class="text-center pt-3 pb-4 mb-1">
                                        <h5>Registro de Cuenta</h5>
                                    </div>
                                    
                                    <div id="custom-progress-bar" class="progress-nav mb-4">
                                        <div class="progress" style="height: 1px;">
                                            <div class="progress-bar" role="progressbar" style="width: 0%;"></div>
                                        </div>
                                        <ul class="nav nav-pills progress-bar-tab custom-nav" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link rounded-pill active" data-progressbar="custom-progress-bar" id="pills-gen-info-tab" data-bs-toggle="pill" data-bs-target="#pills-gen-info" type="button">1</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link rounded-pill" data-progressbar="custom-progress-bar" id="pills-info-desc-tab" data-bs-toggle="pill" data-bs-target="#pills-info-desc" type="button">2</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link rounded-pill" data-progressbar="custom-progress-bar" id="pills-success-tab" data-bs-toggle="pill" data-bs-target="#pills-success" type="button">3</button>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="tab-content">
                                        <!-- Paso 1: Información Básica -->
                                        <div class="tab-pane fade show active" id="pills-gen-info" role="tabpanel" aria-labelledby="pills-gen-info-tab">
                                            <div class="mb-4">
                                                <h5 class="mb-1">Información Personal</h5>
                                                <p class="text-muted">Completa tus datos básicos</p>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nombre <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="nombre" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Apellido <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="apellido" required>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" name="email" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Confirmar Email <span class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" name="email2" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                
                                            <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Contraseña <span class="text-danger">*</span></label>
                                                        <input type="password" class="form-control" name="password" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Confirmar Contraseña <span class="text-danger">*</span></label>
                                                        <input type="password" class="form-control" name="password2" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">ID de Patrocinador</label>
                                                        <input type="text" class="form-control" name="id_patrocinador">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">  
                                                    <div class="mb-3">
                                                        <label class="form-label">Tu ID</label>
                                                        <input type="text" class="form-control" name="id_usuario" value="<?php echo htmlspecialchars(ControladorUsuarios::codigoPatrocinadorUnico()); ?>" required>
                                                    </div>
                                                </div>

                                            </div>
                                            
                                        
                                            
                                            <div class="d-flex align-items-start gap-3 mt-4">
                                                <button type="button" class="btn btn-success btn-label right ms-auto nexttab" data-nexttab="pills-info-desc-tab">
                                                    <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Siguiente
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Paso 2: Información Adicional -->
                                        <div class="tab-pane fade" id="pills-info-desc" role="tabpanel" aria-labelledby="pills-info-desc-tab">
                                            <div class="mb-4">
                                                <h5 class="mb-1">Información Adicional</h5>
                                                <p class="text-muted">Completa tus datos adicionales</p>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Teléfono</label>
                                                        <input type="tel" class="form-control" name="telefono">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">País</label>
                                                        <select class="form-select" name="pais">
                                                            <option value="">Seleccionar...</option>
                                                            <option>Argentina</option>
                                                            <option>México</option>
                                                            <option>España</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Ciudad</label>
                                                        <input type="text" class="form-control" name="ciudad">
                                                    </div>
                                                </div>
                                            </div>
                                                                                
                                            <div class="d-flex align-items-start gap-3 mt-4">
                                                <button type="button" class="btn btn-link text-decoration-none btn-label previestab" data-previous="pills-gen-info-tab">
                                                    <i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Volver
                                                </button>
                                                <button type="submit" name="btnRegistrarUsuario" class="btn btn-success btn-label right ms-auto nexttab" data-nexttab="pills-success-tab">
                                                    <i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Enviar
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Paso 3: Confirmación -->
                                        <div class="tab-pane fade" id="pills-success" role="tabpanel" aria-labelledby="pills-success-tab">
                                            <div class="text-center py-5">
                                                <div class="mb-4">
                                                    <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" 
                                                            trigger="loop" 
                                                            colors="primary:#0ab39c,secondary:#405189" 
                                                            style="width:120px;height:120px">
                                                    </lord-icon>
                                                </div>
                                                <h5>¡Registro Exitoso!</h5>
                                                <p class="text-muted">Tu cuenta ha sido creada correctamente</p>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 text-center fs-5" style="color: white;">
                    <p class="mb-0">¿Ya tienes una cuenta? <a href="login" class="fw-semibold text-decoration-underline" style="color: white;">Iniciar Sesión</a></p>
                </div>
            </div>
        </div>

        <!-- Footer -->
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
    </div>

<!-- Scripts -->
<script src="vistas/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vistas/assets/libs/simplebar/simplebar.min.js"></script>
<script src="vistas/assets/libs/node-waves/waves.min.js"></script>
<script src="vistas/assets/libs/feather-icons/feather.min.js"></script>
<script src="vistas/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
<script src="vistas/assets/js/plugins.js"></script>
<script src="vistas/assets/js/pages/form-wizard.init.js"></script>
<script src="vistas/assets/js/ingreso.js"></script>
<!-- Sweet Alerts js -->
<script src="vistas/assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->
<script src="vistas/assets/js/pages/sweetalerts.init.js"></script>

<script>

</script>

<?php 

$registro = new ControladorUsuarios();
$registro -> ctrRegistroUsuario();

?>