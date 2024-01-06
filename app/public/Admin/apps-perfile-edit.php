<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include ('layouts/config.php');?>


<!-- PARA TESTEAR -->
<head>

    <title><?php echo $titulo ?> | Editar Mi Perfil</title>

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
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Editar información Personal</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="apps-contacts-profile.php">Mi Perfil</a></li>
                                    <li class="breadcrumb-item active">Editar información Personal</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">ACTUALIZACIÓN INFORMACIÓN PERSONAL</h4>
                                <p class="card-title-desc">Los campos con <code>*</code> son los que puede actualizar, el resto de los campos solo el Secretario los puede modificar.</p>
                            </div>
                            <div class="card-body">
                                <!-- ACA COMIENZA EL FORM-->
                                <form action="controller/perfil-update.php" method="POST" enctype="multipart/form-data">
                                   <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['id'] ?> ">
                                    <div class="row">
                                        <div class="col-2 img-perfil">
                                            <img src="uploads/usuarios/<?php echo $_SESSION['image'] ?>"
                                                 alt="Imagen de Perfil" class="img-fluid rounded-circle d-block"><br>
                                            <input type="file" class="form-control" id="file" name="file" >
                                        </div>
                                        <div class="col-5 info-personal">
                                            <h3>Información Personal</h3>
                                            <div class="mb-3">
                                                <label for="username">Nombre de Usuario <code>*</code></label>
                                                <input type="text" name="username" class="form-control"
                                                       value="<?php echo $_SESSION['username'] ?>">
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="name">Nombre <code>*</code></label>
                                                        <input type="text" name="name" class="form-control"
                                                               value="<?php echo $_SESSION['name'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="lastname">Apellidos <code>*</code></label>
                                                        <input type="text" name="lastname" class="form-control"
                                                               value="<?php echo $_SESSION['lastname'] ?>" >
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="date_birthday">Fecha de nacimiento <code>*</code></label>
                                                        <input type="date" name="date_birthday" class="form-control"
                                                               value="<?php echo $_SESSION['date_birthday']; ?>"
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-3">
                                                        <label for="phone">Teléfono <code>*</code></label>
                                                        <input type="tel" name="phone" class="form-control"
                                                               value="<?php echo $_SESSION['phone'] ?>" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="useremail">Email <code>*</code></label>
                                                <input type="email" name="useremail" class="form-control"
                                                       value="<?php echo $_SESSION['useremail'] ?>" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="city">Ciudad <code>*</code></label>
                                                <input type="text" name="city" class="form-control"
                                                       value="<?php echo $_SESSION['city'] ?>"
                                                       >
                                            </div>
                                            <div class="mb-3">
                                                <label for="address">Dirección <code>*</code></label>
                                                <input type="text" name="address" class="form-control"
                                                       value="<?php echo $_SESSION['address'] ?>"
                                                       >
                                            </div>
                                            <div class="mb-3 info-personal">
                                            <button type="submit" name="update" class="btn btn-primary w-md">Actualizar</button>
                                            </div>
                                </form>
                                <!-- FINALIZA EL FORM-->
                                        </div>
                                        <div class="col-5 info-personal">
                                            <h3>Datos Masonicos</h3>
                                            <div class="mb-3">
                                                <label for="grado">Grado</label>
                                                <?php
                                                if ($_SESSION['grado'] == 1) {
                                                    ?>
                                                    <input type="grado" class="form-control" value="Aprendiz"
                                                           disabled>
                                                    <?php
                                                } elseif ($_SESSION['grado'] == 2) {
                                                    ?>
                                                    <input type="grado" class="form-control" value="Compañero"
                                                           disabled>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <input type="grado" class="form-control" value="Maestro"
                                                           disabled>
                                                    <?php
                                                }
                                                ?>

                                            </div>
                                            <div class="mb-3">
                                                <label for="oficialidad">Cargo en la Oficialidad</label>
                                                <?php
                                                if ($_SESSION['oficialidad'] == 1) {
                                                    ?>
                                                    <input type="oficial" class="form-control" value="Ninguno"
                                                           disabled>
                                                    <?php
                                                } elseif ($_SESSION['oficialidad'] == 2) {
                                                    ?>
                                                    <input type="oficial" class="form-control"
                                                           value="Venerable Maestro" disabled>
                                                    <?php
                                                } elseif ($_SESSION['oficialidad'] == 3) {
                                                    ?>
                                                    <input type="oficial" class="form-control"
                                                           value="Primer Vigilante" disabled>

                                                    <?php
                                                } elseif ($_SESSION['oficialidad'] == 4) {
                                                    ?>
                                                    <input type="oficial" class="form-control"
                                                           value="Segundo Vigilante" disabled>
                                                    <?php
                                                } elseif ($_SESSION['oficialidad'] == 5) {
                                                    ?>
                                                    <input type="oficial" class="form-control"
                                                           value="Orador" disabled>
                                                    <?php
                                                } elseif ($_SESSION['oficialidad'] == 6) {
                                                    ?>
                                                    <input type="oficial" class="form-control"
                                                           value="Secretario" disabled>
                                                    <?php
                                                } elseif ($_SESSION['oficialidad'] == 7) {
                                                    ?>
                                                    <input type="oficial" class="form-control"
                                                           value="Tesorero" disabled>
                                                    <?php
                                                } elseif ($_SESSION['oficialidad'] == 8) {
                                                    ?>
                                                    <input type="oficial" class="form-control"
                                                           value="Hospitalario" disabled>
                                                    <?php
                                                } elseif ($_SESSION['oficialidad'] == 9) {
                                                    ?>
                                                    <input type="oficial" class="form-control"
                                                           value="Maestro de Ceremonia" disabled>
                                                    <?php
                                                } elseif ($_SESSION['oficialidad'] == 10) {
                                                    ?>
                                                    <input type="oficial" class="form-control"
                                                           value="Maestro Experto" disabled>
                                                    <?php
                                                } elseif ($_SESSION['oficialidad'] == 11) {
                                                    ?>
                                                    <input type="oficial" class="form-control"
                                                           value="Guarda Templo" disabled>
                                                    <?php
                                                } elseif ($_SESSION['oficialidad'] == 12) {
                                                    ?>
                                                    <input type="oficial" class="form-control"
                                                           value="Maestro de Banquetes" disabled>
                                                    <?php
                                                } elseif ($_SESSION['oficialidad'] == 13) {
                                                    ?>
                                                    <input type="oficial" class="form-control"
                                                           value="Maestro de Armonía" disabled>
                                                    <?php
                                                }
                                                ?>

                                            </div>

                                            <div class="mb-3">
                                                <label for="date_initiation">Fecha de Iniciación</label>
                                                <input type="date" name="date_initiation" class="form-control"
                                                       value="<?php echo $_SESSION['date_initiation']; ?>" disabled>
                                            </div>
                                            <?php
                                            if ($_SESSION['grado'] !== 1){
                                                ?>
                                            <div class="mb-3">
                                                <label for="date_salary">Fecha de Aumento de Salario</label>
                                                <input type="date" name="date_salary" class="form-control"
                                                       value="<?php echo $_SESSION['date_salary']; ?>" disabled>
                                            </div>
                                            <?php
                                                }
                                            ?>

                                            <?php
                                            if ($_SESSION['grado'] == 3){
                                            ?>
                                            <div class="mb-3">
                                                <label for="date_exalted">Fecha de Exaltación</label>
                                                <input type="date" name="date_exalted" class="form-control"
                                                       value="<?php echo $_SESSION['date_exalted']; ?>" disabled>
                                            </div>
                                            <?php
                                                }
                                            ?>

                                        </div>

                                    </div>


                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>

        <?php include 'layouts/footer.php'; ?>
    </div>

    <!-- ============================================================== -->
    <!-- End right Content here -->
    <!-- ============================================================== -->

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

<script src="assets/js/app.js"></script>



</body>

</html>
