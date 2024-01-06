<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include('layouts/config.php'); ?>

<?php

session_start();
$id = $_GET['id_Trazado'];
$query = "SELECT * FROM trazado T
                   JOIN users U on T.autor_Trazado = U.id
                   JOIN grado G on T.grado_Trazado = G.id 
                   WHERE id_Trazado = $id";

$query_run = mysqli_query($link, $query) or ($error= mysqli_error($link));
//echo $error;
//die();

if ($query_run) {
//$usuario = array();
while ($row  = mysqli_fetch_array($query_run)) {
//$usuario = $row;
?>

?>

<head>

    <title><?php echo $titulo ?> | Ver Trazado</title>

    <?php include 'layouts/head.php'; ?>

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
          type="text/css"/>

    <?php include 'layouts/head-style.php'; ?>

</head>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">TRAZADO</h4>
                                <p class="card-title-desc">
                                    <?php echo $row['name_Trazado'] ?> <code>|</code>
                                    Q:.H:. <?php echo $row['name'] ?> <?php echo $row['lastname'] ?><code>|</code>
                                    <?php echo $row['grado_nombre'] ?></p>
                            </div>
                            <div class="card-body p-4">
                                <embed src="uploads/trazado/<?php echo $row['file_name'] ?>" type="application/pdf" width="100%" height="600px" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

<?php
    }
} else {
    echo '<script> alert ("No se a guardado")</script>';
    header('Location: index.php');
}
?>

