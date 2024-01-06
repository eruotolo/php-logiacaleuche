<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; ?>

<head>

    <title><?php echo $titulo ?> | Registrar Nuevo Q:. H:.</title>

    <?php include 'layouts/head.php'; ?>

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <?php include 'layouts/head-style.php'; ?>

</head>

<?php include 'layouts/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Registro de Q:. Hermano</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="apps-contacts-list.php">Hermanos</a></li>
                                <li class="breadcrumb-item active">Registro de Q:. Hermano</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Formulario de Registro de Usuario</h4>
                            <p class="card-title-desc">Los campos con <code>*</code> son campos requeridos/obligatorios.</p>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Ingresar datos en los campos</h5>

                            <form class="needs-validation mt-4 pt-2" action="controller/usuario-new.php" method="post" enctype="multipart/form-data">
                                <div class="row mb-4">
                                    <label for="firstname" class="col-sm-3 col-form-label">Nombre</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="firstname" placeholder="Ingrese su nombre" required name="firstname" value="<?php echo $firstname; ?>">
                                        <span class="text-danger"><?php echo $firstname_err; ?></span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="lastname" class="col-sm-3 col-form-label">Apellido</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="lastname" placeholder="Ingrese su apellido" required name="lastname" value="<?php echo $lastname; ?>">
                                        <span class="text-danger"><?php echo $lastname_err; ?></span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="username" class="col-sm-3 col-form-label">Nombre de Usuario <br><i>Ej: Antonio Lopez, como: alopez</i></label>

                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="username" placeholder="Ingrese su nombre de usuario" required name="username" value="<?php echo $username; ?>">
                                        <span class="text-danger"><?php echo $username_err; ?></span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="useremail" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-5">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">@</span>
                                            <input type="email" class="form-control" id="useremail" placeholder="Ingrese su email" required name="useremail" value="<?php echo $useremail; ?>">
                                        </div>
                                        <span class="text-danger"><?php echo $useremail_err; ?></span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="category" class="col-sm-3 col-form-label">Tipo de usuario</label>
                                    <div class="col-sm-5">
                                        <select id="grado" class="form-select"  name="grado">
                                            <?php try {
                                                $sql = 'SELECT id, grado_Nombre FROM grado';
                                                foreach ($link->query($sql) as $rowc) {
                                                    if ($row['cat_Nombre']) {
                                                        $selected = 'selected="selected"';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                    ?>
                                                    <option <?= $selected ?> value="<?= $rowc['id'] ?>"><?= $rowc['grado_Nombre'] ?></option>
                                                    <?php
                                                }
                                            } catch (PDOException  $e) {
                                                echo "Error: " . $e;
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="userpassword" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-5">
                                        <input type="password" class="form-control" id="userpassword" placeholder="Ingresar password" required name="password" value="<?php echo $password; ?>">
                                        <span class="text-danger"><?php echo $password_err; ?></span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="confirm_password" class="col-sm-3 col-form-label">Confirmar Password</label>
                                    <div class="col-sm-5">
                                        <input type="password" class="form-control" id="confirm_password" placeholder="Confirmar password" name="confirm_password" value="<?php echo $confirm_password; ?>">
                                        <span class="text-danger"><?php echo $confirm_password_err; ?></span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="file" class="col-sm-3 col-form-label">Imagen de Perfil</label>
                                    <div class="col-sm-5">
                                        <input type="file" class="form-control" id="file" name="file">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <input type="hidden" name="category" class="form-control" value="3">
                                    <input type="hidden" name="estado" class="form-control" value="1">
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button class="btn btn-primary w-md" type="submit" name="crear">Registrar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- END layout-wrapper -->


<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- init js -->
<script src="assets/js/pages/datatable-pages.init.js"></script>
<!-- validation init -->
<script src="assets/js/pages/validation.init.js"></script>
<!-- password addon init -->
<script src="assets/js/pages/pass-addon.init.js"></script>

<script src="assets/js/app.js"></script>


</body>

