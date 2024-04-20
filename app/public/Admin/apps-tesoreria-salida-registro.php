<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include ('layouts/config.php');?>

<head>

    <title><?php echo $titulo ?> | Registro Entrada de Dinero</title>

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
                        <h4 class="mb-sm-0 font-size-18">Registro de Egreso de Dinero</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="apps-tesoreria-salida.php">Registro de Egreso de Dinero</a></li>
                                <li class="breadcrumb-item active">Registro</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Formulario de Registro de Egreso de Dinero</h4>
                            <p class="card-title-desc">Los campos con <code>*</code> son campos requeridos/obligatorios.</p>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Ingresar datos en los campos</h5>

                            <form action="controller/registro-salida.php" class="needs-validation mt-4 pt-2" method="post" enctype="multipart/form-data">

                                <div class="row mb-4">
                                    <label for="id_User" class="col-sm-3 col-form-label">Nombre del QH:.</label>
                                    <div class="col-sm-5">
                                        <select name="id_User" id="id_User" class="form-select">
                                            <?php try {
                                                $sql = 'SELECT id, name, lastname from users';
                                                foreach ($link->query($sql) as $rowc) {
                                                    if ($row['id_User']) {
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
                                    <label for="salida_Mes" class="col-sm-3 col-form-label">Mes de Egreso</label>
                                    <div class="col-sm-5">
                                        <select name="salida_Mes" id="salida_Mes" class="form-select">
                                            <option value="01 - Enero">Enero</option>
                                            <option value="02 - Febrero">Febrero</option>
                                            <option value="03 - Marzo">Marzo</option>
                                            <option value="04 - Abril">Abril</option>
                                            <option value="05 - Mayo">Mayo</option>
                                            <option value="06 - Junio">Junio</option>
                                            <option value="07 - Julio">Julio</option>
                                            <option value="08 - Agosto">Agosto</option>
                                            <option value="09 - Septiembre">Septiembre</option>
                                            <option value="10 - Octubre">Octubre</option>
                                            <option value="11 - Noviembre">Noviembre</option>
                                            <option value="12 - Diciembre">Diciembre</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="salida_Ano" class="col-sm-3 col-form-label">Año</label>
                                    <div class="col-sm-5">
                                        <input type="number" class="form-control" name="salida_Ano" id="salida_Ano" placeholder="Ingrese el año" required>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="salida_Motivo" class="col-sm-3 col-form-label">Motivo</label>
                                    <div class="col-sm-5">
                                        <select id="salida_Motivo" class="form-select"  name="salida_Motivo">
                                            <?php try {
                                                $sql = 'SELECT id_SalidaMotivo, name_SalidaMotivo FROM salidamotivo';
                                                foreach ($link->query($sql) as $rowc) {
                                                    if ($row['salida_Motivo']) {
                                                        $selected = 'selected="selected"';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                    ?>
                                                    <option <?= $selected ?> value="<?= $rowc['id_SalidaMotivo'] ?>"><?= $rowc['name_SalidaMotivo'] ?></option>
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
                                    <label for="salida_MovimientoFecha" class="col-sm-3 col-form-label">Fecha Movimiento</label>
                                    <div class="col-sm-5">
                                        <input type="date" class="form-control" name="salida_MovimientoFecha" id="salida_MovimientoFecha"  required>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="salida_Monto" class="col-sm-3 col-form-label">Monto $</label>
                                    <div class="col-sm-5">
                                        <input type="number" class="form-control" name="salida_Monto" id="salida_Monto" placeholder="Ingrese un monto" required>
                                    </div>
                                </div>

                                <div class="row mb-4 justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button class="btn btn-primary w-md" type="submit" name="crear">Crear</button>
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

<script src="assets/js/app.js"></script>

</body>

</html>
