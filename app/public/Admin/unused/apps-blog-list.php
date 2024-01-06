<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include('layouts/config.php');?>

<head>
    <title>Blog List | Minia - Admin & Dashboard Template</title>
    <?php include 'layouts/head.php'; ?>

    <!-- DataTables -->
    <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="../assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Panel Administración</a></li>
                                            <li class="breadcrumb-item active">Escritorio</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <!-- TARJETAS CABEZAL INFORMACIÓN GENERAL -->
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">My Wallet</span>
                                                <h4 class="mb-3">
                                                    $<span class="counter-value" data-target="865.2">0</span>k
                                                </h4>
                                            </div>

                                            <div class="col-6">
                                                <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge badge-soft-success text-success">+$20.9k</span>
                                            <span class="ms-1 text-muted font-size-13">Since last week</span>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Number of Trades</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="6258">0</span>
                                                </h4>
                                            </div>
                                            <div class="col-6">
                                                <div id="mini-chart2" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge badge-soft-danger text-danger">-29 Trades</span>
                                            <span class="ms-1 text-muted font-size-13">Since last week</span>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col-->

                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Invested Amount</span>
                                                <h4 class="mb-3">
                                                    $<span class="counter-value" data-target="4.32">0</span>M
                                                </h4>
                                            </div>
                                            <div class="col-6">
                                                <div id="mini-chart3" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge badge-soft-success text-success">+ $2.8k</span>
                                            <span class="ms-1 text-muted font-size-13">Since last week</span>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <!-- card -->
                                <div class="card card-h-100">
                                    <!-- card body -->
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Profit Ration</span>
                                                <h4 class="mb-3">
                                                    <span class="counter-value" data-target="12.57">0</span>%
                                                </h4>
                                            </div>
                                            <div class="col-6">
                                                <div id="mini-chart4" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                            </div>
                                        </div>
                                        <div class="text-nowrap">
                                            <span class="badge badge-soft-success text-success">+2.95%</span>
                                            <span class="ms-1 text-muted font-size-13">Since last week</span>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div>

                        <!-- end page title -->

                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5 class="card-title">Post de los QQ:.HH:.</h5>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                                    <div>
                                        <a href="#" class="btn btn-light"><i class="bx bx-plus me-1"></i> Nuevo Post</a>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- end row -->

                        <!-- POSTEOS INTERNOS -->
                        <div class="row">
                            <div class="col-xl-8">
                                <?php
                                    $query="SELECT * FROM feed
                                            JOIN categoryfeed c on c.id_Category = feed.category_Feed
                                            JOIN users u on u.id = feed.user_Feed
                                            WHERE estado_Feed = 1";
                                    $result_task = mysqli_query($link, $query);
                                    while ($row = mysqli_fetch_Array($result_task))  {
                                ?>
                                <div class="card">
                                    <img src="uploads/feed/<?php echo $row['file_name']; ?>" alt="" class="img-fluid">
                                    <div class="card-body">
                                        <p class="text-muted mb-2"><?php echo $row['feed.created_at']; ?></p>
                                        <h5 class=""><a href="../apps-blog-detail.php?id_Feed=<?php echo $row['id_Feed'] ?>" class="text-body"><?php echo $row['titulo_Feed']; ?></a></h5>
                                        <p class="mb-0 font-size-15"><?php echo $row['cont_Feed']; ?></p>
                                        <div class="mt-3">
                                            <a href="../apps-blog-detail.php?id_Feed=<?php echo $row['id_Feed'] ?>" class="align-middle font-size-15">Ver más <i class="mdi mdi-chevron-right"></i></a>
                                        </div>
                                    </div>
                                </div> <!-- end card -->
                               <?php
                                    }
                               ?>

                            </div>
                            <!--end col-->

                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mt-1 mb-2">
                                            <h5 class="mb-3">Cumpleaños del Mes</h5>
                                            <div class="list-group list-group-flush">
                                                <?php
                                                    $query="SELECT * FROM users WHERE MONTH(date_birthday) = MONTH(NOW()) ORDER BY date_birthday DESC";
                                                $result_task = mysqli_query($link, $query);
                                                while ($row = mysqli_fetch_Array($result_task))  {
                                                ?>
                                                <div  class="list-group-item text-muted pb-2 pt-2 px-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <img src="uploads/usuarios/<?php echo $row['image']; ?>" alt="" class="avatar-xl h-auto d-block rounded">
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="font-size-13 text-truncate"><?php echo $row['name']; ?> <?php echo $row['lastname']; ?></h5>
                                                            <p class="mb-0 text-truncate"><?php echo date("d/m/Y", strtotime($row['date_birthday'])); ?></p>
                                                        </div>
                                                        <div class="flex-grow-2  saludar">
                                                            <a href="#" >
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
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
                                            <div class="list-group list-group-flush">

                                                <div class="list-group-item text-muted py-3 px-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-3">
                                                            <img src="../assets/images/small/img-1.jpg" alt="" class="avatar-lg h-auto d-block rounded">
                                                        </div>
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <h5 class="font-size-13 text-truncate">Coffee with friends</h5>
                                                            <p class="mb-0 text-truncate">20 August, 2022 <span class="">/ 05:30 PM</span></p>
                                                        </div>
                                                        <div class="fs-1">
                                                            <i class="mdi mdi-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->

                        <div class="row justify-content-center mb-4">
                            <div class="col-md-3">
                                <div class="">
                                    <ul class="pagination mb-sm-0">
                                        <li class="page-item disabled">
                                            <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">1</a>
                                        </li>
                                        <li class="page-item active">
                                            <a href="#" class="page-link">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">4</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">5</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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

        <!-- Required datatable js -->
        <script src="../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="../assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

        <!-- Responsive examples -->
        <script src="../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- init js -->
        <script src="../assets/js/pages/datatable-pages.init.js"></script>

        <!-- App js -->
        <script src="../assets/js/app.js"></script>

    </body>
</html>
