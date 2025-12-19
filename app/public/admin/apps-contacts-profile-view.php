<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<?php
include('layouts/config.php');
session_start();

$id = $_GET['id'];
$query = "SELECT * FROM users WHERE id = $id";
$query_run = mysqli_query($link, $query);

if ($query_run) {
//$usuario = array();
    while ($row = mysqli_fetch_array($query_run)) {
//$usuario = $row;
        ?>

        <head>

            <title><?php echo $titulo ?> | Ver Perfil de hermano</title>

            <?php include 'layouts/head.php'; ?>

            <!-- DataTables -->
            <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"
                  type="text/css"/>

            <!-- Responsive datatable examples -->
            <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
                  type="text/css"/>

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
                                    <h4 class="mb-sm-0 font-size-18">Ver Información del Q:.H:.</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="apps-contacts-list.php">Hermanos</a>
                                            </li>
                                            <li class="breadcrumb-item active">Información</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm order-2 order-sm-1">
                                                <div class="d-flex align-items-start mt-3 mt-sm-0">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar-xl me-3">
                                                            <img src="uploads/usuarios/<?php echo $row['image']; ?>" alt="" class="img-fluid rounded-circle d-block">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 item-perfil">
                                                        <div>
                                                            <h5 class="font-size-16 mb-1"><?php echo $row['name']; ?> <?php echo $row['lastname']; ?></h5>
                                                            <?php
                                                            if ($row['grado'] == 1){
                                                                ?>
                                                                <p class="text-muted font-size-13">Aprendiz</p>
                                                                <?php
                                                            }elseif ($row['grado'] == 2){
                                                                ?>
                                                                <p class="text-muted font-size-13">Compañero</p>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <p class="text-muted font-size-13">Maestro</p>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-auto order-1 order-sm-2">
                                                <div class="d-flex align-items-start justify-content-end gap-2">

                                                </div>
                                            </div>
                                        </div>

                                        <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link px-3 active" data-bs-toggle="tab" href="#publications" role="tab">Publicaciones</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link px-3" data-bs-toggle="tab" href="#about" role="tab">Información General</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link px-3 " data-bs-toggle="tab" href="#overview" role="tab">Trazados</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                                <div class="tab-content">

                                    <div class="tab-pane active" id="publications" role="tabpanel">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Publicaciones</h5>
                                            </div>
                                            <div class="card-body">

                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>

                                    <div class="tab-pane" id="about" role="tabpanel">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Información General</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <table class="table tabla-perfil">
                                                            <tbody>
                                                            <tr>
                                                                <td><b>Nombre:</b></td>
                                                                <td><?php echo $row['name']; ?> <?php echo $row['lastname']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Fecha de Nacimiento:</b></td>
                                                                <td><?php echo date("d/m/Y", strtotime($row['date_birthday'])); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Email:</b></td>
                                                                <td><?php echo $row['useremail']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Teléfono:</b></td>
                                                                <td><?php echo $row['phone']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Ciudad:</b></td>
                                                                <td><?php echo $row['city']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Dirección:</b></td>
                                                                <td><?php echo $row['address']; ?></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-5">
                                                        <table class="table tabla-perfil">
                                                            <tbody>
                                                            <tr>
                                                                <td><b>Grado:</b></td>
                                                                <?php
                                                                if ($row['grado'] == 1){
                                                                    ?>
                                                                    <td>Aprendiz</td>
                                                                    <?php
                                                                }elseif ($row['grado'] == 2){
                                                                    ?>
                                                                    <td>Compañero</td>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <td>Maestro</td>
                                                                    <?php
                                                                }
                                                                ?>

                                                            </tr>
                                                            <tr>
                                                                <td><b>Cargo en la Oficialidad:</b></td>
                                                                <?php
                                                                if ($row['oficialidad'] == 1) {
                                                                    ?>
                                                                    <td>Ninguno</td>
                                                                    <?php
                                                                } elseif ($row['oficialidad'] == 2) {
                                                                    ?>
                                                                    <td>Venerable Maestro</td>
                                                                    <?php
                                                                } elseif ($row['oficialidad'] == 3) {
                                                                    ?>
                                                                    <td>Primer Vigilante</td>
                                                                    <?php
                                                                } elseif ($row['oficialidad'] == 4) {
                                                                    ?>
                                                                    <td>Segundo Vigilante</td>
                                                                    <?php
                                                                } elseif ($row['oficialidad'] == 5) {
                                                                    ?>
                                                                    <td>Orador</td>
                                                                    <?php
                                                                } elseif ($row['oficialidad'] == 6) {
                                                                    ?>
                                                                    <td>Secretario</td>
                                                                    <?php
                                                                } elseif ($row['oficialidad'] == 7) {
                                                                    ?>
                                                                    <td>Tesorero</td>
                                                                    <?php
                                                                } elseif ($row['oficialidad'] == 8) {
                                                                    ?>
                                                                    <td>Hospitalario</td>

                                                                    <?php
                                                                } elseif ($row['oficialidad'] == 9) {
                                                                    ?>
                                                                    <td>Maestro de Ceremonia</td>
                                                                    <?php
                                                                } elseif ($row['oficialidad'] == 10) {
                                                                    ?>
                                                                    <td>Maestro Experto</td>
                                                                    <?php
                                                                } elseif ($row['oficialidad'] == 11) {
                                                                    ?>
                                                                    <td>Guarda Templo</td>
                                                                    <?php
                                                                } elseif ($row['oficialidad'] == 12) {
                                                                    ?>
                                                                    <td>Maestro de Banquetes</td>
                                                                    <?php
                                                                } elseif ($row['oficialidad'] == 13) {
                                                                    ?>
                                                                    <td>Maestro de Armonía</td>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Fecha de Iniciación:</b></td>
                                                                <td><?php echo date("d/m/Y", strtotime($row['date_initiation'])); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Fecha de Aumento de Salario:</td>
                                                                <?php
                                                                if ($row['grado'] == 1){
                                                                    ?>

                                                                    <?php
                                                                }elseif ($row['grado'] == 2){
                                                                    ?>
                                                                    <td><?php echo date("d/m/Y", strtotime($row['date_salary'])); ?></td>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <td><?php echo date("d/m/Y", strtotime($row['date_salary'])); ?></td>
                                                                    <?php
                                                                }
                                                                ?>

                                                            </tr>
                                                            <tr>
                                                                <td><b>Fecha de Exaltación:</td>
                                                                <?php
                                                                if ($row['grado'] == 3){
                                                                    ?>
                                                                    <td><?php echo date("d/m/Y", strtotime($row['date_exalted'])); ?></td>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->
                                    </div>

                                    <div class="tab-pane " id="overview" role="tabpanel">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">Trazados</h5>
                                            </div>
                                            <div class="card-body">

                                            </div>
                                            <!-- end card body -->
                                        </div>
                                        <!-- end card -->

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
    header('Location: apps-contacts-list.php');
}
?>
