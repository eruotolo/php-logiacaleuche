<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include('layouts/config.php'); ?>
<?php
function custom_echo($x, $length)
{
    if (strlen($x) <= $length) {
        echo $x;
    } else {
        $y = substr($x, 0, $length) . '...';
        echo $y;
    }
}

?>
<head>

    <title><?php echo $titulo ?></title>

    <?php include 'layouts/head.php'; ?>

    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet"
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
                            <h4 class="mb-sm-0 font-size-18">Escritorio</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Panel Administración</a>
                                    </li>
                                    <li class="breadcrumb-item active">Escritorio</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <!-- end page title -->

                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h5 class="card-title">Publicaciones
                                                   de los QQ:.HH:.</h5>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                            <div>
                                <a href="apps-news-new.php" class="btn btn-light"><i class="bx bx-plus me-1"></i> Nueva
                                                                                                                  Publicación</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <!-- POSTEOS INTERNOS -->
                <div class="row">

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-0">Publicaciones de los QQ:.HH:.</h5>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <a href="apps-news-list.php">Más Novedades</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="row">
                                        <!-- Inicio card -->
                                        <?php
                                        $query = "SELECT *, F.id_Feed as 'fid', F.created_at AS 'fcreated_at', F.estado_Feed AS 'festado' from feed F
                                            JOIN categoryfeed CF ON F.category_Feed = CF.id_Category
                                            JOIN users U ON F.user_Feed = U.id
                                            WHERE F.estado_Feed = 1 ORDER BY fcreated_at DESC LIMIT 6";
                                                    $result_task = mysqli_query($link, $query);
                                        while ($row = mysqli_fetch_Array($result_task)) {
                                            ?>
                                            <div class="col-xl-4 mb-4">
                                                <div class="card p-1 mb-xl-0 ">
                                                    <div class="p-3">
                                                        <div class="d-flex align-items-start">
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <h5 class="font-size-15 text-truncate"><a href="apps-blog-detail.php?id_Feed=<?php echo $row['id_Feed'] ?>"class="text-body"><?php echo $row['titulo_Feed']; ?></a>
                                                                </h5>
                                                                <p class="font-size-13 text-muted mb-0"><?php echo date("d/m/Y", strtotime($row['fcreated_at'])); ?></p>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="position-relative">
                                                        <div class="box-category">
                                                            <p class="btn-category"><?php echo $row['nombre_Category']; ?></p>
                                                        </div>

                                                        <img src="uploads/feed/<?php echo $row['file_name']; ?>" alt=""
                                                             class="img-thumbnail img-news">
                                                    </div>

                                                    <div class="p-3">
                                                        <p class="text-muted"><?php custom_echo($row['cont_Feed'], 76); ?></p>
                                                        <div>
                                                            <a href="apps-blog-detail.php?id_Feed=<?php echo $row['id_Feed'] ?>"
                                                               >Ver más <i class="mdi mdi-arrow-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <!-- Fin card -->
                                    </div>
                                    <!-- end row -->
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div>


                    <!--end col-->

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="mt-1 mb-2">
                                    <h5 class="mb-3">Cumpleaños del Mes</h5>
                                    <div class="list-group list-group-flush">
                                        <?php
                                        $query = "SELECT * FROM users
                                                        WHERE DATE_FORMAT(date_birthday, '%m%d') >= DATE_FORMAT(CURDATE(), '%m%d')
                                                        ORDER BY DATE_FORMAT(date_birthday, '%m%d') ASC
                                                        LIMIT 4;";
                                        $result_task = mysqli_query($link, $query);
                                        while ($row = mysqli_fetch_Array($result_task)) {
                                            ?>
                                            <div class="list-group-item text-muted pb-2 pt-2 px-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <img src="uploads/usuarios/<?php echo $row['image']; ?>" alt=""
                                                             class="avatar-xl h-auto d-block rounded">
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <h5 class="font-size-13 text-truncate"><?php echo $row['name']; ?> <?php echo $row['lastname']; ?></h5>
                                                        <p class="mb-0 text-truncate"><?php echo date("d/m/Y", strtotime($row['date_birthday'])); ?></p>
                                                    </div>
                                                    <div class="flex-grow-2  saludar">
                                                        <a href="controller/email-cumple.php?id_User=<?php echo $row['id']; ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                 height="16" fill="currentColor"
                                                                 class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                                                <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <!-- FINALIZA LOS CUMPLEAÑOS -->
                                    </div>
                                </div>

                            </div>
                        </div> <!-- end card -->
                        <div class="card">
                            <div class="card-body">
                                <div class="mt-1 mb-2">
                                    <h5 class="mb-3">Próximos Eventos</h5>

                                    <?php
                                    if ($_SESSION['grado'] == 1) {
                                        ?>
                                        <div class="list-group list-group-flush">
                                            <?php
                                            $query = "SELECT * FROM evento
                                                                WHERE cat_Evento = 1
                                                                  AND fecha_Evento >= CURDATE()
                                                                  AND MONTH(fecha_Evento) = MONTH(NOW())
                                                                ORDER BY fecha_Evento ASC";
                                            $result_task1 = mysqli_query($link, $query);
                                            while ($row = mysqli_fetch_Array($result_task1)) {
                                                ?>
                                                <div class="list-group-item text-muted py-3 px-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <?php
                                                            if ($row['cat_Evento'] == 1) {
                                                                ?>
                                                                <img src="assets/images/icono-aprendiz.svg" alt=""
                                                                     class="avatar-md h-auto d-block rounded">
                                                                <?php
                                                            } elseif ($row['cat_Evento'] == 2) {
                                                                ?>
                                                                <img src="assets/images/icono-companero.svg" alt=""
                                                                     class="avatar-md h-auto d-block rounded">
                                                                <?php
                                                            } elseif ($row['cat_Evento'] == 3) {
                                                                ?>
                                                                <img src="assets/images/icono-maestro.svg" alt=""
                                                                     class="avatar-md h-auto d-block rounded">
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src="assets/images/evento.jpg" alt=""
                                                                     class="avatar-lg h-auto d-block rounded">
                                                                <?php
                                                            }
                                                            ?>

                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h4 class="event-titulo text-truncate"><?php echo $row['nombre_Evento']; ?></h4>
                                                            <p class="event-fecha"><?php echo $row['trabajo_Evento']; ?></p>
                                                            <p class="event-date"><?php echo date("d/m/Y", strtotime($row['fecha_Evento'])); ?>
                                                                <span class="">/ <?php echo date("H:i", strtotime($row['inicio_Evento'])); ?></span>
                                                            </p>
                                                        </div>
                                                        <div class="fs-1">
                                                            <i class="mdi mdi-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                        <?php
                                    } elseif ($_SESSION['grado'] == 2) {
                                        ?>
                                        <div class="list-group list-group-flush">
                                            <?php
                                            $query = "SELECT * FROM evento 
                                                                WHERE cat_Evento IN (1,2) 
                                                                  AND fecha_Evento >= CURDATE()
                                                                  AND MONTH(fecha_Evento) = MONTH(NOW())
                                                                ORDER BY fecha_Evento ASC";
                                            $result_task2 = mysqli_query($link, $query);
                                            while ($row = mysqli_fetch_Array($result_task2)) {
                                                ?>
                                                <div class="list-group-item text-muted py-3 px-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <?php
                                                            if ($row['cat_Evento'] == 1) {
                                                                ?>
                                                                <img src="assets/images/icono-aprendiz.svg" alt=""
                                                                     class="avatar-md h-auto d-block rounded">
                                                                <?php
                                                            } elseif ($row['cat_Evento'] == 2) {
                                                                ?>
                                                                <img src="assets/images/icono-companero.svg" alt=""
                                                                     class="avatar-md h-auto d-block rounded">
                                                                <?php
                                                            } elseif ($row['cat_Evento'] == 3) {
                                                                ?>
                                                                <img src="assets/images/icono-maestro.svg" alt=""
                                                                     class="avatar-md h-auto d-block rounded">
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src="assets/images/evento.jpg" alt=""
                                                                     class="avatar-lg h-auto d-block rounded">
                                                                <?php
                                                            }
                                                            ?>

                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h4 class="event-titulo text-truncate"><?php echo $row['nombre_Evento']; ?></h4>
                                                            <p class="event-fecha"><?php echo $row['trabajo_Evento']; ?></p>
                                                            <p class="event-date"><?php echo date("d/m/Y", strtotime($row['fecha_Evento'])); ?>
                                                                <span class="">/ <?php echo date("H:i", strtotime($row['inicio_Evento'])); ?></span>
                                                            </p>
                                                        </div>
                                                        <div class="fs-1">
                                                            <i class="mdi mdi-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="list-group list-group-flush">
                                            <?php
                                            $query = "SELECT * FROM evento 
                                                         WHERE MONTH(fecha_Evento) = MONTH(NOW()) 
                                                                AND fecha_Evento >= CURDATE()
                                                                ORDER BY fecha_Evento ASC
                                                         ";
                                            $result_task3 = mysqli_query($link, $query);
                                            while ($row = mysqli_fetch_Array($result_task3)) {
                                                ?>
                                                <div class="list-group-item text-muted py-3 px-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <?php
                                                            if ($row['cat_Evento'] == 1) {
                                                                ?>
                                                                <img src="assets/images/icono-aprendiz.svg" alt=""
                                                                     class="avatar-md h-auto d-block rounded">
                                                                <?php
                                                            } elseif ($row['cat_Evento'] == 2) {
                                                                ?>
                                                                <img src="assets/images/icono-companero.svg" alt=""
                                                                     class="avatar-md h-auto d-block rounded">
                                                                <?php
                                                            } elseif ($row['cat_Evento'] == 3) {
                                                                ?>
                                                                <img src="assets/images/icono-maestro.svg" alt=""
                                                                     class="avatar-md h-auto d-block rounded">
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src="assets/images/evento.jpg" alt=""
                                                                     class="avatar-lg h-auto d-block rounded">
                                                                <?php
                                                            }
                                                            ?>

                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h4 class="event-titulo text-truncate"><?php echo $row['nombre_Evento']; ?></h4>
                                                            <p class="event-fecha"><?php echo $row['trabajo_Evento']; ?></p>
                                                            <p class="event-date"><?php echo date("d/m/Y", strtotime($row['fecha_Evento'])); ?>
                                                                <span class="">/ <?php echo date("H:i", strtotime($row['inicio_Evento'])); ?></span>
                                                            </p>
                                                        </div>
                                                        <div class="fs-1">
                                                            <i class="mdi mdi-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- end main content-->
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Plugins js-->
<script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>

<!-- dashboard init -->
<script src="assets/js/pages/dashboard.init.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>

</body>

</html>