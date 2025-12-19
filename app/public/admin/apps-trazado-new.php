<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'; ?>

<head>

    <title><?php echo $titulo ?> | Nuevo Trazado</title>

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
                        <h4 class="mb-sm-0 font-size-18">Registro de Nuevo Trazado</h4>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Formulario de Registro de Nuevo Trazado</h4>
                            <p class="card-title-desc">Los campos <code>*</code> son requeridos.</p>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation mt-4 pt-2" action="controller/trazado-new.php" method="post" enctype="multipart/form-data">

                                <div class="row mb-4">
                                    <label for="name_Trazado" class="col-sm-3 col-form-label">Título del Trazados <code>*</code></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="name_Trazado" id="name_Trazado" required>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="file_name" class="col-sm-3 col-form-label">Seleccionar Archivo (pdf) <code>*</code></label>
                                    <div class="col-sm-5">
                                        <input type="file" class="form-control" name="file_name" id="file_name" accept="application/pdf" required>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="autor_Trazado" class="col-sm-3 col-form-label">Autor del Trazado<code>*</code></label>
                                    <div class="col-sm-5">
                                        <select name="autor_Trazado" id="autor_Trazado" class="form-select">
                                            <?php try {
                                                $sql = 'SELECT id, name, lastname FROM users';
                                                foreach ($link->query($sql) as $rowc) {
                                                    if ($row['name']) {
                                                        $selected = 'selected="selected"';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                    ?>
                                                    <option <?= $selected ?> value="<?= $rowc['id'] ?>"><?= $rowc['name'] ?> <?= $rowc['lastname'] ?></option>
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
                                    <label for="grado_Trazado" class="col-sm-3 col-form-label">Grado del Trazado<code>*</code></label>
                                    <div class="col-sm-5">
                                        <select name="grado_Trazado" id="grado_Trazado" class="form-select">
                                            <?php try {
                                                $sql = 'SELECT id, grado_Nombre FROM grado';
                                                foreach ($link->query($sql) as $rowc) {
                                                    if ($row['grado_Nombre']) {
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
                                    <label for="fecha_Trazado" class="col-sm-3 col-form-label">Fecha del Trazado <code>*</code></label>
                                    <div class="col-sm-5">
                                        <input type="date" class="form-control" name="fecha_Trazado" id="fecha_Trazado" required>
                                    </div>
                                </div>

                                <div class="row mb-4 justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button class="btn btn-primary w-md" type="submit" name="crear">Subir</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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
<!-- validation init -->
<script src="assets/js/pages/validation.init.js"></script>

<script src="assets/js/app.js"></script>


</body>
