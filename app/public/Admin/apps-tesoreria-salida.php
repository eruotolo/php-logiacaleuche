<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include ('layouts/config.php');?>

<head>

    <title><?php echo $titulo ?> | Registro Salida Dinero</title>

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
                            <h4 class="mb-sm-0 font-size-18">Administración Tesorero</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tesorería</a></li>
                                    <li class="breadcrumb-item active">Salida de Caja</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="d-flex flex-row justify-content-center col-totales">
                    <div class="col-entrada style-col">
                        <h3>TOTAL ENTRADA DE DINERO</h3>
                        <?php
                        $query ="SELECT SUM(entrada_Monto) AS total_entrada
                                 FROM entradadinero;";
                        $result_task1 = mysqli_query($link, $query);
                        while ($row = mysqli_fetch_Array($result_task1))  {
                            ?>
                            <h4>$ <?php echo $row['total_entrada'] ?></h4>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-salida style-col">
                        <h3>TOTAL SALIDA DE DINERO</h3>
                        <?php
                        $query ="SELECT SUM(salida_Monto) AS total_salida
                                 FROM salidadinero;";
                        $result_task2 = mysqli_query($link, $query);
                        while ($row = mysqli_fetch_Array($result_task2))  {
                            ?>
                            <h4>$ <?php echo $row['total_salida'] ?></h4>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-total style-col">
                        <h3>TOTAL EN CAJA</h3>
                        <?php
                        $query ="SELECT
                                    COALESCE((SELECT SUM(COALESCE(entrada_Monto, 0)) FROM entradadinero), 0) -
                                    COALESCE((SELECT SUM(COALESCE(salida_Monto, 0)) FROM salidadinero), 0) AS saldo_total;
                                ";
                        $result_task3 = mysqli_query($link, $query);
                        while ($row = mysqli_fetch_Array($result_task3))  {
                            ?>
                        <h4>$ <?php echo $row['saldo_total'] ?></h4>
                            <?php
                        }
                        ?>

                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <!--<h5 class="card-title">Contact List <span class="text-muted fw-normal ms-2">(834)</span></h5>-->
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">

                            <!-- VIEW ONLY ADMIN USER-->
                            <?php
                            if ($_SESSION['category'] == 2 || $_SESSION['username'] == '270396356'){
                                ?>
                                <div>
                                    <a href="apps-tesoreria-entrada-registro.php" class="btn btn-light"><i class="bx bx-plus me-1"></i> Registrar Entrada</a>
                                    <a href="apps-tesoreria-salida-registro.php" class="btn btn-light"><i class="bx bx-plus me-1"></i> Registrar Salida</a>
                                </div>
                                <?php
                            } else{
                                ?>
                                <div>
                                    <a href="#" class="btn btn-light"><i class="bx bx-plus me-1"></i> Registrar Entrada</a>
                                    <a href="#" class="btn btn-light"><i class="bx bx-plus me-1"></i> Registrar Salida</a>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                    </div>
                </div>
                <!-- end row -->

                <!-- end row -->

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Registro Salida de Dinero</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Mes</th>
                                            <th>Año</th>
                                            <th>Motivo</th>
                                            <th>Fecha del Movimiento</th>
                                            <th>Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query ="SELECT *, S.id_Salida as 'sid' from salidadinero S
                                                     JOIN users U on S.id_User = U.id
                                                     JOIN salidamotivo SM on S.salida_Motivo = SM.id_SalidaMotivo
                                            ORDER BY S.salida_MovimientoFecha DESC";
                                    $result_task = mysqli_query($link, $query);
                                    while ($row = mysqli_fetch_Array($result_task))  {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['name'] ?> <?php echo $row['lastname'] ?></td>
                                            <td><?php echo $row['salida_Mes'] ?></td>
                                            <td><?php echo $row['salida_Ano'] ?></td>
                                            <td><?php echo $row['name_SalidaMotivo'] ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($row['salida_MovimientoFecha'])); ?></td>
                                            <td>$ <?php echo $row['salida_Monto'] ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
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
<!-- Buttons examples -->
<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/jszip/jszip.min.js"></script>
<script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="assets/js/pages/datatables.init.js"></script>

<script src="assets/js/app.js"></script>

</body>

</html>

