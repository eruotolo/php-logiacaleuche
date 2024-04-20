<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php';?>

<head>

    <title><?php echo $titulo ?> | Testing</title>

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

    <div class="container" style="margin-top: 150px">

        <div style="border: 1px solid #000000;width: 850px; height: 320px">
            <div style="display: flex; justify-content: space-between; ">
                <div style="width: 200px; padding: 20px">
                    <img src="https://intranet.logiacaleuche.cl/Admin/assets/images/logo.jpg" style="width: 160px; height: 160px" alt="Logo">
                </div>
                <div style="width: 600px; padding: 20px">
                    <p style="text-align: right; font-size: 16px; font-weight: bold">Boleta N° ' . $id_Entrada . '</p>
                    <p style="text-align: right; font-size: 16px; font-weight: bold">Respetable Logia Caleuche 250</p>
                    <p style="text-align: right; font-size: 16px; font-weight: bold">Valle de Castro - Chiloé</p>
                </div>
            </div>
            <div style="width: 800px; padding: 20px">
                <table>
                    <thead>
                    <tr>
                        <th style="width: 280px; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right:1px solid #000000; padding-left: 10px; border-bottom: 1px solid #000000 ">Nombre Q:.H:.</th>
                        <th style="width: 100px; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right:1px solid #000000; text-align: center; border-bottom: 1px solid #000000; ">Mes Cuota</th>
                        <th style="width: 50px; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right:1px solid #000000; text-align: center; border-bottom: 1px solid #000000; ">Año</th>
                        <th style="width: 100px; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right:1px solid #000000; text-align: center; border-bottom: 1px solid #000000; ">Motivo</th>
                        <th style="width: 130px; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right:1px solid #000000; text-align: center; border-bottom: 1px solid #000000; ">Fecha de Pago</th>
                        <th style="width: 100px; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right:1px solid #000000; text-align: center; border-bottom: 1px solid #000000; ">Monto</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right:1px solid #000000; padding-left: 10px ">' . $row['name'] . ' ' . $row['lastname'] . '</td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right:1px solid #000000; text-align: center ">'. $mesCortado .'</td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right:1px solid #000000; text-align: center ">' . $row['entrada_Ano'] . '</td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right:1px solid #000000; text-align: center ">' . $row['name_Motivo'] . '</td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right:1px solid #000000; text-align: center ">'. $fechaFormateada .'</td>
                        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right:1px solid #000000; text-align: center ">'. $montoFormat .'</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <?php include 'layouts/footer.php'; ?>
</div>

<!-- ============================================================== -->
<!-- End right Content here -->
<!-- ============================================================== -->

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

<script src="assets/js/app.js"></script>

</body>

</html>
