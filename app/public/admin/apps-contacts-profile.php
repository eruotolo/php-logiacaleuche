<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include ('layouts/config.php');?>
<?php
    $id_user = $_SESSION['id'];
    $bajocosto = array(50020428, 79153427, 37509698, 85088971, 37558249, 45127850, 82731156);
    $mediocosto = array(55348030);
    $username = $_SESSION['username'];
 ?>
<head>
    
    <title><?php echo $titulo ?> | Perfil</title>
    <?php include 'layouts/head.php'; ?>
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
                            <h4 class="mb-sm-0 font-size-18">Perfil del Q:. H:. Logueado</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="apps-contacts-list.php">Perfil Personal</a></li>
                                    <li class="breadcrumb-item active">Información Personal</li>
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
                                                    <img src="uploads/usuarios/<?php echo $_SESSION['image']; ?>" alt="" class="img-fluid rounded-circle d-block">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 item-perfil">
                                                <div>
                                                    <h5 class="font-size-16 mb-1"><?php echo $_SESSION['name']; ?> <?php echo $_SESSION['lastname']; ?></h5>
                                                    <?php
                                                        if ($_SESSION['grado'] == 1){
                                                    ?>
                                                        <p class="text-muted font-size-13">Aprendiz</p>
                                                    <?php
                                                        }elseif ($_SESSION['grado'] == 2){
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
                                            <div>
                                                <a href="apps-perfile-edit.php" class="btn btn-soft-light"><i class="me-1"></i> Editar Perfil</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link px-3 active" data-bs-toggle="tab" href="#about" role="tab">Información General</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3 " data-bs-toggle="tab" href="#tesoreria" role="tab">Tesorería</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3 " data-bs-toggle="tab" href="#publications" role="tab">Publicaciones</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3 " data-bs-toggle="tab" href="#overview" role="tab">Trazados</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="tab-content ">

                            <div class="tab-pane active" id="about" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Información General</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-5 col-sm-1">
                                                <table class="table tabla-perfil">
                                                    <tbody>
                                                    <tr>
                                                        <td><b>Nombre:</b></td>
                                                        <td><?php echo $_SESSION['name']; ?> <?php echo $_SESSION['lastname']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Fecha de Nacimiento:</b></td>
                                                        <td><?php echo date("d/m/Y", strtotime($_SESSION['date_birthday'])); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Email:</b></td>
                                                        <td><?php echo $_SESSION['useremail']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Teléfono:</b></td>
                                                        <td><?php echo $_SESSION['phone']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Ciudad:</b></td>
                                                        <td><?php echo $_SESSION['city']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Dirección:</b></td>
                                                        <td><?php echo $_SESSION['address']; ?></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-5 col-sm-1">
                                                <table class="table tabla-perfil">
                                                    <tbody>
                                                    <tr>
                                                        <td><b>Grado:</b></td>
                                                        <?php
                                                        if ($_SESSION['grado'] == 1){
                                                            ?>
                                                            <td>Aprendiz</td>
                                                            <?php
                                                        }elseif ($_SESSION['grado'] == 2){
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
                                                        if ($_SESSION['oficialidad'] == 1) {
                                                            ?>
                                                            <td>Ninguno</td>
                                                            <?php
                                                        } elseif ($_SESSION['oficialidad'] == 2) {
                                                            ?>
                                                            <td>Venerable Maestro</td>
                                                            <?php
                                                        } elseif ($_SESSION['oficialidad'] == 3) {
                                                            ?>
                                                            <td>Primer Vigilante</td>
                                                            <?php
                                                        } elseif ($_SESSION['oficialidad'] == 4) {
                                                            ?>
                                                            <td>Segundo Vigilante</td>
                                                            <?php
                                                        } elseif ($_SESSION['oficialidad'] == 5) {
                                                            ?>
                                                            <td>Orador</td>
                                                            <?php
                                                        } elseif ($_SESSION['oficialidad'] == 6) {
                                                            ?>
                                                            <td>Secretario</td>
                                                            <?php
                                                        } elseif ($_SESSION['oficialidad'] == 7) {
                                                            ?>
                                                            <td>Tesorero</td>
                                                            <?php
                                                        } elseif ($_SESSION['oficialidad'] == 8) {
                                                            ?>
                                                            <td>Hospitalario</td>

                                                            <?php
                                                        } elseif ($_SESSION['oficialidad'] == 9) {
                                                            ?>
                                                            <td>Maestro de Ceremonia</td>
                                                            <?php
                                                        } elseif ($_SESSION['oficialidad'] == 10) {
                                                            ?>
                                                            <td>Maestro Experto</td>
                                                            <?php
                                                        } elseif ($_SESSION['oficialidad'] == 11) {
                                                            ?>
                                                            <td>Guarda Templo</td>
                                                            <?php
                                                        } elseif ($_SESSION['oficialidad'] == 12) {
                                                            ?>
                                                            <td>Maestro de Banquetes</td>
                                                            <?php
                                                        } elseif ($_SESSION['oficialidad'] == 13) {
                                                            ?>
                                                            <td>Maestro de Armonía</td>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Fecha de Iniciación:</b></td>
                                                        <td><?php echo date("d/m/Y", strtotime($_SESSION['date_initiation'])); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Fecha de Aumento de Salario:</td>
                                                        <?php
                                                        if ($_SESSION['grado'] == 1){
                                                            ?>

                                                            <?php
                                                        }elseif ($_SESSION['grado'] == 2){
                                                            ?>
                                                            <td><?php echo date("d/m/Y", strtotime($_SESSION['date_salary'])); ?></td>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <td><?php echo date("d/m/Y", strtotime($_SESSION['date_salary'])); ?></td>
                                                            <?php
                                                        }
                                                        ?>

                                                    </tr>
                                                    <tr>
                                                        <td><b>Fecha de Exaltación:</td>
                                                        <?php
                                                        if ($_SESSION['grado'] == 3){
                                                            ?>
                                                            <td><?php echo date("d/m/Y", strtotime($_SESSION['date_exalted'])); ?></td>
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

                            <div class="tab-pane mb-5" id="tesoreria" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Tesorería</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive mb-4">
                                            <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%; margin-bottom: 80px">
                                                <thead>
                                                <tr>
                                                    <th scope="col" style="width: 50px;">
                                                        <div class="form-check font-size-16">
                                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th scope="col">Motivo</th>
                                                    <th scope="col">Mes</th>
                                                    <th scope="col">Año</th>
                                                    <th scope="col">Fecha de Pago</th>
                                                    <th style="col">Monto Pagado</th>
                                                    <th style="col">Pendiente</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $query ="SELECT * from entradadinero E
                                                                          JOIN users U on E.id_User = U.id
                                                                          JOIN entradamotivo on E.entrada_Motivo = entradamotivo.id_Motivo
                                                        WHERE U.id = $id_user AND entradamotivo.id_Motivo = 1 ORDER BY entrada_Ano DESC";
                                                $result_task = mysqli_query($link, $query);
                                                while ($row = mysqli_fetch_Array($result_task))  {

                                                    ?>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox" class="form-check-input" id="contacusercheck1">
                                                                <label class="form-check-label" for="contacusercheck1"></label>
                                                            </div>
                                                        </th>
                                                        <td><?php echo $row['name_Motivo'] ?></td>
                                                        <td><?php echo $row['entrada_Mes'] ?></td>
                                                        <td><?php echo $row['entrada_Ano'] ?></td>
                                                        <td><?php echo date("d/m/Y", strtotime($row['entrada_MovimientoFecha'])); ?></td>
                                                        <td>$ <?php echo $row['entrada_Monto'] ?></td>
                                                        <?php
                                                            if (in_array($username, $bajocosto)) {
                                                        ?>
                                                                <td style="color: red">$ <?php echo number_format(10000 - $row['entrada_Monto'], 2, ',', '.') ?></td>
                                                        <?php
                                                            }elseif (in_array($username, $mediocosto)) {
                                                        ?>
                                                                <td style="color: red">$ <?php echo number_format(30000 - $row['entrada_Monto'], 2, ',', '.') ?></td>
                                                        <?php
                                                            }else{
                                                        ?>
                                                                <td style="color: red">$ <?php echo number_format(43000 - $row['entrada_Monto'], 2, ',', '.') ?></td>
                                                        <?php
                                                            }
                                                        ?>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->

                            </div>

                            <div class="tab-pane" id="publications" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col-md-6">
                                                <h5 class="card-title mb-0">Publicaciones</h5>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="d-flex flex-wrap align-items-center justify-content-end ">
                                                    <div>
                                                        <a href="apps-news-new.php" class="btn btn-light"><i class="bx bx-plus me-1"></i> Nueva Publicación</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive mb-4">
                                            <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%; margin-bottom: 80px">
                                                <thead>
                                                <tr>
                                                    <th scope="col" style="width: 50px;">
                                                        <div class="form-check font-size-16">
                                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th scope="col">Titulo del Publicación</th>
                                                    <th scope="col">Autor</th>
                                                    <th scope="col">Fecha</th>
                                                    <th style="width: 80px; min-width: 80px;">Acción</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $query ="SELECT * FROM feed
                                                        JOIN categoryfeed c on c.id_Category = feed.category_Feed
                                                        JOIN users u on u.id = feed.user_Feed
                                                        WHERE u.id = $id_user and estado_Feed = 1";
                                                $result_task = mysqli_query($link, $query);
                                                while ($row = mysqli_fetch_Array($result_task))  {

                                                    ?>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox" class="form-check-input" id="contacusercheck1">
                                                                <label class="form-check-label" for="contacusercheck1"></label>
                                                            </div>
                                                        </th>
                                                        <td><?php echo $row['titulo_Feed'] ?></td>
                                                        <td><?php echo $row['name'] ?> <?php echo $row['lastname'] ?></td>
                                                        <td><?php echo date("d/m/Y", strtotime($row['created_at'])); ?></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item" href="apps-blog-detail.php?id_Feed=<?php echo $row['id_Feed'] ?>">Ver</a></li>
                                                                    <li><a class="dropdown-item" href="../admin/controller/feed-remove.php?id_Feed=<?php echo $row['id_Feed'] ?>">Eliminar</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>

                            <div class="tab-pane mb-5" id="overview" role="tabpanel">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Trazados</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive mb-4">
                                            <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%; margin-bottom: 80px">
                                                <thead>
                                                <tr>
                                                    <th scope="col" style="width: 50px;">
                                                        <div class="form-check font-size-16">
                                                            <input type="checkbox" class="form-check-input" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                    </th>
                                                    <th scope="col">Nombre Trazado</th>
                                                    <th scope="col">Autor Trazado</th>
                                                    <th scope="col">Fecha Trazado</th>
                                                    <th style="width: 80px; min-width: 80px;">Acción</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $query ="SELECT * FROM trazado T
                                                         JOIN grado G on T.grado_Trazado = G.id
                                                         JOIN users U on T.autor_Trazado = U.id
                                                         WHERE U.id = $id_user";
                                                $result_task = mysqli_query($link, $query);
                                                while ($row = mysqli_fetch_Array($result_task))  {

                                                    ?>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox" class="form-check-input" id="contacusercheck1">
                                                                <label class="form-check-label" for="contacusercheck1"></label>
                                                            </div>
                                                        </th>
                                                        <td><?php echo $row['name_Trazado'] ?></td>
                                                        <td><?php echo $row['name'] ?> <?php echo $row['lastname'] ?></td>
                                                        <td><?php echo date("d/m/Y", strtotime($row['fecha_Trazado'])); ?></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-link font-size-16 shadow-none py-0 text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item" href="apps-trazado-view.php?id_Trazado=<?php echo $row['id_Trazado'] ?>">Ver</a></li>

                                                                    <?php
                                                                    if ($_SESSION['category'] == 2 || $_SESSION['username'] == '270396356'){
                                                                        ?>
                                                                        <li><a class="dropdown-item" href="../admin/controller/trazado-remove.php?id_Trazado=<?php echo $row['id_Trazado'] ?>">Eliminar</a></li>
                                                                        <?php
                                                                    } else{
                                                                        ?>
                                                                        <li><a class="dropdown-item disabled" href="#">Eliminar</a></li>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->

                            </div>

                        </div>
                        <!-- end tab content -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>

</body>

</html>